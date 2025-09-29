<!-- Google Fonts: Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
  body { background-color:#f8f9fa; font-family:'Inter',sans-serif; }
  .comment-container {
    background-color:#ffffff; padding:24px 32px; border-radius:8px;
    box-shadow:0 2px 10px rgba(0,0,0,0.05); margin:20px 0;
  }
  .comment-container h2 {
    font-size:1.5rem; font-weight:600; color:#333; margin:0 0 20px 0;
  }
  .comment-text {
    color:#555; font-size:0.95rem; line-height:1.6;
    border-top:1px solid #e9ecef; padding-top:20px; margin:0;
    white-space:normal;
  }
</style>

<div class="comment-container">
  <h2>Commentaires du chercheur</h2>
  <p id="commentText" class="comment-text">—</p>
</div>

<?php if (is_user_logged_in()): ?>
<script>
  // Expose REST settings si connecté (WordPress)
  window.pmsettings = {
    rest_root: <?php echo json_encode(esc_url_raw(rest_url())); ?>,
    nonce: <?php echo json_encode(wp_create_nonce('wp_rest')); ?>
  };
</script>
<?php endif; ?>

<script>
(function(){
  // Prépare racine & nonce (compatible wpApiSettings ou pmsettings)
  const REST_ROOT = (window.pmsettings && pmsettings.rest_root) || (window.wpApiSettings && wpApiSettings.root) || '/wp-json/';
  const NONCE     = (window.pmsettings && pmsettings.nonce) || (window.wpApiSettings && wpApiSettings.nonce) || '';
  const API       = REST_ROOT.replace(/\/$/, '') + '/plateforme-recherche/v1';

  function q(k){ return new URLSearchParams(location.search).get(k); }
  const pubId = q('id');

  // Helpers
  function setCommentSafe(domId, text){
    const el = document.getElementById(domId);
    if (!el) return;
    if (!text || String(text).trim() === '') { el.textContent = '—'; return; }
    // Échappe l'HTML puis convertit \n -> <br>
    const escaped = String(text)
      .replace(/&/g,'&amp;').replace(/</g,'&lt;')
      .replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');
    el.innerHTML = escaped.replace(/\n/g,'<br>');
  }

  function pickField(obj, names){
    for (const n of names){
      if (obj && obj[n] !== undefined && obj[n] !== null) return obj[n];
    }
    return undefined;
  }

  async function fetchJSON(url, opt={}){
    const res = await fetch(url, {
      headers: {'X-WP-Nonce': NONCE, 'Accept':'application/json'},
      credentials: 'same-origin',
      ...opt
    });
    if (!res.ok) throw new Error('HTTP '+res.status);
    return await res.json();
  }

  async function load(){
    if(!pubId){ setCommentSafe('commentText', 'ID manquant'); return; }

    let comment;

    // 1) Essaye de trouver le commentaire directement sur l'objet publication
    try {
      const p = await fetchJSON(`${API}/publication/${pubId}`);
      comment = pickField(p, [
        'commentaire_chercheur', 'commentaire', 'comment', 'feedback', 'avis', 'note', 'comment_text'
      ]);
    } catch(e){
      // on ignore ici, on tentera le fallback
    }

    // 2) Fallback : endpoint /publication/{id}/commentaires
    if (!comment) {
      try {
        const list = await fetchJSON(`${API}/publication/${pubId}/commentaires`);
        if (Array.isArray(list) && list.length){
          // priorise un item dont le rôle contient "chercheur", sinon prend le premier
          let item = list.find(it => (it.role || it.user_role || '').toString().toLowerCase().includes('chercheur')) || list[0];
          comment = pickField(item, ['commentaire', 'comment', 'content', 'texte', 'text', 'message']);
        }
      } catch(e){
        // rien, on mettra —
      }
    }

    setCommentSafe('commentText', comment || '—');
  }

  load();
})();
</script>
