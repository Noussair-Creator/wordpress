<?php include __DIR__ . '/../layout/header_side.php'; ?>


            <!-- Main Content -->
            <main class="main-content">
                <!-- Progress steps -->
                <div class="progress-container">
                    <div class="progress-step active">
                        <div class="step-circle">
                            <div class="completion-check">
                                <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/step_valid.jpeg" style="width: 19px;height: 19px;">
                            </div>
                            <div class="step-label">Étape </div> 1
                        </div>
                    </div>
                    <div class="progress-line"></div>
                    <div class="progress-step">
                        <div class="step-circle">
                            <div class="completion-check">
                                <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/step_valid.jpeg" style="width: 19px;height: 19px;">
                            </div>
                            <div class="step-label">Étape </div> 2
                        </div>
                    </div>
                    <div class="progress-line"></div>
                    <div class="progress-step">
                        <div class="step-circle">
                            <div class="completion-check">
                                <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/step_valid.jpeg" style="width: 19px;height: 19px;">
                            </div>
                            <div class="step-label">Étape </div> 3
                        </div>
                    </div>
                    <div class="progress-line"></div>
                    <div class="progress-step">
                        <div class="step-circle">
                            <div class="completion-check">
                                <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/step_valid.jpeg" style="width: 19px;height: 19px;">
                            </div>
                            <div class="step-label">Étape </div> 4
                        </div>
                    </div>
                </div>

                <!-- Form container -->
                <div class="form-container">
                    <form id="application-form">
                        <!-- Step 1: Personal Information -->
                        <div class="form-step active" id="step1">
                            <div class="section-title">
                                <h2 class="Quicksand-bold">INFORMATIONS PERSONNELLES</h2>
                            </div>
                            <div class="form-group">
                                <div class="form-field" style="flex: 1; min-width: unset;">
                                    <label for="nom">Nom (Français) <span class="required">*</span></label>
                                    <input type="text" id="nom" name="nom" required>
                                    <span class="error-message"></span>
                                </div>
                                <div class="form-field">
                                    <label for="nom-arabe" style="text-align: end;">(Arabe)<span
                                            class="required">*</span>الإسم</label>
                                    <input type="text" id="nom-arabe" name="nom-arabe" dir="rtl" required>
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
                                    <input type="text" id="prenom-arabe" name="prenom-arabe" dir="rtl" required>
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
                                    <input type="text" id="lieunaissanceAr" name="lieunaissanceAr" dir="rtl" required>
                                    <span class="error-message"></span>
                                </div>
                            </div>

                           

                              <div class="form-group">
                            <div class="form-field">
                                <label for="nationalite">Nationnalité ( français ) <span
                                        class="required">*</span></label>
                                  <select id="nationalite" name="nationalite" ></select>

                                <span class="error-message"></span>
                            </div>
                            <div class="form-field">
                                <label for="nationnaliteAr" style="text-align: end;">(Arabe) <span
                                        class="required">*</span>الجنسية</label>
                                        <select id="nationalite_ar" name="nationalite_ar" dir="rtl" ></select>

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
                                            </div>
                                        </div>
                                        <input type="tel" class="phone-input2" placeholder="XX XX XX XX">
                                    </div>
                                    <span class="error-message"></span>
                                </div>
                            </div>

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
                                <div class="form-field" style="flex: 1; min-width: unset;">
                                    <label for="gouvernorat">Gouvernorat <span class="required">*</span></label>
                                    <div class="select-wrapper">
                                        <select id="gouvernorat" name="gouvernorat" required>
                                            <option value="">-- Sélectionner --</option>
                                            <option value="Ariana">Ariana</option>
                                            <option value="Béja">Béja</option>
                                            <option value="Ben Arous">Ben Arous</option>
                                            <option value="Bizerte">Bizerte</option>
                                            <option value="Gabès">Gabès</option>
                                            <option value="Gafsa">Gafsa</option>
                                            <option value="Jendouba">Jendouba</option>
                                            <option value="Kairouan">Kairouan</option>
                                            <option value="Kasserine">Kasserine</option>
                                            <option value="Kébili">Kébili</option>
                                            <option value="Kef">Kef</option>
                                            <option value="Mahdia">Mahdia</option>
                                            <option value="La Manouba">La Manouba</option>
                                            <option value="Médenine">Médenine</option>
                                            <option value="Monastir">Monastir</option>
                                            <option value="Nabeul">Nabeul</option>
                                            <option value="Sfax">Sfax</option>
                                            <option value="Sidi Bouzid">Sidi Bouzid</option>
                                            <option value="Siliana">Siliana</option>
                                            <option value="Sousse">Sousse</option>
                                            <option value="Tataouine">Tataouine</option>
                                            <option value="Tozeur">Tozeur</option>
                                            <option value="Tunis">Tunis</option>
                                            <option value="Zaghouan">Zaghouan</option>
                                        </select>
                                    </div>
                                    <span class="error-message"></span>
                                </div>
                                <div class="form-field">
                                    <label for="gouvernoratAr" style="text-align: end;"> (Arabe)<span
                                            class="required">*</span> الولاية </label>
                                    <div class="select-wrapper">
                                        <select id="gouvernoratAr" name="gouvernoratAr" required>
                                            <option value="">-- اختر --</option>
                                            <option value="أريانة">أريانة</option>
                                            <option value="باجة">باجة</option>
                                            <option value="بن عروس">بن عروس</option>
                                            <option value="بنزرت">بنزرت</option>
                                            <option value="قابس">قابس</option>
                                            <option value="قفصة">قفصة</option>
                                            <option value="جندوبة">جندوبة</option>
                                            <option value="القيروان">القيروان</option>
                                            <option value="القصرين">القصرين</option>
                                            <option value="قبلي">قبلي</option>
                                            <option value="الكاف">الكاف</option>
                                            <option value="المهدية">المهدية</option>
                                            <option value="منوبة">منوبة</option>
                                            <option value="مدنين">مدنين</option>
                                            <option value="المنستير">المنستير</option>
                                            <option value="نابل">نابل</option>
                                            <option value="صفاقس">صفاقس</option>
                                            <option value="سيدي بوزيد">سيدي بوزيد</option>
                                            <option value="سليانة">سليانة</option>
                                            <option value="سوسة">سوسة</option>
                                            <option value="تطاوين">تطاوين</option>
                                            <option value="توزر">توزر</option>
                                            <option value="تونس">تونس</option>
                                            <option value="زغوان">زغوان</option>
                                        </select>

                                    </div>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-field" style="flex: 1; min-width: unset;">
                                    <label for="delegation">Délégation <span class="required">*</span></label>
                                    <div class="select-wrapper">
                                        <select id="delegation" name="delegation" required>
                                            <option value="">-- Sélectionner un gouvernorat d'abord --</option>
                                        </select>
                                    </div>
                                    <span class="error-message"></span>
                                </div>
                                <div class="form-field">
                                    <label for="delegationAr" style="text-align: end;">(Arabe) <span
                                            class="required">*</span>المعتمدية </label>
                                    <select id="delegationAr" name="delegationAr" required>
                                        <option value="">-- الرجاء اختيار معتمدية --</option>
                                    </select>
                                    <span class="error-message"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-field form-field">
                                    <label for="code-postal">Code postal / Casier P <span
                                            class="required">*</span></label>
                                    <input type="number" id="code-postal" name="code-postal" required>
                                    <span class="error-message"></span>
                                </div>
                            </div>



                            <div class="section-title">
                                <h2 class="Quicksand-bold">ETAT</h2>
                            </div>
                            <label class="custom-checkbox" class="Quicksand-medium smallText"
                                style="font-family: 'Poppins';color: #2A2916;">
                                <input type="checkbox" checked />
                                <span class="checkmark"></span>
                                Étudiant(e) a besoins spécifiques
                            </label>
                            <div class="form-field" style="width: 50%;margin-top: 20px;">
                                <label for="type">Type<span class="required">*</label>
                                <input type="text" id="type" name="type" >
                                <span class="error-message"></span>
                            </div>

                            <div class="form-actions">
                                <button type="button" id="next-btn" class="btn btn-primary">SUIVANT</button>
                            </div>
                        </div>

                        <!-- Step 2 will be added via JS -->
                        <div class="form-step" id="step2">

                        </div>

                        <div class="form-step" id="step3">
                        </div>
                        <div class="form-step" id="step4">
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
    <div id="confirmation-popup" class="popup-overlay" style="display: none;">
        <div class="popup-box">
            <h3 class="popup-title">Confirmation</h3>
            <div style="position: relative;top: 50px;">
                <div class="popup-icon">
                    <img src="/wp-content/plugins/plateforme-master/pages/Candidature/assets/done.png" alt="icon" style="width: 55px;height: 55px;">
                </div>
                <p>Confirmez vous les informations saisies ?</p>

            </div>
            <div class="popup-actions">
                <button class=" Quicksand-bold cancel-button">Annuler</button>
                <button class="Quicksand-bold confirm-button ">Confirmer</button>
            </div>

        </div>
    </div>


   
<?php
$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role = $roles[0] ?? null;
$user_id = $current_user->ID;
?>

<script>
  const PMSettings = {
    apiUrlCandidats: '<?= esc_url(rest_url("plateforme-master/v1/candidats")) ?>',
    apiUrlNationalites: '<?= esc_url(rest_url("plateforme-master/v1/nationalites")) ?>',
    nonce: '<?= wp_create_nonce("wp_rest") ?>',
    role: '<?= esc_js($role) ?>',
    userId: <?= (int) $user_id ?>
  };
</script>





    <script src="/wp-content/plugins/plateforme-master/pages/Candidature/js/main.js"></script>
    <script src="/wp-content/plugins/plateforme-master/pages/Candidature/js/script_fsdt.js"></script>
    <script src="/wp-content/plugins/plateforme-master/pages/Candidature/js/form-validation.js"></script>
    <script src="/wp-content/plugins/plateforme-master/pages/Candidature/js/navigation.js"></script>

 <?php include "modal.php"; ?>

 <style>
    /* Style personnalisé pour les checkboxes */
.utm-checkbox {
  width: 18px !important;
  height: 18px !important;
  accent-color: #c00; /* Couleur personnalisée de coche (rouge UTM) */
  cursor: pointer;
  border-radius: 4px;
  margin-right: 5px;
}

/* Optionnel : focus visuel */
.utm-checkbox:focus {
  outline: 2px solid #a00;
  outline-offset: 2px;
}

.utm-checkbox {
  width: 18px;
  height: 18px;
  accent-color: #c00;
  cursor: pointer;
  border-radius: 4px;
  margin-right: 5px;
  margin-left: 10px;

}

.utm-malus-exclusion label {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 15px;
  font-weight: 500;
  color: #444;
}

.Quicksand-medium {
    font-family: "Poppins", sans-serif;
    font-weight: 500;
    text-align: center;
}

#masters-radio-container label.role-option {
  display: flex;
  align-items: center;
  gap: 10px; /* espace entre input et texte */
  margin-bottom: 10px;
  cursor: pointer;
}

#masters-radio-container label.role-option input[type="number"] {
  width: 60px;       /* largeur fixe pour input number */
  padding: 5px 8px;  /* un peu d’espace intérieur */
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
      background-color: #F8F8F8;
}

#masters-radio-container label.role-option span {
  font-family: 'Poppins', sans-serif;
  font-weight: 400;
  color: black;
  font-size: 15px;
  user-select: none;  /* empêche la sélection du texte au clic */
}


#select-wrapper {
  display: flex;
  gap: 12px;             /* Espace entre les éléments */
  align-items: center;   /* Alignement vertical centré */
}

#select-wrapper select {
  padding: 8px 12px;
  font-size: 1rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  min-width: 250px;      /* Largeur minimale */
  background-color: #fff;
  cursor: pointer;
}

#select-wrapper #annee-diplome {
  font-size: 1rem;
  color: #333;
  min-width: 150px;
}
.input-error {
  border: 2px solid red;
  background-color: #ffa2a2;
}

.master-choice-info {
  margin-top: 0rem;
  padding: 1rem;
  padding-left:0px
}
.master-choice-info h4 {
  margin: 0 0 0.5rem;
  font-size: 1.1rem;
  color: #2A2916;
}
.master-choice-info p {
     color: #6E6D55;
    font-size: 13px;
}
.master-choice-info hr {
    margin-top: 10px;
    margin-bottom: 33px;
    border: none;               
    border-top: 1px solid #6e6d554d;
    height: 0;                 
    background: none;     
}
#select-wrapper select {
    padding: 8px 12px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 4px;
    min-width: 250px;
    background-color: #fff;
    cursor: pointer;
    width: 100%;
    padding: 10px 12px;
    border: unset;
    border-bottom: 2px solid #A6A485;
    border-radius: 0;
    background: #ECECEC61;
    font-size: var(--text-md);
    transition: border-color var(--transition-fast);
}
 </style>

</body>

</html>