<style>
/* All original CSS styles from your code are preserved here. */
.main-card {
    background-color: #fff;
    border-radius: 0.5rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    padding: 1rem;
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.header-icon-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.5rem;
    font-weight: 600;
    color: #212529;
}

.add-activity-btn {
    background-color: #BF0404;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    border-radius: 0.5rem;
    color: #fff;
}

.add-activity-btn:hover {
    background-color: #BF0404 !important;
    border-color: #BF0404 !important;
    color: #fff !important;
}

.filter-controls-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    justify-content: space-between;
}

@media (min-width: 768px) {
    .filter-controls-container {
        flex-direction: row;
    }
}

.input-filter-group {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    width: 100%;
}

@media (min-width: 768px) {
    .input-filter-group {
        width: auto;
    }
}

.flex-grow-1 {
    flex-grow: 1;
}

.action-btn-group {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-left: auto;
}

.navigation-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.75rem;
}

.nav-link-btn {
    background-color: transparent;
    text-decoration: none;
    color: #6c757d;
    border: none;
}

.calendar-grid {
    background-color: #F1F1F1;
    display: grid;
    grid-template-columns: 80px repeat(7, 1fr);
    /* UPDATED: All grid rows for time slots now have the same fixed height */
    grid-template-rows: 50px repeat(24, 30px);
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
}

.time-slot {
    grid-column: 1;
    padding: 0 0.5rem;
    display: flex;
    align-items: flex-start;
    justify-content: flex-end;
    font-size: 0.75rem;
    color: #6b7280;
    /* transform: translateY(-50%); */
}

.day-header {

    grid-row: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 0.5rem;
    font-weight: 600;
    color: #1f2937;
    border-bottom: 1px solid #e5e7eb;

    position: relative;
}

/* New class for the first day header */
.day-header-start {
    grid-column: 1;
}

.day-header .weekday {
    font-size: 0.875rem;
    font-weight: 600;
}

.day-header .date {
    font-size: 0.75rem;
    font-weight: 400;
    color: #6b7280;
}

.grid-line-vertical {
    border-right: 1px solid #e5e7eb;
}

.grid-line-horizontal {
    border-bottom: 1px solid #e5e7eb;
}

.event-block {
    border-radius: 0.5rem;
    padding: 0.5rem;
    margin: 0.25rem;
    position: relative;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    word-wrap: break-word;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-start;
    overflow: visible;
}

.event-details {
    font-size: 0.875rem;
    font-weight: 500;
}

.event-time {
    font-size: 0.75rem;
    opacity: 0.9;
}

.nav-btn {
    background-color: transparent;
    border: none;
    color: #6c757d;
    cursor: pointer;
    font-size: 1.25rem;
    padding: 0 0.25rem;
}

.nav-btn:hover {
    color: #1f2937;
}

/* Hide the default Bootstrap dropdown arrow */
.filter-btn::after {
    display: none;
}

.event-dropdown .dropdown-toggle::after {
    display: none;
}

.event-dropdown .btn.btn-sm {
    padding: 0;
    background: transparent;
    color: white;
}

/* New Modal Styles from user example */
.btn-close-x {
    background: transparent;
    border: none;
    font-size: 20px;
    font-weight: bold;
    color: #333;
    cursor: pointer;
    padding: 4px 10px;
    line-height: 1;
    transition: color 0.2s ease;
    margin-left: auto;
}

.btn-close-x:hover {
    color: #c40000;
}

.modal-overlay {
    position: fixed;
    top: 0px;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: flex-end;
    z-index: 999999;
}

.popup-container {
    background-color: white;
    width: 400px;
    height: 100%;
    box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
}

/* New classes for popup styles */
.popup-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 10px;
    margin-bottom: 20px;
    padding-left: 25px;
    padding-right: 25px;
    padding-top: 20px;
    box-shadow: 1px 1px 5px 0px #0000002d;
}

.popup-header h2 {
    font-size: 16px;
    margin: 0;
    color: #2A2916;
}

.popup-header-buttons {
    display: flex;
    align-items: center;
    gap: 10px;
}

.btn-enregistrer {
    background-color: #BF0404;
    color: white;
    border: none;
    padding: 6px 14px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
}

.btn-enregistrer:hover {
    background-color: #BF0404 !important;
    border-color: #BF0404 !important;
    color: white !important;
}

.popup-form {
    padding-left: 25px;
    padding-right: 25px;
}

.popup-form input,
.popup-form select {
    width: 100%;
    padding: 10px;
    border: 1px solid #b5af8e;
    border-radius: 7px;
    font-size: 14px;
}

.popup-form textarea {
    width: 100%;
    border: 1px solid #b5af8e;
    border-radius: 6px;
    padding: 12px;
    font-size: 14px;
    margin-bottom: 15px;
}


.file-upload {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

.file-upload input[type="file"] {
    display: none;
}

.file-upload label {
    background-color: #f5f5f5;
    padding: 8px 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
}

.piece-jointe-row {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}

.champ-fichier {
    flex: 1;
    padding: 10px;
    border: 1px solid #ccc;
    background-color: #f3f3f3;
    border-radius: 6px;
    font-size: 14px;
    color: #666;
}

.btn-importer {
    background-color: #DBD9C3;
    color: #6E6D55;
    padding: 11px 16px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    cursor: pointer;
    text-align: center;
    white-space: nowrap;
}

.custom-file-upload {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-top: 10px;
}

.upload-label {
    display: inline-block;
    padding: 10px 15px;
    background-color: #f8f8f8;
    color: #333;
    border: 1px solid #ccc;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    width: fit-content;
    transition: all 0.3s ease;
}

.upload-label:hover {
    background-color: #eaeaea;
}

.upload-label i {
    margin-right: 8px;
    color: #b40000;
}

.input-file-wrapper {
    display: flex;
    align-items: center;
    border-radius: 7px;
    overflow: hidden;
    width: 100%;
    background-color: white;
}

.input-file-text {
    flex: 1;
    border: none;
    padding: 10px 12px;
    font-size: 14px;
    color: #555;
    background-color: transparent;
    border-radius: 7px 0 0 7px !important;
}

.input-file-text:focus {
    outline: none;
}

.btn-importer {
    background-color: #DBD9C3;
    color: #ffffffff !important;
    padding: 11px 16px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    border-left: 1px solid #e2e0d1;
    border-radius: 0 7px 7px 0;
}

.btn-importer:hover {
    background-color: #b5af8e;
}

.btn-importer i {
    font-size: 14px;
}

.modal-overlay label {
    min-width: 100px;
    font-weight: 600;
    color: #6E6D55;
    flex-shrink: 0;
}

.objectifs_liste {
    list-style-type: none;
    padding-left: 0;
    margin-bottom: 20px;
}

.objectifs_liste li::before {
    content: '\25B6';
    color: #b40000;
    margin-right: 8px;
}

.btn-ajouter {
    background-color: #c62828;
    color: white;
    border: none;
    padding: 10px 14px;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
}

.form-group-flex {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.form-group-row {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

/* New color and background classes */
.text-calendar-red {
    color: #BF0404;
}

.bg-calendar-red {
    background-color: #BF0404;
}

/* New border color class */
.border-light-brown {
    border-color: #DBD9C3;
}

/* New styles to match the screenshot */
.search-container {
    position: relative;
    flex: 1;
}

.search-container input {
    border-color: #b5af8e;
    border-radius: 6px;
    padding-right: 2.5rem;
    width: 100%;
    border-width: 1px;
}

.search-container input:focus {
    outline: none;
    border-color: #b5af8e;
    box-shadow: none;
}

.search-container .search-icon {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    color: #6b7280;
}

.filter-btn {
    text-align: left;
    background-color: white;
    border: 1px solid #b5af8e;
    border-radius: 6px;
    color: black;
    box-shadow: none !important;
    width: 200px !important;
}

.filter-btn:hover {
    background-color: white;
    border-color: #b5af8e;
}

.filter-btn:focus {
    box-shadow: none !important;
}

.action-btn-group {
    display: flex;
    gap: 0.5rem;
}

.action-btn {
    background-color: white;
    border: none;
    color: #6b7280;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    border-radius: 6px;
    transition: all 0.2s ease;
    box-shadow: 1px 1px 10px -1px #00000038;
}

.action-btn:hover {
    background-color: #f0f0f0;
}

.action-btn .icon {
    font-size: 1rem;
}

.filter-select {
    flex: 1;
}

.bg-action-btn-1 {
    /* background-color: #D3CEB4;
border-color: #D3CEB4; */
}

.text-action-btn-1 {
    color: #6E6D55;
}

/* Removed default flatpickr icons and moved the padding to the parent container */
.flatpickr-input {
    background-image: none !important;
    padding-right: 10px;
}

/* New style to align icons correctly inside the input field */
.date-input-container,
.time-input-container {
    position: relative;

}

.date-input-container {
    width: 100%;
}

.time-input-container {
    width: 47%;
}


.date-input-container input,
.time-input-container input {
    padding-right: 2.5rem;
}

.date-input-container .date-icon,
.time-input-container .time-icon {
    position: absolute;
    right: 1rem;
    top: 68%;
    transform: translateY(-50%);
    color: #8c8c8c;
}

/* NEW STYLES FOR SEGMENTED BUTTONS */
.segmented-buttons {
    display: flex;
    border-radius: 6px;
    box-shadow: 1px 1px 10px -1px #00000038;
    overflow: hidden;
    background-color: #fff;
}

.segmented-buttons .action-btn {
    border-radius: 0;
    box-shadow: none;
    width: 45px;
    height: 45px;
    transition: background-color 0.2s ease, color 0.2s ease;
}

.segmented-buttons .action-btn:first-child {
    border-right: 1px solid #e5e7eb;
}

.segmented-buttons .action-btn:last-child {
    border-left: 1px solid #e5e7eb;
}

.btn-active {
    background-color: #d8d6b4;
}

.btn-active .icon {
    color: white;
}
</style>

<div class="container-fluid">
    <div class="main-card">

        <!-- Header and "Add Activity" Button -->
        <div class="header-container">
            <div class="header-icon-group">
                <img width="40px" class="text-calendar-red"
                    src="/wp-content/plugins/plateforme-master/images/icons/7061954.png" alt="7061954.png">
                <!-- <i class="fa-solid fa-calendar-days "></i> -->
                <span>Calendrier</span>
            </div>
            <button type="button" class="btn add-activity-btn" id="openActivityModalBtn">

                <i class="fa-regular fa-calendar text-white " style="color: #ffffffff;"></i>
                <!-- <i class="fa-solid fa-plus "></i> -->
                <span class="text-white">Ajouter une activité</span>
            </button>
        </div>

        <!-- Filters and Controls -->
        <div class="filter-controls-container">
            <div class="input-filter-group">
                <div class="search-container">
                    <input type="text" placeholder="Recherche..." class="form-control" id="searchInput">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                </div>
                <div class="dropdown">
                    <button                            
                        class="btn dropdown-toggle w-100 rounded-2 filter-btn d-flex justify-content-between align-items: center"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false" id="filterTypeButton"        
                        data-type="all">
                        <span>Type</span><i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item filter-type" href="#" data-type="all">Tous</a></li>
                        <li><a class="dropdown-item filter-type" href="#" data-type="Colloque">Colloques</a></li>
                        <li><a class="dropdown-item filter-type" href="#" data-type="Conférence">Conférences</a>
                        </li>
                        <li><a class="dropdown-item filter-type" href="#" data-type="Séminaire">Séminaires</a></li>
                        <li><a class="dropdown-item filter-type" href="#" data-type="journee-etude">Journées
                                d'étude</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button                            
                        class="btn dropdown-toggle w-100 rounded-2 filter-btn d-flex justify-content-between align-items: center"
                        type="button" data-bs-toggle="dropdown" aria-expanded="false" id="filterMonthButton">
                        <span>Mois</span>
                        <img width="20px"                                
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png"          
                            alt="Icon-calendar">
                    </button>
                    <ul class="dropdown-menu" id="monthDropdown">
                        <li><a class="dropdown-item filter-month" href="#" data-month="reset">Tous les mois</a></li>
                        <li><a class="dropdown-item filter-month" href="#" data-month="0">Janvier</a></li>
                        <li><a class="dropdown-item filter-month" href="#" data-month="1">Février</a></li>
                        <li><a class="dropdown-item filter-month" href="#" data-month="2">Mars</a></li>
                        <li><a class="dropdown-item filter-month" href="#" data-month="3">Avril</a></li>
                        <li><a class="dropdown-item filter-month" href="#" data-month="4">Mai</a></li>
                        <li><a class="dropdown-item filter-month" href="#" data-month="5">Juin</a></li>
                        <li><a class="dropdown-item filter-month" href="#" data-month="6">Juillet</a></li>
                        <li><a class="dropdown-item filter-month" href="#" data-month="7">Août</a></li>
                        <li><a class="dropdown-item filter-month" href="#" data-month="8">Septembre</a></li>
                        <li><a class="dropdown-item filter-month" href="#" data-month="9">Octobre</a></li>
                        <li><a class="dropdown-item filter-month" href="#" data-month="10">Novembre</a></li>
                        <li><a class="dropdown-item filter-month" href="#" data-month="11">Décembre</a></li>
                    </ul>
                </div>
            </div>
            <div class="action-btn-group">
                <button type="button" class="action-btn bg-action-btn-1">
                    <img class="text-action-btn-1 icon" width="20px"                        
                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-funnel.png"            
                        alt="Icon-funnel">
                </button>
                <button type="button" class="action-btn">
                    <img class="icon text-calendar-red" width="20px"                        
                        src="/wp-content/plugins/plateforme-master/images/icons/upload-red.png" alt="upload-red">
                </button>
            </div>
        </div>

        <!-- New Navigation Header -->
        <div class="navigation-header">
            <button class="btn nav-link-btn" id="prevWeekBtn">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <span class="fs-4 fw-bold text-dark" id="currentMonthYear"></span>
            <button class="btn nav-link-btn" id="nextWeekBtn">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

        <!-- Calendar Grid -->
        <div class="calendar-grid bg-white">
            <!-- Top Row: Day Headers -->
            <div class="day-header day-header-start"></div>
            <div class="day-header" style="grid-column: 2;"><span class="weekday">Lundi</span><span class="date"></span>
            </div>
            <div class="day-header" style="grid-column: 3;"><span class="weekday">Mardi</span><span class="date"></span>
            </div>
            <div class="day-header" style="grid-column: 4;"><span class="weekday">Mercredi</span><span              
                    class="date"></span>
            </div>
            <div class="day-header" style="grid-column: 5;"><span class="weekday">Jeudi</span><span class="date"></span>
            </div>
            <div class="day-header" style="grid-column: 6;"><span class="weekday">Vendredi</span><span              
                    class="date"></span>
            </div>
            <div class="day-header" style="grid-column: 7;"><span class="weekday">Samedi</span><span
                    class="date"></span>
            </div>
            <div class="day-header" style="grid-column: 8;"><span class="weekday">Dimanche</span><span              
                    class="date"></span>
            </div>

            <!-- Time and Grid Lines are now generated by JavaScript -->
        </div>
    </div>
</div>

<!-- New Custom Modal -->
<div class="modal-overlay" id="newActivityModal" style="display: none;">
    <div class="popup-container" id="popupContainerActivity">
        <div class="popup-header">
            <h2>Ajouter une activité</h2>
            <button class="btn-enregistrer" id="btnSaveActivity">Enregistrer</button>
        </div>
        <form class="popup-form">
            <!-- Type -->
            <div class="form-group-flex">
                <label for="activity-type">Type</label>
                <select id="activity-type">
                    <option selected>Sélection...</option>
                    <option value="Colloque">Colloques</option>
                    <option value="Conférence">Conférences</option>
                    <option value="Séminaire">Séminaires</option>
                    <option value="journee-etude">Journées d'étude</option>
                </select>
            </div>
            <!-- Titre -->
            <div class="form-group-flex">
                <label for="activity-title">Titre</label>
                <input type="text" id="activity-title">
            </div>
            <!-- Date and Time -->
            <div class="form-group-row">
                <div class="form-group-flex date-input-container">
                    <label for="activity-date">Date</label>
                    <input type="text" id="activity-date" placeholder="jj/mm/aaaa">
                    <img width="20px" class="date-icon"                            
                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png"              
                        alt="Icon-calendar">
                </div>
                <div class="form-group-flex time-input-container">
                    <label for="activity-time">Heure début</label>
                    <input type="text" id="activity-time" placeholder="--:--">
                    <img width="20px" class="time-icon"                            
                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-clock.png"                
                        alt="Icon-clock">
                </div>
                <div class="form-group-flex time-input-container">
                    <label for="activity-time-end">Heure fin</label>
                    <input type="text" id="activity-time-end" placeholder="--:--">
                    <img width="20px" class="time-icon"                            
                        src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-clock.png"                
                        alt="Icon-clock">
                </div>
            </div>
            <!-- Description -->
            <div class="form-group-flex">
                <label for="activity-description">Description</label>
                <textarea id="activity-description" rows="4"></textarea>
            </div>
            <!-- File Upload -->
            <div class="form-group-flex">
                <label for="activity-file">Pièces jointe (facultatif)</label>
                <div class="input-file-wrapper">
                    <input type="text" class="input-file-text" id="file-name" readonly      
                        placeholder="Aucun fichier sélectionné">
                    <label for="activity-file" class="btn-importer">
                        <img width="20px"                                
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"      
                            alt="Icon-uploadwhite">
                        Importer
                    </label>
                    <input type="file" id="activity-file" style="display: none;">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal for Editing an Activity -->
<div class="modal-overlay" id="editActivityModal" style="display: none;">
    <div class="popup-container" id="popupContainerEditActivity">
        <div class="popup-header">
            <h2>Modifier une activité</h2>
            <div class="popup-header-buttons">
                <button class="btn-enregistrer" id="btnSaveEditActivity">Enregistrer</button>
            </div>
        </div>
        <form class="popup-form">
            <!-- Hidden input for event ID -->
            <input type="hidden" id="edit-activity-id">
            <!-- Type -->
            <div class="form-group-flex">
                <label for="edit-activity-type">Type</label>
                <select id="edit-activity-type">
                    <option selected>Sélection...</option>
                    <option value="Colloque">Colloques</option>
                    <option value="Conférence">Conférences</option>
                    <option value="Séminaire">Séminaires</option>
                    <option value="journee-etude">Journées d'étude</option>
                </select>
            </div>
            <!-- Titre -->
            <div class="form-group-flex">
                <label for="edit-activity-title">Titre</label>
                <input type="text" id="edit-activity-title">
            </div>
            <!-- Date and Time -->
            <div class="form-group-row">
                <div class="form-group-flex date-input-container">
                    <label for="edit-activity-date">Date</label>
                    <input type="text" id="edit-activity-date" placeholder="jj/mm/aaaa">
                    <i class="fa-solid fa-calendar-days date-icon"></i>
                </div>
                <div class="form-group-flex time-input-container">
                    <label for="edit-activity-time">Heure début</label>
                    <input type="text" id="edit-activity-time" placeholder="--:--">
                    <i class="fa-regular fa-clock time-icon"></i>
                </div>
                <div class="form-group-flex time-input-container">
                    <label for="edit-activity-time-end">Heure fin</label>
                    <input type="text" id="edit-activity-time-end" placeholder="--:--">
                    <i class="fa-regular fa-clock time-icon"></i>
                </div>
            </div>
            <!-- Description -->
            <div class="form-group-flex">
                <label for="edit-activity-description">Description</label>
                <textarea id="edit-activity-description" rows="4"></textarea>
            </div>
            <!-- File Upload -->
            <div class="form-group-flex">
                <label for="edit-activity-file">Pièces jointe (facultatif)</label>
                <div class="input-file-wrapper">
                    <input type="text" class="input-file-text" id="edit-file-name" readonly
                        placeholder="Aucun fichier sélectionné">
                    <label for="edit-activity-file" class="btn-importer">
                        <img width="20px"                                
                            src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-uploadwhite.png"      
                            alt="Icon-uploadwhite">
                        Importer
                    </label>
                    <input type="file" id="edit-activity-file" style="display: none;">
                </div>
            </div>
        </form>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', () => {
    // --- NEW --- Color mapping for each event type
    const typeColors = {
        'Colloque': '#f59e0b',
        'Conférence': '#3b82f6',
        'Séminaire': '#a3a3a3',
        'journee-etude': '#10b981',
    };

    let events = [{
            id: 1,
            date: new Date('2025-09-08T09:30:00'),
            end: new Date('2025-09-08T10:30:00'),
            title: "Colloque: l'avenir du web",
            type: 'Colloque',
            textColor: '#fff',
            description: 'Un colloque passionnant sur les nouvelles technologies du web.',
            file: 'presentation_web.pdf'
        },
        {
            id: 2,
            date: new Date('2025-09-09T12:00:00'),
            end: new Date('2025-09-09T13:00:00'),
            title: 'Séminaire sur la gestion de projet',
            type: 'Séminaire',
            textColor: '#fff',
            description: 'Formation intensive sur les méthodes agiles.',
            file: 'notes_agile.docx'
        },
        {
            id: 3,
            date: new Date('2025-09-10T14:30:00'),
            end: new Date('2025-09-10T15:30:00'),
            title: 'Colloque: FinTech en 2025',
            type: 'Colloque',
            textColor: '#fff',
            description: 'Débat sur les innovations financières à venir.',
            file: 'rapport_fintech.xlsx'
        },
        {
            id: 4,
            date: new Date('2025-09-11T15:00:00'),
            end: new Date('2025-09-11T16:00:00'),
            title: 'Séminaire: IA pour les débutants',
            type: 'Séminaire',
            textColor: '#fff',
            description: "Apprenez les bases de l'intelligence artificielle.",
            file: 'intro_ia.pptx'
        },
        {
            id: 5,
            date: new Date('2025-09-12T13:00:00'),
            end: new Date('2025-09-12T14:00:00'),
            title: 'Séminaire: Développement durable',
            type: 'Séminaire',
            textColor: '#fff',
            description: 'Comment intégrer le développement durable dans vos projets.',
            file: 'guide_dd.pdf'
        },
        {
            id: 6,
            date: new Date('2025-09-13T12:00:00'),
            end: new Date('2025-09-13T13:00:00'),
            title: 'Séminaire: Cybersécurité',
            type: 'Séminaire',
            textColor: '#fff',
            description: 'Protégez vos données et vos systèmes.',
            file: 'guide_securite.pdf'
        },
        {
            id: 7,
            date: new Date('2025-09-14T10:00:00'),
            end: new Date('2025-09-14T11:00:00'),
            title: "Conférence sur l'IA",
            type: 'Conférence',
            textColor: '#fff',
            description: "Exposé sur les dernières avancées en IA.",
            file: 'conf_ia.pptx'
        },
        {
            id: 8,
            date: new Date('2025-09-15T14:00:00'),
            end: new Date('2025-09-15T15:00:00'),
            title: "Journée d'étude sur la santé",
            type: 'journee-etude',
            textColor: '#fff',
            description: 'Thèmes variés sur la santé publique et la recherche.',
            file: 'notes_sante.docx'
        },
        {
            id: 9,
            date: new Date('2025-09-16T10:00:00'),
            end: new Date('2025-09-16T11:00:00'),
            title: 'Conférence sur la blockchain',
            type: 'Conférence',
            textColor: '#fff',
            description: 'Présentation des usages de la blockchain.',
            file: 'conf_blockchain.pdf'
        },
        {
            id: 10,
            date: new Date('2025-09-17T09:30:00'),
            end: new Date('2025-09-17T10:30:00'),
            title: "Colloque sur l'éthique numérique",
            type: 'Colloque',
            textColor: '#fff',
            description: "Discussion sur les enjeux éthiques de l'ère numérique.",
            file: 'rapport_ethique.pdf'
        },
        {
            id: 11,
            date: new Date('2025-09-18T15:00:00'),
            end: new Date('2025-09-18T16:00:00'),
            title: "Journée d'étude sur l'éducation",
            type: 'journee-etude',
            textColor: '#fff',
            description: "Les nouvelles méthodes d'enseignement.",
            file: 'pedagogie_moderne.pdf'
        },
        {
            id: 12,
            date: new Date('2025-09-19T16:00:00'),
            end: new Date('2025-09-19T17:00:00'),
            title: "Conférence: le futur de la robotique",
            type: 'Conférence',
            textColor: '#fff',
            description: "Vue d'ensemble des innovations en robotique.",
            file: 'conf_robotique.pptx'
        },
        {
            id: 13,
            date: new Date('2025-02-05T10:00:00'),
            end: new Date('2025-02-05T11:00:00'),
            title: 'Séminaire: Marketing digital',
            type: 'Séminaire',
            textColor: '#fff',
            description: 'Stratégies pour le marketing en ligne.',
            file: 'guide_marketing.docx'
        },
        {
            id: 14,
            date: new Date('2025-02-12T11:30:00'),
            end: new Date('2025-02-12T12:30:00'),
            title: 'Conférence: Big Data et analyse',
            type: 'Conférence',
            textColor: '#fff',
            description: 'Comment exploiter les données massives.',
            file: 'rapport_bigdata.pdf'
        },
        {
            id: 15,
            date: new Date('2025-02-20T14:00:00'),
            end: new Date('2025-02-20T15:00:00'),
            title: 'Colloque: Écologie et technologie',
            type: 'Colloque',
            textColor: '#fff',
            description: 'Synergie entre solutions technologiques et écologiques.',
            file: 'etude_eco_tech.pdf'
        },
        {
            id: 16,
            date: new Date('2025-06-10T09:00:00'),
            end: new Date('2025-06-10T10:00:00'),
            title: "Journée d'étude sur l'histoire de l'art",
            type: 'journee-etude',
            textColor: '#fff',
            description: "Parcours des mouvements artistiques majeurs.",
            file: 'notes_art.docx'
        },
        {
            id: 17,
            date: new Date('2025-06-15T15:00:00'),
            end: new Date('2025-06-15T16:00:00'),
            title: 'Séminaire: Introduction à Python',
            type: 'Séminaire',
            textColor: '#fff',
            description: 'Premier pas dans le langage Python.',
            file: 'cours_python.pdf'
        },
        {
            id: 18,
            date: new Date('2025-06-25T11:00:00'),
            end: new Date('2025-06-25T12:00:00'),
            title: 'Conférence: Réseaux sociaux et communication',
            type: 'Conférence',
            textColor: '#fff',
            description: 'Impact des réseaux sociaux sur la communication moderne.',
            file: 'reseaux_sociaux.pptx'
        },
        {
            id: 19,
            date: new Date('2025-09-10T12:30:00'),
            end: new Date('2025-09-10T14:30:00'),
            title: 'Séminaire sur la gestion de projet',
            type: 'Séminaire',
            textColor: '#fff',
            description: 'Formation intensive sur les méthodes agiles.',
            file: 'notes_agile.docx'
        }
    ];

    const gridContainer = document.querySelector('.calendar-grid');
    const searchInput = document.getElementById('searchInput');
    const filterTypeButton = document.getElementById('filterTypeButton');
    const filterTypeLinks = document.querySelectorAll('.filter-type');

    const prevWeekBtn = document.getElementById('prevWeekBtn');
    const nextWeekBtn = document.getElementById('nextWeekBtn');
    const currentMonthYearDisplay = document.getElementById('currentMonthYear');

    const dayHeaders = document.querySelectorAll('.day-header .date');

    const newActivityModal = document.getElementById('newActivityModal');
    const openActivityModalBtn = document.getElementById('openActivityModalBtn');
    const popupContainerNew = document.getElementById('popupContainerActivity');
    const editActivityModal = document.getElementById('editActivityModal');
    const popupContainerEdit = document.getElementById('popupContainerEditActivity');

    const fileInputNew = document.getElementById('activity-file');
    const fileNameDisplayNew = document.getElementById('file-name');
    const fileInputEdit = document.getElementById('edit-activity-file');
    const fileNameDisplayEdit = document.getElementById('edit-file-name');

    const filterMonthButton = document.getElementById('filterMonthButton');
    const filterMonthLinks = document.querySelectorAll('.filter-month');

    const newDateInput = document.getElementById('activity-date');
    const newTimeInput = document.getElementById('activity-time');
    const newTimeInputEnd = document.getElementById('activity-time-end');
    const editDateInput = document.getElementById('edit-activity-date');
    const editTimeInput = document.getElementById('edit-activity-time');
    const editTimeInputEnd = document.getElementById('edit-activity-time-end');

    // --- UPDATED --- Added `static: true` to fix positioning on scroll
    flatpickr(newDateInput, {
        dateFormat: "Y-m-d",
        locale: "fr",
        minDate: "today",
        appendTo: popupContainerNew,
        static: true
    });

    flatpickr(newTimeInput, {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        locale: "fr",
        appendTo: popupContainerNew,
        static: true,
        onOpen: function(selectedDates, dateStr, instance) {
            instance.calendarContainer.style.width = instance.input.offsetWidth + 'px';
        }
    });

    flatpickr(newTimeInputEnd, {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        locale: "fr",
        appendTo: popupContainerNew,
        static: true,
        onOpen: function(selectedDates, dateStr, instance) {
            instance.calendarContainer.style.width = instance.input.offsetWidth + 'px';
        }
    });

    flatpickr(editDateInput, {
        dateFormat: "Y-m-d",
        locale: "fr",
        minDate: "today",
        appendTo: popupContainerEdit,
        static: true
    });

    flatpickr(editTimeInput, {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        locale: "fr",
        appendTo: popupContainerEdit,
        static: true,
        onOpen: function(selectedDates, dateStr, instance) {
            instance.calendarContainer.style.width = instance.input.offsetWidth + 'px';
        }
    });

    flatpickr(editTimeInputEnd, {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        locale: "fr",
        appendTo: popupContainerEdit,
        static: true,
        onOpen: function(selectedDates, dateStr, instance) {
            instance.calendarContainer.style.width = instance.input.offsetWidth + 'px';
        }
    });


    const getStartOfWeek = (date) => {
        const d = new Date(date);
        const day = d.getDay();
        const diff = d.getDate() - day + (day === 0 ? -6 : 1);
        return new Date(d.setDate(diff));
    };

    const formatTime = (date) => {
        const hours = date.getHours();
        const minutes = date.getMinutes();
        return `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
    };

    // --- UPDATED --- Grid generation logic for 08:00 - 19:00
    const hours = ["08:00", "09:00", "10:00", "11:00", "12:00", "13:00", "14:00", "15:00", "16:00", "17:00",
        "18:00", "19:00"
    ];
    const totalSlots = (hours.length - 1) * 2;

    // Create Time Labels for each hour
    hours.forEach((hour, i) => {
        const timeSlot = document.createElement('div');
        timeSlot.classList.add('time-slot');
        timeSlot.textContent = hour;
        timeSlot.style.gridRow = `${(i * 2) + 2}`;
        gridContainer.appendChild(timeSlot);
    });

    // Create Grid Lines for each half-hour, but only draw horizontal lines for full hours
    for (let i = 0; i < totalSlots + 2; i++) {
        for (let j = 0; j < 7; j++) {
            const gridLine = document.createElement('div');
            gridLine.classList.add('grid-line-vertical'); // Always add vertical lines

            // The grid row index is i + 2.
            // The line is a border-bottom.
            // Row 2 (i=0) represents 08:00-08:30. Its bottom border is the 08:30 line. (Remove)
            // Row 3 (i=1) represents 08:30-09:00. Its bottom border is the 09:00 line. (Keep)
            // So, we add the horizontal class if the row index (i+2) is ODD.
            if ((i + 2) % 2 !== 0) {
                gridLine.classList.add('grid-line-horizontal');
            }
            gridLine.style.gridRow = `${i + 2}`;
            gridLine.style.gridColumn = `${j + 2}`;
            gridContainer.appendChild(gridLine);
        }
    }


    let currentWeekStart = getStartOfWeek(new Date());
    let selectedMonthFilter = null;

    const filterEvents = () => {
        const startOfWeek = getStartOfWeek(currentWeekStart);
        const endOfWeek = new Date(startOfWeek.getTime());
        endOfWeek.setDate(endOfWeek.getDate() + 7);

        const searchTerm = searchInput.value.toLowerCase();
        const selectedType = filterTypeButton.dataset.type;

        return events.filter(event => {
            const eventDate = event.date;
            const matchesSearch = event.title.toLowerCase().includes(searchTerm) ||
                formatTime(event.date).toLowerCase().includes(searchTerm);
            const matchesType = selectedType === 'all' || event.type === selectedType;
            const matchesWeek = eventDate >= startOfWeek && eventDate < endOfWeek;
            const matchesMonth = selectedMonthFilter === null || eventDate.getMonth() ===
                selectedMonthFilter;

            return matchesSearch && matchesType && matchesWeek && matchesMonth;
        });
    };

    const renderCalendar = () => {
        const startOfWeek = getStartOfWeek(currentWeekStart);

        currentMonthYearDisplay.textContent = startOfWeek.toLocaleString('fr-FR', {
            month: 'long',
            year: 'numeric'
        }).replace(/^\w/, c => c.toUpperCase());

        for (let i = 0; i < 7; i++) {
            const dayDate = new Date(startOfWeek);
            dayDate.setDate(startOfWeek.getDate() + i);
            dayHeaders[i].textContent =
                `${dayDate.getDate()} ${dayDate.toLocaleString('fr-FR', { month: 'short' })}`;
        }

        const filteredEvents = filterEvents();

        const existingEvents = gridContainer.querySelectorAll('.event-block');
        existingEvents.forEach(event => event.remove());

        filteredEvents.forEach(event => {
            const eventBlock = document.createElement('div');
            eventBlock.classList.add('event-block');
            eventBlock.dataset.id = event.id;
            eventBlock.style.backgroundColor = typeColors[event.type] || '#6b7280';
            eventBlock.style.color = event.textColor;

            const eventDate = event.date;
            const dayOfWeek = eventDate.getDay() === 0 ? 7 : eventDate.getDay();
            const startHour = eventDate.getHours() + eventDate.getMinutes() / 60;
            const endHour = event.end.getHours() + event.end.getMinutes() / 60;

            // UPDATED: Changed offset from 9 to 8 to match new start time
            const startRow = Math.floor((startHour - 8) * 2) + 2;
            const endRow = Math.ceil((endHour - 8) * 2) + 2;


            eventBlock.style.gridColumnStart = dayOfWeek + 1;
            eventBlock.style.gridRowStart = startRow;
            eventBlock.style.gridRowEnd = endRow;


            eventBlock.innerHTML = `
<div class="d-flex justify-content-between align-items-start w-100">
<div class="flex-grow-1">
<div class="event-details fw-bold">${event.title}</div>
<div class="event-time">${formatTime(event.date)} - ${formatTime(event.end)}</div>
</div>
<div class="dropdown event-dropdown">
<button class="btn btn-sm px-1 py-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
<i class="fa-solid fa-ellipsis-vertical"></i>
</button>
<ul class="dropdown-menu shadow">
<li><a class="dropdown-item edit-event-btn" href="#" data-id="${event.id}">
<i class="fa-solid fa-pen-to-square"></i> Modifier
</a></li>
<li><a class="dropdown-item view-event-btn" href="/calendrier-detais" data-id="${event.id}">
<i class="fa-solid fa-eye"></i> Voir détails
</a></li>
<li><hr class="dropdown-divider"></li>
<li><a class="dropdown-item text-danger delete-event-btn" href="#" data-id="${event.id}">
<i class="fa-solid fa-trash-can"></i> Supprimer
</a></li>
</ul>
</div>
</div>`;
            gridContainer.appendChild(eventBlock);
        });

        document.querySelectorAll('.edit-event-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const eventId = parseInt(e.currentTarget.dataset.id, 10);
                const eventToEdit = events.find(ev => ev.id === eventId);
                if (eventToEdit) {
                    openEditModal(eventToEdit);
                }
            });
        });

        document.querySelectorAll('.delete-event-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                const eventId = parseInt(e.currentTarget.dataset.id, 10);
                events = events.filter(ev => ev.id !== eventId);
                renderCalendar();
            });
        });
    };

    const openEditModal = (event) => {
        document.getElementById('edit-activity-id').value = event.id;
        document.getElementById('edit-activity-type').value = event.type;
        document.getElementById('edit-activity-title').value = event.title;
        editDateInput._flatpickr.setDate(event.date, true, "Y-m-d");
        editTimeInput._flatpickr.setDate(event.date, true, "H:i");
        editTimeInputEnd._flatpickr.setDate(event.end, true, "H:i");
        document.getElementById('edit-activity-description').value = event.description;
        document.getElementById('edit-file-name').value = event.file || '';
        editActivityModal.style.display = 'flex';
    };

    openActivityModalBtn.addEventListener('click', () => {
        newActivityModal.style.display = 'flex';
    });

    newActivityModal.addEventListener('click', (e) => {
        if (!popupContainerNew.contains(e.target) && e.target !== openActivityModalBtn) {
            newActivityModal.style.display = 'none';
        }
    });

    editActivityModal.addEventListener('click', (e) => {
        if (!popupContainerEdit.contains(e.target) && !e.target.closest('.dropdown-menu')) {
            editActivityModal.style.display = 'none';
        }
    });

    fileInputNew.addEventListener('change', () => {
        fileNameDisplayNew.value = fileInputNew.files.length > 0 ? fileInputNew.files[0].name : '';
    });

    fileInputEdit.addEventListener('change', () => {
        fileNameDisplayEdit.value = fileInputEdit.files.length > 0 ? fileInputEdit.files[0].name :
            '';
    });

    const btnSaveActivity = document.getElementById('btnSaveActivity');
    btnSaveActivity.addEventListener('click', (e) => {
        e.preventDefault();
        const type = document.getElementById('activity-type').value;
        const title = document.getElementById('activity-title').value;
        const date = newDateInput.value;
        const time = newTimeInput.value;
        const timeEnd = newTimeInputEnd.value;

        if (!type || !title || !date || !time || !timeEnd || type === "Sélection...") {
            alert("Veuillez remplir tous les champs obligatoires.");
            return;
        }

        const datetime = new Date(`${date}T${time}:00`);
        const datetimeEnd = new Date(`${date}T${timeEnd}:00`);
        const description = document.getElementById('activity-description').value;
        const file = fileInputNew.files.length > 0 ? fileInputNew.files[0].name : null;

        const newId = events.length > 0 ? Math.max(...events.map(ev => ev.id)) + 1 : 1;

        const newEvent = {
            id: newId,
            date: datetime,
            end: datetimeEnd,
            title: title,
            type: type,
            textColor: '#fff',
            description: description,
            file: file,
        };

        events.push(newEvent);
        renderCalendar();
        newActivityModal.style.display = 'none';
        document.querySelector('#newActivityModal form').reset();
        fileNameDisplayNew.value = "";
    });

    const btnSaveEditActivity = document.getElementById('btnSaveEditActivity');
    btnSaveEditActivity.addEventListener('click', (e) => {
        e.preventDefault();
        const id = document.getElementById('edit-activity-id').value;
        const type = document.getElementById('edit-activity-type').value;
        const title = document.getElementById('edit-activity-title').value;
        const date = editDateInput.value;
        const time = editTimeInput.value;
        const timeEnd = editTimeInputEnd.value;
        const datetime = new Date(`${date}T${time}:00`);
        const datetimeEnd = new Date(`${date}T${timeEnd}:00`);
        const description = document.getElementById('edit-activity-description').value;
        const file = fileInputEdit.files.length > 0 ? fileInputEdit.files[0].name : document
            .getElementById('edit-file-name').value;

        const eventIndex = events.findIndex(ev => ev.id === parseInt(id, 10));
        if (eventIndex !== -1) {
            events[eventIndex] = {
                ...events[eventIndex],
                type,
                title,
                date: datetime,
                end: datetimeEnd,
                description,
                file
            };
            renderCalendar();
        }

        editActivityModal.style.display = 'none';
    });

    searchInput.addEventListener('input', renderCalendar);
    filterTypeLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            filterTypeButton.dataset.type = e.target.dataset.type;
            filterTypeButton.innerHTML =
                `<span>${e.target.textContent}</span><i class="fa-solid fa-chevron-down"></i>`;
            renderCalendar();
        });
    });

    filterMonthLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            if (e.target.dataset.month === 'reset') {
                selectedMonthFilter = null;
                currentWeekStart = getStartOfWeek(new Date());
                filterMonthButton.innerHTML =
                    `<span>Tous les mois</span><img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt="Icon-calendar">`;

            } else {
                selectedMonthFilter = parseInt(e.target.dataset.month, 10);
                const currentYear = currentWeekStart.getFullYear();
                currentWeekStart = new Date(currentYear, selectedMonthFilter, 1);
                filterMonthButton.innerHTML =
                    `<span>${e.target.textContent}</span><img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt="Icon-calendar">`;

            }
            renderCalendar();
        });
    });

    prevWeekBtn.addEventListener('click', () => {
        currentWeekStart.setDate(currentWeekStart.getDate() - 7);
        selectedMonthFilter = null;
        filterMonthButton.innerHTML =
            `<span>Mois</span><img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt="Icon-calendar">`;
        renderCalendar();
    });

    nextWeekBtn.addEventListener('click', () => {
        currentWeekStart.setDate(currentWeekStart.getDate() + 7);
        selectedMonthFilter = null;
        filterMonthButton.innerHTML =
            `<span>Mois</span><img width="20px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png" alt="Icon-calendar">`;
        renderCalendar();
    });

    gridContainer.addEventListener('show.bs.dropdown', (event) => {
        const eventBlock = event.target.closest('.event-block');
        if (eventBlock) {
            eventBlock.style.zIndex = 10;
        }
    });

    gridContainer.addEventListener('hide.bs.dropdown', (event) => {
        const eventBlock = event.target.closest('.event-block');
        if (eventBlock) {
            eventBlock.style.zIndex = 'auto';
        }
    });

    renderCalendar();
});
</script>