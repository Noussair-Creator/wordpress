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
                    Liste des entretiens </div>

               <!-- <div style="display: flex;align-items: center;justify-content: space-between;margin-bottom: 40px;">
                    <div class="form-field" style="width: 50%;flex: none;">
                        <label for="etablissement">Etablissement<span class="required">*</span></label>
                        <div class="select-wrapper">
                            <select id="etablissement" name="etablissement" required>
                                <option value="">-- Sélectionner --</option>
                                <option value="Ariana">Ecole nationale d'ingénieurs de Tunis</option>
                            </select>
                        </div>
                        <span class="error-message"></span>
                    </div>
                    <button type="button" id="next-btn" class="btn btn-primary" style="width: 128px;">FILTRER</button>
                </div>-->
                <div class="container">
                    <table class="applications-table">
                        <thead>
                            <tr style="background: #ECEBE3;">
                                <th class="paragraphe Quicksand-bold">Etablissement</th>
                                <th class="paragraphe Quicksand-bold">Master</th>
                                <th class="paragraphe Quicksand-bold">Entretien</th>
                                <th class="paragraphe Quicksand-bold">Contenu</th>
                                <th class="paragraphe Quicksand-bold">Date</th>
                                <th class="paragraphe Quicksand-bold">Action</th>
                            </tr>
                        </thead>
                        <!--<tbody>
                            <tr>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Ecole nationale
                                    d'ingénieurs de Tunis ( ENIT )</td>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Systèmes de
                                    communications (sys.com)</td>
                                <td class="paragraphe Quicksand-bold"><span class="status processed"
                                        style="width: 150px;">Invité a un
                                        entretien</span>
                                </td>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">-</td>


                                <td><button id="goto" class="action-btn view-btn"><img src="../assets/eye.png" style="width: 20px;
                                            height: 14px;"></i></button></td>
                            </tr>
                            <tr>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Ecole nationale
                                    d'ingénieurs de Tunis ( ENIT )</td>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Modélisation en
                                    hydraulique et environnement (MHE)</td>
                                <td class="paragraphe Quicksand-bold"><span class="status processed"
                                        style="width: 150px;">Invité a un
                                        entretien</span>
                                </td>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">may 27,2023 13:30</td>

                                <td><button class="action-btn view-btn"><img src="../assets/eye.png" style="width: 20px;
                                        height: 14px;"></i></button></td>
                            </tr>
                            <tr>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Ecole nationale
                                    d'ingénieurs de Tunis ( ENIT )</td>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Modélisation
                                    mathématique et calcul scientifique (MMCS)</td>
                                <td class="paragraphe Quicksand-bold" style="padding-left: 65px;"><span
                                        class="status processed" style="background:#BF0404;color: white;">Non</span>
                                </td>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">-</td>
                                <td><button class="action-btn view-btn"><img src="../assets/eye.png" style="width: 20px;
                                                height: 14px;opacity: 0.5;"></button></td>
                            </tr>
                        </tbody>-->

                        <tbody id="entretiensTbody"></tbody>

                    </table>


                </div>
                <!--
                <div class="pagination">
                    <ul>
                        <li><a href="#" class="page-link">1</a></li>
                        <li><a href="#" class="page-link active">2</a></li>
                        <li><a href="#" class="page-link">3</a></li>
                        <li><span class="ellipsis" style=" width: 28px;
                            height: 28px;
                            font-size: 14px;
                            font-family: 'Poppins';">...</span></li>
                        <li><a href="#" class="page-link">6</a></li>
                        <li><a href="#" class="page-link">7</a></li>
                    </ul>
                </div>
                -->

            </main>
        </div>
    </div>


    <script src="/wp-content/plugins/plateforme-master/pages/Candidature/js/form-validation.js"></script>
    <script src="/wp-content/plugins/plateforme-master/pages/Candidature/js/navigation.js"></script>
    <script src="/wp-content/plugins/plateforme-master/pages/Candidature/entretien/index.js"></script>

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
  const tbody = document.getElementById('entretiensTbody');
  const userId = PMSettings.userId; // fourni via wp_localize_script

  fetch(`/wp-json/plateforme-master/v1/entretiens-par-candidat/${userId}`, {
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
        tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;">Aucun entretien trouvé.</td></tr>';
        return;
      }

      data.forEach(entretien => {
        const date = entretien.date_entretien || '-';
        const heure = entretien.heure_entretien || '';
        const contenu = entretien.contenu || '-';
        const master = entretien.intitule_master || '';
        const etab = entretien.nom|| '';
        const etat = entretien.etat === 'prévu'
          ? `<span class="status processed" style="width: 150px;">Invité à un entretien</span>`
          : `<span class="status processed" style="background:#BF0404;color: white;">Non</span>`;

        const viewBtn = entretien.date_entretien
          ? `<button class="action-btn view-btn"><img src="../assets/eye.png" style="width:20px;height:14px;"></button>`
          : `<button class="action-btn view-btn"><img src="../assets/eye.png" style="width:20px;height:14px;opacity: 0.5;"></button>`;

        const tr = `
          <tr>
            <td class="paragraphe Quicksand-regular" style="color: #2A2916;">${etab}</td>
            <td class="paragraphe Quicksand-regular" style="color: #2A2916;">${master}</td>
            <td class="paragraphe Quicksand-bold">${etat}</td>
            <td class="paragraphe Quicksand-regular" style="color: #2A2916;">${contenu}</td>
            <td class="paragraphe Quicksand-regular" style="color: #2A2916;">${date} ${heure}</td>
            <td>${viewBtn}</td>
          </tr>
        `;

        tbody.insertAdjacentHTML('beforeend', tr);
      });
    })
    .catch(err => {
      console.error("Erreur chargement des entretiens :", err);
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