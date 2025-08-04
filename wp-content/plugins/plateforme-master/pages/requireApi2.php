<?php
$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role = $roles[0] ?? null;
$user_id = $current_user->ID;
?>

<script>
  const PMSettings = {
    apiUrl: '<?= esc_url(rest_url("plateforme-master/v1/candidats")) ?>',
    nonce: '<?= wp_create_nonce("wp_rest") ?>',
    role: '<?= esc_js($role) ?>',
    userId: <?= (int) $user_id ?>
  };
</script>



<?php
$current_user = wp_get_current_user();
$user_id = $current_user->ID;

// Récupérer le rôle principal
$roles = (array) $current_user->roles;
$role  = $roles[0] ?? null; // exemple : 'um_service-master'
?>