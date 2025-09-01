<section id="comp-plan-etude">
  <style>
    #comp-plan-etude{ display:block; padding:0 12px; width:100%; }
    #comp-plan-etude *{ box-sizing:border-box; font-family:Roboto,system-ui,-apple-system,"Segoe UI",Arial,sans-serif }

    /* ===== Card ===== */
    #comp-plan-etude .card{
      background:#FFF; border:1px solid #EDEBE7; border-radius:10px; box-shadow:0 3px 16px #00000029;
      margin-top:20px; display:flex; flex-direction:column;
    }

    /* ===== Header (identique au modèle) ===== */
    #comp-plan-etude .head{
      display:flex; align-items:center; gap:10px; padding:14px 16px;
      background:#FFF; box-shadow:0 5px 16px #00000012; border-radius:10px 10px 0 0;
    }
    #comp-plan-etude .head .ico{ width:clamp(26px,3vw,35px); height:clamp(26px,3vw,35px); object-fit:contain }
    #comp-plan-etude .head h3{ margin:0; color:#2A2916; font-weight:700; font-size:20px; line-height:1.3 }

    /* ===== Body compact ===== */
    #comp-plan-etude .body{ padding:12px 16px 14px; display:flex; }
    #comp-plan-etude .content{
      display:grid; grid-template-columns:90px 1fr; gap:16px; align-items:center; width:100%;
      /* on retire le margin-top négatif et les grands espacements */
    }

    #comp-plan-etude .pdfBox{
      width:70px; height:90px; background:#F0F0EE; border-radius:8px; display:grid; place-items:center;
      box-shadow:inset 0 1px 0 #fff;
    }
    #comp-plan-etude .pdfBox img{ width:50px; height:60px }

    #comp-plan-etude .txt{ color:#2A2916; margin:2px 0 0 0; font:400 14px/20px Roboto }

    #comp-plan-etude .btn{
      margin-top:10px; padding:8px 14px; background:#BF0404; color:#fff; border:none; border-radius:8px;
      display:inline-flex; align-items:center; justify-content:center; gap:8px; cursor:pointer; font:600 14px/18px Roboto;
      box-shadow:0 6px 14px #BF040426;
    }
    #comp-plan-etude .btn img{ width:16px; height:17px; filter:brightness(0) invert(1) }

    @media (max-width: 700px){
      #comp-plan-etude .content{ grid-template-columns:1fr; justify-items:start }
    }
  </style>

  <div class="card">
    <div class="head">
      <img class="ico" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/17015024.png" alt="">
      <h3>Plan d’étude</h3>
    </div>

    <div class="body">
      <div class="content">
        <div class="pdfBox">
          <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/pdf-svgrepo-com%20(2).png" alt="">
        </div>
        <div>
          <div class="txt">Veuillez trouver ci-joint le PDF des plans d’étude.</div>
          <button class="btn" type="button">
            <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-upload.png" alt="">
            Télécharger
          </button>
        </div>
      </div>
    </div>
  </div>
</section>
