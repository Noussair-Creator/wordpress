<section id="meeting-now">
  <style>
    #meeting-now{ --ink:#2A2916; --muted:#9A9987; --edge:#ECEBE3; --line:#EBE9D7; --brand:#BF0404; --bg:#FFFFFF; }

    /* Carte */
    #meeting-now .card{
      background:var(--bg); border:1px solid var(--edge); border-radius:10px;
      box-shadow:0 6px 24px rgba(0,0,0,.08);
      padding:14px 16px 12px; position:relative; color:var(--ink);
      font-family:Roboto, Arial, sans-serif;margin-top: 20px;height: 330px;
    }

    /* En-tête */
    #meeting-now .head{display:flex;align-items:center;gap:10px;margin-bottom:8px}
    #meeting-now .ico{width:28px;height:28px;flex:0 0 28px;border-radius:4px;background:#fff url('/wp-content/plugins/plateforme-master/images/iconscoordinateur/7398214.png') center/contain no-repeat}
    #meeting-now .title{font:700 18px/1 Roboto}
    #meeting-now .join{margin-left:auto;height:34px;padding:0 14px;border-radius:8px;background:var(--brand);color:#fff;border:1px solid var(--brand);font:700 14px/1 Roboto}

    /* Séparateur fin */
    #meeting-now .divider{border:0;border-top:1px solid var(--line);margin:10px 0 12px}

    /* Grille infos */
    #meeting-now dl{display:grid;grid-template-columns:140px 1fr;column-gap:56px;row-gap:14px;margin:0}
    #meeting-now dt{font:500 14px/18px Roboto;color:#A6A485}
    #meeting-now dd{margin:0;font:400 14px/20px Roboto}

    /* Participants */
    #meeting-now .participants{list-style:none;margin:0;padding:0}
    #meeting-now .participants li{display:flex;align-items:center;gap:8px;margin:4px 0}
    #meeting-now .dot{width:7px;height:7px;border-radius:50%;background:var(--brand);display:inline-block}

    /* ===== BOTTOM (comme ta capture) ===== */
    #meeting-now .footer{
      display:flex;align-items:center;justify-content:space-between;
      margin-top:32px;
    }

    /* Checkbox carrée rouge avec ✓ blanc */
    #meeting-now .reminder{display:flex;align-items:center;gap:10px}
    #meeting-now .chk{
      appearance:none; width:18px; height:18px; margin:0; border-radius:4px;
      background:#fff; border:1px solid var(--brand); position:relative; cursor:pointer;
    }
    #meeting-now .chk:checked{ background:var(--brand); }
    #meeting-now .chk::after{
      content:""; position:absolute; left:5px; top:2px; width:6px; height:10px;
      border:2px solid #fff; border-top:0; border-left:0; transform:rotate(45deg);
      opacity:0;
    }
    #meeting-now .chk:checked::after{ opacity:1; }
    #meeting-now .reminder label{margin:0;font:400 14px/1 Roboto;color:var(--ink)}

    /* Deux petits boutons blancs avec flèches rouges */
    #meeting-now .nav{display:flex;gap:8px}
    #meeting-now .nav .btn{
      width:32px; height:28px; border:1px solid #EEE; border-radius:10px;
      background:#fff; display:grid; place-items:center; cursor:pointer;
      box-shadow:0 2px 8px rgba(0,0,0,.08);
      padding:0;
    }
    #meeting-now .nav .btn svg{width:12px;height:9px;display:block}
    #meeting-now .nav .btn path{stroke:var(--brand)}
  </style>

  <div class="card">
    <!-- Header -->
    <div class="head">
      <span class="ico" aria-hidden="true"></span>
      <div class="title">Réunion en cours / à venir</div>
      <button class="join" type="button">Rejoindre</button>
    </div>

    <hr class="divider">

    <!-- Infos -->
    <dl>
      <dt>Date :</dt>
      <dd>Vendredi 10 mai, 2025 - 11h00</dd>

      <dt>Sujet :</dt>
      <dd>Soutenance Master IA - groupe A</dd>

      <dt>Participants :</dt>
      <dd>
        <ul class="participants">
          <li><span class="dot"></span> Mr. Salah Ben Aisa</li>
          <li><span class="dot"></span> Mm. Ahlem Chaieb</li>
          <li><span class="dot"></span> Mm. Sonia Bousalem</li>
        </ul>
      </dd>
    </dl>

    <hr class="divider">

    <!-- Bas : rappel + deux flèches séparées -->
    <div class="footer">
      <div class="reminder">
        <input id="remindNow" class="chk" type="checkbox" checked>
        <label for="remindNow">Rappel activé</label>
      </div>

      <div class="nav" aria-label="Navigation réunions">
        <button class="btn" title="Précédent" aria-label="Précédent">
          <svg viewBox="0 0 12 9" xmlns="http://www.w3.org/2000/svg" fill="none">
            <path d="M6.5 8.5L1 4.5L6.5 0.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M1 4.5H11" stroke-width="1.5" stroke-linecap="round"/>
          </svg>
        </button>
        <button class="btn" title="Suivant" aria-label="Suivant">
          <svg viewBox="0 0 12 9" xmlns="http://www.w3.org/2000/svg" fill="none">
            <path d="M5.5 0.5L11 4.5L5.5 8.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M11 4.5H1" stroke-width="1.5" stroke-linecap="round"/>
          </svg>
        </button>
      </div>
    </div>
  </div>
</section>
