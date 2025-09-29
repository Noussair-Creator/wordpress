<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Profil – Informations personnelles</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
:root{
  --primary:#d71920;
  --ink:#2A2916;
  --muted:#76735a;
  --line:#e7e3d7;
  --bg:#f8f7f2;
  --input:#F8FBF1;
  --accent:#A6A485;
  --radius:12px;
}

*{box-sizing:border-box;}
html,body{height:100%}
body{margin:0;background:#f5f4f2;font-family:"Segoe UI",system-ui,-apple-system,sans-serif;color:var(--ink)}

.wrapper{max-width:auto;margin:16px auto;padding:0 16px}

/* ---- Card ---- */
.card{
  background:#fff;border:1px solid var(--line);border-radius:var(--radius);
  box-shadow:0 2px 6px rgba(0,0,0,.05);overflow:hidden;width:100%;
}
.card-header{
  display:flex;justify-content:space-between;align-items:center;gap:12px;
  padding:14px 16px;border-bottom:1px solid var(--line);background:#fff
}
.card-header .title{display:flex;align-items:center;gap:10px;font-weight:700}
.card-header .title i{
  width:30px;height:30px;border-radius:50%;background:#fff;border:1px solid var(--line);
  display:inline-flex;align-items:center;justify-content:center;color:var(--accent)
}
.btn-primary{
  display:inline-flex;align-items:center;gap:8px;background:var(--primary);color:#fff;
  border:none;border-radius:10px;padding:10px 14px;font-weight:700;cursor:pointer
}
.btn-primary i{font-size:14px}

.card-body{padding:18px}
.form{display:grid;grid-template-columns:265px 1fr;gap:18px}
@media (max-width:780px){.form{grid-template-columns:1fr}}

/* ---- Avatar ---- */
.avatar{display:flex;flex-direction:column;align-items:center;gap:10px;position:relative;width:262px;    margin-top: 56px;}
.avatar .photo{
  width:250px;height:250px;border-radius:50%;border:3px solid #000;
  background:#f0f0f0 url('https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=300&q=60') center/cover no-repeat;
  position:relative;display:flex;align-items:center;justify-content:center
}
.avatar input[type="file"]{display:none}
.avatar .cam{
  position:absolute;right:40px;bottom:-6px;width:38px;height:38px;border-radius:50%;
  background:#fff;border:2px solid #000;display:flex;align-items:center;justify-content:center;
  cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,.15);z-index:2
}
.avatar .cam i{color:#222}

/* ---- Inputs ---- */
.grid{display:grid;gap:12px;grid-template-columns:repeat(2,minmax(0,1fr))}
@media (max-width:780px){.grid{grid-template-columns:1fr}}

.field{
  position:relative;display:flex;align-items:center;
  border:1px solid var(--line);border-radius:10px;height:42px;padding:0 10px;gap:8px;background:#fff
}

.field input,.field select{
  width:100%;height:100%;border:none;background:transparent;outline:none;color:var(--ink);font-size:14px;font-weight:600
}
.field input::placeholder{color:#b3af9f;font-weight:500}
.field .flag{width:22px;height:16px;border-radius:2px;border:1px solid #ddd;object-fit:cover}
.field .chev{color:#2A2916}

.section-title{margin:6px 0 8px;font-weight:700; font-size: 15px}

/* ---- Labels ---- */
.field-label{
  font-size:14px; line-height:1.4; color:black; font-weight:550; margin:2px 2px 8px;
}
.col{display:flex;flex-direction:column;gap:6px}

/* ---- File row / full width ---- */
.file-row{display:grid;grid-template-columns:1fr 140px;gap:10px;align-items:center}
  .btn-import{border:none;border-radius:10px;height:42px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;background:#bdb694;color:#fff}
  .full-row{grid-column:1 / -1;width:100%}
  .full-row-inner{margin:0 10px}

.hr{height:1px;background:var(--line);margin:14px 0;grid-column:1/-1}

/* ---- Select custom ---- */
.field.select-like{position:relative}
.field.select-like select{
  appearance:none;background:transparent;border:none;outline:none;width:100%;height:100%;font-size:14px;font-weight:600;color:var(--ink);padding-right:40px
}
.field.select-like .chev{position:absolute;right:12px;pointer-events:none}
.field.select-like .split{position:absolute;right:36px;top:50%;transform:translateY(-50%);width:1px;height:60%;background:#d8d4c7}

/* ---- Blocks (adresses) ---- */
.address-block{grid-column:1 / -1;display:grid;gap:12px;margin:0 10px}
.address-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
@media (max-width:780px){.address-row{grid-template-columns:1fr}}

/* ---- Téléphone style (perso & pro) ---- */
.field.tel-field{height:42px; padding:0 12px; gap:10px; display:flex; align-items:center; position:relative;}
.tel-flag-btn{display:inline-flex; align-items:center; gap:8px; background:transparent; border:0; padding:0; cursor:pointer;}
.tel-flag-chip{width:28px; height:28px; border-radius:6px; display:flex; align-items:center; justify-content:center; box-shadow:0 0 0 1px #ffffff inset;}
.tel-flag-chip img{ width:20px; height:15px; border-radius:2px; object-fit:cover; }
.tel-flag-btn .chev{ font-size:12px; color:#2A2916; }
.tel-vsep{ width:1px; height:22px; background:var(--line); }
.tel-country-menu{position:absolute; top:calc(100% + 6px); left:12px; background:#fff; border:1px solid var(--line); border-radius:10px; box-shadow:0 8px 20px rgba(0,0,0,.08); padding:6px; display:none; z-index:1000;}
.tel-country-menu button{display:flex; align-items:center; gap:8px; border:none; background:#fff; padding:8px 10px; width:160px; border-radius:8px; cursor:pointer;}
.tel-country-menu button:hover{ background:#f4f2ec; }

/* ---- Actions ---- */
.form-actions{display:flex;gap:10px;justify-content:flex-end;margin-top:18px}
.btn{border:none;border-radius:10px;padding:10px 14px;font-weight:700;cursor:pointer}
.btn.save{background:var(--primary);color:#fff}
.btn.cancel{background:#eee}

/* === Champs verrouillés === */
.field.is-locked{background:#f3f3f3;border-color:#e0ded4;opacity:.9}
.field.is-locked input[readonly],
.field.is-locked select:disabled{cursor:not-allowed;color:#555}
.field.is-locked .chev{opacity:.4}

/* === Drawer password === */
.drawer-backdrop{position:fixed;inset:0;background:rgba(0,0,0,.35);opacity:0;pointer-events:none;transition:opacity .25s;z-index:100000;}
.drawer-backdrop.show{opacity:1;pointer-events:auto}
.drawer{position:fixed;top:0;right:0;height:100dvh;width:420px;max-width:92vw;background:#fff;box-shadow:-8px 0 24px rgba(0,0,0,.12);border-top-left-radius:12px;border-bottom-left-radius:12px;transform:translateX(110%);transition:transform .28s ease;z-index:100001;display:flex;flex-direction:column;}
.drawer.open{transform:translateX(0)}
.drawer-header{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:12px 14px;border-bottom:1px solid #e9ecef;background:#f8f9fa;position:sticky;top:0;z-index:2;}
.drawer-title{font-size:16px;font-weight:700;margin:0}
.drawer-actions{display:flex;gap:8px;align-items:center}
.drawer-save{background:#d71920;color:#fff;border:none;border-radius:8px;padding:8px 14px;font-weight:700;cursor:pointer}
.drawer-close{background:#eee;border:none;border-radius:8px;width:32px;height:32px;font-size:18px;cursor:pointer}
.drawer-body{padding:16px;overflow:auto;flex:1}
.drawer .field{background:#fff;border-color:#e9ecef}

/* ====== Expertises & Domaines ====== */
.pill-input{position:relative; display:flex; align-items:center; border:1px solid var(--line); border-radius:10px; height:42px; padding:0 12px; gap:10px; background:#fff;}
.pill-input input{flex:1; border:none; outline:none; height:100%; font-size:14px; font-weight:600;}
.pill-input .add-btn{width:26px; height:26px; border:none; background:transparent; cursor:pointer; padding:0; display:inline-flex; align-items:center; justify-content:center;}
.pill-input .add-btn img{width:16px; height:16px; display:block}

/* BLOC UNIQUE scrollable qui enveloppe toutes les expertises */
.exp-box{
  border:1px solid var(--line);
  border-radius:10px;
  background:#fff;
  padding:8px;
  height:200px;          /* <-- au lieu de max-height */
  overflow:auto;         /* scroll si ça dépasse */
  margin-top:10px;
}.exp-list{list-style:none; margin:0; padding:0; display:flex; flex-direction:column; gap:8px;}
.exp-item{display:flex; align-items:center; gap:10px;}
.exp-item .trash{width:18px; height:18px; cursor:pointer; flex:0 0 auto;}

.dom-list{display:flex; flex-wrap:wrap; gap:8px; margin-top:10px}
.dom-chip{display:inline-flex; align-items:center; gap:6px; padding:8px 12px; background:#BF0404 ; border:1px solid var(--line); border-radius:999px; font-weight:600; font-size:13px}
.dom-chip .close{width:16px; height:16px; cursor:pointer;}
/* Domaine d’intérêt : texte en blanc (conserve le background actuel) */
.dom-chip { 
  color: #fff !important;
}
.dom-chip span { 
  color: #fff !important;  /* au cas où un style cible le span */
}

/* garder le texte blanc aussi au survol/focus */
.dom-chip:hover,
.dom-chip:focus { 
  color: #fff !important;
}
.dom-chip:hover span,
.dom-chip:focus span { 
  color: #fff !important;
}
/* État vide du bloc expertises */
.exp-empty{
  display:flex; flex-direction:column;
  align-items:center; justify-content:center;
  height:100%;           /* occupe toute la hauteur du bloc */
  gap:8px; text-align:center; color:#76735a;
  padding:0;
}
.exp-empty img{ max-width:120px; height:auto; opacity:.85 }

/* Toggle auto : cache l'état vide quand il y a des items */
.exp-box.has-items .exp-empty{ display:none }
.exp-box:not(.has-items) .exp-list{ display:none }

</style>
</head>
<body>

<div class="wrapper">
  <div class="card">
    <div class="card-header">
      <div class="title"><i class="fa-regular fa-id-card"></i> Informations personnelles</div>
      <button id="btnOpenPwd" class="btn-primary" type="button"><i class="fa-solid fa-key"></i> Modifier votre mot de passe</button>
    </div>

    <form class="card-body" method="post" action="#" enctype="multipart/form-data">
      <div class="form">

        <!-- Avatar -->
        <div class="avatar">
          <label class="photo" id="avatarPreview">
            <input type="file" name="avatar" id="avatarInput" accept="image/*">
            <span class="cam" id="camTrigger"><i class="fa-solid fa-camera"></i></span>
          </label>
        </div>

        <!-- Colonne droite -->
        <div class="grid">
          <!-- Prénom -->
          <div class="col">
            <label for="prenom" class="field-label">Prénom</label>
            <div class="field<?= $lockClass ?>" title="<?= $is_student_php?'Champ non modifiable':'' ?>">
              <input id="prenom" type="text" name="prenom" value="<?=htmlspecialchars($profil['prenom'])?>" placeholder="Prénom"<?= $roAttr ?>>
            </div>
          </div>

          <!-- Nom -->
          <div class="col">
            <label for="nom" class="field-label">Nom</label>
            <div class="field<?= $lockClass ?>" title="<?= $is_student_php?'Champ non modifiable':'' ?>">
              <input id="nom" type="text" name="nom" value="<?=htmlspecialchars($profil['nom'])?>" placeholder="Nom"<?= $roAttr ?>>
            </div>
          </div>

          <!-- Nationalité -->
          <div class="col">
            <label for="nationalite" class="field-label">Nationalité</label>
            <div class="field select-like<?= $lockClass ?>" title="<?= $is_student_php?'Champ non modifiable':'' ?>">
              <select name="nationalite_display" id="nationalite"<?= $selDis ?>>
                <option <?= $profil['nationalite']==='Tunisienne'?'selected':''; ?>>Tunisienne</option>
                <option <?= $profil['nationalite']==='Française'?'selected':''; ?>>Française</option>
                <option <?= $profil['nationalite']==='Marocaine'?'selected':''; ?>>Marocaine</option>
                <option <?= $profil['nationalite']==='Algérienne'?'selected':''; ?>>Algérienne</option>
              </select>
              <input type="hidden" name="nationalite" value="<?=htmlspecialchars($profil['nationalite'])?>">
              <span class="split" aria-hidden="true"></span>
              <i class="fa-solid fa-chevron-down chev" aria-hidden="true"></i>
            </div>
          </div>

          <!-- CIN -->
          <div class="col">
            <label for="cin" class="field-label">CIN / Identifiant</label>
            <div class="field<?= $lockClass ?>" title="<?= $is_student_php?'Champ non modifiable':'' ?>">
              <input id="cin" type="text" name="cin" value="<?=htmlspecialchars($profil['cin'])?>" placeholder="CIN / Identifiant"<?= $roAttr ?>>
            </div>
          </div>

          <!-- Email 1 -->
          <div class="col">
            <label for="email1" class="field-label">Email 1</label>
            <div class="field"><input id="email1" type="email" name="email1" value="<?=htmlspecialchars($profil['email1'])?>" placeholder="Email 1"></div>
          </div>

          <!-- Email 2 -->
          <div class="col">
            <label for="email2" class="field-label">Email 2</label>
            <div class="field"><input id="email2" type="email" name="email2" value="<?=htmlspecialchars($profil['email2'])?>" placeholder="Email 2"></div>
          </div>

          <!-- Téléphone perso -->
          <div class="col">
            <label for="tel" class="field-label">Téléphone</label>
            <div class="field tel-field" id="telField">
              <button type="button" class="tel-flag-btn" id="telFlagBtn" aria-haspopup="listbox" aria-expanded="false">
                <span class="tel-flag-chip"><img id="telFlagImg" src="https://flagcdn.com/w20/tn.png" alt="TN"></span>
                <i class="fa-solid fa-chevron-down chev" aria-hidden="true"></i>
              </button>
              <span class="tel-vsep" aria-hidden="true"></span>
              <input type="text" name="tel" id="tel" value="<?=htmlspecialchars($profil['tel'])?>" placeholder="Téléphone" style="padding-left:0">
              <!-- menu pays -->
              <div class="tel-country-menu" id="telMenu">
                <button type="button" data-iso="tn"><img class="flag" src="https://flagcdn.com/w20/tn.png" alt=""> Tunisie</button>
                <button type="button" data-iso="fr"><img class="flag" src="https://flagcdn.com/w20/fr.png" alt=""> France</button>
                <button type="button" data-iso="ma"><img class="flag" src="https://flagcdn.com/w20/ma.png" alt=""> Maroc</button>
                <button type="button" data-iso="dz"><img class="flag" src="https://flagcdn.com/w20/dz.png" alt=""> Algérie</button>
              </div>
            </div>
          </div>

          <!-- ORCID -->
          <div class="col">
            <label for="orcid" class="field-label">ORCID</label>
            <div class="field">
              <input type="text" name="orcid" id="orcid" value="<?=htmlspecialchars($profil['orcid'] ?? '')?>" placeholder="xxxx-xxxx-xxxx-xxxx" maxlength="19" pattern="\d{4}-\d{4}-\d{4}-\d{4}">
            </div>
          </div>
        </div>

        <!-- Fichier (CV) -->
          <div class="full-row">
            <div class="full-row-inner">
              <div class="file-row">
                <div class="field" id="cvBox">
                  <input type="text" id="cvName" value="<?=htmlspecialchars($profil['cv'])?>" placeholder="Aucun fichier" readonly>
                </div>
                <label class="btn-import">
                  <i class="fa-solid fa-upload"></i> Importer
                  <input type="file" name="cv" id="cvInput" accept=".pdf,.doc,.docx" hidden>
                </label>
              </div>
            </div>
          </div>

        <div class="hr"></div>

        <!-- ======= BLOCS SELON RÔLE ======= -->

        <?php if ($is_student_php): ?>
          <!-- (Bloc étudiant : inchangé, ajoute des labels comme ci-dessus si besoin) -->
          <!-- … -->
        <?php else: ?>
          <!-- ===== Informations académiques ===== -->
          <div class="section-title"style="grid-column:1 / -1;">Informations académiques</div>
          <div class="address-block" id="acadBlock">
            <div class="address-row">
              <div class="col">
                <label for="specialite_id" class="field-label">Spécialité</label>
                <div class="field select-like">
                  <select name="specialite_id" id="specialite_id">
                    <option value="">Spécialité</option>
                  </select>
                  <span class="split"></span>
                  <i class="fa-solid fa-chevron-down chev"></i>
                </div>
              </div>

              <div class="col">
                <label for="grade_id" class="field-label">Grade académique</label>
                <div class="field select-like">
                  <select name="grade_id" id="grade_id">
                    <option value="">Grade académique</option>
                  </select>
                  <span class="split"></span>
                  <i class="fa-solid fa-chevron-down chev"></i>
                </div>
              </div>
            </div>

            <div class="address-row" style="margin-top:12px">
              <div class="col">
                <label for="acad_email" class="field-label">Email académique</label>
                <div class="field">
                  <input type="email" name="acad_email" id="acad_email" placeholder="Email académique">
                </div>
              </div>

              <div class="col">
                <label for="pro_tel" class="field-label">Téléphone Professionnel</label>
                <div class="field tel-field" id="proTelField">
                  <button type="button" class="tel-flag-btn" id="proFlagBtn" aria-haspopup="listbox" aria-expanded="false">
                    <span class="tel-flag-chip"><img id="proFlagImg" src="https://flagcdn.com/w20/tn.png" alt="TN"></span>
                    <i class="fa-solid fa-chevron-down chev"></i>
                  </button>
                  <span class="tel-vsep"></span>
                  <input type="text" name="pro_tel" id="pro_tel" placeholder="Téléphone Professionnel" style="padding-left:0">
                  <div class="tel-country-menu" id="proTelMenu">
                    <button type="button" data-iso="tn"><img class="flag" src="https://flagcdn.com/w20/tn.png" alt=""> Tunisie</button>
                    <button type="button" data-iso="fr"><img class="flag" src="https://flagcdn.com/w20/fr.png" alt=""> France</button>
                    <button type="button" data-iso="ma"><img class="flag" src="https://flagcdn.com/w20/ma.png" alt=""> Maroc</button>
                    <button type="button" data-iso="dz"><img class="flag" src="https://flagcdn.com/w20/dz.png" alt=""> Algérie</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- ===== Expertises & Domaines (SECTION) ===== -->
          <div class="hr"></div>

          <div class="address-block" id="skillsBlock">
            <!-- Expertises techniques -->
            <div class="section-title">Expertises techniques</div>
            <div class="pill-input">
              <input type="text" id="expInput" placeholder="Ajouter une expertise (ex. Traitement des données)">
              <button type="button" class="add-btn" id="expAddBtn" title="Ajouter">
                <img src="/wp-content/plugins/plateforme-master/images/27)%20Icon-corner-right-up.png" alt="Ajouter">
              </button>
            </div>
            <!-- bloc unique scrollable -->
          <!-- bloc unique scrollable -->
<div class="exp-box" id="expBox">
  <div class="exp-empty">
    <img src="/wp-content/plugins/plateforme-master/images/undraw_no-data_ig65%20(2).png" alt="Aucune donnée">
    <div>Aucune expertise technique n’a encore été renseignée.</div>
  </div>
  <ul class="exp-list" id="expList"></ul>
</div>


            <div class="hr"></div>

            <!-- Domaines d'intérêt -->
            <div class="section-title">Domaine d’intérêt</div>
            <div class="pill-input">
              <input type="text" id="domInput" placeholder="Ajouter un domaine (ex. AI)">
              <button type="button" class="add-btn" id="domAddBtn" title="Ajouter">
                <img src="/wp-content/plugins/plateforme-master/images/27)%20Icon-corner-right-up.png" alt="Ajouter">
              </button>
            </div>
            <div class="dom-list" id="domList"></div>
          </div>
        <?php endif; ?>

        <div class="hr"></div>

        <!-- Actions -->
        <div class="form-actions" style="grid-column:1 / -1;">
          <button class="btn cancel" type="reset">Annuler</button>
          <button class="btn save" type="submit">Enregistrer</button>
        </div>

      </div>
    </form>
  </div>
</div>

<!-- Drawer Password -->
<div id="pwdBackdrop" class="drawer-backdrop" aria-hidden="true"></div>
<aside id="pwdDrawer" class="drawer" role="dialog" aria-modal="true" aria-labelledby="pwdTitle">
  <div class="drawer-header">
    <h3 id="pwdTitle" class="drawer-title">Changer le mot de passe</h3>
    <div class="drawer-actions">
      <button id="btnSavePwd" class="drawer-save" type="button">Enregistrer</button>
    </div>
  </div>
  <div class="drawer-body">
    <div class="field" style="margin-bottom:12px;">
      <input type="password" id="oldPassword" placeholder="Ancien mot de passe">
    </div>
    <div class="field" style="margin-bottom:12px;">
      <input type="password" id="newPassword" placeholder="Nouveau mot de passe">
    </div>
    <div class="field">
      <input type="password" id="confirmPassword" placeholder="Confirmer mot de passe">
    </div>
  </div>
</aside>

<script>
const API_BASE    = (window.PMSettings?.restUrl || '') + 'plateforme-profile/v1';
const NONCE       = window.PMSettings?.nonce;
const IS_STUDENT  = !!(window.PMSettings && window.PMSettings.isStudent);

/* Helpers */
function authHeaders(isJson = true) {
  const h = { 'X-WP-Nonce': NONCE };
  if (isJson) h['Content-Type'] = 'application/json';
  return h;
}
async function wpGet(path) {
  const r = await fetch(API_BASE + path, { headers: authHeaders(false), credentials: 'include' });
  if (!r.ok) throw new Error(await r.text());
  return r.json();
}
async function wpPatch(path, body) {
  const r = await fetch(API_BASE + path, {
    method: 'PATCH',
    headers: authHeaders(true),
    credentials: 'include',
    body: JSON.stringify(body)
  });
  if (!r.ok) throw new Error(await r.text());
  return r.json();
}
async function wpPost(path, body) {
  const r = await fetch(API_BASE + path, {
    method: 'POST',
    headers: authHeaders(true),
    credentials: 'include',
    body: JSON.stringify(body)
  });
  if (!r.ok) throw new Error(await r.text());
  return r.json();
}
function fileToDataUrl(file) {
  return new Promise((res, rej) => {
    const fr = new FileReader();
    fr.onload = () => res(fr.result);
    fr.onerror = rej;
    fr.readAsDataURL(file);
  });
}

/* DOM */
const form          = document.querySelector('form.card-body');
const prenomInput   = form.querySelector('input[name="prenom"]');
const nomInput      = form.querySelector('input[name="nom"]');
const natSelect     = form.querySelector('select[name="nationalite_display"]');
const natHidden     = form.querySelector('input[name="nationalite"]');
const cinInput      = form.querySelector('input[name="cin"]');
const email1Input   = form.querySelector('input[name="email1"]');
const email2Input   = form.querySelector('input[name="email2"]');
const telInput      = form.querySelector('input[name="tel"]');
const orcidInput    = form.querySelector('input[name="orcid"]');
const cvInput       = document.getElementById('cvInput');
const cvName        = document.getElementById('cvName');
const avatarInput   = document.getElementById('avatarInput');
const avatarPreview = document.getElementById('avatarPreview');

const gradeSel      = document.getElementById('grade_id');
const specSel       = document.getElementById('specialite_id');

/* Expertises / Domaines UI */
let expItems = [];
let domItems = [];
const expInput   = document.getElementById('expInput');
const expAddBtn  = document.getElementById('expAddBtn');
const expListUl  = document.getElementById('expList');
const domInput   = document.getElementById('domInput');
const domAddBtn  = document.getElementById('domAddBtn');
const domListDiv = document.getElementById('domList');

const expBox = document.getElementById('expBox');

function renderExpertises(){
  expListUl.innerHTML = '';
  if (!expItems.length) {
    expBox.classList.remove('has-items'); // montre l'état vide
    return;
  }
  expBox.classList.add('has-items');      // cache l'état vide

  expItems.forEach((txt, idx) => {
    const li = document.createElement('li');
    li.className = 'exp-item';
    li.innerHTML = `
      <img class="trash" data-i="${idx}"
           src="/wp-content/plugins/plateforme-master/images/icons/27)%20Icon-trash-2.png"
           alt="Supprimer">
      <span class="txt">${txt}</span>
    `;
    expListUl.appendChild(li);
  });
}



function renderDomaines(){
  domListDiv.innerHTML = '';
  domItems.forEach((txt, idx) => {
    const chip = document.createElement('div');
    chip.className = 'dom-chip';
    chip.innerHTML = `
      <span>${txt}</span>
      <img class="close" data-i="${idx}" src="/wp-content/plugins/plateforme-master/images/27)%20Icon-close-circle.png" alt="Retirer">
    `;
    domListDiv.appendChild(chip);
  });
}
function addExpertise(){
  const v = (expInput.value || '').trim();
  if(!v) return;
  if(!expItems.includes(v)) expItems.push(v);
  expInput.value = '';
  renderExpertises();
}
function addDomaine(){
  const v = (domInput.value || '').trim();
  if(!v) return;
  if(!domItems.includes(v)) domItems.push(v);
  domInput.value = '';
  renderDomaines();
}
expAddBtn?.addEventListener('click', addExpertise);
domAddBtn?.addEventListener('click', addDomaine);
expInput?.addEventListener('keydown', e=>{ if(e.key==='Enter'){ e.preventDefault(); addExpertise(); }});
domInput?.addEventListener('keydown', e=>{ if(e.key==='Enter'){ e.preventDefault(); addDomaine(); }});
expListUl?.addEventListener('click', (e)=>{
  const i = e.target?.dataset?.i;
  if(typeof i !== 'undefined'){ expItems.splice(Number(i),1); renderExpertises(); }
});
domListDiv?.addEventListener('click', (e)=>{
  const i = e.target?.dataset?.i;
  if(typeof i !== 'undefined'){ domItems.splice(Number(i),1); renderDomaines(); }
});

/* Refs grade/spec si non-étudiant */
async function loadRefsIfNeeded() {
  if (!IS_STUDENT && gradeSel && specSel) {
    try {
      const refs = await wpGet('/profile/refs'); // {grades:[], specialites:[]}
      refs?.grades?.forEach(g => {
        const o = document.createElement('option');
        o.value = g.id; o.textContent = g.intitule || g.code || ('#'+g.id);
        gradeSel.appendChild(o);
      });
      refs?.specialites?.forEach(s => {
        const o = document.createElement('option');
        o.value = s.id; o.textContent = s.intitule || s.code || ('#'+s.id);
        specSel.appendChild(o);
      });
    } catch (e) {
      console.warn('Impossible de charger grades/spécialités', e);
    }
  }
}

/* Chargement profil */
async function loadProfile() {
  try {
    await loadRefsIfNeeded();
    const p = await wpGet('/profile');

    prenomInput.value = p.prenom || '';
    nomInput.value    = p.nom || '';
    if (natSelect) natSelect.value = p.nationalite || 'Tunisienne';
    if (natHidden) natHidden.value = p.nationalite || 'Tunisienne';
    cinInput.value    = p.cin || '';
    email1Input.value = p.email1 || '';
    email2Input.value = p.email2 || '';
    telInput.value    = p.tel || '';
    orcidInput.value  = p.orcid || '';

    // CV : n’afficher que le nom
    if (p.cv) {
      try {
        const u = new URL(p.cv, window.location.origin);
        cvName.value = u.pathname.split('/').pop() || p.cv;
        cvName.dataset.url = p.cv;
      } catch (_) {
        cvName.value = (p.cv || '').split('/').pop();
      }
    } else {
      cvName.value = '';
    }

    // Avatar
    if (p.avatar) avatarPreview.style.backgroundImage = `url('${p.avatar}')`;

    if (!IS_STUDENT) {
      if (p.grade?.id && gradeSel) gradeSel.value = String(p.grade.id);
      if (p.specialite?.id && specSel) specSel.value = String(p.specialite.id);

      let info = {};
      try {
        if (typeof p.academic_info === 'string' && p.academic_info.trim().startsWith('{')) {
          info = JSON.parse(p.academic_info);
        } else if (typeof p.academic_info === 'object' && p.academic_info) {
          info = p.academic_info;
        }
      } catch(_) {}
      document.getElementById('acad_email')?.setAttribute('value', info.email_acad || '');
      document.getElementById('pro_tel')?.setAttribute('value', info.tel_pro || '');
      document.getElementById('acad_address')?.setAttribute('value', info.adresse_pro || '');
      document.getElementById('acad_functions')?.setAttribute('value', info.fonctions || '');

      // listes depuis l’API
      expItems = Array.isArray(p.expertises) ? [...p.expertises] : [];
      domItems = Array.isArray(p.domaines)   ? [...p.domaines]   : [];
      renderExpertises();
      renderDomaines();
    }
  } catch (e) {
    console.error(e);
    alert("Impossible de charger votre profil. Merci de vous reconnecter.");
  }
}

/* Submit */
form.addEventListener('submit', async (e) => {
  e.preventDefault();

  // avatar en différé
  if (pendingAvatarFile) {
    try {
      const dataUrl = await fileToDataUrl(pendingAvatarFile);
      const res = await wpPost('/profile/avatar', {
        file_name: pendingAvatarFile.name,
        mime_type: pendingAvatarFile.type || 'image/jpeg',
        content: dataUrl
      });
      const sidebarImg = document.getElementById('sidebarAvatar');
      if (sidebarImg && res?.url) {
        sidebarImg.src = res.url + '?v=' + (res.version || Date.now());
      }
    } catch (err) {
      console.error(err);
      alert("Échec de l'upload avatar.");
      return;
    }
  }

  const payload = {
    nom: nomInput.value.trim(),
    prenom: prenomInput.value.trim(),
    nationalite: natHidden.value.trim(),
    cin: cinInput.value.trim(),
    email1: email1Input.value.trim(),
    email2: email2Input.value.trim(),
    tel_country: telFlagImg.alt.toLowerCase(),
    tel: telInput.value.trim(),
    orcid: orcidInput.value.trim()
  };

  if (!IS_STUDENT) {
    payload.grade_id = gradeSel?.value || '';
    payload.specialite_id = specSel?.value || '';
    payload.academic_info = {
      email_acad: document.getElementById('acad_email')?.value.trim() || '',
      tel_pro: document.getElementById('pro_tel')?.value.trim() || '',
      adresse_pro: document.getElementById('acad_address')?.value.trim() || '',
      fonctions: document.getElementById('acad_functions')?.value.trim() || ''
    };
    // nouvelles listes
    payload.expertises = expItems;
    payload.domaines   = domItems;
  }

  try {
    await wpPatch('/profile', payload);
    alert('Profil enregistré avec succès ✅');
    pendingAvatarFile = null;
    await loadProfile();
  } catch (e) {
    console.error(e);
    alert('Échec de l’enregistrement. Vérifiez vos droits ou reconnectez-vous.');
  }
});

/* Upload avatar */
let pendingAvatarFile = null;
document.getElementById('camTrigger').addEventListener('click', () => avatarInput.click());
avatarInput.addEventListener('change', (e) => {
  const f = e.target.files?.[0];
  if (!f) { pendingAvatarFile = null; return; }
  pendingAvatarFile = f;
  avatarPreview.style.backgroundImage = `url('${URL.createObjectURL(f)}')`;
});

/* Upload CV */
document.querySelector('.btn-import').addEventListener('click', () => cvInput.click());
cvInput.addEventListener('change', async (e) => {
  const f = e.target.files?.[0];
  if (!f) return;
  cvName.value = f.name;
  try {
    const dataUrl = await fileToDataUrl(f);
    await wpPost('/profile/cv', {
      file_name: f.name,
      mime_type: f.type || 'application/pdf',
      content: dataUrl
    });
  } catch (err) {
    console.error(err);
    alert("Échec de l'upload du CV.");
  }
});

/* Menus pays (perso) */
const telField   = document.getElementById('telField');
const telFlagBtn = document.getElementById('telFlagBtn');
const telFlagImg = document.getElementById('telFlagImg');
const telMenu    = document.getElementById('telMenu');
function toggleTelMenu(show){ telMenu.style.display = (show ?? (telMenu.style.display !== 'block')) ? 'block' : 'none'; }
telFlagBtn?.addEventListener('click', (e) => {
  e.stopPropagation(); toggleTelMenu(); telFlagBtn.setAttribute('aria-expanded', telMenu.style.display === 'block' ? 'true' : 'false');
});
telMenu?.querySelectorAll('button').forEach(btn => {
  btn.addEventListener('click', () => {
    const iso = btn.dataset.iso;
    telFlagImg.src = `https://flagcdn.com/w20/${iso}.png`; telFlagImg.alt = iso.toUpperCase();
    toggleTelMenu(false); telFlagBtn.setAttribute('aria-expanded', 'false');
  });
});
document.addEventListener('click', (e) => {
  if (telField && !telField.contains(e.target)) { toggleTelMenu(false); telFlagBtn?.setAttribute('aria-expanded', 'false'); }
});

/* Menus pays (pro) */
const proTelField = document.getElementById('proTelField');
const proFlagBtn  = document.getElementById('proFlagBtn');
const proFlagImg  = document.getElementById('proFlagImg');
const proTelMenu  = document.getElementById('proTelMenu');
function toggleProMenu(show){ proTelMenu.style.display = (show ?? (proTelMenu.style.display !== 'block')) ? 'block' : 'none'; }
proFlagBtn?.addEventListener('click', (e) => {
  e.stopPropagation(); toggleProMenu(); proFlagBtn.setAttribute('aria-expanded', proTelMenu.style.display === 'block' ? 'true' : 'false');
});
proTelMenu?.querySelectorAll('button').forEach(btn => {
  btn.addEventListener('click', () => {
    const iso = btn.dataset.iso;
    proFlagImg.src = `https://flagcdn.com/w20/${iso}.png`; proFlagImg.alt = iso.toUpperCase();
    toggleProMenu(false); proFlagBtn.setAttribute('aria-expanded', 'false');
  });
});
document.addEventListener('click', (e) => {
  if (proTelField && !proTelField.contains(e.target)) { toggleProMenu(false); proFlagBtn?.setAttribute('aria-expanded', 'false'); }
});

/* Drawer Password */
const btnOpenPwd = document.getElementById('btnOpenPwd');
const btnSavePwd = document.getElementById('btnSavePwd');
const drawer = document.getElementById('pwdDrawer');
const backdrop = document.getElementById('pwdBackdrop');
function openDrawer(){ drawer.classList.add('open'); backdrop.classList.add('show'); document.body.style.overflow='hidden'; }
function closeDrawer(){ drawer.classList.remove('open'); backdrop.classList.remove('show'); document.body.style.overflow=''; }
btnOpenPwd?.addEventListener('click', openDrawer);
backdrop?.addEventListener('click', closeDrawer);
document.addEventListener('keydown', (e)=>{ if(e.key==='Escape' && drawer?.classList.contains('open')) closeDrawer(); });

btnSavePwd?.addEventListener('click', async () => {
  const oldP = document.getElementById('oldPassword').value.trim();
  const newP = document.getElementById('newPassword').value.trim();
  const cfmP = document.getElementById('confirmPassword').value.trim();

  if (!oldP || !newP || !cfmP) return alert('Veuillez remplir tous les champs.');
  if (newP.length < 6) return alert('Le nouveau mot de passe doit contenir au moins 6 caractères.');
  if (newP !== cfmP) return alert('Les mots de passe ne correspondent pas.');

  try{
    await wpPost('/profile/password', { old_password: oldP, new_password: newP, confirm_password: cfmP });
    alert('Mot de passe modifié ✅');
    closeDrawer();
  }catch(err){
    console.error(err);
    alert("Échec du changement de mot de passe.");
  }
});

loadProfile();
</script>

</body>
</html>
<?php
$role_from_parent = isset($role) ? strtolower($role) : '';
$is_student_php = in_array($role_from_parent, ['um_student_master','student_master','um_doctorant','doctorant'], true);
$lockClass = $is_student_php ? ' is-locked' : '';
$roAttr    = $is_student_php ? ' readonly aria-readonly="true"' : '';
$selDis    = $is_student_php ? ' disabled aria-disabled="true"' : '';
$profil = [
  'nom'           => '',
  'prenom'        => '',
  'nationalite'   => 'Tunisienne',
  'tel_country'   => 'tn',
  'tel'           => '',
  'email1'        => '',
  'email2'        => '',
  'cin'           => '',
  'cv'            => ''
];
?>
