// --- Config API ---
const API_ROOT = (
  (window.PMSettings && PMSettings.restUrl) ||
  (window.wpApiSettings && window.wpApiSettings.root) ||
  '/wp-json'
).replace(/\/$/, '');

const API_NS   = 'plateforme-reunion/v1';
const API_BASE = `${API_ROOT}/${API_NS}`;
const NONCE    = (window.PMSettings && PMSettings.nonce) ||
                 (window.wpApiSettings && window.wpApiSettings.nonce) || '';

const BASE_HEADERS = { 'X-WP-Nonce': NONCE, 'Accept': 'application/json' };

console.log("PMSettings =", window.PMSettings);
console.log("API_BASE =", API_BASE);


function addParticipantToEditList(input, listElement) {
    const email = input.value.trim();
    if (!email) return;

    // Vérification format email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        Swal.fire('Erreur', 'Adresse email invalide', 'error');
        return;
    }

    // Vérifier si déjà présent
    const exists = Array.from(listElement.querySelectorAll('li'))
        .some(li => li.dataset.email === email);
    if (exists) {
        Swal.fire('Info', 'Cet email est déjà ajouté', 'info');
        return;
    }

    // Créer l’élément li
    const li = document.createElement('li');
    li.dataset.email = email;
    li.style.display = 'flex';
    li.style.justifyContent = 'space-between';
    li.style.alignItems = 'center';
    li.style.gap = '10px';

    // ✅ Ajouter du vrai texte et bouton
    li.innerHTML = `
        <span>${email}</span>
        <button class="delete-participant" style="background:none;border:none;color:#c00;cursor:pointer;">
            <i class="fas fa-trash-alt"></i>
        </button>
    `;

    // Bouton supprimer
    li.querySelector('.delete-participant').addEventListener('click', () => li.remove());

    listElement.appendChild(li);
    input.value = '';
}


document.addEventListener('DOMContentLoaded', function () {

        const editParticipantEmailInput = document.getElementById('editParticipantEmail');

        const addEditParticipantBtn = document.getElementById('addEditParticipantBtn');

         addEditParticipantBtn.addEventListener('click', () => addParticipantToEditList(editParticipantEmailInput, document
            .getElementById('editParticipantList')));
             editParticipantEmailInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                addParticipantToEditList(editParticipantEmailInput, document.getElementById(
                    'editParticipantList'));
            }
        });

    const table = $('#candidaturesTable').DataTable({
        paging: true,
        searching: false,
        ordering: false,
        info: false,
        pageLength: 5,
        dom: 'Bfrtip',
        buttons: [],
        language: { "emptyTable": "Aucune réunion programmée" },
        columnDefs: [{ targets: 0, orderable: false }]
    });

    // === Charger les réunions avec filtres optionnels ===
    async function loadReunions(filters = {}) {
        try {
            const query = new URLSearchParams(filters).toString();
            const res = await fetch(`${API_BASE}/reunions?${query}`, { headers: BASE_HEADERS, credentials: 'include' });
            if (!res.ok) throw new Error("Erreur API " + res.status);
            const data = await res.json();

            table.clear();
            (data || []).forEach(r => {
                // Par défaut aucune action
                let actionsHtml = '';

                // Vérifier si l'utilisateur connecté est le créateur
                if (parseInt(r.created_by) === parseInt(PMSettings.userId)) {
                    actionsHtml = `
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" class="details-btn" data-id="${r.id}">Détails</a>
                                <a href="#" class="edit-btn" data-id="${r.id}">Modifier</a>
                                <a href="#" class="delete-btn" data-id="${r.id}">Supprimer</a>
                            </div>
                        </div>`;
                } else {
                    // Sinon, afficher seulement "Détails"
                    actionsHtml = `
                        <div class="actions">
                            <button class="action-btn">...</button>
                            <div class="dropdown-menu">
                                <a href="#" class="details-btn" data-id="${r.id}">Détails</a>
                            </div>
                        </div>`;
                }

                table.row.add([
                    `<input type="checkbox" value="${r.id}">`,
                    r.date_reunion,
                    r.sujet,
                    (r.duree ? r.duree + " min" : "-"),
                    r.nb_participants ? r.nb_participants : 0,
                    r.fichier ? `<a href="${r.fichier}" target="_blank"><i class="fas fa-paperclip"></i></a>` : "-",
                    actionsHtml
                ]);
            });
            table.draw();

        } catch (e) {
            console.error("[loadReunions] ", e);
        }
    }

    loadReunions();

    // --- Gestion des dropdowns actions ---
    $('#candidaturesTable').on('click', '.action-btn', function (e) {
        e.preventDefault();
        e.stopPropagation();

        // Fermer les autres dropdowns
        $('.dropdown-menu').hide();

        // Ouvrir celui cliqué
        const menu = $(this).next('.dropdown-menu');
        menu.toggle();
    });

    // Fermer si on clique ailleurs
    $(document).on('click', function () {
        $('.dropdown-menu').hide();
    });

    

    // === Modal ajout réunion ===
    const addModal = document.getElementById('addMeetingModal');
    const openBtn = document.getElementById('openModalBtn');
    const closeBtn = document.getElementById('closeModalBtn');
    const saveBtn = document.getElementById('saveMeetingBtn');
    const participantInput = document.getElementById('participantEmail');
    const participantList = document.getElementById('participantList');
    /*
        document.getElementById('addParticipantBtn').addEventListener('click', () =>
            addParticipantToList(participantInput, participantList)
        );
    */
    openBtn.addEventListener('click', e => { e.preventDefault(); addModal.style.display = 'flex'; });
    closeBtn.addEventListener('click', () => addModal.style.display = 'none');

    saveBtn.addEventListener('click', async () => {
        const sujet = document.getElementById('meetingSubject').value;
        const date = document.getElementById('meetingDate').value;
        const duree = document.getElementById('duration').value;
        const etabId = (PMSettings && PMSettings.institutId) || 0;
        const participants = Array.from(participantList.querySelectorAll('li')).map(li => li.firstChild.textContent.trim());
        const fichier = document.getElementById('meetingFile').files[0];

        let res;
        try {
            if (fichier) {
                const formData = new FormData();
                formData.append('sujet', sujet);
                formData.append('date_reunion', date);
                formData.append('duree', duree);
                formData.append('etablissement_id', etabId);
                formData.append('emails', JSON.stringify(participants));
                formData.append('fichier', fichier);

                res = await fetch(`${API_BASE}/reunions`, {
                    method: 'POST',
                    headers: { 'X-WP-Nonce': NONCE },
                    body: formData,
                    credentials: 'include'
                });
            } else {
                res = await fetch(`${API_BASE}/reunions`, {
                    method: 'POST',
                    headers: { ...BASE_HEADERS, 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        sujet, date_reunion: date, duree, etablissement_id: etabId, emails: participants
                    }),
                    credentials: 'include'
                });
            }

            const data = await res.json(); // ✅ lire la réponse API

            if (!res.ok) {
                // ⚠️ Afficher le message JSON renvoyé
                Swal.fire('Erreur', data.message || 'Erreur inconnue', 'error');
                return;
            }

            Swal.fire('Succès', 'Réunion créée avec succès', 'success');
            addModal.style.display = 'none';
            loadReunions();
        } catch (e) {
            Swal.fire('Erreur', 'Impossible de créer la réunion', 'error');
            console.error("[saveMeeting]", e);
        }
    });


    // === Voir détails ===
    $('#candidaturesTable').on('click', '.details-btn', async function (e) {
        e.preventDefault();
        const id = this.dataset.id;
        const res = await fetch(`${API_BASE}/reunions/${id}`, { headers: BASE_HEADERS, credentials: 'include' });
        const r = await res.json();

        $('#detailsSubject').text(r.sujet);
        $('#detailsDate').text(r.date_reunion);
        $('#detailsDuration').text(r.duree + ' min');

        const list = $('#detailsParticipantList').empty();

            (r.participants || []).forEach(p => {
                const avatar = p.avatar_url ? `<img src="${p.avatar_url}" alt="avatar" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">`
                                            : `<i class="fas fa-user-circle" style="font-size:32px;color:#999;"></i>`;
                const name   = (p.nom || p.prenom) ? `${p.prenom || ''} ${p.nom || ''}`.trim() : p.email;

                list.append(`
                    <li style="display:flex;align-items:center;gap:10px;">
                        ${avatar}
                        <span>${p.email}</span>
                    </li>
                `);
            });


        document.getElementById('detailsMeetingModal').style.display = 'flex';
    });

    $('#closeDetailsModalBtn').on('click', () =>
        document.getElementById('detailsMeetingModal').style.display = 'none'
    );


    // --- Edit Modal Functionality ---
        const editModal = document.getElementById('editMeetingModal');
        const closeEditBtn = document.getElementById('closeEditModalBtn');
        const updateBtn = document.getElementById('updateMeetingBtn');
        const editPopupContainer = editModal.querySelector('.popup-container');
       // const editParticipantEmailInput = document.getElementById('editParticipantEmail');
       // const addEditParticipantBtn = document.getElementById('addEditParticipantBtn');
        const editParticipantList = document.getElementById('editParticipantList');

        // Ouvrir / fermer
        const openEditModal = () => { editModal.style.display = 'flex'; };
        const closeEditModal = () => { editModal.style.display = 'none'; };

        // Chargement des infos + participants
            $('#candidaturesTable').on('click', '.edit-btn', async function (e) {
                e.preventDefault();
                const id = this.dataset.id;

                // Charger la réunion
                const res = await fetch(`${API_BASE}/reunions/${id}`, { headers: BASE_HEADERS, credentials: 'include' });
                const r = await res.json();

                // Remplir les champs
                $('#editMeetingId').val(id);
                $('#editMeetingDate').val(r.date_reunion.split('/').reverse().join('-'));
                $('#editMeetingSubject').val(r.sujet);

                // Nettoyer la liste
                editParticipantList.innerHTML = '';

                // Ajouter les participants existants
               
                (r.participants || []).forEach(p => {
                    addParticipantToEditList(
                        editParticipantList, 
                        p.email, 
                        p.avatar_url, 
                        p.nom, 
                        p.prenom
                    );
                });

                openEditModal();

                  function addParticipantToEditList(listElement, email, avatarUrl = null, nom = '', prenom = '') {
                if (!email) return;

                // Vérifier doublon
                const exists = Array.from(listElement.querySelectorAll('li'))
                    .some(li => li.dataset.email === email);
                if (exists) return;

                const li = document.createElement('li');
                li.dataset.email = email;
                li.style.display = 'flex';
                li.style.alignItems = 'center';
                li.style.justifyContent = 'space-between';
                li.style.gap = '10px';

                const avatar = avatarUrl
                    ? `<img src="${avatarUrl}" alt="avatar" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">`
                    : `<i class="fas fa-user-circle" style="font-size:32px;color:#999;"></i>`;

                const name = (prenom || nom) ? `${prenom || ''} ${nom || ''}`.trim() : email;

                li.innerHTML = `
                    <div style="display:flex;align-items:center;gap:10px;">
                        ${avatar}
                        <div>
                            <span style="font-weight:600;">${name}</span><br>
                            <small style="color:#666;">${email}</small>
                        </div>
                    </div>
                    <button class="remove-edit-participant-btn" data-email="${email}"
                        style="background:none;border:none;color:#c00;cursor:pointer;font-size:16px;">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                `;

                // Suppression côté UI (optionnel : appel API DELETE)
                li.querySelector('.remove-edit-participant-btn').addEventListener('click', () => {
                    li.remove();
                });

                listElement.appendChild(li);
             }
            });

          



            // === Fonction utilitaire pour ajouter un participant dans la liste du modal Edit ===
           /* function addParticipantToEditList(reunionId, email, avatarUrl = null, nom = '', prenom = '') {
                const li = document.createElement('li');
                li.dataset.email = email;
                li.style.display = 'flex';
                li.style.alignItems = 'center';
                li.style.justifyContent = 'space-between';
                li.style.gap = '10px';

                const avatar = avatarUrl
                    ? `<img src="${avatarUrl}" alt="avatar" style="width:32px;height:32px;border-radius:50%;object-fit:cover;">`
                    : `<i class="fas fa-user-circle" style="font-size:32px;color:#999;"></i>`;

                const name = (nom || prenom) ? `${prenom || ''} ${nom || ''}`.trim() : email;

                li.innerHTML = `
                    <div style="display:flex;align-items:center;gap:10px;">
                        ${avatar}
                        <div>
                            <span style="font-weight:600;">${name}</span><br>
                            <small style="color:#666;">${email}</small>
                        </div>
                    </div>
                    <button class="remove-edit-participant-btn" 
                        style="background:none;border:none;color:#c00;cursor:pointer;font-size:16px;">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                `;

                // Gérer la suppression
                li.querySelector('.remove-edit-participant-btn').addEventListener('click', async function (e) {
                    e.preventDefault();   // ⛔ empêche submit
                    e.stopPropagation();  // ⛔ empêche la propagation

                    if (!confirm(`Supprimer le participant ${email} ?`)) return;

                    try {
                        const res = await fetch(`${API_BASE}/reunions/${reunionId}/participants`, {
                            method: 'DELETE',
                            headers: { ...BASE_HEADERS, 'Content-Type': 'application/json' },
                            credentials: 'include',
                            body: JSON.stringify({ emails: [email] })
                        });
                        const data = await res.json();

                        if (!res.ok) {
                            Swal.fire('Erreur', data.message || 'Impossible de supprimer', 'error');
                            return;
                        }

                        Swal.fire('Succès', `Participant ${email} supprimé`, 'success');
                      
                        li.remove(); // ✅ supprime uniquement l'élément de la liste
                          loadReunions();
                    } catch (e) {
                        Swal.fire('Erreur', 'Échec suppression', 'error');
                        console.error(e);
                    }
                });

                editParticipantList.appendChild(li);
            }*/


            // === Ajouter un participant via input du modal Edit ===
           /* addEditParticipantBtn.addEventListener('click', async () => {
                const id = $('#editMeetingId').val();
                const email = editParticipantEmailInput.value.trim();
                if (!email) return;

                // Vérifier format email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    Swal.fire('Erreur', 'Adresse email invalide', 'error');
                    return;
                }

                try {
                    const res = await fetch(`${API_BASE}/reunions/${id}/participants`, {
                        method: 'POST',
                        headers: { ...BASE_HEADERS, 'Content-Type': 'application/json' },
                        credentials: 'include',
                        body: JSON.stringify({ emails: [email] })
                    });
                    const data = await res.json();

                    if (!res.ok) {
                        Swal.fire('Erreur', data.message || 'Impossible d’ajouter', 'error');
                        return;
                    }

                    Swal.fire('Succès', `Participant ${email} ajouté`, 'success');
                    editParticipantEmailInput.value = '';

                    // Ajouter directement dans la liste
                    addParticipantToEditList(id, email);
                } catch (e) {
                    Swal.fire('Erreur', 'Échec ajout', 'error');
                    console.error(e);
                }
            });*/
            

   
        // === Sauvegarder la réunion depuis le modal Edit ===
        updateBtn.addEventListener('click', async () => {
            const id = $('#editMeetingId').val();
            const sujet = $('#editMeetingSubject').val();
            const date = $('#editMeetingDate').val();

            const participants = Array.from(editParticipantList.querySelectorAll('li'))
                .map(li => li.dataset.email)
                .filter(email => email && email.trim() !== "");

            try {
                const res = await fetch(`${API_BASE}/reunions/${id}`, {
                    method: 'PATCH',
                    headers: { ...BASE_HEADERS, 'Content-Type': 'application/json' },
                    credentials: 'include',
                    body: JSON.stringify({ sujet, date_reunion: date, emails: participants })
                });

                const data = await res.json();
                if (!res.ok) {
                    Swal.fire('Erreur', data.message || 'Échec de la mise à jour', 'error');
                    return;
                }

                Swal.fire('Succès', 'Réunion mise à jour avec succès', 'success');
                closeEditModal();
                loadReunions();
            } catch (e) {
                Swal.fire('Erreur', 'Impossible de mettre à jour la réunion', 'error');
                console.error(e);
            }
        });



        // Fermeture
        closeEditBtn.addEventListener('click', closeEditModal);
        editModal.addEventListener('click', (e) => {
            if (!editPopupContainer.contains(e.target)) {
                closeEditModal();
            }
        });


    // === Supprimer réunion ===
    $('#candidaturesTable').on('click', '.delete-btn', async function (e) {
        e.preventDefault();
        const id = this.dataset.id;
        if (confirm("Supprimer cette réunion ?")) {
            await fetch(`${API_BASE}/reunions/${id}`, {
                method: 'DELETE',
                headers: BASE_HEADERS,
                credentials: 'include'
            });
            loadReunions();
        }
    });
});
