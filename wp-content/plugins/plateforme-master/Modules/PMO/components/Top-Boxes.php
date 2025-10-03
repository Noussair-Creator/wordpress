<?php
// URL to the submissions page
$gestion_requetes_url = trailingslashit(get_site_url()) . 'gestion-requetes';
?>
<style>
:root {
    --dark-green: #6E6D55;
    --light-green: #A6A485;
    --dark-text: #333;
}

/* ====== Main container for the cards ====== */
.top-boxes {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
    align-items: stretch;
    /* Makes all cards the same height */
}

/* ====== General card styling ====== */
.box {
    flex: 1 1 calc(33.333% - 20px);
    /* Responsive layout for 3 cards */
    min-width: 280px;
    min-height: 180px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
    transition: transform .2s ease-in-out, box-shadow .2s ease-in-out;
    display: flex;
    overflow: hidden;
    /* Ensures content stays within rounded corners */
}

.box:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, .12);
}

/* Make the second card clickable */
.box.js-nav {
    cursor: pointer;
}

/* ====== Left icon panel for the first two cards ====== */
.box-icon {
    width: 92px;
    flex-shrink: 0;
    align-self: stretch;
    border-radius: 12px 0 0 12px;
    background: linear-gradient(180deg, var(--light-green) 0%, var(--dark-green) 100%);
    display: flex;
    justify-content: center;
    align-items: center;
}

.img-box {
    width: 52px;
    height: 52px;
    object-fit: contain;
}

/* ====== Text content area ====== */
.box-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 24px;
    font-family: sans-serif;
}

.box-content h4 {
    margin: 0 0 15px;
    font-size: 20px;
    font-weight: 700;
    color: var(--dark-text);
}

.list-box {
    margin: 0;
    padding: 0;
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.list-box li {
    display: flex;
    align-items: center;
    gap: 11px;
    line-height: 1.4;
    font-size: 16px;
    color: #555;
}

.list-box li::before {
    content: "";
    width: 7px;
    height: 7px;
    flex-shrink: 0;
    border-radius: 50%;
    background: var(--dark-green);
}

/* ====== Styling for the third card (Info Card) ====== */
.info-flex {
    width: 100%;
    display: flex;
    gap: 15px;
}

.info-line {
    display: flex;
    flex-direction: column;
    gap: 12px;
    color: #6E6D55;
    font-weight: 600;
    flex-shrink: 0;
}

.info-value {
    display: flex;
    flex-direction: column;
    gap: 12px;
    color: #2A2916;
    font-weight: 500;
    font-size: 14px;
}

.info-value a {
    color: #2A2916;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
}



/* Specific styling for the contact list items */
.contact-item {
    position: relative;
    padding-left: 15px;
    padding-top: 3px;
}

.contact-item::before {
    content: "▸";
    position: absolute;
    left: 0;
    top: 0;
    color: #b60303;
    font-size: 18px;
}
</style>

<div class="top-boxes">
    <!-- Card 1: Calendrier -->
    <div class="box">
        <div class="box-icon">
            <!-- The icon path is preserved as requested -->
            <a href="/calendrier-pmo"> <img src="/wp-content/plugins/plateforme-master/images/pmo/27) Icon-calendar.png"
                    alt="Calendar Icon" class="img-box"></a>
        </div>
        <div class="box-content">
            <a href="/calendrier-pmo">
                <h4>Calendrier</h4>
            </a>
            <ul class="list-box">
                <li>Réunions</li>
                <li>Formations</li>
            </ul>
        </div>
    </div>

    <!-- Card 2: Soumissions (Clickable) -->
    <div class="box js-nav" role="link" tabindex="0" data-href="<?php echo esc_url($gestion_requetes_url); ?>">
        <div class="box-icon">
            <!-- The icon path is preserved as requested -->
            <img src="/wp-content/plugins/plateforme-master/images/pmo/27) Icon-paper-plane.png" alt="Submissions Icon"
                class="img-box">
        </div>
        <div class="box-content">
            <h4>Soumissions</h4>
            <ul class="list-box">
                <li>En attente</li>
                <li>En cours</li>
                <li>terminées</li>
            </ul>
        </div>
    </div>

    <!-- Card 3: Information -->
    <div class="box">
        <div class="box-content">
            <div class="info-flex">
                <div class="info-line">
                    <div>Responsable :</div>
                    <div>Date de création :</div>
                    <div>Contact :</div>
                </div>
                <div class="info-value">
                    <div>Mohamed Smail</div>
                    <div>15/03/2012</div>
                    <div>
                        <div class="contact-item"><a href="mailto:Test@gmail.com">Test@gmail.com</a></div>
                        <div class="contact-item">71 895 236</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// This script makes the entire "Soumissions" card clickable
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.js-nav').forEach(box => {
        const go = () => {
            const href = box.dataset.href;
            if (href) {
                window.location.href = href;
            }
        };
        box.addEventListener('click', go);
        box.addEventListener('keydown', e => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                go();
            }
        });
    });
});
</script>