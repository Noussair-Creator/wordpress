<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dépôt de candidature</title>
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/form.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="./style.css">


    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Signika:wght@300..700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="app-container">
        <!-- Header -->
        <header class="header">
            <div class="header-content">
                <div class="logo-container">
                    <img src="../assets/tn.png" style="width: 61px;height: 40px;">
                    <img src="../assets/flag_tn.png" style="width: 55px;height: 36px;">
                    <div class="logo-content">
                        <div class="Quicksand-regular thinText">République Tunisienne <br> Ministère de l’Enseignement
                            Supérieur <br> et de la Recherche Scientifique</div>
                    </div>
                </div>

            </div>
        </header>
        <div class="sub-header-container">
            <div class="sub-header-content">

                <img src="../assets/logoback.jpeg" style="width: 284px;height: 129px;flex: none;">
            </div>

        </div>
        <div class="bloc-under-header">
            <div class="Quicksand-bold " style="font-size: 20px; color: #2A2916; font-family: 'Poppins';">INFORMATIONS
                GÉNÉRALES</div>

            <div style="display: flex;align-items: center;gap: 20px;">
                <button class="Quicksand-medium smallText btn"
                    style="font-family: 'Poppins';text-align: center;border: 2px solid #A6A485;color: #A6A485;background: unset;"
                    type="submit">SAUVEGARDER BROUILLON</button>
                <button id="goto" class="Quicksand-medium smallText btn"
                    style="font-family: 'Poppins';text-align: center;" >INSCRIPTION Master</button>
            </div>
        </div>
        <div class="content-container">
            <div class="form-container">
                <form  id="application-form" enctype="multipart/form-data" method="POST" style="height: fit-content;padding-bottom: 128px;">
                    <!-- Step 1: Personal Information -->
                    <div class="section-title fixed-title" style="justify-content: space-between;">
                        <h2 class="Quicksand-bold">INFORMATIONS PERSONNELLES</h2>
                        <div id="stepIndicator" class="Quicksand-bold" style="font-size: 20px;">1/2</div>
                    </div>
                    <div class="form-step active" id="step1" style="position: relative;
                    top: 100px;
                    padding: 0 67px;">
                        <div class="profile-pic-container">
                            <div id="pictureContainer" style="display: flex; flex-direction: column; gap: 20px;">
                                <!-- Image wrapper -->
                                <div onclick="document.getElementById('fileInput').click()" style="width: 198px; height: 198px; max-width: 198px; max-height: 198px;
                                        border: 1px solid #6e6d5559;
                                    overflow: hidden; border-radius: 50%; cursor: pointer;position:relative">
                                    <img id="previewImage" src="../assets/user.jpeg"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                    <div class="hover-img">

                                    </div>
                                </div>

                                <!-- Hidden file input -->
                                <input type="file" id="fileInput" accept="image/jpeg,image/png" style="display: none;"
                                    onchange="previewFile(event)">

                                <!-- Info text -->
                                <div class="Quicksand-regular tagsText" style="color: #949598; font-family: 'Poppins';">
                                    Formats acceptés : <span style="color: #2A2916;">JPEG, PNG,</span> <br>
                                    Taille maximale : <span style="color: #2A2916;">20 Mo</span>
                                </div>
                            </div>
                            <div style="display: flex;flex-direction: column;gap: 20px;margin-top: 20px;">
                                <div style="display: flex;flex-direction: column;gap: 8px;">
                                    <div style="display: flex;gap: 8px;">
                                        <label class="role-option">
                                            <input type="radio" name="academic-role" value="enseignant">
                                            <span class="Quicksand-bold smallText"
                                                style="color: black;font-family: 'Poppins';">Interne</span>
                                        </label>
                                    </div>
                                    <div class="Quicksand-regular paragraphe"
                                        style="color: #949598;font-family: 'Poppins';    margin-left: 34px;">Si vous
                                        êtes déjà Etudiant de l’Université Tunis El Manar</div>
                                </div>
                                <div style="display: flex;flex-direction: column;gap: 8px;">
                                    <div style="display: flex;gap: 8px;">
                                        <label class="role-option">
                                            <input type="radio" name="academic-role" value="enseignant">
                                            <span class="Quicksand-bold smallText"
                                                style="color: black;font-family: 'Poppins';">Externe</span>
                                        </label>
                                    </div>
                                    <div class="Quicksand-regular paragraphe"
                                        style="color: #949598;font-family: 'Poppins';    margin-left: 34px;">Si Vous
                                        êtes Etudiant d’un autre Etablissement autre que l’Université Tunis El Manar
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin-top: 60px;">
                            <div class="form-field" style="flex: 1; min-width: unset;">
                                <label for="nom">Nom (Français) <span class="required">*</span></label>
                                <input type="text" id="nom" name="nom" required>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-field">
                                <label for="nom-arabe" style="text-align: end;">(Arabe)<span
                                        class="required">*</span>الإسم</label>
                                <input type="text" id="nom-arabe" name="nom_ar" dir="rtl" required>
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-field">
                                <label for="prenom">Prénom (Français) <span class="required">*</span></label>
                                <input type="text" id="prenom" name="prenom" required>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-field">
                                <label for="prenom-arabe" style="text-align: end;">(Arabe) <span
                                        class="required">*</span>اللقب</label>
                                <input type="text" id="prenom-arabe" name="prenom_ar" dir="rtl" required>
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-field">
                                <label for="datenaissance">Date de naissance ( français ) <span
                                        class="required">*</span></label>
                                <div class="phone-input">
                                    <input type="date" id="datenaissance" name="datenaissance"
                                        placeholder="6 XX XX XX XX" required>
                                </div>
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-field" style="flex: 1; min-width: unset;">
                                <label for="lieunaissance">Lieu de naissance ( français )<span
                                        class="required">*</span></label>
                                <input type="text" id="lieunaissance" name="lieunaissance" required>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-field">
                                <label for="lieunaissanceAr" style="text-align: end;"> (Arabe)<span
                                        class="required">*</span> مكان الولادة</label>
                                <input type="text" id="lieunaissance_ar" name="lieunaissance_ar" dir="rtl" required>
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-field">
                                <label for="nationalite">Nationnalité ( français ) <span
                                        class="required">*</span></label>
                                  <select id="nationalite" name="nationalite" required></select>

                                <span class="error-message"></span>
                            </div>
                            <div class="form-field">
                                <label for="nationnaliteAr" style="text-align: end;">(Arabe) <span
                                        class="required">*</span>الجنسية</label>
                                        <select id="nationalite_ar" name="nationalite_ar" dir="rtl" required></select>
                                <span class="error-message"></span>
                            </div>
                        </div>


                        <div class="form-group blocCin" style="display:none">
                            <div class="form-field form-field-half">
                                <label for="cin">Carte d'identité nationale ( Si Tunisien) <span
                                        class="required">*</span></label>
                                        <input type="number" id="cin" name="cin"
                                        minlength="8" maxlength="8"
                                        oninput="this.value = this.value.slice(0, 8)"
                                        pattern="\d{8}"
                                        placeholder="xxxxxxxx"
                                        required>   
                                        <span class="error-message"></span>
                            </div>
                            
                        </div>

                        <div class="form-group blocIdentifiantUnique" style="display:none">
                            
                            <div class="form-field form-field-half">
                                <label for="cne">N° Passport ( Si étranger )<span class="required">*</span></label>
                                <input type="text" id="cne" name="cne" required>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-field form-field-half">
                                <label for="cne">Identifiant Unique ( Si étranger )<span class="required">*</span></label>
                                <input type="text" id="IdentifiantUnique" name="IdentifiantUnique" required>
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-field form-field-half">
                                <label for="email">Email 1 <span class="required">*</span></label>
                                <input type="email" id="email" name="email" required>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-field form-field-half">
                                <label for="email2">Email 2</label>
                                <input type="email" id="email2" name="email2" placeholder="exemple@gmail.com">
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-field">
                                <label for="telephone">Téléphone <span class="required">*</span></label>
                                <div class="phone-input-container">
                                    <div class="country-selector">
                                        <!--<div class="selected-country">
                                            <div class="country-flag flag-tn"></div>
                                            <span class="country-code">+216</span>
                                        </div>
                                        <div class="country-dropdown">
                                            <div class="country-option" data-code="216" data-flag="tn">
                                                <div class="country-flag flag-tn"></div>
                                                <span class="country-name">Tunisia (+216)</span>
                                            </div>
                                            <div class="country-option" data-code="1" data-flag="us">
                                                <div class="country-flag">🇺🇸</div>
                                                <span class="country-name">USA (+1)</span>
                                            </div>
                                            <div class="country-option" data-code="33" data-flag="fr">
                                                <div class="country-flag">🇫🇷</div>
                                                <span class="country-name">France (+33)</span>
                                            </div>
                                            <div class="country-option" data-code="44" data-flag="gb">
                                                <div class="country-flag">🇬🇧</div>
                                                <span class="country-name">UK (+44)</span>
                                            </div>
                                        </div>-->
                                    </div>
                                    <input type="number" class="phone-input" name="telephone"  placeholder="XX XX XX XX">
                                </div>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <!-- 
                        <div class="section-title">
                            <h2 class="Quicksand-bold">ADRESSE</h2>
                        </div>

                        <div class="form-group">
                            <div class="form-field">
                                <label for="adresse">Adresse (Français) <span class="required">*</span></label>
                                <input type="text" id="adresse" name="adresse" required>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-field">
                                <label for="adresseAr" style="text-align: end;">(Arabe) <span
                                        class="required">*</span>العنوان </label>
                                <input type="text" id="adresseAr" name="adresseAr" required>
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-field">
                                <label for="delegation">Délégation ( français ) <span class="required">*</span></label>
                                <input type="text" id="delegation" name="delegation" required>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-field">
                                <label for="delegationAr" style="text-align: end;">(Arabe) <span
                                        class="required">*</span>المعتمدية </label>
                                <input type="text" id="delegationAr" name="delegationAr" required>
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-field form-field">
                                <label for="code-postal">Code postal / Casier P <span class="required">*</span></label>
                                <input type="text" id="code-postal" name="code-postal" required>
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-field">
                                <label for="gouvernorat">Gouvernorat ( français )<span class="required">*</label>
                                <input type="text" id="gouvernorat" name="gouvernorat" required>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-field">
                                <label for="gouvernoratAr" style="text-align: end;"> (Arabe)<span
                                        class="required">*</span> الولاية </label>
                                <input type="text" id="gouvernoratAr" name="gouvernoratAr" required>
                                <span class="error-message"></span>
                            </div>
                        </div>

                        <div class="section-title">
                            <h2 class="Quicksand-bold">SITUATION</h2>
                        </div>

                        <div class="form-group">
                            <div class="form-field">
                                <label for="matricule">Matricule CNRPS / CNSS</label>
                                <input type="text" id="matricule" name="matricule" required>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-field">
                                <label for="universite"> Université </label>
                                <input type="text" id="universite" name="universite" required>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-field">
                                <label for="etablissement">Établissement d'affectation</label>
                                <input type="text" id="etablissement" name="etablissement" required>
                                <span class="error-message"></span>
                            </div>
                            <div class="form-field">
                                <label for="grade"> Grade </label>
                                <input type="text" id="grade" name="grade" required>
                                <span class="error-message"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-field">
                                <label for="dateGrade">Date D'obtention Du Grade</label>
                                <input type="date" id="dateGrade" name="dateGrade" required>
                                <span class="error-message"></span>
                            </div>
                        </div> -->
                        <div class="section-title">
                            <h2 class="Quicksand-bold">Genre</h2>
                        </div>
                        <div class="academic-roles">
                            <label class="role-option">
                                <input type="radio" name="academic-role" value="enseignant">
                                <span class="radio-label">Femme</span>
                            </label>
                            <label class="role-option">
                                <input type="radio" name="academic-role" value="mastere">
                                <span class="radio-label">Homme</span>
                            </label>
                        </div>
                        <div class="form-actions" style="gap: 10px;">
                            <div type="button" id="prev-btn" class="flesh-container">
                                <img src="../assets/arraw_left_grey.png" style="width: 14px;">
                            </div>
                            <div style="display: flex;align-items: center;gap: 10px;">
                                <div style="width: 17px;
                                height: 17px;
                                border-radius: 50%;
                                background: #BF0404 0% 0% no-repeat padding-box;"></div>
                                <div style="width: 17px;
                                 height: 17px;
                                 border-radius: 50%;
                                 background: #DDACA7 0% 0% no-repeat padding-box;"></div>
                            </div>
                            <div type="button" id="next-btn" class="flesh-container">
                                <img src="../assets/arrow_write.png" style="width: 14px;">
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 will be added via JS -->
                    <div class="form-step" id="step2" style="position: relative;
                    top: 100px;
                    padding: 0 67px;">

                        <!-- Will be populated by JavaScript -->
                    </div>

                    <!-- Step 3 will be added via JS -->
                    <div class="form-step" id="step3">
                        <!-- Will be populated by JavaScript -->
                    </div>
                </form>


            </div>
        </div>
    </div>

    <!-- <img src="../assets/illustration.png" /> -->
    <script src="./index.js"></script>
    <script src="./form-validation.js"></script>
    <script src="../js/navigation.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Delegation mapping
            const delegationsByGouvernorat = {
                "Ariana": ["Ariana Ville", "Ettadhamen", "La Soukra", "Raoued", "Sidi Thabet"],
                "Béja": ["Béja Nord", "Béja Sud", "Testour", "Téboursouk", "Amdoun", "Goubellat", "Nefza"],
                "Ben Arous": ["Ben Arous", "Mégrine", "Ezzahra", "Hammam Lif", "Hammam Chott", "Mohamedia", "Radès"],
                "Bizerte": ["Bizerte Nord", "Bizerte Sud", "Mateur", "Ras Jebel", "Sejnane", "Tinja", "Utique"],
                "Gabès": ["Gabès Ville", "El Hamma", "Ghannouch", "Mareth", "Matmata"],
                "Gafsa": ["Gafsa Nord", "Gafsa Sud", "Metlaoui", "Redeyef", "Oum Laarayes"],
                "Jendouba": ["Jendouba", "Fernana", "Aïn Draham", "Bou Salem"],
                "Kairouan": ["Kairouan Nord", "Kairouan Sud", "Haffouz", "Sbikha", "Chebika"],
                "Kasserine": ["Kasserine Nord", "Kasserine Sud", "Thala", "Fériana"],
                "Kébili": ["Kébili Nord", "Kébili Sud", "Douz"],
                "Kef": ["Le Kef", "Nebeur", "Tajerouine", "Dahmani"],
                "Mahdia": ["Mahdia", "Chebba", "Ksour Essef", "El Jem"],
                "La Manouba": ["Manouba", "Djedeida", "Douar Hicher", "Oued Ellil"],
                "Médenine": ["Médenine Nord", "Médenine Sud", "Ben Gardane", "Djerba"],
                "Monastir": ["Monastir", "Ksar Hellal", "Sahline", "Jemmal"],
                "Nabeul": ["Nabeul", "Hammamet", "Korba", "Kelibia", "Dar Chaabane"],
                "Sfax": ["Sfax Ville", "Sakiet Ezzit", "El Ain", "Mahres"],
                "Sidi Bouzid": ["Sidi Bouzid", "Meknassi", "Menzel Bouzaiene"],
                "Siliana": ["Siliana", "Gaafour", "Kesra"],
                "Sousse": ["Sousse Ville", "Msaken", "Kalaa Kebira", "Kalaa Seghira"],
                "Tataouine": ["Tataouine Nord", "Tataouine Sud", "Bir Lahmar"],
                "Tozeur": ["Tozeur", "Nefta", "Degache"],
                "Tunis": ["Tunis Centre", "El Omrane", "Carthage", "La Marsa", "Bab El Bhar"],
                "Zaghouan": ["Zaghouan", "El Fahs", "Zriba"]
            };

            // 2. Function to update delegation select based on selected gouvernorat
            function updateDelegations() {
                const gouvernoratSelect = document.getElementById('gouvernorat');
                const delegationSelect = document.getElementById('delegation');
                const selectedGov = gouvernoratSelect.value;

                // Clear previous options
                delegationSelect.innerHTML = '<option value="">-- Sélectionner une délégation --</option>';
                console.log(selectedGov, delegationsByGouvernorat[selectedGov]);

                if (delegationsByGouvernorat[selectedGov]) {
                    delegationsByGouvernorat[selectedGov].forEach(delegation => {
                        const option = document.createElement('option');
                        option.value = delegation;
                        option.textContent = delegation;
                        delegationSelect.appendChild(option);
                    });
                }
            }
            console.log(document.getElementById('gouvernorat'));

            document.getElementById('gouvernorat')?.addEventListener('change', updateDelegations);


            // 3. Attach onchange event
            // const gouvernoratElement = document.getElementById('gouvernorat');
            // if (gouvernoratElement) {
            //   gouvernoratElement.addEventListener('change', updateDelegations);
            // }


        });
        document.addEventListener('DOMContentLoaded', () => {
            const delegationsArByGouvernoratAr = {
                "أريانة": ["أريانة المدينة", "رواد", "سكرة", "التضامن", "سيدي ثابت"],
                "باجة": ["باجة الشمالية", "باجة الجنوبية", "نفزة", "تيبار", "تستور", "عمدون", "مجاز الباب"],
                "بن عروس": ["بن عروس", "الزهراء", "حمام الأنف", "حمام الشط", "رادس", "مقرين", "مرناق", "فوشانة", "المروج"],
                "بنزرت": ["بنزرت الشمالية", "بنزرت الجنوبية", "رأس الجبل", "ماطر", "منزل بورقيبة", "منزل جميل", "تينجة", "غار الملح", "عالية"],
                "قابس": ["قابس المدينة", "قابس الغربية", "قابس الجنوبية", "الحامة", "ماتماطة", "غنوش", "المطوية", "وديان"],
                "قفصة": ["قفصة الشمالية", "قفصة الجنوبية", "أم العرائس", "المتلوي", "الرديف", "السند", "القطار"],
                "جندوبة": ["جندوبة", "بلطة بوعوان", "طبرقة", "فرنانة", "عين دراهم", "وادي مليز", "غار الدماء"],
                "القيروان": ["القيروان الشمالية", "القيروان الجنوبية", "الشراردة", "بوحجلة", "السبيخة", "حاجب العيون", "نصر الله", "العلا"],
                "القصرين": ["القصرين", "سبيطلة", "تالة", "فريانة", "جدليان", "حاسي الفريد", "العيون"],
                "قبلي": ["قبلي الشمالية", "قبلي الجنوبية", "دوز الشمالية", "دوز الجنوبية", "الفوار", "رجيم معتوق"],
                "الكاف": ["الكاف", "تاجروين", "ساقية سيدي يوسف", "الدهماني", "الجريصة", "نبر", "السرس"],
                "المهدية": ["المهدية", "الجم", "سيدي علوان", "بومرداس", "شربان", "ملولش", "أولاد الشامخ", "هبيرة"],
                "منوبة": ["منوبة", "دوار هيشر", "وادي الليل", "المرناقية", "الجديدة", "البطان", "طبربة", "برج العامري"],
                "مدنين": ["مدنين الشمالية", "مدنين الجنوبية", "جرجيس", "بني خداش", "سيدي مخلوف", "بن قردان"],
                "المنستير": ["المنستير", "المكنين", "زرمدين", "بنان", "قصيبة المديوني", "جمّال", "طبلبة", "الساحلين"],
                "نابل": ["نابل", "دار شعبان الفهري", "الحمامات", "بني خيار", "قربة", "منزل تميم", "الهوارية", "قرمبالية"],
                "سيدي بوزيد": ["سيدي بوزيد الغربية", "سيدي بوزيد الشرقية", "المكناسي", "الرقاب", "بئر الحفي", "جلمة", "سبالة أولاد عسكر"],
                "سليانة": ["سليانة", "قعفور", "الكريب", "بوعرادة", "كسرى", "مكثر", "الروحية"],
                "سوسة": ["سوسة المدينة", "سوسة الجنوبية", "سوسة الشمالية", "القلعة الكبرى", "القلعة الصغرى", "سيدي بوعلي", "هرقلة", "حومة السوق"],
                "تطاوين": ["تطاوين الجنوبية", "تطاوين الشمالية", "غمراسن", "البئر الأحمر", "الصمار", "ذهيبة", "رمادة"],
                "توزر": ["توزر", "نفطة", "تمغزة", "حامة الجريد", "دوز"],
                "تونس": ["تونس المدينة", "المرسى", "قرطاج", "سيدي البشير", "باب سويقة", "باب البحر", "الزهروني", "حي الخضراء"],
                "زغوان": ["زغوان", "الفحص", "الناظور", "صواف", "بئر مشارقة"],
                "المهدية": ["المهدية", "الجم", "ملولش", "سيدي علوان", "بومرداس", "أولاد الشامخ"]
            };


            function updateDelegationsAr() {
                const gouvernoratArSelect = document.getElementById('gouvernoratAr');
                const delegationArSelect = document.getElementById('delegationAr');
                const selectedGovAr = gouvernoratArSelect.value.trim();

                delegationArSelect.innerHTML = '<option value="">-- الرجاء اختيار معتمدية --</option>';

                if (delegationsArByGouvernoratAr[selectedGovAr]) {
                    delegationsArByGouvernoratAr[selectedGovAr].forEach(delegation => {
                        const option = document.createElement('option');
                        option.value = delegation;
                        option.textContent = delegation;
                        delegationArSelect.appendChild(option);
                    });
                }
            }

            document.getElementById('gouvernoratAr')?.addEventListener('change', updateDelegationsAr);
        });
    </script>
</body>

</html>