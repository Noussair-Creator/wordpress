<?php
// --- Démo : valeurs par défaut
$profil = [
  'nom'           => 'Ahlem Ben Amor',
  'prenom'        => 'Ahlem Ben Amor',
  'nationalite'   => 'Tunisienne',
  'tel_country'   => 'tn',
  'tel'           => '+216 23 44 55 76',
  'email1'        => 'ahlem@gmail.com',
  'email2'        => '',
  'cin'           => '06974593',
  'cv'            => 'Resume.pdf',
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
.field input,.field select{
  width:100%;height:100%;border:none;background:transparent;outline:none;color:var(--ink);font-size:14px;font-weight:600
}
.field input::placeholder{color:#b3af9f;font-weight:500}
.field .flag{width:22px;height:16px;border-radius:2px;border:1px solid #ddd;object-fit:cover}
.field .chev{color:#2A2916}
.hr{height:1px;background:var(--line);margin:14px 0}
.section-title{margin:6px 0 8px;font-weight:700; font-size: 15px}

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

/* ---- Address blocks ---- */
.address-block{grid-column:1 / -1;display:grid;gap:12px;margin:0 10px}
.address-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
@media (max-width:780px){.address-row{grid-template-columns:1fr}}

/* ---- Actions ---- */
.form-actions{display:flex;gap:10px;justify-content:flex-end;margin-top:18px}
.btn{border:none;border-radius:10px;padding:10px 14px;font-weight:700;cursor:pointer}
.btn.save{background:var(--primary);color:#fff}
.btn.cancel{background:#eee}

/* === Champs verrouillés (inchangeables) === */
.field.is-locked{background:#f3f3f3;border-color:#e0ded4;opacity:.9}
.field.is-locked input[readonly]{cursor:not-allowed;color:#555}
.field.is-locked select:disabled{cursor:not-allowed;color:#555}
.field.is-locked .chev{opacity:.4}

/* ===================================================================== */
/* === DRAWER PASSWORD (overlay + panneau, très haut z-index)         === */
.drawer-backdrop{
  position:fixed;inset:0;background:rgba(0,0,0,.35);opacity:0;pointer-events:none;
  transition:opacity .25s;z-index:100000;
}
.drawer-backdrop.show{opacity:1;pointer-events:auto}
.drawer{
  position:fixed;top:0;right:0;height:100dvh;width:420px;max-width:92vw;background:#fff;
  box-shadow:-8px 0 24px rgba(0,0,0,.12);border-top-left-radius:12px;border-bottom-left-radius:12px;
  transform:translateX(110%);transition:transform .28s ease;z-index:100001;display:flex;flex-direction:column;
}
.drawer.open{transform:translateX(0)}
.drawer-header{
  display:flex;align-items:center;justify-content:space-between;gap:12px;
  padding:12px 14px;border-bottom:1px solid #e9ecef;background:#f8f9fa;position:sticky;top:0;z-index:2;
}
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

    <form class="card-body" method="post" action="save_profile.php" enctype="multipart/form-data">
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
          <!-- Prénom (verrouillé) -->
          <div class="field is-locked" title="Champ non modifiable">
            <input type="text" name="prenom" value="<?=htmlspecialchars($profil['prenom'])?>" placeholder="Prénom" readonly aria-readonly="true">
          </div>

          <!-- Nom (verrouillé) -->
          <div class="field is-locked" title="Champ non modifiable">
            <input type="text" name="nom" value="<?=htmlspecialchars($profil['nom'])?>" placeholder="Nom" readonly aria-readonly="true">
          </div>

          <!-- Nationalité (verrouillé) -->
          <div class="field select-like is-locked" title="Champ non modifiable">
            <select name="nationalite_display" disabled aria-disabled="true">
              <option <?= $profil['nationalite']==='Tunisienne'?'selected':''; ?>>Tunisienne</option>
              <option <?= $profil['nationalite']==='Française'?'selected':''; ?>>Française</option>
              <option <?= $profil['nationalite']==='Marocaine'?'selected':''; ?>>Marocaine</option>
              <option <?= $profil['nationalite']==='Algérienne'?'selected':''; ?>>Algérienne</option>
            </select>
            <!-- On envoie quand même la valeur au serveur -->
            <input type="hidden" name="nationalite" value="<?=htmlspecialchars($profil['nationalite'])?>">
            <span class="split" aria-hidden="true"></span>
            <i class="fa-solid fa-chevron-down chev" aria-hidden="true"></i>
          </div>

          <!-- CIN (verrouillé) -->
          <div class="field is-locked" title="Champ non modifiable">
            <input type="text" name="cin" value="<?=htmlspecialchars($profil['cin'])?>" placeholder="CIN / Identifiant" readonly aria-readonly="true">
          </div>

          <!-- Emails (modifiables) -->
          <div class="field"><input type="email" name="email1" value="<?=htmlspecialchars($profil['email1'])?>" placeholder="Email 1"></div>
          <div class="field"><input type="email" name="email2" value="<?=htmlspecialchars($profil['email2'])?>" placeholder="Email 2"></div>
        </div>

        <!-- Téléphone (plein largeur) -->
        <div class="full-row">
          <div class="full-row-inner">
            <div class="phone">
              <div class="field" id="countryBox" style="position:relative;">
                <img class="flag" id="flag" src="https://flagcdn.com/w20/tn.png" alt="TN">
                <i class="fa-solid fa-chevron-down chev"></i>
                <div class="country-menu" id="countryMenu">
                  <button type="button" data-iso="tn"><img class="flag" src="https://flagcdn.com/w20/tn.png" alt=""> Tunisie</button>
                  <button type="button" data-iso="fr"><img class="flag" src="https://flagcdn.com/w20/fr.png" alt=""> France</button>
                  <button type="button" data-iso="ma"><img class="flag" src="https://flagcdn.com/w20/ma.png" alt=""> Maroc</button>
                  <button type="button" data-iso="dz"><img class="flag" src="https://flagcdn.com/w20/dz.png" alt=""> Algérie</button>
                </div>
              </div>
              <div class="field"><input type="text" name="tel" value="<?=htmlspecialchars($profil['tel'])?>" placeholder="+216 ..."></div>
            </div>
          </div>
        </div>

        <!-- Fichier (plein largeur) -->
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

          <!-- Téléphone parents (plein largeur) -->
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

<!-- ================= Drawer Password (au-dessus de tout) ================= -->
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
// ------- Avatar preview + click cam
const avatarInput = document.getElementById('avatarInput');
const avatarPreview = document.getElementById('avatarPreview');
document.getElementById('camTrigger').addEventListener('click', () => avatarInput.click());
avatarInput.addEventListener('change', e => {
  const f = e.target.files?.[0];
  if (!f) return;
  const url = URL.createObjectURL(f);
  avatarPreview.style.backgroundImage = `url('${url}')`;
});

// ------- Country dropdown (phone)
const countryBox = document.getElementById('countryBox');
const countryMenu = document.getElementById('countryMenu');
const flagImg = document.getElementById('flag');
countryBox.addEventListener('click', () => countryMenu.style.display = (countryMenu.style.display === 'block' ? 'none' : 'block'));
countryMenu.querySelectorAll('button').forEach(btn => {
  btn.addEventListener('click', () => {
    flagImg.src = `https://flagcdn.com/w20/${btn.dataset.iso}.png`;
    countryMenu.style.display = 'none';
  });
});
document.addEventListener('click', e => { if (!countryBox.contains(e.target)) countryMenu.style.display = 'none'; });

// ------- Country dropdown (parents)
const countryBoxParents = document.getElementById('countryBoxParents');
const countryMenuParents = document.getElementById('countryMenuParents');
const flagParents = document.getElementById('flagParents');
countryBoxParents.addEventListener('click', () => countryMenuParents.style.display = (countryMenuParents.style.display === 'block' ? 'none' : 'block'));
countryMenuParents.querySelectorAll('button').forEach(btn => {
  btn.addEventListener('click', () => {
    flagParents.src = `https://flagcdn.com/w20/${btn.dataset.iso}.png`;
    countryMenuParents.style.display = 'none';
  });
});
document.addEventListener('click', e => { if (!countryBoxParents.contains(e.target)) countryMenuParents.style.display = 'none'; });

// ------- Fichier CV
const cvInput = document.getElementById('cvInput');
const cvName = document.getElementById('cvName');
document.querySelector('.btn-import').addEventListener('click', () => cvInput.click());
cvInput.addEventListener('change', e => { const f = e.target.files?.[0]; if (f) cvName.value = f.name; });

// ------- Drawer Password
const btnOpenPwd = document.getElementById('btnOpenPwd');
const btnSavePwd = document.getElementById('btnSavePwd');
const drawer = document.getElementById('pwdDrawer');
const backdrop = document.getElementById('pwdBackdrop');

function openDrawer() {
  drawer.classList.add('open');
  backdrop.classList.add('show');
  document.body.style.overflow = 'hidden';
}

function closeDrawer() {
  drawer.classList.remove('open');
  backdrop.classList.remove('show');
  document.body.style.overflow = '';
}

btnOpenPwd.addEventListener('click', openDrawer);
backdrop.addEventListener('click', closeDrawer);

// Enregistrer : validation simple + fermeture
btnSavePwd.addEventListener('click', () => {
  const oldP = document.getElementById('oldPassword').value.trim();
  const newP = document.getElementById('newPassword').value.trim();
  const cfmP = document.getElementById('confirmPassword').value.trim();

  if (!oldP || !newP || !cfmP) { alert('Veuillez remplir tous les champs.'); return; }
  if (newP.length < 6) { alert('Le nouveau mot de passe doit contenir au moins 6 caractères.'); return; }
  if (newP !== cfmP) { alert('Les mots de passe ne correspondent pas.'); return; }

  // TODO: fetch/ajax vers ton endpoint pour changer le mot de passe
  closeDrawer(); // Close the drawer after successful validation
});

// Échap pour fermer
document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && drawer.classList.contains('open')) closeDrawer(); });
</script>
</body>
</html>
