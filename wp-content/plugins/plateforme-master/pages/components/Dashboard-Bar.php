<?php
// ---- Contexte PHP minimal pour exposer user/role au JS
if (!defined('ABSPATH')) exit;

$user     = wp_get_current_user();
$user_id  = get_current_user_id();
$role     = ($user && !empty($user->roles)) ? $user->roles[0] : '';
?>
<!-- DASHBOARD BAR + POPOVER MESSAGES & NOTIFS -->
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

/* ====== Popover (réutilisé pour Messages & Notifications) ====== */
.msg-popover, .notification-popover{
  position:absolute;top:48px;right:0;width:340px;max-height:70vh;background:#fff;
  border:1px solid #e6e6e6;border-radius:10px;box-shadow:0 10px 28px rgba(0,0,0,.15);
  overflow:hidden;display:none;z-index:10000
}
.msg-popover::before, .notification-popover::before{
  content:"";position:absolute;top:-8px;right:18px;width:14px;height:14px;background:#fff;
  border-left:1px solid #e6e6e6;border-top:1px solid #e6e6e6;transform:rotate(45deg)
}
.msg-head, .notification-head{
  display:flex;align-items:center;justify-content:space-between;padding:10px 12px;
  background:#f7f7f7;border-bottom:1px solid #eee;font-weight:700;font-size:14px;color:#111
}
.msg-head .open-full, .notification-head .open-full{ color:#222;text-decoration:none;font-size:16px}
.msg-search, .notification-search{position:relative;padding:10px;border-bottom:1px solid #f0f0f0;background:#fff}
.msg-search input, .notification-search input{
  width:100%;height:38px;border:1px solid #e6e6e6;border-radius:8px;padding:0 40px 0 12px;font-size:14px;outline:none
}
.msg-search i, .notification-search i{position:absolute;right:18px;top:50%;transform:translateY(-50%);color:#777;font-size:16px}
.msg-list, .notification-list{max-height:calc(70vh - 94px);overflow:auto;padding:10px;background:#fff}
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
      $current_id  = get_the_ID();
      $parent_id   = wp_get_post_parent_id($current_id);
      $parent_link = $parent_id ? get_permalink($parent_id) : '';
      $parent_title= $parent_id ? get_the_title($parent_id) : '';
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
        <div class="msg-list" id="msgList"></div>
      </div>
    </div>

    <!-- Notifications (même UX que Messages) -->
    <div class="icon-box has-badge" id="notifBtn" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-bell"></i>
      <span class="badge-dot" id="notifBadge">0</span>

      <div class="notification-popover" id="notifPopover" role="dialog" aria-label="Notifications">
        <div class="notification-head">
          <span>Notifications</span>
          <a href="#" class="open-full" title="Ouvrir tout">
            <i class="fas fa-external-link-alt"></i>
          </a>
        </div>
        <div class="notification-search">
          <input type="text" id="notifSearch" placeholder="Recherche...">
          <i class="fas fa-search"></i>
        </div>
        <div class="notification-list" id="notifList"></div>
      </div>
    </div>

    <!-- Profil -->
    <a href="/profile2" class="icon-box" title="Profil">
      <i class="fas fa-cog"></i>
    </a>

    <!-- Déconnexion -->
    <a class="icon-box logout" href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">
      <i class="fas fa-sign-out-alt"></i>
    </a>
  </div>
</div>

<script>
  // Exposer paramètres au JS
  window.PMSettings = {
    restUrl: "<?= esc_url( rest_url() ) ?>",
    nonce: "<?= wp_create_nonce('wp_rest') ?>",
    role: "<?= esc_js($role) ?>",
    userId: <?= (int) $user_id ?>
  };
</script>

<script>
/** ===== Barre : recherche repliable ===== */
const searchIcon = document.getElementById('search-icon');
const searchContainer = document.querySelector('.search-container');
searchIcon.addEventListener('click', () => {
  searchContainer.classList.toggle('active');
  const input = document.getElementById('search-input');
  if (searchContainer.classList.contains('active')) input.focus(); else input.value='';
});

/** ===== Popover Messages ===== */
const msgBtn     = document.getElementById('msgBtn');
const msgPopover = document.getElementById('msgPopover');
const msgSearch  = document.getElementById('msgSearch');
const msgList    = document.getElementById('msgList');

function toggleMsg(open){
  const willOpen = (open!==undefined) ? open : (msgPopover.style.display!=='block');
  msgPopover.style.display = willOpen ? 'block' : 'none';
  msgBtn.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
  if (willOpen) setTimeout(()=>msgSearch?.focus(), 40);
}
msgBtn.addEventListener('click', (e)=>{ e.stopPropagation(); toggleMsg(); });
document.addEventListener('click', (e)=>{ if(!msgBtn.contains(e.target)) toggleMsg(false); });
document.addEventListener('keydown', (e)=>{ if(e.key==='Escape') toggleMsg(false); });

msgSearch?.addEventListener('input', ()=>{
  const q = msgSearch.value.trim().toLowerCase();
  [...msgList.querySelectorAll('.msg-item')].forEach(it=>{
    it.style.display = it.textContent.toLowerCase().includes(q) ? '' : 'none';
  });
});
msgList.addEventListener('click', (e)=>{
  const item = e.target.closest('.msg-item'); if(!item) return;
  item.classList.remove('unread');
  // si tu as un lien cible :
  const href = item.getAttribute('data-href');
  toggleMsg(false);
  if (href) window.location.href = href; else window.location.href = '/messages';
});

/** ===== Popover Notifications (copie conforme) ===== */
const notifBtn     = document.getElementById('notifBtn');
const notifPopover = document.getElementById('notifPopover');
const notifSearch  = document.getElementById('notifSearch');
const notifList    = document.getElementById('notifList');

function toggleNotif(open){
  const willOpen = (open!==undefined) ? open : (notifPopover.style.display!=='block');
  notifPopover.style.display = willOpen ? 'block' : 'none';
  notifBtn.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
  if (willOpen) setTimeout(()=>notifSearch?.focus(), 40);
}
notifBtn.addEventListener('click', (e)=>{ e.stopPropagation(); toggleNotif(); });
document.addEventListener('click', (e)=>{ if(!notifBtn.contains(e.target)) toggleNotif(false); });
document.addEventListener('keydown', (e)=>{ if(e.key==='Escape') toggleNotif(false); });

notifSearch?.addEventListener('input', ()=>{
  const q = notifSearch.value.trim().toLowerCase();
  [...notifList.querySelectorAll('.msg-item')].forEach(it=>{
    it.style.display = it.textContent.toLowerCase().includes(q) ? '' : 'none';
  });
});
notifList.addEventListener('click', async (e)=>{
  const item = e.target.closest('.msg-item');
  if (!item) return;

  const id = item.getAttribute('data-id');
  if (!id) return;

  try {
    await api(`/notifications/${id}`, {method:'PATCH', data:{lu:1}});
    item.classList.remove('unread');
    refreshNotifications();
  } catch(e){
    console.error("Erreur PATCH notification:", e);
  }
});

</script>

<script>
/** ===== IIFE REST : chargement Messages + Notifications ===== */
/*
(function(){
  // --- Config REST depuis WP ---
  const REST_BASE = (window.PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');

  // Namespaces (⚠️ adapte si besoin)
  const NS_MSG   = REST_BASE + '/plateforme-messagerie/v1';

  // --- util REST générique (sélectionne base selon path) ---
  async function api(path, {method='GET', ns='msg', query=null, data=null, headers={}}={}){
    const base = ns === 'notif' ? NS_NOTIF : NS_MSG;
    const url  = new URL(path.startsWith('http') ? path : (base + path), location.href);
    if (query) Object.entries(query).forEach(([k,v])=>{
      if (v!==undefined && v!==null && v!=='') url.searchParams.set(k,v);
    });
    const opts = {
      method,
      headers: { 'Content-Type':'application/json', ...headers },
      credentials:'same-origin'
    };
    if (NONCE) opts.headers['X-WP-Nonce'] = NONCE;
    if (data)  opts.body = JSON.stringify(data);

    const r = await fetch(url.toString(), opts);
    const t = await r.text(); let j; try{ j = JSON.parse(t); } catch { j = { raw:t }; }
    if (!r.ok) throw Object.assign(new Error(j?.message || ('HTTP '+r.status)), {status:r.status, detail:j});
    return j;
  }

  // ====== MESSAGES ======
  const ME1     = Number(window.PMSettings?.userId || 0);
  const badgeEl = document.getElementById('msgBadge');
  const listEl  = document.getElementById('msgList');
  const search  = document.getElementById('msgSearch');

  const esc = (s)=>String(s||'').replace(/[&<>]/g,m=>({ '&':'&amp;','<':'&lt;','>':'&gt;' }[m]));

  function renderThreads(threads){
    listEl.innerHTML = '';
    if (!threads?.length) {
      listEl.innerHTML = `<div class="msg-item"><div class="msg-snippet">Aucun message</div></div>`;
      return;
    }
    const frag = document.createDocumentFragment();
    threads.forEach(t=>{
      const it = document.createElement('div');
      it.className = 'msg-item' + ((t.unread_count>0)?' unread':'');
      it.setAttribute('data-href','/messages'); // ou `/messages/${t.id}`
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
      frag.appendChild(it);
    });
    listEl.appendChild(frag);
  }

  async function refreshMessages(){
    try{
      // Fils récents
      const latest = await api('/messages/threads', { ns:'msg', method:'GET', query:{ limit:5, offset:0 }});
      const received = (latest || []).filter(t => Number(t.last_sender_id) !== ME1);
      renderThreads(received.slice(0,5));

      // Total non lus
      const unreadThreads = await api('/messages/threads', { ns:'msg', method:'GET', query:{ only_unread:1, limit:200 }});
      const totalUnread = (unreadThreads || []).reduce((acc,t)=> acc + (parseInt(t.unread_count||0,10)||0), 0);
      if (totalUnread > 0) { badgeEl.style.display=''; badgeEl.textContent=String(totalUnread); }
      else { badgeEl.style.display='none'; badgeEl.textContent=''; }
    } catch(e){
      console.error('[navbar messages]', e);
      badgeEl.style.display = 'none';
      if (listEl.innerHTML.trim()==='') {
        listEl.innerHTML = `<div class="msg-item"><div class="msg-snippet">Erreur de chargement</div></div>`;
      }
    }
  }

 



  
  setInterval(refreshMessages,     60000);
  setInterval(refreshNotifications, 60000);
})();

*/

/** ===== IIFE REST : chargement Messages + Notifications ===== */
(function(){
  // --- Config REST depuis WP ---
  const REST_BASE = (window.PMSettings?.restUrl || '/wp-json').replace(/\/$/,'');
  const NONCE     = window.PMSettings?.nonce || '';

  const NS_MSG   = REST_BASE + '/plateforme-messagerie/v1';
  const NS_NOTIF = REST_BASE + '/plateforme-recherche/v1'; // ✅ corrige namespace

  // --- util REST générique ---
  async function api(path, {method='GET', ns='msg', query=null, data=null, headers={}}={}) {
    const base = ns === 'notif' ? NS_NOTIF : NS_MSG;
    const url  = new URL(path.startsWith('http') ? path : (base + path), location.href);
    if (query) Object.entries(query).forEach(([k,v])=>{
      if (v!==undefined && v!==null && v!=='') url.searchParams.set(k,v);
    });
    const opts = {
      method,
      headers: { 'Content-Type':'application/json', ...headers },
      credentials:'same-origin'
    };
    if (NONCE) opts.headers['X-WP-Nonce'] = NONCE;
    if (data)  opts.body = JSON.stringify(data);

    const r = await fetch(url.toString(), opts);
    const t = await r.text(); let j; try { j = JSON.parse(t); } catch { j = { raw:t }; }
    if (!r.ok) throw Object.assign(new Error(j?.message || ('HTTP '+r.status)), {status:r.status, detail:j});
    return j;
  }

  // ====== MESSAGES ======
  const ME1     = Number(window.PMSettings?.userId || 0);
  const badgeEl = document.getElementById('msgBadge');
  const listEl  = document.getElementById('msgList');
  const search  = document.getElementById('msgSearch');

  const esc = (s)=>String(s||'').replace(/[&<>]/g,m=>({ '&':'&amp;','<':'&lt;','>':'&gt;' }[m]));

  function renderThreads(threads){
    listEl.innerHTML = '';
    if (!threads?.length) {
      listEl.innerHTML = `<div class="msg-item"><div class="msg-snippet">Aucun message</div></div>`;
      return;
    }
    const frag = document.createDocumentFragment();
    threads.forEach(t=>{
      const it = document.createElement('div');
      it.className = 'msg-item' + ((t.unread_count>0)?' unread':'');
      it.setAttribute('data-href','/messages');
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
      frag.appendChild(it);
    });
    listEl.appendChild(frag);
  }

  async function refreshMessages(){
    try{
      const latest = await api('/messages/threads', { ns:'msg', method:'GET', query:{ limit:5, offset:0 }});
      const received = (latest || []).filter(t => Number(t.last_sender_id) !== ME1);
      renderThreads(received.slice(0,5));

      const unreadThreads = await api('/messages/threads', { ns:'msg', method:'GET', query:{ only_unread:1, limit:200 }});
      const totalUnread = (unreadThreads || []).reduce((acc,t)=> acc + (parseInt(t.unread_count||0,10)||0), 0);

      if (totalUnread > 0) { badgeEl.style.display=''; badgeEl.textContent=String(totalUnread); }
      else { badgeEl.style.display='none'; badgeEl.textContent=''; }
    } catch(e){
      console.error('[navbar messages]', e);
      badgeEl.style.display = 'none';
      if (listEl.innerHTML.trim()==='') {
        listEl.innerHTML = `<div class="msg-item"><div class="msg-snippet">Erreur de chargement</div></div>`;
      }
    }
  }

  // ====== NOTIFICATIONS ======
  const notifBadge = document.getElementById('notifBadge');
  const notifList  = document.getElementById('notifList');

  function renderNotifs(items){
    notifList.innerHTML = '';
    if (!items?.length) {
      notifList.innerHTML = `<div class="msg-item"><div class="msg-snippet">Aucune notification</div></div>`;
      return;
    }
    const frag = document.createDocumentFragment();
    items.forEach(n=>{
      const it = document.createElement('div');
      it.className = 'msg-item' + (n.lu == 0 ? ' unread' : '');
      it.setAttribute('data-id', n.id);
      it.innerHTML = `
        <div class="msg-top">
          <div class="from"><span class="role">${n.type || 'Info'}</span></div>
          <div class="date">${n.created_at ? new Date(n.created_at).toLocaleDateString('fr-FR') : ''}</div>
        </div>
        <div class="msg-snippet">${n.message || ''}</div>
      `;
      frag.appendChild(it);
    });
    notifList.appendChild(frag);
  }

  async function refreshNotifications(){
    try{
      const notifs = await api('/notifications?per_page=5', { ns:'notif', method:'GET' });
      renderNotifs(notifs);

      const unread = notifs.filter(n=>n.lu == 0).length;
      if (unread > 0) { notifBadge.style.display=''; notifBadge.textContent=String(unread); }
      else { notifBadge.style.display='none'; notifBadge.textContent=''; }
    } catch(e){
      console.error('[navbar notifs]', e);
      notifBadge.style.display='none';
      if (notifList.innerHTML.trim()==='') {
        notifList.innerHTML = `<div class="msg-item"><div class="msg-snippet">Erreur de chargement</div></div>`;
      }
    }
  }

  // Boot + refresh périodique
  document.addEventListener('DOMContentLoaded', ()=>{
    refreshMessages();
    refreshNotifications();
  });
  setInterval(refreshMessages,     60000);
  setInterval(refreshNotifications, 60000);
})();


</script>
