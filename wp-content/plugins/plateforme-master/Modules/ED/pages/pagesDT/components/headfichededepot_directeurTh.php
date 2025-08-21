<style>
/* --- Base Styles --- */
.body {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

/* --- Custom Component Styles --- */
.status-container {
    background-color: #ffffff;
    border-radius: 12px;
    padding: 15px 25px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    width: 98%;

}

.status-label {
    font-size: 1rem;
    color: #333;
    font-weight: 500;
}

/* Customizing Bootstrap components */
.btn-custom-outline {
    color: #d9534f;
    border-color: #d9534f;
    font-weight: 500;
    padding: 0.375rem 1.25rem;
}

.btn-custom-outline:hover {
    color: #fff;
    background-color: #d9534f;
    border-color: #d9534f;
}

.form-select-custom {
    border-color: #d9534f;
    color: #555;
    font-weight: 500;
}


.form-select-custom:focus {
    border-color: #d9534f;
    box-shadow: 0 0 0 0.25rem rgba(217, 83, 79, 0.25);
}
</style>

<div class="body">


    <div class="status-container d-flex justify-content-between align-items-center">
        <!-- Left Side: Label -->
        <div class="status-label">
            Statut dépôt
        </div>

        <!-- Right Side: Controls -->
        <div class="controls d-flex align-items-center gap-2">
            <button type="button" class="btn btn-custom-outline">Télécharger</button>
            <select class="form-select form-select-custom">
                <option selected>Valider Le Dépôt</option>
                <option value="">Refuser</option>
            </select>
        </div>
    </div>
</div>