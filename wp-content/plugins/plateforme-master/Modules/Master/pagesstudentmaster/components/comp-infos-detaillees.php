<section id="comp-infos-detaillees">
  <style>
    /* ===== Scope ===== */
    #comp-infos-detaillees{ display:block; padding:0 12px; width:100%; }
    #comp-infos-detaillees *{ box-sizing:border-box; font-family:Roboto,system-ui,-apple-system,"Segoe UI",Arial,sans-serif }

    /* ===== Card ===== */
    #comp-infos-detaillees .card{
      background:#FFF; border:1px solid #EDEBE7; border-radius:10px; box-shadow:0 3px 16px #00000029;
      margin-top:20px; display:flex; flex-direction:column;
    }

    /* ===== Header (identique au modèle) ===== */
    #comp-infos-detaillees .head{
      display:flex; align-items:center; gap:10px; padding:14px 16px;
      background:#FFF; box-shadow:0 5px 16px #00000012; border-radius:10px 10px 0 0;
    }
    #comp-infos-detaillees .head .ico{ width:clamp(26px,3vw,35px); height:clamp(26px,3vw,35px); object-fit:contain }
    #comp-infos-detaillees .head h3{ margin:0; color:#2A2916; font-weight:700; font-size:20px; line-height:1.3 }
    #comp-infos-detaillees .head .pdf{
      margin-left:auto; width:clamp(22px,2.5vw,28px); height:clamp(26px,3vw,32px); object-fit:contain; display:block;
    }

    /* ===== Body (hauteur plus compacte) ===== */
    #comp-infos-detaillees .body{ padding:10px 16px 12px; display:flex; flex-direction:column; gap:4px }

    /* Lignes label/valeur — compact + pas de séparateurs verticaux */
    #comp-infos-detaillees .row{
      display:grid; grid-template-columns:minmax(150px,230px) 1fr; gap:8px; padding:6px 0;
   }
    #comp-infos-detaillees .row:last-child{ border-bottom:0 }

    #comp-infos-detaillees .row > *{
      /* si un style global ajoutait des bordures verticales, on les neutralise ici */
      border-right:0 !important; border-left:0 !important; background-clip:padding-box;
    }

    #comp-infos-detaillees .label{ color:#6E6D55; font-weight:700; font-size:14px; line-height:18px }
    #comp-infos-detaillees .value{ color:#2A2916; font:400 14px/18px Roboto }

    @media (max-width: 600px){
      #comp-infos-detaillees .row{ grid-template-columns:1fr; }
    }
  </style>

  <div class="card">
    <div class="head">
      <img class="ico" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/12500601.png" alt="">
      <h3>Informations détaillées</h3>
      <img class="pdf" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/pdf-svgrepo-com%20(2).png" alt="">
    </div>

    <div class="body">
      <div class="row"><div class="label">Intitulé du master :</div><div class="value">Master de recherche en AI et Data</div></div>
      <div class="row"><div class="label">Code interne du Master :</div><div class="value">M456</div></div>
      <div class="row"><div class="label">Début d’habilitation :</div><div class="value">13-09-2025</div></div>
      <div class="row"><div class="label">Fin d’habilitation :</div><div class="value">13-09-2025</div></div>
      <div class="row"><div class="label">Nature master :</div><div class="value">Master de recherche</div></div>
    </div>
  </div>
</section>
