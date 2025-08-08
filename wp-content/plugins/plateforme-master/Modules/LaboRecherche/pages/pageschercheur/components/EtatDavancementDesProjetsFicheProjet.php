<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="content-wrapper">

    <!-- Informations générales block -->
    <div class="card full-width">
        <h3>Informations générales</h3>
        <ul class="styled-list">
            <li><strong>Titre :</strong>Interface cerveau-machine – BCI-Learn</li>
            <li><strong>Porteur :</strong>Pr. Rym Nasri</li>
            <li><strong>Date début / fin :</strong>01/03/2024 – 28/02/2026</li>
            <li><strong>Financement :</strong>90 000 TND (H2020 + MESRS)</li>
            <li><strong>État :</strong>En cours (80% d’avancement)</li>
            <li><strong>Livrables réalisés :</strong>Rapport technique ✅, Prototype matériel ✅, Article</li>
            <li><strong>Prochaine étape :</strong>Soumission article – Septembre 2025</li>
            <li><strong>Blocages éventuels :</strong></li>
            <li><strong>Jalons passés :</strong>Planning validé, ✅ Tests initiaux ✅, Déploiement v1✅</li>
        </ul>
    </div>

    <!-- Suivi visuel de l’avancement  block -->
    <div class="card full-width">
        <h3>Suivi visuel de l’avancement</h3>
        <table class="parcours-table">
            <thead>
                <tr>
                    <th>Étape</th>
                    <th>Date prévu</th>
                    <th>Statut</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Signature convention</td>
                    <td>01/03/2024</td>
                    <td><span class="badge badge-success"><i class="fa-regular fa-circle-check"
                                style="color: #0E962D;"></i> Terminé</span></td>

                </tr>
                <tr>
                    <td>Réalisation prototype</td>
                    <td>30/06/2024</td>
                    <td><span class="badge badge-success"><i class="fa-regular fa-circle-check"
                                style="color: #0E962D;"></i> Terminé</span></td>

                </tr>
                <tr>
                    <td>Début tests cliniques</td>
                    <td>15/09/2024</td>
                    <td><span class="badge badge-success"><i class="fa-regular fa-circle-check"
                                style="color: #0E962D;"></i> Terminé</span></td>

                </tr>
                <tr>
                    <td>Rédaction publication</td>
                    <td>01/11/2024</td>
                    <td><span class="badge badge-warning"><i class="fa-regular fa-clock" style="color: #FFD43B;"></i> En
                            cours</span></td>

                </tr>
                <tr>
                    <td>Rapport final</td>
                    <td>15/01/2026</td>
                    <td><span class="badge badge-secondary"> <i class="fa-regular fa-clock" style="color: #A6A485;"></i>
                            Prévu</span>

                </tr>

            </tbody>
        </table>
    </div>

</div>


<style>
.content-wrapper {
    padding: 20px;
    font-family: 'Poppins', sans-serif;
}

.header-section {
    margin-bottom: 20px;
}

.header-section h2 {
    font-size: 22px;
    font-weight: 600;
}

.grid-layout {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.card {
    background: #fff;
    padding: 16px;
    border-radius: 8px;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.05);
}

.card h3 {
    font-size: 21px;
    margin-bottom: 14px;
    font-weight: bold;
    border-bottom: 1px solid #eee;
    padding-bottom: 6px;
    margin-left: -15px;
    margin-right: -15px;
    margin-top: -19px;
    padding: 20px 25px;
    box-shadow: 0px 5px 16px #00000012;
    color: #2A2916;
}

.info-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.info-list li {
    margin-bottom: 8px;
    font-size: 14px;
}

.enabled {
    background: #9EB08F;
    color: #fff;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 13px;
}

.full-width {
    grid-column: 1 / -1;
}

.parcours-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 5px;
}

.parcours-table th,
.parcours-table td {
    border: 1px solid #ddd;
    padding: 8px;
    font-size: 13px;
    text-align: center;
}

.parcours-table th {
    background-color: #f5f5f5;
    font-weight: 600;
}

.pdf-icon {
    width: 16px;
    vertical-align: middle;
    margin-right: 8px;
    /* Added margin for spacing */
    color: #c60000;
    /* Red color for icons */
}

.parcours-table a {
    text-decoration: none;
    color: #0d6efd;
    font-weight: 500;
}

.parcours-table a:hover {
    text-decoration: underline;
}


.status-bar-container {
    background-color: #fff;
    border-radius: 8px;
    padding: 16px 24px;
    margin-bottom: 24px;
    font-family: 'Poppins', sans-serif;
    box-shadow: 0px 3px 16px #00000014;
}

.status-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.status-header h2 {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.status-dropdown {
    position: relative;
    display: inline-block;
}

.current-status {
    padding: 6px 16px;
    border-radius: 20px;
    background-color: #D6E6D3;
    color: #2B6629;
    font-weight: 500;
    font-size: 14px;
    cursor: pointer;
    user-select: none;
}

.current-status.accepted {
    background-color: #C6E8C2;
    color: #247626;
}

.status-list {
    position: absolute;
    top: 120%;
    right: 0;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 8px 0;
    margin: 4px 0 0 0;
    list-style: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    display: none;
    z-index: 10;
}

.status-dropdown:hover .status-list {
    display: block;
}

.status-item {
    padding: 6px 16px;
    font-size: 14px;
    cursor: pointer;
}

.status-item:hover {
    background-color: #f2f2f2;
}

.status-item.selected {
    background-color: #e7f6e6;
    color: #2B6629;
    font-weight: bold;
}

.status-wrapper h2 {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.status-select {
    position: relative;
}



.status-options {
    position: absolute;
    right: 0;
    top: 110%;
    width: 180px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    display: none;
    flex-direction: column;
    padding: 4px 0;
    z-index: 10;
}

.status-select:hover .status-options {
    display: flex;
}

.option {
    padding: 10px 16px;
    font-size: 14px;
    text-align: left;
    cursor: pointer;
    transition: background 0.2s ease;
}

.option:hover {
    background-color: #f5f5f5;
}

.option.selected {
    background-color: #e9f5e8;
    color: #2a6529;
    font-weight: 600;
}

button.status-button {
    background: #FFFFFF 0% 0% no-repeat padding-box;
    border: 1px solid #BF0404;
    border-radius: 5px;
    padding: 5px 45px;
    font-weight: 600;
}


.grid-container {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    grid-template-rows: auto auto;
    gap: 24px;
}

.box {
    background-color: #ffffff;
    padding: 20px 24px;
    border-radius: 12px;
    box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.06);
    cursor: grab;
}

.box:active {
    cursor: grabbing;
}

.box h3 {
    font-size: 21px;
    margin-bottom: 14px;
    font-weight: 600;
    border-bottom: 1px solid #eee;
    padding-bottom: 6px;
    box-shadow: 0px 5px 16px #00000012;
    margin-left: -23px;
    margin-right: -22px;
    margin-top: -19px;
    padding: 17px 15px;
}

.card.full-width {
    margin-top: 20px;
    border: 0px;
}

.box ul {
    list-style: none;
    padding: 0;
    margin: 0;
    margin-top: 32px;
}

.box ul li {
    margin-bottom: 10px;
    font-size: 14px;
}

.badge.enabled {
    background-color: #A6A485;
    color: white;
    padding: 7px 15px;
    border-radius: 12px;
    font-size: 13px;
    display: inline-block;
}

/* Responsive */
@media (max-width: 768px) {
    .grid-container {
        grid-template-columns: 1fr;
    }
}

.styled-list {
    list-style: none;
    padding: 0;
    margin: 0;
    border-radius: 10px;
    overflow: hidden;
    background-color: #fff;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
}

.styled-list li {
    padding: 16px 16px;
    border-bottom: 1px solid #dedcc9;
    display: flex;
    color: #333;
    gap: 200px;
}




.styled-list li:last-child {
    border-bottom: none;
}

.styled-list li ul li {
    border-bottom: none;
    padding-left: 0px;
    padding: 0px;

}

.badge {
    display: inline-block;
    padding: 4px 10px;
    font-size: 13px;
    font-weight: 500;
    border-radius: 20px;
    border: 2px solid transparent;
}

.badge-success {
    color: #198754;
    background-color: #e6f7ee;
    border-color: #198754;
}

.badge-warning {
    color: #d89e00;
    background-color: #fff9e6;
    border-color: #d89e00;
}

/* Add this new rule here */
.badge-secondary {
    color: #555;
    background-color: #f0f0f0;
    border-color: #ccc;
}

.badge.badge-danger {
    background-color: #C31111;
    color: #fff;
    padding: 8px 20px;
    border-radius: 30px;
    font-size: 14px;
    font-weight: 500;
    display: inline-block;
    margin: 0px 8px 5px 0;
    font-family: 'Poppins', sans-serif;
    box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.05);
    background: #BF0404 0% 0% no-repeat padding-box;
    border-radius: 17px;
}


.styled-list li ul {
    padding: 0px;
}

.styled-list li ul li:first-child {
    padding-top: 0px
}

.styled-list strong {
    font-weight: 600;
    color: #6E6D55;
    min-width: 240px;
    display: inline-block;
}

.box ul li {
    display: flex;
    align-items: center;
    gap: 20px;
    font-size: 14px;
    padding: 10px 0;
    border-bottom: 1px solid #dedcc9;
    font-weight: 600;

}

.box ul li:last-child {
    border-bottom: none;
}

.box ul li strong {
    min-width: 180px;
    font-weight: 600;
    color: #6E6D55;
    flex-shrink: 0;
}

.box ul li span {
    color: #333;
}

.parcours-table th {
    background-color: #ECEBE3;
    font-weight: bold;
}

.parcours-table th,
.parcours-table td {
    border: 1px solid #ddd;
    padding: 8px;
    font-size: 14px;
    text-align: center;
}

.parcours-table .notes-cell {
    text-align: left;
    font-size: 13px;
    line-height: 1.4;
    font-family: 'Poppins', sans-serif;
    color: #333;
    white-space: nowrap;
}

.status-select .btn {
    background-color: #ffffff;
    border: 1px solid #ccc;
    border-radius: 6px;
    color: #333;
    padding: 6px 14px;
    font-size: 14px;
    min-width: 140px;
    box-shadow: none;
    transition: all 0.2s ease-in-out;
}

.status-select .btn:hover {
    border-color: #999;
    background-color: #f8f9fa;
}

.status-select .dropdown-toggle::after {
    margin-left: 8px;
    vertical-align: middle;
}

.parcours-table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 12px;
    overflow: hidden;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    box-shadow: 0px 3px 16px rgba(0, 0, 0, 0.06);
}

.parcours-table thead th {
    background-color: #ECEBE3;
    color: #333;
    font-weight: 600;
    padding: 14px 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.parcours-table tbody td {
    padding: 12px;
    border-bottom: 1px solid #eee;
    color: #444;
    vertical-align: middle;
    text-align: center;
}

.parcours-table tbody tr:last-child td {
    border-bottom: none;
}

.parcours-table td:first-child {
    width: 200px;
    font-weight: 500;
    color: #555;
}

.parcours-table td:nth-child(3) {
    font-weight: 300;
    color: #444;
}

table#historique tbody tr:last-child td:first-child {
    width: 143Px;
}

/****table  */
/* Container pagination */
.dataTables_paginate {
    display: flex !important;
    justify-content: center !important;
    margin-top: 20px !important;
    gap: 6px !important;
    font-family: 'Poppins', sans-serif !important;
}

/* Boutons de pagination */
.dataTables_paginate .paginate_button {
    background-color: #fff !important;
    border: 2px solid #c40000 !important;
    color: #c40000 !important;
    font-weight: 500 !important;
    padding: 6px 10px !important;
    min-width: 36px !important;
    text-align: center !important;
    border-radius: 8px !important;
    cursor: pointer !important;
    transition: all 0.2s ease !important;
}

/* Bouton actif */
.dataTables_paginate .paginate_button.current {
    background-color: #c40000 !important;
    color: #fff !important;
    border-color: #c40000 !important;
}

/* Survol */
.dataTables_paginate .paginate_button:hover {
    background-color: #f8eaea !important;
}

/* Supprime les bordures par défaut de DataTables */
.dataTables_wrapper .dataTables_paginate .paginate_button {
    border: none !important;
}

/* Supprime focus violet */
.dataTables_paginate .paginate_button:focus {
    outline: none !important;
    box-shadow: none !important;
}

/* Table générique */
table {
    border: none !important;
    border-collapse: separate !important;
    border-spacing: 0 !important;
    border-radius: 12px !important;
    overflow: hidden !important;
    box-shadow: none !important;
}

/* En-têtes */
table thead {
    position: static !important;
    transform: translateY(-15px) !important;
    border: none !important;
}

/* Cellules */
table th {
    padding: 27px 10px 9px !important;
    border: 0px solid #EBE9D7 !important;
    background-color: #ECEBE3 !important;
    font-weight: bold !important;
}

table td {
    padding: 12px !important;
    border: 1px solid #EBE9D7 !important;
    box-shadow: none !important;
}

/* Coins arrondis */
table thead tr:first-child th:first-child {
    border-top-left-radius: 12px !important;
    border-bottom-left-radius: 12px !important;
}

table thead tr:first-child th:last-child {
    border-top-right-radius: 12px !important;
    border-bottom-right-radius: 12px !important;
}

table tbody tr:first-child td:first-child {
    border-top-left-radius: 12px !important;
}

table tbody tr:first-child td:last-child {
    border-top-right-radius: 12px !important;
}

table tbody tr:last-child td:first-child {
    border-bottom-left-radius: 12px !important;
}

table tbody tr:last-child td:last-child {
    border-bottom-right-radius: 12px !important;
}

table tbody tr:nth-child(even) {
    background: #ECEBE34D 0% 0% no-repeat padding-box !important;
}

/*** style table */
.custom-list {
    list-style: none;
    padding-left: 0;
    margin-top: 10px;
}

.custom-list li {
    position: relative;
    padding-left: 22px;
    margin-bottom: 6px;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    color: #333;
}

.custom-list li::before {
    content: "";
    position: relative;
    top: 6px;
    left: 0;
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-bottom: 10px solid #c40000;
    transform: rotate(90deg);
    margin-right: 10px;
}

/* style select **/
select.form-control {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;

    background-color: #fff;
    border: 1px solid #DBD9C3;
    border-radius: 8px;
    padding: 12px 45px 12px 16px;

    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    color: #2A2916;

    background-image: url("/wp-content/plugins/plateforme-master/images/DROPDOWN icon.png");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 30px;
}

select.form-control::-ms-expand {
    display: none;
}


/* Pour IE */
select.form-control::-ms-expand {
    display: none;
}


select.form-control:focus {
    outline: none;
    border-color: #c4c1a0;
    box-shadow: 0 0 0 2px rgba(204, 204, 204, 0.2);
}

.btn-status {
    color: #333;
    font-weight: 500;
}

.btn-status.accepted {
    background-color: #d4edda;
    color: #155724;
    border-color: #c3e6cb;
}

.btn-status.pending {
    background-color: #fff3cd;
    color: #856404;
    border-color: #ffeeba;
}

.btn-status.rejected {
    background-color: #f8d7da;
    color: #721c24;
    border-color: #f5c6cb;
}

.dropdown-item {

    font-size: 15px;

}

/* Custom styles for ordered list */
.custom-ordered-list {
    list-style: none;
    padding-left: 0;
    counter-reset: item-counter;
    margin-top: 10px;
}

.custom-ordered-list li {
    counter-increment: item-counter;
    display: flex;
    align-items: flex-start;
    margin-bottom: 12px;
    font-weight: 600;
    color: #333;
}

.custom-ordered-list li::before {
    content: counter(item-counter) ".";
    font-weight: bold;
    color: #c60000;
    margin-right: 10px;
}
</style>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const btn = document.getElementById('dropdownStatutInscription');
    const menu = document.getElementById('dropdownMenuStatut');
    const items = menu.querySelectorAll('.dropdown-item');

    // Initialiser le dropdown Bootstrap (manuellement si besoin)
    const dropdown = new bootstrap.Dropdown(btn);

    // Gestion du clic sur le bouton pour toggle
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        menu.classList.contains('show') ? dropdown.hide() : dropdown.show();
    });

    // Gérer les clics sur les items du dropdown
    items.forEach(item => {
        item.addEventListener("click", function(e) {
            e.preventDefault();

            const selectedText = this.textContent.trim();



            // Sinon, mettre à jour le texte du bouton
            btn.textContent = selectedText;
        });
    });


});



document.addEventListener("DOMContentLoaded", function() {
    const btn = document.getElementById("dropdownStatutInscription");
    const items = document.querySelectorAll("#dropdownMenuStatut .dropdown-item");
    const modal = document.getElementById("modalObjectifs");
    const popup = document.getElementById("popupContainerObjectifs");

    items.forEach(item => {
        item.addEventListener("click", function(e) {
            e.preventDefault();
            const selected = this.textContent.trim();



            // ✅ Mise à jour du texte du bouton
            btn.textContent = selected;

            // ✅ Mise à jour de la couleur du bouton selon le statut
            btn.classList.remove("accepted", "pending", "rejected", "btn-status");
            btn.classList.add("btn-status");

            if (selected === "Acceptée") btn.classList.add("accepted");
            else if (selected === "En Attente") btn.classList.add("pending");
            else if (selected === "Refusée") btn.classList.add("rejected");
        });
    });




});





/*
  document.addEventListener('DOMContentLoaded', () => {
  const dropdown = document.querySelector('.dropdown');
  dropdown.addEventListener('click', () => {
    alert("Changer le statut ici...");
  });
});
*/



const dragZone = document.getElementById('dragZone');
let draggedItem = null;

dragZone.addEventListener('dragstart', function(e) {
    draggedItem = e.target;
    e.target.style.opacity = '0.5';
});

dragZone.addEventListener('dragend', function(e) {
    e.target.style.opacity = '1';
});

dragZone.addEventListener('dragover', function(e) {
    e.preventDefault();
});

dragZone.addEventListener('drop', function(e) {
    e.preventDefault();
    const target = e.target.closest('.box');
    if (target && draggedItem !== target) {
        const allBoxes = [...dragZone.querySelectorAll('.box')];
        const draggedIndex = allBoxes.indexOf(draggedItem);
        const targetIndex = allBoxes.indexOf(target);

        if (draggedIndex < targetIndex) {
            target.after(draggedItem);
        } else {
            target.before(draggedItem);
        }
    }
});
</script>