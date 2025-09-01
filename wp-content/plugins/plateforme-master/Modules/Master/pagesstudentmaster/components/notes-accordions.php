<!-- Notes Accordions Component -->
<div id="notes-accordions">
  <style>
  /* ===== Styles SCOPÉS pour notes-accordions ===== */
#notes-accordions{
  --ink:#2A2916; --muted:#6E6D55; --line:#ECEBE3; --card:#FFFFFF;
  --shadow:0px 9px 16px #0000001A; --active-bg:#A6A485; --content-bg:#F8F7F4;
  font-family: Roboto, -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;
  color:var(--ink); margin-top:20px;
}
#notes-accordions *,#notes-accordions *::before,#notes-accordions *::after{box-sizing:border-box}

/* Conteneur principal : centré, fluide (mêmes principes que notes-kpis) */
#notes-accordions .accordion-container{
  margin: 0 auto;
}

/* Onglets semestres */
#notes-accordions .semester-tabs{
  display:flex; gap:8px; margin-bottom:0; flex-wrap:wrap;
  border-radius:10px 10px 0 0; overflow:hidden;
}
#notes-accordions .tab{
  flex:1 1 220px; /* largeur mini, puis s'étire */
  min-height:56px;
  display:flex; align-items:center; justify-content:center;
  font:700 20px/20px Roboto; cursor:pointer; transition:.3s;
  border:none; outline:none; border-radius:10px 10px 0 0;
  background:var(--active-bg); color:#fff;
}
#notes-accordions .tab.active{ background:#fff; color:var(--ink); box-shadow:inset 0 -3px 0 0 #fff }

/* Items */
#notes-accordions .accordion-item{ margin-bottom:0; border:none }

/* En‑tête d’UE */
#notes-accordions .unit-header{
  width:100%;
  min-height:60px;
  background:var(--card);
  box-shadow:var(--shadow);
  display:flex; align-items:center; justify-content:space-between;
  padding:0 24px; cursor:pointer; transition:.3s;
  border-radius:6px;
}
#notes-accordions .unit-title{ font:700 15px/20px Roboto; color:var(--muted); margin:0 }
#notes-accordions .toggle-icon{ width:16px; height:9px; transition:transform .3s; fill:var(--muted) }
#notes-accordions .unit-header.expanded .toggle-icon{ transform:rotate(180deg) }

/* Contenu d’UE */
#notes-accordions .unit-content{
  width:100%;
  background:#f8f7f4;
  padding:24px;
  display:none;
  border-radius:6px;
  
}
#notes-accordions .unit-content.show{ display:block }

/* Infos matière */
#notes-accordions .subject-info{ font:500 15px/18px Roboto; color:var(--ink); margin-bottom:14px }

/* Tableau des notes -> CSS Grid responsive */
#notes-accordions .grades-table{
  width:100%;
  background:var(--card);
  border:1px solid var(--line);
  border-radius:5px;
  margin-bottom:18px;
  overflow:hidden;
}
#notes-accordions .table-header,
#notes-accordions .table-values{
  display:grid; align-items:center;
  grid-template-columns: 1fr 1fr 1fr 0.8fr; /* Exam | TP | M | C */
  gap:12px; padding:0 15px;
}
#notes-accordions .table-header{ height:41px; border-bottom:1px solid var(--line) }
#notes-accordions .table-values{ min-height:42px }
#notes-accordions .table-header span,
#notes-accordions .table-values span{ font:400 14px/17px Roboto; color:var(--ink) }

/* Résumé */
#notes-accordions .summary-box{
  width:100%; min-height:56px; background:var(--line);
  border:1px solid var(--active-bg); border-radius:5px;
  display:flex; align-items:center; justify-content:space-between;
  padding:0 24px; gap:16px; flex-wrap:wrap;
}
#notes-accordions .summary-item{ display:flex; align-items:center; gap:10px }
#notes-accordions .summary-label{ font:500 14px/17px Roboto; color:var(--muted) }
#notes-accordions .summary-value{ font:700 16px/21px Roboto; color:var(--ink) }

/* ===== Breakpoints ===== */

/* <= 1200px : confort */
@media (max-width:1200px){
  #notes-accordions .accordion-container{ width: clamp(320px, 94vw, 1200px) }
}

/* <= 900px : tableau sur 2 colonnes (Exam|TP sur ligne 1, M|C sur ligne 2) */
@media (max-width:900px){
  #notes-accordions .tab{ flex:1 1 260px; font-size:18px }
  #notes-accordions .unit-header{ padding:0 18px }
  #notes-accordions .unit-content{ padding:20px }
  #notes-accordions .table-header,
  #notes-accordions .table-values{
    grid-template-columns: 1fr 1fr;
  }
  /* étiquettes “fines” si besoin */
  #notes-accordions .table-header span:nth-child(3)::after,
  #notes-accordions .table-header span:nth-child(4)::after{ content:""; }
}

/* <= 600px : 1 colonne empilée */
@media (max-width:600px){
  #notes-accordions .tab{ flex:1 1 100%; min-height:48px; font-size:16px }
  #notes-accordions .unit-header{ padding:0 14px; min-height:54px }
  #notes-accordions .unit-title{ font-size:14px }
  #notes-accordions .unit-content{ padding:14px }
  #notes-accordions .subject-info{ font-size:14px }
  #notes-accordions .table-header,
  #notes-accordions .table-values{
    grid-template-columns: 1fr; gap:8px; padding:10px 12px;
  }
  #notes-accordions .summary-box{ padding:10px 12px; gap:10px }
}

/* réduit les animations si demandé par l’OS */
@media (prefers-reduced-motion: reduce){
  #notes-accordions *{ transition:none }
}

  </style>

  <section class="accordion-container">
    <!-- Onglets des semestres -->
    <div class="semester-tabs">
      <button class="tab semester-1 active" data-semester="1">Semestre 1</button>
      <button class="tab semester-2" data-semester="2">Semestre 2</button>
    </div>

    <!-- Contenu Semestre 1 -->
    <div class="semester-content" data-semester="1">
      
      <!-- Unité d'enseignement : Finance internationale -->
      <div class="accordion-item">
        <div class="unit-header" data-toggle="collapse" data-target="#unit1">
          <h3 class="unit-title">Unité d’enseignement : Finance internationale et institutions financières</h3>
          <svg class="toggle-icon" viewBox="0 0 16 9">
            <path d="M8 9L0 1h16L8 9z"/>
          </svg>
        </div>
        
        <div class="unit-content show" id="unit1">
          <!-- Matière 1 -->
          <div class="subject-info">Matière : Gestion financière internationale Cr : 2 Coef : 1</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">11</span>
              <span class="col-tp">14.25</span>
              <span class="col-moyenne">13.75</span>
              <span class="col-credit">7</span>
            </div>
          </div>

          <!-- Matière 2 -->
          <div class="subject-info">Matière : Gestion des Institutions Financières Cr : 2 Coef : 1</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">11</span>
              <span class="col-tp">14.25</span>
              <span class="col-moyenne">13.75</span>
              <span class="col-credit">7</span>
            </div>
          </div>

          <!-- Résumé -->
          <div class="summary-box">
            <div class="summary-item">
              <span class="summary-label">Moyenne</span>
              <span class="summary-value">14.89</span>
            </div>
            <div class="summary-item">
              <span class="summary-label">Crédit</span>
              <span class="summary-value">0</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Unité d'enseignement : Économétrie -->
      <div class="accordion-item">
        <div class="unit-header" data-toggle="collapse" data-target="#unit2">
          <h3 class="unit-title">Unité d’enseignement : Économétrie</h3>
          <svg class="toggle-icon" viewBox="0 0 16 9">
            <path d="M8 9L0 1h16L8 9z"/>
          </svg>
        </div>
        
        <div class="unit-content" id="unit2">
          <!-- Matière 1 -->
          <div class="subject-info">Matière : Gestion financière internationale Cr : 2 Coef : 1</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">11</span>
              <span class="col-tp">14.25</span>
              <span class="col-moyenne">13.75</span>
              <span class="col-credit">7</span>
            </div>
          </div>

          <!-- Matière 2 -->
          <div class="subject-info">Matière : Gestion des Institutions Financières Cr : 2 Coef : 1</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">11</span>
              <span class="col-tp">14.25</span>
              <span class="col-moyenne">13.75</span>
              <span class="col-credit">7</span>
            </div>
          </div>

          <!-- Résumé -->
          <div class="summary-box">
            <div class="summary-item">
              <span class="summary-label">Moyenne</span>
              <span class="summary-value">14.89</span>
            </div>
            <div class="summary-item">
              <span class="summary-label">Crédit</span>
              <span class="summary-value">0</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Unité d'enseignement : Gestion de portefeuille -->
      <div class="accordion-item">
        <div class="unit-header" data-toggle="collapse" data-target="#unit3">
          <h3 class="unit-title">Unité d’enseignement : Gestion de portefeuille</h3>
          <svg class="toggle-icon" viewBox="0 0 16 9">
            <path d="M8 9L0 1h16L8 9z"/>
          </svg>
        </div>
        
        <div class="unit-content" id="unit3">
          <!-- Matière 1 -->
          <div class="subject-info">Matière : Gestion financière internationale Cr : 2 Coef : 1</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">11</span>
              <span class="col-tp">14.25</span>
              <span class="col-moyenne">13.75</span>
              <span class="col-credit">7</span>
            </div>
          </div>

          <!-- Matière 2 -->
          <div class="subject-info">Matière : Gestion des Institutions Financières Cr : 2 Coef : 1</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">11</span>
              <span class="col-tp">14.25</span>
              <span class="col-moyenne">13.75</span>
              <span class="col-credit">7</span>
            </div>
          </div>

          <!-- Résumé -->
          <div class="summary-box">
            <div class="summary-item">
              <span class="summary-label">Moyenne</span>
              <span class="summary-value">14.89</span>
            </div>
            <div class="summary-item">
              <span class="summary-label">Crédit</span>
              <span class="summary-value">0</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Unité d'enseignement : Activité à pratique -->
      <div class="accordion-item">
        <div class="unit-header" data-toggle="collapse" data-target="#unit4">
          <h3 class="unit-title">Unité d’enseignement : Activité à pratique</h3>
          <svg class="toggle-icon" viewBox="0 0 16 9">
            <path d="M8 9L0 1h16L8 9z"/>
          </svg>
        </div>
        
        <div class="unit-content" id="unit4">
          <!-- Matière 1 -->
          <div class="subject-info">Matière : Gestion financière internationale Cr : 2 Coef : 1</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">11</span>
              <span class="col-tp">14.25</span>
              <span class="col-moyenne">13.75</span>
              <span class="col-credit">7</span>
            </div>
          </div>

          <!-- Matière 2 -->
          <div class="subject-info">Matière : Gestion des Institutions Financières Cr : 2 Coef : 1</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">11</span>
              <span class="col-tp">14.25</span>
              <span class="col-moyenne">13.75</span>
              <span class="col-credit">7</span>
            </div>
          </div>

          <!-- Résumé -->
          <div class="summary-box">
            <div class="summary-item">
              <span class="summary-label">Moyenne</span>
              <span class="summary-value">14.89</span>
            </div>
            <div class="summary-item">
              <span class="summary-label">Crédit</span>
              <span class="summary-value">0</span>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Contenu Semestre 2 (caché par défaut) -->
    <div class="semester-content" data-semester="2" style="display: none;">
      
      <!-- Unité d'enseignement : Finance internationale -->
      <div class="accordion-item">
        <div class="unit-header" data-toggle="collapse" data-target="#unit5">
          <h3 class="unit-title">Unité d’enseignement : Macroéconomie avancée</h3>
          <svg class="toggle-icon" viewBox="0 0 16 9">
            <path d="M8 9L0 1h16L8 9z"/>
          </svg>
        </div>
        
        <div class="unit-content show" id="unit5">
          <!-- Matière 1 -->
          <div class="subject-info">Matière : Analyse macroéconomique Cr : 3 Coef : 1.5</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">13</span>
              <span class="col-tp">15.50</span>
              <span class="col-moyenne">14.25</span>
              <span class="col-credit">9</span>
            </div>
          </div>

          <!-- Matière 2 -->
          <div class="subject-info">Matière : Politiques économiques Cr : 3 Coef : 1.5</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">12</span>
              <span class="col-tp">14.75</span>
              <span class="col-moyenne">13.50</span>
              <span class="col-credit">8</span>
            </div>
          </div>

          <!-- Résumé -->
          <div class="summary-box">
            <div class="summary-item">
              <span class="summary-label">Moyenne</span>
              <span class="summary-value">13.87</span>
            </div>
            <div class="summary-item">
              <span class="summary-label">Crédit</span>
              <span class="summary-value">17</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Unité d'enseignement : Économétrie -->
      <div class="accordion-item">
        <div class="unit-header" data-toggle="collapse" data-target="#unit6">
          <h3 class="unit-title">Unité d’enseignement : Statistiques avancées</h3>
          <svg class="toggle-icon" viewBox="0 0 16 9">
            <path d="M8 9L0 1h16L8 9z"/>
          </svg>
        </div>
        
        <div class="unit-content" id="unit6">
          <!-- Matière 1 -->
          <div class="subject-info">Matière : Modélisation statistique Cr : 2.5 Coef : 1.2</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">14</span>
              <span class="col-tp">16.00</span>
              <span class="col-moyenne">15.00</span>
              <span class="col-credit">10</span>
            </div>
          </div>

          <!-- Matière 2 -->
          <div class="subject-info">Matière : Analyse de données Cr : 2.5 Coef : 1.2</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">13.5</span>
              <span class="col-tp">15.25</span>
              <span class="col-moyenne">14.50</span>
              <span class="col-credit">9</span>
            </div>
          </div>

          <!-- Résumé -->
          <div class="summary-box">
            <div class="summary-item">
              <span class="summary-label">Moyenne</span>
              <span class="summary-value">14.75</span>
            </div>
            <div class="summary-item">
              <span class="summary-label">Crédit</span>
              <span class="summary-value">19</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Unité d'enseignement : Gestion de portefeuille -->
      <div class="accordion-item">
        <div class="unit-header" data-toggle="collapse" data-target="#unit7">
          <h3 class="unit-title">Unité d’enseignement : Investissements stratégiques</h3>
          <svg class="toggle-icon" viewBox="0 0 16 9">
            <path d="M8 9L0 1h16L8 9z"/>
          </svg>
        </div>
        
        <div class="unit-content" id="unit7">
          <!-- Matière 1 -->
          <div class="subject-info">Matière : Gestion des portefeuilles Cr : 3 Coef : 1.5</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">12.5</span>
              <span class="col-tp">15.00</span>
              <span class="col-moyenne">13.75</span>
              <span class="col-credit">8</span>
            </div>
          </div>

          <!-- Matière 2 -->
          <div class="subject-info">Matière : Analyse des marchés Cr : 3 Coef : 1.5</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">13</span>
              <span class="col-tp">14.50</span>
              <span class="col-moyenne">13.75</span>
              <span class="col-credit">9</span>
            </div>
          </div>

          <!-- Résumé -->
          <div class="summary-box">
            <div class="summary-item">
              <span class="summary-label">Moyenne</span>
              <span class="summary-value">13.75</span>
            </div>
            <div class="summary-item">
              <span class="summary-label">Crédit</span>
              <span class="summary-value">17</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Unité d'enseignement : Activité à pratique -->
      <div class="accordion-item">
        <div class="unit-header" data-toggle="collapse" data-target="#unit8">
          <h3 class="unit-title">Unité d’enseignement : Projet professionnel</h3>
          <svg class="toggle-icon" viewBox="0 0 16 9">
            <path d="M8 9L0 1h16L8 9z"/>
          </svg>
        </div>
        
        <div class="unit-content" id="unit8">
          <!-- Matière 1 -->
          <div class="subject-info">Matière : Stage en entreprise Cr : 2 Coef : 1</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">14.5</span>
              <span class="col-tp">16.25</span>
              <span class="col-moyenne">15.25</span>
              <span class="col-credit">10</span>
            </div>
          </div>

          <!-- Matière 2 -->
          <div class="subject-info">Matière : Rapport de stage Cr : 2 Coef : 1</div>
          
          <div class="grades-table">
            <div class="table-header">
              <span class="col-exam">Examen</span>
              <span class="col-tp">Tp1</span>
              <span class="col-moyenne">M</span>
              <span class="col-credit">C</span>
            </div>
            <div class="table-values">
              <span class="col-exam">13.75</span>
              <span class="col-tp">15.50</span>
              <span class="col-moyenne">14.75</span>
              <span class="col-credit">9</span>
            </div>
          </div>

          <!-- Résumé -->
          <div class="summary-box">
            <div class="summary-item">
              <span class="summary-label">Moyenne</span>
              <span class="summary-value">15.00</span>
            </div>
            <div class="summary-item">
              <span class="summary-label">Crédit</span>
              <span class="summary-value">19</span>
            </div>
          </div>
        </div>
      </div>

    </div>

  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Gestion des onglets semestres
      const tabs = document.querySelectorAll('#notes-accordions .tab');
      const contents = document.querySelectorAll('#notes-accordions .semester-content');
      
      tabs.forEach(tab => {
        tab.addEventListener('click', function() {
          const semester = this.getAttribute('data-semester');
          
          // Gérer les classes actives des onglets
          tabs.forEach(t => t.classList.remove('active'));
          this.classList.add('active');
          
          // Afficher le contenu correspondant
          contents.forEach(content => {
            if (content.getAttribute('data-semester') === semester) {
              content.style.display = 'block';
            } else {
              content.style.display = 'none';
            }
          });
        });
      });

      // Gestion des accordéons
      const unitHeaders = document.querySelectorAll('#notes-accordions .unit-header');
      
      unitHeaders.forEach(header => {
        header.addEventListener('click', function() {
          const targetId = this.getAttribute('data-target');
          const targetContent = document.querySelector(targetId);
          
          if (targetContent) {
            // Toggle du contenu
            const isExpanded = targetContent.classList.contains('show');
            
            if (isExpanded) {
              targetContent.classList.remove('show');
              this.classList.remove('expanded');
            } else {
              targetContent.classList.add('show');
              this.classList.add('expanded');
            }
          }
        });
      });
    });
  </script>
</div>