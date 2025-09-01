<!-- VOLET THREAD (autonome, avec icône send dans l'input) -->
<div id="messages-thread">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

    #messages-thread{
      --ink:#2A2916;
      --muted:#6E6D55;
      --line:#ECEBE3;
      --card:#FFFFFF;
      --soft: rgba(236,235,227,.49); /* #ECEBE37D */
      --radius:8px;
      font-family:"Roboto",system-ui,-apple-system,"Segoe UI",Arial,sans-serif;
      color:var(--ink);
    }
    #messages-thread *, #messages-thread *::before, #messages-thread *::after{box-sizing:border-box}

    /* Carte principale (621 x 823) */
    #messages-thread .thread{
      width:621px;
      height:823px;
      background:#FFFFFF;
      box-shadow:0px 3px 22px #0000000F;
      border-radius:8px;
      display:flex;flex-direction:column;overflow:hidden;
      border:none;
    }

    /* largeur interne figma = 573px */
    #messages-thread .inner{width:573px;margin:0 auto}

    /* Nom enseignant */
    #messages-thread .teacher{
      padding:16px 0 10px 0;
      font: normal normal bold 20px/24px Roboto, sans-serif;
      color:#2A2916;
    }
    /* ligne sous le nom */
    #messages-thread .divider{border-bottom:1px solid #ECEBE3}

    /* zone défilante */
    #messages-thread .thread-body{flex:1;overflow:auto;padding:12px 0}

    /* Carte message (573 x 171) */
    #messages-thread .msg-card{
      width:573px;min-height:171px;
      background:var(--soft);
      border:1px solid #ECEBE3;border-radius:5px;
      padding:12px 14px;color:#2A2916;
    }
    .msg-header{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:8px}
    .msg-subject{font: normal normal bold 15px/20px Roboto, sans-serif;color:#2A2916}
    .msg-date{font: normal normal bold 15px/20px Roboto, sans-serif;color:#6E6D55;white-space:nowrap}
    .msg-content{max-width:532px;font: normal normal normal 14px/22px Roboto, sans-serif;color:#2A2916}
    .msg-content p{margin:0 0 6px}
    .msg-content p:last-child{margin-bottom:0}

    /* Composer (barre d'écriture + bouton joindre) */
    #messages-thread .composer{padding:12px 0 14px 0;background:#fff}
    /* 509 (input) + 14 (espace) + 50 (joindre) = 573 */
    #messages-thread .composer-row{
      width:573px;margin:0 auto;display:grid;
      grid-template-columns:509px 14px 50px;align-items:center;
    }

    /* conteneur de l'input pour placer l'icône send dedans */
    #messages-thread .input-wrap{position:relative;width:509px;height:50px}

    /* Champ (509 x 50, bord #A6A485, radius 6) */
    #messages-thread .composer-input{
      width:100%;height:100%;
      background:#FFFFFF;border:1px solid #A6A485;border-radius:6px;outline:none;
      padding:0 44px 0 12px; /* on réserve 44px à droite pour l’icône send */
      font: normal normal normal 14px/22px Roboto, sans-serif;color:#2A2916;
    }
    #messages-thread .composer-input::placeholder{
      color:#A6A59F;font: normal normal normal 14px/22px Roboto, sans-serif;letter-spacing:0;
    }

    /* Bouton send INSIDE input */
    #messages-thread .send-btn{
      position:absolute;right:10px;top:50%;transform:translateY(-50%);
      width:26px;height:26px;border:0;background:transparent;cursor:pointer;padding:0;
      display:flex;align-items:center;justify-content:center;
    }
    #messages-thread .send-btn svg{width:22px;height:22px;display:block}
    #messages-thread .send-btn svg path{stroke:#1F2433} /* bleu/gris foncé comme la capture */
    #messages-thread .send-btn:hover{transform:translateY(-50%) scale(1.05)}

    /* Bouton “Joindre” (50 x 50) */
    #messages-thread .icon-btn{
      width:50px;height:50px;display:inline-flex;align-items:center;justify-content:center;
      background:#FFFFFF;border:1px solid #A6A485;border-radius:5px;cursor:pointer;
    }
    #messages-thread .icon-btn svg{width:22px;height:23px;display:block}
  </style>

  <section class="thread">
    <!-- En-tête -->
    <div class="inner">
      <div id="mt-head" class="teacher">Dr. Mounir Ben Ahmed</div>
      <div class="divider"></div>
    </div>

    <!-- Corps -->
    <div class="thread-body">
      <div class="inner">
        <div class="msg-card" id="mt-card">
          <div class="msg-header">
            <div id="mt-subject" class="msg-subject">Examen de Fin de Module - Analyse des Données</div>
            <div id="mt-date" class="msg-date">18 mai 2025</div>
          </div>
          <div id="mt-content" class="msg-content">
            <p>Bonjour,</p>
            <p>Veuillez noter que l'examen final du module d’Analyse des Données se tiendra le 18 mai 2025 à 09h00 en salle B203. N'oubliez pas d'apporter votre carte étudiante et votre calculatrice scientifique.</p>
            <p>Cordialement</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Composer -->
    <div class="composer">
      <div class="inner composer-row">
        <!-- Input + send INSIDE -->
        <div class="input-wrap">
          <input id="mt-input" class="composer-input" type="text" placeholder="Écrivez votre message ici..." />
          <button id="mt-send" class="send-btn" title="Envoyer" aria-label="Envoyer">
            <!-- Avion -->
            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M3 11l18-8-8 18-2-7-8-3z" stroke-width="1.8" stroke-linejoin="round"/>
            </svg>
          </button>
        </div>

        <!-- Espace de 14px entre input et joindre -->
        <div aria-hidden="true"></div>

        <!-- Bouton Joindre (si tu ne le veux plus, supprime ce block) -->
        <button class="icon-btn" id="mt-attach" title="Joindre un fichier" aria-label="Joindre un fichier">
          <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M7 14.5 15.5 6a3 3 0 1 1 4.2 4.2L9.8 20.1a5 5 0 0 1-7.1-7.1L11 4.7" stroke="#333" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </div>
    </div>
  </section>

  <script>
    (function(){
      const root    = document.getElementById('messages-thread');
      const headEl  = root.querySelector('#mt-head');
      const subjEl  = root.querySelector('#mt-subject');
      const dateEl  = root.querySelector('#mt-date');
      const contEl  = root.querySelector('#mt-content');
      const input   = root.querySelector('#mt-input');
      const sendBtn = root.querySelector('#mt-send');

      /* MàJ depuis la liste */
      window.addEventListener('msg:open', (e)=>{
        const m = e.detail || {};
        headEl.textContent = (m.from || '—').toString().trim();
        subjEl.textContent = m.title || '—';
        dateEl.textContent = m.displayDate || '—';
        contEl.innerHTML   = m.body || '';
        root.querySelector('.thread-body').scrollTop = 0;
      });

      /* Envoi factice (ajoute un bloc sous le message) */
      function sendMessage(){
        const txt = (input.value||'').trim();
        if(!txt) return;
        const wrap = document.createElement('div');
        wrap.className = 'msg-card';
        wrap.style.marginTop = '10px';
        wrap.innerHTML = `
          <div class="msg-header">
            <div class="msg-subject">Vous</div>
            <div class="msg-date">${new Date().toLocaleString('fr-FR')}</div>
          </div>
          <div class="msg-content">${txt.replace(/</g,'&lt;')}</div>
        `;
        root.querySelector('#mt-card').parentElement.appendChild(wrap);
        const body = root.querySelector('.thread-body');
        body.scrollTop = body.scrollHeight;
        input.value = '';
      }
      sendBtn.addEventListener('click', sendMessage);
      input.addEventListener('keydown', (e)=>{ if(e.key==='Enter') sendMessage(); });
    })();
  </script>
</div>
