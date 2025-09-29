<!-- User-provided styles combined into one block -->
<style>
.content-block {
    margin: 20px 0;
    background: #fff;
    border-radius: 10px;
    padding: 34px;
    font-family: 'Segoe UI', sans-serif;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.styled-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 10px;
    box-shadow: 0 0 0 1px #ddd;
    background: #fff;
    font-family: 'Segoe UI', sans-serif;
}

.styled-table thead {
    background-color: #f3f1e9;
}

.styled-table th,
.styled-table td {
    padding: 14px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.styled-table tr:last-child td {
    border-bottom: none;
}

#candidaturesTable thead tr:first-child th:first-child {
    border-top-left-radius: 12px;
    border-bottom-left-radius: 12px;
}

#candidaturesTable thead tr:first-child th:last-child {
    border-top-right-radius: 12px;
    border-bottom-right-radius: 12px;
}
</style>


<div class="content-block">
  <table id="candidaturesTable" class="styled-table display">
    <thead>
      <tr>
        <th>Ref_Doc</th>
        <th>Fichier</th>
        <th>Télécharger</th>
      </tr>
    </thead>
    <tbody id="candidaturesBody"></tbody>
  </table>
</div>

<script>
(function(){
  const REST_ROOT  = (window.pmsettings && pmsettings.rest_root) || (window.wpApiSettings && wpApiSettings.root) || '/wp-json/';
  const NONCE      = (window.pmsettings && pmsettings.nonce)     || (window.wpApiSettings && wpApiSettings.nonce) || '';
  const API        = REST_ROOT.replace(/\/$/, '') + '/plateforme-recherche/v1';

  function q(k){ return new URLSearchParams(location.search).get(k); }
  const pubId = q('id');

  async function fetchJSON(url){
    const res = await fetch(url, { headers: { 'X-WP-Nonce': NONCE, 'Accept': 'application/json' }, credentials: 'same-origin' });
    if (!res.ok) throw new Error('HTTP '+res.status);
    return await res.json();
  }

  function filenameFromURL(u){
    try { const p = new URL(u); return decodeURIComponent(p.pathname.split('/').pop() || 'fichier'); }
    catch(_){ return (u||'').split('/').pop() || 'fichier'; }
  }

  async function load(){
    const tbody = document.getElementById('candidaturesBody');
    tbody.innerHTML = '';

    if(!pubId){
      tbody.innerHTML = `<tr><td colspan="3" style="text-align:center;color:#777;">ID manquant</td></tr>`;
      return;
    }

    try {
      const p = await fetchJSON(`${API}/publication/${pubId}`);
      const url = (p && p.fichier_url) ? String(p.fichier_url).trim() : '';

      if (!url){
        tbody.innerHTML = `<tr><td colspan="3" style="text-align:center;color:#777;">Aucun fichier disponible</td></tr>`;
      } else {
        const name = filenameFromURL(url);
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td>001</td>
          <td>${name}</td>
          <td>
            <a href="${url}" target="_blank" rel="noopener">
              <img width="20" src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png" alt="download">
            </a>
          </td>`;
        tbody.appendChild(tr);
      }

      if ($.fn.dataTable) {
        $('#candidaturesTable').DataTable({
          paging:false, searching:false, ordering:false, info:false,
          language:{ emptyTable: "Aucune donnée disponible" }
        });
      }
    } catch(e){
      console.error(e);
      tbody.innerHTML = `<tr><td colspan="3" style="text-align:center;color:#c00;">Erreur de chargement</td></tr>`;
    }
  }

  load();
})();
</script>
