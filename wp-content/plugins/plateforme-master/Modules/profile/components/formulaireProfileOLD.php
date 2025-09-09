<?php
// On dérive le rôle côté PHP (au cas où window.PMSettings n’est pas dispo très tôt)
$role_from_parent = isset($role) ? strtolower($role) : '';
$is_student_php = in_array($role_from_parent, ['um_student_master','student_master','um_doctorant','doctorant'], true);

// Helpers visuels pour champs verrouillés (étudiant/doctorant)
$lockClass = $is_student_php ? ' is-locked' : '';
$roAttr    = $is_student_php ? ' readonly aria-readonly="true"' : '';
$selDis    = $is_student_php ? ' disabled aria-disabled="true"' : '';

// Valeurs de démo/placeholder (surchargées par loadProfile())
$profil = [
  'nom'           => '',
  'prenom'        => '',
  'nationalite'   => 'Tunisienne',
  'tel_country'   => 'tn',
  'tel'           => '',
  'email1'        => '',
  'email2'        => '',
  'cin'           => '',
  'cv'            => '',
  'adr_etud'      => '',
  'gov_etud'      => '',
  'cp_etud'       => '',
  'adr_parents'   => '',
  'gov_parents'   => '',
  'cp_parents'    => '',
  'tel_parents'   => ''
];
?>
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

*{box-sizing:border-box}
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
.form{display:grid;grid-template-columns:160px 1fr;gap:18px}
@media (max-width:780px){.form{grid-template-columns:1fr}}

/* ---- Avatar ---- */
.avatar{display:flex;flex-direction:column;align-items:center;gap:10px;position:relative;width:140px}
.avatar .photo{
  width:140px;height:140px;border-radius:50%;border:3px solid #000;
  background:#f0f0f0 url('https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=300&q=60') center/cover no-repeat;
  position:relative;display:flex;align-items:center;justify-content:center
}
.avatar input[type="file"]{display:none}
.avatar .cam{
  position:absolute;right:-8px;bottom:-6px;width:38px;height:38px;border-radius:50%;
  background:#fff;border:2px solid #000;display:flex;align-items:center;justify-content:center;
  cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,.15);z-index:2
}
.avatar .cam i{color:#222}

/* ---- Inputs ---- */
.grid{display:grid;gap:12px;grid-template-columns:repeat(2,minmax(0,1fr))}
.grid-4{grid-template-columns:1fr 180px 120px 1fr}
@media (max-width:780px){.grid,.grid-4{grid-template-columns:1fr}}

.field{
  position:relative;display:flex;align-items:center;background:var(--input);
  border:1px solid var(--line);border-radius:10px;height:42px;padding:0 10px;gap:8px
}
/* === Téléphone pro (style capture) === */
.field.tel-field{
  background:#fff;               /* fond blanc comme la capture */
  border:1px solid var(--line);  /* #EBE9D7 */
  height:42px; padding:0 12px; gap:10px;
  display:flex; align-items:center; position:relative;
}

/* bouton drapeau rouge + chevron */
.tel-flag-btn{
  display:inline-flex; align-items:center; gap:8px;
  background:transparent; border:0; padding:0; cursor:pointer;
}
.tel-flag-chip{
  width:28px; height:28px; border-radius:6px;
  display:flex; align-items:center; justify-content:center;
  box-shadow:0 0 0 1px #ffffff inset;
}
.tel-flag-chip img{ width:20px; height:15px; border-radius:2px; object-fit:cover; }
.tel-flag-btn .chev{ font-size:12px; color:#2A2916; }

/* séparateur vertical fin */
.tel-vsep{ width:1px; height:22px; background:var(--line); }

/* menu pays dans le même champ */
.tel-country-menu{
  position:absolute; top:calc(100% + 6px); left:12px;
  background:#fff; border:1px solid var(--line); border-radius:10px;
  box-shadow:0 8px 20px rgba(0,0,0,.08); padding:6px; display:none; z-index:1000;
}
.tel-country-menu button{
  display:flex; align-items:center; gap:8px;
  border:none; background:#fff; padding:8px 10px; width:160px; border-radius:8px; cursor:pointer;
}
.tel-country-menu button:hover{ background:#f4f2ec; }

.field input,.field select{
  width:100%;height:100%;border:none;background:transparent;outline:none;color:var(--ink);font-size:14px;font-weight:600
}
.field input::placeholder{color:#b3af9f;font-weight:500}
.field .flag{width:22px;height:16px;border-radius:2px;border:1px solid #ddd;object-fit:cover}
.field .chev{color:#2A2916}
.hr{height:1px;background:var(--line);margin:14px 0}
.section-title{margin:6px 0 8px;font-weight:700; font-size: 15px}
/* ---- Labels de champs ---- */
.field-label{
  font-size:14px;
  line-height:1.4;
  color:black;
  font-weight:550;
  margin:2px 2px 8px;
}
.col{display:flex;flex-direction:column;gap:6px}

/* ---- Full width rows sous avatar ---- */
.phone{display:grid;grid-template-columns:64px 1fr;gap:10px}
.file-row{display:grid;grid-template-columns:1fr 140px;gap:10px;align-items:center}
.btn-import{border:none;border-radius:10px;height:42px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;background:#bdb694;color:#fff}
.full-row{grid-column:1 / -1;width:100%}
.full-row-inner{margin:0 10px}

/* ---- Country dropdown ---- */
.country-menu{position:absolute;top:calc(100% + 6px);left:0;background:#fff;border:1px solid var(--line);border-radius:10px;box-shadow:0 8px 20px rgba(0,0,0,.08);padding:6px;display:none;z-index:50}
.country-menu button{display:flex;align-items:center;gap:8px;border:none;background:#fff;padding:8px 10px;width:160px;border-radius:8px;cursor:pointer}
.country-menu button:hover{background:#f4f2ec}

/* ---- Select custom ---- */
.field.select-like{position:relative}
.field.select-like select{
  appearance:none;-webkit-appearance:none;-moz-appearance:none;background:transparent;border:none;outline:none;width:100%;
  height:100%;font-size:14px;font-weight:600;color:var(--ink);padding-right:40px
}
.field.select-like .chev{position:absolute;right:12px;pointer-events:none}
.field.select-like .split{position:absolute;right:36px;top:50%;transform:translateY(-50%);width:1px;height:60%;background:#d8d4c7}

/* ---- Blocks ---- */
.address-block{grid-column:1 / -1;display:grid;gap:12px;margin:0 10px}
.address-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
@media (max-width:780px){.address-row{grid-template-columns:1fr}}

/* ---- Actions ---- */
.form-actions{display:flex;gap:10px;justify-content:flex-end;margin-top:18px}
.btn{border:none;border-radius:10px;padding:10px 14px;font-weight:700;cursor:pointer}
.btn.save{background:var(--primary);color:#fff}
.btn.cancel{background:#eee}

/* === Champs verrouillés === */
.field.is-locked{background:#f3f3f3;border-color:#e0ded4;opacity:.9}
.field.is-locked input[readonly]{cursor:not-allowed;color:#555}
.field.is-locked select:disabled{cursor:not-allowed;color:#555}
.field.is-locked .chev{opacity:.4}

/* === Drawer password === */
.drawer-backdrop{position:fixed;inset:0;background:rgba(0,0,0,.35);opacity:0;pointer-events:none;transition:opacity .25s;z-index:100000;}
.drawer-backdrop.show{opacity:1;pointer-events:auto}
.drawer{
  position:fixed;top:0;right:0;height:100dvh;width:420px;max-width:92vw;background:#fff;
  box-shadow:-8px 0 24px rgba(0,0,0,.12);border-top-left-radius:12px;border-bottom-left-radius:12px;
  transform:translateX(110%);transition:transform .28s ease;z-index:100001;display:flex;flex-direction:column;
}
.drawer.open{transform:translateX(0)}
.drawer-header{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:12px 14px;border-bottom:1px solid #e9ecef;background:#f8f9fa;position:sticky;top:0;z-index:2;}
.drawer-title{font-size:16px;font-weight:700;margin:0}
.drawer-actions{display:flex;gap:8px;align-items:center}
.drawer-save{background:#d71920;color:#fff;border:none;border-radius:8px;padding:8px 14px;font-weight:700;cursor:pointer}
.drawer-close{background:#eee;border:none;border-radius:8px;width:32px;height:32px;font-size:18px;cursor:pointer}
.drawer-body{padding:16px;overflow:auto;flex:1}
.drawer .field{background:#fff;border-color:#e9ecef}
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
          <div class="field<?= $lockClass ?>" title="<?= $is_student_php?'Champ non modifiable':'' ?>">
            <input type="text" name="prenom" value="<?=htmlspecialchars($profil['prenom'])?>" placeholder="Prénom"<?= $roAttr ?>>
          </div>

          <!-- Nom -->
          <div class="field<?= $lockClass ?>" title="<?= $is_student_php?'Champ non modifiable':'' ?>">
            <input type="text" name="nom" value="<?=htmlspecialchars($profil['nom'])?>" placeholder="Nom"<?= $roAttr ?>>
          </div>

          <!-- Nationalité -->
          <div class="field select-like<?= $lockClass ?>" title="<?= $is_student_php?'Champ non modifiable':'' ?>">
            <select name="nationalite_display"<?= $selDis ?>>
              <option <?= $profil['nationalite']==='Tunisienne'?'selected':''; ?>>Tunisienne</option>
              <option <?= $profil['nationalite']==='Française'?'selected':''; ?>>Française</option>
              <option <?= $profil['nationalite']==='Marocaine'?'selected':''; ?>>Marocaine</option>
              <option <?= $profil['nationalite']==='Algérienne'?'selected':''; ?>>Algérienne</option>
            </select>
            <input type="hidden" name="nationalite" value="<?=htmlspecialchars($profil['nationalite'])?>">
            <span class="split" aria-hidden="true"></span>
            <i class="fa-solid fa-chevron-down chev" aria-hidden="true"></i>
          </div>

          <!-- CIN -->
          <div class="field<?= $lockClass ?>" title="<?= $is_student_php?'Champ non modifiable':'' ?>">
            <input type="text" name="cin" value="<?=htmlspecialchars($profil['cin'])?>" placeholder="CIN / Identifiant"<?= $roAttr ?>>
          </div>

          <!-- Emails (toujours éditables) -->
          <div class="field"><input type="email" name="email1" value="<?=htmlspecialchars($profil['email1'])?>" placeholder="Email 1"></div>
          <div class="field"><input type="email" name="email2" value="<?=htmlspecialchars($profil['email2'])?>" placeholder="Email 2"></div>
        </div>

       <!-- Téléphone (plein largeur) -->
<div class="full-row">
  <div class="full-row-inner">
    <label for="tel" class="field-label">Téléphone</label>
    <div class="field tel-field" id="telField">
      <button type="button" class="tel-flag-btn" id="telFlagBtn" aria-haspopup="listbox" aria-expanded="false">
        <span class="tel-flag-chip">
          <img id="telFlagImg" src="https://flagcdn.com/w20/tn.png" alt="TN">
        </span>
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

        <div class="hr" style="grid-column:1/-1"></div>

        <!-- ======= BLOCS SELON RÔLE ======= -->

        <?php if ($is_student_php): ?>
          <!-- ===== Adresse étudiant ===== -->
          <div class="section-title" style="grid-column:1 / -1">Adresse étudiant</div>
          <div class="address-block">
            <div class="field">
              <input type="text" name="adr_etud" value="<?=htmlspecialchars($profil['adr_etud'])?>" placeholder="Adresse étudiant">
            </div>
            <div class="address-row">
              <div class="field select-like">
                <select name="gov_etud" id="gov_etud">
                  <option value="" <?= $profil['gov_etud']===''?'selected':''; ?>>Gouvernorat</option>
                  <option <?= $profil['gov_etud']==='Ariana'?'selected':''; ?>>Ariana</option>
                  <option <?= $profil['gov_etud']==='Ben Arous'?'selected':''; ?>>Ben Arous</option>
                  <option <?= $profil['gov_etud']==='Manouba'?'selected':''; ?>>Manouba</option>
                  <option <?= $profil['gov_etud']==='Tunis'?'selected':''; ?>>Tunis</option>
                </select>
                <span class="split" aria-hidden="true"></span>
                <i class="fa-solid fa-chevron-down chev" aria-hidden="true"></i>
              </div>
              <div class="field">
                <input type="text" name="cp_etud" value="<?=htmlspecialchars($profil['cp_etud'])?>" placeholder="Code postal">
              </div>
            </div>
          </div>

          <div class="hr" style="grid-column:1/-1"></div>

          <!-- ===== Adresse parents ===== -->
          <div class="section-title" style="grid-column:1 / -1">Adresse parents</div>
          <div class="address-block">
            <div class="field">
              <input type="text" name="adr_parents" value="<?=htmlspecialchars($profil['adr_parents'])?>" placeholder="Adresse parents">
            </div>
            <div class="address-row">
              <div class="field select-like">
                <select name="gov_parents" id="gov_parents">
                  <option value="" <?= ($profil['gov_parents'] ?? '')===''?'selected':''; ?>>Gouvernorat</option>
                  <option <?= ($profil['gov_parents'] ?? '')==='Ariana'?'selected':''; ?>>Ariana</option>
                  <option <?= ($profil['gov_parents'] ?? '')==='Ben Arous'?'selected':''; ?>>Ben Arous</option>
                  <option <?= ($profil['gov_parents'] ?? '')==='Manouba'?'selected':''; ?>>Manouba</option>
                  <option <?= ($profil['gov_parents'] ?? '')==='Tunis'?'selected':''; ?>>Tunis</option>
                </select>
                <span class="split" aria-hidden="true"></span>
                <i class="fa-solid fa-chevron-down chev" aria-hidden="true"></i>
              </div>
              <div class="field">
                <input type="text" name="cp_parents" value="<?=htmlspecialchars($profil['cp_parents'])?>" placeholder="Code postal">
              </div>
            </div>

            <div class="phone" style="margin-top:4px;">
              <div class="field" id="countryBoxParents" style="position:relative;">
                <img class="flag" id="flagParents" src="https://flagcdn.com/w20/tn.png" alt="TN">
                <i class="fa-solid fa-chevron-down chev"></i>
                <div class="country-menu" id="countryMenuParents">
                  <button type="button" data-iso="tn"><img class="flag" src="https://flagcdn.com/w20/tn.png" alt=""> Tunisie</button>
                  <button type="button" data-iso="fr"><img class="flag" src="https://flagcdn.com/w20/fr.png" alt=""> France</button>
                  <button type="button" data-iso="ma"><img class="flag" src="https://flagcdn.com/w20/ma.png" alt=""> Maroc</button>
                  <button type="button" data-iso="dz"><img class="flag" src="https://flagcdn.com/w20/dz.png" alt=""> Algérie</button>
                </div>
              </div>
              <div class="field">
                <input type="text" name="tel_parents" value="<?=htmlspecialchars($profil['tel_parents'])?>" placeholder="+216 ...">
              </div>
            </div>
          </div>

<?php else: ?>
  <!-- ===== Informations académiques ===== -->
  <div class="section-title" style="grid-column:1 / -1">Informations académiques</div>
  <div class="address-block" id="acadBlock">
    <div class="address-row">
      <!-- Spécialité -->
      <div class="col">
        <label for="specialite_id" class="field-label">Spécialité</label>
        <div class="field select-like">
          <select name="specialite_id" id="specialite_id">
            <option value="">Spécialité</option>
            <!-- options injectées via JS -->
          </select>
          <span class="split" aria-hidden="true"></span>
          <i class="fa-solid fa-chevron-down chev" aria-hidden="true"></i>
        </div>
      </div>

      <!-- Grade académique -->
      <div class="col">
        <label for="grade_id" class="field-label">Grade académique</label>
        <div class="field select-like">
          <select name="grade_id" id="grade_id">
            <option value="">Grade académique</option>
            <!-- options injectées via JS -->
          </select>
          <span class="split" aria-hidden="true"></span>
          <i class="fa-solid fa-chevron-down chev" aria-hidden="true"></i>
        </div>
      </div>
    </div>

    <div class="address-row" style="margin-top:12px">
      <!-- Email académique -->
      <div class="col">
        <label for="acad_email" class="field-label">Email académique</label>
        <div class="field">
          <input type="email" name="acad_email" id="acad_email" placeholder="Email académique">
        </div>
      </div>

      <!-- Téléphone Professionnel -->
<div class="col">
  <label for="pro_tel" class="field-label">Téléphone Professionnel</label>

  <div class="field tel-field" id="proTelField">
    <button type="button" class="tel-flag-btn" id="proFlagBtn" aria-haspopup="listbox" aria-expanded="false">
      <span class="tel-flag-chip">
        <img id="proFlagImg" src="https://flagcdn.com/w20/tn.png" alt="TN">
      </span>
      <i class="fa-solid fa-chevron-down chev" aria-hidden="true"></i>
    </button>

    <span class="tel-vsep" aria-hidden="true"></span>

    <input type="text" name="pro_tel" id="pro_tel" placeholder="Téléphone Professionnel" style="padding-left:0">
    
    <!-- menu pays -->
    <div class="tel-country-menu" id="proTelMenu">
      <button type="button" data-iso="tn"><img class="flag" src="https://flagcdn.com/w20/tn.png" alt=""> Tunisie</button>
      <button type="button" data-iso="fr"><img class="flag" src="https://flagcdn.com/w20/fr.png" alt=""> France</button>
      <button type="button" data-iso="ma"><img class="flag" src="https://flagcdn.com/w20/ma.png" alt=""> Maroc</button>
      <button type="button" data-iso="dz"><img class="flag" src="https://flagcdn.com/w20/dz.png" alt=""> Algérie</button>
    </div>
  </div>
</div>

    </div>

    <div class="address-row" style="margin-top:12px">
      <!-- Adresse postale professionnelle -->
      <div class="col">
        <label for="acad_address" class="field-label">Adresse postale professionnelle</label>
        <div class="field">
          <input type="text" name="acad_address" id="acad_address" placeholder="Adresse postale professionnelle">
        </div>
      </div>

      <!-- Fonctions actuelles -->
      <div class="col">
        <label for="acad_functions" class="field-label">Fonctions actuelles</label>
        <div class="field">
          <input type="text" name="acad_functions" id="acad_functions" placeholder="Fonctions actuelles">
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>


        <div class="hr" style="grid-column:1/-1"></div>

        <!-- Actions -->
        <div class="form-actions" style="grid-column:1 / -1">
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

// =========== Helpers =============
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

// =========== Sélecteurs ===========
const form          = document.querySelector('form.card-body');
const prenomInput   = form.querySelector('input[name="prenom"]');
const nomInput      = form.querySelector('input[name="nom"]');
const natSelect     = form.querySelector('select[name="nationalite_display"]');
const natHidden     = form.querySelector('input[name="nationalite"]');
const cinInput      = form.querySelector('input[name="cin"]');
const email1Input   = form.querySelector('input[name="email1"]');
const email2Input   = form.querySelector('input[name="email2"]');
const telInput      = form.querySelector('input[name="tel"]');
const adrEtudInput  = form.querySelector('input[name="adr_etud"]');
const govEtudSelect = form.querySelector('select[name="gov_etud"]');
const cpEtudInput   = form.querySelector('input[name="cp_etud"]');
const adrParInput   = form.querySelector('input[name="adr_parents"]');
const govParSelect  = form.querySelector('select[name="gov_parents"]');
const cpParInput    = form.querySelector('input[name="cp_parents"]');
const telParInput   = form.querySelector('input[name="tel_parents"]');
const cvInput       = document.getElementById('cvInput');
const cvName        = document.getElementById('cvName');
const avatarInput   = document.getElementById('avatarInput');
const avatarPreview = document.getElementById('avatarPreview');

const gradeSel      = document.getElementById('grade_id');
const specSel       = document.getElementById('specialite_id');

// =========== Chargement du profil ===========
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
      console.warn('Impossible de charger les listes grade/spécialité', e);
    }
  }
}

async function loadProfile() {
  try {
    await loadRefsIfNeeded();

    const p = await wpGet('/profile');

    // Remplissage — informations personnelles
    prenomInput.value = p.prenom || '';
    nomInput.value    = p.nom || '';
    if (natSelect) natSelect.value = p.nationalite || 'Tunisienne';
    if (natHidden) natHidden.value = p.nationalite || 'Tunisienne';
    cinInput.value    = p.cin || '';
    email1Input.value = p.email1 || '';
    email2Input.value = p.email2 || '';
    telInput.value    = p.tel || '';
// Ancien
// cvName.value = (p.cv ? p.cv : '');

// Nouveau : n’afficher que le nom de fichier
if (p.cv) {
  try {
    const u = new URL(p.cv, window.location.origin); // tolère les URLs relatives/absolues
    const name = u.pathname.split('/').pop();
    cvName.value = name || p.cv;
    cvName.dataset.url = p.cv; // (optionnel) garder l’URL originale si besoin
  } catch (_) {
    // fallback si new URL() échoue (valeur non-URL) :
    cvName.value = p.cv.split('/').pop();
  }
} else {
  cvName.value = '';
}

    // Avatar
    if (p.avatar) avatarPreview.style.backgroundImage = `url('${p.avatar}')`;

    // Étudiant : adresses
    if (IS_STUDENT) {
      if (adrEtudInput)  adrEtudInput.value  = p.adr_etud || '';
      if (govEtudSelect) govEtudSelect.value = p.gov_etud || '';
      if (cpEtudInput)   cpEtudInput.value   = p.cp_etud || '';
      if (adrParInput)   adrParInput.value   = p.adr_parents || '';
      if (govParSelect)  govParSelect.value  = p.gov_parents || '';
      if (cpParInput)    cpParInput.value    = p.cp_parents || '';
      if (telParInput)   telParInput.value   = p.tel_parents || '';
    } else {
      // Bloc académique
      if (p.grade?.id && gradeSel) gradeSel.value = String(p.grade.id);
      if (p.specialite?.id && specSel) specSel.value = String(p.specialite.id);

      // academic_info peut être string JSON ou objet
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
    }
  } catch (e) {
    console.error(e);
    alert("Impossible de charger votre profil. Merci de vous reconnecter.");
  }
}

// =========== Enregistrement (PATCH JSON) ===========
form.addEventListener('submit', async (e) => {
  e.preventDefault();
document.querySelector('.btn.cancel')?.addEventListener('click', async () => {
  pendingAvatarFile = null;
  try {
    const p = await wpGet('/profile'); // recharge les données réelles
    if (p.avatar) avatarPreview.style.backgroundImage = `url('${p.avatar}${p.avatar_version ? ('?v='+p.avatar_version) : ''}')`;
  } catch (_) {}
});

  // 1) Si un avatar est en attente, on l’upload maintenant
  if (pendingAvatarFile) {
    try {
      const dataUrl = await fileToDataUrl(pendingAvatarFile);
      const res = await wpPost('/profile/avatar', {
        file_name: pendingAvatarFile.name,
        mime_type: pendingAvatarFile.type || 'image/jpeg',
        content: dataUrl
      });
      // (optionnel) rafraîchir le sidebar en live
      const sidebarImg = document.getElementById('sidebarAvatar');
      if (sidebarImg && res?.url) {
        sidebarImg.src = res.url + '?v=' + (res.version || Date.now());
      }
    } catch (err) {
      console.error(err);
      alert("Échec de l'upload avatar.");
      return; // on stoppe l’enregistrement si l’avatar échoue (à toi de voir)
    }
  }

  // 2) Ensuite, on envoie le PATCH du profil (comme avant)
  const payload = { /* ... ton payload existant ... */ };
  // ...
  try {
    await wpPatch('/profile', payload);
    alert('Profil enregistré avec succès ✅');
    pendingAvatarFile = null; // on purge l’état local après succès
  } catch (e2) {
    console.error(e2);
    alert('Échec de l’enregistrement. Vérifiez vos droits ou reconnectez-vous.');
  }
});

// =========== Upload Avatar ===========
// === Avatar: mode "différé" (preview uniquement) ===
let pendingAvatarFile = null;
document.getElementById('camTrigger').addEventListener('click', () => avatarInput.click());

avatarInput.addEventListener('change', (e) => {
  const f = e.target.files?.[0];
  if (!f) { pendingAvatarFile = null; return; }
  pendingAvatarFile = f; // ⟵ on mémorise le fichier, pas d'upload maintenant
  avatarPreview.style.backgroundImage = `url('${URL.createObjectURL(f)}')`;
});

// =========== Upload CV ===========
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

// =========== Dropdowns pays (perso & pro) ===========
const countryBox = document.getElementById('countryBox');
const countryMenu = document.getElementById('countryMenu');
const flagImg = document.getElementById('flag');
countryBox?.addEventListener('click', () => {
  if (!countryMenu) return;
  countryMenu.style.display = (countryMenu.style.display === 'block' ? 'none' : 'block');
});
countryMenu?.querySelectorAll('button').forEach(btn => {
  btn.addEventListener('click', () => {
    flagImg.src = `https://flagcdn.com/w20/${btn.dataset.iso}.png`;
    countryMenu.style.display = 'none';
  });
});
document.addEventListener('click', e => {
  if (countryBox && countryMenu && !countryBox.contains(e.target)) countryMenu.style.display = 'none';
});

// Pro phone
// === Téléphone Pro : menu pays intégré au champ ===
const proTelField = document.getElementById('proTelField');
const proFlagBtn  = document.getElementById('proFlagBtn');
const proFlagImg  = document.getElementById('proFlagImg');
const proTelMenu  = document.getElementById('proTelMenu');

function toggleProMenu(show){
  proTelMenu.style.display = (show ?? (proTelMenu.style.display !== 'block')) ? 'block' : 'none';
}

proFlagBtn?.addEventListener('click', (e) => {
  e.stopPropagation();
  toggleProMenu();
  proFlagBtn.setAttribute('aria-expanded', proTelMenu.style.display === 'block' ? 'true' : 'false');
});

proTelMenu?.querySelectorAll('button').forEach(btn => {
  btn.addEventListener('click', () => {
    const iso = btn.dataset.iso;
    proFlagImg.src = `https://flagcdn.com/w20/${iso}.png`;
    proFlagImg.alt = iso.toUpperCase();
    toggleProMenu(false);
    proFlagBtn.setAttribute('aria-expanded', 'false');
  });
});

document.addEventListener('click', (e) => {
  if (proTelField && !proTelField.contains(e.target)) {
    toggleProMenu(false);
    proFlagBtn?.setAttribute('aria-expanded', 'false');
  }
});
// === Téléphone perso : menu pays intégré au champ ===
const telField   = document.getElementById('telField');
const telFlagBtn = document.getElementById('telFlagBtn');
const telFlagImg = document.getElementById('telFlagImg');
const telMenu    = document.getElementById('telMenu');

function toggleTelMenu(show){
  telMenu.style.display = (show ?? (telMenu.style.display !== 'block')) ? 'block' : 'none';
}

telFlagBtn?.addEventListener('click', (e) => {
  e.stopPropagation();
  toggleTelMenu();
  telFlagBtn.setAttribute('aria-expanded', telMenu.style.display === 'block' ? 'true' : 'false');
});

telMenu?.querySelectorAll('button').forEach(btn => {
  btn.addEventListener('click', () => {
    const iso = btn.dataset.iso;
    telFlagImg.src = `https://flagcdn.com/w20/${iso}.png`;
    telFlagImg.alt = iso.toUpperCase();
    toggleTelMenu(false);
    telFlagBtn.setAttribute('aria-expanded', 'false');
  });
});

document.addEventListener('click', (e) => {
  if (telField && !telField.contains(e.target)) {
    toggleTelMenu(false);
    telFlagBtn?.setAttribute('aria-expanded', 'false');
  }
});

// =========== Drawer Password ===========
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

// Démarrage
loadProfile();
</script>

</body>
</html>
