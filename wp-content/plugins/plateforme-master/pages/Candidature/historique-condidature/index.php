<?php include __DIR__ . '/../layout/header_side.php'; ?>
    <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/historique-condidature/style.css">
    <!-- <script src="/wp-content/plugins/plateforme-master/pages/Candidature/historique-condidature/index.js"></script> -->

            <!-- Main Content -->
            <main class="main-content" style="background-color: unset;">
                <div class="Quicksand-bold " 
                        style="
                        font-size: 20px;
                        color: #2A2916; 
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


    <!-- <script src="/wp-content/plugins/plateforme-master/pages/Candidature/js/form-validation.js"></script>
    <script src="/wp-content/plugins/plateforme-master/pages/Candidature/js/navigation.js"></script> -->
    <!-- <script src="/wp-content/plugins/plateforme-master/pages/Candidature/historique-condidature/index.js"></script> -->

    <!-- <script src="/wp-content/plugins/plateforme-master/pages/Candidature/js/main.js"></script> -->




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



var candidatures = [];
const itemsPerPage = 5;
let currentPage = 1;

function renderTable(page = 1) {
  const tableBody = document.querySelector('.applications-table tbody');
  tableBody.innerHTML = '';

  const start = (page - 1) * itemsPerPage;
  const end = start + itemsPerPage;
  const currentItems = candidatures.slice(start, end);

  currentItems.forEach(item => {
    const infos = item.infos;

    let statusClass = '';
    let statusText = '';

    switch (infos.etat) {
      case 'soumis':
        statusClass = 'pending';
        statusText = 'En instance';
        break;
      case 'traite':
      case 'accepté':
      case 'accepté définitif':
        statusClass = 'processed';
        statusText = 'Traitée';
        break;
      default:
        statusClass = 'pending';
        statusText = infos.etat;
    }

    const row = document.createElement('tr');
    row.innerHTML = `
      <td class="paragraphe Quicksand-regular" style="color: #2A2916;">${infos.intitule_master}</td>
      <td class="paragraphe Quicksand-regular" style="color: #2A2916;">${infos.institut_nom}</td>
      <td class="paragraphe Quicksand-bold"><span class="status ${statusClass}">${statusText}</span></td>
      <td>
        <button class="action-btn view-btn" data-id="${infos.candidature_id}">
          <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/eye.png" style="width: 20px; height: 14px;">
        </button>
      </td>
    `;

    tableBody.appendChild(row);
  });
}
function renderPagination() {
  const totalPages = Math.ceil(candidatures.length / itemsPerPage);
  const paginationContainer = document.querySelector('.pagination ul');
  paginationContainer.innerHTML = '';

  for (let i = 1; i <= totalPages; i++) {
    const li = document.createElement('li');
    li.innerHTML = `<a href="#" class="page-link ${i === currentPage ? 'active' : ''}">${i}</a>`;
    paginationContainer.appendChild(li);
  }
}

document.querySelector('.pagination').addEventListener('click', function (e) {
  if (e.target.classList.contains('page-link')) {
    e.preventDefault();
    currentPage = parseInt(e.target.textContent);
    renderTable(currentPage);
    renderPagination();
  }
});

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
    console.log("resultat" , result);
    candidatures = result.candidatures
    const listCondidature = result.candidatures

    const tableBody = document.querySelector('.applications-table tbody');
tableBody.innerHTML = ''; // Clear existing rows

listCondidature.forEach(item => {
  const infos = item.infos;

  // Format the status
  let statusClass = '';
  let statusText = '';

  switch (infos.etat) {
    case 'soumis':
      statusClass = 'pending';
      statusText = 'En instance';
      break;
    case 'traite':
    case 'accepté':
    case 'accepté définitif':
      statusClass = 'processed';
      statusText = 'Traitée';
      break;
    default:
      statusClass = 'pending';
      statusText = infos.etat;
  }

  const row = document.createElement('tr');
  row.innerHTML = `
    <td class="paragraphe Quicksand-regular" style="color: #2A2916;">${infos.intitule_master}</td>
    <td class="paragraphe Quicksand-regular" style="color: #2A2916;">${infos.institut_nom}</td>
    <td class="paragraphe Quicksand-bold"><span class="status ${statusClass}">${statusText}</span></td>
    <td>
      <button class="action-btn view-btn" data-id="${infos.candidature_id}">
        <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/eye.png" style="width: 20px; height: 14px;">
      </button>
    </td>
  `;

  tableBody.appendChild(row);


  const candidatures = result.candidatures;
const itemsPerPage = 5;
let currentPage = 1;

renderPagination()
});

    console.log('Candidat chargé avec succès');

  } catch (error) {
    console.error('Erreur fetch /candidats :', error);
  }



});



</script>

</body>

</html>