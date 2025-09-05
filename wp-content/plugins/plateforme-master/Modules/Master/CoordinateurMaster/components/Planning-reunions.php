<section id="planning-reunions">
  <style>
    /* ===== Palette & reset local ===== */
    #planning-reunions {
      --ink:#2A2916;
      --muted:#8E8C78;
      --edge:#ECEBE3;
      --line:#EBE9D7;
      --olive:#A6A485;
      --accent:#BF0404;
      --card-bg:#FFFFFF;
      font-family: Roboto, system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
      color: var(--ink);
    }
    #planning-reunions{
  --ink:#2A2916; --muted:#8E8C78; --edge:#ECEBE3; --line:#EBE9D7;
  --olive:#A6A485; --accent:#BF0404; --card-bg:#FFFFFF;
  font-family: Roboto, system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
  color: var(--ink);

  /* ⬇️ important */
  width: 100%;
  max-width: none;    /* supprime la contrainte à 360px */
}

#planning-reunions .card{
  width: 100%;       /* la card remplit la colonne */
  padding:14px;
  margin-top:20px;
}

    #planning-reunions .card {
      background: var(--card-bg);
      border-radius: 16px;
      box-shadow: 0 6px 24px rgba(0,0,0,.08), 0 2px 8px rgba(0,0,0,.06);
      padding: 14px;margin-top: 20px;
    }
    #planning-reunions .title {
      font-weight: 700;
      font-size: 16px;
      margin: 0 0 10px 0;
    }

    /* ===== Barre de mois ===== */
    #planning-reunions .monthbar {
      background: var(--olive);
      color: #fff;
      border-radius: 10px;
      height: 36px;
      display: grid;
      grid-template-columns: 1fr auto;
      align-items: center;
      padding: 0 8px;
      margin-bottom: 10px;
    }
    #planning-reunions .month-left {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-weight: 700;
      padding-left: 8px;
    }
    #planning-reunions .caret {
      display:inline-block; width:0; height:0;
      border-left: 5px solid transparent;
      border-right:5px solid transparent;
      border-top:6px solid #fff;
      margin-left: 4px;
      opacity:.9;
    }
    #planning-reunions .nav {
      display: inline-flex; gap: 6px; align-items: center;
    }
   /* Boutons flèches blancs, chevrons fins */
#planning-reunions .btn{
  width:28px; height:28px; border-radius:8px;
  background:#fff; border:1px solid rgba(0,0,0,.06);
  display:grid; place-items:center; padding:0;
  box-shadow:0 2px 6px rgba(0,0,0,.12); cursor:default;
}
#planning-reunions .btn svg{ width:16px; height:16px; display:block; }
#planning-reunions .btn path{
  stroke:#6F6C52; stroke-width:2.2; fill:none;
  stroke-linecap:round; stroke-linejoin:round;
}

    #planning-reunions .btn:disabled { opacity:.9 }

    /* ===== Grille du calendrier ===== */
    #planning-reunions .grid {
      background:#fff;
      border-radius: 12px;
      padding: 6px 8px 10px;
    }
    #planning-reunions .dow {
      display:grid;
      grid-template-columns: repeat(7, 1fr);
      font-size: 12px;
      color: var(--muted);
      text-align:center;
      gap: 4px;
      margin-bottom: 6px;
    }
    #planning-reunions .days {
      display:grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 4px;
    }

    /* Cellule jour */
    #planning-reunions .d {
      height: 34px;
      display:grid; place-items:center;
      font-size: 14px; font-weight:600;
      position:relative;
    }
    /* Jours hors du mois */
    #planning-reunions .muted { color:#B7B5A3; font-weight:500; }

    /* Marquages spéciaux */
    /* cercle rouge fin (1, 15, 17) */
    #planning-reunions .circle {
      width: 28px; height: 28px; border-radius: 50%;
      border: 2px solid var(--accent);
      display:grid; place-items:center;background: #BF04041F 0% 0% no-repeat padding-box;
    }
    /* pastille rouge pleine (10) */
    #planning-reunions .filled {
      width: 28px; height: 28px; border-radius: 50%;
      background: var(--accent);
      color:#fff; display:grid; place-items:center;
      font-weight:700;
    }

  /* Week-ends en gris (Sam = 6e, Dim = 7e) */
#planning-reunions .days .d:nth-child(7n-1),
#planning-reunions .days .d:nth-child(7n) {
  color:#B7B5A3;            /* texte gris */
}

/* Si un jour du week-end est entouré (circle), on garde la bordure rouge mais on grise le chiffre */
#planning-reunions .days .d:nth-child(7n-1) .circle,
#planning-reunions .days .d:nth-child(7n)   .circle{
  color:#B7B5A3;
  /* border-color reste rouge (var(--accent)) -> on ne le change pas */
}

/* Si un jour du week-end est en pastille pleine, on laisse le texte blanc (contraste) */
#planning-reunions .days .d:nth-child(7n-1) .filled,
#planning-reunions .days .d:nth-child(7n)   .filled{
  color:#fff;
}

  </style>

  <div class="card">
    <h3 class="title">Planning des reunions</h3>

    <div class="monthbar">
      <div class="month-left">
        Janvier, 2025 <span class="caret"></span>
      </div>
      <div class="nav">
  <button class="btn" aria-label="Mois précédent">
    <!-- chevron gauche -->
    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path d="M15 19L8 12l7-7"></path>
    </svg>
  </button>
  <button class="btn" aria-label="Mois suivant">
    <!-- chevron droit -->
    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path d="M9 5l7 7-7 7"></path>
    </svg>
  </button>
</div>

    </div>

    <div class="grid">
      <div class="dow">
        <div>Lun</div><div>Mar</div><div>Mer</div><div>Jeu</div><div>Ven</div><div>Sam</div><div>Dim</div>
      </div>

      <!-- Janvier 2025 commence Mercredi (01/01/2025). On affiche les jours précédents (30,31) en grisé
           et on termine par les 1–2 de février en grisé, pour un rendu identique à la capture. -->
      <div class="days">
        <!-- Semaine 1 -->
        <div class="d muted">30</div>
        <div class="d muted">31</div>
        <div class="d"><div class="circle">1</div></div>
        <div class="d">2</div>
        <div class="d">3</div>
        <div class="d">4</div>
        <div class="d">5</div>

        <!-- Semaine 2 -->
        <div class="d">6</div>
        <div class="d">7</div>
        <div class="d">8</div>
        <div class="d">9</div>
        <div class="d"><div class="filled">10</div></div>
        <div class="d">11</div>
        <div class="d">12</div>

        <!-- Semaine 3 -->
        <div class="d">13</div>
        <div class="d"><div class="circle">15</div></div>
        <div class="d">16</div>
        <div class="d"><div class="circle">17</div></div>
        <div class="d">18</div>
        <div class="d">19</div>
        <div class="d">20</div>

        <!-- Semaine 4 -->
        <div class="d">21</div>
        <div class="d">22</div>
        <div class="d">23</div>
        <div class="d">24</div>
        <div class="d">25</div>
        <div class="d">26</div>
        <div class="d">27</div>

        <!-- Semaine 5 -->
        <div class="d">28</div>
        <div class="d">29</div>
        <div class="d">30</div>
        <div class="d">31</div>
        <div class="d muted">1</div>
        <div class="d muted">2</div>
      </div>
    </div>
  </div>
</section>
