<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Fiche Équipement</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
  :root{
    --bg:#F5F5F3;
    --card:#FFFFFF;
    --line:#ECEBE3;
    --text:#2A2916;
    --muted:#6E6D55;
    --accent:#BF0404;
    --thead:#ECEBE3;
  }
  *{box-sizing:border-box}
  body{
    margin:0;
    background:var(--bg);
    font-family:'Poppins',system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif;
    color:var(--text);
  }
 
  .card{
    background:var(--card);
    border-radius:12px;
    box-shadow:0 6px 18px rgba(0,0,0,.06);
    overflow:hidden;
    margin-bottom:16px;
  }
  /* Header de card: pleine largeur + ombre uniquement en bas */
  .card h3{
    position:relative;
    margin:0;
    padding:16px 20px;
    font-size:18px;
    font-weight:700;
    color:var(--text);
    background:#fff;
    border-bottom:1px solid var(--line);
    box-shadow:0 4px 12px rgba(0,0,0,.08);
  }
  /* Bouton edit en haut à droite */
  .edit-btn{
    position:absolute;
    right:14px; top:10px;
    width:34px; height:34px;
    border-radius:8px;
    border:1px solid #E2DFC9;
    background:#fff;
    color:#BF0404;
    display:flex; align-items:center; justify-content:center;
    cursor:pointer;
    transition:.15s ease;
  }
  .edit-btn:hover{ background:#fff4f4; }

  /* ========== Informations générales (liste table-like) */
  .info-list{ list-style:none; margin:0; padding:0; }
  .info-row{
    display:grid;
    grid-template-columns: 260px 1fr;
    border-bottom:1px solid var(--line);
  }
  .info-row:last-child{ border-bottom:none; }
  .info-cell{ padding:12px 18px; font-size:14px; }
  .label{ color:var(--muted); font-weight:600; }
  .value{ color:var(--text); font-weight:500; }

  /* ========== Galerie d'images */
  .gallery{
    padding:14px 14px 18px 14px;
    display:grid;
    grid-template-columns: repeat(auto-fill, minmax(160px,1fr));
    gap:62px;
  }
  .thumb{
    background:#fff;
    border:1px solid #E9E6D6;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 3px 10px rgba(0,0,0,.05);
    aspect-ratio: 4 / 3;
    display:block;
  }
  .thumb img{
    width:100%; height:100%;
    object-fit:cover; display:block;
  }

  /* ========== Tables génériques (Documents / Maintenance) */
  .table-wrap{ padding:10px 10px 16px 10px; }
  table{
    width:100%;
    border-collapse:separate;
    border-spacing:0;
    background:#fff;
    border-radius:10px;
    overflow:hidden;
    font-size:14px;
    box-shadow:0 3px 12px rgba(0,0,0,.04);
  }
  thead th{
    background:var(--thead);
    color:#2A2916;
    font-weight:700;
    text-align:left;
    padding:12px 14px;
    border-bottom:1px solid #E5E3D2;
  }
  tbody td{
    padding:12px 14px;
    border-bottom:1px solid #EEEADF;
    color:#333;
    vertical-align:middle;
  }
  tbody tr:last-child td{ border-bottom:none; }

  /* Boutons / icônes dans cellules */
  .dl-btn, .doc-pill{
    display:inline-flex;
    align-items:center; justify-content:center;
    width:32px; height:32px;
    border-radius:8px;
    border:1px solid #E2DFC9;
    background:#F3F1E7;
    color:#2A2916;
  }
  .dl-btn:hover, .doc-pill:hover{ filter:brightness(0.98); }

  /* Responsive */
  @media (max-width:700px){
    .info-row{ grid-template-columns:1fr; }
  }
</style>
</head>
<body>
  <div class="wrap">

    <!-- ===== 1) Informations générales ===== -->
    <div class="card">
      <h3>Informations générales
        <button class="edit-btn" title="Modifier"><i class="fa-solid fa-pen"></i></button>
      </h3>
      <ul class="info-list">
        <li class="info-row">
          <div class="info-cell label">Catégorie :</div>
          <div class="info-cell value">Équipements</div>
        </li>
        <li class="info-row">
          <div class="info-cell label">Nom de l’équipement :</div>
          <div class="info-cell value">Microscope électronique haute résolution</div>
        </li>
        <li class="info-row">
          <div class="info-cell label">Localisation :</div>
          <div class="info-cell value">Plateforme Biotechnologie – Bloc B</div>
        </li>
        <li class="info-row">
          <div class="info-cell label">Modèle / Version :</div>
          <div class="info-cell value">JEOL JSM-7800F</div>
        </li>
        <li class="info-row">
          <div class="info-cell label">Unité :</div>
          <div class="info-cell value">Unité Génomique</div>
        </li>
        <li class="info-row">
          <div class="info-cell label">Disponibilité :</div>
          <div class="info-cell value">Disponible</div>
        </li>
        <li class="info-row">
          <div class="info-cell label">Spécification technique :</div>
          <div class="info-cell value">—</div>
        </li>
      </ul>
    </div>

    <!-- ===== 2) Image ===== -->
    <div class="card">
      <h3>Image
        <button class="edit-btn" title="Modifier"><i class="fa-solid fa-pen"></i></button>
      </h3>
      <div class="gallery">
        <a class="thumb" href="#"><img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=800&auto=format&fit=crop" alt="Microscope 1"></a>
        <a class="thumb" href="#"><img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=800&auto=format&fit=crop" alt="Microscope 2"></a>
        <a class="thumb" href="#"><img src="https://images.unsplash.com/photo-1581090464777-f3220bbe1b8b?q=80&w=800&auto=format&fit=crop" alt="Microscope 3"></a>
        <a class="thumb" href="#"><img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?q=80&w=800&auto=format&fit=crop" alt="Microscope 4"></a>
      </div>
    </div>

    <!-- ===== 3) Documents associés ===== -->
    <div class="card">
      <h3>Documents associés</h3>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Nom &amp; Prénom</th>
              <th>Date d’ajout</th>
              <th>Télécharger</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Protocole d’utilisation</td>
              <td>12/09/2025</td>
              <td><a class="dl-btn" href="#" title="Télécharger"><i class="fa-solid fa-download"></i></a></td>
            </tr>
            <tr>
              <td>Contrat</td>
              <td>12/09/2025</td>
              <td><a class="dl-btn" href="#" title="Télécharger"><i class="fa-solid fa-download"></i></a></td>
            </tr>
            <tr>
              <td>Périodicité</td>
              <td>12/09/2025</td>
              <td><a class="dl-btn" href="#" title="Télécharger"><i class="fa-solid fa-download"></i></a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- ===== 4) Maintenance & incidents ===== -->
    <div class="card">
      <h3>Maintenance &amp; incidents</h3>
      <div class="table-wrap">
        <table>
          <thead>
            <tr>
              <th>Date</th>
              <th>Type</th>
              <th>Description</th>
              <th>Document</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>08/07/2025</td>
              <td>Corrective</td>
              <td>–</td>
              <td style="text-align:center"><span class="doc-pill"><i class="fa-solid fa-paperclip"></i></span></td>
            </tr>
            <tr>
              <td>08/07/2025</td>
              <td>Corrective</td>
              <td>Remplacement détecteur EDS</td>
              <td style="text-align:center"><span class="doc-pill"><i class="fa-solid fa-paperclip"></i></span></td>
            </tr>
            <tr>
              <td>08/07/2025</td>
              <td>Préventive</td>
              <td>Nettoyage chambre à vide</td>
              <td style="text-align:center"><span class="doc-pill"><i class="fa-solid fa-paperclip"></i></span></td>
            </tr>
            <tr>
              <td>08/07/2025</td>
              <td>Incident signalé</td>
              <td>Problème alimentation</td>
              <td style="text-align:center"><span class="doc-pill"><i class="fa-solid fa-paperclip"></i></span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</body>
</html>
