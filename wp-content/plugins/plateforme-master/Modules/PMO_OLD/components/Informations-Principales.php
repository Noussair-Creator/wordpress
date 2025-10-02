<section id="infos-principales">
  <style>
    #infos-principales{
      --ink:#2A2916;--muted:#6E6D55;--edge:#ECEBE3;--head:#FFFFFF;
      --green:#1C7F45;--green-b:#A8D6BB;--green-bg:#EAF7F0;
      font-family:Roboto,system-ui,-apple-system,"Segoe UI",Arial;color:var(--ink)
    }
    .ip-card{background:#fff;box-shadow:0 3px 16px #00000029;border-radius:10px;overflow:hidden}
    .ip-head{background:#FFFFFF;box-shadow:0px 5px 16px #00000012;border-radius:10px 10px 0 0;height: 54px;
      padding:12px 16px;border-bottom:1px solid var(--edge)}
    .ip-head h3{margin:0;font:700 16px/1 Roboto}
    .ip-body{padding:14px 18px}

    /* grille libellé / valeur */
    .kv{display:grid;gap:0;margin:0 0 8px}
    .r{display:grid;grid-template-columns:368px 1fr;align-items:center;min-height:38px;border-top:1px solid var(--edge)}
    .r:first-child{border-top:0}
    .k{text-align: left;
font: normal normal bold 14px/19px Roboto;
letter-spacing: 0px;
color: #6E6D55;
opacity: 1;}
    .v{text-align: left;
font: normal normal normal 14px/17px Roboto;
letter-spacing: 0px;
color: #2A2916;
opacity: 1;}
    .dates{display:flex;align-items:center;gap:18px}
    .pill{display:inline-block;padding:6px 16px;border-radius:20px;background:#EAF7F0;border:1px solid #A8D6BB;color:#1C7F45;font:700 13px/1 Roboto}
    a.link{color:#1a73e8;text-decoration:none} a.link:hover{text-decoration:underline}

    /* >>> Head interne pour "Description détaillée" (dans la même card) */
    .seg-head{
      margin:12px -18px 0;             /* déborde pour prendre toute la largeur de la card */
      padding:12px 16px;
      background: #FFFFFF 0% 0% no-repeat padding-box;
box-shadow: 0px 5px 16px #00000012;
opacity: 1;
font: 700 16px / 1 Roboto;    }
    .seg-body{padding:12px 18px 16px}
    .seg-body p{margin:0;font:400 14px/22px Roboto;color:var(--ink)}

    @media (max-width:640px){
      .r{grid-template-columns:1fr}
      .k{margin:8px 0 4px}
      .seg-head{margin-left:-14px;margin-right:-14px} /* légère adaptation si padding diffère */
    }
  </style>

  <div class="ip-card">
    <div class="ip-head"><h3>Informations Principales</h3></div>
    <div class="ip-body">
      <div class="kv">
        <div class="r"><div class="k">Nom de la plateforme :</div><div class="v">Plateforme A</div></div>
        <div class="r"><div class="k">Responsable :</div><div class="v">Dr. Dupont</div></div>
        <div class="r"><div class="k">Domaine :</div><div class="v">Energie</div></div>
        <div class="r">
          <div class="k">Date de création / mise à jour :</div>
          <div class="v"><span class="dates"><span>01/03/2024</span><span>-</span><span>28/03/2024</span></span></div>
        </div>
        <div class="r"><div class="k">Statut :</div><div class="v"><span class="pill">Active</span></div></div>
        <div class="r"><div class="k">Lien externe / Site dédié :</div><div class="v"><a class="link" href="https://plateforme-energie.tn" target="_blank" rel="noopener">https://plateforme-energie.tn</a></div></div>
      </div>

      <!-- Head interne + corps de la description DANS la même card -->
      <div class="seg-head">Description détaillée</div>
      <div class="seg-body">
        <p>
          Le lorem ipsum est, en imprimerie, une suite de mots sans signification utilisée à titre provisoire
          pour calibrer une mise en page, le texte définitif venant remplacer le faux-texte dès qu’il est prêt
          ou que la mise en page est achevée. Généralement, on utilise un texte en faux latin, le Lorem ipsum
          ou Lipsum.
        </p>
      </div>
    </div>
  </div>
</section>
