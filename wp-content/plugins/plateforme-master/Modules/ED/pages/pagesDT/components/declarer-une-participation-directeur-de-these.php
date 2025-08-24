<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déclarer Une Participation</title>
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
    .form-group select {
        border: 1px solid #e0ddcd;
        border-radius: 8px;
        padding: 0.6rem 0.75rem;
        background-color: #fff;
        font-size: 14px;
        height: 42px;
        box-sizing: border-box;
        transition: border-color 0.2s;
        width: 100%;
    }

    .form-group input:focus,
    .form-group select:focus {
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
        border-radius: 8px 0 0 8px;
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
</head>

<body>

    <div class="content-block">
        <form>
            <h2 class="form-section-title">Informations générales</h2>
            <div class="form-grid">
                <div class="form-group grid-col-span-3">
                    <label for="event-title">Titre de l'événement</label>
                    <input type="text" id="event-title" value="Journée Doctorale De L'ED FST">
                </div>
                <div class="form-group grid-col-span-3">
                    <label for="event-type">Type</label>
                    <select id="event-type">
                        <option>Séminaire</option>
                        <option selected>Colloque</option>
                        <option>École D'été</option>
                    </select>
                </div>
                <div class="form-group grid-col-span-2">
                    <label for="event-location">Lieu</label>
                    <input type="text" id="event-location" value="FST _ Amphi 1">
                </div>
                <div class="form-group grid-col-span-2">
                    <label for="event-date">Date de l'événement</label>
                    <div class="input-with-icon">
                        <input type="text" id="event-date" value="01/12/2024">
                        <i class="fa-solid fa-calendar-days icon"></i>
                    </div>
                </div>
                <div class="form-group grid-col-span-2">
                    <label for="event-organizer">Organisateur(s)</label>
                    <select id="event-organizer">
                        <option selected>Pr. Mourad Alleni</option>
                        <option>Autre</option>
                    </select>
                </div>
                <div class="form-group grid-col-span-3">
                    <label for="student-role">Rôle du doctorant</label>
                    <select id="student-role">
                        <option selected>Modérateur / Intervenant</option>
                        <option>Participant</option>
                    </select>
                </div>
            </div>

            <h2 class="form-section-title">Pièces justificatives à déposer</h2>
            <div class="form-grid">
                <div class="form-group grid-col-span-3">
                    <label for="attestation-file">Attestation de participation</label>
                    <div class="file-input-wrapper">
                        <input type="text" class="file-input-text" placeholder="Importer" readonly>
                        <button type="button" class="file-input-button"
                            onclick="this.nextElementSibling.click()">Importer</button>
                        <input type="file" style="display: none;"
                            onchange="this.previousElementSibling.previousElementSibling.value = this.files[0] ? this.files[0].name : 'Importer'">
                    </div>
                </div>
                <div class="form-group grid-col-span-3">
                    <label for="program-file">Programme officiel (facultatif)</label>
                    <div class="file-input-wrapper">
                        <input type="text" class="file-input-text" value="lettre_accueil.pdf" readonly>
                        <button type="button" class="file-input-button"
                            onclick="this.nextElementSibling.click()">Importer</button>
                        <input type="file" style="display: none;"
                            onchange="this.previousElementSibling.previousElementSibling.value = this.files[0] ? this.files[0].name : 'Importer'">
                    </div>
                </div>
            </div>

            <!-- --- BUTTONS MOVED HERE AND WRAPPED --- -->
            <div class="form-actions">
                <button type="button" class="btn btn-outline">Enregistrer en brouillon</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>

        </form>
    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

</body>

</html>