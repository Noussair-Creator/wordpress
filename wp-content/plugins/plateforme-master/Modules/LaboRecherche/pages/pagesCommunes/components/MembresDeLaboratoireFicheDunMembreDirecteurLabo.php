<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Poppins', sans-serif;
    }

    /* .content-wrapper {
        padding: 25px;
    } */

    .card {
        background: #fff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        border: none;
        position: relative;
    }

    .card h3 {
        font-size: 21px;
        margin-bottom: 14px;
        font-weight: bold;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
        color: #2A2916;
    }

    .card .dropdown {
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .kebab-button {
        background: transparent;
        border: none;
        font-size: 16px;
        color: #6c757d;
        cursor: pointer;
    }

    .styled-list {
        list-style: none;
        padding: 0;
        margin: 0;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
    }

    .styled-list li {
        padding: 15px 10px;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        color: #333;
        gap: 110px;
    }

    .styled-list li:last-child {
        border-bottom: none;
    }

    .styled-list strong {
        font-weight: 500;
        color: #6E6D55;
        min-width: 240px;
    }

    .styled-list span {
        display: flex;
        align-items: center;
        text-align: right;
    }

    .styled-list li a {
        text-decoration: none;
        font-weight: 500;
        color: black;
    }

    .styled-list li a[href^="mailto"] {
        color: #0d6efd;
        text-decoration: underline;
    }

    .profile-pic {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        margin-right: 12px;
        object-fit: cover;
    }

    .pdf-icon {
        color: #d93025;
        margin-right: 6px;
    }

    .status-active-icon {
        color: #28a745;
        font-size: 10px;
        margin-right: 8px;
    }

    /* Modal Styles with Specificity */
    #editMemberModal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: none;
        /* Hidden by default */
        justify-content: flex-end;
        /* Position popup to the right */
        align-items: center;
        z-index: 1000;
    }

    #editMemberModal.show {
        display: flex;
        /* Show the modal */
    }

    #editMemberModal .popup-container {
        background-color: white;
        width: 450px;
        height: 100%;
        box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        display: flex;
        flex-direction: column;
    }

    #editMemberModal .popup-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px 25px;
        box-shadow: 0px 5px 16px #0000001A;
        flex-shrink: 0;
    }

    #editMemberModal .popup-header h2 {
        font-size: 18px;
        margin: 0;
        color: #2A2916;
    }

    #editMemberModal .popup-header .header-actions {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    #editMemberModal .popup-form {
        padding: 25px;
        flex-grow: 1;
        overflow-y: auto;
    }

    #editMemberModal .btn-enregistrer {
        background-color: #c62828;
        color: white;
        border: none;
        padding: 8px 18px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
    }

    #editMemberModal .popup-form .form-group {
        margin-bottom: 20px;
    }

    #editMemberModal .popup-form .form-group label {
        display: block;
        font-weight: 600;
        color: #6E6D55;
        margin-bottom: 8px;
        font-size: 14px;
    }

    #editMemberModal .popup-form .form-group input[type="text"],
    #editMemberModal .popup-form .form-group input[type="email"],
    #editMemberModal .popup-form .form-group select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #b5af8e;
        border-radius: 7px;
        font-size: 14px;
        box-sizing: border-box;
    }
</style>


<div class="content-wrapper">
    <div class="card full-width">
        <!-- Dropdown Menu -->
       <!-- <div class="dropdown">
            <button class="btn kebab-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#" id="editBtn">Modifier</a></li>
                <li><a class="dropdown-item" href="#">Envoyer email</a></li>
            </ul>
        </div>-->

        <!-- Card Header -->
        <h3>Informations générales</h3>

        <!-- Details List -->
        <ul class="styled-list">
            <li>
                <strong>Nom complet :</strong>
                <span>
                    <img src="/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 435.png"
                        onerror="this.onerror=null;this.src='https://placehold.co/30x30/EFEFEF/AAAAAA?text=User';"
                        class="profile-pic" alt="Profile Picture">
                    Dr. Sarra Messaoudi
                </span>
            </li>
            <li><strong>Grade / Statut :</strong> <span>Maitre assistant</span></li>
            <li><strong>Spécialité :</strong> <span>Intelligence Artificielle</span></li>
            <li><strong>Email :</strong> <span><a href="mailto:sarra.messaoudi@utm.tn">sarra.messaoudi@utm.tn</a></span>
            </li>
            <li><strong>Téléphone :</strong> <span>+216 71 123 456</span></li>
            <li><strong>Date d'entrée au labo :</strong> <span>15/01/2022</span></li>
            <li><strong>Projet associé :</strong> <span>BCI-Learn, ARUX</span></li>
            <li><strong>Encadrements :</strong> <span>2 thèses, 1 mastère</span></li>
            <li>
                <strong>CV / Dossier :</strong>
                <span>
                    <a href="#">

                        <!-- <i class="fas fa-file-pdf pdf-icon"></i> -->

                        <img class="pdf-icon" width="20px"
                            src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png"
                            alt="pdf-svgrepo-com (2).png">
                        CV_Sarra_Messaoudi.pdf
                    </a>
                </span>
            </li>
            <li>
                <strong>Etat :</strong>
                <span><i class="fas fa-circle status-active-icon"></i>Actif</span>
            </li>
        </ul>
    </div>
</div>

<!-- Edit Member Modal -->
<div class="modal-overlay" id="editMemberModal">
    <div class="popup-container">
        <div class="popup-header">
            <h2>Modifier le membre</h2>
            <div class="header-actions">
                <button class="btn-enregistrer" id="saveEditMemberBtn">Enregistrer</button>
            </div>
        </div>
        <form class="popup-form">
            <div class="form-group">
                <label>Nom & Prénom</label>
                <input type="text" value="Dr. Sarra Messaoudi">
            </div>
            <div class="form-group">
                <label>Rôle</label>
                <select>
                    <option>Post-Doc</option>
                    <option selected></option>
                </select>
            </div>
            <div class="form-group">
                <label>Projet Liés</label>
                <select>
                    <option>Stockage Cloud Médical</option>
                    <option selected>BCI-Learn, ARUX</option>
                </select>
            </div>
            <div class="form-group">
                <label>Spécialité</label>
                <select>
                    <option>Interfaces Cerveau-Machine</option>
                    <option selected>Intelligence Artificielle</option>
                </select>
            </div>
        </form>
    </div>
</div>


<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



<!-- Custom JS for Modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editBtn = document.getElementById('editBtn');
        const editModal = document.getElementById('editMemberModal');
        const saveBtn = document.getElementById('saveEditMemberBtn');

        // Function to show the modal
        const showModal = () => {
            editModal.classList.add('show');
        };

        // Function to hide the modal
        const hideModal = () => {
            editModal.classList.remove('show');
        };

        // Event listener for the edit button
        editBtn.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior
            showModal();
        });

        // Event listener for the save button
        saveBtn.addEventListener('click', function () {
            // Add save logic here if needed
            hideModal();
        });

        // Event listener to close modal when clicking on the overlay
        editModal.addEventListener('click', function (event) {
            // We check if the clicked element is the overlay itself, not a child
            if (event.target === editModal) {
                hideModal();
            }
        });
    });
</script>


<?php
$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role  = $roles[0] ?? '';
$user_id = get_current_user_id();
?>
<script>
  window.PMSettings = {
    restUrl: "<?= esc_url( rest_url() ) ?>",          // ex: https://utmresearchplatform.clickerp.tn/wp-json/
    nonce: "<?= wp_create_nonce('wp_rest') ?>",       // nonce pour X-WP-Nonce
    role: "<?= esc_js( $role ) ?>",                   // rôle principal de l’utilisateur
    userId: <?= (int) $user_id ?>                     // ID WP de l’utilisateur
  };
</script>
<script>

document.addEventListener("DOMContentLoaded", async function(){
  const params = new URLSearchParams(window.location.search);
  const membreId = params.get("id");
  if (!membreId) return;

  try {
    const res = await fetch(
      `${window.PMSettings.restUrl}plateforme-recherche/v1/membre/${membreId}?with_user=true`,
      { headers: { "X-WP-Nonce": window.PMSettings.nonce } }
    );
    if (!res.ok) throw new Error("Erreur API membre");
    const m = await res.json();

    const ul = document.querySelector(".styled-list");
    if (!ul) return;

    // choisir la photo → meta profile_photo ou fallback
    const photoUrl =
      m.profile_photo && m.profile_photo.trim() !== ""
        ? m.profile_photo
        : "/wp-content/plugins/plateforme-master/images/icons/Groupe de masques 435.png";

    ul.innerHTML = `
      <li>
        <strong>Nom complet :</strong>
        <span>
          <img src="${photoUrl}"
            onerror="this.onerror=null;this.src='https://placehold.co/30x30/EFEFEF/AAAAAA?text=User';"
            class="profile-pic" alt="Profile Picture">
          ${m.user_display_name || "—"}
        </span>
      </li>
      <li><strong>Grade / Statut :</strong> <span>${m.grade || "—"}</span></li>
      <li><strong>Spécialité :</strong> <span>${m.specialite || "—"}</span></li>
      <li><strong>Email :</strong> <span><a href="mailto:${m.user_email}">${m.user_email || "—"}</a></span></li>
      <li><strong>Téléphone :</strong> <span>${m.tel|| "—"}</span></li>
      <li><strong>Date d'entrée au labo :</strong> <span>${formatDate(m.created_at) || "—"}</span></li>
      <li><strong>Projet associé :</strong> <span>${m.projets_lies || "—"}</span></li>
      <li><strong>Encadrements :</strong> <span>${m.encadrements || "—"}</span></li>
      <li>
        <strong>CV / Dossier :</strong>
        <span>
          ${m.cv_url ? `<a href="${m.cv_url}" target="_blank">
            <img class="pdf-icon" width="20px"
              src="/wp-content/plugins/plateforme-master/images/icons/pdf-svgrepo-com (2).png" alt="CV">
            ${m.cv_url.split('/').pop()}
          </a>` : "—"}
        </span>
      </li>
      <li>
        <strong>Etat :</strong>
        <span>
          ${
            m.account_status === "approved"
              ? `<i class="fas fa-circle status-active-icon"></i> Actif`
              : `<i class="fas fa-circle status-inactive-icon"></i> Inactif`
          }
        </span>
      </li>
    `;
  } catch (e) {
    console.error("Erreur chargement membre :", e);
  }
});
function formatDate(sqlDate) {
  if (!sqlDate) return '';

  // Extraire uniquement la partie date (avant l'heure)
  const [datePart] = sqlDate.split(' '); // "2025-09-10"
  const [year, month, day] = datePart.split('-'); // ["2025","09","10"]

  return `${day}/${month}/${year}`; // "10/09/2025"
}

// Exemple d'utilisation
const rawDate = "2025-09-10 10:47:05";
console.log(formatDate(rawDate)); // 👉 "10/09/2025"

</script>
