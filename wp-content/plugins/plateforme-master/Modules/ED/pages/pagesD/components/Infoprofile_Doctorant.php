<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information Form</title>

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
        padding: 24px;
        font-family: 'Segoe UI', sans-serif;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);

        width: 100%;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .form-header h2 {
        font-size: 24px;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .profile-section {
        display: flex;
        align-items: flex-start;
        gap: 24px;
        margin-bottom: 30px;
    }

    .profile-picture-wrapper {
        position: relative;
        flex-shrink: 0;
        cursor: pointer;
    }

    .profile-picture {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #eee;
    }

    .camera-icon {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background-color: #333;
        color: white;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid white;
    }

    .address-title {
        font-size: 18px;
        font-weight: 600;
        margin-top: 30px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }

    .phone-input-wrapper {
        display: flex;
        align-items: center;
        border: 1px solid #e0ddcd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    .country-selector {
        display: flex;
        align-items: center;
        padding: 0 10px;
        background-color: transparent;
        cursor: pointer;
    }

    .country-selector img {
        width: 24px;
        margin-right: 8px;
    }

    .country-selector i {
        color: #6b7280;
    }

    .phone-input-wrapper input {
        border: none !important;
        background-color: transparent !important;
        flex-grow: 1;
        padding: 0.6rem 0.75rem;
    }

    .phone-input-wrapper input:focus {
        outline: none;
        box-shadow: none;
    }


    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px 24px;
    }

    .grid-col-span-1 {
        grid-column: span 1;
    }

    .grid-col-span-2 {
        grid-column: span 2;
    }

    @media (max-width: 768px) {
        .profile-section {
            flex-direction: column;
            align-items: center;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .grid-col-span-1,
        .grid-col-span-2 {
            grid-column: span 1;
        }
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

    /* --- MODIFIED STYLES TO MATCH SCREENSHOT --- */
    .form-group input,
    .form-group select {
        border: 1px solid #eee;
        /* Lighter border */
        border-radius: 8px;
        padding: 0.6rem 0.75rem;
        background-color: #f9f9f9;
        /* Light beige background */
        font-size: 14px;
        height: 42px;
        box-sizing: border-box;
        transition: border-color 0.2s;
        width: 100%;
        font-family: 'Segoe UI', sans-serif;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #c60000;
    }

    .form-group select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        padding-right: 2.5rem;
        cursor: pointer;
        background-image: url("data:image/svg+xml;utf8,<svg fill='%236b7280' height='24' viewBox='0 0 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
        background-repeat: no-repeat;
        background-position: right 0.5rem center;
    }

    .file-input-wrapper {
        display: flex;
        border: 1px solid #e0ddcd;
        border-radius: 8px;
        overflow: hidden;
        background-color: #f9f9f9;
    }

    .file-input-text {
        flex-grow: 1;
        padding: 0.6rem 0.75rem;
        color: #333;
        font-size: 14px;
        line-height: 1.5;
        background-color: transparent;
    }

    .file-input-button {
        background-color: #c5c3a9;
        /* Khaki color */
        color: #333;
        /* Darker text */
        border: none;
        border-left: 1px solid #e0ddcd;
        padding: 0 20px;
        cursor: pointer;
        font-weight: 500;
        font-size: 16px;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .file-input-button:hover {
        background-color: #b9b79e;
        /* Darker khaki on hover */
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #eee;
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
        color: #555;
        border-color: #ccc;
    }

    .btn-outline:hover {
        background-color: #f8f8f8;
    }
    </style>
</head>

<body>

    <div class="content-block">
        <form onsubmit="event.preventDefault();">
            <div class="form-header">
                <h2><i class="fa-solid fa-id-card"></i> Informations personnelles</h2>
                <button type="button" class="btn btn-primary"><i class="fa-solid fa-lock"></i> Modifier votre mot de
                    passe</button>
            </div>

            <div class="profile-section">
                <div class="profile-picture-wrapper">
                    <img src="https://i.imgur.com/hmdQj2P.png" alt="Profile Picture" class="profile-picture">
                    <div class="camera-icon">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <!-- Hidden file input for profile picture -->
                    <input type="file" id="profile-picture-input" style="display: none;" accept="image/*">
                </div>
                <div class="form-grid" style="flex-grow: 1; margin-bottom: 0;">
                    <div class="form-group grid-col-span-1">
                        <input type="text" id="first-name" value="Ahlem Ben Amor">
                    </div>
                    <div class="form-group grid-col-span-1">
                        <input type="text" id="last-name" value="Ahlem Ben Amor">
                    </div>
                    <div class="form-group grid-col-span-1">
                        <select id="nationality">
                            <option selected>Tunisienne</option>
                            <option>Autre</option>
                        </select>
                    </div>
                    <div class="form-group grid-col-span-1">
                        <input type="text" id="phone1" value="06974593">
                    </div>
                    <div class="form-group grid-col-span-1">
                        <input type="email" id="email1" value="ahlem@gmail.com">
                    </div>
                    <div class="form-group grid-col-span-1">
                        <input type="email" id="email2" placeholder="Email 2">
                    </div>
                    <div class="form-group grid-col-span-2">
                        <div class="phone-input-wrapper">
                            <div class="country-selector">
                                <img src="https://flagcdn.com/w40/tn.png" alt="Tunisia Flag">
                                <i class="fa-solid fa-caret-down"></i>
                            </div>
                            <input type="text" id="phone2" value="+216 23 44 55 76">
                        </div>
                    </div>
                    <div class="form-group grid-col-span-2">
                        <div class="file-input-wrapper">
                            <div class="file-input-text">Resume.pdf</div>
                            <button type="button" class="file-input-button"
                                onclick="document.getElementById('resume-input' ).click()">
                                <i class="fa-solid fa-upload"></i>
                                Importer
                            </button>
                            <input type="file" id="resume-input" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="address-title">Adresse étudiant</h3>
            <div class="form-grid">
                <div class="form-group grid-col-span-2">
                    <input type="text" id="student-address" placeholder="Adresse étudiant">
                </div>
                <div class="form-group grid-col-span-1">
                    <select id="student-gov">
                        <option selected disabled>Gouvernorat</option>
                        <option>Tunis</option>
                        <option>Ariana</option>
                    </select>
                </div>
                <div class="form-group grid-col-span-1">
                    <input type="text" id="student-postal" placeholder="Code postal">
                </div>
            </div>

            <h3 class="address-title">Adresse parents</h3>
            <div class="form-grid">
                <div class="form-group grid-col-span-2">
                    <input type="text" id="parent-address" placeholder="Adresse parents">
                </div>
                <div class="form-group grid-col-span-1">
                    <select id="parent-gov">
                        <option selected disabled>Gouvernorat</option>
                        <option>Tunis</option>
                        <option>Ariana</option>
                    </select>
                </div>
                <div class="form-group grid-col-span-1">
                    <input type="text" id="parent-postal" placeholder="Code postal">
                </div>
                <div class="form-group grid-col-span-2">
                    <div class="phone-input-wrapper">
                        <div class="country-selector">
                            <img src="https://flagcdn.com/w40/tn.png" alt="Tunisia Flag">
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                        <input type="text" id="parent-phone" value="+216 23 44 55 76">
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-outline">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>

    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <!-- Custom Script for Photo Upload -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const profilePictureWrapper = document.querySelector('.profile-picture-wrapper');
        const profilePictureInput = document.getElementById('profile-picture-input');
        const profilePictureImg = profilePictureWrapper.querySelector('.profile-picture');

        // When the wrapper (image or camera icon) is clicked, trigger the hidden file input
        profilePictureWrapper.addEventListener('click', function() {
            profilePictureInput.click();
        });

        // When a file is selected in the input
        profilePictureInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Use FileReader to read the file and set it as the image source
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePictureImg.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    });
    </script>

</body>

</html>