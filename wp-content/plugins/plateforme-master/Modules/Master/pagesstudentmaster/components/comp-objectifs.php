<section id="comp-objectifs">
  <style>
    /* ====== Scope ====== */
    #comp-objectifs{display:block; padding:0 12px;}
    #comp-objectifs *{box-sizing:border-box; font-family:Roboto,system-ui,-apple-system,"Segoe UI",Arial,sans-serif}

    /* ====== Card ====== */
    #comp-objectifs .card{
      background:#FFF; box-shadow:0 3px 16px #00000029; border-radius:10px;
      min-height:auto;
    }

    /* ====== Header ====== */
    #comp-objectifs .head{
      display:flex; align-items:center; gap:10px; padding:14px 16px;
      background:#FFF; box-shadow:0 5px 16px #00000012; border-radius:10px 10px 0 0;
    }
    #comp-objectifs .head .ico{width:clamp(26px,3vw,35px);height:clamp(26px,3vw,35px);object-fit:contain}
    #comp-objectifs .head h3{margin:0; color:#2A2916; font-weight:700; font-size:20px; line-height:1.3}
    #comp-objectifs .head .pdf{
      margin-left:auto; width:clamp(22px,2.5vw,28px); height:clamp(26px,3vw,32px); object-fit:contain; display:block;
    }

    /* ====== Body ====== */
    #comp-objectifs .body{padding:18px 20px 22px;}
    #comp-objectifs .grid{
      display: grid
;
    grid-template-columns: minmax(160px, 306px) 1fr;
    gap: 10px 20px;
    }

    #comp-objectifs .label{color:#6E6D55; font-weight:700; font-size:14px; line-height:19px; padding-top:8px}

    /* Liste objectifs */
    #comp-objectifs .obj-list{list-style:none; padding:0; margin:0;}
    #comp-objectifs .obj-list li{
      display:flex; align-items:flex-start; gap:12px;
      margin:14px 0;
      color:#2A2916; font:400 14px/24px Roboto;
    }
    #comp-objectifs .obj-list li::before{
      content:""; width:14px; height:15px; background:#BF0404;
      clip-path:polygon(0 50%, 100% 0, 100% 100%); flex:0 0 14px; margin-top:4px;
    }

    #comp-objectifs .parag{color:#2A2916; font:400 14px/26px Roboto; letter-spacing: 0px;}

    /* Séparateur (clean, sans positionnement absolu) */
    #comp-objectifs .divider{
      border:0; height:1px; background:#ECEBE3; margin:10px 0 6px;
    }

    /* ====== Responsif ====== */
    @media (max-width: 768px){
      #comp-objectifs .body{padding:14px 14px 18px}
      #comp-objectifs .grid{grid-template-columns:1fr}
      #comp-objectifs .label{padding-top:0}
      #comp-objectifs .obj-list li{margin:10px 0}
    }
  </style>

  <div class="card">
    <div class="head">
      <img class="ico" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/4185501.png" alt="">
      <h3>Objectifs pédagogiques et scientifiques</h3>
      <img class="pdf" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/pdf-svgrepo-com%20(2).png" alt="">
    </div>

    <div class="body">
      <div class="grid">
        <div class="label">Objectifs généraux du master :</div>
        <div>
          <ul class="obj-list">
            <li>Acquérir des compétences avancées en IA, mathématiques appliquées et informatique.</li>
            <li>Préparer à la recherche scientifique ou à des fonctions d’expertise dans l’industrie.</li>
            <li>Maîtriser les techniques modernes de modélisation, d’apprentissage automatique et d’analyse de données.</li>
          </ul>
        </div>
      </div>

      <hr class="divider">

      <div class="grid">
        <div class="label" style="margin-top:8px">Objectifs spécifiques :</div>
        <div class="parag">
          Le Master de Recherche en Intelligence Artificielle (IA) forme des experts capables de concevoir,
          développer et évaluer des systèmes intelligents intégrant des technologies avancées telles que le
          machine learning, le deep learning, le traitement du langage naturel ou encore la vision par ordinateur.
        </div>
      </div>
    </div>
  </div>
</section>
