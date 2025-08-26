<!-- Font Awesome for icons -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body {
    background-color: #f8f9fa;
    font-family: 'Segoe UI', sans-serif;
}

.content-block {
    background: #fff;
    border-radius: 10px;
    padding: 0px 24px;
    font-family: 'Segoe UI', sans-serif;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    /* Added max-width and margin for better centering on larger screens */
}

.form-section-title {
    margin: 0px -23px 35px;
    padding: 20px 25px 10px;
    box-shadow: 0px 5px 5px #00000029;
    font-size: 24px;
    font-weight: 700;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 20px 24px;
    margin-bottom: 30px;
}

.grid-col-span-3 {
    grid-column: span 3;
}

.grid-col-span-6 {
    grid-column: span 6;
}

.grid-col-span-2 {
    grid-column: span 2;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-size: 14px;
    font-weight: 500;
    color: #717058;
    margin-bottom: 6px;
}

.form-group input[type="text"],
.form-group input[type="number"],
.form-group select,
.form-group textarea {
    border: 1px solid #e0ddcd;
    border-radius: 8px;
    padding: 0.6rem 0.75rem;
    background-color: #fff;
    font-size: 14px;
    height: 42px;
    box-sizing: border-box;
    transition: border-color 0.2s;
    width: 100%;
    font-family: 'Segoe UI', sans-serif;
}

.form-group input[type="text"] {
    border-radius: 8px 0px 0px 8px !important;
}

.form-group textarea {
    height: auto;
    min-height: 80px;
    resize: vertical;
}

.form-group input:focus,
.form-group input[type="number"]:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #c60000;
}

.input-with-icon {
    position: relative;
}

.input-with-icon .icon {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #6b7280;
    pointer-events: none;
    font-size: 14px;
    right: 0.85rem;
}


.form-group select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    padding-right: 2.5rem;
    cursor: pointer;
    background-image: url("data:image/svg+xml;utf8,<svg fill='%236b7280' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
    background-repeat: no-repeat;
    background-position: right 0.5rem center;
}

.file-input-wrapper {
    display: flex;
    border-radius: 6px;
    overflow: hidden;
    background-color: #fdfdfd;
}

.file-input-text {
    flex-grow: 1;
    padding: 0.6rem 0.75rem;
    font-size: 14px;
    color: #888;
    border: 1px solid #e0ddcd;
    border-right: none;
    /* border-radius: 8px 0 0 8px; */
    background: transparent;
    height: 42px;
    box-sizing: border-box;
}

.file-input-button {
    background-color: #d1cfb0ff;
    color: #fff;
    border: 1px solid #e0ddcd;
    border-left: none;
    border-radius: 0 8px 8px 0;
    padding: 0 20px;
    cursor: pointer;
    font-weight: 500;
    font-size: 16px;
    white-space: nowrap;
}

.file-input-button:hover {
    background-color: #c8c6a8;
}

/* --- MODIFIED STYLES FOR BUTTONS --- */
.form-actions {
    display: flex;
    justify-content: flex-end;
    /* Center align buttons */
    gap: 12px;
    margin-top: 20px;
    /* Adjusted margin */
    padding-bottom: 20px;
    /* Added padding for spacing */
    margin-left: -23px;
    margin-right: -23px;
    /* padding-bottom: 10px; */
    margin-bottom: 20px;
    padding-left: 25px;
    padding-right: 25px;
    box-shadow: 0px -5px 16px #00000029;
    padding-top: 20px;
}

.btn {
    padding: 10px 24px;
    border-radius: 6px;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    border: 1px solid transparent;
    transition: background-color 0.2s, color 0.2s;
}

.btn-primary {
    background-color: #c60000;
    color: white;
    border-color: #c60000;
}

.btn-primary:hover {
    background-color: #a50000;
}

.btn-outline {
    background-color: #fff;
    color: #c60000;
    border-color: #c60000;
}

.btn-outline:hover {
    background-color: #fdf0f0;
}
</style>

<div class="content-block">
    <form>
        <h2 class="form-section-title">Informations générales</h2>
        <div class="form-grid">
            <div class="form-group grid-col-span-3">
                <label for="training-title">Titre de la formation</label>
                <input type="text" id="training-title" placeholder="Titre">
            </div>
            <div class="form-group grid-col-span-3">
                <label for="training-type">Type de formation</label>
                <select id="training-type">
                    <option selected>En Ligne</option>
                    <option>Présentiel</option>
                </select>
            </div>
            <div class="form-group grid-col-span-3">
                <label for="start-date">Date de début</label>
                <div class="input-with-icon">
                    <input type="text" id="start-date" value="12-07-2025">
                    <img width="15px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png"
                        alt="Icon-calendar.png" class="icon">
                    <!-- <i class="fa-solid fa-calendar-days "></i> -->
                </div>
            </div>
            <div class="form-group grid-col-span-3">
                <label for="end-date">Date fin</label>
                <div class="input-with-icon">
                    <input type="text" id="end-date" value="12-07-2025">
                    <img width="15px" src="/wp-content/plugins/plateforme-master/images/icons/27) Icon-calendar.png"
                        alt="Icon-calendar.png" class="icon">
                    <!-- <i class="fa-solid fa-calendar-days icon"></i> -->
                </div>
            </div>
            <div class="form-group grid-col-span-3">
                <label for="duration">Durée / Volume horaire</label>
                <input type="number" id="duration" value="10">
            </div>
            <div class="form-group grid-col-span-3">
                <label for="credits">Crédits demandés</label>
                <input type="number" id="credits" value="4">
            </div>
            <div class="form-group grid-col-span-3">
                <label for="justificatives">Pièces justificatives</label>
                <div class="file-input-wrapper">
                    <input type="text" class="file-input-text" placeholder="" readonly>
                    <button type="button" class="file-input-button"
                        onclick="this.nextElementSibling.click()">IMPORTER</button>
                    <input type="file" style="display: none;"
                        onchange="this.previousElementSibling.previousElementSibling.value = this.files[0] ? this.files[0].name : ''">
                </div>
            </div>
        </div>

        <h2 class="form-section-title">Commentaires du doctorant</h2>
        <div class="form-grid">
            <div class="form-group grid-col-span-6">
                <label for="comment">Commentaire</label>
                <div style="display: flex; align-items: center; gap: 12px;">
                    <textarea id="comment" placeholder="Ajouter Un Commentaire ..." style="flex-grow: 1;"></textarea>
                    <button type="button" class="btn btn-outline">Ajouter</button>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>


    </form>
</div>

<!-- JS Libraries -->

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>