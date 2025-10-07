/* === Réseaux de recherche (Insert + Liste + Modifier + Supprimer) & Stats === */
(() => {
  "use strict";

  // --- Config REST ---
  const CFG = (() => {
    const base = (window.PMSettings?.restUrl || "/wp-json").replace(/\/$/, "");
    return { base, nonce: window.PMSettings?.nonce || "", ns: "plateforme-recherche/v1" };
  })();

  // --- Utils ---
  const $   = (sel, root=document) => root.querySelector(sel);
  const $$ = (sel, root=document) => Array.from(root.querySelectorAll(sel));

  // --- Unified API Function ---
  async function api(path, {method="GET", data=null, query=null}={}) {
    // FIX: Automatically add the user_id to all query parameters.
    const queryWithUserContext = { ...query, user_id: window.PMSettings?.userId };
    const url = `${CFG.base}/${CFG.ns}/${path}` + (queryWithUserContext ? `?${new URLSearchParams(queryWithUserContext)}` : "");
    const opt = {
      method,
      headers: { "X-WP-Nonce": CFG.nonce, "Accept":"application/json" },
      credentials: "include"
    };
    if (data) {
      opt.headers["Content-Type"] = "application/json";
      opt.body = JSON.stringify(data);
    }
    const r = await fetch(url, opt);
    const t = await r.text(); let j;
    try { j = JSON.parse(t); } catch { j = { raw:t }; }
    if (!r.ok) throw new Error(j?.message || `HTTP ${r.status}`);
    return j;
  }

  // --- Project & Country Loading ---
  const loadProjects = async () => {
    try {
      const data = await api('projet', { method: 'GET' });
      const projets = Array.isArray(data) ? data : [];
      const options = `<option value="">Sélection..</option>` +
        projets.map(p => `<option value="${p.id}">${p.titre}</option>`).join('');
      const selAdd = document.getElementById('projetsAssocies');
      const selEdit = document.getElementById('projetsAssociesModifier');
      if (selAdd) selAdd.innerHTML = options;
      if (selEdit) selEdit.innerHTML = options;
    } catch (e) {
      console.error('Erreur lors du chargement des projets :', e);
      alert('Erreur lors du chargement des projets : ' + (e.message || e));
    }
  };

  async function loadPays({ lang = 'fr', q = '', actif = 1 } = {}) {
    try {
      const data = await wpFetch(`${CFG.base}/plateforme/v1/pays?lang=${encodeURIComponent(lang)}&actif=${actif}` + (q ? `&q=${encodeURIComponent(q)}` : ''));
      const items = Array.isArray(data?.items) ? data.items : [];
      populateSelect(document.getElementById('pays'), items, 'Sélection..');
      populateSelect(document.getElementById('paysModifier'), items, 'Sélection..');
    } catch (e) {
      console.error('[loadPays]', e);
      if (window.toast) window.toast('Erreur de chargement des pays : ' + e.message, true);
    }
  }

window.badgeHTML = function(statut) {
    if (statut === "Actif") return `<span class="badge badge-success"><i class="fa-regular fa-circle-check" style="color:#0E962D;padding-right:5px;"></i>Actif</span>`;
    if (statut === "Occasionnel") return `<span class="badge badge-secondary"><i class="fa-solid fa-arrows-rotate" style="color:#A6A485;padding-right:5px;"></i>Occasionnel</span>`;
    if (statut === "En cours") return `<span class="badge badge-warning"><i class="fa-regular fa-clock" style="color:#FFD43B;padding-right:5px;"></i>En cours</span>`;
    return `<span class="badge badge-danger">Clos</span>`;
}

window.actionsHTML = function(id) {
    return `<div class="actions">
        <button class="action-btn">...</button>
        <div class="dropdown-menu">
            <a href="#" class="btn-modifier" data-id="${id}">Modifier</a>
            <a href="/fiche-partenaires/?id=${id}">Fiche partenaire</a>
            <a href="#" class="btn-supprimer" data-id="${id}">Supprimer</a>
        </div>
    </div>`;
}

  // function renderRows(items){
  //   const tbody = $('#candidaturesTable tbody');
  //   tbody.innerHTML = (items||[]).map(it => `
  //     <tr data-id="${it.id}">
  //       <td><input type="checkbox"></td>
  //       <td>${it.institution || ''}</td>
  //       <td>${it.pays || ''}</td>
  //       <td>${it.type_collab || ''}</td>
  //       <td>${it.contact_nom || ''}</td>
  //       <td>${it.convention_signee ? 'Oui' : 'Non'}</td>
  //       <td>${badgeHTML(it.statut || '')}</td>
  //       <td>${actionsHTML(it.id || '')}</td>
  //     </tr>
  //   `).join('');
  // }

// --- Data Loading ---
async function loadVisibleReseaux() {
    try {
        // Check if the table instance exists
        if (!window.partenairesTable) {
            console.error("DataTables instance not found.");
            return;
        }

        const data = await api('reseaux/visible', { method: 'GET', query: { page: 1, per_page: 50 } });

        // Use the DataTables API to add data
        window.partenairesTable.clear(); // Clear old data
        window.partenairesTable.rows.add(data.items || []); // Add new data
        window.partenairesTable.draw(); // Redraw the table

        // The draw event will automatically trigger the pagination update.
        // You still need to attach menus for the new rows.
        attachRowMenus();
    } catch (err) {
        console.error("Erreur chargement réseaux:", err);
    }
}

  // --- Form Handling ---
  function collectAddForm(root) {
    const fileInput = root.querySelector('#fileUpload');
    const file = fileInput?.files?.[0] || null;
    const prjSel = $('#projetsAssocies', root)?.value;
    
    return {
      institution: $('#institutionPartenaire', root)?.value?.trim() || "",
      pays: $('#pays', root)?.value || "",
      type_collab: $('#typeCollaboration', root)?.value || "",
      contact_nom: $('#nomComplet', root)?.value?.trim() || "",
      contact_email: $('#email', root)?.value?.trim() || "",
      date_debut: $('#dateDebut', root)?.value || null,
      date_fin: $('#dateFin', root)?.value || null,
      convention_signee: root.querySelector('input[name="convention"]:checked')?.value === 'oui' ? 1 : 0,
      statut: 'Actif',
      projets_associes: (prjSel && prjSel !== 'Sélection..') ? [ parseInt(prjSel,10) ] : [],
      site_web: $('#siteweb', root)?.value?.trim() || "",
      adresse_org: $('#adresse', root)?.value?.trim() || "",
      piece_jointe: file
    };
  }

  function validatePayload(p) {
    if (!p.institution) throw new Error("Institution requise");
    if (!p.pays || p.pays === "Sélection..") throw new Error("Pays requis");
    if (!p.type_collab || p.type_collab === "Sélection..") throw new Error("Type requis");
    if (!p.contact_email) throw new Error("Email requis");
    if (!/^\S+@\S+\.\S+$/.test(p.contact_email)) throw new Error("Email invalide");
    if (!p.date_debut) throw new Error("Date début requise");
  }

  // --- Event Handlers & Attachments ---
  function attachRowMenus(){
    $$('#candidaturesTable .action-btn').forEach(btn=>{
      btn.addEventListener('click', e=>{
        e.stopPropagation();
        const menu = btn.nextElementSibling;
        const show = menu && !menu.classList.contains('show');
        $$('.dropdown-menu.show').forEach(m=>m.classList.remove('show'));
        if (menu && show) menu.classList.add('show');
      });
    });
    document.addEventListener('click', ()=> $$('.dropdown-menu.show').forEach(m=>m.classList.remove('show')), { once:true });

    $$('#candidaturesTable .btn-modifier').forEach(a=>{
      a.addEventListener('click', async e=>{
        e.preventDefault();
        const id = a.dataset.id;
        try {
          const item = await api(`reseaux/${id}`, { method:'GET' });
          $('#institutionPartenaireModifier').value = item.institution || '';
          $('#paysModifier').value = item.pays || '';
          $('#typeCollaborationModifier').value = item.type_collab || '';
          $('#nomCompletModifier').value = item.contact_nom || '';
          $('#emailModifier').value = item.contact_email || '';
          $('#dateDebutModifier').value = item.date_debut || '';
          $('#dateFinModifier').value = item.date_fin || '';
          $('#adresseModifier').value = item.adresse_org || '';
          $('#sitewebModifier').value = item.site_web || '';
          
          const yes = document.querySelector('input[name="conventionModifier"][value="oui"]');
          const no  = document.querySelector('input[name="conventionModifier"][value="non"]');
          (item.convention_signee ? yes : no).checked = true;

          if (item.projets_associes && item.projets_associes.length) {
            const selProj = document.getElementById('projetsAssociesModifier');
            if (selProj) {
              if (typeof item.projets_associes[0] === 'object' && item.projets_associes[0].id) {
                selProj.value = String(item.projets_associes[0].id);
              } else {
                selProj.value = String(item.projets_associes[0]);
              }
            }
          }

          const fileTextEl = document.getElementById('fileTextModifier');
          const linkEl = document.getElementById('pieceJointeModifierLink');
          const fileInput = document.getElementById('fileUploadModifier');
          if (fileInput) fileInput.value = '';

          if (item.piece_jointe_path) {
            const name = item.piece_jointe_path.split('/').pop();
            if (fileTextEl) fileTextEl.value = name || 'Fichier existant';
            if (linkEl) {
              linkEl.href = item.piece_jointe_path;
              linkEl.textContent = name;
              linkEl.style.display = 'inline-block';
            }
          } else {
            if (fileTextEl) fileTextEl.value = 'Aucun fichier choisi';
            if (linkEl) linkEl.style.display = 'none';
          }

          $('#modalModifier').dataset.id = id;
          $('#modalModifier').style.display = 'flex';
        } catch (err) {
          alert('Impossible de charger les données du réseau');
          console.error(err);
        }
      });
    });

    $$('#candidaturesTable .btn-supprimer').forEach(a=>{
      a.addEventListener('click', async e=>{
        e.preventDefault();
        const id = a.dataset.id;
        if (!confirm('Voulez-vous vraiment supprimer ce réseau ?')) return;
        try {
          await api(`reseaux/${id}`, { method:'DELETE' });
          a.closest('tr')?.remove();
          if (typeof window.refreshReseauxStats === 'function') {
            await window.refreshReseauxStats();
          }
        } catch (err) {
          alert('Suppression impossible');
          console.error(err);
        }
      });
    });
  }

  // --- Statistics ---
  let pieChart;
  async function loadCardsStats(year){
    try {
      const data = await api('reseaux/stats', { query:{ scope:'cards', year } });
      $('.left-stats .stat-box:nth-child(1) .value').textContent = data.nationaux ?? 0;
      $('.left-stats .stat-box:nth-child(2) .value').textContent = data.internationaux ?? 0;
    } catch(err) {
      console.error("Erreur stats cards:", err);
    }
  }

  async function loadPieChart(year){
    try {
      const rows = await api('reseaux/stats', { query:{ scope:'pie', year } });
      const labels = rows.map(r => r.pays);
      const dataValues = rows.map(r => r.n);
      const colors = ['#808066','#b1342f','#dabebe','#a6a485','#c9b037','#f28c28','#3b83bd'];
      const ctx = document.getElementById('pieChart').getContext('d');
      if (pieChart) pieChart.destroy();
      pieChart = new Chart(ctx, {
        type: 'pie',
        data: { labels, datasets: [{ data: dataValues, backgroundColor: colors.slice(0, labels.length) }] },
        options: { responsive: true, plugins: { legend: { display:false } } }
      });
      $('#chartLegend').innerHTML = labels.map((l,i)=>`
        <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px;">
          <span style="display:inline-block;width:14px;height:14px;border-radius:3px;background:${colors[i]}"></span>
          <span>${l} (${dataValues[i]})</span>
        </div>
      `).join('');
    } catch(err) {
      console.error("Erreur stats pie:", err);
    }
  }

  window.refreshReseauxStats = async (year) => {
    const y = year || $('.graph-select')?.value || "2025-2026";
    await Promise.all([ loadCardsStats(y), loadPieChart(y) ]);
  };

  // --- Main Execution & Event Listeners ---
  document.addEventListener('DOMContentLoaded', async ()=>{
    // Initial loads
    await Promise.all([
      loadPays({ lang: 'fr', actif: 1 }),
      loadProjects(),
      loadVisibleReseaux(),
      window.refreshReseauxStats()
    ]);

    // Graph year change listener
    $('.graph-select')?.addEventListener('change', e => window.refreshReseauxStats(e.target.value));
    
    // Save (Add) button
    $('#btnSaveObjectifs')?.addEventListener('click', async ()=>{
      try {
        const root = $('#popupContainerObjectifs');
        const payload = collectAddForm(root);
        validatePayload(payload);

        const fd = new FormData();
        Object.entries(payload).forEach(([k,v])=>{
          if (k === 'projets_associes') (v||[]).forEach(val => fd.append('projets_associes[]', val));
          else if (k === 'piece_jointe' && v) fd.append('piece_jointe', v);
          else fd.append(k, v ?? '');
        });

        await fetch(`${CFG.base}/${CFG.ns}/reseaux`, { method: 'POST', headers: { 'X-WP-Nonce': CFG.nonce }, body: fd, credentials: 'include' });
        
        $('#modalObjectifs').style.display = 'none';
        root.querySelector('form.popup-form')?.reset();
        await loadVisibleReseaux();
        await window.refreshReseauxStats();
      } catch (err) {
        alert((err && err.message) ? err.message : 'Erreur ajout');
        console.error(err);
      }
    });

    // Update button
    $('#btnUpdateObjectifs')?.addEventListener('click', async ()=>{
      const id = $('#modalModifier').dataset.id;
      if (!id) return;
      try {
        const fd = new FormData();
        fd.append('institution',   $('#institutionPartenaireModifier').value.trim());
        fd.append('pays',          $('#paysModifier').value);
        fd.append('type_collab',   $('#typeCollaborationModifier').value);
        fd.append('contact_nom',   $('#nomCompletModifier').value.trim());
        fd.append('contact_email', $('#emailModifier').value.trim());
        fd.append('date_debut',    $('#dateDebutModifier').value);
        fd.append('date_fin',      $('#dateFinModifier').value);
        fd.append("site_web" , $('#sitewebModifier').value.trim());
        fd.append("adresse_org" , $('#adresseModifier').value.trim());
        fd.append('convention_signee', $('input[name="conventionModifier"]:checked')?.value === 'oui' ? '1' : '0');
        
        const prj = $('#projetsAssociesModifier').value;
        if (prj && prj !== 'Sélection..') fd.append('projets_associes[]', prj);

        const fileInputEdit = document.getElementById('fileUploadModifier');
        if (fileInputEdit?.files?.[0]) fd.append('piece_jointe', fileInputEdit.files[0]);

        const url = `${CFG.base}/${CFG.ns}/reseaux/${id}`;
        await fetch(url, { method: 'POST', headers: { 'X-WP-Nonce': CFG.nonce, 'X-HTTP-Method-Override': 'PATCH' }, body: fd, credentials: 'include' });
        
        $('#modalModifier').style.display = 'none';
        $('#fileTextModifier').value = 'Aucun fichier choisi';
        await loadVisibleReseaux();
        await window.refreshReseauxStats();
      } catch (err) {
        alert('Mise à jour impossible');
        console.error(err);
      }
    });
  });
})();

/** Helper fetch WordPress (nonce + credentials) */
async function wpFetch(url, options = {}) {
  const headers = Object.assign(
    { 'Accept': 'application/json' },
    (PMSettings?.nonce ? { 'X-WP-Nonce': PMSettings.nonce } : {}),
    options.headers || {}
  );
  const res = await fetch(url, { ...options, headers, credentials: 'include' });
  if (!res.ok) {
    const txt = await res.text().catch(()=> '');
    throw new Error(`API ${res.status} – ${txt || res.statusText}`);
  }
  return res.json();
}

/** Remplit un <select> avec les pays */
function populateSelect(selectEl, items, placeholder = 'Sélection..', selected = null) {
  if (!selectEl) return;
  const keep = (selected ?? selectEl.value) || null;
  selectEl.innerHTML = '';
  const opt0 = document.createElement('option');
  opt0.value = '';
  opt0.textContent = placeholder;
  selectEl.appendChild(opt0);
  for (const it of items) {
    const opt = document.createElement('option');
    opt.value = it.libelle;
    opt.textContent = it.libelle;
    if (keep && (keep === it.code_iso2 || keep == it.id)) opt.selected = true;
    selectEl.appendChild(opt);
  }
}

