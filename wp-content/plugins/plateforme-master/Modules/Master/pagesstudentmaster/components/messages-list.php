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
          .chips{display:flex; gap:8px; flex-wrap:nowrap}
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

            /*const MESSAGES = [
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
            ];*/

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
/*  height: var(--pane-height);*/
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
div#nt-card {
    margin-top: 15px;
}input#nt-subject {
    height: 42px;
}
div#nt-card {
    margin-top: 15px;
    margin-bottom: 15px;
}button#nt-send {
    margin-top: 7px;
}
        </style>
        <!-- ===== NOUVEAU MESSAGE (même style que messages-thread) ===== -->
<section class="thread" style="margin-bottom:12px;">
  <div class="inner">
    <div class="msg-card" id="nt-card">
      <div class="msg-header">
        <div class="msg-subject">Nouveau message</div>
        <div class="msg-date" id="nt-status">—</div>
      </div>

      <div class="msg-content">
        <!-- Sujet -->
        <div style="margin-bottom:8px;">
          <label for="nt-subject" style="display:block; margin-bottom:4px;">Sujet</label>
          <input id="nt-subject" class="composer-input" type="text" placeholder="Sujet du fil">
        </div>

        <!-- Rôle + Utilisateurs -->
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:8px; margin-bottom:8px;">
          <div>
            <label for="nt-role" style="display:block; margin-bottom:4px;">Rôle</label>
            <select id="nt-role" class="composer-input" style="height:44px;">
              <option value="">— Sélectionner —</option>
              <option value="um_chercheur">um_chercheur</option>
              <option value="um_doctorant">um_doctorant</option>
              <option value="um_directeur_laboratoire">um_directeur_laboratoire</option>
              <option value="um_service_master">um_service_master</option>
              <option value="um_coordonnateur_master">um_coordonnateur_master</option>
            </select>
          </div>
          <div>
            <label for="nt-users" style="display:block; margin-bottom:4px;">Utilisateurs (du rôle)</label>
            <select id="nt-users" multiple size="6" class="composer-input" style="height:auto; padding:6px 12px;">
              <!-- options injectées -->
            </select>
          </div>
        </div>

        <!-- Message -->
        <div style="margin-bottom:8px;">
          <label for="nt-body" style="display:block; margin-bottom:4px;">Message</label>
          <textarea id="nt-body" rows="4" class="composer-input" placeholder="Votre message initial..." style="height:auto; padding:8px 12px;"></textarea>
        </div>
      </div>

      <!-- Barre d’actions au style composer -->
      <div class="composer" style="padding-top:0;">
        <div class="composer-row">
          <div class="input-wrap" style="flex:0 0 auto;">
            <button id="nt-send" class="icon-btn" title="Créer le fil et envoyer" aria-label="Créer le fil et envoyer">
              <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M3 11l18-8-8 18-2-7-8-3z" stroke="#1F2433" stroke-width="1.8" stroke-linejoin="round"></path>
              </svg>
            </button>
          </div>
          <small id="nt-hint" style="opacity:.8;"></small>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ===== /NOUVEAU MESSAGE ===== -->

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

<script>
  window.PMSettings = {
    restUrl: "<?= esc_url( rest_url() ) ?>",
    nonce: "<?= wp_create_nonce('wp_rest') ?>",
    role: "<?= esc_js($role) ?>",
    userId: <?= (int) $user_id ?>
  };
</script>

<script>
/* ============================================================
   Messagerie – Wiring JS ↔ API (WordPress REST) — version corrigée
   - Requiert être connecté (cookie WP) + nonce injecté (cf. PHP)
   - Namespace: /wp-json/plateforme-messagerie/v1
   ============================================================ */
(function(){
  /* ---------- GUARDE-FOUS DOM ---------- */
  const listRoot   = document.getElementById('messages-list');
  const threadRoot = document.getElementById('messages-thread');
  if(!listRoot || !threadRoot){ console.error('[MSG] DOM manquant (#messages-list / #messages-thread)'); return; }

  /* ---------- CONFIG ---------- */
  const API_BASE = String((window.PMSettings?.restUrl || '/wp-json').replace(/\/$/,'')) + '/plateforme-messagerie/v1';
  const NONCE    = window.PMSettings?.nonce || (window.wpApiSettings?.nonce || '');
  const ME       = Number.isFinite(window.userId) ? Number(window.userId) : 0;

  /* ---------- HELPERS ---------- */
  const $  = (sel,root=document)=>root.querySelector(sel);
  const $$ = (sel,root=document)=>Array.from(root.querySelectorAll(sel));
  const esc = (s='') => String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');

  async function apiFetch(path, {method='GET', data=null, query=null, headers={}}={}) {
    const url = new URL(API_BASE + path, window.location.href);
    if (query) Object.entries(query).forEach(([k,v])=> (v!==undefined && v!==null && v!=='') && url.searchParams.set(k,v));

    const opts = {
      method,
      headers: { 'Content-Type':'application/json', ...headers },
      credentials: 'same-origin'   // 🔑 important pour envoyer les cookies WordPress
    };

    if (NONCE) opts.headers['X-WP-Nonce'] = NONCE;
    if (data)  opts.body = JSON.stringify(data);

    const res = await fetch(url.toString(), opts);
    const txt = await res.text();
    let json; try { json = JSON.parse(txt); } catch { json = { raw:txt }; }
    if (!res.ok) {
      const msg = json?.message || `HTTP ${res.status}`;
      throw Object.assign(new Error(msg), {status:res.status, detail:json});
    }
    return json;
  }

  const toast = (msg, type='info') => console[type==='error'?'error':'log']('[MSG]', msg);
  const debounce = (fn, ms=300)=>{ let t; return (...a)=>{ clearTimeout(t); t=setTimeout(()=>fn(...a), ms); }; };

  /* ---------- DOM HOOKS ---------- */
  const listBox    = $('#ml-list', listRoot);
  const searchInp  = $('#ml-q', listRoot);
  const chipAll    = $('#ml-chip-all', listRoot);
  const chipUnread = $('#ml-chip-unread', listRoot);

  const headEl  = $('#mt-head', threadRoot);
  const subjEl  = $('#mt-subject', threadRoot);
  const dateEl  = $('#mt-date', threadRoot);
  const contEl  = $('#mt-content', threadRoot);
  const bodyEl  = $('.thread-body', threadRoot);

  const inputEl   = $('#mt-input', threadRoot);
  const sendBtn   = $('#mt-send',  threadRoot);
  const attachBtn = $('#mt-attach',threadRoot);

  // input file caché pour PJ
  const fileInput = document.createElement('input');
  fileInput.type = 'file';
  fileInput.multiple = true;
  fileInput.style.display='none';
  document.body.appendChild(fileInput);

  /* ---------- ÉTAT ---------- */
  let threads = [];
  let currentThreadId = null;
  let currentFilter = 'all';
  let currentSearch = '';
  let pendingAttachments = [];
  let openToken = 0;

  /* ---------- LISTE FILS ---------- */
  function renderThreads(){
    listBox.innerHTML = '';
    const q = currentSearch.trim().toLowerCase();

    threads.forEach(t=>{
      if (currentFilter==='unread' && !(t.unread_count>0)) return;
      if (q) {
        const blob = `${t.subject||''} ${t.last_excerpt||''}`.toLowerCase();
        if (!blob.includes(q)) return;
      }

      const div = document.createElement('div');
      div.className = 'item' + (t.unread_count>0?' unread':'') + (t.id===currentThreadId?' active':'');
      div.dataset.id = t.id;
      const dateStr  = new Date(t.last_message_at || t.updated_at).toLocaleDateString('fr-FR');

      div.innerHTML = `
        <div class="item-top">
          <div class="from"><span class="role">${t.is_group?'Groupe':'Fil'}</span> <span class="name">${esc(t.subject || '(sans sujet)')}</span></div>
          <div class="date">${dateStr}</div>
        </div>
        <div class="snippet">${esc(t.last_excerpt||'')}</div>
      `;
      div.addEventListener('click', ()=>openThread(t.id));
      listBox.appendChild(div);
    });

    if (!threads.length) {
      listBox.innerHTML = `<div class="item"><div class="snippet">Aucun message</div></div>`;
    }
  }

  async function refreshThreads(){
    try{
      const data = await apiFetch('/messages/threads', {
        method:'GET',
query: {
    only_unread: (currentFilter==='unread')?1:0,
    query: currentSearch,
    limit: 50,
    offset: 0,
    participant_role: (window.PMSettings?.role || '') // <-- filtre rôle
  }      });
      threads = Array.isArray(data) ? data : [];
      renderThreads();
      if (!currentThreadId && threads[0]?.id) openThread(threads[0].id);
    }catch(e){ toast(e.message || 'Erreur chargement fils', 'error'); }
  }

  /* ---------- OUVERTURE D’UN FIL ---------- */
  async function openThread(threadId){
    currentThreadId = threadId;
    $$('.item', listBox).forEach(el=>el.classList.toggle('active', String(el.dataset.id)===String(threadId)));

    const myToken = ++openToken;
    try{
      const thread = await apiFetch(`/messages/threads/${threadId}`, {method:'GET'});
      if (myToken!==openToken) return;
      headEl.textContent = thread?.thread?.subject || '—';

      const msgs = await apiFetch(`/messages/threads/${threadId}/messages`, {method:'GET', query:{limit:100}});
      if (myToken!==openToken) return;
      renderThreadMessages(msgs);

      msgs.forEach(m=>{
        if (m.sender_id !== ME) apiFetch(`/messages/${m.id}/read`, {method:'POST'}).catch(()=>{});
      });

      refreshThreads();
    }catch(e){ if (myToken===openToken) toast(e.message || 'Erreur ouverture fil', 'error'); }
  }

  function renderThreadMessages(messages=[]){
    const last = messages[messages.length-1];
    if (last) {
      subjEl.textContent = threads.find(t=>t.id===currentThreadId)?.subject || '—';
      dateEl.textContent = new Date(last.created_at).toLocaleDateString('fr-FR', { day:'2-digit', month:'long', year:'numeric' });
      contEl.innerHTML   = last.body || esc(last.body_plain || '');
    } else {
      subjEl.textContent = '—';
      dateEl.textContent = '—';
      contEl.innerHTML   = '';
    }

    const anchor = $('#mt-card', threadRoot).parentElement;
    anchor.parentElement.querySelectorAll('.msg-card.__dyn').forEach(n=>n.remove());

    messages.forEach(m=>{
      const wrap = document.createElement('div');
      wrap.className = 'msg-card __dyn';
      wrap.style.marginTop = '10px';
      const files = (m.attachments && m.attachments.length)
        ? `<div style="margin-top:6px">${m.attachments.map(a=>(
            `<a href="${a.storage_url}" target="_blank" rel="noopener">${esc(a.file_name)}</a>`
          )).join(' ')}</div>`
        : '';

      wrap.innerHTML = `
        <div class="msg-header">
          <div class="msg-subject">${m.sender_id===ME?'Vous':'Message'}</div>
          <div class="msg-date">${new Date(m.created_at).toLocaleString('fr-FR')}</div>
        </div>
        <div class="msg-content">${m.body ? m.body : esc(m.body_plain||'')}</div>
        ${files}
      `;
      anchor.appendChild(wrap);
    });

    bodyEl.scrollTop = bodyEl.scrollHeight;
  }

  /* ---------- ENVOI MESSAGE + PJ ---------- */
  async function postMessage(){
    const txt = (inputEl.value||'').trim();
    if (!txt && pendingAttachments.length===0) return;
    if (!currentThreadId) return toast('Aucun fil sélectionné', 'error');

    try{
      const payload = { body: txt, attachments: pendingAttachments.slice() };
      await apiFetch(`/messages/threads/${currentThreadId}/messages`, {method:'POST', data:payload});

      const wrap = document.createElement('div');
      wrap.className = 'msg-card __dyn';
      wrap.style.marginTop = '10px';
      const files = pendingAttachments.length
        ? `<div style="margin-top:6px">${pendingAttachments.map(a=>`<span>${esc(a.name)}</span>`).join(' ')}</div>`
        : '';
      wrap.innerHTML = `
        <div class="msg-header">
          <div class="msg-subject">Vous</div>
          <div class="msg-date">${new Date().toLocaleString('fr-FR')}</div>
        </div>
        <div class="msg-content">${esc(txt)}</div>
        ${files}
      `;
      $('#mt-card', threadRoot).parentElement.appendChild(wrap);
      bodyEl.scrollTop = bodyEl.scrollHeight;

      inputEl.value = '';
      pendingAttachments = [];
      toast('Message envoyé', 'success');
      refreshThreads();
    }catch(e){ toast(e.message || 'Échec envoi', 'error'); }
  }

  // PJ → base64 buffer
  attachBtn?.addEventListener('click', ()=> fileInput.click());
  fileInput.addEventListener('change', async (e)=>{
    const files = Array.from(e.target.files||[]);
    for (const f of files) {
      const b64 = await fileToBase64(f);
      pendingAttachments.push({ name:f.name, mime:f.type||'application/octet-stream', size:f.size, content:b64 });
    }
    toast(`${pendingAttachments.length} pièce(s) jointe(s) prête(s)`);
    fileInput.value = '';
  });
  const fileToBase64 = file => new Promise((res,rej)=>{
    const r = new FileReader();
    r.onload = ()=>res(r.result);
    r.onerror = rej;
    r.readAsDataURL(file);
  });

  /* ---------- RECHERCHE & FILTRES ---------- */
  const onSearch = debounce(()=>{ currentSearch = searchInp.value || ''; refreshThreads(); }, 250);
  searchInp?.addEventListener('input', onSearch);

  chipAll?.addEventListener('click', ()=>{
    chipAll.classList.add('active'); chipUnread.classList.remove('active');
    currentFilter='all'; refreshThreads();
  });
  chipUnread?.addEventListener('click', ()=>{
    chipUnread.classList.add('active'); chipAll.classList.remove('active');
    currentFilter='unread'; refreshThreads();
  });

  /* ---------- ENVOI ---------- */
  sendBtn?.addEventListener('click', postMessage);
  inputEl?.addEventListener('keydown', (e)=>{ if(e.key==='Enter'){ e.preventDefault(); postMessage(); } });

  /* ---------- INIT ---------- */
  document.addEventListener('DOMContentLoaded', refreshThreads);

})();
</script>
<script>
(function(){
  // --- Références DOM ---
  const box     = document.getElementById('ml-newthread');
  if(!box) return;
  const roleEl  = document.getElementById('nm-role');
  const usersEl = document.getElementById('nm-users');
  const subjEl  = document.getElementById('nm-subject');
  const bodyEl  = document.getElementById('nm-body');
  const sendEl  = document.getElementById('nm-send');
  const hintEl  = document.getElementById('nm-hint');

  // --- Helpers / Fallbacks (réutilise ton apiFetch si présent) ---
  const API_BASE = (window.PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');
  const NS_MSG   = '/plateforme-messagerie/v1';
  const NONCE    = window.PMSettings?.nonce || (window.wpApiSettings?.nonce || '');

  async function fallbackFetch(path, {method='GET', data=null, query=null, headers={}}={}) {
    const url = new URL((path.startsWith('http')? path : API_BASE + path), location.href);
    if (query) Object.entries(query).forEach(([k,v])=> (v!==undefined && v!==null && v!=='') && url.searchParams.set(k,v));
    const opts = {
      method,
      headers: { 'Content-Type':'application/json', ...headers },
      credentials: 'same-origin'
    };
    if (NONCE) opts.headers['X-WP-Nonce'] = NONCE;
    if (data)  opts.body = JSON.stringify(data);
    const r = await fetch(url.toString(), opts);
    const txt = await r.text(); let json; try{ json=JSON.parse(txt);}catch{ json={raw:txt}; }
    if (!r.ok) throw Object.assign(new Error(json?.message || ('HTTP '+r.status)), {status:r.status,detail:json});
    return json;
  }
  const apiFetch = window.apiFetch || window.msgApiFetch || fallbackFetch;

  const toast = (m,t='info')=>{ hintEl.textContent = m; if(t==='error'){ hintEl.style.color='#b60303'; } else { hintEl.style.color=''; } };

  // --- Charger les utilisateurs du rôle (via WP REST /wp/v2/users) ---
  async function loadUsersByRole(role){
    usersEl.innerHTML = '';
    if(!role){ return; }
    try{
      // _fields pour limiter la payload ; augmente per_page si nécessaire
      const resp = await apiFetch('/plateforme-messagerie/v1/users-by-role', {
  method: 'GET',
  query: { role: role, per_page: 100 }
});
      const users = resp.items || [];
      if (!Array.isArray(users) || users.length===0) {
        usersEl.innerHTML = '<option value="">(aucun utilisateur pour ce rôle)</option>';
        return;
      }
      const frag = document.createDocumentFragment();
      users.forEach(u=>{
        const opt = document.createElement('option');
        opt.value = String(u.id);
        opt.textContent = `${u.name} (ID:${u.id})`;
        frag.appendChild(opt);
      });
      usersEl.appendChild(frag);
    }catch(e){
      // 403 ou endpoint fermé: on affiche une info
      usersEl.innerHTML = `<option value="">Impossible de charger les utilisateurs (${e.message||'erreur'})</option>`;
    }
  }

  roleEl.addEventListener('change', ()=> loadUsersByRole(roleEl.value));

  // --- Envoi : créer un thread + 1er message ---
  async function sendNewThread(){
    const subject = (subjEl.value||'').trim();
    const body    = (bodyEl.value||'').trim();
    const sel     = Array.from(usersEl.selectedOptions||[]).map(o=>parseInt(o.value,10)).filter(Boolean);

    if (!subject) return toast('Sujet requis','error');
    if (!body)    return toast('Message requis','error');
    if (!sel.length) return toast('Sélectionnez au moins un utilisateur','error');

    try{
      sendEl.disabled = true; toast('Envoi en cours…');
      const payload = {
        subject,
        participant_ids: sel,
        first_message: { body, mentions: [], attachments: [] }
      };
      const res = await apiFetch(NS_MSG + '/messages/threads', { method:'POST', data: payload });

      // reset formulaire
      bodyEl.value = ''; subjEl.value = '';
      usersEl.selectedIndex = -1; roleEl.selectedIndex = 0;
      toast('Fil créé avec succès');

      // Si ta page a la fonction refreshThreads/openThread (fourni dans ton JS principal), on les appelle
      if (typeof window.refreshThreads === 'function') window.refreshThreads();
      if (res?.thread_id && typeof window.openThread === 'function') window.openThread(res.thread_id);
    }catch(e){
      toast(e.message || 'Échec de création','error');
    }finally{
      sendEl.disabled = false;
    }
  }

  sendEl.addEventListener('click', sendNewThread);
})();

// 1) rends apiFetch accessible aux autres scripts
window.apiFetch = apiFetch;

// 2) utilise bien l'id utilisateur de PMSettings
const ME = Number.isFinite(window.PMSettings?.userId) ? Number(window.PMSettings.userId) : 0;
if (window.PMSettings?.userId && !window.userId) window.userId = Number(window.PMSettings.userId);

// 3) après la définition de ces fonctions :
window.refreshThreads = refreshThreads;
window.openThread     = openThread;


</script>

<script>
(function(){
  const root = document.getElementById('messages-thread');
  const roleEl  = root?.querySelector('#nt-role');
  const usersEl = root?.querySelector('#nt-users');
  const subjEl  = root?.querySelector('#nt-subject');
  const bodyEl  = root?.querySelector('#nt-body');
  const sendEl  = root?.querySelector('#nt-send');
  const hintEl  = root?.querySelector('#nt-hint');
  const statusEl= root?.querySelector('#nt-status');
  if (!roleEl || !usersEl || !subjEl || !bodyEl || !sendEl) return;

  const API_BASE = (window.PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');
  const NS_MSG   = '/plateforme-messagerie/v1';
  const NONCE    = window.PMSettings?.nonce || (window.wpApiSettings?.nonce || '');

  async function api(path, {method='GET', data=null, query=null, headers={}}={}) {
    const url = new URL((path.startsWith('http')? path : API_BASE + path), location.href);
    if (query) Object.entries(query).forEach(([k,v])=> (v!==undefined && v!==null && v!=='') && url.searchParams.set(k,v));
    const opts = { method, headers: { 'Content-Type':'application/json', ...headers }, credentials:'same-origin' };
    if (NONCE) opts.headers['X-WP-Nonce'] = NONCE;
    if (data)  opts.body = JSON.stringify(data);
    const r = await fetch(url.toString(), opts);
    const txt = await r.text(); let json; try{ json=JSON.parse(txt);}catch{ json={raw:txt}; }
    if (!r.ok) throw Object.assign(new Error(json?.message || ('HTTP '+r.status)), {status:r.status,detail:json});
    return json;
  }

  const toast = (m, err=false)=>{ hintEl.textContent=m; hintEl.style.color = err ? '#b60303' : ''; statusEl.textContent = new Date().toLocaleString('fr-FR'); };

  async function loadUsersByRole(role){
    usersEl.innerHTML = '';
    if (!role) return;
    try{
      const resp  = await api(NS_MSG + '/users-by-role', { method:'GET', query:{ role, per_page:100 } });
      const users = resp.items || [];
      if (!users.length) { usersEl.innerHTML = '<option value="">(aucun utilisateur)</option>'; return; }
      const frag = document.createDocumentFragment();
      users.forEach(u=>{
        const opt = document.createElement('option');
        opt.value = String(u.id);
        opt.textContent = `${u.name} (ID:${u.id})`;
        frag.appendChild(opt);
      });
      usersEl.appendChild(frag);
      toast(`Chargé: ${users.length} utilisateur(s)`);
    }catch(e){
      usersEl.innerHTML = `<option value="">Chargement impossible (${e.message||'erreur'})</option>`;
      toast(e.message||'Erreur chargement', true);
    }
  }
  roleEl.addEventListener('change', ()=> loadUsersByRole(roleEl.value));

  async function sendNewThread(){
    const subject = (subjEl.value||'').trim();
    const body    = (bodyEl.value||'').trim();
    const sel     = Array.from(usersEl.selectedOptions||[]).map(o=>parseInt(o.value,10)).filter(Boolean);

    if (!subject) return toast('Sujet requis',true);
    if (!body)    return toast('Message requis',true);
    if (!sel.length) return toast('Sélectionnez au moins un utilisateur',true);

    try{
      sendEl.disabled = true; toast('Envoi…');
      const payload = { subject, participant_ids: sel, first_message:{ body, mentions:[], attachments:[] } };
      const res = await api(NS_MSG + '/messages/threads', { method:'POST', data:payload });

      // reset
      subjEl.value=''; bodyEl.value=''; usersEl.selectedIndex=-1; roleEl.selectedIndex=0;
      toast('Fil créé avec succès');

      // rafraîchir + ouvrir
      if (typeof window.refreshThreads === 'function') window.refreshThreads();
      if (res?.thread_id && typeof window.openThread === 'function') window.openThread(res.thread_id);
    }catch(e){
      toast(e.message || 'Échec de création', true);
    }finally{
      sendEl.disabled = false;
    }
  }
  sendEl.addEventListener('click', sendNewThread);
})();
</script>
