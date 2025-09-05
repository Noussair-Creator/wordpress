<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
/* Base styles for body to see the component */


/* Styles from the first code block (memorized) */
.footer-wave-top {
    position: relative;
    width: 100%;
    height: 100px;
    overflow: hidden;
    margin-bottom: -5px;
    z-index: 1;
}

.footer-wave-top svg {
    display: block;
    width: 100%;
    height: 100%;
    transform: rotate(180deg);
}

.footer-coordonnees {
    background-image: url("/wp-content/plugins/plateforme-master/images/uscr/Tracé 1293.png");
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    padding: 60px 120px 20px;
    font-family: 'Arial', sans-serif;
    color: #2a2916;
    position: relative;
    z-index: 0;
}

.footer-wrapper {
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
    gap: 60px;
}

.footer-left img {
    width: 110px;
    height: 110px;
}

.footer-middle h4 {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
    position: relative;
}

.footer-middle h4::after {
    content: "";
    width: 50px;
    height: 4px;
    background: #b60303;
    position: absolute;
    left: 0;
    bottom: -6px;
    border-radius: 2px;
}

.footer-middle p {
    margin-top: 25px;
    font-size: 18px;
    line-height: 1.6;
    letter-spacing: 0px;
    color: #2A2916;
}

.footer-right {
    margin-left: auto;

}

.footer-right h4 {
    position: relative;
    margin-bottom: 20px;
    font-weight: 700;
}

.footer-right h4::after {
    content: '';
    position: absolute;
    top: 30px;
    left: 0;
    width: 65px;
    height: 5px;
    background-color: #b60303;
    border-radius: 0px 0px 10px 10px;
}

.footer-right p {
    font-size: 16px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    /* gap: 10px; */
    font-weight: 700;
}

.footer-right a {
    color: #2A2916;
    text-decoration: none;
}

.footer-right a:hover {
    text-decoration: underline;
}

.footer-right p i {
    color: #b60303;
    font-size: 18px;
    margin-top: 2px;
    min-width: 20px;
}

.footer-icons {
    display: flex;
    gap: 15px;
    margin-top: 15px;
}

.footer-icons a {
    width: 44px;
    height: 44px;
    background: #c5c2a4;
    color: white;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    transition: background 0.3s, transform 0.3s;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.footer-icons a:hover {
    background: #b60303;
    transform: scale(1.1);
}

.footer-bottom-bar {
    margin-top: 40px;
}

.footer-bottom-bar hr {
    border: none;
    border-top: 2px solid #C6C3AC;
    margin-bottom: 15px;
}

.bottom-bar-content {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
    color: #666;
    flex-wrap: wrap;
    gap: 10px;
}

.bottom-bar-content strong {
    color: #999;
    font-weight: 500;
}

/* Responsive styles from original code */
@media (max-width: 768px) {
    .footer-wrapper {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .footer-right {
        margin-left: 0;
    }

    .footer-right p {
        justify-content: center;
    }

    .bottom-bar-content {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
}
</style>


<!-- Footer with original structure/style and new content -->
<footer class="footer-coordonnees">
    <div class="footer-wrapper">
        <div class="footer-left">
            <!-- Image path from the original code -->
            <img src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/logo-removebg-preview.png"
                alt="Logo Plateforme">
        </div>

        <!-- This middle section is kept for structure but its content is replaced by the right section's details -->
        <div class="footer-middle">
            <!-- The title is now in the right section as per the new content's layout -->
        </div>

        <div class="footer-right">
            <!-- New content starts here -->
            <h4>Coordonnées :</h4>
            <p>
                <!-- <i class="fa-solid fa-location-dot"></i>  -->
                <img width="20px" class="me-2"
                    src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-pin.png"
                    alt="Icon-pin">
                Campus Universitaire – B.P. 248 – El Manar II – 2092 Tunis
            </p>
            <p>
                <!-- <i class="fa-solid fa-phone"></i>  -->
                <img width="20px" class="me-2"
                    src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-phone.png"
                    alt="Icon-phone">
                Tél. : 71 871 828 – Fax : 71 872 139
            </p>
            <p>

                <!-- <i class="fa-solid fa-envelope"></i> -->

                <img width="20px" class="me-2"
                    src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/27) Icon-email.png"
                    alt="Icon-email">
                <a href="mailto:informatique@utm.rnu.tn">informatique@utm.rnu.tn</a>
            </p>
            <!-- The social icons from the original footer are removed as they are not in the new content -->
        </div>
    </div>

    <div class="footer-bottom-bar">
        <hr>
        <div class="bottom-bar-content">
            <!-- New copyright text -->
            <span>Copyright ©2025 UTM</span>
            <span>Tous droits réservés. Conception et réalisation CLICKERP</span>

            <!-- The "Tous droits réservés" part is removed as it was not in the new content -->
        </div>
    </div>
</footer>