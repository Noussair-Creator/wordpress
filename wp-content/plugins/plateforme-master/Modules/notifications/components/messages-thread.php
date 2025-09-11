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





<script>
  window.PMSettings = {
    restUrl: "<?= esc_url( rest_url() ) ?>",
    nonce: "<?= wp_create_nonce('wp_rest') ?>",
    role: "<?= esc_js($role) ?>",
    userId: <?= (int) $user_id ?>
  };
</script>
<script>
(function(){
  // --- Config REST ---
  const REST_BASE = (window.PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');
  const NS        = REST_BASE + '/plateforme-messagerie/v1';
  const NONCE     = window.PMSettings?.nonce || (window.wpApiSettings?.nonce || '');

  // --- DOM ---
  const msgBtn   = document.getElementById('msgBtn');
  const badgeEl  = document.getElementById('msgBadge');   // <- badge pilotable
  const msgList  = document.getElementById('msgList');
  const msgSearch= document.getElementById('msgSearch');
  if (!msgBtn || !badgeEl || !msgList) return;

  // --- util REST ---
  async function api(path, {method='GET', query=null, data=null, headers={}}={}){
    const url = new URL(path.startsWith('http') ? path : (NS + path), location.href);
    if (query) Object.entries(query).forEach(([k,v])=>{
      if (v!==undefined && v!==null && v!=='') url.searchParams.set(k,v);
    });
    const opts = {
      method,
      headers: { 'Content-Type':'application/json', ...headers },
      credentials: 'same-origin'
    };
    if (NONCE) opts.headers['X-WP-Nonce'] = NONCE;
    if (data)  opts.body = JSON.stringify(data);

    const r = await fetch(url.toString(), opts);
    const t = await r.text(); let j; try{ j=JSON.parse(t); }catch{ j={raw:t}; }
    if (!r.ok) throw Object.assign(new Error(j?.message || ('HTTP '+r.status)), {status:r.status, detail:j});
    return j;
  }

  const esc = s => String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');
  const fmtDate = iso => { try { return new Date(iso).toLocaleDateString('fr-FR',{day:'2-digit',month:'long',year:'numeric'}); } catch { return esc(iso||''); }};

  function renderThreads(threads){
    msgList.innerHTML = '';
    if (!threads?.length) {
      msgList.innerHTML = `<div class="msg-item"><div class="msg-snippet">Aucun message</div></div>`;
      return;
    }
    const frag = document.createDocumentFragment();
    threads.forEach(t=>{
      const it = document.createElement('div');
      it.className = 'msg-item' + ((t.unread_count>0)?' unread':'');
      const who  = t.is_group ? 'Groupe' : 'Fil';
      const date = fmtDate(t.last_message_at || t.updated_at);
      it.innerHTML = `
        <div class="msg-top">
          <div class="from"><span class="role">${who} :</span> <span class="name">${esc(t.subject||'(sans sujet)')}</span></div>
          <div class="date">${date}</div>
        </div>
        <div class="msg-snippet">${esc(t.last_excerpt||'')}</div>
      `;
      it.addEventListener('click', ()=>{
        const pop = document.getElementById('msgPopover'); if (pop) pop.style.display='none';
        if (typeof window.openThread === 'function') { try { window.openThread(t.id); } catch{} }
        else { window.location.href = '/messages'; }
      });
      frag.appendChild(it);
    });
    msgList.appendChild(frag);
  }

  async function updateNavbarMessages(){
    try{
      // Liste pour l'affichage
      const threads = await api('/messages/threads', { method:'GET', query:{ limit: 10, offset: 0 }});
      renderThreads(threads);

      // Total de messages non lus = somme des unread_count de chaque fil non lu
      const unreadThreads = await api('/messages/threads', { method:'GET', query:{ only_unread: 1, limit: 200 }});
      const totalUnread = (unreadThreads || []).reduce((acc,t)=> acc + (parseInt(t.unread_count||0,10)||0), 0);

      if (totalUnread > 0) {
        badgeEl.style.display = '';
        badgeEl.textContent = String(totalUnread);
      } else {
        badgeEl.style.display = 'none';
        badgeEl.textContent = '';
      }

      // Filtre live (sur ce lot)
      const items = Array.from(msgList.querySelectorAll('.msg-item'));
      msgSearch?.addEventListener('input', ()=>{
        const q = msgSearch.value.trim().toLowerCase();
        items.forEach(it=>{ it.style.display = it.textContent.toLowerCase().includes(q) ? '' : 'none'; });
      }, { once:true });

    }catch(e){
      console.error('[navbar messages]', e);
      badgeEl.style.display = 'none';
      msgList.innerHTML = `<div class="msg-item"><div class="msg-snippet">Erreur de chargement (${esc(e.message)})</div></div>`;
    }
  }

  // 1er chargement + rafraîchissement toutes les 60s
  document.addEventListener('DOMContentLoaded', updateNavbarMessages);
  setInterval(updateNavbarMessages, 60000);
})();
</script>

