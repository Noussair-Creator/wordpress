<?php
// ---- Titre parent > page courante
$current_id  = get_the_ID();
$parent_id   = wp_get_post_parent_id($current_id);
$parent_link = $parent_id ? get_permalink($parent_id) : '';
$parent_title= $parent_id ? get_the_title($parent_id) : '';
?>
<!-- DASHBOARD BAR + POPOVER MESSAGES -->
<style>
/* ====== Barre de page ====== */
.dashboard-bar{
  display:flex;justify-content:space-between;align-items:center;
  padding:12px 24px;background:#fff;box-shadow:0 2px 6px rgba(0,0,0,.05);
}
.dashboard-title{font-weight:700;font-size:17px;color:#6E6D55;text-transform:uppercase}
.dashboard-title .title-active{color:#000}
.dashboard-icons{display:flex;align-items:center;gap:12px;position:relative}
.icon-box{
  position:relative;width:38px;height:38px;background:#fff;border-radius:8px;
  box-shadow:0 2px 6px rgba(0,0,0,.1);display:flex;align-items:center;justify-content:center;
  color:#111;font-size:16px;cursor:pointer
}
.icon-box.logout{background:#b30000;color:#fff}
.badge-dot{
  position:absolute;top:2px;right:2px;min-width:16px;height:16px;background:red;color:#fff;
  font-size:10px;font-weight:700;border-radius:999px;display:flex;align-items:center;justify-content:center;
  padding:0 4px;box-shadow:0 0 0 2px #fff
}

/* Recherche repliable de la barre */
.search-container{display:flex;align-items:center;position:relative}
#search-input{
  width:0;opacity:0;transition:all .3s ease;padding:6px 10px;font-size:14px;border:1px solid #ccc;
  border-radius:6px;margin-left:8px;pointer-events:none
}
.search-container.active #search-input{width:180px;opacity:1;pointer-events:auto}

/* ====== Popover Messages ====== */
.msg-popover{
  position:absolute;top:48px;right:0;width:340px;max-height:70vh;background:#fff;
  border:1px solid #e6e6e6;border-radius:10px;box-shadow:0 10px 28px rgba(0,0,0,.15);
  overflow:hidden;display:none;z-index:10000
}
.msg-popover::before{
  content:"";position:absolute;top:-8px;right:18px;width:14px;height:14px;background:#fff;
  border-left:1px solid #e6e6e6;border-top:1px solid #e6e6e6;transform:rotate(45deg)
}
.msg-head{
  display:flex;align-items:center;justify-content:space-between;padding:10px 12px;
  background:#f7f7f7;border-bottom:1px solid #eee;font-weight:700;font-size:14px;color:#111
}
.msg-head .open-full{color:#222;text-decoration:none;font-size:16px}
.msg-search{position:relative;padding:10px;border-bottom:1px solid #f0f0f0;background:#fff}
.msg-search input{
  width:100%;height:38px;border:1px solid #e6e6e6;border-radius:8px;padding:0 40px 0 12px;font-size:14px;outline:none
}
.msg-search i{position:absolute;right:18px;top:50%;transform:translateY(-50%);color:#777;font-size:16px}
.msg-list{max-height:calc(70vh - 94px);overflow:auto;padding:10px;background:#fff}
.msg-item{
  border:1px solid #eee;border-radius:8px;padding:8px 10px;background:#fff;margin-bottom:8px;
  cursor:pointer;transition:box-shadow .15s
}
.msg-item:hover{box-shadow:0 2px 8px rgba(0,0,0,.06)}
.msg-item.unread{border-color:#f2b6b6;box-shadow:inset 0 0 0 1px #ef9a9a}
.msg-top{display:flex;align-items:center;justify-content:space-between;gap:8px;margin-bottom:4px;font-size:12px;color:#333}
.msg-top .from{white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.msg-top .from .role{color:#8e8d78}
.msg-top .from .name{font-weight:700;color:#111}
.msg-top .date{color:#8b8b8b;font-size:11px}
.msg-snippet{font-size:12px;color:#4a4a4a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
</style>

<div class="dashboard-bar">
  <div class="dashboard-title">
    <?php
      if ($parent_id) {
        echo '<a href="'.esc_url($parent_link).'">'.esc_html($parent_title).'</a> ';
      }
      echo '<span class="title-active">'.esc_html(get_the_title($current_id)).'</span>';
    ?>
  </div>

  <div class="dashboard-icons">
    <!-- Recherche repliable -->
    <div class="search-container">
      <input type="text" id="search-input" placeholder="Rechercher..." />
      <div class="icon-box" id="search-icon"><i class="fas fa-search"></i></div>
    </div>

    <!-- Messages (avec badge) + popover -->
    <div class="icon-box has-badge" id="msgBtn" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-comment-dots"></i>
      <span class="badge-dot" id="msgBadge">0</span>

      <div class="msg-popover" id="msgPopover" role="dialog" aria-label="Messages">
        <div class="msg-head">
          <span>Messages</span>
          <a href="/messages" class="open-full" title="Ouvrir la messagerie">
            <i class="fas fa-external-link-alt"></i>
          </a>
        </div>
        <div class="msg-search">
          <input type="text" id="msgSearch" placeholder="Recherche...">
          <i class="fas fa-search"></i>
        </div>
        <div class="msg-list" id="msgList">
          <!-- Exemples (remplace par ta boucle PHP) -->
          <!--<div class="msg-item unread">
            <div class="msg-top">
              <div class="from"><span class="role">Enseignant :</span> <span class="name">Mr. Mourad Bouzidi</span></div>
              <div class="date">18-05-2025</div>
            </div>
            <div class="msg-snippet">"Veuillez noter que l'examen final du module d'Analyse des …"</div>
          </div>

          <div class="msg-item unread">
            <div class="msg-top">
              <div class="from"><span class="role">Enseignant :</span> <span class="name">Mme. Samira Khaldi</span></div>
              <div class="date">24-05-2025</div>
            </div>
            <div class="msg-snippet">"Le cours de Séminaire de Recherche prévu le 24 mai est rep…"</div>
          </div>

          <div class="msg-item">
            <div class="msg-top">
              <div class="from"><span class="role">Enseignant :</span> <span class="name">Pr. Karim Zouari</span></div>
              <div class="date">24-05-2025</div>
            </div>
            <div class="msg-snippet">"Je vous rappelle que la date limite pour le dépôt de votre…"</div>
          </div>

          <div class="msg-item">
            <div class="msg-top">
              <div class="from"><span class="role">Enseignant :</span> <span class="name">Dr. Inès Mejdoub</span></div>
              <div class="date">24-05-2025</div>
            </div>
            <div class="msg-snippet">"Une réunion de suivi des stages est programmée le 15 mai…"</div>
          </div>-->
        </div>
      </div>
    </div>

    <!-- Notifications -->
    <div class="icon-box has-badge"><i class="fas fa-bell"></i><span class="badge-dot">0</span></div>

    <!-- Profil -->
    <a href="/profile" class="icon-box" title="Profil">
      <i class="fas fa-cog"></i>
    </a>

    <!-- Déconnexion -->
    <a class="icon-box logout" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">
      <i class="fas fa-sign-out-alt"></i>
    </a>
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

const ME1 = Number(window.PMSettings?.userId || 0);

// ==== Recherche repliable dans la barre ====
const searchIcon = document.getElementById('search-icon');
const searchContainer = document.querySelector('.search-container');
searchIcon.addEventListener('click', () => {
  searchContainer.classList.toggle('active');
  const input = document.getElementById('search-input');
  if (searchContainer.classList.contains('active')) input.focus(); else input.value='';
});

// ==== Popover Messages ====
const msgBtn     = document.getElementById('msgBtn');
const msgPopover = document.getElementById('msgPopover');
const msgSearch  = document.getElementById('msgSearch');
const msgList    = document.getElementById('msgList');

function toggleMsg(open){
  const willOpen = (open!==undefined) ? open : (msgPopover.style.display!=='block');
  msgPopover.style.display = willOpen ? 'block' : 'none';
  msgBtn.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
  if (willOpen) setTimeout(()=>msgSearch.focus(), 40);
}
msgBtn.addEventListener('click', (e)=>{ e.stopPropagation(); toggleMsg(); });
document.addEventListener('click', (e)=>{ if(!msgBtn.contains(e.target)) toggleMsg(false); });
document.addEventListener('keydown', (e)=>{ if(e.key==='Escape') toggleMsg(false); });

// Filtre simple
msgSearch.addEventListener('input', ()=>{
  const q = msgSearch.value.trim().toLowerCase();
  [...msgList.querySelectorAll('.msg-item')].forEach(it=>{
    it.style.display = it.textContent.toLowerCase().includes(q) ? '' : 'none';
  });
});

// Marquer lu + fermer sur clic item (tu peux rediriger ici)
msgList.addEventListener('click', (e)=>{
  const item = e.target.closest('.msg-item'); if(!item) return;
  item.classList.remove('unread');
  // window.location.href = '/messages/ID'; // si besoin
  toggleMsg(false);
});
</script>


<script>
(function(){
  // --- Config REST depuis WP ---
  const REST_BASE = (window.PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');
  const NS        = REST_BASE + '/plateforme-messagerie/v1';
  const NONCE     = window.PMSettings?.nonce || (window.wpApiSettings?.nonce || '');

  // --- DOM ---
  const badgeEl = document.getElementById('msgBadge');
  const listEl  = document.getElementById('msgList');
  const search  = document.getElementById('msgSearch');
  if (!badgeEl || !listEl) return;

  // --- util REST ---
  async function api(path, {method='GET', query=null, data=null, headers={}}={}) {
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
    const t = await r.text(); let j; try{ j = JSON.parse(t); } catch { j = { raw:t }; }
    if (!r.ok) throw Object.assign(new Error(j?.message || ('HTTP '+r.status)), {status:r.status, detail:j});
    return j;
  }

  // --- utils ---
  const esc = s => String(s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;');

  function renderList(threads){
    listEl.innerHTML = '';
    if (!threads?.length) {
      listEl.innerHTML = `<div class="msg-item"><div class="msg-snippet">Aucun message</div></div>`;
      return;
    }
    const frag = document.createDocumentFragment();
    threads.forEach(t=>{
      const it = document.createElement('div');
      it.className = 'msg-item' + ((t.unread_count>0)?' unread':'');
      it.innerHTML = `
        <div class="msg-top">
          <div class="from">
            <span class="role">${esc(t.last_sender_role_label || '')}</span>
            &nbsp;<span class="name">${esc(t.last_sender_name || '')}</span>
          </div>
          <div class="date">${esc(t.last_message_at_display || (t.last_message_at ? new Date(t.last_message_at).toLocaleDateString('fr-FR') : ''))}</div>
        </div>
        <div class="msg-snippet">${esc(t.last_excerpt || '')}</div>
      `;
      it.addEventListener('click', ()=>{
        // ferme le popover
        const pop = document.getElementById('msgPopover'); if (pop) pop.style.display='none';
        // si la page /messages expose openThread, ouvre le fil
        if (typeof window.openThread === 'function') { try { window.openThread(t.id); } catch{} }
        else { window.location.href = '/messages'; }
      });
      frag.appendChild(it);
    });
    listEl.appendChild(frag);

    // filtre live (sur ce lot) — attaché une seule fois
    if (search && !search._wired) {
      search._wired = true;
      search.addEventListener('input', ()=>{
        const q = search.value.trim().toLowerCase();
        [...listEl.querySelectorAll('.msg-item')].forEach(it=>{
          it.style.display = it.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
      });
    }
  }

  async function updateNavbarMessages(){
    try{
      // 1) 5 derniers fils pour l’affichage
      const latest = await api('/messages/threads', { method:'GET', query:{ limit:5, offset:0 }});
      //renderList(latest);
      // 1) Récupérer des fils récents

        // ➜ garder seulement les reçus (dernier message non envoyé par moi)
        const received = (latest || []).filter(t => Number(t.last_sender_id) !== ME1);

        // limiter à 5 pour l’affichage
        renderList(received.slice(0, 5));

      // 2) total des non-lus = somme des unread_count (on peut limiter à 200 fils)
      const unreadThreads = await api('/messages/threads', { method:'GET', query:{ only_unread:1, limit:200 }});
      const totalUnread = (unreadThreads || []).reduce((acc,t)=> acc + (parseInt(t.unread_count||0,10)||0), 0);

      if (totalUnread > 0) {
        badgeEl.style.display = '';
        badgeEl.textContent = String(totalUnread);
      } else {
        badgeEl.style.display = 'none';
        badgeEl.textContent = '';
      }
    } catch(e){
      console.error('[navbar messages]', e);
      // fallback discret
      badgeEl.style.display = 'none';
      if (listEl.innerHTML.trim()==='') {
        listEl.innerHTML = `<div class="msg-item"><div class="msg-snippet">Erreur de chargement</div></div>`;
      }
    }
  }

  // init + refresh toutes les 60s
  document.addEventListener('DOMContentLoaded', updateNavbarMessages);
  setInterval(updateNavbarMessages, 60000);
})();
</script>


