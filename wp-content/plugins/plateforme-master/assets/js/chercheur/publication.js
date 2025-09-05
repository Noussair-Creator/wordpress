/* Auto-generated CRUD for entity: publication */
(() => {
  "use strict";

  const CFG = (() => {
    const base = (window.PMSettings?.restUrl || "/wp-json").replace(/\/$/, "");
    return {
      base,
      nonce: window.PMSettings?.nonce || "",
      ns: "plateforme-recherche/v1",
      entity: "publication"
    };
  })();

  // --- Utils ---
  const qs = (o={}) => {
    const p = new URLSearchParams();
    Object.entries(o).forEach(([k,v]) => { if(v!==undefined&&v!==null&&v!=="") p.append(k,v); });
    const s = p.toString();
    return s ? `?${s}` : "";
  };

  async function toJSONSafe(resp) {
    const txt = await resp.text();
    try { return JSON.parse(txt); } catch { return { raw: txt }; }
  }

  async function apiFetch(path, { method="GET", data=null, files=null, query=null, methodOverride=false }={}) {
    const url = `${CFG.base}/${CFG.ns}/${String(path).replace(/^\/+/,"")}${qs(query||{})}`;
    const headers = { "Accept": "application/json" };
    if (CFG.nonce) headers["X-WP-Nonce"] = CFG.nonce;

    let body;
    const hasFiles = files && Object.keys(files).length>0;
    const fileFields = ['fichier_url'];

    // si data contient des Blob/File -> forcer form-data
    const containsFileLike = data && Object.values(data).some(v => v instanceof File || v instanceof Blob);
    const needsFormData = hasFiles || containsFileLike || fileFields.length>0;

    if (needsFormData) {
      const fd = new FormData();
      if (data) Object.entries(data).forEach(([k,v]) => fd.append(k, v ?? ""));
      if (files) Object.entries(files).forEach(([k,f]) => f && fd.append(k, f));
      body = fd;
      if ((method==="PUT" || method==="PATCH") && methodOverride) {
        headers["X-HTTP-Method-Override"] = method;
        method = "POST";
      }
    } else if (data) {
      headers["Content-Type"] = "application/json";
      body = JSON.stringify(data);
    }

    const resp = await fetch(url, { method, headers, body, credentials:"include" });
    const payload = await toJSONSafe(resp);
    if (!resp.ok) {
      const msg = payload?.message || payload?.raw || `HTTP ${resp.status}`;
      const err = new Error(msg);
      err.details = { status: resp.status, code: payload?.code, url, method, payload };
      throw err;
    }
    return payload;
  }

  // --- Sérialisation du formulaire ---
  const FIELDS = ['date_publication', 'titre', 'type', 'chercheur_id', 'doi', 'fichier_url', 'isbn', 'revue'];
  const FILE_FIELDS = ['fichier_url'];

  function readForm(formSel="#form-publication") {
    const root = document.querySelector(formSel) || document;
    const data = {};
    const files = {};

    FIELDS.forEach((name) => {
      const el = root.querySelector(`[name="${name}"]`);
      if (!el) return;
      if (el.type === "checkbox") {
        data[name] = el.checked ? 1 : 0;
      } else if (el.tagName === "SELECT" || el.tagName === "TEXTAREA" || el.tagName === "INPUT") {
        data[name] = (el.value ?? "").trim();
      }
    });

    // fichiers
    FILE_FIELDS.forEach((name) => {
      const el = root.querySelector(`input[type="file"][name="${name}"]`);
      if (el && el.files && el.files.length) files[name] = el.files[0];
    });

    return { data, files };
  }

  // --- CRUD ---
  async function listPublication(params={}) {
    return await apiFetch("publication", { method:"GET", query: params });
  }

  async function getPublication(id) {
    return await apiFetch("publication/"+id, { method:"GET" });
  }

  async function createPublication(formSel="#form-publication") {
    const {data, files} = readForm(formSel);
    const useOverride = Object.keys(files).length>0; // PUT/PATCH override quand form-data
    const res = await apiFetch("publication", {
      method: "POST",
      data, files,
      methodOverride: useOverride
    });
    return res;
  }

  async function updatePublication(id, formSel="#form-publication") {
    const {data, files} = readForm(formSel);
    const res = await apiFetch("publication/"+id, {
      method: "PUT",
      data, files,
      methodOverride: true
    });
    return res;
  }

  async function deletePublication(id) {
    return await apiFetch("publication/"+id, { method:"DELETE" });
  }

  // --- Expose en global si besoin ---
  window.API_Publication = {
    list: listPublication,
    get: getPublication,
    create: createPublication,
    update: updatePublication,
    delete: deletePublication,
    readForm
  };

})();