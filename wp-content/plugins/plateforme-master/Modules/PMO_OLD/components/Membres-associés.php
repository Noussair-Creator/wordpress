<section id="members-assoc">
  <style>
    /* Palette & base */
    #members-assoc{--ink:#2A2916;--muted:#6E6D55;--edge:#ECEBE3;--line:#E6E4D8;--head:#FFFFFF;--red:#BF0404;font-family:Roboto,system-ui,-apple-system,"Segoe UI",Arial;color:var(--ink)}
    #members-assoc .card{background:#fff; margin-top:20px; box-shadow:0 3px 16px #00000029;border-radius:10px;overflow:hidden}

    /* Header (titre + bouton) */
    #members-assoc .head{
      background:#FFFFFF;box-shadow:0 5px 16px #00000012;
      border-radius:10px 10px 0 0;
      padding:12px 16px;border-bottom:1px solid var(--edge);
      display:flex;align-items:center;gap:14px;height: 54px;
    }
    #members-assoc .head h3{margin:0;font:700 16px/1 Roboto}
    #members-assoc .btn-add{
      margin-left:auto;background:#fff;border:2px solid var(--red);color:var(--red);
      height:32px;border-radius:8px;padding:0 12px;font:700 13px/30px Roboto;cursor:pointer
    }
    #members-assoc .btn-add:hover{filter:brightness(.95)}

    /* Entête (bande gris-beige arrondie) */
    #members-assoc .table-head{
      margin:14px 16px 10px;background:#EEEADF;border:1px solid #E1DFC9;border-radius:8px;
      display:grid;grid-template-columns:48px 1.1fr .9fr 1fr 110px;align-items:center;
      height:38px;padding:0 14px
    }
    #members-assoc .table-head div{font:700 13px/1 Roboto;color:#3a3a2f}
    #members-assoc .table-head .chk{display:flex;align-items:center;justify-content:center}

    /* Corps & état vide */
    #members-assoc .body{padding:0 16px 16px}
    #members-assoc .empty{
      border:1px solid var(--line);border-radius:8px;background:#fff;
      min-height:150px;display:grid;place-items:center
    }
    #members-assoc .empty .inner{display:flex;flex-direction:column;align-items:center;gap:10px}
    #members-assoc .empty .txt{font:400 13px/1.3 Roboto;color:#3a3a2f}

    /* Icône vide (deux carrés superposés) */
    #members-assoc .ico{width:56px;height:40px;opacity:.9}
    #members-assoc .ico .sheet{fill:#F7F7F2;stroke:#D7D5C4}
    #members-assoc .ico .mini{fill:#EDEBDD;stroke:#D7D5C4}

    @media (max-width:700px){
      #members-assoc .table-head{grid-template-columns:40px 1fr .9fr 1fr 90px}
    }
  </style>

  <div class="card">
    <!-- En-tête -->
    <div class="head">
      <h3>Membres associés</h3>
      <button class="btn-add">Inviter des membres</button>
    </div>

    <!-- Bande d'entête -->
    <div class="table-head">
      <div class="chk"><input type="checkbox" aria-label="Tout sélectionner"></div>
      <div>Membres</div>
      <div>Rôle</div>
      <div>Email</div>
      <div>Actions</div>
    </div>

    <!-- Corps : état vide -->
    <div class="body">
      <div class="empty">
        <div class="inner">
          <!-- Icône “vide” -->
          <svg class="ico" viewBox="0 0 88 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <rect class="sheet" x="20" y="14" width="36" height="28" rx="6" />
            <rect class="mini"  x="34" y="22" width="16" height="16" rx="4" />
            <rect class="sheet" x="36" y="20" width="36" height="28" rx="6" />
          </svg>
          <div class="txt">Aucun membre n'est associé pour le moment</div>
        </div>
      </div>
    </div>
  </div>
</section>
