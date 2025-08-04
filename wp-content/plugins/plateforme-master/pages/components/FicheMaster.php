<?php
$current_user = wp_get_current_user();
$user_roles = $current_user->roles;
$user_role = !empty($user_roles) ? $user_roles[0] : 'guest';
?>

<script>
  const PMSettings2 = {
    apiUrl: "<?php echo esc_url( rest_url('/plateforme-master/v1/masters') ); ?>",
    nonce: "<?php echo esc_js( wp_create_nonce('wp_rest') ); ?>",
    userRole: "<?php echo esc_js( $user_role ); ?>"
  };
</script>

<div class="body-content">
    <div class="master-wrapper">
    <!-- Titre + Actions -->
    <div class="master-topbar">
        <div class="master-title"><img class="icon_img" src="/imagesMaster/servicemaster_images/2274790.png">  Master de recherche en AI et Data</div>
        <div class="master-actions">
        <select id="annee_actuel">
            
        </select>
        
         <button class="btn red btn-publier-espace" id="btnPublierEspace" style="display: none;">
          <img class="icon_img2" src="/imagesMaster/servicemaster_images/27) Icon-lock.png"> Publier espace
        </button>

         <button class="btn red btn-publier-web" id="btnPublierWeb" style="display: none;">
          <img class="icon_img2" src="/imagesMaster/servicemaster_images/internet-svgrepo-com.png"> Publier web
        </button>
        </div>
    </div>

    <!-- Bloc Infos + Responsable -->
    <div class="master-card">
            <div class="master-header card-double">
              <div class="block-title">Informations détaillées</div>
              <div class="block-title with-icons">
                Responsable académique
                <span class="icons">
                <img class="icon_img3" src="/imagesMaster/servicemaster_images/pdf-svgrepo-com (2).png" alt="" srcset="">
                <img class="icon_img4 btn" src="/imagesMaster/servicemaster_images/edit-2rouge.png" alt="" srcset="">
                </span>
            </div>

       </div>

       <div class="card-double">
          <div class="master-block">
           <div class="info-grid3" >


              <!--
              <div class="info1">
                  <div><strong>Nature :</strong></div>
                  <div><strong>Domaine :</strong></div>

                  <div><strong>Mention :</strong></div>

                 <div><strong>Parcours :</strong></div>
                 <div><strong>Code interne :</strong></div>

                  <div><strong>Intitulé :</strong></div>
                  <div><strong>Début d’habilitation :</strong></div>
                  <div><strong>Fin d’habilitation :</strong></div>
              </div>

              <div class="info2 infoM">
                <div></div>
                <div></div>
                <div> </div>
                <div> </div>
                <div>  </div>
                <div> </div>
                <div></div>
                <div>  </div>
              </div>
              -->

              <ul class="master-details">
                <li><strong>Nature :</strong> <span>  </span></li>
                <li><strong>Domaine :</strong> <span> </span></li>
                <li><strong>Mention :</strong> <span> </span></li>
                <li><strong>Parcours :</strong> <span> </span></li>
                <li><strong>Code interne :</strong> <span> </span></li>
                <li><strong>Intitulé :</strong> <span> </span></li>
                <li><strong>Début d’habilitation :</strong> <span> </span></li>
                <li><strong>Fin d’habilitation :</strong> <span> </span></li>
              </ul>


            </div>
            
          </div>
          <div class="master-block">
            
          <img src="" class="avatar" alt="Photo">

              <div class="info-grid3" style="margin-top: 26px;">

                
                <ul class="master-details master-details2">
                  <li><strong>Nom et Prénom :</strong> <span> </span></li>
                  <li><strong>Grade :</strong> <span></span></li>
                  <li><strong>Spécialité :</strong> <span></span></li>
                  <li><strong>Email :</strong> <span></span></li>
                  <li><strong>Tél :</strong> <span></span></li>
                </ul>

              </div>

              <div class="statut-block statut-publication" id="statut-publication">
                <label>Statut de publication :</label>
                <span class="badge badge-publie"></span>
                <span class="statut-date"></span>
                <span class="statut-user"></span>
              </div>




          </div>
      </div>
    </div>

    <!-- Objectifs -->
    <div class="master-card">
        <!--<div class="block-title with-icons">
        Objectifs pédagogiques et scientifiques
        <span class="icons">
            <i class="fas fa-file-pdf"></i>
            <i class="fas fa-pen"></i>
        </span>
        </div>-->
        <div class="master-header card-double">
              <div class="block-title with-icons">
                  Objectifs pédagogiques et scientifiques
                <span class="icons">
                <img class="icon_img3" src="/imagesMaster/servicemaster_images/pdf-svgrepo-com (2).png" alt="" srcset="">
                <img class="icon_img4 btn openmodalObjectifs" src="/imagesMaster/servicemaster_images/edit-2rouge.png" alt="" srcset="">
                </span>
            </div>
        </div>

        <div class="card-double">
            <div class="master-block2 p-3">
              <strong>Objectifs généraux du master :</strong>
            </div>
            <div class="master-block3 p-3 objectifs_generaux">

              <ul class="objectifs_liste">
                 
              </ul>

          </div>
        </div>


        <div class="card-double">
            <div class="master-block2 p-3">
                  <strong>Objectifs spécifiques :</strong>
            </div>
            <div class="master-block3 p-3 objectifs_specifiques">
          

          </div>
        </div>

        
    </div>

 

    <!-- Score & Plan -->
    <div class="two-columns">
       <!--
       <div class="master-card card2">
            <div class="score-box">
            <div class="master-header card-double">
              <div class="block-title with-icons">
                   Formule de calcul du score
                <span class="icons">
                    <a class="btn red" href="/formule-de-calcul-du-score/" target="_blank" rel="noopener noreferrer">Configurer</a>
                </span>
            </div>
            </div>

            <div class="card-double">
            <div class="master-block2 p-3">
                    <div><strong>Score total =</strong></div>
                </div>

                <div class="master-block3 p-3">
                  <div>(Note licence × 40%) + (Note mémoires × 30%) + (Note entretien × 30%) + expérience × 10% + Bonus</div>

                </div>
              </div>

            </div>
           
       </div>-->

       <div class="master-card card2">
          
            <div class="plan-box">

            

             <div class="master-header card-double">
              <div class="block-title with-icons">
                  Plan d'étude
                <span class="icons">
                <img class="icon_img4 btn btn_pdf" src="/imagesMaster/servicemaster_images/edit-2rouge.png" alt="" srcset="">
                </span>
            </div>
            </div>
            
         

             <div class="card-double">
               <div class="master-block2 p-3">
                   <img class="icon_img5" src="/imagesMaster/servicemaster_images/pdf-svgrepo-com (2).png" alt="" srcset="">
                </div>

                <div class="master-block3 p-3">
                    <p>Vous pouvez télécharger le plan en PDF</p>

                    <button class="btn red">📄 Télécharger</button>

                </div>
              </div>


            </div>
       </div>

    </div>
    



    </div>

</div>


<!-- Bloc M1 -->
<!-- M1 - Bloc modules et admission -->
<div class="bloc-m1-wrapper">

  <div class="m1-header">
    <h2>M1</h2>
    <button class="btn red add-m2"><i class="fa fa-plus"></i> Ajouter M2</button>
  </div>
  <hr class="section-divider">

  <!-- Condition d'admission -->
      <!-- Admission -->
    <div class="master-card">
         <div class="master-header card-double">
              <div class="block-title with-icons">
                  Condition d'admission
                <span class="icons">
                <img class="icon_img3" src="/imagesMaster/servicemaster_images/pdf-svgrepo-com (2).png" alt="" srcset="">
                 <img class="icon_img4 btn openmodalConditions" onclick="openmodalConditions('M1')"
                    src="/imagesMaster/servicemaster_images/edit-2rouge.png" 
                     data-cycle="M1"
                    alt="">
                </span>
            </div>
        </div>

        <div class="card-double">
            <div class="master-block2 p-3">
                    <div><strong>Diplômes requis :</strong></div>
                    <div><strong>Procédure de sélection :</strong></div>
                    <div><strong>Places disponibles :</strong></div>
                    <div><strong>Critères :</strong></div>
                    <div><strong>Public visé :</strong></div>
                </div>

                <div class="master-block3 conditions-m1 p-3" id="conditions-m1">
                <!--<div>Licence, Master1, Ingénieur</div>
                  <div>Entretien</div>
                  <div>30</div>
                  <div> Moyenne, expérience, motivation</div>
                  <div> Étudiants, internationaux</div>-->

                </div>
              </div>

    </div>

  <!-- Formule score -->
  <div class="master-card card2">
            <div class="score-box">
            <div class="master-header card-double">
              <div class="block-title with-icons">
                   Formule de calcul du score
                <span class="icons">
          <a class="btn red" href="/formule-de-calcul-du-score?master=M1&id=<?php echo $_GET['id']; ?>" target="_blank" rel="noopener noreferrer">
            Configurer
          </a>                </span>
            </div>
            </div>

            <div class="card-double">
            <div class="master-block2 p-3">
                    <div><strong>Score total =</strong></div>
                </div>

                <div class="master-block3 p-3" id="scoreM1">
                  <div></div>

                </div>
              </div>

            </div>
           
       </div>

</div>


<style>
  .card2 {
    flex: 50%;
  }
    .body-content {
  background: #ffffff;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  padding: 30px;
  border-radius: 12px;
  margin: 30px 0;
}
img.icon_img5 {
    width: 59px;
    height: 75px;
    text-align: center;
}
 .master-wrapper {
  margin: 20px auto;
  font-family: 'Segoe UI', sans-serif;
  color: #333;
}

.master-topbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
}

.master-title {
  font-size: 18px;
  font-weight: bold;
}

.master-actions {
  display: flex;
  gap: 10px;
}

.master-actions select {
    padding: 6px;
    border-radius: 6px;
    border: 1px solid #ccc;
    width: 150px;
}

.btn {
  padding: 7px 12px;
  border-radius: 6px;
  border: none;
  cursor: pointer;
  font-size: 14px;
}

.btn.red {
  background: #c62828;
  color: #fff;
  float:right
}

.btn.green {
  background: #2ecc71;
  color: #fff;
}

.master-card {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  margin-bottom: 20px;
}

 .section-divider {
    border: none;
    border-top: 2px solid #e0e0e0;
    margin: 16px 0;
  }
.card-double{
  display: flex;
  gap: 20px;
}

.master-card.two-columns {
  display: flex;
  gap: 20px;
}

.master-block {
  flex: 1;
  padding: 20px;
}

.block-title {
    font-weight: bold;
    color: #555;
    /* margin-bottom: 10px; */
    /* border-bottom: 1px solid #ddd; */
    /* padding-bottom: 5px; */
    flex: 1;
}

.block-title.with-icons {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.icons i {
  color: #c62828;
  margin-left: 10px;
  cursor: pointer;
}

.info-grid {
  display: grid;
 grid-template-columns: repeat(2, 1fr);
  gap: 8px 15px;
  font-size: 14px;
}

.prof-card {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-top: 10px;
}

.avatar {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #ccc;
}

.prof-info p {
  margin: 2px 0;
  font-size: 14px;
}

ul.objectifs_liste {
  list-style-type: none;
  padding-left: 0;
}

ul.objectifs_liste li::before {
  content: '▶';
  color: red;
  margin-right: 8px;
}
img.icon_img
 {
    width: 36px;
    height: 36px;
}
img.icon_img2
 {
    width: 15px;
    height: 15px;
    top: -1px;
    position: relative;
}
img.icon_img3 {
    width: 31px;
    height: 40px;
}

img.icon_img4.btn {
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 0px 6px #00000030;
    border-radius: 5px;
    opacity: 1;
    width: 40px;
    height: 40px;
    margin-left: 10px;
}
.master-header{
    background: #FFFFFF 0% 0% no-repeat padding-box;
    box-shadow: 0px 5px 16px #00000012;
    border-radius: 10px 10px 0px 0px;
    opacity: 1;
    padding: 20px;
}

.master-block2{
    flex: 25%;
}
.master-block3 {
    flex: 75%;
}
.two-columns {
    display: flex;
    gap: 20px;

}
/* Bloc Modules M1 */
.modules_m1 {
  font-size: 14px;
  color: #333;
}

.modules_m1 ul.objectifs_liste {
  list-style-type: none;
  padding-left: 0;
}

.modules_m1 ul.objectifs_liste li::before {
  content: '📘';
  color: #c62828;
  margin-right: 8px;
}

.openmodalM1 {
  cursor: pointer;
}
.block-title.with-icons {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.card-double {
  display: flex;
  gap: 20px;
}

.master-block2 {
  flex: 25%;
  padding: 20px;
}

.master-block3 {
  flex: 75%;
  padding: 20px;
}
.bloc-m1-wrapper {
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  margin: 30px 0;
}

.m1-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.m1-header h2 {
  font-size: 20px;
  margin: 0;
  font-weight: 600;
}

.add-m2 {
  font-size: 14px;
  padding: 8px 14px;
  display: flex;
  align-items: center;
  gap: 6px;
}

.m1-card {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
  margin-bottom: 20px;
}

.m1-card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 14px 20px;
  border-bottom: 1px solid #eee;
}

.m1-card-header.between {
  justify-content: space-between;
}

.m1-title {
  font-weight: 600;
  font-size: 16px;
}

.m1-icons {
  display: flex;
  gap: 10px;
}

.pdf-btn,
.edit-btn {
  background: #fff;
  border: none;
  padding: 5px;
  border-radius: 8px;
  box-shadow: 0 2px 5px #00000030;
  cursor: pointer;
}

.pdf-btn img,
.edit-btn img {
  width: 24px;
  height: 24px;
}

.m1-card-body {
  padding: 20px;
  font-size: 14px;
}

.m1-card-body p {
  margin: 8px 0;
}

.btn.red {
  background: #c62828;
  color: white;
  border: none;
  border-radius: 6px;
  padding: 6px 14px;
  cursor: pointer;
}
ul.master-details{
padding-left: 0rem
}

ul.master-details li {
    display: flex;
    align-items: center;
    gap: 20px;
    font-size: 14px;
    padding: 10px 0;
    border-bottom: 1px solid #dedcc9;
    font-weight: 600;
}
ul.master-details li strong {
    min-width: 180px;
    font-weight: 600;
    color: #6E6D55;
    flex-shrink: 0;
}
.statut-block {
  margin-top: 12px;
  font-size: 14px;
  display: flex;
  align-items: center;
  gap: 10px;
  flex-wrap: wrap;
}

.badge-publie {
  background-color: #c62828; /* rouge UTM */
  color: white;
  padding: 4px 12px;
  border-radius: 20px;
  font-weight: 500;
  font-size: 13px;
}

.statut-date {
  color: #666;
  font-style: italic;
  font-size: 13px;
}

.statut-user {
  color: #444;
  font-size: 13px;
  font-style: italic;
}
.statut-block.empty .statut-absent {
  color: #999;
  font-style: italic;
  font-size: 13px;
}

.statut-block.empty label {
  color: #444;
  font-weight: 500;
  font-size: 14px;
}
.statut-publication label {
    min-width: 180px;
    font-weight: 600;
    color: #6E6D55;
}
</style>
<script>


 // get master by id

 document.addEventListener('DOMContentLoaded', () => {
  fetch(PMSettings.apiUrl, {
    headers: { 'X-WP-Nonce': PMSettings.nonce }
  })
    .then(res => res.json())
    .then(data => {
      const urlParams = new URLSearchParams(window.location.search);
      const masterId = parseInt(urlParams.get("id"), 10);

      const master = data.find(m => parseInt(m.id, 10) === masterId);
      if (!master) return alert("Master introuvable.");

      loadMasterGeneralForm(master);
      loadMasterIntoForm2(master);


      
      chargerAnneesUniversitaires(master);

        // ✅ Corrigé : utilise bien le cycle passé
      window.openmodalConditions = function (cycle) {
        showAdmissionModal(cycle);
        loadAdmissionForm(master, cycle);
      }

      window.openmodalConditions2 = function (cycle) {
        showAdmissionModal(cycle);
        loadAdmissionForm(master, cycle);
      }

      


    


      // 🟥 Titre
      document.querySelector(".master-title").innerHTML =
        `<img class="icon_img" src="/imagesMaster/servicemaster_images/2274790.png"> ${master.nature} : ${master.intitule_master}`;

      // 🟧 Informations générales
      /*const info2 = document.querySelectorAll(".infoM > div");
      if (info2.length >= 8) {
        info2[0].textContent = master.nature ?? '-';
        info2[1].textContent = master.domaine ?? '-';
        info2[2].textContent = master.mention ?? '-';
        info2[3].textContent = master.parcours ?? '-';
        info2[4].textContent = master.code_interne ?? '-';
        info2[5].textContent = master.intitule_master ?? '-';
        info2[6].textContent = master.debut_annee_habilitation ?? '-';
        info2[7].textContent = master.fin_annee_habilitation ?? '-';
      }*/
     // 🟧 Informations générales
      const infoSpans = document.querySelectorAll(".master-details span");

      if (infoSpans.length >= 8) {
        infoSpans[0].textContent = master.nature ?? '-';
        infoSpans[1].textContent = master.domaine ?? '-';
        infoSpans[2].textContent = master.mention ?? '-';
        infoSpans[3].textContent = master.parcours ?? '-';
        infoSpans[4].textContent = master.code_interne ?? '-';
        infoSpans[5].textContent = master.intitule_master ?? '-';
        infoSpans[6].textContent = master.debut_annee_habilitation ?? '-';
        infoSpans[7].textContent = master.fin_annee_habilitation ?? '-';
      }

    /*
      // 🟨 Coordinateur
      const coord = master.coordinateur ?? {};
      const coordDivs = document.querySelectorAll(".InfoC > div");
      document.querySelector(".avatar").src = coord.avatar || '/imagesMaster/servicemaster.jpg';

      function safe(value) {
        return value && value.trim() !== '' ? value : '-';
      }

      if (coordDivs.length >= 5) {
        coordDivs[0].textContent = safe(coord.display_name);
        coordDivs[1].textContent = safe(coord.grade);
        coordDivs[2].textContent = safe(coord.specialite);
        coordDivs[3].textContent = safe(coord.email);
        coordDivs[4].textContent = safe(coord.tel);
      }

      */

      // 🟨 Coordinateur
      const coord = master.coordinateur ?? {};
      const coordSpans = document.querySelectorAll(".master-details2 span");

      // Mise à jour avatar
      document.querySelector(".avatar").src = coord.avatar || '/imagesMaster/servicemaster.jpg';

    

      // Fonction de fallback
      function safe(value) {
        return value && value.trim() !== '' ? value : '-';
      }

      // Injection dans les <span>
      if (coordSpans.length >= 5) {
        coordSpans[0].textContent = safe(coord.display_name);
        coordSpans[1].textContent = safe(coord.grade);
        coordSpans[2].textContent = safe(coord.specialite);
        coordSpans[3].textContent = safe(coord.email);
        coordSpans[4].textContent = safe(coord.tel);
      }


     // Objectifs généraux
     const objGen = master.objectifs_generaux ?? [];
      const containerGen = document.querySelector('.master-block3.objectifs_generaux');
      if (containerGen) {
        containerGen.innerHTML = '';
        if (Array.isArray(objGen) && objGen.length > 0) {
          const ul = document.createElement('ul');
          ul.classList.add('objectifs_liste');
          objGen.forEach(text => {
            const li = document.createElement('li');
            li.textContent = text;
            ul.appendChild(li);
          });
          containerGen.appendChild(ul);
        } else {
          containerGen.textContent = 'Non spécifié.';
        }
      }

      // Objectifs spécifiques
      const objSpe = master.objectifs_specifiques ?? [];
      const containerSpe = document.querySelector('.master-block3.objectifs_specifiques');
      if (containerSpe) {
        containerSpe.innerHTML = '';
        if (Array.isArray(objSpe) && objSpe.length > 0) {
          const ul = document.createElement('ul');
          ul.classList.add('objectifs_liste');
          objSpe.forEach(text => {
            const li = document.createElement('li');
            li.textContent = text;
            ul.appendChild(li);
          });
          containerSpe.appendChild(ul);
        } else {
          containerSpe.textContent = 'Non spécifié.';
        }
      }
  

      // 🟫 Admission
         console.log(master);
    console.log(master.admission);

        // 🟫 Admission
      // 🟫 Admission M1
    const admissionM1 = master.admission?.M1;
    const admissionM2 = master.admission?.M2;
  

      // 🔹 Affichage M1
      if (admissionM1) {
        const containerM1 = document.getElementById("conditions-m1");
        if (containerM1) {
          containerM1.innerHTML = '';
          const champsM1 = [
            admissionM1.diplomes_requis ?? '-',
            admissionM1.procedure_selection ?? '-',
            admissionM1.nb_places ?? '-',
            admissionM1.criteres_admission ?? '-',
            admissionM1.public_vise ?? '-'
          ];
          champsM1.forEach((valeur, index) => {
            const div = document.createElement('div');
            div.innerHTML = `${valeur}`;
            containerM1.appendChild(div);
          });
        }
      }

      // 🔹 Affichage M2
      if (admissionM2) {
        const containerM2 = document.getElementById("conditions-m2");
        if (containerM2) {
          containerM2.innerHTML = '';
          const champsM2 = [
            admissionM2.diplomes_requis ?? '-',
            admissionM2.procedure_selection ?? '-',
            admissionM2.nb_places ?? '-',
            admissionM2.criteres_admission ?? '-',
            admissionM2.public_vise ?? '-'
          ];
          champsM2.forEach((valeur, index) => {
            const div = document.createElement('div');
            div.innerHTML = ` ${valeur}`;
            containerM2.appendChild(div);
          });
        }
      }


      const statut = master.statut_coordinateur ?? {};
      const container = document.getElementById("statut-publication");

      if (container) {
         console.log(statut.statut_coordinateur);
        const badge = container.querySelector(".badge-publie");
        const date = container.querySelector(".statut-date");
        const user = container.querySelector(".statut-user");

        if (statut.statut_coordinateur) {
          badge.textContent = statut.statut_coordinateur;
          date.textContent = `le ${new Date(statut.date_statut_coordinateur).toLocaleString('fr-FR')}`;
          user.textContent = statut.user_nom ? `(par ${statut.user_nom})` : '';
        } else {
          badge.textContent = "Non publié";
          date.textContent = "";
          user.textContent = "";
        }
      }




      // 🟪 Score
      /*const scoreDiv = document.querySelector(".score-box .master-block3.p-3 div");
      if (scoreDiv) {
        scoreDiv.textContent = master.formule_score ?? '-';
      }*/


      /*
      const scoreM1 = document.getElementById("scoreM1");
      const scoreM2 = document.getElementById("scoreM2");

      if (scoreM1) {
        scoreM1.textContent = master.formule_score_M1 ?? '-';
      }

      if (scoreM2) {
        scoreM2.textContent = master.formule_score_M2 ?? '-';
      }
        */

        // Ajout affichage formule par diplôme
      const scoreM1 = document.getElementById("scoreM1");
      if (scoreM1) {
        const formuleM1 = master.formule_score?.M1 ?? null;
        if (formuleM1 && typeof formuleM1 === 'object') {
          const html = Object.entries(formuleM1)
            .map(([mention, formule]) => `<div><strong>${mention} :</strong> ${formule}</div>`) 
            .join('');
          scoreM1.innerHTML = html || '-';
        } else {
          scoreM1.textContent = master.formule_score_M1 ?? '-';
        }
      }

      const scoreM2 = document.getElementById("scoreM2");
      if (scoreM2) {
        const formuleM2 = master.formule_score?.M2 ?? null;
        if (formuleM2 && typeof formuleM2 === 'object') {
          const html = Object.entries(formuleM2)
            .map(([mention, formule]) => `<div><strong>${mention} :</strong> ${formule}</div>`) 
            .join('');
          scoreM2.innerHTML = html || '-';
        } else {
          scoreM2.textContent = master.formule_score_M2 ?? '-';
        }
      }



      // 🟨 Plan d'étude
      const btnDownload = document.querySelector('.plan-box .btn.red');
      if (btnDownload && master.plan_etude_pdf) {
        btnDownload.onclick = () => window.open(master.plan_etude_pdf, '_blank');
      }

    })
    .catch(err => {
      console.error("Erreur API master:", err);
      alert("Erreur lors du chargement de la fiche master.");
    });
});



document.addEventListener("DOMContentLoaded", function () {
  // Ciblage de l'image cliquable
  const editBtn = document.querySelector('img.icon_img4.btn');

  // Ciblage du modal
  const modal = document.getElementById("modalOverlay");

  if (editBtn && modal) {
    editBtn.addEventListener("click", function () {
      modal.style.display = "flex"; // ou "block" selon ton CSS
    });
  }

  // Fermer le modal si on clique en dehors
  modal.addEventListener("click", function (e) {
    if (e.target === modal) {
      modal.style.display = "none";
    }
  });
});

function reloadMasterData() {

  fetch(PMSettings.apiUrl, {
    headers: { 'X-WP-Nonce': PMSettings.nonce }
  })
    .then(res => res.json())
    .then(data => {
      const urlParams = new URLSearchParams(window.location.search);
      const masterId = parseInt(urlParams.get("id"), 10);
      const master = data.find(m => parseInt(m.id, 10) === masterId);
      if (!master) return alert("Master introuvable.");

       loadMasterIntoForm(master); // recharge le formulaire si ouvert

        // ✅ Corrigé : utilise bien le cycle passé
      window.openmodalConditions = function (cycle) {
        showAdmissionModal(cycle);
        loadAdmissionForm(master, cycle);
      }

      window.openmodalConditions2 = function (cycle) {
        showAdmissionModal(cycle);
        loadAdmissionForm(master, cycle);
      }
      
      // Re-remplir les blocs HTML
      document.querySelector(".master-title").innerHTML =
        `<img class="icon_img" src="/imagesMaster/servicemaster_images/2274790.png"> ${master.nature} : ${master.intitule_master}`;

      const info2 = document.querySelectorAll(".infoM > div");
      if (info2.length >= 8) {
        info2[0].textContent = master.nature ?? '-';
        info2[1].textContent = master.domaine ?? '-';
        info2[2].textContent = master.mention ?? '-';
        info2[3].textContent = master.parcours ?? '-';
        info2[4].textContent = master.code_interne ?? '-';
        info2[5].textContent = master.intitule_master ?? '-';
        info2[6].textContent = master.debut_annee_habilitation ?? '-';
        info2[7].textContent = master.fin_annee_habilitation ?? '-';

        
      /*  info2[6].textContent = master.debut_habilitation ?? '-';
        info2[7].textContent = master.fin_habilitation ?? '-';*/
      }


      const infoSpans = document.querySelectorAll(".master-details span");

      if (infoSpans.length >= 8) {
        infoSpans[0].textContent = master.nature ?? '-';
        infoSpans[1].textContent = master.domaine ?? '-';
        infoSpans[2].textContent = master.mention ?? '-';
        infoSpans[3].textContent = master.parcours ?? '-';
        infoSpans[4].textContent = master.code_interne ?? '-';
        infoSpans[5].textContent = master.intitule_master ?? '-';
        infoSpans[6].textContent = master.debut_annee_habilitation ?? '-';
        infoSpans[7].textContent = master.fin_annee_habilitation ?? '-';
      }

      const coord = master.coordinateur ?? {};
      const coordDivs = document.querySelectorAll(".InfoC > div");
      document.querySelector(".avatar").src = coord.avatar || '/imagesMaster/servicemaster.jpg';

      const safe = val => val && val.trim() !== '' ? val : '-';
      if (coordDivs.length >= 5) {
        coordDivs[0].textContent = safe(coord.display_name);
        coordDivs[1].textContent = safe(coord.grade);
        coordDivs[2].textContent = safe(coord.specialite);
        coordDivs[3].textContent = safe(coord.email);
        coordDivs[4].textContent = safe(coord.tel);
      }

     // Objectifs généraux
     const objGen = master.objectifs_generaux ?? [];
      const containerGen = document.querySelector('.master-block3.objectifs_generaux');
      if (containerGen) {
        containerGen.innerHTML = '';
        if (Array.isArray(objGen) && objGen.length > 0) {
          const ul = document.createElement('ul');
          ul.classList.add('objectifs_liste');
          objGen.forEach(text => {
            const li = document.createElement('li');
            li.textContent = text;
            ul.appendChild(li);
          });
          containerGen.appendChild(ul);
        } else {
          containerGen.textContent = 'Non spécifié.';
        }
      }

      // Objectifs spécifiques
      const objSpe = master.objectifs_specifiques ?? [];
      const containerSpe = document.querySelector('.master-block3.objectifs_specifiques');
      if (containerSpe) {
        containerSpe.innerHTML = '';
        if (Array.isArray(objSpe) && objSpe.length > 0) {
          const ul = document.createElement('ul');
          ul.classList.add('objectifs_liste');
          objSpe.forEach(text => {
            const li = document.createElement('li');
            li.textContent = text;
            ul.appendChild(li);
          });
          containerSpe.appendChild(ul);
        } else {
          containerSpe.textContent = 'Non spécifié.';
        }
      }


        const admissionM1 = master.admission?.M1;
    const admissionM2 = master.admission?.M2;
  

      // 🔹 Affichage M1
      if (admissionM1) {
        const containerM1 = document.getElementById("conditions-m1");
        if (containerM1) {
          containerM1.innerHTML = '';
          const champsM1 = [
            admissionM1.diplomes_requis ?? '-',
            admissionM1.procedure_selection ?? '-',
            admissionM1.nb_places ?? '-',
            admissionM1.criteres_admission ?? '-',
            admissionM1.public_vise ?? '-'
          ];
          champsM1.forEach((valeur, index) => {
            const div = document.createElement('div');
            div.innerHTML = `${valeur}`;
            containerM1.appendChild(div);
          });
        }
      }

      // 🔹 Affichage M2
      if (admissionM2) {
        const containerM2 = document.getElementById("conditions-m2");
        if (containerM2) {
          containerM2.innerHTML = '';
          const champsM2 = [
            admissionM2.diplomes_requis ?? '-',
            admissionM2.procedure_selection ?? '-',
            admissionM2.nb_places ?? '-',
            admissionM2.criteres_admission ?? '-',
            admissionM2.public_vise ?? '-'
          ];
          champsM2.forEach((valeur, index) => {
            const div = document.createElement('div');
            div.innerHTML = ` ${valeur}`;
            containerM2.appendChild(div);
          });
        }
      }

      const statut = master.statut_publication ?? {};
      if (statut.etat_publication) {
        const container = document.getElementById("statut-publication");

        const badge = document.createElement("span");
        badge.className = "badge badge-publie";
        badge.textContent = statut.etat_publication;

        const date = document.createElement("span");
        date.className = "statut-date";
        date.textContent = `le ${new Date(statut.date_etat_publication).toLocaleString('fr-FR')}`;

        const user = document.createElement("span");
        user.className = "statut-user";
        user.textContent = `(par ${statut.user_nom || '---'})`;

        container.append("Statut de publication :", badge, date, user);
      }




      /*
      const scoreDiv = document.querySelector(".score-box .master-block3.p-3 div");
      if (scoreDiv) {
        scoreDiv.textContent = master.formule_score ?? '-';
      }
        */
      const scoreM1 = document.getElementById("scoreM1");
      const scoreM2 = document.getElementById("scoreM2");

      if (scoreM1) {
        scoreM1.textContent = master.formule_score_M1 ?? '-';
      }

      if (scoreM2) {
        scoreM2.textContent = master.formule_score_M2 ?? '-';
      }

      const btnDownload = document.querySelector('.plan-box .btn.red');
      if (btnDownload && master.plan_etude_pdf) {
        btnDownload.onclick = () => window.open(master.plan_etude_pdf, '_blank');
      }

    })
    .catch(err => {
      console.error("Erreur API master:", err);
      alert("Erreur lors du chargement de la fiche master.");
    });
}
document.addEventListener("DOMContentLoaded", () => {
 // const btn = document.getElementById("btnPublierWeb");
/*
  if (btn) {
    btn.addEventListener("click", () => {
      if (confirm("Êtes-vous sûr de vouloir publier ce master sur le site vitrine ?")) {
        const urlParams = new URLSearchParams(window.location.search);
        const masterId = parseInt(urlParams.get("id"), 10);

        fetch(`/wp-json/plateforme-master/v1/publier/${masterId}`, {
          method: 'POST',
          headers: {
            'X-WP-Nonce': PMSettings.nonce
          }
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert("✅ Publication effectuée avec succès !");
            reloadMasterData();
          } else {
            alert("❌ Échec de la publication.");
          }
        })
        .catch(err => {
          console.error("Erreur API :", err);
          alert("❌ Erreur lors de la publication.");
        });
      }
    });
  }
*/
/*
const btn = document.getElementById('btnPublierEspace');

if (btn) {
  btn.addEventListener("click", async () => {
    if (confirm("Êtes-vous sûr de vouloir publier ce master sur le site vitrine ?")) {
      const urlParams = new URLSearchParams(window.location.search);
      const masterId = parseInt(urlParams.get("id"), 10);
      console.log('master_id');
      console.log(masterId);
      try {
        const res = await fetch(`/wp-json/plateforme-master/v1/statut-coordinateur/${masterId}`, {
          method: 'POST',
          headers: {
            'X-WP-Nonce': PMSettings.nonce
          }
        });

        if (!res.ok) {
          const error = await res.json();
          alert(error.message || "❌ Une erreur s’est produite lors de la publication.");
          throw new Error(error.message);
        }

        const data = await res.json();

        if (data.success) {
          alert("✅ Publication effectuée avec succès !");
          reloadMasterData();
        } else if (data.code === 'score_required') {
          alert("⚠️ Veuillez d’abord enregistrer une formule de score avant de publier ce master.");
        } else {
          alert("❌ Échec de la publication : " + (data.message || "Erreur inconnue."));
        }

      } catch (err) {
        console.error("Erreur API :", err);
        alert("❌ Une erreur réseau est survenue.");
      }
    }
  });
}

*/

document.getElementById('btnPublierEspace').addEventListener('click', async function () {
  const params = new URLSearchParams(window.location.search);
  const masterId = params.get('id');

  if (!masterId) {
    alert("Identifiant du master introuvable dans l'URL.");
    return;
  }

  try {
    const response = await fetch(`/wp-json/plateforme-master/v1/statut-coordinateur/${masterId}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': PMSettings.nonce
      },
      body: JSON.stringify({
        statut: 'publié'
      })
    });

    if (!response.ok) {
      const errorData = await response.json();
      alert(errorData.message || 'Une erreur est survenue.');
      throw new Error(errorData.message);
    }

    const data = await response.json();

  if (data.success) {
      alert('✅ Le master a été publié avec succès !');
      document.getElementById('btnPublierEspace').disabled = true;
      reloadMasterData();
    } else if (data.code === 'score_required') {
      alert('⚠️ Vous devez d’abord enregistrer une formule de score avant de publier ce master.');
    } else {
      alert('❌ Erreur : ' + (data.message || 'Erreur inconnue'));
    }
  } catch (error) {
    console.error('Erreur réseau ou serveur :', error);
    alert('❌ Une erreur réseau est survenue.');
  }
});


document.getElementById('btnPublierWeb').addEventListener('click', async function () {
  const params = new URLSearchParams(window.location.search);
  const masterId = params.get('id');

  if (!masterId) {
    alert("Identifiant du master introuvable dans l'URL.");
    return;
  }

  try {
    const response = await fetch(`/wp-json/plateforme-master/v1/publier2/${masterId}`, {  
      method: 'POST', 
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': PMSettings.nonce
      },
      body: JSON.stringify({
        statut: 'publié'
      })
    });

    if (!response.ok) {
      const errorData = await response.json();
      alert(errorData.message || 'Une erreur est survenue.');
      throw new Error(errorData.message);
    }

    const data = await response.json();

  if (data.success) {
      alert('✅ Le master a été publié avec succès !');
      document.getElementById('btnPublierEspace').disabled = true;
      reloadMasterData();
    } else if (data.code === 'score_required') {
      alert('⚠️ Vous devez d’abord enregistrer une formule de score avant de publier ce master.');
    } else {
      alert('❌ Erreur : ' + (data.message || 'Erreur inconnue'));
    }
  } catch (error) {
    console.error('Erreur réseau ou serveur :', error);
    alert('❌ Une erreur réseau est survenue.');
  }
});

  // Modules M1
  const modulesM1 = master.modules_m1 ?? [];
  const containerM1 = document.querySelector('.modules_m1 ul');
  if (containerM1) {
    containerM1.innerHTML = '';
    if (Array.isArray(modulesM1) && modulesM1.length > 0) {
      modulesM1.forEach(mod => {
        const li = document.createElement('li');
        li.textContent = mod;
        containerM1.appendChild(li);
      });
    } else {
      containerM1.innerHTML = '<li>Aucun module spécifié.</li>';
    }
  }

});





</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const addBtn = document.querySelector(".add-m2");

  addBtn.addEventListener("click", () => {
    // Vérifier si un bloc avec le titre "M2" existe déjà
    const allTitles = document.querySelectorAll(".m1-header h2");
    const m2Exists = Array.from(allTitles).some(title => title.textContent.trim() === "M2");

    if (m2Exists) {
      alert("⚠️ Le bloc M2 est déjà ajouté.");
      return;
    }
    reloadMasterData();

    // Cloner un nouveau bloc M2
    const blocM1 = document.querySelector(".bloc-m1-wrapper");

    const newBloc = document.createElement("div");
    newBloc.classList.add("bloc-m1-wrapper");
    newBloc.innerHTML = `
      <div class="m1-header">
        <h2>M2</h2>
      </div>
      <hr class="section-divider">

      <div class="master-card">
        <div class="master-header card-double">
          <div class="block-title with-icons">
            Condition d'admission
            <span class="icons">
              <img class="icon_img3" src="/imagesMaster/servicemaster_images/pdf-svgrepo-com (2).png" alt="">
              <img class="icon_img4 btn openmodalConditions2" onclick="openmodalConditions2('M2')" src="/imagesMaster/servicemaster_images/edit-2rouge.png" alt="" data-cycle="M2">
            </span>
          </div>
        </div>
        <div class="card-double">
          <div class="master-block2 p-3">
            <div><strong>Diplômes requis :</strong></div>
            <div><strong>Procédure de sélection :</strong></div>
            <div><strong>Places disponibles :</strong></div>
            <div><strong>Critères :</strong></div>
            <div><strong>Public visé :</strong></div>
          </div>
          <div class="master-block3 conditions-m2 p-3" id="conditions-m2">
            <!-- M2 dynamic content -->
          </div>
        </div>
      </div>

      <div class="master-card card2">
        <div class="score-box">
          <div class="master-header card-double">
            <div class="block-title with-icons">
              Formule de calcul du score
              <span class="icons">
                <a class="btn red" href="/formule-de-calcul-du-score?master=M2&id=<?php echo $_GET['id']; ?>" target="_blank" rel="noopener noreferrer">Configurer</a>
                
              </span>
            </div>
          </div>
          <div class="card-double">
            <div class="master-block2 p-3">
              <div><strong>Score total =</strong></div>
            </div>
            <div class="master-block3 p-3" id="scoreM2">
              <div></div>
            </div>
          </div>
        </div>
      </div>
    `;

    blocM1.parentNode.insertBefore(newBloc, blocM1.nextSibling);
  });
});

console.log("Rôle actuel :", PMSettings2.userRole);

if (PMSettings2.userRole === 'um_admin' || PMSettings2.userRole === 'um_service-master') {
  document.querySelector('.btn-publier-web')?.style.removeProperty('display');
}
if (PMSettings2.userRole === 'um_coordonnateur-master') {
  document.querySelector('.btn-publier-espace')?.style.removeProperty('display');
}
</script>
<script>

  /*
document.getElementById('btnPublierEspace').addEventListener('click', function () {
  const params = new URLSearchParams(window.location.search);
  const masterId = params.get('id'); // ex: ?id=12

  if (!masterId) {
    alert("Identifiant du master introuvable dans l'URL.");
    return;
  }

  fetch(`/wp-json/plateforme-master/v1/statut-coordinateur/${masterId}`, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json', // ✅ INDISPENSABLE
      'X-WP-Nonce': PMSettings.nonce
    },
    body: JSON.stringify({
      statut: 'publié' // ✅ master_id est déjà dans l’URL, donc pas nécessaire ici
    })
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      alert('✅ Le master a été publié avec succès !');
      document.getElementById('btnPublierEspace').disabled = true;
    } else if (data.code === 'score_required') {
      alert('⚠️ Vous devez d’abord enregistrer une formule de score avant de publier ce master.');
    } else {
      alert('❌ Erreur : ' + (data.message || 'Erreur inconnue'));
    }
  })

  .catch(error => {
    console.error('Erreur réseau :', error);
    alert('Une erreur est survenue.');
  });
});
*/

/*
document.getElementById('btnPublierEspace').addEventListener('click', async function () {
  const params = new URLSearchParams(window.location.search);
  const masterId = params.get('id');

  if (!masterId) {
    alert("Identifiant du master introuvable dans l'URL.");
    return;
  }

  try {
    const response = await fetch(`/wp-json/plateforme-master/v1/statut-coordinateur/${masterId}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': PMSettings.nonce
      },
      body: JSON.stringify({
        statut: 'publié'
      })
    });

    if (!response.ok) {
      const errorData = await response.json();
      alert(errorData.message || 'Une erreur est survenue.');
      throw new Error(errorData.message);
    }

    const data = await response.json();

  if (data.success) {
      alert('✅ Le master a été publié avec succès !');
      document.getElementById('btnPublierEspace').disabled = true;
    } else if (data.code === 'score_required') {
      alert('⚠️ Vous devez d’abord enregistrer une formule de score avant de publier ce master.');
    } else {
      alert('❌ Erreur : ' + (data.message || 'Erreur inconnue'));
    }
  } catch (error) {
    console.error('Erreur réseau ou serveur :', error);
    alert('❌ Une erreur réseau est survenue.');
  }
});
*/

</script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

