<?php
if (!defined('ABSPATH')) exit;

/* $data provient de ta fusion finale des rôles (déjà dans ton fichier) */
$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role  = $roles[0] ?? null;

/* Sécurité : valeurs par défaut si la clé manque */
$uscr = [
  'disponibilites' => $data['disponibilites'] ?? ['Équipements','Salles'],
  'calendriers'    => $data['calendriers']    ?? ['Réservations','Maintenance','Réunions'],
  'membres'        => $data['membres']        ?? ['Utilisateurs Autorisés','Responsables'],
  'demandes'       => $data['demandes']       ?? ['Réservations','Maintenance'],
];

/* Cibles au clic (tu peux changer ces URLs) */
$goto = [
  'disponibilites' => '/equipements',
  'calendriers'    => '/reservation-planning',
  'membres'        => '/utilisateurs',
  'demandes'       => '/maintenance-incidents',
];

/* Icônes (mets tes fichiers réels si tu en as) */
/* Base URL du dossier images du plugin */
$plugin_images_base = trailingslashit( get_site_url() ) . 'wp-content/plugins/plateforme-master/images/';

/* Icônes (avec encodage des espaces/parenthèses) */
$icons = [
  // Disponibilités -> images/uscr/27) Icon-person-done.png
  'disponibilites' => $plugin_images_base . 'uscr/' . rawurlencode('27) Icon-person-done.png'),

  // Calendriers -> images/icon etudiant/27) Icon-calendar.png
  'calendriers'    => $plugin_images_base . rawurlencode('icon etudiant') . '/' . rawurlencode('27) Icon-calendar.png'),

  // Membres Gestionnaires -> images/uscr/27) Icon-people.png
  'membres'        => $plugin_images_base . 'uscr/' . rawurlencode('27) Icon-people.png'),

  // Demandes -> images/uscr/27) Icon-home.png
  'demandes'       => $plugin_images_base . 'uscr/' . rawurlencode('27) Icon-home.png'),
];
?>

<style>
:root{ --olive:#A6A485; --olive-dark:#6E6D55; --ink:#2A2916; --shadow:0 2px 6px rgba(0,0,0,.08); }

.uscr-top-boxes{ display:flex; flex-wrap:wrap; gap:18px; margin-top:16px; }
.uscr-box{
  flex:1 1 calc(25% - 18px);
  min-width:240px;
  background:#fff; border-radius:12px; box-shadow:var(--shadow);
  display:flex; overflow:hidden; transition:transform .18s ease, box-shadow .18s ease; cursor:pointer;
}
.uscr-box:hover{ transform:translateY(-3px); box-shadow:0 6px 14px rgba(0,0,0,.12); }

.uscr-box .left{
  width:92px; background:linear-gradient(180deg, var(--olive) 0%, var(--olive-dark) 100%);
  display:flex; align-items:center; justify-content:center;
}
.uscr-box .left img{ width:48px; height:48px; object-fit:contain; filter:brightness(0) invert(1); }

.uscr-box .right{ flex:1; padding:16px 18px; }
.uscr-box .right h4{ margin:0 0 10px; font-size:15px; font-weight:700; color:#111; }
.uscr-box .right ul{ margin:0; padding-left:16px; display:flex; flex-direction:column; gap:6px; }
.uscr-box .right li{ list-style:none; position:relative; padding-left:10px; color:#222; font-size:14px; }
.uscr-box .right li::before{
  content:""; width:6px; height:6px; border-radius:50%; background:var(--olive-dark);
  position:absolute; left:0; top:.55em;
}

/* Responsive */
@media (max-width: 1100px){
  .uscr-box{ flex:1 1 calc(50% - 18px); }
}
@media (max-width: 580px){
  .uscr-box{ flex:1 1 100%; }
}
</style>

<div class="uscr-top-boxes">
  <!-- 1) Disponibilités -->
  <div class="uscr-box" data-href="<?php echo esc_url($goto['disponibilites']); ?>" role="link" tabindex="0" aria-label="Ouvrir Disponibilités">
    <div class="left"><img src="<?php echo esc_url($icons['disponibilites']); ?>" alt=""></div>
    <div class="right">
      <h4>Disponibilités</h4>
      <ul>
        <?php foreach ($uscr['disponibilites'] as $li): ?>
          <li><?php echo esc_html($li); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <!-- 2) Calendriers -->
  <div class="uscr-box" data-href="<?php echo esc_url($goto['calendriers']); ?>" role="link" tabindex="0" aria-label="Ouvrir Calendriers">
    <div class="left"><img src="<?php echo esc_url($icons['calendriers']); ?>" alt=""></div>
    <div class="right">
      <h4>Calendriers</h4>
      <ul>
        <?php foreach ($uscr['calendriers'] as $li): ?>
          <li><?php echo esc_html($li); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <!-- 3) Membres Gestionnaires -->
  <div class="uscr-box" data-href="<?php echo esc_url($goto['membres']); ?>" role="link" tabindex="0" aria-label="Ouvrir Membres Gestionnaires">
    <div class="left"><img src="<?php echo esc_url($icons['membres']); ?>" alt=""></div>
    <div class="right">
      <h4>Membres Gestionnaires</h4>
      <ul>
        <?php foreach ($uscr['membres'] as $li): ?>
          <li><?php echo esc_html($li); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <!-- 4) Demandes -->
  <div class="uscr-box" data-href="<?php echo esc_url($goto['demandes']); ?>" role="link" tabindex="0" aria-label="Ouvrir Demandes">
    <div class="left"><img src="<?php echo esc_url($icons['demandes']); ?>" alt=""></div>
    <div class="right">
      <h4>Demandes</h4>
      <ul>
        <?php foreach ($uscr['demandes'] as $li): ?>
          <li><?php echo esc_html($li); ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>

<script>
/* Navigation au clic + clavier (Enter/Espace) */
document.querySelectorAll('.uscr-box').forEach(box => {
  const go = () => { const href = box.dataset.href; if (href) window.location.href = href; };
  box.addEventListener('click', go);
  box.addEventListener('keydown', e => {
    if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); go(); }
  });
});
</script>
