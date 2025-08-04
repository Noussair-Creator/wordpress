<?php include __DIR__ . '/../layout/header_side.php'; ?>
    <link rel="stylesheet" href="/wp-content/plugins/plateforme-master/pages/Candidature/calendrier/style.css">
    <script src="/wp-content/plugins/plateforme-master/pages/Candidature/calendrier/index.js"></script>




 <main class="main-content" style="background-color: unset;">
                <div class="Quicksand-bold " style="font-size: 20px; color: #2A2916; 
                font-family: 'Poppins';
                margin-bottom: 25px;">
                    Session Master </div>

                <div style="display: flex;align-items: center;justify-content: space-between;margin-bottom: 40px;">
                    <div style="display: flex;align-items: center;gap: 40px;">
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
                    <div style="display: flex;flex-direction: column;gap: 8px;">
                        <label style="font: normal normal medium 14px/21px Poppins;
letter-spacing: 0px;
color: #6E6D55;" class="Quicksand-regular" for="etablissement">Session</label>

                        <div class="academic-roles" style="padding: 0;margin-top: 8px;">
                            <label class="role-option">
                                <input type="radio" name="academic-role" value="enseignant">
                                <span class="radio-label">Session 1</span>
                            </label>
                            <label class="role-option">
                                <input type="radio" name="academic-role" value="mastere">
                                <span class="radio-label">Session 2</span>
                            </label>
                        </div>
                    </div>
                    </div>
               
                    <button type="button" id="next-btn" class="btn btn-primary" style="width: 128px;">FILTRER</button>
                </div>
                <div class="container">
                    <table class="applications-table">
                        <thead>
                            <tr style="background: #ECEBE3;">
                                <th class="paragraphe Quicksand-bold">Nom du session</th>
                                <th class="paragraphe Quicksand-bold">Date d'ouverture</th>
                                <th class="paragraphe Quicksand-bold">Date de fermeture</th>
                                <th class="paragraphe Quicksand-bold">Entretien</th>
                                <th class="paragraphe Quicksand-bold">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Systèmes de communications (sys.com)</td>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">27 janvier 2025 00:00</td>
                               
                                                               <td class="paragraphe Quicksand-regular" style="color: #2A2916;">01 avril 2025 23:59</td>

                                <td class="paragraphe Quicksand-bold" style="padding-left: 65px;"><span
                                        class="status processed" style="background:#BF0404;color: white;">Non</span>
                                </td>


                                <td><button id="goto" class="action-btn view-btn"><img src="../assets/eye.png" style="width: 20px;
                                            height: 14px;"></i></button></td>
                            </tr>
                            <tr>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Modélisation en hydraulique et environnement (MHE)</td>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">27 janvier 2025 00:00</td>
                                                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">01 avril 2025 23:59</td>

                                <td class="paragraphe Quicksand-bold"><span class="status processed"
                                        style="width: 150px;">Invité a un
                                        entretien</span>
                                </td>

                                <td><button class="action-btn view-btn"><img src="../assets/eye.png" style="width: 20px;
                                        height: 14px;"></i></button></td>
                            </tr>
                            <tr>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">Modélisation mathématique et calcul scientifique (MMCS)</td>
                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">27 janvier 2025 00:00</td>
                                                                <td class="paragraphe Quicksand-regular" style="color: #2A2916;">01 avril 2025 23:59</td>

                                <td class="paragraphe Quicksand-bold" style="padding-left: 65px;"><span
                                        class="status processed" style="background:#BF0404;color: white;">Non</span>
                                </td>
                                <td><button class="action-btn view-btn"><img src="../assets/eye.png" style="width: 20px;
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
    font-family: 'Poppins';">...</span></li>
                        <li><a href="#" class="page-link">6</a></li>
                        <li><a href="#" class="page-link">7</a></li>
                    </ul>
                </div>
            </main>


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

    </body>

</html>