<?php
$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role = $roles[0] ?? null;
$user_id = $current_user->ID;
?>

<script>
  const PMSettings = {
    apiUrl: '<?= esc_url(rest_url("plateforme-master/v1/masters-by-user")) ?>',
    apiUrlAllMasters: '<?= esc_url(rest_url("plateforme-master/v1/masters-all")) ?>',
    apiUrlByCoordinateur: '<?= esc_url(rest_url("plateforme-master/v1/masters-coordinateur")) ?>',

    apiUrlCoordinateurs: '<?php echo esc_url(rest_url('plateforme-master/v1/coordinateurs')); ?>',
    apiUrlCandidatures: '<?php echo esc_url(rest_url('plateforme-master/v1/liste-candidatures')); ?>',
    apiUrlEtudiant: '<?php echo esc_url(rest_url('plateforme-master/v1/liste-candidatures-etudiant')); ?>',

    apiUrlFicheMasterScore: '<?php echo esc_url(rest_url('plateforme-master/v1/masters-formules-statut')); ?>',
    apiUrlvaliderScore :'<?php echo esc_url(rest_url('plateforme-master/v1/valider-formule-score')); ?>',
    apiUrlDossierCandidature: '<?php echo esc_url(rest_url('plateforme-master/v1/fiche-candidature')); ?>',
    apiUrlListeAppel:'<?php echo esc_url(rest_url('plateforme-master/v1/appels')); ?>',  
    nonce: '<?= wp_create_nonce("wp_rest") ?>',
    role: '<?= esc_js($role) ?>',
    userId: <?= (int) $user_id ?>
  };
</script>





<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__) . '../assets/css/style.css'; ?>">



<?php
$current_user = wp_get_current_user();
$user_id = $current_user->ID;

// Récupérer le rôle principal
$roles = (array) $current_user->roles;
$role  = $roles[0] ?? null; // exemple : 'um_service-master'
?>