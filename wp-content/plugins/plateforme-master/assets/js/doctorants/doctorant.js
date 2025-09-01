// Fonction pour créer une inscription
async function createInscription() {
    let formData = new FormData();

    // Champs texte (match avec les "name" dans ton HTML)
    formData.append("doctorant_id", 112); // ⚠️ à remplacer dynamiquement avec l’ID du doctorant connecté
    formData.append("sujet", document.querySelector('input[name="sujet"]').value || "");
    formData.append("specialite", document.querySelector('select[name="specialite"]').value || "");
    formData.append("date_debut", document.querySelector('input[name="date_debut"]').value || "");
    formData.append("directeur_id", document.querySelector('select[name="directeur"]').value || "");
    formData.append("laboratoire", document.querySelector('select[name="laboratoire"]').value || "");
    formData.append("type_these", document.querySelector('select[name="type"]').value || "Nationale");
    formData.append("cotutelle", document.querySelector('select[name="cotutelle"]').value || "Non");

    // Champs fichiers (les inputs type="file" doivent avoir un "name" = identifiant attendu en backend)
    document.querySelectorAll('input[type="file"]').forEach((input, i) => {
        if (input.files.length > 0) {
            formData.append(input.name || "fichier" + i, input.files[0]);
        }
    });

    // Debug avant envoi (permet de vérifier ce qui part réellement)
    for (let [key, value] of formData.entries()) {
        console.log(key, value);
    }

    try {
        let response = await fetch("/wp-json/plateforme-doctorants/v1/inscriptionsthese", {
            method: "POST",
            body: formData
        });

        if (!response.ok) {
            throw new Error("Erreur HTTP : " + response.status);
        }

        let data = await response.json();
        console.log("Inscription créée :", data);
        alert(data.message || "Inscription créée avec succès !");
    } catch (err) {
        console.error("Erreur création inscription :", err);
        alert("Échec lors de la création de l'inscription.");
    }
}



// Fonction pour mettre à jour une inscription existante
async function updateInscription(id) {
    let formData = new FormData();

    // Champs texte
    formData.append("sujet", document.querySelector('input[placeholder="Sujet"]').value || "Optimisation des réseaux hybrides");
    formData.append("specialite", document.querySelector('select[name="specialite"]').value || "Informatique");
    formData.append("date_debut", document.querySelector('input[type="date"]').value || "2024-11-01");
    formData.append("directeur_id", document.querySelector('select[name="directeur"]').value || 1);
    formData.append("laboratoire", document.querySelector('select[name="laboratoire"]').value || "LIPAH");
    formData.append("type_these", document.querySelector('select[name="type"]').value || "Nationale");
    formData.append("cotutelle", document.querySelector('select[name="cotutelle"]').value || "Non");
    formData.append("statut", "En cours");

    // Fichiers (si nouveaux)
    document.querySelectorAll('input[type="file"]').forEach((input, i) => {
        if (input.files.length > 0) {
            formData.append(input.name || "fichier" + i, input.files[0]);
        }
    });

    try {
        let response = await fetch(`/wp-json/plateforme-doctorants/v1/inscriptionsthese/${id}`, {
            method: "POST", // ⚠️ pour FormData il faut souvent POST + _method=PUT
            body: formData
        });
        let data = await response.json();
        console.log("Inscription mise à jour :", data);
        alert(data.message);
    } catch (err) {
        console.error("Erreur mise à jour inscription :", err);
    }
}

// Exemple : attacher un bouton
document.addEventListener("DOMContentLoaded", () => {
    document.querySelector("#btnCreate").addEventListener("click", createInscription);
    document.querySelector("#btnUpdate").addEventListener("click", () => updateInscription(5)); // ID fictif
});

async function getInscription(id) {
    try {
        let response = await fetch(`/wp-json/plateforme-doctorants/v1/inscriptionsthese/${id}`);
        let data = await response.json();

        console.log("Données inscription :", data);

        if (!data) return;

        // === Champs texte / select ===
        document.querySelector('input[name="sujet"]').value = data.sujet || "";
        document.querySelector('select[name="specialite"]').value = data.specialite || "";
        document.querySelector('input[name="date_debut"]').value = data.date_debut || "";
        document.querySelector('select[name="directeur"]').value = data.directeur_id || "";
        document.querySelector('select[name="laboratoire"]').value = data.laboratoire || "";
        document.querySelector('select[name="type"]').value = data.type_these || "Nationale";
        document.querySelector('select[name="cotutelle"]').value = data.cotutelle || "Non";

        // === Champs fichier ===
        const fichiers = [
            'fichier_diplome',
            'fichier_releve_notes',
            'fichier_cv',
            'fichier_lettre',
            'fichier_accord_encadrant',
            'fichier_attestation_financement'
        ];
        fichiers.forEach(f => {
            if (data[f]) {
                const el = document.querySelector(`#${f}`);
                if (el) el.value = data[f].split('/').pop();
            }
        });

        // === Badge statut ===
        const badge = document.querySelector('.badge-validation');
        if (badge) {
            let statutText = data.statut || "En cours de validation par l'École Doctorale";
            badge.innerHTML = `<span class="dot"></span> ${statutText}`;
            badge.classList.remove("badge-valide", "badge-refuse", "badge-validation");
            switch (data.statut) {
                case "Validé": badge.classList.add("badge-valide"); break;
                case "Refusé": badge.classList.add("badge-refuse"); break;
                default: badge.classList.add("badge-validation");
            }
        }

        // === Dernière mise à jour ===
        const dernierInscription = document.querySelector('#dernier_inscription');
        if (dernierInscription) {
            dernierInscription.textContent = data.date_update || data.date_update || "Non renseigné";
        }

        // === Encadrant / Directeur de thèse ===
        const encadrant = document.querySelector('#encadrant');
        if (encadrant) {
            // Si le nom du directeur est déjà inclus dans la réponse API
            encadrant.textContent = data.directeur_nom || "Non renseigné";
        }

    } catch (err) {
        console.error("Erreur récupération inscription :", err);
    }
}




// Charger par défaut l’inscription ID=5 (exemple)
document.addEventListener("DOMContentLoaded", () => {
    getInscription(PMSettings.userId); // 
});

async function setupInscriptionButton(doctorantId) {
    const container = document.querySelector(".card-section"); // conteneur pour footer
    if (!container) return;

    // Créer le footer si inexistant
    let footer = container.querySelector(".card-footer");
    if (!footer) {
        footer = document.createElement("div");
        footer.className = "card-footer text-right mt-3";
        container.appendChild(footer);
    }

    // Vérifier si inscription existe
    let inscriptionExists = false;
    try {
        const response = await fetch(`/wp-json/plateforme-doctorants/v1/inscriptionsthese/${doctorantId}`);
        if (response.ok) {
            const data = await response.json();
            if (data && data.id) {
                inscriptionExists = true;
                // Pré-remplir le formulaire via ta fonction existante
                getInscription(doctorantId);
            }
        }
    } catch (err) {
        console.warn("Aucune inscription existante", err);
    }

    // Créer le bouton
    footer.innerHTML = ""; // vider les anciens boutons
    const btn = document.createElement("button");
    btn.type = "button";
    btn.className = "btn btn-danger";
    btn.innerHTML = inscriptionExists ? '<i class="fas fa-save"></i> Mettre à jour' : '<i class="fas fa-plus"></i> Créer';
    footer.appendChild(btn);

    // Ajouter la fonction de clic
    btn.addEventListener("click", async () => {
        const dataForm = {
            doctorant_id: doctorantId,
            sujet: document.querySelector('input[name="sujet"]').value,
            specialite: document.querySelector('select[name="specialite"]').value,
            date_debut: document.querySelector('input[name="date_debut"]').value,
            directeur_id: document.querySelector('select[name="directeur"]').value,
            laboratoire: document.querySelector('select[name="laboratoire"]').value,
            type_these: document.querySelector('select[name="type"]').value,
            cotutelle: document.querySelector('select[name="cotutelle"]').value
        };

        try {
            const url = inscriptionExists
                ? `/wp-json/plateforme-doctorants/v1/inscriptionsthese/${doctorantId}`
                : `/wp-json/plateforme-doctorants/v1/inscriptionsthese`;
            const method = inscriptionExists ? "PUT" : "POST";

            const response = await fetch(url, {
                method: method,
                headers: {
                    "Content-Type": "application/json",
                    "X-WP-Nonce": PMSettings.nonce
                },
                body: JSON.stringify(dataForm)
            });

            const result = await response.json();
            alert(inscriptionExists ? "Mise à jour réussie !" : "Inscription créée !");
            if (!inscriptionExists) location.reload(); // recharger pour passer en mode update
        } catch (err) {
            console.error(err);
            alert("Erreur lors de l'opération");
        }
    });
}

// Exemple d'appel :
setupInscriptionButton(PMSettings.userId);




// Fonction pour charger les spécialités de thèse et remplir le select
async function loadSpecialites() {
    try {
        const response = await fetch('/wp-json/plateforme-doctorants/v1/specialites');
        if (!response.ok) throw new Error(`Erreur HTTP ${response.status}`);

        const data = await response.json();

        const select = document.querySelector('select[name="specialite"]');
        if (!select) return;

        // Réinitialiser le select
        select.innerHTML = '<option value="">-- Sélectionner une spécialité --</option>';

        // Ajouter les options depuis l'API
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.code; // ou item.id si tu préfères
            option.textContent = item.intitule + (item.domaine ? ` (${item.domaine})` : '');
            select.appendChild(option);
        });

    } catch (error) {
        console.error("Erreur chargement spécialités :", error);
    }
}

// Appel automatique au chargement de la page
document.addEventListener('DOMContentLoaded', loadSpecialites);

  

async function loadDirecteurs() {
    try {
        const response = await fetch('/wp-json/plateforme-doctorants/v1/directeurs-these-by-institut', {
            credentials: 'include',  // envoi le cookie WordPress
            headers: {
                'X-WP-Nonce': PMSettings.nonce
            }
        });

        if (!response.ok) throw new Error(`Erreur HTTP ${response.status}`);

        const data = await response.json();

        const select = document.querySelector('select[name="directeur"]');
        if (!select) return;

        select.innerHTML = '<option value="">-- Sélectionner un directeur --</option>';
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.nom + (item.email ? ` (${item.email})` : '');
            select.appendChild(option);
        });

        // Exemple d'utilisation de role et userId
        console.log('Utilisateur connecté :', PMSettings.userId, 'Rôle :', PMSettings.role);

    } catch (error) {
        console.error("Erreur chargement directeurs :", error);
    }
}



// Charger après que le DOM soit prêt
document.addEventListener('DOMContentLoaded', loadDirecteurs);



async function loadLaboratoires() {
    try {
        const response = await fetch('/wp-json/plateforme-doctorants/v1/laboratoires', {
            credentials: 'include',
            headers: {
                'X-WP-Nonce': PMSettings.nonce // si nonce est utilisé pour sécuriser
            }
        });

        if (!response.ok) throw new Error(`Erreur HTTP ${response.status}`);

        const data = await response.json();
        console.log("Laboratoires :", data);

        // Exemple : remplir un select
        const select = document.querySelector('select[name="laboratoire"]');
        if (select) {
            select.innerHTML = '<option value="">-- Sélectionner un laboratoire --</option>';
            data.forEach(labo => {
                const option = document.createElement('option');
                option.value = labo.id;
                option.textContent = labo.denomination + (labo.code ? ` (${labo.code})` : '');
                select.appendChild(option);
            });
        }

    } catch (error) {
        console.error("Erreur chargement laboratoires :", error);
    }
}

// Charger après que le DOM soit prêt
document.addEventListener('DOMContentLoaded', loadLaboratoires);


