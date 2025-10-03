<style>
  .member-profile body{background:#f8f9fa;font-family:'Poppins',sans-serif}
  .member-profile .content-wrapper{max-width:1100px;margin:0 auto;padding:0 2px}
  .member-profile .card{background:#fff;padding:20px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.06);border:none;position:relative}
  .member-profile .card h3{font-size:21px;margin-bottom:14px;font-weight:700;border-bottom:1px solid #eee;padding-bottom:15px;color:#2A2916}

  /* actions menu (scopé) */
  .member-profile .profile-actions{position:absolute;top:16px;right:16px}
  .member-profile .kebab-button{background:transparent;border:none;font-size:18px;color:#6c757d;cursor:pointer;line-height:1}
  .member-profile .profile-menu{position:absolute;right:0;top:32px;background:#fff;border:1px solid #eee;border-radius:8px;box-shadow:0 8px 18px rgba(0,0,0,.08);padding:6px 0;min-width:160px;display:none;z-index:10}
  .member-profile .profile-menu.show{display:block}
  .member-profile .profile-menu a{display:block;padding:10px 14px;font-size:14px;color:#333;text-decoration:none}
  .member-profile .profile-menu a:hover{background:#f6f6f6}

  /* table-like list */
  .member-profile .styled-list{list-style:none;padding:0;margin:0;font-size:14px}
  .member-profile .styled-list li{padding:15px 10px;border-bottom:1px solid #f0f0f0;display:flex;align-items:center;gap:110px}
  .member-profile .styled-list li:last-child{border-bottom:none}
  .member-profile .styled-list strong{font-weight:500;color:#6E6D55;min-width:240px}
  .member-profile .styled-list span{display:flex;align-items:center}
  .member-profile .styled-list a{text-decoration:none;font-weight:500;color:#000}
  .member-profile .styled-list a[href^="mailto"]{color:#0d6efd;text-decoration:underline}
  .member-profile .profile-pic{width:30px;height:30px;border-radius:50%;margin-right:12px;object-fit:cover}
  .member-profile .pdf-icon{margin-right:6px;width:20px;height:20px}
  .member-profile .status-active-icon{color:#28a745;font-size:10px;margin-right:8px}

  /* section headers */
  .member-profile .section-header{
    display:flex; align-items:center; justify-content:space-between; gap:12px;
    background:#fff; color:#2A2916; font-weight:700; font-size:16px;
    padding:14px 16px; margin:0 -20px 12px -20px; box-shadow:0 10px 18px -14px rgba(0,0,0,.35);
  }
  .member-profile .section-header:first-of-type{margin-top:-8px}
  .member-profile .section-header .title{display:flex; align-items:center; gap:8px}

 /* expertise bullets — style flèche rouge */
.member-profile .expertise-list{list-style:none;margin:0;padding:0}
.member-profile .expertise-list li{
  position:relative;
  padding:10px 8px 10px 28px;            /* + espace pour la flèche */
  border-bottom:1px solid #f5f5f5;
}
.member-profile .expertise-list li:last-child{border-bottom:none}
.member-profile .expertise-list li::before{
  content:"";
  position:absolute;
  left:8px;                               /* position horizontale de la flèche */
  top:50%;
  transform:translateY(-50%);             /* centrage vertical */
  width:0;height:0;
  border-top:6px solid transparent;       /* triangle CSS */
  border-bottom:6px solid transparent;
  border-left:10px solid #c62828;         /* couleur de la flèche */
}

  /* interest chips */
  .member-profile .chips{display:flex;flex-wrap:wrap;gap:10px;padding:6px 0 2px}
  .member-profile .chip{background:#c62828;color:#fff;border-radius:999px;padding:8px 14px;font-size:13px;font-weight:600;display:inline-flex;align-items:center}
  .member-profile .chip i{font-size:13px;margin-right:6px;opacity:.9}

  /* modal */
  #editMemberModal{position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.5);display:none;justify-content:flex-end;align-items:center;z-index:1000}
  #editMemberModal.show{display:flex}
  #editMemberModal .popup-container{background:#fff;width:450px;height:100%;box-shadow:-4px 0 10px rgba(0,0,0,.1);overflow-y:auto;display:flex;flex-direction:column}
  #editMemberModal .popup-header{display:flex;justify-content:space-between;align-items:center;padding:20px 25px;box-shadow:0 5px 16px #0000001A}
  #editMemberModal .popup-header h2{font-size:18px;margin:0;color:#2A2916}
  #editMemberModal .btn-enregistrer{background:#c62828;color:#fff;border:none;padding:8px 18px;border-radius:5px;cursor:pointer;font-size:14px}
  #editMemberModal .popup-form{padding:25px}
  #editMemberModal .popup-form .form-group{margin-bottom:20px}
  #editMemberModal .popup-form label{display:block;font-weight:600;color:#6E6D55;margin-bottom:8px;font-size:14px}
  #editMemberModal .popup-form input[type="text"],
  #editMemberModal .popup-form input[type="email"],
  #editMemberModal .popup-form select{width:100%;padding:10px 12px;border:1px solid #b5af8e;border-radius:7px;font-size:14px;box-sizing:border-box}
</style>

<div class="member-profile">
  <div class="content-wrapper">
    <div class="card full-width">
      

      <div class="section-header"><div class="title">Informations générales</div></div>
      <ul class="styled-list" id="generalList"></ul>

      <div class="section-header"><div class="title">Domaine d’expertise</div></div>
      <ul class="expertise-list" id="expertiseList"></ul>

      <div class="section-header"><div class="title">Domaine d’intérêt</div></div>
      <div class="chips" id="interestChips"></div>
    </div>
  </div>
</div>

<!-- Modal Edition -->
<div class="modal-overlay" id="editMemberModal">
  <div class="popup-container">
    <div class="popup-header">
      <h2>Modifier le membre</h2>
      <div class="header-actions"><button class="btn-enregistrer" id="saveEditMemberBtn">Enregistrer</button></div>
    </div>
    <form class="popup-form">
      <div class="form-group"><label>Nom & Prénom</label><input type="text" id="edit_fullname" value=""></div>
      <div class="form-group"><label>Rôle</label>
        <select id="edit_role"><option>Post-Doc</</option><option>Maître assistant</option><option>Professeur</option></select>
      </div>
      <div class="form-group"><label>Projets liés</label><input type="text" id="edit_projects" placeholder="BCI-Learn, ARUX"></div>
      <div class="form-group"><label>Spécialité</label><input type="text" id="edit_specialite" placeholder="Intelligence Artificielle"></div>
    </form>
  </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<?php
  $current_user = wp_get_current_user();
  $roles = (array) $current_user->roles;
  $role  = $roles[0] ?? '';
  $user_id = get_current_user_id();
?>
<script>
  window.PMSettings = {
    restUrl: "<?= esc_url( rest_url() ) ?>",
    nonce: "<?= wp_create_nonce('wp_rest') ?>",
    role: "<?= esc_js( $role ) ?>",
    userId: <?= (int) $user_id ?>
  };
</script>

<script>
/* ===== Helpers ===== */
function formatDate(sqlDate){
  if(!sqlDate) return '—';
  const [datePart] = String(sqlDate).split(' ');
  const [y,m,d] = (datePart||'').split('-');
  return (d&&m&&y) ? `${d}/${m}/${y}` : sqlDate;
}
function splitList(v){
  if(!v) return [];
  return String(v).split(/\r?\n|;|,/).map(s=>s.trim()).filter(Boolean);
}
async function fetchJSON(url){
  const r = await fetch(url,{headers:{'X-WP-Nonce':window.PMSettings.nonce}});
  if(!r.ok) throw new Error(await r.text());
  return r.json();
}

/* ===== Menus actions (IDs uniques) ===== */
const profileMenuBtn = document.getElementById('profileMenuBtn');
const profileMenu    = document.getElementById('profileMenu');
document.addEventListener('click', e=>{
  if(profileMenuBtn && profileMenuBtn.contains(e.target)){ profileMenu.classList.toggle('show'); return; }
  if(profileMenu && !profileMenu.contains(e.target)) profileMenu.classList.remove('show');
});

/* ====== Charge le PROFIL du MEMBRE (pas le connecté !) ====== */
async function getMemberProfile(userId){
  if(!userId) return {};
  // 1) endpoint avec ?user_id=
  try{
    const url = `${window.PMSettings.restUrl}plateforme-profile/v1/profile?user_id=${userId}`;
    const r = await fetch(url,{headers:{'X-WP-Nonce':window.PMSettings.nonce}});
    if(r.ok) return await r.json();
  }catch(_){}
  // 2) fallback endpoint alternatif /user/{id}
  try{
    const url = `${window.PMSettings.restUrl}plateforme-profile/v1/user/${userId}`;
    const r = await fetch(url,{headers:{'X-WP-Nonce':window.PMSettings.nonce}});
    if(r.ok) return await r.json();
  }catch(_){}
  return {};
}

/* ===== Build page ===== */
document.addEventListener("DOMContentLoaded", async function(){
  const params   = new URLSearchParams(window.location.search);
  const membreId = params.get("id");
  if(!membreId) return;

  try{
    // 1) infos membre (avec user_id)
    const m = await fetchJSON(`${window.PMSettings.restUrl}plateforme-recherche/v1/membre/${membreId}?with_user=true`);
    // 2) profil du membre ciblé
    const prof = await getMemberProfile(m.user_id || m.user?.ID || m.user?.id);

    // === Normalisations ===
    const fullName   = m.user_display_name || m.display_name || `${m.nom||''} ${m.prenom||''}` || '—';
    const email      = m.user_email || m.email || prof.email1 || '';
    const tel        = (m.tel || m.telephone || prof.tel || prof.pro_tel || '').toString().trim();
    const grade      = m.grade || m.statut || '—';
    const specialite = m.specialite || m.specialty || '—';
    const dateLabo   = formatDate(m.created_at || m.date_entree_labo || m.date_entree);
    const projets    = m.projets_lies || m.projets || m.projet_associe || '—';
    const encadre    = m.encadrements || m.encadrements_text || '—';
    const equipe     = m.equipe_recherche || m.equipe || m.research_team || '—';

    let orcid = (m.orcid || m.orcid_id || prof.orcid || '').toString().trim();
    orcid = orcid.replace(/[^\d-]/g,'');

    const exps = Array.isArray(m.expertises) ? m.expertises
                : Array.isArray(prof.expertises) ? prof.expertises
                : splitList(m.domaines_expertise || prof.expertises_text || '');
    const domaines = Array.isArray(m.domaines) ? m.domaines
                    : Array.isArray(prof.domaines) ? prof.domaines
                    : splitList(m.domaines_interet || prof.domaines_text || '');

    const photoUrl = (m.profile_photo && m.profile_photo.trim()!=="")
      ? m.profile_photo
      : (prof.avatar || "/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 435.png");

    // === Remplir UI ===
    const ul = document.getElementById("generalList");
    ul.innerHTML = `
      <li>
        <strong>Nom complet :</strong>
        <span><img src="${photoUrl}"
            onerror="this.onerror=null;this.src='https://placehold.co/30x30/EFEFEF/AAAAAA?text=User';"
            class="profile-pic" alt="Profile Picture">
          ${fullName}</span>
      </li>
      <li><strong>orcid :</strong>
        <span>${orcid ? `<a href="https://orcid.org/${orcid}" target="_blank">${orcid}</a>` : '—'}</span>
      </li>
      <li><strong>Grade / Statut :</strong> <span>${grade}</span></li>
      <li><strong>Spécialité :</strong> <span>${specialite}</span></li>
      <li><strong>Email :</strong> <span>${email ? `<a href="mailto:${email}">${email}</a>` : '—'}</span></li>
      <li><strong>Téléphone :</strong> <span>${tel || '—'}</span></li>
      <li><strong>Date d’entrée au labo :</strong> <span>${dateLabo || '—'}</span></li>
      <li><strong>Équipe de recherche :</strong> <span>${equipe || '—'}</span></li>
      <li><strong>Projet associé :</strong> <span>${projets}</span></li>
      <li><strong>Encadrements :</strong> <span>${encadre}</span></li>
      <li>
        <strong>CV / Dossier :</strong>
        <span>
          ${m.cv_url ? `<a href="${m.cv_url}" target="_blank">
            <img class="pdf-icon" src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png" alt="CV">
            ${m.cv_url.split('/').pop()}
          </a>` : (prof.cv ? `<a href="${prof.cv}" target="_blank">
            <img class="pdf-icon" src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png" alt="CV">
            ${String(prof.cv).split('/').pop()}
          </a>` : '—')}
        </span>
      </li>
      <li>
        <strong>Etat :</strong>
        <span>${
          m.account_status === "approved" || m.etat === 'Actif'
            ? `<i class="fas fa-circle status-active-icon"></i> Actif`
            : `<i class="fas fa-circle" style="color:#aaa;font-size:10px;margin-right:8px"></i> Inactif`
        }</span>
      </li>
    `;

    document.getElementById('expertiseList').innerHTML =
      (exps && exps.length) ? exps.map(x=>`<li>${x}</li>`).join('')
                            : `<li>Aucune expertise renseignée.</li>`;

    document.getElementById('interestChips').innerHTML =
      (domaines && domaines.length) ? domaines.map(x=>`<span class="chip"><i class="fa-solid fa-tag"></i>${x}</span>`).join('')
                                    : `<span style="color:#6E6D55">Aucun domaine saisi.</span>`;

    // Actions
    const sendMailBtn = document.getElementById('sendMailBtn');
    if (sendMailBtn) sendMailBtn.onclick = (e)=>{ e.preventDefault(); if(email) window.location.href = `mailto:${email}`; };

    // Pré-remplir modal (optionnel)
    document.getElementById('edit_fullname')?.setAttribute('value', fullName || '');
    document.getElementById('edit_specialite')?.setAttribute('value', specialite || '');
    document.getElementById('edit_projects')?.setAttribute('value', projets !== '—' ? projets : '');
  }catch(err){
    console.error("Erreur chargement membre :", err);
  }
});

/* Modal */
const editBtn   = document.getElementById('editBtn');
const editModal = document.getElementById('editMemberModal');
const saveBtn   = document.getElementById('saveEditMemberBtn');
function showModal(){ editModal.classList.add('show'); }
function hideModal(){ editModal.classList.remove('show'); }
editBtn?.addEventListener('click',(e)=>{ e.preventDefault(); showModal(); });
saveBtn?.addEventListener('click',()=> hideModal());
editModal?.addEventListener('click',(e)=>{ if(e.target===editModal) hideModal(); });
</script>
