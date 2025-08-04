<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dépôt de candidature</title>
    <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/css/main.css">
    <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/css/form.css">
    <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/css/fonts.css">
    <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/historique-condidature/style.css">


    <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/css/sidebar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Signika:wght@300/wp-content/plugins/plateforme-master/pages/Candidature700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="app-container">
        <!-- Header -->
        <header class="header">
            <div class="header-content">
                <div class="logo-container">
                    <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/tn.png" style="width: 61px;height: 40px;">
                    <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/flag_tn.png" style="width: 55px;height: 36px;">
                    <div class="logo-content">
                        <div class="Quicksand-regular thinText">République Tunisienne <br> Ministère de l’Enseignement
                            Supérieur <br> et de la Recherche Scientifique</div>
                    </div>
                </div>

            </div>
        </header>
        <div class="sub-header-container">
            <div class="sub-header-content">
                <div class="profile-container">
                    <div class="profile-picture">
                    <img src="" id="imageUser" style="width: 100%;height: 100%;">
                    </div>
                    <div class="profile-content">
                    <div class="Quicksand-bold smallText" style="font-family: 'Signika';color: black;" id="displayNom">
                    </div>
                        <div class="Quicksand-regular paragraphe" style="font-family: 'Signika';color: black;">Espace
                            Candidature <br /> Master</div>
                        <div class="filled-btn Quicksand-bold paragraphe" style="font-family: 'Signika';color: black;">
                                    <a href="<?php echo wp_logout_url('/'); ?>" class="filled-btn Quicksand-bold paragraphe" style="font-family: 'Signika';color: black;">
                                Déconnexion
                            </a>
                    </div>
                    </div>
                </div>
                <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/logoback.jpeg" style="width: 284px;height: 129px;flex: none;">
            </div>

        </div>
        <div class="content-container">
            <!-- Sidebar -->
            <aside class="sidebar">
                <nav class="sidebar-nav">
                    <ul>
                        <li><a href="/wp-content/plugins/plateforme-master/pages/Candidature/depot-condidature/index.html" id="application-status">Dépôt de candidature</a></li>
                        <li  class="active"><a href="./index.html" id="application-history">Historique de candidature</a></li>
                        <li><a href="/wp-content/plugins/plateforme-master/pages/Candidature/resultat-condidature/index.html" id="results">Résultat</a></li>
                        <li><a href="/wp-content/plugins/plateforme-master/pages/Candidature/entretien/index.html" id="registration">Entretien</a></li>
                        <li><a href="/wp-content/plugins/plateforme-master/pages/Candidature/calendrier/index.html" id="confirmation">Calendrier</a></li>
                        <li><a href="/wp-content/plugins/plateforme-master/pages/Candidature/reclamation/index.html" id="reclamation">Réclamation</a></li>
                    </ul>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="main-content" style="background-color: unset;">
                <div class="Quicksand-bold " style="font-size: 20px; color: #2A2916; 
                font-family: 'Poppins';
                margin-bottom: 25px;">
                    Suivi des candidatures
                </div>
                <div class="container">
                    <table class="applications-table">
                        <thead>
                            <tr style="background: #ECEBE3;">
                                <th class="paragraphe Quicksand-bold">Master</th>
                                <th class="paragraphe Quicksand-bold">Etablissement</th>
                                <th class="paragraphe Quicksand-bold">Etat de candidature</th>
                                <th class="paragraphe Quicksand-bold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Master de recherche en
                                    chimie org...</td>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Faculté des Sciences de
                                    tunis</td>
                                <td class="paragraphe Quicksand-bold"><span class="status pending">En instance</span>
                                </td>
                                <td><button id="goto" class="action-btn view-btn"><img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/eye.png" style="width: 20px;
                                            height: 14px;"></i></button></td>
                            </tr>
                            <tr>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Modélisation en
                                    Hydraulique et Env...</td>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Ecole nationale
                                    d'ingénieurs de Tunis</td>
                                <td class="paragraphe Quicksand-bold"><span class="status processed">Traitée</span></td>
                                <td><button class="action-btn view-btn"><img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/eye.png" style="width: 20px;
                                        height: 14px;"></i></button></td>
                            </tr>
                            <tr>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Systèmes électriques de
                                    puissa/wp-content/plugins/plateforme-master/pages/Candidature. (SEP)</td>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Ecole nationale
                                    d'ingénieurs de Tunis</td>
                                <td class="paragraphe Quicksand-bold" style="color: #2A2916;"><span
                                        class="status processed">Traitée</span></td>
                                <td><button class="action-btn view-btn"><img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/eye.png" style="width: 20px;
                                                height: 14px;"></button></td>
                            </tr>
                        </tbody>
                    </table>


                </div>
                <div class="pagination">
                    <ul>
                        <li><a href="#" class="page-link">1</a></li>
                        <li><a href="#" class="page-link active">2</a></li>
                        <li><a href="#" class="page-link">3</a></li>
                        <li><span class="ellipsis" style=" width: 28px;
    height: 28px;
    font-size: 14px;
    font-family: 'Poppins';">..</span></li>
                        <li><a href="#" class="page-link">6</a></li>
                        <li><a href="#" class="page-link">7</a></li>
                    </ul>
                </div>
            </main>
        </div>
    </div>


    <script src="/wp-content/plugins/plateforme-master/pages/Candidature/js/form-validation.js"></script>
    <script src="/wp-content/plugins/plateforme-master/pages/Candidature/js/navigation.js"></script>
    <script src="/wp-content/plugins/plateforme-master/pages/Candidature/historique-condidature/index.js"></script>

    <script src="/wp-content/plugins/plateforme-master/pages/Candidature/js/main.js"></script>




    <?php
$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role = $roles[0] ?? null;
$user_id = $current_user->ID;
?>

<script>
  const PMSettings = {
    apiUrlCandidats: '<?= esc_url(rest_url("plateforme-master/v1/candidats")) ?>',
    nonce: '<?= wp_create_nonce("wp_rest") ?>',
    role: '<?= esc_js($role) ?>',
    userId: <?= (int) $user_id ?>
  };
</script>
<script>

document.addEventListener('DOMContentLoaded', async () => {
  try {
    const response = await fetch(PMSettings.apiUrlCandidats, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': PMSettings.nonce
      },
      credentials: 'include'
    });

    const result = await response.json();
    // Ensuite : passer les données à la fonction
    populateEtablissements(result);

    const institutId = result.candidatures?.[0]?.institut_id ?? null;
    const masterId =result.candidatures?.[0]?.master_id ?? null;
  
    if (institutId) {
        populateMastersRadios(institutId, masterId);
        }

    if (!response.ok || !result || !result.nom) {
      console.warn('Candidat non trouvé ou erreur :', result);
      return;
    }

        // ➕ Affichage du nom complet dans l'interface
        const displayNom = document.getElementById('displayNom');
        if (displayNom && result.nom && result.prenom) {
        displayNom.textContent = `${result.prenom} ${result.nom}`;
        }
   // ➕ Champs personnels
   document.getElementById('nom').value = result.nom || '';
    document.getElementById('nom-arabe').value = result.nom_ar || '';
    document.getElementById('prenom').value = result.prenom || '';
    document.getElementById('prenom-arabe').value = result.prenom_ar || '';
    document.getElementById('datenaissance').value = result.date_naissance || '';
    document.getElementById('lieunaissance').value = result.lieu_naissance || '';
    document.getElementById('lieunaissanceAr').value = result.lieu_naissance_ar || '';
    document.getElementById('nationalite').value = result.nationalite_fr_label || '';
    document.getElementById('nationnaliteAr').value = result.nationalite_ar_label || '';
   // Remplir les champs
document.getElementById('cin').value = result.cin || '';
document.getElementById('cne').value = result.passport || '';

// Afficher/masquer selon le cas
const cinInput = document.getElementById('cin');
const cneInput = document.getElementById('cne');
const cinContainer = cinInput.closest('.form-field'); // pour cacher le bloc <div>
const cneContainer = cneInput.closest('.form-field');

if (result.cin) {
  if (cneContainer) cneContainer.style.display = 'none';
  if (cinContainer) cinContainer.style.display = 'block';
} else if (result.passport) {
  if (cinContainer) cinContainer.style.display = 'none';
  if (cneContainer) cneContainer.style.display = 'block';
} else {
  // Si les deux sont vides, afficher les deux
  if (cinContainer) cinContainer.style.display = 'block';
  if (cneContainer) cneContainer.style.display = 'block';
}
    document.getElementById('email').value = result.email1 || '';
    document.getElementById('email2').value = result.email2 || '';
    document.querySelector('.phone-input2').value = result.telephone || '';
    document.getElementById('type').value = result.type_besoin || '';

    // ➕ Adresse (Français)
    document.getElementById('adresse').value = result.adresse_fr || '';
    document.getElementById('adresseAr').value = result.adresse_ar || '';
    document.getElementById('gouvernorat').value = result.gouvernorat_fr || '';
    document.getElementById('gouvernorat').dispatchEvent(new Event('change'));
    setTimeout(() => {
      document.getElementById('delegation').value = result.delegation_fr || '';
    }, 200);

    // ➕ Adresse (Arabe)
    document.getElementById('gouvernoratAr').value = result.gouvernorat_ar || '';
    document.getElementById('gouvernoratAr').dispatchEvent(new Event('change'));
    setTimeout(() => {
      document.getElementById('delegationAr').value = result.delegation_ar || '';
    }, 200);

    document.getElementById('code-postal').value = result.code_postal || '';

    // ➕ Besoin spécifique
    const besoinCheckbox = document.querySelector('.custom-checkbox input[type="checkbox"]');
    besoinCheckbox.checked = (result.besoin_specifique === 'oui');

    // ➕ Image utilisateur
    const imageUser = document.getElementById('imageUser');
    if (imageUser && result.photo_path) {
    imageUser.src = "/Candidature/" + result.photo_path;
    }



    console.log('Candidat chargé avec succès');

  } catch (error) {
    console.error('Erreur fetch /candidats :', error);
  }
});



</script>

</body>

</html>