<?php if (!defined('ABSPATH')) exit;
/**
 * Page: Détails Publication (Front, 1 card par bloc)
 * - Bloc 1 = Émetteur ; Blocs suivants = Récepteurs (parts)
 * - Une seule card qui contient : Informations générales + Documents associés + Commentaires
 * - Affiche Type, DOI (sous Titre), Mots-clés (sous Date), Nb pages (sous Statut)
 * - Dans le 1er bloc, ces champs s’affichent même vides
 * - Auteurs = émetteur d’abord, puis récepteurs, avec noms/avatars
 * - Actions (Valider / Rejeter / Publier) visibles pour les directeurs sur le 1er bloc
 */

$current_user = wp_get_current_user();
$roles = is_user_logged_in() ? (array)$current_user->roles : array();
?>
<!-- Fonts / Icons -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

<style>
  :root{
    --ink:#2A2916; --line:#EBE9D7; --muted:#6E6D55; --chip:#E9E7D7; --chip-active:#A6A485;
    --danger:#D71920; --success:#198754; --warning:#d89e00;
  }
  body{background:#f8f9fa; font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif}

  .pub-block{margin:20px 0}
  .card{background:#fff;padding:22px 24px;border-radius:12px;box-shadow:0 2px 12px rgba(0,0,0,.06)}
  .card h2{font-size:1.25rem;margin:0 0 10px;color:#333}
  .meta-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:6px}
  .meta-row .actions .btn{border:1px solid #d8d4b7}

  .section-title{font-size:1.05rem;color:#333;margin:18px 0 10px;font-weight:700}
  .divider{height:1px;background:#eee;margin:16px 0}

  .info-list{list-style:none;margin:0;padding:0}
  .info-item{display:flex;flex-wrap:wrap;border-bottom:1px solid #eee;padding:10px 0}
  .info-item:last-child{border-bottom:none}
  .info-label{width:260px;flex-shrink:0;font-weight:600;color:#555}
  .info-value{flex:1;min-width:240px;color:#212529}

  .badge{display:inline-flex;align-items:center;gap:6px;padding:4px 12px;font-size:13px;font-weight:700;border-radius:20px}
  .badge-success{ color:#198754; background:#e6f7ee }
  .badge-danger{  color:#D71920; background:#fff0f0 }
  .badge-warning{ color:var(--warning); background:#fff9e6 }
  .badge-info{    color:#fff; background:#808066 }

  .user-pill{display:inline-flex;align-items:center;gap:8px;background:#f7f7f7;border:1px solid #eee;border-radius:999px;padding:4px 10px;margin:2px 8px 2px 0}
  .user-pill img{width:24px;height:24px;border-radius:50%}

  .docs-table{width:100%;border-collapse:separate;border-spacing:0;border-radius:10px;box-shadow:0 0 0 1px #ddd;background:#fff}
  .docs-table thead{background:#f3f1e9}
  .docs-table th,.docs-table td{padding:12px 14px;text-align:left;border-bottom:1px solid #eee; text-align: center;}
  .docs-table tr:last-child td{border-bottom:none}
  .col-ref{width:100px;text-align:center;color:#35342b}
  .col-action{width:120px;text-align:center}
  .dl-icon{width:20px;display:inline-block}

  .comment-text{color:#555;font-size:.95rem;line-height:1.6;white-space:normal}

  @media (max-width:768px){
    .info-label{width:100%;margin-bottom:6px}
    .info-value{width:100%}
  }
</style>

<div id="pubDetailsRoot"></div>

<?php if (is_user_logged_in()): ?>
<script>
  window.pmsettings = {
    rest_root: <?php echo json_encode(esc_url_raw(rest_url())); ?>,
    nonce:     <?php echo json_encode(wp_create_nonce('wp_rest')); ?>
  };
  window.pmuser = {
    id:    <?php echo (int) get_current_user_id(); ?>,
    roles: <?php echo json_encode($roles); ?>
  };
</script>
<?php endif; ?>

<script>
(function(){
  /* ===== REST/CONST ===== */
  const ROOT   = (window.pmsettings?.rest_root) || (window.wpApiSettings?.root) || '/wp-json/';
  const NONCE  = (window.pmsettings?.nonce)     || (window.wpApiSettings?.nonce) || '';
  const API    = ROOT.replace(/\/$/, '') + '/plateforme-recherche/v1';
  const pubId  = new URLSearchParams(location.search).get('id');

  const root = document.getElementById('pubDetailsRoot');

  /* ===== Helpers ===== */
  const isDirector = () => {
    const R = (window.pmuser?.roles||[]).map(r=>String(r).toLowerCase());
    return R.includes('um_directeur_laboratoire') || R.includes('directeur_laboratoire') || R.includes('directeur-laboratoire');
  };
  function esc(s){return String(s??'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');}
  function fmtDate(iso){
    if(!iso) return '—';
    const m=String(iso).match(/^(\d{4})-(\d{2})-(\d{2})/);
    return m?`${m[3]}/${m[2]}/${m[1]}`:esc(iso);
  }
  function badge(st){
    const map={
      'Validée':{c:'badge-success',i:'fa-circle-check'},
      'Rejetée':{c:'badge-danger', i:'fa-circle-stop'},
      'Publiée':{c:'badge-info',   i:'fa-circle-check'},
      'En attente':{c:'badge-warning',i:'fa-clock'}
    };
    const m=map[st]||map['En attente'];
    return `<span class="badge ${m.c}"><i class="fa-regular ${m.i}"></i>${esc(st)}</span>`;
  }
  async function fetchJSON(url,opt={}){
    const res = await fetch(url,{credentials:'same-origin',headers:{'Accept':'application/json','X-WP-Nonce':NONCE},...opt});
    if(!res.ok) throw new Error('HTTP '+res.status);
    return res.json();
  }
  function filenameFromURL(u){
    try{ const p=new URL(u); return decodeURIComponent((p.pathname.split('/').pop()||'').replace(/\+/g,' '))||'fichier'; }
    catch(_){ return (u||'').split('/').pop()||'fichier'; }
  }
  function md5(str){function L(k,d){return(k<<d)|(k>>>(32-d))}function K(G,k){var I,J,H;return(I=(G&2147483648))|(J=(k&2147483648)),(H=(G&1073741824))|(k&1073741824)?(G&1073741823)+(k&1073741823)^2147483648^I^J:(G&1073741823)+(k&1073741823)^I^J}function r(d,k,G){return(d&k)|((~d)&G)}function q(d,k,G){return(d&G)|(k&(~G))}function p(d,k,G){return d^k^G}function n(d,k,G){return k^(d|(~G))}function u(F,E,D,C,d,k,G){return K(L(K(K(E,F),K(C,G)),d),k)}function f(E,D,C,d,k,G,H){return u((E&D)|((~E)&C),E,D,k,G,H,d)}function b(E,D,C,d,k,G,H){return u((E&C)|(D&(~C)),E,D,k,G,H,d)}function v(E,D,C,d,k,G,H){return u(E^D^C,E,D,k,G,H,d)}function w(E,D,C,d,k,G,H){return u(D^(E|(~C)),E,D,k,G,H,d)}function x(G){var C,D=G.length,E=D+8,F=(E-(E%64))/64,G2=(F+1)*16,H=Array(G2-1),i=0;for(;i<D;)C=(i-(i%4))/4,H[C]|=G.charCodeAt(i)<<((i%4)*8),i++;return H[(i-(i%4))/4]|=128<<((i%4)*8),H[G2-2]=D*8,H[G2-1]=D>>>29,H}var y=1732584193,z=4023233417,A=2562383102,B=271733878;var H=x(unescape(encodeURIComponent(str)));for(var i=0;i<H.length;i+=16){var E=y,D1=z,C1=A,D2=B;y=f(y,z,A,B,H[i+0],7,3614090360),B=f(B,y,z,A,H[i+1],12,3905402710),A=f(A,B,y,z,H[i+2],17,606105819),z=f(z,A,B,y,H[i+3],22,3250441966),y=f(y,z,A,B,H[i+4],7,4118548399),B=f(B,y,z,A,H[i+5],12,1200080426),A=f(A,B,y,z,H[i+6],17,2821735955),z=f(z,A,B,y,H[i+7],22,4249261313),y=f(y,z,A,B,H[i+8],7,1770035416),B=f(B,y,z,A,H[i+9],12,2336552879),A=f(A,B,y,z,H[i+10],17,4294925233),z=f(z,A,B,y,H[i+11],22,2304563134),y=f(y,z,A,B,H[i+12],7,1804603682),B=f(B,y,z,A,H[i+13],12,4254626195),A=f(A,B,y,z,H[i+14],17,2792965006),z=f(z,A,B,y,H[i+15],22,1236535329),y=b(y,z,A,B,H[i+1],5,4129170786),B=b(B,y,z,A,H[i+6],9,3225465664),A=b(A,B,y,z,H[i+11],14,643717713),z=b(z,A,B,y,H[i+0],20,38016083),y=b(y,z,A,B,H[i+5],5,-165796510),B=b(B,y,z,A,H[i+10],9,-1069501632),A=b(A,B,y,z,H[i+15],14,643717713),z=b(z,A,B,y,H[i+4],20,-373897302),y=v(y,z,A,B,H[i+5],4,-378558),B=v(B,y,z,A,H[i+8],11,-2022574463),A=v(A,B,y,z,H[i+11],16,1839030562),z=v(z,A,B,y,H[i+14],23,-35309556),y=v(y,z,A,B,H[i+1],4,-1530992060),B=v(B,y,z,A,H[i+10],11,1272893353),A=v(A,B,y,z,H[i+15],16,-155497632),z=v(z,A,B,y,H[i+4],23,-1094730640),y=w(y,z,A,B,H[i+2],6,2734768916),B=w(B,y,z,A,H[i+9],10,-343485551),A=w(A,B,y,z,H[i+14],15,-51403784),z=w(z,A,B,y,H[i+3],21,286898874),y=w(y,z,A,B,H[i+1],6,-145523070),B=w(B,y,z,A,H[i+8],10,-1120210379),A=w(A,B,y,z,H[i+11],15,718787259),z=w(z,A,B,y,H[i+14],21,-343485551),y=K(y,E),z=K(z,D1),A=K(A,C1),B=K(B,D2);}return (y>>>0).toString(16).padStart(8,'0')+(z>>>0).toString(16).padStart(8,'0')+(A>>>0).toString(16).padStart(8,'0')+(B>>>0).toString(16).padStart(8,'0')}
  function gravatar(email){ const e=(email||'').trim().toLowerCase(); if(!e) return 'https://www.gravatar.com/avatar/?d=identicon&s=96'; return `https://www.gravatar.com/avatar/${md5(e)}?s=96&d=identicon`; }

  // tente de récupérer name + avatar depuis WP REST users, sinon null
  async function fetchUserBrief(userId){
    try{
      const u = await fetchJSON(`${ROOT.replace(/\/$/,'')}/wp/v2/users/${userId}`);
      const name = u?.name || '';
      const avatar = (u?.avatar_urls && (u.avatar_urls['96']||u.avatar_urls['48'])) || '';
      const email = u?.email || '';
      return {name, avatar, email};
    }catch(_){ return null; }
  }

  // extrait nom/email depuis le label "Display <email>"
  function parseLabel(label, fallbackId){
    const email = (String(label||'').match(/<([^>]+)>/)||[])[1] || '';
    const name  = String(label||'').replace(/\s*<[^>]+>\s*/,'').trim() || (fallbackId ? `User #${fallbackId}` : '');
    return {name, email};
  }

  function infoRow(label, valueHTML){
    return `<li class="info-item"><span class="info-label">${esc(label)} :</span><span class="info-value">${valueHTML||'—'}</span></li>`;
  }
  function renderFilesTable(files){
    if(!files || !files.length){
      return `<table class="docs-table"><thead><tr><th class="col-ref">Ref_Doc</th><th>Fichier</th><th class="col-action">Télécharger</th></tr></thead><tbody><tr><td colspan="3" style="text-align:center;color:#777">Aucun fichier disponible</td></tr></tbody></table>`;
    }
    const rows = files.map((f,i)=>{
      const url=(f.storage_path||'').trim();
      const name=(f.original_name||'').trim() || filenameFromURL(url);
      const ref=String(i+1).padStart(3,'0');
      return `<tr>
        <td class="col-ref">${ref}</td>
        <td>${esc(name)}</td>
        <td class="col-action">
          <a href="${esc(url)}" target="_blank" rel="noopener" aria-label="Télécharger ${esc(name)}">
            <img class="dl-icon" src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png" alt="download">
          </a>
        </td>
      </tr>`;
    }).join('');
    return `<table class="docs-table">
      <thead><tr><th class="col-ref">Ref_Doc</th><th>Fichier</th><th class="col-action">Télécharger</th></tr></thead>
      <tbody>${rows}</tbody>
    </table>`;
  }

  function renderAuthorsPills(authors){
    return authors.map(a=>`<span class="user-pill"><img src="${esc(a.avatar||'https://www.gravatar.com/avatar/?d=identicon&s=96')}" alt=""><span>${esc(a.name)}</span></span>`).join(' ');
  }

  function buildCardHTML(title, infoHTML, authorsHTML, docsHTML, commentHTML, withActions){
    return `
      <div class="card">
        <div class="meta-row">
          <h2>${esc(title)}</h2>
          ${withActions && isDirector() ? `
            <div class="actions dropdown">
              <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Actions
              </button>
              <ul class="dropdown-menu">
                <li><button class="dropdown-item" type="button" data-action="validate">Valider</button></li>
                <li><button class="dropdown-item" type="button" data-action="reject">Rejeter</button></li>
                <li><button class="dropdown-item" type="button" data-action="publish">Publier</button></li>
              </ul>
            </div>
          `:''}
        </div>

        <div>
          <div class="section-title">Informations générales</div>
          <ul class="info-list">${infoHTML}</ul>
          <div style="margin-top:8px"><strong>Auteur(s) :</strong> <span>${authorsHTML||'—'}</span></div>
        </div>

        <div class="divider"></div>

        <div>
          <div class="section-title">Documents associés</div>
          ${docsHTML}
        </div>

        <div class="divider"></div>

        <div>
          <div class="section-title">Commentaires du chercheur</div>
          <p class="comment-text">${commentHTML||'—'}</p>
        </div>
      </div>
    `;
  }

  // met à jour le badge "Statut actuel" dans toutes les cards
  function updateLocalStatus(newStatus){
    root.querySelectorAll('.info-item').forEach(li=>{
      const lab = li.querySelector('.info-label'); if(!lab) return;
      if (lab.textContent.trim().toLowerCase().startsWith('statut actuel')){
        const val = li.querySelector('.info-value');
        if (val) val.innerHTML = badge(newStatus);
      }
    });
  }

  /* ===== Load ===== */
  async function load(){
    if(!pubId){ root.innerHTML = '<div class="card"><p>ID manquant</p></div>'; return; }

    // 1) Publication (base)
    const pub = await fetchJSON(`${API}/publication/${pubId}`);

    // 2) Shares
    let shares = [];
    try{ shares = await fetchJSON(`${API}/publication/${pubId}/shares`); }catch(_){}

    // fallback : /my-share (quand /shares est vide)
    if (!shares || shares.length===0){
      try{
        const ms = await fetchJSON(`${API}/publication/${pubId}/my-share`);
        if (ms && ms.my_share){
          shares = [{
            share_id: Number(ms.my_share.id),
            user_id: Number(ms.my_share.user_id),
            label: '', // on remplira via /wp/v2/users
            nb_pages: ms.my_share.nb_pages || null,
            resume: ms.my_share.resume || '',
            commentaire: ms.my_share.commentaire || '',
            summary_en: ms.my_share.summary_en || '',
            date_publication: ms.my_share.date_publication || null,
            fichier_url: ms.my_share.fichier_url || null,
            keywords: ms.my_share.keywords || [],
            files: ms.my_share.files || []
          }];
        }
      }catch(_){}
    }

    /* ===== AUTEURS ===== */
    // Émetteur
    const emitterUserId = Number(pub.chercheur_id || pub.created_by || 0);
    let emitterBrief = null;
    if (emitterUserId) emitterBrief = await fetchUserBrief(emitterUserId);
    const emitterAuthor = {
      name: emitterBrief?.name || pub.auteur_display_name || `User #${emitterUserId||''}`,
      avatar: emitterBrief?.avatar || 'https://www.gravatar.com/avatar/?d=identicon&s=96'
    };

    // Récepteurs
    const receiverAuthors = [];
    for (const s of (shares||[])){
      let name='', email='', avatar='';
      if (s.label && s.label.includes('<')){
        const p = parseLabel(s.label, s.user_id);
        name = p.name; email = p.email;
        avatar = email ? gravatar(email) : '';
      }
      if (!name || !avatar){
        const b = await fetchUserBrief(Number(s.user_id));
        if (b){
          if (!name)   name   = b.name || name;
          if (!avatar) avatar = b.avatar || avatar;
          if (!email)  email  = b.email || email;
        }
      }
      receiverAuthors.push({
        name: name || `User #${s.user_id}`,
        avatar: avatar || (email ? gravatar(email) : 'https://www.gravatar.com/avatar/?d=identicon&s=96')
      });
    }

    // auteurs = émetteur d’abord, puis récepteurs
    const authorsHTML_all = renderAuthorsPills([emitterAuthor, ...receiverAuthors]);

    /* ===== Mots-clés agrégés (base + parts) ===== */
    const kw = new Set();
    (pub.base_keywords||[]).forEach(k=>{ if(k) kw.add(String(k)); });
    (shares||[]).forEach(s=> (s.keywords||[]).forEach(k=>{ if(k) kw.add(String(k)); }));
    const keywordsHTML_all = (kw.size>0) ? esc(Array.from(kw).join(', ')) : '—';

    /* ===== Bloc 1 : ÉMETTEUR ===== */
    let info1 = '';
    info1 += infoRow('Titre complet', esc(pub.titre||'—'));
    info1 += infoRow('Type de publication', esc(pub.type||'—'));
    // DOI doit apparaître même si vide (bloc 1)
    info1 += infoRow('DOI', esc(pub.doi||''));
    info1 += infoRow('Date de soumission', fmtDate(pub.date_publication));
    info1 += infoRow('Mots-clés', keywordsHTML_all);
    info1 += infoRow('Statut actuel', badge(pub.statut||'En attente'));
    // Nb pages doit apparaître même si vide (bloc 1)
    info1 += infoRow('Nombre des pages', esc(pub.nb_pages ?? ''));
    if (pub.maison_edition_scientifique) {
      info1 += infoRow("Maison d'édition scientifique", esc(pub.maison_edition_scientifique));
    }
    if (pub.resume) {
      info1 += infoRow('Résumé (Abstract)', esc(pub.resume).replace(/\n/g,'<br>'));
    }

    const docs1 = renderFilesTable(pub.base_files||[]);
    const comment1 = esc(pub.commentaire??'').replace(/\n/g,'<br>');
    const block1HTML = buildCardHTML('', info1, authorsHTML_all, docs1, comment1, true);

    const wrap1 = document.createElement('section');
    wrap1.className = 'pub-block';
    wrap1.innerHTML = block1HTML;
    root.appendChild(wrap1);

    /* ===== Blocs RÉCEPTEURS ===== */
    for (const s of (shares||[])){
      let infoR = '';
      infoR += infoRow('Titre complet', esc(pub.titre||'—'));
      infoR += infoRow('Type de publication', esc(pub.type||'—'));
      // Pour récepteur : DOI affiché aussi pour cohérence
      infoR += infoRow('DOI', esc(pub.doi||''));
      infoR += infoRow('Date de soumission', fmtDate(s.date_publication || pub.date_publication));
      // Mots-clés propres à la part (sinon —)
      const kwR = (s.keywords && s.keywords.length) ? esc(s.keywords.join(', ')) : '—';
      infoR += infoRow('Mots-clés', kwR);
      infoR += infoRow('Statut actuel', badge(pub.statut||'En attente'));
      // Nb pages : priorité à la part
      infoR += infoRow('Nombre des pages', esc(s.nb_pages ?? ''));
      if (pub.maison_edition_scientifique) {
        infoR += infoRow("Maison d'édition scientifique", esc(pub.maison_edition_scientifique));
      }
      // Résumé/commentaire saisis par le récepteur
      const rx = (s.commentaire && String(s.commentaire).trim()!=='') ? s.commentaire : s.resume;
      if (rx && String(rx).trim()!=='') {
        infoR += infoRow('Résumé (Récepteur)', esc(rx).replace(/\n/g,'<br>'));
      }
      if (s.summary_en && String(s.summary_en).trim()!=='') {
        infoR += infoRow('Summary', esc(s.summary_en).replace(/\n/g,'<br>'));
      }

      // auteurs = émetteur + tous récepteurs (même rendu que bloc 1)
      const docsR = renderFilesTable(s.files||[]);
      const commentR = esc(s.commentaire??'').replace(/\n/g,'<br>');

      const wrapR = document.createElement('section');
      wrapR.className = 'pub-block';
      wrapR.innerHTML = buildCardHTML('', infoR, authorsHTML_all, docsR, commentR, false);
      root.appendChild(wrapR);
    }

    // Actions directeur (sur 1er bloc)
    if (isDirector()){
      const menu = root.querySelector('.pub-block .dropdown-menu');
      if (menu){
        menu.querySelectorAll('.dropdown-item').forEach(btn=>{
          btn.addEventListener('click', async ()=>{
            const act = btn.dataset.action;
            try{
              if (act==='validate'){
                await fetchJSON(`${API}/publication/${pubId}/validate`, {method:'POST'});
                updateLocalStatus('Validée');
              }else if(act==='reject'){
                await fetchJSON(`${API}/publication/${pubId}/reject`, {method:'POST'});
                updateLocalStatus('Rejetée');
              }else if(act==='publish'){
                await fetchJSON(`${API}/publication/${pubId}/publish`, {method:'POST'});
                updateLocalStatus('Publiée');
              }
            }catch(e){
              alert('Action impossible: '+(e.message||''));
            }
          });
        });
      }
    }
  }

  load();
})();
</script>
