<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Master – Fiche du parcours</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

<style>
:root{
  --ink:#2A2916;
  --muted:#6e6d55;
  --line:#e7e3d7;
  --bg:#f5f4f2;
  --card:#ffffff;
  --accent:#A6A485;
  --danger:#d71920;
  --radius:12px;
}

*{box-sizing:border-box}
body{margin:0;background:var(--bg);font-family:"Segoe UI",system-ui,-apple-system,sans-serif;color:var(--ink)}
.wrapper{max-width:1100px;margin:26px auto;padding:0 16px;}

/* Cards */
.card{
  background:var(--card);border:1px solid var(--line);border-radius:var(--radius);
  box-shadow:0 2px 10px rgba(0,0,0,.06);overflow:hidden;
}
.card + .card{margin-top:16px}
.card-header{
  display:flex;align-items:center;justify-content:space-between;gap:12px;
  padding:12px 14px;border-bottom:1px solid var(--line);background:#fff;
}
.card-title{display:flex;align-items:center;gap:10px;font-weight:600;font-size:19px;} /* ↑ taille augmentée */
.card-title i{
  width:34px;height:34px;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;
  background:#fff;border:1px solid var(--line);color:var(--accent);
}
.badge-pdf{
  display:inline-flex;align-items:center;gap:8px;
  padding:6px 10px;border:1px solid var(--line);border-radius:8px;background:#fff;font-size:12px;color:#111;
}
.badge-pdf i{color:#d71920}

/* Main card content (objectifs) */
.obj-body{padding:14px}
.obj-row{display:grid;grid-template-columns:240px 1fr;gap:12px;align-items:flex-start;padding:8px 0}
.obj-row + .obj-row{border-top:1px solid var(--line)}
.obj-label{font-weight:550;color:#585858;} /* plus de gras + gris */
.obj-list{display:grid;gap:7px}
.obj-item{display:flex;gap:10px;align-items:flex-start}
.obj-item i{color:#d71920;margin-top:3px}
.obj-text{color:#222;line-height:1.55}

/* Bottom section layout */
.bottom-grid{
  display:grid;grid-template-columns:1.15fr .85fr;gap:18px;margin-top:16px
}
@media (max-width:980px){.bottom-grid{grid-template-columns:1fr}}

/* Info détaillées (dl) */
.info-body{padding:14px}
.dl{display:grid;grid-template-columns:240px 1fr;gap:10px 14px}
.dl dt{font-weight:550;color:#585858;} /* plus de gras + gris */
.dl dd{margin:0;color:#222}

/* Plan d’étude */
.plan-body{padding:14px;display:grid;grid-template-columns:120px 1fr;gap:16px;align-items:center}
.pdf-thumb{
  width:100%;max-width:110px;height:120px;border:1px dashed var(--line);border-radius:10px;
  display:flex;align-items:center;justify-content:center;background:#fafafa;user-select:none;
}
.pdf-thumb i{font-size:42px;color:#d71920}
.plan-text{color:#555;line-height:1.5}
.btn{
  display:inline-flex;align-items:center;gap:10px;border:none;border-radius:10px;
  background:var(--danger);color:#fff;font-weight:800;padding:10px 16px;cursor:pointer;text-decoration:none;
}
</style>

</head>
<body>
<div class="wrapper">

  <!-- =================== Objectifs =================== -->
  <section class="card">
    <header class="card-header">
      <div class="card-title">
        <i class="fa-regular fa-bullseye"></i>
        Objectifs pédagogiques et scientifiques
      </div>
      <span class="badge-pdf"><i class="fa-regular fa-file-pdf"></i> pdf</span>
    </header>

    <div class="obj-body">
      <!-- Objectifs généraux -->
      <div class="obj-row">
        <div class="obj-label">Objectifs généraux du master :</div>
        <div class="obj-list">
          <div class="obj-item">
            <i class="fa-solid fa-caret-right"></i>
            <div class="obj-text">Acquérir des compétences avancées en IA, mathématiques appliquées et informatique.</div>
          </div>
          <div class="obj-item">
            <i class="fa-solid fa-caret-right"></i>
            <div class="obj-text">Préparer à la recherche scientifique ou à des fonctions d’expertise dans l’industrie.</div>
          </div>
          <div class="obj-item">
            <i class="fa-solid fa-caret-right"></i>
            <div class="obj-text">Maîtriser les techniques modernes de modélisation, d’apprentissage automatique et d’analyse de données.</div>
          </div>
        </div>
      </div>

      <!-- Objectifs spécifiques -->
      <div class="obj-row">
        <div class="obj-label">Objectifs spécifiques :</div>
        <div class="obj-text">
          Le Master de Recherche en Intelligence Artificielle (IA) forme des experts capables de
          concevoir, développer et évaluer des systèmes intelligents intégrant des technologies
          avancées telles que le Machine Learning, le Deep Learning, le traitement du langage
          naturel ou encore la vision par ordinateur.
        </div>
      </div>
    </div>
  </section>

  <!-- =================== Bas de page =================== -->
  <div class="bottom-grid">

    <!-- Informations détaillées -->
    <section class="card">
      <header class="card-header">
        <div class="card-title">
          <i class="fa-regular fa-id-card"></i>
          Informations détaillées
        </div>
        <span class="badge-pdf"><i class="fa-regular fa-file-pdf"></i> pdf</span>
      </header>
      <div class="info-body">
        <dl class="dl">
          <dt>Intitulé du master :</dt>
          <dd>Master de recherche en AI et Data</dd>

          <dt>Code interne du Master :</dt>
          <dd>M456</dd>

          <dt>Début d’habilitation :</dt>
          <dd>13-08-2025</dd>

          <dt>Fin d’habilitation :</dt>
          <dd>13-09-2025</dd>

          <dt>Nature master :</dt>
          <dd>Master de recherche</dd>
        </dl>
      </div>
    </section>

    <!-- Plan d’étude -->
    <section class="card">
      <header class="card-header">
        <div class="card-title">
          <i class="fa-regular fa-rectangle-list"></i>
          Plan d’étude
        </div>
      </header>
      <div class="plan-body">
        <div class="pdf-thumb" aria-hidden="true">
          <i class="fa-regular fa-file-pdf"></i>
        </div>
        <div>
          <p class="plan-text" style="margin-top:0">
            Veuillez trouver ci-joint le PDF des plans d’étude.
          </p>
          <a class="btn" href="#" download>
            <i class="fa-solid fa-download"></i> Télécharger
          </a>
        </div>
      </div>
    </section>

  </div>
</div>
</body>
</html>
