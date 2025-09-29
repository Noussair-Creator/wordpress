document.addEventListener('DOMContentLoaded', function () {

    // --- Config API ---
    const API_ROOT = (
        (window.PMSettings && PMSettings.restUrl) ||
        (window.wpApiSettings && window.wpApiSettings.root) ||
        '/wp-json'
    ).replace(/\/$/, '');

    const API_NS = 'plateforme-reunion/v1';
    const API_BASE = `${API_ROOT}/${API_NS}`;
    const NONCE = (window.PMSettings && PMSettings.nonce) ||
        (window.wpApiSettings && window.wpApiSettings.nonce) || '';

    const BASE_HEADERS = { 'X-WP-Nonce': NONCE, 'Accept': 'application/json' };

    console.log("PMSettings =", window.PMSettings);
    console.log("API_BASE =", API_BASE);


    function addParticipantToList(input, listElement) {
        const email = input.value.trim();
        if (!email) return;

        // Vérification format email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Adresse email invalide');
            return;
        }

        // Vérifier si déjà présent
        const exists = Array.from(listElement.querySelectorAll('li'))
            .some(li => li.dataset.email === email);
        if (exists) {
            alert('Cet email est déjà ajouté');
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


    const editParticipantEmailInput = document.getElementById('editParticipantEmail');
    const addEditParticipantBtn = document.getElementById('addEditParticipantBtn');

    addEditParticipantBtn.addEventListener('click', () => addParticipantToList(editParticipantEmailInput, document.getElementById('editParticipantList')));
    editParticipantEmailInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            addParticipantToList(editParticipantEmailInput, document.getElementById('editParticipantList'));
        }
    });

    const table = $('#candidaturesTable').DataTable({
        paging: true,
        pagingType: 'full_numbers',
        searching: false,
        ordering: false,
        info: false,
        pageLength: 5,
        dom: 'Bfrtip',
        buttons: [],
        language: {
            "emptyTable": "Aucune réunion programmée",
            "paginate": {
                "first": '<i class="fa-solid fa-angles-left"></i>',
                "last": '<i class="fa-solid fa-angles-right"></i>',
                "next": '<i class="fa-solid fa-angle-right"></i>',
                "previous": '<i class="fa-solid fa-angle-left"></i>'
            }
        },
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
                ]).node().id = `reunion-${r.id}`; // Add unique ID to the row
            });
            table.draw();

        } catch (e) {
            console.error("[loadReunions] ", e);
        }
    }

    loadReunions();

    // --- Search Functionality ---
    const searchInput = document.getElementById('customSearchInput');
    searchInput.addEventListener('keyup', function (event) {
        const searchTerm = event.target.value;
        // We can add a debounce here if needed to avoid too many API calls
        loadReunions({ sujet: searchTerm });
    });

    // --- Check All Functionality ---
    $('#checkAll').on('click', function () {
        const isChecked = $(this).prop('checked');
        $('#candidaturesTable tbody input[type="checkbox"]').prop('checked', isChecked);
    });

    $('#candidaturesTable tbody').on('change', 'input[type="checkbox"]', function () {
        if (!this.checked) {
            $('#checkAll').prop('checked', false);
        } else {
            const totalCheckboxes = $('#candidaturesTable tbody input[type="checkbox"]').length;
            const checkedCheckboxes = $('#candidaturesTable tbody input[type="checkbox"]:checked').length;
            if (totalCheckboxes === checkedCheckboxes) {
                $('#checkAll').prop('checked', true);
            }
        }
    });

    table.on('draw', function () {
        // Uncheck "check all" on table redraw (like pagination) because selection is lost across pages
        $('#checkAll').prop('checked', false);
    });


    // --- Gestion des dropdowns actions ---
    $('#candidaturesTable').on('click', '.action-btn', function (e) {
        e.preventDefault();
        e.stopPropagation();

        // Fermer les autres dropdowns
        $('.dropdown-menu').not($(this).next()).hide();

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
    const addParticipantBtn = document.getElementById('addParticipantBtn');

    addParticipantBtn.addEventListener('click', () => addParticipantToList(participantInput, participantList));
    participantInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            addParticipantToList(participantInput, participantList);
        }
    });

    openBtn.addEventListener('click', e => { e.preventDefault(); addModal.style.display = 'flex'; });
    closeBtn.addEventListener('click', () => addModal.style.display = 'none');

    saveBtn.addEventListener('click', async () => {
        const sujet = document.getElementById('meetingSubject').value;
        const date = document.getElementById('meetingDate').value;
        const duree = document.getElementById('duration').value;
        const etabId = (PMSettings && PMSettings.institutId) || 0;
        const participants = Array.from(participantList.querySelectorAll('li')).map(li => li.querySelector('span').textContent.trim());
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
                alert(data.message || 'Erreur inconnue');
                return;
            }

            alert('Réunion créée avec succès');
            addModal.style.display = 'none';
            // Clear form
            document.getElementById('meetingSubject').value = '';
            document.getElementById('meetingDate').value = '';
            document.getElementById('duration').value = '';
            document.getElementById('meetingFile').value = '';
            participantList.innerHTML = '';
            loadReunions();
        } catch (e) {
            alert('Impossible de créer la réunion');
            console.error("[saveMeeting]", e);
        }
    });


    // === Voir détails ===
    const detailsModal = document.getElementById('detailsMeetingModal');
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
            const name = (p.nom || p.prenom) ? `${p.prenom || ''} ${p.nom || ''}`.trim() : p.email;

            list.append(`
        <li style="display:flex;align-items:center;gap:10px;">
        ${avatar}
        <span>${p.email}</span>
        </li>
        `);
        });


        detailsModal.style.display = 'flex';
    });

    $('#closeDetailsModalBtn').on('click', () =>
        detailsModal.style.display = 'none'
    );


    // --- Edit Modal Functionality ---
    const editModal = document.getElementById('editMeetingModal');
    const closeEditBtn = document.getElementById('closeEditModalBtn');
    const updateBtn = document.getElementById('updateMeetingBtn');
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
        $('#editMeetingSubject').val(r.sujet);
        $('#editDuration').val(r.duree);
        
        const editDateInput = document.getElementById('editMeetingDate');
        if (r.date_reunion && r.date_reunion.includes('/')) {
            const datePart = r.date_reunion.split(' ')[0];
            const [day, month, year] = datePart.split('/');
            const formattedDate = `${year}-${month}-${day}`;
            editDateInput.value = formattedDate;
        } else {
            editDateInput.value = r.date_reunion ? r.date_reunion.split(' ')[0] : '';
        }

        // Nettoyer la liste
        editParticipantList.innerHTML = '';

        // Ajouter les participants existants
        (r.participants || []).forEach(p => {
            addParticipantToEditList(
                editParticipantList,
                p.email
            );
        });

        openEditModal();

        function addParticipantToEditList(listElement, email) {
            if (!email) return;

            // Simplified version for edit modal
            const exists = Array.from(listElement.querySelectorAll('li')).some(li => li.dataset.email === email);
            if (exists) return;

            const li = document.createElement('li');
            li.dataset.email = email;
            li.style.display = 'flex';
            li.style.justifyContent = 'space-between';
            li.style.alignItems = 'center';

            li.innerHTML = `
            <span>${email}</span>
            <button class="remove-edit-participant-btn" data-email="${email}"
            style="background:none;border:none;color:#c00;cursor:pointer;font-size:16px;">
            <i class="fas fa-trash-alt"></i>
            </button>
            `;

            li.querySelector('.remove-edit-participant-btn').addEventListener('click', () => {
                li.remove();
            });

            listElement.appendChild(li);
        }
    });

    // === Sauvegarder la réunion depuis le modal Edit ===
    updateBtn.addEventListener('click', async () => {
        const id = $('#editMeetingId').val();
        const sujet = $('#editMeetingSubject').val();
        const date = $('#editMeetingDate').val();
        const duree = $('#editDuration').val();

        const participants = Array.from(editParticipantList.querySelectorAll('li'))
            .map(li => li.dataset.email)
            .filter(email => email && email.trim() !== "");

        try {
            const res = await fetch(`${API_BASE}/reunions/${id}`, {
                method: 'PATCH',
                headers: { ...BASE_HEADERS, 'Content-Type': 'application/json' },
                credentials: 'include',
                body: JSON.stringify({ sujet, date_reunion: date, duree, emails: participants })
            });

            const data = await res.json();
            if (!res.ok) {
                alert(data.message || 'Échec de la mise à jour');
                return;
            }

            alert('Réunion mise à jour avec succès');
            closeEditModal();
            loadReunions();
        } catch (e) {
            alert('Impossible de mettre à jour la réunion');
            console.error(e);
        }
    });

    // === Supprimer réunion ===
    $('#candidaturesTable').on('click', '.delete-btn', async function (e) {
        e.preventDefault();
        const id = this.dataset.id;

        if (confirm("Êtes-vous sûr de vouloir supprimer cette réunion ? Vous ne pourrez pas revenir en arrière!")) {
            try {
                const res = await fetch(`${API_BASE}/reunions/${id}`, {
                    method: 'DELETE',
                    headers: BASE_HEADERS,
                    credentials: 'include'
                });

                if (!res.ok) {
                    const errData = await res.json();
                    throw new Error(errData.message || 'Failed to delete');
                }

                alert('La réunion a été supprimée.');
                loadReunions();

            } catch (err) {
                alert('La suppression a échoué.');
            }
        }
    });

    // --- Generic Modal Closer ---
    function setupModal(modalId, closeBtnId) {
        const modal = document.getElementById(modalId);
        const closeBtn = document.getElementById(closeBtnId);
        if (modal) {
            closeBtn.addEventListener('click', () => modal.style.display = 'none');
            modal.addEventListener('click', (e) => {
                // Close if click is on the overlay itself, not the container
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }
    }

    setupModal('addMeetingModal', 'closeModalBtn');
    setupModal('editMeetingModal', 'closeEditModalBtn');
    setupModal('detailsMeetingModal', 'closeDetailsModalBtn');

});
