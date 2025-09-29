<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publication Details</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* General body styling */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
            /* A light grey background for better contrast */
        }

        /* Utility classes */
        .text-custom-red {
            color: #b60303;
        }





        /* Hero section styling */
        .hero-bg {
            background-image: url('/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3330 (1).png');
            background-size: cover;
            background-position: center;
            padding: 13rem 0;
            color: white;
        }

        .hero-bg h1 {
            font-size: 50px;
            width: 340px;
            font-weight: 500;
            /* text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); */
        }

        .breadcrumb-custom {
            background-color: rgb(83 81 81 / 40%);
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .breadcrumb-custom a {
            color: white;
            text-decoration: none;
        }

        .breadcrumb-custom a:hover {
            text-decoration: underline;
        }

        .breadcrumb-custom span {
            color: #e9ecef;
            margin: 0 0.5rem;
        }


        /* Main Content Styling */
        .main-content {
            margin-top: -100px;
            position: relative;
            z-index: 10;
        }

        .details-card {
            text-align: center;
            background-color: #ffffff;
            border-radius: 1rem;
            padding: 2.5rem;
            box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
            /* border: 1px solid #dee2e6; */
        }

        .summary-card {
            background-color: #ffffff;
            border-radius: 1rem;
            padding: 2.5rem;
            box-shadow: 1px 1px 14px 1px rgba(0, 0, 0, 0.15);
            /* border: 1px solid #dee2e6; */
            margin-top: 2rem;
        }

        .publication-meta {
            display: flex;
            font-size: 0.95rem;
            color: #495057;
            justify-content: center;
            align-items: center;
            gap: 205px;
        }

        .publication-meta img {
            filter: invert(35%) sepia(85%) saturate(3033%) hue-rotate(346deg) brightness(70%) contrast(110%);
        }

        .summary-card h3 {
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .summary-card p,
        .summary-card h4 {
            color: #212529;
        }

        .summary-card h4 {
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .keyword-tag {
            display: inline-block;
            background-color: #b60303;
            color: white;
            padding: 0.5rem 1.25rem;
            border-radius: 999px;
            text-decoration: none;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .keyword-tag:hover {
            background-color: #930202;
            color: white;
        }

        .file-download-list {
            list-style: none;
            padding-left: 0;
        }

        .file-download-list li a {
            display: flex;
            align-items: center;
            padding: 0.75rem 0;
            text-decoration: none;
            color: #212529;
            border-bottom: 1px solid #e9ecef;
        }

        .file-download-list li:last-child a {
            border-bottom: none;
        }

        .file-download-list li a:hover {
            color: #b60303;
        }

        .file-download-list img {
            width: 24px;
            margin-right: 1rem;
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-bg">
        <div class="container">
            <div class="breadcrumb-custom">
                <a href="#">Université de Tunis El Manar</a><span>›</span> <a href="/structures-de-recherche-utm">
                    Structures de recherche </a> <span>›</span> <a href="/publications-utm">Publications</a>
                <span>›</span> Détails
            </div>
            <h1 class="text-start">Publications</h1>
        </div>
    </section>

    <main class="container main-content">
        <div class="col-lg-10 mx-auto">
            <!-- Publication Title Card -->
            <section class="details-card ">
                <h2 class="fw-bold mb-4" style="font-size: 2rem;">Deep Learning for Brain-Computer Interface Systems
                </h2>
                <div class="d-flex flex-wrap publication-meta">
                    <div class="me-4 d-flex align-items-center mb-2">
                        <img class="me-2" width="20px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-person.png"
                            alt="Author Icon">
                        <span>Dr. Sarra Messaoudi (Maître-Assistant, Labo IA & Signal - FDST)</span>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <img class="me-2" width="20px"
                            src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-calendar.png"
                            alt="Calendar Icon">
                        <span>05/08/2025</span>
                    </div>
                </div>
            </section>

            <!-- Publication Summary & Download Card -->
            <section class="summary-card mb-5">
                <h3>Résumé</h3>
                <p>Cet article explore l'utilisation des réseaux de neurones convolutifs et des modèles Transformer pour
                    améliorer la précision des systèmes d'interfaces cerveau-machine (BCI). Les résultats obtenus sur
                    des bases de données EEG montrent une amélioration de 12 % par rapport aux méthodes classiques de
                    traitement du signal. Cette approche ouvre la voie à des applications en neuro-réhabilitation et
                    contrôle de prothèses intelligentes.</p>

                <h4>Mots clés :</h4>
                <div>
                    <a href="#" class="keyword-tag">Deep learning</a>
                    <a href="#" class="keyword-tag">BCI</a>
                    <a href="#" class="keyword-tag">Neurosciences</a>
                    <a href="#" class="keyword-tag">Signal Processing</a>
                </div>

                <h4>Fichiers à télécharger :</h4>
                <ul class="file-download-list">
                    <li>
                        <a href="#">
                            <!-- Assuming a pdf icon path based on other icons -->
                            <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/pdf-svgrepo-com (2).png"
                                alt="PDF Icon">
                            <span>Deeplearning_BCI_Systems.Pdf</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/pdf-svgrepo-com (2).png"
                                alt="PDF Icon">
                            <span>Poster_Bci2025.Pdf</span>
                        </a>
                    </li>
                </ul>
            </section>
        </div>
    </main>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <?php
    $current_user = wp_get_current_user();
    $roles = (array) $current_user->roles;
    $role = $roles[0] ?? '';
    $user_id = get_current_user_id();

?>
<script>
        window.PMSettings = {
            restUrl: "<?= esc_url(rest_url()) ?>",
            nonce: "<?= wp_create_nonce('wp_rest') ?>",
            role: "<?= esc_js($role) ?>",
            userId: <?= (int) $user_id ?>
        };
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // ===== Helpers REST =====
  const REST_BASE = (window.PMSettings?.restUrl || '/wp-json/').replace(/\/+$/,'/');
  const API_NS    = 'plateforme-recherche/v1';
  const ICONS     = '/wp-content/plugins/plateforme-master/images/SiteRechercheImages/';
  const $ = (sel) => document.querySelector(sel);

  const params = new URL(location.href).searchParams;
  const PUB_ID = params.get('publication_id') || params.get('id');
  const LAB_ID = params.get('laboratoireid') || params.get('laboratoire_id') || localStorage.getItem('laboratoireid') || '';

  if (LAB_ID) localStorage.setItem('laboratoireid', LAB_ID);

  // Cibles DOM
  const detailsCard = document.querySelector('.details-card');
  const summaryCard = document.querySelector('.summary-card');
  const breadcrumbPublications = document.querySelector('.breadcrumb-custom a[href="/publications-utm"]');

  // Loader simple
  function setLoading(on=true){
    if (on) {
      detailsCard.innerHTML = `<div class="text-center py-4">Chargement…</div>`;
      summaryCard.innerHTML = '';
    }
  }

  function esc(s){ return (''+ (s??'')).replace(/[&<>"]/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[m])); }
  function escAttr(s){ return esc(s).replace(/"/g,'&quot;'); }
  function formatDateFR(iso){
    const d = new Date(iso);
    return isNaN(d) ? (iso || '—') : d.toLocaleDateString('fr-FR', {day:'2-digit', month:'2-digit', year:'numeric'});
  }

  // Parse fichiers: accepte string ou JSON (array strings/obj {url, label})
  function parseFiles(fichier_url){
    if (!fichier_url) return [];
    try {
      const v = typeof fichier_url === 'string' ? JSON.parse(fichier_url) : fichier_url;
      if (Array.isArray(v)) {
        return v.map(x => {
          if (typeof x === 'string') return { url: x, label: x.split('/').pop() };
          if (x && typeof x === 'object') return { url: x.url || x.path || '', label: x.label || x.name || (x.url? x.url.split('/').pop() : '') };
          return null;
        }).filter(Boolean);
      }
    } catch(e){}
    // fallback: string simple éventuellement séparé par |
    if (typeof fichier_url === 'string') {
      return fichier_url.split('|').map(s => s.trim()).filter(Boolean).map(u => ({ url: u, label: u.split('/').pop() }));
    }
    return [];
  }

  // Rendu Details (titre + meta)
  function renderDetails(pub){
    const title = esc(pub.titre || 'Publication');
    const auteur = esc(pub.auteur_display || pub.display_name || pub.user_login || 'Auteur inconnu');
    const date = formatDateFR(pub.date_publication || pub.date);

    // Breadcrumb "Publications" avec labo
    if (breadcrumbPublications && LAB_ID) {
      breadcrumbPublications.setAttribute('href', `/publications-utm/?laboratoireid=${encodeURIComponent(LAB_ID)}`);
    }

    document.title = `${title} – Publications`;

    detailsCard.innerHTML = `
      <h2 class="fw-bold mb-4" style="font-size: 2rem;">${title}</h2>
      <div class="d-flex flex-wrap publication-meta">
        <div class="me-4 d-flex align-items-center mb-2">
          <img class="me-2" width="20" src="${ICONS}27) Icon-person.png" alt="">
          <span>${auteur}${pub.revue ? ' ('+esc(pub.revue)+')' : ''}</span>
        </div>
        <div class="d-flex align-items-center mb-2">
          <img class="me-2" width="20" src="${ICONS}27) Icon-calendar.png" alt="">
          <span>${date}</span>
        </div>
      </div>
    `;
  }

  // Rendu Résumé + tags + fichiers
  function renderSummary(pub){
    const resume = (pub.resume ? esc(pub.resume) : '—');
    const tags = collectTags(pub);  // type, revue, doi, isbn + mots_cles si dispo
    const files = parseFiles(pub.fichier_url || pub.fichiers || pub.piece_jointe_path);

    const tagsHTML = tags.map(t => `<a href="#" class="keyword-tag">${esc(t)}</a>`).join('');

    const filesHTML = files.length
      ? files.map(f => `
          <li>
            <a href="${escAttr(f.url)}" target="_blank" rel="noopener">
              <img src="${ICONS}pdf-svgrepo-com (2).png" alt="PDF">
              <span>${esc(f.label || 'Fichier')}</span>
            </a>
          </li>`).join('')
      : `<li><a href="#"><img src="${ICONS}pdf-svgrepo-com (2).png" alt=""><span>Aucun fichier</span></a></li>`;

    summaryCard.innerHTML = `
      <h3>Résumé</h3>
      <p>${resume}</p>

      ${tags.length ? `<h4>Mots clés :</h4><div>${tagsHTML}</div>` : ''}

      <h4>Fichiers à télécharger :</h4>
      <ul class="file-download-list">
        ${filesHTML}
      </ul>
    `;
  }

  function collectTags(pub){
    const out = [];
    if (pub.type) out.push(pub.type);
    if (pub.revue) out.push(pub.revue);
    if (pub.doi) out.push(`DOI: ${pub.doi}`);
    if (pub.isbn) out.push(`ISBN: ${pub.isbn}`);
    // Si le backend expose "mots_cles" (csv ou array)
    const mk = pub.mots_cles || pub.keywords;
    if (mk) {
      if (Array.isArray(mk)) out.push(...mk.filter(Boolean));
      else if (typeof mk === 'string') out.push(...mk.split(',').map(s=>s.trim()).filter(Boolean));
    }
    return out;
  }

  async function fetchJSON(u){
    const headers = {};
    if (window.PMSettings?.nonce) headers['X-WP-Nonce'] = PMSettings.nonce;
    const r = await fetch(u, { headers, credentials: 'same-origin' });
    if (!r.ok) throw new Error('HTTP '+r.status);
    return r.json();
  }

  async function loadPublicationById(id){
    // 1) Essaye /publications/{id}
    try {
      const url = `${REST_BASE}${API_NS}/publications/${encodeURIComponent(id)}`;
      return await fetchJSON(url);
    } catch (e) {
      // 2) Fallback: /publications/by-lab?laboratoire_id=... puis .find(id)
      if (!LAB_ID) throw e;
      const url2 = new URL(`${REST_BASE}${API_NS}/publications/by-lab`, location.origin);
      url2.searchParams.set('laboratoire_id', LAB_ID);
      url2.searchParams.set('per_page', '200');
      const rows = await fetchJSON(url2.toString());
      const found = Array.isArray(rows) ? rows.find(x => String(x.id) === String(id)) : null;
      if (!found) throw e;
      return found;
    }
  }

  async function main(){
    if (!PUB_ID) {
      detailsCard.innerHTML = `<div class="text-center text-danger">Paramètre <code>publication_id</code> manquant.</div>`;
      return;
    }
    setLoading(true);
    try {
      const pub = await loadPublicationById(PUB_ID);
      renderDetails(pub);
      renderSummary(pub);
    } catch (err) {
      console.error(err);
      detailsCard.innerHTML = `<div class="text-center text-danger">Impossible de charger cette publication.</div>`;
      summaryCard.innerHTML = '';
    }
  }

  main();
});
</script>

</body>

</html>