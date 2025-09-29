<!-- Google Fonts: Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
/* Custom styles for the info component */
.info-container {
    background-color: #ffffff;
    padding: 24px 32px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    width: 100%;
    margin-bottom: 20px;
    /* Added margin for spacing between components */
}

.info-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.info-header h2 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
    margin: 0;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-item {
    display: flex;
    flex-wrap: wrap;
    padding: 16px 0;
    border-bottom: 1px solid #e9ecef;
    font-size: 0.95rem;
    align-items: flex-start;
}

.info-item:last-child {
    border-bottom: none;
}

.info-item-label {
    color: #555;
    font-weight: 600;
    width: 250px;
    flex-shrink: 0;
    padding-right: 15px;
}

.info-item-value {
    color: #212529;
    flex-grow: 1;
    flex-basis: 0;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .info-item-label {
        width: 100%;
        margin-bottom: 8px;
        font-weight: 700;
    }

    .info-item-value {
        width: 100%;
    }
}
</style>

<div class="info-container">
    <div class="info-header">
        <h2>Informations générales</h2>
        <div class="dropdown">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                Valider
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">valider</a></li>
                <li><a class="dropdown-item" href="#">Rejeter</a></li>
                <li><a class="dropdown-item" href="#">publier</a></li>
            </ul>
        </div>
    </div>

    <ul class="info-list">
       <li class="info-item">
  <span class="info-item-label">Titre complet :</span>
  <span class="info-item-value" id="completeTitleValue">—</span>
</li>
<li class="info-item">
  <span class="info-item-label">Type de publication :</span>
  <span class="info-item-value" id="typeValue">—</span>
</li>
<li class="info-item">
  <span class="info-item-label">Auteur(s) :</span>
  <span class="info-item-value" id="auteurValue">—</span>
</li>
<li class="info-item">
  <span class="info-item-label">Date de soumission :</span>
  <span class="info-item-value" id="dateValue">—</span>
</li>
<li class="info-item">
  <span class="info-item-label">Statut actuel :</span>
  <span class="info-item-value" id="statutValue">—</span>
</li>
<li class="info-item">
  <span class="info-item-label">Résumé (Abstract) :</span>
  <span class="info-item-value" id="resumeValue">—</span>
</li>

    </ul>
</div>
<?php if (is_user_logged_in()): ?>
  <script>
    // REST settings exposées au JS
    window.pmsettings = {
      rest_root: <?php echo json_encode(esc_url_raw(rest_url())); ?>,
      nonce: <?php echo json_encode(wp_create_nonce('wp_rest')); ?>
    };
    // Rôles utilisateur courant
    window.pmuser = {
      roles: <?php echo json_encode($roles); ?>
    };
  </script>
<?php endif; ?>
<script>
(function(){
  const REST_ROOT = (window.pmsettings && pmsettings.rest_root) || (window.wpApiSettings && wpApiSettings.root) || '/wp-json/';
  const NONCE     = (window.pmsettings && pmsettings.nonce) || (window.wpApiSettings && wpApiSettings.nonce) || '';
  const API       = REST_ROOT.replace(/\/$/,'') + '/plateforme-recherche/v1';

  function q(k){ return new URLSearchParams(location.search).get(k); }
  const pubId = q('id');

  async function load(){
    if(!pubId){ alert('ID manquant'); return; }
    const res = await fetch(`${API}/publication/${pubId}`, {
      headers:{'X-WP-Nonce':NONCE,'Accept':'application/json'},
      credentials:'same-origin'
    });
    if(!res.ok){ alert('Publication introuvable'); return; }
    const p = await res.json();

    // Remplir les champs de la fiche (remplace tes valeurs statiques)
    setText('completeTitleValue', p.titre || '—');
    setText('typeValue', p.type || '—');
    setText('auteurValue', p.auteur_display_name || '—');
    setText('dateValue', p.date_publication || '—');
    setText('statutValue', p.statut || '—');
    setText('resumeValue', p.resume || '—');

    // Si tu veux afficher des fichiers (si tu passes file URL)
    // setText('fichiersValue', p.fichier_url ? p.fichier_url : '—');
  }

  function setText(domId, value){
    const el = document.getElementById(domId);
    if (el) el.textContent = value;
  }

  load();
})();
</script>
