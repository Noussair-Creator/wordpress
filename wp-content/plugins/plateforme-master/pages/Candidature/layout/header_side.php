<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dépôt de candidature</title>
    <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/css/main.css">
    <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/css/form.css">
    <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/css/fonts.css">

    <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/css/sidebar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Signika:wght@300..700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="app-container">





        <div class="sub-header-container">
            <header class="header">
                <div class="header-content">
                    <div class="logo-container">
                        <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/tn.png"
                            style="width: 61px;height: 40px;">
                        <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/flag_tn.png"
                            style="width: 55px;height: 36px;">
                        <div class="logo-content">
                            <div class="Quicksand-regular thinText">République Tunisienne <br> Ministère de
                                l’Enseignement
                                Supérieur <br> et de la Recherche Scientifique</div>
                        </div>
                    </div>

                </div>
            </header>
            <div class="sub-header-content">
                <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/subheaderimage.jpeg"
                    style="height: 100%;width: 48vw;    max-height: 168px;">
                <div class="profile-container">
                    <div class="profile-picture">
                        <img src="" id="imageUser" style="width: 100%;height: 100%;">
                    </div>
                    <div class="profile-content">
                        <div class="Quicksand-bold smallText" style="font-family: 'Signika';color: black;"
                            id="displayNom">
                        </div>
                        <div class="Quicksand-regular paragraphe" style="font-family: 'Signika';color: black;">Espace
                            Candidature <br /> Master</div>
                        <div class="filled-btn Quicksand-bold paragraphe" style="font-family: 'Signika';color: black;">
                            <a href="<?php echo wp_logout_url('/'); ?>" class="filled-btn Quicksand-bold paragraphe"
                                style="font-family: 'Signika';color: black;">
                                Déconnexion
                            </a>
                        </div>


                    </div>
                </div>
                <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/logoback.jpeg"
                    class="logo-back-page">
            </div>
            <div class="menu-responsive">
                <div class="Quicksand-bold paragraphe"> DÉPÔT DE CANDIDATURE</div>
                <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/toggle.png" class="open-menu">
            </div>
        </div>







        <!-- Header -->
        <!-- <header class="header">
            <div class="header-content">
                <div class="logo-container">
                    <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/tn.png"
                        style="width: 61px;height: 40px;">
                    <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/flag_tn.png"
                        style="width: 55px;height: 36px;">
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
                        <div class="Quicksand-bold smallText" style="font-family: 'Signika';color: black;"
                            id="displayNom">
                        </div>
                        <div class="Quicksand-regular paragraphe" style="font-family: 'Signika';color: black;">Espace
                            Candidature <br /> Master</div>
                        <div class="filled-btn Quicksand-bold paragraphe" style="font-family: 'Signika';color: black;">
                            <a href="<?php echo wp_logout_url('/'); ?>" class="filled-btn Quicksand-bold paragraphe"
                                style="font-family: 'Signika';color: black;">
                                Déconnexion
                            </a>
                        </div>


                    </div>
                </div>
                <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/logoback.jpeg"
                    style="width: 284px;height: 129px;flex: none;">
            </div>

        </div> -->
        <div class="content-container">
            <!-- Sidebar -->
            <aside class="sidebar">
                <nav class="sidebar-nav">
                    <ul>
                        <li class="active"><a href="/depot-candidature/" id="application-status">Dépôt de
                                candidature</a></li>

                        <li><a href="/historique-de-candidature/" id="application-history"  >Historique de
                                candidature</a></li>
                        <li><a href="/resultats-candidat" id="results" >Résultat</a></li>
                        <li><a href="/entretien-candidat" id="registration" >Entretien</a></li>
                        <li><a href="/calendrier" id="confirmation">Calendrier</a></li>
                        <li><a href="/reclamation" id="reclamation">Réclamation</a></li>
                    </ul>
                </nav>
            </aside>

       

            <div class="toggled-menu">
                <div class="Quicksand-bold close-menu">X</div>
                <div class="profile-container" style="display: flex !important;">
                    <div class="profile-picture">
                        <img src="" id="imageUser" style="width: 100%;height: 100%;">
                    </div>
                    <div class="profile-content">
                        <div id="displayNom" class="Quicksand-bold smallText" style="font-family: 'Signika';color: black;">
                        </div>
                        <div class="Quicksand-regular paragraphe" style="font-family: 'Signika';color: black;">Espace
                            pré-inscription <br /> Master</div>
                    </div>
                </div>
                <div class="menu-content">
                    <div class="active-resp item-menu"><a href="#" id="application-status">Dépôt de candidature</a>
                    </div>
                    <div class="line-menu-resp"></div>
                    <div class="active item-menu"><a href="/historique-de-candidature"
                            id="application-history">Historique de
                            candidature</a></div>
                    <div class="line-menu-resp"></div>

                    <div class="active item-menu"><a href="/resultats-candidat" id="results">Résultat</a>
                    </div>
                    <div class="line-menu-resp"></div>

                    <div class="active item-menu"><a href="/entretien-candidat" id="registration">Entretien</a>
                    </div>
                    <div class="line-menu-resp"></div>

                    <div class="active item-menu"><a href="/calendrier" id="confirmation">Calendrier</a>
                    </div>
                    <div class="line-menu-resp"></div>

                    <div class="active item-menu"><a href="/reclamation" id="reclamation">Réclamation</a>
                    </div>


                </div>
                <div class="logout">
                    <img src="../assets/download.jpeg" style="width: 18px;transform: rotate(90deg);">
                    <div class="Quicksand-bold paragraphe" style="color: #BF0404;">Déconnexion</div>
                </div>
            </div>




            <script>



                document.querySelector('.menu-responsive')?.addEventListener('click', () => {
                    const menu = document.querySelector('.toggled-menu');
                    if (menu) {
                        // Toggle visibility
                        menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
                    }
                });
                document.querySelector('.close-menu')?.addEventListener('click', () => {
                    const menu = document.querySelector('.toggled-menu');
                    if (menu) {
                        menu.style.display = 'none';
                    }
                });

  document.addEventListener("DOMContentLoaded", () => {
    const currentPath = window.location.pathname;

    document.querySelectorAll(".sidebar-nav ul li").forEach(li => {
      const link = li.querySelector("a");
      if (link && currentPath.includes(link.getAttribute("href"))) {
        li.classList.add("active");
      } else {
        li.classList.remove("active");
      }
    });
  });

  

document.addEventListener('DOMContentLoaded', async () => {
  try {

    // Appel API candidat
    const response = await fetch(PMSettings.apiUrlCandidats, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': PMSettings.nonce
      },
      credentials: 'include'
    });

    const result = await response.json();

    if (!response.ok || !result || !result.nom) {
      console.warn('Candidat non trouvé ou erreur :', result);
      return;
    }

    // ➕ Affichage image utilisateur
    const imageUser = document.getElementById('imageUser');
    if (imageUser && result.photo_path) {
      imageUser.src = "/Candidature/" + result.photo_path;
    }

    // ➕ Affichage nom
    const displayNom = document.getElementById('displayNom');
    if (displayNom && result.nom && result.prenom) {
      displayNom.textContent = `${result.prenom} ${result.nom}`;
    }

    console.log('✅ Candidat chargé avec succès');

  } catch (error) {
    console.error('❌ Erreur lors du chargement du candidat :', error);
  }
});

                
</script>