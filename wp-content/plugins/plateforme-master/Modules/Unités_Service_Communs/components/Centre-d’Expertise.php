<section id="ceip-view" class="px-3">
  <style>
    #ceip-view{
      --ink:#2A2916;--muted:#6E6D55;--edge:#ECEBE3;--head:#FFFFFF;--line:#EEEADF;--red:#BF0404;
      --badge:#F1F0EA;--badge-stroke:#E1DFC9;
      font-family:Roboto,system-ui,-apple-system,"Segoe UI",Arial;color:var(--ink)
    }
    #ceip-view .card{background:#fff;border-radius:12px;box-shadow:0 6px 24px rgba(0,0,0,.10);padding:16px;display:flex;flex-direction:column;gap:18px}

    /* Header global */
    #ceip-view .title{display:flex;align-items:center;gap:10px}
    #ceip-view .title h3{margin:0;font:700 18px/1 Roboto}
    #ceip-view .btn-ghost{background:#fff;border:2px solid var(--red);color:var(--red);border-radius:8px;height:36px;padding:0 14px;font:700 13px}

    /* Bouton Publier web (Poppins + icône à gauche) */
    #ceip-view .btn-red{
      background:var(--red);color:#fff;border:none;border-radius:8px;height:36px;padding:0 14px;
      display:inline-flex;align-items:center;gap:8px;
      text-align:left;letter-spacing:0;opacity:1;
      font:500 14px/21px "Poppins",system-ui,-apple-system,"Segoe UI",Arial,sans-serif;
    }
    #ceip-view .btn-red .icon{width:16px;height:16px;display:inline-block}

    #ceip-view .actions{margin-left:auto;display:flex;gap:10px}

    /* HR sous le titre (spécifications demandées) */
    #ceip-view .title + hr{
      border:0;border-top:1px solid #ECEBE3;opacity:1;height:0;width:947px;margin:0 0 8px 340px;
    }

    /* ===== COMPOSANT 1 — “Informations détaillés / Directeur” ===== */
    #ceip-view .cid-card{background:#FFFFFF;box-shadow:0px 3px 16px #00000029;border-radius:10px;overflow:hidden}
    #ceip-view .cid-head{display:grid;grid-template-columns:1fr 1fr;gap:20px;background:#FFFFFF;box-shadow:0px 5px 16px #00000012;border-radius:10px 10px 0 0;padding:16px 18px}
    #ceip-view .cid-head h3{margin:0;text-align:left;font:normal normal bold 18px/24px Roboto;color:var(--ink)}
    #ceip-view .cid-sep{border:0;border-top:1px solid var(--edge);margin:0}
    #ceip-view .cid-body{display:grid;grid-template-columns:1fr 1fr;gap:20px;padding:20px 22px}

    /* Colonne gauche */
    #ceip-view .cid-list{display:grid;gap:18px}
    #ceip-view .cid-row{display:grid;grid-template-columns:140px 1fr;align-items:start}
    #ceip-view .cid-label{font:normal 500 14px/17px Roboto;color:var(--muted)}
    #ceip-view .cid-value{font:normal 400 14px/21px Roboto;color:var(--ink)}

    /* Colonne droite : AVATAR au-dessus, INFOS en dessous (comme la capture) */
    #ceip-view .cid-directeur{display:grid;grid-template-columns:1fr;gap:14px}
    #ceip-view .cid-avatar{width:70px;height:70px;border-radius:50%;object-fit:cover;box-shadow:0 2px 8px rgba(0,0,0,.12);justify-self:start}
    #ceip-view .cid-fields{display:grid;gap:10px}
    #ceip-view .cid-field{display:grid;grid-template-columns:260px 1fr;align-items:start}
    #ceip-view .cid-field .k{font:normal 500 14px/17px Roboto;color:var(--muted);white-space:nowrap}
    #ceip-view .cid-field .v{font:normal 400 14px/21px Roboto;color:var(--ink)}

    /* ===== COMPOSANT 2 — “Mission & Objectifs” ===== */
    #ceip-view .mo-card{background:#FFFFFF;box-shadow:0px 3px 16px #00000029;border-radius:10px;overflow:hidden}
    #ceip-view .mo-head{background:#FFFFFF;box-shadow:0px 5px 16px #00000012;border-radius:10px 10px 0 0;padding:12px 16px;border-bottom:1px solid var(--edge)}
    #ceip-view .mo-head h3{margin:0;font:normal 700 18px/24px Roboto;color:var(--ink)}
    #ceip-view .mo-body{padding:18px 20px}
    #ceip-view .mo-body p{margin:0 0 18px;font:normal 400 14px/22px Roboto;color:var(--ink)}
    #ceip-view .mo-sub{margin:10px 0 12px;font:normal 500 14px/17px Roboto;color:var(--muted)}
    #ceip-view .mo-list{list-style:none;margin:0;padding:0;display:grid;gap:12px}
    #ceip-view .mo-item{display:flex;align-items:flex-start;gap:10px}
    #ceip-view .mo-tick{position:relative;width:20px;height:20px;flex:0 0 20px;background:#fff;border:2px solid var(--red);border-radius:6px;box-shadow:0 1px 1px rgba(0,0,0,.04) inset;margin-top:2px}
    #ceip-view .mo-tick::after{content:"";position:absolute;left:7px;top:6px;width:10px;height:6px;border-left:3px solid var(--red);border-bottom:3px solid var(--red);transform:rotate(-45deg);transform-origin:left bottom}
    #ceip-view .mo-text{font:normal 400 14px/22px Roboto;color:var(--ink)}

    /* ===== COMPOSANT 3 — “Organisation & Structure” ===== */
    #ceip-view .os-card{background:#FFFFFF;box-shadow:0px 3px 16px #00000029;border-radius:10px;overflow:hidden}
    #ceip-view .os-head{background:#FFFFFF;box-shadow:0px 5px 16px #00000012;border-radius:10px 10px 0 0;padding:12px 16px;border-bottom:1px solid var(--edge)}
    #ceip-view .os-head h3{margin:0;font:normal 700 18px/24px Roboto;color:var(--ink)}
    #ceip-view .os-body{padding:16px;display:grid;gap:6px}
    #ceip-view .os-table-head{width:100%;border-collapse:separate;border-spacing:0;border:1px solid #DCD9C4;border-radius:8px;overflow:hidden}
    #ceip-view .os-table-head th{background:#ECEBE3;padding:12px 14px;font:700 14px/1 Roboto;text-align:left;color:#3a3a2f}
    #ceip-view .os-table-body{width:100%;border-collapse:separate;border-spacing:0;border:1px solid #E1DFC9;border-radius:8px;overflow:hidden;background:#fff}
    #ceip-view .os-table-body td{padding:12px 14px;font:400 14px/1.4 Roboto;color:var(--ink);border-bottom:1px solid #EFEDE4}
    #ceip-view .os-table-body tr:last-child td{border-bottom:0}
    #ceip-view .os-table-body td+td{border-left:1px solid var(--line)}
    #ceip-view .os-table-body a{color:#1a73e8;text-decoration:none}
    #ceip-view .os-table-body a:hover{text-decoration:underline}

    /* ===== COMPOSANT 4 — “Chiffres Clés + Contact & Support” ===== */
    #ceip-view .cc-grid{display:grid;grid-template-columns:1.3fr 1fr;gap:16px}
    #ceip-view .cc-card{background:#FFFFFF;box-shadow:0px 3px 16px #00000029;border-radius:10px;overflow:hidden}
    #ceip-view .cc-head{background:#FFFFFF;box-shadow:0px 5px 16px #00000012;border-radius:10px 10px 0 0;padding:12px 16px;border-bottom:1px solid var(--edge);font:700 18px/24px Roboto}
    #ceip-view .cc-body{padding:16px}

    /* KPI boxes */
    #ceip-view .kpi-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
    #ceip-view .kpi-box{display:flex;justify-content:space-between;align-items:center;background:#fff;border-radius:10px;box-shadow:0px 3px 12px rgba(0,0,0,.08);padding:14px 16px;position:relative}
    #ceip-view .kpi-box::before{content:"";position:absolute;left:0;top:12px;bottom:12px;width:4px;border-radius:2px;background:var(--red)}
    #ceip-view .kpi-text{font:700 14px/1.3 Roboto;color:var(--ink)}
    #ceip-view .kpi-val{background:var(--badge);border:1px solid var(--badge-stroke);border-radius:8px;padding:6px 14px;font:800 15px Roboto;color:var(--ink);min-width:48px;text-align:center}

    /* Contact — valeurs sous les titres */
    #ceip-view .contact{display:grid;gap:14px}
    #ceip-view .c-row{display:block}
    #ceip-view .c-lab{display:block;font:500 14px/17px Roboto;color:var(--muted);margin-bottom:6px}
    #ceip-view .c-val{display:block;font:400 14px/21px Roboto;color:var(--ink)}
    #ceip-view .sep{height:1px;background:var(--edge);margin:10px 0 2px}

    /* Responsive */
    @media (max-width:1200px){
      #ceip-view .cid-head{grid-template-columns:1fr}
      #ceip-view .cid-body{grid-template-columns:1fr}
    }
    @media (max-width:1024px){
      #ceip-view .cc-grid{grid-template-columns:1fr}
      #ceip-view .title + hr{width:100%;margin-left:0}
    }
    @media (max-width:560px){
      #ceip-view .cid-field, #ceip-view .cid-row{grid-template-columns:1fr}
      #ceip-view .cid-field .k{margin-bottom:4px}
      #ceip-view .mo-body{padding:16px}
      #ceip-view .os-body{padding:12px}
      #ceip-view .os-table-head th, #ceip-view .os-table-body td{padding:10px}
    }
  </style>

  <div class="card">
    <!-- Header -->
    <div class="title">
      <img src="/wp-content/plugins/plateforme-master/images/iconscoordinateur/2274790.png" width="26" height="26" alt="">
      <h3>Centre d’Expertise en Ingénierie de Projets (CEIP)</h3>
      <div class="actions">
        <button class="btn-ghost">Modifier</button>
        <button class="btn-red">
          <img class="icon" src="/wp-content/plugins/plateforme-master/images/pmo/internet-svgrepo-com.png" alt="">
          Publier web
        </button>
      </div>
    </div>
    <hr>

    <!-- ===== Composant 1 ===== -->
    <div class="cid-card">
      <div class="cid-head">
        <h3>Informations détaillés</h3>
        <h3>Directeur</h3>
      </div>
      <hr class="cid-sep">
      <div class="cid-body">
        <!-- Colonne gauche -->
        <div class="cid-list">
          <div class="cid-row"><div class="cid-label">Création :</div><div class="cid-value">2018</div></div>
          <div class="cid-row"><div class="cid-label">Localisation :</div><div class="cid-value">Tunis, Technopole El Ghazala</div></div>
        </div>

        <!-- Colonne droite : avatar au-dessus, infos en dessous -->
        <div class="cid-directeur">
          <img class="cid-avatar" src="/wp-content/plugins/plateforme-master/images/pmo/download.jpg" alt="Directeur">
          <div class="cid-fields">
            <div class="cid-field"><div class="k">Nom et prénom du coordinateur :</div><div class="v">Mr. Ahmed Tayaa</div></div>
            <div class="cid-field"><div class="k">Grade :</div><div class="v">Professeur</div></div>
            <div class="cid-field"><div class="k">Spécialité :</div><div class="v">–</div></div>
            <div class="cid-field"><div class="k">Email académique :</div><div class="v">Ahmed@gmail.com</div></div>
            <div class="cid-field"><div class="k">Téléphone professionnel :</div><div class="v">+216 22 45 45 00</div></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ===== Composant 2 ===== -->
    <div class="mo-card">
      <div class="mo-head"><h3>Mission &amp; Objectifs</h3></div>
      <div class="mo-body">
        <p>Le CEIP a pour mission d’accompagner les chercheurs, enseignants et entreprises dans la gestion, le financement et le suivi des projets d’ingénierie.</p>
        <div class="mo-sub">Objectifs principaux&nbsp;:</div>
        <ul class="mo-list">
          <li class="mo-item"><span class="mo-tick"></span><span class="mo-text">Offrir un appui méthodologique pour la préparation et la gestion des projets.</span></li>
          <li class="mo-item"><span class="mo-tick"></span><span class="mo-text">Développer des partenariats nationaux et internationaux.</span></li>
          <li class="mo-item"><span class="mo-tick"></span><span class="mo-text">Centraliser et diffuser les informations et ressources documentaires.</span></li>
          <li class="mo-item"><span class="mo-tick"></span><span class="mo-text">Fournir une plateforme digitale intégrée pour la gestion des données, dépôts et requêtes.</span></li>
        </ul>
      </div>
    </div>

    <!-- ===== Composant 3 — Organisation & Structure ===== -->
    <div class="os-card">
      <div class="os-head"><h3>Organisation &amp; Structure</h3></div>
      <div class="os-body">
        <table class="os-table-head">
          <thead>
            <tr>
              <th style="width:40%">Nom complet</th>
              <th style="width:35%">Rôle</th>
              <th style="width:25%">Email</th>
            </tr>
          </thead>
        </table>
        <table class="os-table-body">
          <tbody>
            <tr><td>Pr. Hatem Ben Youssef</td><td>Directeur CEIP</td><td><a href="mailto:hatem.youssef@utm.tn">hatem.youssef@utm.tn</a></td></tr>
            <tr><td>Mme. Salma Trabelsi</td><td>Responsable Plateformes Digitales</td><td><a href="mailto:salma.trabelsi@utm.tn">salma.trabelsi@utm.tn</a></td></tr>
            <tr><td>Dr. Yassine Ayari</td><td>Chargé Des Partenariats</td><td><a href="mailto:yassine.ayari@etu.utm.tn">yassine.ayari@etu.utm.tn</a></td></tr>
            <tr><td>M. Amine Mejri</td><td>Responsable Support &amp; Assistance</td><td><a href="mailto:amine.mejri@etu.utm.tn">amine.mejri@etu.utm.tn</a></td></tr>
            <tr><td>Mme. Nour Ben Romdhane</td><td>Assistante Administrative</td><td><a href="mailto:nour.T@etu.utm.tn">nour.T@etu.utm.tn</a></td></tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- ===== Composant 4 — Chiffres Clés + Contact & Support ===== -->
    <div class="cc-grid">
      <!-- Chiffres Clés -->
      <div class="cc-card">
        <div class="cc-head">Chiffres Clés</div>
        <div class="cc-body">
          <div class="kpi-grid">
            <div class="kpi-box"><div class="kpi-text">Projets<br>Accompagnés</div><div class="kpi-val">+120</div></div>
            <div class="kpi-box"><div class="kpi-text">Documents Déposés<br>Sur La Plateforme</div><div class="kpi-val">+500</div></div>
            <div class="kpi-box"><div class="kpi-text">Partenariats<br>Académiques Et Industriels</div><div class="kpi-val">35</div></div>
            <div class="kpi-box"><div class="kpi-text">Taux De Satisfaction<br>Des Utilisateurs</div><div class="kpi-val">96%</div></div>
          </div>
        </div>
      </div>

      <!-- Contact & Support -->
      <div class="cc-card">
        <div class="cc-head">Contact &amp; Support</div>
        <div class="cc-body">
          <div class="contact">
            <div class="c-row">
              <div class="c-lab">Email :</div>
              <div class="c-val">contact@ceip.tn</div>
              <div class="sep"></div>
            </div>
            <div class="c-row">
              <div class="c-lab">Localisation :</div>
              <div class="c-val">Technopole El Ghazala, Bâtiment B2 – Tunis</div>
              <div class="sep"></div>
            </div>
            <div class="c-row">
              <div class="c-lab">Téléphone :</div>
              <div class="c-val">+216 71 000 123</div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>
