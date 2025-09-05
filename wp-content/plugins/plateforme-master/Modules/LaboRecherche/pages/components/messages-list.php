<!-- components/messages.php -->
<div >
  <div class="row gx-3 gy-3 align-items-start messages-wrap">
    <!-- LISTE -->
    <div class="col-12 col-lg-4">
      <div id="messages-list">
        <style>
          @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

          #messages-list{
            --ink:#2A2916; --muted:#6E6D55; --line:#DBD9C3;
            --card:#FFFFFF; --chip:#6E6D55; --chip-active:#BF0404;
            --shadow:0px 3px 22px #0000000F;
            font-family:"Roboto",system-ui,-apple-system,"Segoe UI",Arial,sans-serif;
            color:var(--ink);
          }
          #messages-list *, #messages-list *::before, #messages-list *::after{box-sizing:border-box}

          /* Carte fluide */
          #messages-list .panel{
            width:100%;
            background:var(--card);
            box-shadow:var(--shadow);
            border-radius:8px;
            border:none;
            display:flex; flex-direction:column; overflow:hidden;
          }

          .panel-header{padding:16px 16px 8px 16px; font:700 20px/24px Roboto; color:#2A2916}
          .panel-body{padding:10px 16px 16px 16px; display:flex; flex-direction:column; gap:12px}

          /* Recherche fluide */
          .search{position:relative; width:100%; height:40px}
          .search input{
            width:100%; height:40px; background:#fff; border:1px solid var(--line); border-radius:5px;
            outline:none; padding:0 40px 0 12px; font:14px/17px Roboto; color:#2A2916;
          }
          .search input::placeholder{color:#A6A59F; font:14px/17px Roboto; text-transform:capitalize}
          .search .ico{position:absolute; right:12px; top:50%; transform:translateY(-50%); opacity:.75; pointer-events:none}

          /* Filtres */
          .chips{display:flex; gap:8px; flex-wrap:wrap}
          .chip{
            flex:1 1 155px; min-width:140px; height:36px;
            background:#fff; border:1px solid var(--chip); border-radius:18px; color:#6E6D55;
            font:15px/20px Roboto; display:inline-flex; align-items:center; justify-content:center; cursor:pointer;
          }
          .chip.active{background:#BF0404; border-color:#BF0404; color:#fff}

          /* Liste : hauteur responsive (viewport) */
          .list{
            display:flex; flex-direction:column; gap:8px; overflow:auto;
            max-height: 64vh; /* pas de px : reste stable quelle que soit la taille d'écran */
          }

          .item{
            width:100%; min-height:74px; background:#fff; border:1px solid #EAEAEA; border-radius:4px;
            padding:8px 10px; cursor:pointer; transition:box-shadow .15s,border-color .15s,transform .15s;
          }
          .item:hover{transform:translateY(-1px); box-shadow:0 2px 8px rgba(0,0,0,.06)}
          .item.unread{border-color:#ef9a9a; box-shadow:inset 0 0 0 1px #ef9a9a}
          .item.active{border:1px solid #BF0404}

          .item-top{display:flex; align-items:center; justify-content:space-between; gap:8px; margin-bottom:6px}
          .from{display:flex; gap:6px; align-items:baseline; min-height:15px; max-width:75%; white-space:nowrap; overflow:hidden; text-overflow:ellipsis}
          .from .role{font:13px/15px Roboto; color:#6E6D55}
          .from .name{font:500 13px/15px Roboto; color:#2A2916}
          .date{font:13px/15px Roboto; color:#6E6D55; white-space:nowrap}
          .snippet{font:13px/15px Roboto; color:#2A2916; white-space:nowrap; overflow:hidden; text-overflow:ellipsis}
        </style>

        <aside class="panel">
          <div class="panel-header">Messages</div>
          <div class="panel-body">
            <div class="search">
              <input id="ml-q" type="text" placeholder="Recherche" autocomplete="off" />
              <svg class="ico" width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <circle cx="11" cy="11" r="7" stroke="#6b7280" stroke-width="2"></circle>
                <path d="M20 20l-3.5-3.5" stroke="#6b7280" stroke-width="2" stroke-linecap="round"></path>
              </svg>
            </div>

            <div class="chips">
              <button class="chip active" data-filter="all"   id="ml-chip-all">Tous</button>
              <button class="chip"         data-filter="unread" id="ml-chip-unread">Non lu</button>
            </div>
            
            <div id="ml-list" class="list"><!-- items injectés --></div>
          </div>
        </aside>

        <script>
          (function(){
            const root  = document.getElementById('messages-list');
            const q     = root.querySelector('#ml-q');
            const list  = root.querySelector('#ml-list');
            const chips = root.querySelectorAll('.chip');

            const MESSAGES = [
              { id:'m1', unread:true,  fromRole:'Enseignant', from:'Mr. Mourad Bouzidi', date:'18-05-2025',
                title:'Examen de fin de Module - Analyse des Données', displayDate:'18 mai 2025',
                snippet:'"Veuillez noter que l\'examen final du module d’Analyse des …"',
                body:`Bonjour,<br><br>Veuillez noter que l'examen final du module d’Analyse des Données se tiendra le <b>18 mai 2025 à 09h00</b> en salle <b>B203</b>. N'oubliez pas d'apporter votre carte d'étudiant et votre calculatrice scientifique.<br><br>Cordialement`
              },
              { id:'m2', unread:true,  fromRole:'Enseignant', from:'Mme. Samira Khaldi', date:'24-05-2025',
                title:'Séminaire de Recherche', displayDate:'24 mai 2025',
                snippet:'"Le cours de Séminaire de Recherche prévu le 24 mai est rep…"', body:`Le cours de Séminaire de Recherche prévu le 24 mai est reporté à la semaine prochaine.` },
              { id:'m3', unread:false, fromRole:'Enseignant', from:'Pr. Karim Zouari', date:'24-05-2025',
                title:'Dépôt de votre mémoire', displayDate:'24 mai 2025',
                snippet:'"Je vous rappelle que la date limite pour le dépôt de votre…"', body:`Je vous rappelle que la date limite pour le dépôt de votre mémoire est le 30 mai.` },
              { id:'m4', unread:false, fromRole:'Enseignant', from:'Dr. Inès Mejdoub', date:'24-05-2025',
                title:'Réunion de suivi des stages', displayDate:'24 mai 2025',
                snippet:'"Une réunion de suivi des stages est programmée le 15 mai…" ', body:`Une réunion de suivi des stages est programmée le 15 mai à 10h.` }
            ];

            let currentFilter = 'all';
            let currentId = 'm1';

            function renderList(){
              const qv = (q.value||'').trim().toLowerCase();
              list.innerHTML = '';
              MESSAGES.forEach(m=>{
                if(currentFilter==='unread' && !m.unread) return;
                if(qv && !(m.from+m.title+m.snippet).toLowerCase().includes(qv)) return;

                const div = document.createElement('div');
                div.className = `item ${m.unread?'unread':''} ${m.id===currentId?'active':''}`;
                div.dataset.id = m.id;
                div.innerHTML = `
                  <div class="item-top">
                    <div class="from"><span class="role">${m.fromRole}</span> <span class="name">${m.from}</span></div>
                    <div class="date">${m.date}</div>
                  </div>
                  <div class="snippet">${m.snippet}</div>
                `;
                div.addEventListener('click', ()=>openMessage(m.id));
                list.appendChild(div);
              });
            }

            function openMessage(id){
              currentId = id;
              const m = MESSAGES.find(x=>x.id===id); if(!m) return;
              m.unread = false;
              window.dispatchEvent(new CustomEvent('msg:open', { detail: m }));
              renderList();
            }

            chips.forEach(chip=>{
              chip.addEventListener('click', ()=>{
                chips.forEach(c=>c.classList.remove('active'));
                chip.classList.add('active');
                currentFilter = chip.dataset.filter;
                renderList();
              });
            });

            q.addEventListener('input', renderList);

            renderList();
            openMessage(currentId);
          })();
        </script>
      </div>
    </div>

    <!-- THREAD -->
    <div class="col-12 col-lg-8">
      <div id="messages-thread">
        <style>
          @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

          #messages-thread{
            --ink:#2A2916; --muted:#6E6D55; --line:#ECEBE3; --card:#FFFFFF; --soft:rgba(236,235,227,.49);
            font-family:"Roboto",system-ui,-apple-system,"Segoe UI",Arial,sans-serif; color:var(--ink);
          }
          #messages-thread *, #messages-thread *::before, #messages-thread *::after{box-sizing:border-box}

          .thread{width:auto; background:#fff; box-shadow:0px 3px 22px #0000000F; border-radius:8px; overflow:hidden; border:none; display:flex; flex-direction:column}
          .inner{padding:0 16px; max-width:auto; }

          .teacher{padding:16px 0 10px; font-size: 20px;font: normal normal bold 20px/24px Roboto;
letter-spacing: 0px;
color: #2A2916; color:#2A2916}
          .divider{border-bottom:1px solid #ECEBE3}

          /* Corps : hauteur responsive (viewport) pour garder une zone scroll stable */
          .thread-body{overflow:auto; padding:12px 0; max-height:64vh}

          .msg-card{width:100%; min-height:140px; background:var(--soft); border:1px solid #ECEBE3; border-radius:5px; padding:12px 14px; color:#2A2916}
          .msg-header{display:flex; align-items:center; justify-content:space-between; gap:12px; margin-bottom:8px}
          .msg-subject{font:700 15px/20px Roboto; color:#2A2916}
          .msg-date{font:700 15px/20px Roboto; color:#6E6D55; white-space:nowrap}
          .msg-content{font:14px/22px Roboto; color:#2A2916}
          .msg-content p{margin:0 0 6px}
          .msg-content p:last-child{margin-bottom:0}

          /* Composer fluide */
          .composer{padding:12px 0 14px; background:#fff}
          .composer-row{display:flex; align-items:center; gap:14px; padding:0 16px}
          .input-wrap{position:relative; flex:1; height:44px}
          .composer-input{width:100%; height:100%; background:#fff; border:1px solid #A6A485; border-radius:6px; outline:none; padding:0 44px 0 12px; font:14px/22px Roboto; color:#2A2916}
          .composer-input::placeholder{color:#A6A59F}

          .send-btn{position:absolute; right:10px; top:50%; transform:translateY(-50%); width:26px; height:26px; border:0; background:transparent; cursor:pointer; padding:0; display:flex; align-items:center; justify-content:center}
          .send-btn svg{width:22px; height:22px; display:block}
          .send-btn svg path{stroke:#1F2433}
          .send-btn:hover{transform:translateY(-50%) scale(1.05)}

          .icon-btn{width:44px; height:44px; display:inline-flex; align-items:center; justify-content:center; background:#fff; border:1px solid #A6A485; border-radius:5px; cursor:pointer}
          .icon-btn svg{width:22px; height:23px; display:block}

          /* Empilement mobile : les deux colonnes sont déjà gérées par Bootstrap (col-12) */


          /* 1) Hauteur commune réglable pour les deux panneaux */
.messages-wrap{
  --pane-height: 100vh;   /* ↑ augmente ici (ex: 72vh, 78vh, 85vh…) */
}

/* 2) (optionnel) donner aussi une hauteur mini aux cartes */
#messages-list .panel,
#messages-thread .thread{
  min-height: var(--pane-height);
}

/* 3) les zones défilantes s’alignent sur la même hauteur */
#messages-list .list{
  max-height: var(--pane-height);
}
#messages-thread .thread-body{
  max-height: var(--pane-height);
}
/* Hauteur commune déjà définie plus haut : .messages-wrap{ --pane-height: 100vh; } */
/* 1) La carte prend une hauteur fixe et devient un conteneur flex colonne */
#messages-thread .thread{
  height: var(--pane-height);
  display: flex;
  flex-direction: column;
}

/* 2) Le corps occupe tout l'espace restant et scrolle */
#messages-thread .thread-body{
  flex: 1 1 auto;
  overflow: auto;
  padding: 12px 0;
  max-height: none;   /* annule l'ancienne contrainte */
  min-height: 0;      /* évite les soucis de scroll en flex */
}

/* 3) La barre de composition reste en bas et ne rétrécit pas */
#messages-thread .composer{
  flex-shrink: 0;
  border-top: 1px solid #ECEBE3; /* optionnel : séparateur visuel */
}

        </style>

        <section class="thread">
          <div class="inner">
            <div id="mt-head" class="teacher">Dr. Mounir Ben Ahmed</div>
            <div class="divider"></div>
          </div>

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

          <div class="composer">
            <div class="composer-row">
              <div class="input-wrap">
                <input id="mt-input" class="composer-input" type="text" placeholder="Écrivez votre message ici..." />
                <button id="mt-send" class="send-btn" title="Envoyer" aria-label="Envoyer">
                  <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M3 11l18-8-8 18-2-7-8-3z" stroke-width="1.8" stroke-linejoin="round"/>
                  </svg>
                </button>
              </div>
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

            window.addEventListener('msg:open', (e)=>{
              const m = e.detail || {};
              headEl.textContent = (m.from || '—').toString().trim();
              subjEl.textContent = m.title || '—';
              dateEl.textContent = m.displayDate || '—';
              contEl.innerHTML   = m.body || '';
              root.querySelector('.thread-body').scrollTop = 0;
            });

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
    </div>
  </div>
</div>
