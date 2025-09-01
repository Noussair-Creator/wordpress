<?php 
// 1) Page WordPress “Réclamations” (slug: reclamations) :
$reclamations_url = '';
$page = get_page_by_path('reclamations');
if ($page) {
  $reclamations_url = get_permalink($page->ID);
}
// 2) Fallback vers un fichier :
if (!$reclamations_url) {
  $reclamations_url = trailingslashit( plugin_dir_url( dirname(__FILE__) ) ) . 'reclamations.php';
}
?>
<section id="suivi-rec">
  <style>
    #suivi-rec{ font-family:Roboto,system-ui,-apple-system,"Segoe UI",Arial,sans-serif; }
    #suivi-rec{
      --ink:#2A2916; --olive:#A6A485; --danger:#BF0404; --edge:#ECEBE3; --line:#EBE9D7;
      --ok:#0E962D; --ok-bg:rgba(14,150,45,.1);
      --warn:#9A7A01; --warn-bg:#FFF5D6; --warn-b:#F0DF9C;
      --ko:#B10202; --ko-bg:#FFE8E8; --ko-b:#F5B6B6;
    }

    /* ===== Carte ===== */
    #suivi-rec .sr-card{width:auto;min-height:462px;margin:0 auto;background:#fff;box-shadow:0 3px 22px #0000000F;border-radius:8px;padding:14px 16px 56px;position:relative}
    #suivi-rec .sr-head{display:flex;align-items:center;gap:10px;padding:6px 4px 10px}
    #suivi-rec .sr-ico{width:34px;height:25px;object-fit:contain;display:block}
    #suivi-rec .sr-title{margin:0;font:700 20px/26px Roboto;color:var(--ink)}
    #suivi-rec .sr-title-sep{border:0;border-top:1px solid var(--edge);width:100%;max-width:952px;margin:8px 0 12px}

    #suivi-rec .sr-toolbar{display:flex;align-items:center;gap:10px;margin:0 0 10px}
    #suivi-rec .sr-search{width:255px;height:35px;position:relative;background:#fff;border:1px solid #DBD9C3;border-radius:6px}
    #suivi-rec .sr-search input{width:100%;height:100%;border:0;outline:0;background:transparent;padding:0 36px 0 14px;font:400 14px/17px Roboto;color:var(--ink)}
    #suivi-rec .sr-search input::placeholder{color:#A6A59F;text-transform:capitalize}
    #suivi-rec .sr-search svg{position:absolute;right:10px;top:50%;transform:translateY(-50%);width:18px;height:18px}
    #suivi-rec .sr-btn-primary{width:178px;height:40px;border-radius:5px;border:none;background:#BF0404;color:#fff;font:700 13px/1 Roboto;cursor:pointer;text-decoration:none;display:inline-grid;place-items:center}
    #suivi-rec .sr-btn-square{width:38px;height:38px;border-radius:5px;border:none;background:#fff;box-shadow:0 0 6px #00000030;display:grid;place-items:center;cursor:pointer}

    /* ======= TABLES SÉPARÉES : head + body ======= */
    #suivi-rec .sr-table-wrap{ margin-top:6px; }
    #suivi-rec .sr-table-head,
    #suivi-rec .sr-table-body{ width:100%; border-collapse:separate; border-spacing:0; table-layout:fixed; font-size:14px; color:var(--ink); }

    /* Colgroup identique (total ~100%) */
    #suivi-rec col.c1{width:4%}   /* checkbox */
    #suivi-rec col.c2{width:16%}  /* ref */
    #suivi-rec col.c3{width:20%}  /* type */
    #suivi-rec col.c4{width:30%}  /* sujet */
    #suivi-rec col.c5{width:10%}  /* date */
    #suivi-rec col.c6{width:12%}  /* statut */
    #suivi-rec col.c7{width:8%}   /* actions */

    /* En-tête indépendant (barre grise arrondie) */
    #suivi-rec .head-box{
      background:#ECEBE3; border:1px solid #A6A4853D; border-radius:8px; overflow:hidden;
    }
    #suivi-rec .sr-table-head thead th{
      background:transparent; padding:10px 10px; text-align:left; font:700 15px/20px Roboto; color:var(--ink);
    }
    #suivi-rec .sr-table-head thead th + th{ border-left:1px solid #E6E4D8; }
    #suivi-rec .sr-table-head thead th:first-child{ text-align:center; }
    #suivi-rec .sr-table-head thead th:last-child{ text-align:right; padding-right:12px; }

    /* Corps séparé (cadre blanc) */
    #suivi-rec .body-box{
      border:2px solid var(--line); border-radius:8px; overflow:hidden; background:#fff; margin-top:10px;
    }
    #suivi-rec .sr-table-body tbody td{
      padding:10px 10px; vertical-align:middle; background:#fff; border-top:1px solid var(--edge);
    }
    #suivi-rec .sr-table-body tbody tr:first-child td{ border-top:none; }
    #suivi-rec .sr-table-body tbody td + td{ border-left:1px solid var(--edge); }
    #suivi-rec .sr-table-head thead th + th{ border-left:1px solid var(--edge); }

    /* Liens ref */
    #suivi-rec td.ref a{color:#2A2916;text-decoration:none}
    #suivi-rec td.ref a.active{color:#08449D;text-decoration:underline}

    /* Badges statut */
    #suivi-rec .sr-badge{display:inline-flex;align-items:center;gap:6px;padding:4px 10px;border-radius:999px;font:700 12px/14px Roboto}
    #suivi-rec .sr-b-ok{background:var(--ok-bg);color:var(--ok);border:1px solid var(--ok);border-radius:15px;height:25px;min-width:97px;padding-left:26px;position:relative}
    #suivi-rec .sr-b-ok::before{content:"";position:absolute;left:8px;top:50%;transform:translateY(-50%);width:14px;height:14px;
      background:url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="%230E962D" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>') center/14px 14px no-repeat;}
    #suivi-rec .sr-b-w{background:var(--warn-bg);color:var(--warn);border:1px solid var(--warn-b)}
    #suivi-rec .sr-b-ko{background:var(--ko-bg);color:var(--ko);border:1px solid var(--ko-b)}

    /* Actions (⋯) + Popover style capture */
    #suivi-rec .sr-actions{ position:relative; text-align:center; white-space:nowrap; }
    #suivi-rec .sr-dots{
      width:28px;height:28px;border-radius:6px;background:transparent;border:1px solid transparent;cursor:pointer; font-size:22px; line-height:26px;
    }
    #suivi-rec .sr-dots:hover{ background:#f7f6f1; border-color:#e8e3cf; }

    #suivi-rec .sr-menu{
      position:absolute; top:30px; right:0;
      background:#fff; border:1px solid #E6E4D8; border-radius:10px;
      box-shadow:0 8px 24px rgba(0,0,0,.12);
      display:none; min-width:180px; padding:6px; z-index:10;
    }
    #suivi-rec .sr-menu a{
      display:flex; align-items:center; gap:10px;
      padding:8px 10px; border-radius:8px; text-decoration:none;
      color:#2A2916; font:500 13px/1.2 Roboto;
    }
    #suivi-rec .sr-menu a:hover{ background:#F7F6F2; }
    #suivi-rec .sr-menu .ico{
      width:18px; height:18px; display:inline-block; flex:0 0 18px;
      background-size:18px 18px; background-repeat:no-repeat; background-position:center;
      filter: none;
    }
    /* Icône document */
    #suivi-rec .ico-doc{
      background-image:url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="%232A2916" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v10.5A1.5 1.5 0 0 0 5.5 16H14a2 2 0 0 0 2-2V6z"/><path d="M14 2v4h4"/></svg>');
    }
    /* Icône mail */
    #suivi-rec .ico-mail{
      background-image:url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" stroke="%232A2916" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><path d="m22 6-10 7L2 6"/></svg>');
    }

    /* Pagination */
    #suivi-rec .sr-pager{
      position:absolute; right:16px; bottom:12px;
      width:auto; height:27px; display:flex; align-items:center; gap:12px;
    }
    #suivi-rec .sr-btn{
      width:27px; height:27px; border:2px solid var(--danger); border-radius:3px; background:#fff;
      display:inline-flex; align-items:center; justify-content:center; cursor:pointer; box-sizing:border-box;
      font-weight:700; color:#BF0404; line-height:1; font-size:22px; padding:0;
    }
    #suivi-rec .sr-num{ min-width:20px; text-align:center; font-family:'Signika', system-ui, sans-serif; font-size:14px; color:#010103; }

    /* ====== Sidebar ====== */
    #suivi-rec .sr-overlay{position:fixed;inset:0;background:rgba(0,0,0,.35);opacity:0;pointer-events:none;transition:.2s;z-index:9998}
    #suivi-rec .sr-overlay.open{opacity:1;pointer-events:auto}
    #suivi-rec .sr-sidebar{ position:fixed; top:0; right:0; width:450px; height:100vh;
      background:#FFFFFF; box-shadow:-7px 0px 36px #00000029; transform:translateX(110%); transition:.25s; z-index:9999;
      display:flex; flex-direction:column; border-radius:0; }
    #suivi-rec .sr-sidebar.open{ transform:translateX(0) }
    #suivi-rec .sr-sb-head{
      height:60px; background:#FFFFFF; box-shadow:0px 5px 16px #00000029; display:flex; align-items:center; justify-content:space-between; padding:10px 12px;
    }
    #suivi-rec .sr-sb-title{ font:700 18px/24px Roboto; color:#2A2916; }
    #suivi-rec .sr-sb-close{
      width:40px; height:40px; border:none; border-radius:5px; cursor:pointer;
      background:#BF0404 url('/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-close.png') center/14px 14px no-repeat;
    }
    #suivi-rec .sr-sb-body{ padding:16px 18px; overflow:auto; flex:1; }
    #suivi-rec .sr-sb-h2{ font:700 15px/20px Roboto; color:#2A2916; margin:14px 0 10px; }
    #suivi-rec .sr-hr{ border:0; border-top:1px solid #ECEBE3; width:390px; margin:14px auto; }
    #suivi-rec .sr-kv{ display:grid; grid-template-columns:130px 1fr; gap:6px 10px; margin:0 0 6px; }
    #suivi-rec .sr-k{ font:700 14px/19px Roboto; color:#6E6D55; }
    #suivi-rec .sr-v{ font:400 14px/17px Roboto; color:#2A2916; }
    #suivi-rec .sr-kv.response .sr-v{ grid-column:1 / -1; margin-top:6px; }
    #suivi-rec .sr-meta{ margin-top:24px; }
    #suivi-rec .sr-meta .sr-kv + .sr-kv{ margin-top:18px; }

    /* ===== Responsive léger ===== */
    @media (max-width: 980px){
      #suivi-rec col.c3{width:18%}
      #suivi-rec col.c4{width:34%}
    }
  </style>

  <div class="sr-card">
    <div class="sr-head">
      <img class="sr-ico" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/entrevue.png" alt="">
      <h2 class="sr-title">Suivi des réclamations</h2>
    </div>
    <hr class="sr-title-sep">

    <div class="sr-toolbar">
      <label class="sr-search">
        <input id="sr-q" type="text" placeholder="Recherche">
        <svg viewBox="0 0 24 24" fill="none"><path d="M21 21l-4.3-4.3M10.5 18a7.5 7.5 0 1 1 0-15 7.5 7.5 0 0 1 0 15Z" stroke="#2a2a2a" stroke-width="2" stroke-linecap="round"/></svg>
      </label>

      <div style="margin-left:auto;display:flex;gap:10px">
        <a class="sr-btn-primary" href="<?php echo esc_url($reclamations_url); ?>" target="_self">
          Envoyer une réclamation
        </a>
        <button class="sr-btn-square" type="button" title="Enregistrer / Export">
          <img src="/wp-content/plugins/plateforme-master/images/icon etudiant/upload-red.png" alt="Upload" style="width:18px;height:18px;">
        </button>
      </div>
    </div>

    <!-- ===== HEAD SEPARE ===== -->
    <div class="sr-table-wrap head-box">
      <table class="sr-table-head" aria-hidden="true">
        <colgroup>
          <col class="c1"><col class="c2"><col class="c3"><col class="c4"><col class="c5"><col class="c6"><col class="c7">
        </colgroup>
        <thead>
          <tr>
            <th scope="col" style="text-align:center"><input type="checkbox" id="sr-ckall"></th>
            <th scope="col">Reference</th>
            <th scope="col">Type</th>
            <th scope="col">Sujet</th>
            <th scope="col">Date</th>
            <th scope="col">Statut</th>
            <th scope="col" style="text-align:right">Actions</th>
          </tr>
        </thead>
      </table>
    </div>

    <!-- ===== BODY SEPARE ===== -->
    <div class="sr-table-wrap body-box">
      <table class="sr-table-body" id="sr-table" aria-describedby="liste réclamations">
        <colgroup>
          <col class="c1"><col class="c2"><col class="c3"><col class="c4"><col class="c5"><col class="c6"><col class="c7">
        </colgroup>
        <tbody id="sr-tbody"><!-- lignes injectées en JS --></tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="sr-pager">
      <button class="sr-btn" title="Première page">&laquo;</button>
      <button class="sr-btn" title="Précédent">&lsaquo;</button>
      <span class="sr-num">2</span>
      <button class="sr-btn" title="Suivant">&rsaquo;</button>
      <button class="sr-btn" title="Dernière page">&raquo;</button>
    </div>
  </div>

  <!-- ===== Sidebar ===== -->
  <div class="sr-overlay" id="sr-ov"></div>
  <aside class="sr-sidebar" id="sr-sb">
    <div class="sr-sb-head">
      <div class="sr-sb-title" id="sr-sb-title">Reclamation #Rec-2025-001</div>
      <button type="button" class="sr-sb-close" id="sr-sb-close" aria-label="Fermer"></button>
    </div>
    <div class="sr-sb-body" id="sr-sb-body"><!-- rempli en JS --></div>
  </aside>

  <script>
  (function(){
    const root   = document.getElementById('suivi-rec');
    const q      = root.querySelector('#sr-q');
    const tbody  = root.querySelector('#sr-tbody');
    const ov     = root.querySelector('#sr-ov');
    const sb     = root.querySelector('#sr-sb');
    const sbBody = root.querySelector('#sr-sb-body');
    const sbTitle= root.querySelector('#sr-sb-title');

    const LIST_API = "<?php echo esc_url( rest_url('plateforme/v1/reclamations') ); ?>";
    const NONCE    = "<?php echo esc_attr( wp_create_nonce('wp_rest') ); ?>";

    const badge = s => s==='ok'
      ? '<span class="sr-badge sr-b-ok">Acceptée</span>'
      : s==='ko'
        ? '<span class="sr-badge sr-b-ko">Refusée</span>'
        : '<span class="sr-badge sr-b-w">En cours</span>';

    function row(d,i){
      return `
        <tr data-i="${i}">
          <td style="text-align:center"><input type="checkbox"></td>
          <td class="ref"><a href="#" class="sr-ref" data-i="${i}">${d.ref||'—'}</a></td>
          <td>${d.type || '—'}</td>
          <td>${d.sujet || '—'}</td>
          <td>${d.date || '—'}</td>
          <td>${badge(d.statut)}</td>
          <td class="sr-actions">
            <button class="sr-dots" type="button" aria-haspopup="true" aria-expanded="false" title="Actions">⋯</button>
            <div class="sr-menu" role="menu">
              <a href="#" data-act="view" data-i="${i}">
                <span class="ico ico-doc"></span> Lire la réponse
              </a>
              <a href="#" data-act="mail" data-i="${i}">
                <span class="ico ico-mail"></span> E-mail
              </a>
            </div>
          </td>
        </tr>`;
    }

    function draw(list){ tbody.innerHTML = list.map(row).join(''); bind(); }

    let CURRENT = [];
    let PAGE = 1, PER = 10;

    async function load({search='', page=1} = {}){
      PAGE = page;
      const url = new URL(LIST_API);
      url.searchParams.set('page', page);
      url.searchParams.set('per_page', PER);
      if (search) url.searchParams.set('search', search);

      const res = await fetch(url.toString(), {
        headers: { 'X-WP-Nonce': NONCE },
        credentials: 'same-origin'
      });
      const json = await res.json().catch(()=>({data:[],pagination:{}}));
      CURRENT = json.data || [];
      draw(CURRENT);
    }

    function openDetails(i){
      const d = CURRENT[i]; if(!d) return;
      sbTitle.textContent = `Reclamation ${d.ref || ''}`;

      const pj = d?.pj?.url
        ? `<a href="${d.pj.url}" target="_blank" rel="noopener">${d.pj.name||'Pièce jointe'}</a>`
        : (d?.pj?.name || '—');

      sbBody.innerHTML = `
        <div class="sr-sb-h2">Details de la reclamation :</div>
        <div class="sr-kv"><div class="sr-k">Type :</div><div class="sr-v">${d.type||'—'}</div></div>
        <div class="sr-kv"><div class="sr-k">Sujet :</div><div class="sr-v">${d.sujet||'—'}</div></div>
        <div class="sr-kv"><div class="sr-k">Date d’envoi :</div><div class="sr-v">${d.date||'—'}</div></div>
        <div class="sr-kv"><div class="sr-k">Statut :</div><div class="sr-v">${badge(d.statut)}</div></div>
        <div class="sr-kv"><div class="sr-k">pièce jointe :</div><div class="sr-v">${pj}</div></div>

        <hr class="sr-hr">

        <div class="sr-sb-h2">Réponse de l’administration :</div>
        <div class="sr-kv response">
          <div class="sr-k">Réponse :</div>
          <div class="sr-v"><p>${d.reponse || '—'}</p></div>
        </div>

        <div class="sr-meta">
          <div class="sr-kv">
            <div class="sr-k">Date de la réponse :</div>
            <div class="sr-v">${d.date_rep || '—'}</div>
          </div>
          <div class="sr-kv">
            <div class="sr-k">Répondant(e) :</div>
            <div class="sr-v">${d.repondant || '—'}</div>
          </div>
        </div>
      `;
      sb.classList.add('open'); ov.classList.add('open');
    }

    function bind(){
      // clic sur référence
      root.querySelectorAll('.sr-ref').forEach(a=>{
        a.addEventListener('click',e=>{
          e.preventDefault();
          root.querySelectorAll('.sr-ref').forEach(x=>x.classList.remove('active'));
          a.classList.add('active');
          openDetails(Number(a.dataset.i));
        });
      });

      // menu actions
      root.querySelectorAll('.sr-dots').forEach(btn=>{
        btn.addEventListener('click',e=>{
          const menu = btn.nextElementSibling;
          // Fermer les autres
          root.querySelectorAll('.sr-menu').forEach(m=>{ if(m!==menu) m.style.display='none'; });
          const open = menu.style.display==='block';
          menu.style.display = open ? 'none' : 'block';
          btn.setAttribute('aria-expanded', String(!open));
          e.stopPropagation();
        });
      });

      // cliquer en dehors ferme le menu
// Ferme si on clique ailleurs que sur le menu ou le bouton ⋯
document.addEventListener('click', (e)=>{
  if (e.target.closest('#suivi-rec .sr-menu') || e.target.closest('#suivi-rec .sr-dots')) return;
  closeAllMenus();
});

// Ferme avec la touche Échap
document.addEventListener('keydown', (e)=>{
  if (e.key === 'Escape') closeAllMenus();
});

      // actions du menu
      root.querySelectorAll('.sr-menu a').forEach(a=>{
        a.addEventListener('click',e=>{
          e.preventDefault();
          const i = Number(a.dataset.i);
          if(a.dataset.act==='view'){ openDetails(i); }
        });
      });
    }
function closeAllMenus(){
  root.querySelectorAll('.sr-menu').forEach(m=> m.style.display='none');
  root.querySelectorAll('.sr-dots[aria-expanded="true"]').forEach(b=> b.setAttribute('aria-expanded','false'));
}

    // Recherche côté serveur
    q.addEventListener('input', ()=> load({search: q.value.trim(), page: 1}));

    // Fermer le panneau
    root.querySelector('#sr-sb-close').addEventListener('click',()=>{ sb.classList.remove('open'); ov.classList.remove('open'); });
    ov.addEventListener('click',()=>{ sb.classList.remove('open'); ov.classList.remove('open'); });

    // Chargement initial
    load();
  })();
  </script>
</section>
