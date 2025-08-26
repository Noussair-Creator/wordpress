<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
body {
    background-color: #f0f2f5;
    font-family: 'Segoe UI', sans-serif;
}

.content-block {
    background: #fff;
    border-radius: 10px;
    font-family: 'Segoe UI', sans-serif;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    max-width: 1200px;
    margin: auto;
}

.accordion-container {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.05);
    border-top: 0px;
}

.accordion-tabs {
    display: flex;
    background: #f3f3f3;
    border-radius: 10px 10px 0 0;
    overflow: hidden;
}

.tab-btn {
    flex: 1;
    padding: 12px 20px;
    font-weight: 600;
    border: none;
    background: #A6A485;
    cursor: pointer;
    font-size: 18px;
    transition: 0.3s;
    letter-spacing: 0px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

}

.tab-btn:first-child {
    margin-right: 20px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.tab-btn:last-child {
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.tab-btn.active {
    background-color: #fff;
    color: #2A2916;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    box-shadow: inset 0 -3px 0 0 #fff;
}

.accordion-content {
    padding: 25px;
    padding-top: 35px;
    background: #fff;
}

.tab-panel {
    display: none;
}

.tab-panel.active {
    display: block;
}

.soutenance-header {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 20px;
}

.badge {
    display: inline-block;
    padding: 6px 15px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 20px;
    text-transform: capitalize;
    border: 2px solid transparent;
}

.badge-warning {
    color: #856404;
    /* background-color: #fff3cd; */
    border-color: #A6A485;
}

.badge-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.soutenance-details {
    background-color: #faf9f7;
    border: 1px solid #ebe9d7;
    border-radius: 10px;
    padding: 10px;
    margin-bottom: 30px;
}

.detail-row {
    display: flex;
    align-items: center;
    padding: 15px 0;
    border-bottom: 1px solid #ebe9d7;
    font-size: 16px;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    width: 180px;
    color: #6c757d;
    font-weight: 500;
}

.detail-value {
    color: #343a40;
    font-weight: 600;
    display: flex;
    gap: 20px;
}

.tab-icon {
    width: 24px;
    height: 24px;
}

.section-title {
    font-size: 20px;
    font-weight: 600;
    color: #333;
    margin-top: 30px;
    margin-bottom: 15px;
}

.file-upload-wrapper {
    display: flex;
    align-items: center;
    /* border: 1px solid #ddd; */
    border-radius: 8px;
    /* padding: 5px 5px 5px 15px; */
    margin-bottom: 5px;
}

.file-name {
    flex-grow: 1;
    color: #555;
    border: 2px solid #EBEADE;
    padding: 8px 15px;
    border-radius: 8px 0 0 8px;
}

.import-btn {
    background-color: #A6A485;
    border-radius: 0px 8px 8px 0px;
    padding: 8px 15px;
    cursor: pointer;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 5px;
    border: 1px solid #EBEADE;
    color: #fff;
}

.file-upload-caption {
    font-size: 13px;
    color: #888;
    margin-left: 5px;
    margin-bottom: 20px;
}

.note-textarea {
    width: 100%;
    height: 80px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
    resize: vertical;
    margin-bottom: 20px;
    box-sizing: border-box;
}

.confirmation-checkbox {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    color: #c60000;
    font-weight: 500;
}

.confirmation-checkbox input {
    width: 18px;
    height: 18px;
}

.confirmation-message {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 15px;
    font-size: 15px;
    color: #333;
}
</style>


<div class="content-block">
    <div class="accordion-container">
        <!-- Tabs based on the screenshot -->
        <div class="accordion-tabs">
            <button class="tab-btn active" data-tab="tab1">
                <img src="/wp-content/plugins/plateforme-master/images/icons/5326531.png" alt="5326531"
                    class="tab-icon">
                Date de soutenance
            </button>
            <button class="tab-btn" data-tab="tab2">
                <img src="/wp-content/plugins/plateforme-master/images/icons/report-document-file.png"
                    alt="report-document-file" class="tab-icon">
                Dépôt de rapport
            </button>
        </div>

        <div class="accordion-content">
            <!-- Tab 1: Date de soutenance Content -->
            <div class="tab-panel active" id="tab1">
                <div class="soutenance-header">
                    <span class="badge badge-warning"> <i class="fa-solid fa-circle"
                            style="color: #6E6D55; margin-right: 5px; font-size: 12px;"></i>
                        Ajournée</span>
                </div>
                <div class="soutenance-details">
                    <div class="detail-row">
                        <span class="detail-label">Rapporteur :</span>
                        <span class="detail-value">Mourd Aloui</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Jurys :</span>
                        <div class="detail-value">
                            <span>Manel Bouzidi</span>
                            <span>Ahmed Smaili</span>
                        </div>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Date :</span>
                        <span class="detail-value">13-09-2025</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Heure :</span>
                        <span class="detail-value">10h30</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Salle :</span>
                        <span class="detail-value">B14 bloc B</span>
                    </div>
                </div>
            </div>

            <!-- Tab 2: Dépôt de rapport Content -->
            <div class="tab-panel" id="tab2">
                <div class="soutenance-header">
                    <span class="badge badge-success"> <i class="fa-solid fa-circle"
                            style="font-size: 12px; margin-right: 5px; color: #217C1E;"></i> En
                        attente de soutenance</span>
                </div>

                <h3 class="section-title">Date de dépôt</h3>
                <div class="soutenance-details">
                    <div class="detail-row">
                        <span class="detail-label">Date limite de dépôt :</span>
                        <span class="detail-value">01-09-2025</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Encadrant :</span>
                        <span class="detail-value">Manel Bouzidi</span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Statut de soutenance :</span>
                        <span class="detail-value">Ajournée (session 2)</span>
                    </div>
                </div>

                <h3 class="section-title">Déposer mon mémoire</h3>
                <div class="file-upload-wrapper">
                    <span class="file-name">Memoirefinale.pdf</span>
                    <button class="import-btn">
                        <i class="fas fa-upload"></i> Importer
                    </button>
                </div>
                <p class="file-upload-caption">PDF uniquement, max 20 Mo</p>

                <textarea class="note-textarea" placeholder="Note..."></textarea>

                <div class="confirmation-checkbox">
                    <input type="checkbox" id="confirm-final" checked>
                    <label for="confirm-final">Je confirme que le mémoire déposé est la version finale et
                        définitive.</label>
                </div>

                <div class="confirmation-message">
                    votre mémoire a été déposer le <strong>01-09-2025</strong> à <strong>15h37</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Tab switching logic
document.querySelectorAll('.tab-btn').forEach(button => {
    button.addEventListener('click', () => {
        const tabId = button.getAttribute('data-tab');

        // Deactivate all tabs and panels
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-panel').forEach(panel => panel.classList.remove('active'));

        // Activate the clicked tab and corresponding panel
        button.classList.add('active');
        document.getElementById(tabId).classList.add('active');
    });
});
</script>