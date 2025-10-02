<section id="docs-assoc">
  <style>
    /* Palette & base */
    #docs-assoc{--ink:#2A2916;--muted:#6E6D55;--edge:#ECEBE3;--line:#E6E4D8;--head:#FFFFFF;--red:#BF0404;font-family:Roboto,system-ui,-apple-system,"Segoe UI",Arial;color:var(--ink)}
    #docs-assoc .card{background:#fff;margin-top:20px; box-shadow:0 3px 16px #00000029;border-radius:10px;overflow:hidden}

    /* Header (titre + bouton) */
    #docs-assoc .head{
      background:#FFFFFF;box-shadow:0 5px 16px #00000012;
      border-radius:10px 10px 0 0;
      padding:12px 16px;border-bottom:1px solid var(--edge);
      display:flex;align-items:center;gap:14px;height: 54px;
    }
    #docs-assoc .head h3{margin:0;font:700 16px/1 Roboto;}
    #docs-assoc .btn-add{
      margin-left:auto;background:#fff;border:2px solid var(--red);color:var(--red);
      height:32px;border-radius:8px;padding:0 12px;font:700 13px/30px Roboto;cursor:pointer
    }
    #docs-assoc .btn-add:hover{filter:brightness(.95)}

    /* Entête (ligne gris-beige arrondie) */
    #docs-assoc .table-head{
      margin:14px 16px 10px;background:#EEEADF;border:1px solid #E1DFC9;border-radius:8px;
      display:grid;grid-template-columns:160px 1fr 120px;align-items:center;
      height:38px;padding:0 14px
    }
    #docs-assoc .table-head div{font:700 13px/1 Roboto;color:#3a3a2f}

    /* Corps & état vide */
    #docs-assoc .body{padding:0 16px 16px}
    #docs-assoc .empty{
      border:1px solid var(--line);border-radius:8px;background:#fff;
      min-height:120px;display:grid;place-items:center
    }
    #docs-assoc .empty .inner{display:flex;flex-direction:column;align-items:center;gap:8px}
    #docs-assoc .empty .txt{font:400 13px/1.3 Roboto;color:#3a3a2f}

    /* Petite icône “documents” (SVG inline) */
    #docs-assoc .ico{width:56px;height:40px;opacity:.9}
    #docs-assoc .ico .sheet{fill:#F7F7F2;stroke:#D7D5C4}
    #docs-assoc .ico .clip{fill:#A9AA7A}

    @media (max-width:640px){
      #docs-assoc .table-head{grid-template-columns:120px 1fr 90px}
    }
  </style>

  <div class="card">
    <!-- En-tête -->
    <div class="head">
      <h3>Documents associés</h3>
      <button class="btn-add">Ajouter des Documents</button>
    </div>

    <!-- Ligne d'entête -->
    <div class="table-head">
      <div>Ref_Doc</div>
      <div>Titre doc</div>
      <div>Actions</div>
    </div>

    <!-- Corps : état vide -->
    <div class="body">
      <div class="empty">
        <div class="inner">
          <!-- Icône empilement de documents -->
          <svg class="ico" viewBox="0 0 88 64" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <!-- feuille arrière -->
            <rect class="sheet" x="8" y="14" width="42" height="48" rx="4"/>
            <rect class="clip"  x="22" y="14" width="14" height="7" rx="2"/>
            <!-- feuille avant -->
            <rect class="sheet" x="36" y="10" width="42" height="48" rx="4"/>
            <rect class="clip"  x="50" y="10" width="14" height="7" rx="2"/>
          </svg>
          <div class="txt">Aucun document associé pour le moment</div>
        </div>
      </div>
    </div>
  </div>
</section>
