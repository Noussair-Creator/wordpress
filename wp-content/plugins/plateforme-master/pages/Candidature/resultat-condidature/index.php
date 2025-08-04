<?php include __DIR__ . '/../layout/header_side.php'; ?>
   <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/css/main.css">
    <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/css/form.css">
    <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/css/fonts.css">
    <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/entretien/style.css">
   <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Signika:wght@300..700&display=swap"
        rel="stylesheet">

            <!-- Main Content -->
            <main class="main-content" style="background-color: unset;">
                <div class="Quicksand-bold " style="font-size: 20px; color: #2A2916; 
                font-family: 'Poppins';
                margin-bottom: 25px;">
                    Résultat des candidatures </div>
                <div class="container">
                    <table class="applications-table">
                        <thead>
                            <tr style="background: #ECEBE3;">
                                <th class="paragraphe Quicksand-bold">Master</th>
                                <th class="paragraphe Quicksand-bold">Etablissement</th>
                                <th class="paragraphe Quicksand-bold">Score</th>
                                <th class="paragraphe Quicksand-bold">Résultat</th>
                            </tr>
                        </thead>
                      
                        <tbody id="resultatsTbody"></tbody>

                    </table>


                </div>
              


            </main>
        </div>
    </div>


    <script src="/wp-content/plugins/plateforme-master/pages/Candidatur/js/form-validation.js"></script>
    <script src="/wp-content/plugins/plateforme-master/pages/Candidatur/js/navigation.js"></script>
    <script src="/wp-content/plugins/plateforme-master/pages/Candidatur/resultat-condidature/index.js"></script>


<script>
  window.PMSettings = {
    userId: <?php echo get_current_user_id(); ?>,
    nonce: "<?php echo wp_create_nonce('wp_rest'); ?>"
  };
</script>
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', () => {
  const tbody = document.getElementById('resultatsTbody');
  const userId = PMSettings.userId; // injecté via wp_localize_script ou <script>

  fetch(`/wp-json/plateforme-master/v1/resultats-candidatures/${userId}`, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
      'X-WP-Nonce': PMSettings.nonce
    }
  })
    .then(res => res.json())
    .then(data => {
      tbody.innerHTML = '';

      if (!Array.isArray(data) || data.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;">Aucun résultat disponible.</td></tr>';
        return;
      }

      data.forEach(row => {
        const master = row.intitule_master || '-';
        const etab = row.nom || '-';
        const score = row.score || '-';
        const code = row.code_resultat || '';
        const libelle = row.libelle || 'Non défini';

        let badgeClass = 'pending';
        if (code === 'refuse') badgeClass = 'processed refus';
        else if (code === 'liste_principale' || code === 'admis') badgeClass = 'processed';
        else if (code === 'liste_attente') badgeClass = 'pending';

        const tr = `
          <tr>
            <td class="paragraphe Quicksand-regular" style="color: #2A2916;">${master}</td>
            <td class="paragraphe Quicksand-regular" style="color: #2A2916;">${etab}</td>
            <td class="paragraphe Quicksand-regular" style="color: #2A2916;">${score}</td>
            <td class="paragraphe Quicksand-bold"><span class="status ${badgeClass}">${libelle}</span></td>
          </tr>
        `;

        tbody.insertAdjacentHTML('beforeend', tr);
      });
    })
    .catch(err => {
      console.error("Erreur chargement des résultats :", err);
    });
});

</script>
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