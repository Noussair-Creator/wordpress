<!-- KPIs “Vue Globale” — version responsive -->
<div id="notes-kpis">
  <style>
    /* ===== Styles SCOPÉS ===== */
    #notes-kpis{
      --ink:#2A2916; --muted:#6E6D55; --line:#ECEBE3; --chip:#ECEBE3; --card:#FFFFFF;
      --shadow:0px 3px 22px #0000000F; --stripe-red:#BF0404; --stripe-pink:#EAABAB;
      --btn-green-bg:#1998153B; --btn-green-b:#199815; --btn-yellow-bg:#E1E16752; --btn-yellow-b:#FFCD00;
      font-family: Roboto, -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif; color:var(--ink);
    }
    #notes-kpis *,#notes-kpis *::before,#notes-kpis *::after{box-sizing:border-box}

    /* Conteneur: centré, fluide */
    #notes-kpis .wrap{
      width:100%;
      
      margin:0 auto;
      background:#FFFFFF;border-radius:8px;box-shadow:var(--shadow);
      border:1px solid #e7e4d7;overflow:hidden;
    }

    /* En-tête */
    #notes-kpis .hdr{display:flex;align-items:center;gap:12px;padding:10px 16px 8px}
    #notes-kpis .ico{
      width:42px;height:43px;flex:0 0 42px;
      background:transparent url('/wp-content/plugins/plateforme-master/images/icon%20etudiant/3329498.png') 0 0/contain no-repeat;
    }
    #notes-kpis .title{font:700 20px/26px Roboto;color:#2A2916}
    #notes-kpis .sep{margin:0 auto;width:calc(100% - 32px);height:0;border-top:1px solid var(--line)}

    /* Grille: 4 cols par défaut */
    #notes-kpis .grid{
  
    padding: 14px 16px;
    display: grid
;
    /* grid-template-columns: 255px 255px 254px 119px; */
    grid-template-rows: auto auto;
    column-gap: 18px;
    row-gap: 18px;
    align-items: center;
    align-content: center;
    justify-items: center;
    }
    #notes-kpis .b1{grid-column:1} .b2{grid-column:2}
    #notes-kpis .b3{grid-column:1} .b4{grid-column:2}
    #notes-kpis .big{grid-column:3;grid-row:1 / span 2}
    #notes-kpis .status{grid-column:4;grid-row:1;display:flex;flex-direction:column;gap:18px}

    /* Petites cartes */
    #notes-kpis .box{
      position:relative;width:100%;min-height:77px;background:#FFFFFF;border-radius:10px;box-shadow:0 0 16px #00000017;
      padding:14px 24px;display:flex;align-items:center;
    }
    #notes-kpis .box::before{content:"";position:absolute;left:0;top:16px;width:4px;height:45px;border-radius:0 10px 10px 0;background:transparent}
    #notes-kpis .stripe-red::before{background:#BF0404}
    #notes-kpis .stripe-pink::before{background:#EAABAB}
    #notes-kpis .label{font:700 16px/21px Roboto;color:#2A2916}
    #notes-kpis .value{
      margin-left:auto; width:67px;height:50px;background:#ECEBE3;border-radius:5px;display:grid;place-items:center;flex:0 0 67px;
    }
    #notes-kpis .value b{font:700 22px/29px Roboto;color:#2A2916}

    /* Grande carte */
    #notes-kpis .big{
      width:100%;background:#FFFFFF;border-radius:10px;box-shadow:0 0 16px #00000017;
      padding:14px;display:flex;flex-direction:column;justify-content:space-between;gap:10px;
      min-height:172px;
    }
    #notes-kpis .krow{display:flex;align-items:center;justify-content:space-between;gap:12px}
    #notes-kpis .krow .lbl{font:700 16px/21px Roboto;color:#2A2916}
    #notes-kpis .krow .pill{width:67px;height:50px;background:#ECEBE3;border-radius:5px;display:grid;place-items:center;flex:0 0 67px}
    #notes-kpis .krow .pill b{font:700 22px/29px Roboto;color:#2A2916}
    #notes-kpis .inner-sep{width:100%;height:0;border-top:1px solid var(--line)}

    /* Statuts */
    #notes-kpis .pill-status{
      width:119px;height:35px;border-radius:19px;border:1px solid;display:flex;align-items:center;justify-content:center;
      font:400 15px/20px Roboto;
    }
    #notes-kpis .pill-status.green{background:#1998153B;border-color:#199815;color:#199815}
    #notes-kpis .pill-status.yellow{background:#E1E16752;border-color:#FFCD00;color:#EABE56}

    /* ====== Responsiveness ====== */

    /* <= 1200px : grille en 3 colonnes (les statuts passent sous la big) */
    @media (max-width:1200px){
      #notes-kpis .grid{
        grid-template-columns:repeat(3, 1fr);
        column-gap:16px;
      }
      #notes-kpis .status{grid-column:1 / span 3; grid-row:auto; flex-direction:row; gap:12px}
      #notes-kpis .pill-status{width:auto; padding:6px 14px}
    }

    /* <= 900px : grille en 2 colonnes */
    @media (max-width:900px){
      #notes-kpis .grid{
        grid-template-columns:1fr 1fr;
        row-gap:14px; column-gap:14px;
      }
      #notes-kpis .b1{grid-column:auto} .b2{grid-column:auto}
      #notes-kpis .b3{grid-column:auto} .b4{grid-column:auto}
      #notes-kpis .big{grid-column:1 / span 2; grid-row:auto}
      #notes-kpis .status{grid-column:1 / span 2; justify-content:flex-start; flex-wrap:wrap}
    }

    /* <= 600px : une seule colonne, typographies qui respirent */
    @media (max-width:600px){
      #notes-kpis .wrap{border-radius:10px}
      #notes-kpis .hdr{padding:10px 12px}
      #notes-kpis .title{font-size:18px; line-height:24px}
      #notes-kpis .grid{grid-template-columns:1fr; padding:12px}
      #notes-kpis .box{padding:12px 14px}
      #notes-kpis .label{font-size:15px}
      #notes-kpis .value, #notes-kpis .krow .pill{width:60px;height:44px}
      #notes-kpis .value b, #notes-kpis .krow .pill b{font-size:20px; line-height:26px}
      #notes-kpis .status{grid-column:1; flex-direction:row; gap:10px}
      #notes-kpis .pill-status{width:auto; padding:6px 12px; height:auto}
    }

    /* Confort : réduire animations si demandé */
    @media (prefers-reduced-motion: reduce){
      #notes-kpis *{scroll-behavior:auto; transition:none}
    }
  </style>

  <section class="wrap">
    <!-- En-tête -->
    <div class="hdr">
      <i class="ico" aria-hidden="true"></i>
      <div class="title">Vue Globale</div>
    </div>
    <div class="sep"></div>

    <div class="grid">
      <!-- Moyenne S1 -->
      <div class="box stripe-red b1">
        <div class="label">Moyenne<br>Semestre 1</div>
        <div class="value"><b>11.78</b></div>
      </div>

      <!-- Moyenne S2 -->
      <div class="box stripe-pink b2">
        <div class="label">Moyenne<br>Semestre 2</div>
        <div class="value"><b>12.08</b></div>
      </div>

      <!-- Crédit S1 -->
      <div class="box stripe-red b3">
        <div class="label">Crédit Semestre 1</div>
        <div class="value"><b>22</b></div>
      </div>

      <!-- Crédit S2 -->
      <div class="box stripe-pink b4">
        <div class="label">Crédit Semestre 2</div>
        <div class="value"><b>15</b></div>
      </div>

      <!-- Grande carte -->
      <div class="big">
        <div class="krow">
          <div class="lbl">Moyenne Générale</div>
          <div class="pill"><b>11.34</b></div>
        </div>
        <div class="inner-sep"></div>
        <div class="krow">
          <div class="lbl">Crédit Total</div>
          <div class="pill"><b>27</b></div>
        </div>
      </div>

      <!-- Statuts -->
      <div class="status">
        <div class="pill-status green">Admis</div>
        <div class="pill-status yellow">Assez bien</div>
      </div>
    </div>
  </section>
</div>
