<?php


$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role = $roles[0] ?? null;

$base_data = [
    'user' => get_user_meta($current_user->ID, 'first_name', true) . ' ' . get_user_meta($current_user->ID, 'last_name', true),
    'photo' => get_avatar_url($current_user->ID),
];



// Configuration dynamique par rôle
$roleConfigs = [
    "um_ecole_doctorale" => [
        "label" => "ÉCOLE DOCTORALE",
        "menu" => [
            ["label" => "Dashboard", "lien" => "/espace_ecole_doctorale"],
            ["label" => "Membres", "lien" => "/membres"],
            ["label" => "Inscription & Réinscription", "lien" => "/inscription-et-reinscription"],
            ["label" => "Commissions doctorales", "lien" => "/commission-doctorale-ecole-doctorale"],
            ["label" => "Soutenances", "lien" => "/soutenances-ecole-doctorale"],
            ["label" => "Habilitations", "lien" => "#"],
            ["label" => "Établissements & Structures", "lien" => "#"],
            ["label" => "Statistiques", "lien" => "#"],
            ["label" => "Rapports", "lien" => "#"],
            ["label" => "Bibliothèque", "lien" => "#"],
            ["label" => "Budgets", "lien" => "#"],
            ["label" => "Contacts", "lien" => "/contacts-ecole-doctorale"],
            ["label" => "Réclamations", "lien" => "#"]
        ],
        "calendriers" => [
            "Manifestation",
            "Stages/Missions",
            "Journées d'étude",
            "Événements"
        ],
        "inscriptions" => [
            "En attente",
            "Validées",
            "Refusées"
        ],
        "membres_ed" => [
            "Directeurs De These Habilités",
            "Cadre Administratif",
            "Directeurs De Labo",
            "Doctorants"
        ],
        "theses_habilitations" => [
            "En cours",
            "Validées"
        ],
        "video_link" => "https://meet.example.com/ecole-doctorale"
    ],

    "um_directeur_these" => [
        "label" => "DIRECTEUR DE THÈSE",
        "menu" => [
            ["label" => "Dashboard", "lien" => "/espace_directeurthese"],
            ["label" => "Mes Doctorants", "lien" => "/mes-doctorants_directeurth"],
            ["label" => "Planning des Réunions", "lien" => "/planning-des-r-eunions_directeurth"],
            ["label" => "Documents", "lien" => "#"],
            ["label" => "Contacts", "lien" => "#"],
            ["label" => "Réunions", "lien" => "/reunions-ed"],
            ["label" => "Réclamations", "lien" => "#"]
        ],
        "calendriers" => [
            "Soutenances",
            "Conférences",
            "Séminaires",
            "Journées d'étude"
        ],
        "demandes" => [
            "En attente",
            "Validées",
            "Refusées"
        ],
        "disponibilites" => [
            "Présence",
            "Stages",
            "Missions"
        ],
        "soutenances" => [
            "En cours",
            "Validées"
        ],
        "statistiques" => [
            "1ère année" => 40,
            "2ème année" => 15,
            "3ème année" => 12,
            "4ème année" => 23,
            "5ème année" => 5
        ],
        "sections_central" => [
            "Manifestations scientifiques",
            "Evaluations et rapports",
            "Suivi des dépôts",
            "Doctorants",
            "Progression",
            "Planification des soutenances",
            "Publications et communications",
            "GED"
        ],
        "video_link" => "https://meet.example.com/directeur-these"
    ],

    "um_commission_ed" => [
        "label" => "COMMISSION DOCTORALE",
        "menu" => [
            ["label" => "Dashboard", "lien" => "/espace-comissioned"],
            ["label" => "Membres", "lien" => "#"],
            ["label" => "Inscription & Réinscription", "lien" => "/inscription-et-reinscription"],
            ["label" => "Commissions doctorales", "lien" => "/comissions-doctorale_comissioned"],
            ["label" => "Soutenances", "lien" => "/soutenances_comissioned"],
            ["label" => "Habilitations", "lien" => "#"],
            ["label" => "Établissements & Structures", "lien" => "#"],
            ["label" => "Statistiques & Rapports", "lien" => "#"],
            ["label" => "Réunions", "lien" => "#"],
            ["label" => "Contacts", "lien" => "#"],
            ["label" => "Réclamations", "lien" => "#"]
        ],

        "calendriers" => [
            "Réunions",
            "Conférences",
            "Séminaires",
            "Journées d'étude"
        ],

        "demandes" => [
            "En attente",
            "Validées",
            "Refusées"
        ],

        "progression" => [
            "Rapports",
            "Thèses"
        ],

        "etat_theses" => [
            "En cours",
            "Soutenues",
            "En attente"
        ],

        "statistiques_dossiers" => [
            "Accepté" => 1800,
            "Refusé" => 1200,
            "Ajourné" => 1500,
            "En cours" => 2400
        ],

        "sections_central" => [
            "Candidatures ED",
            "Formations Doctorales",
            "Pré-Soutenances / Soutenances",
            "Financements et Conformité",
            "Comités De Suivi",
            "Jurys / Rapporteurs",
            "GED"
        ],

        "video_link" => "https://meet.example.com/commission-doctorale"
    ],
    "um_doctorant" => [
        "label" => "ESPACE DOCTORANT",
        "menu" => [
            ["label" => "Dashboard", "lien" => "/espace-doctorant"],
            ["label" => "Mon Dossier", "lien" => "#"],
            ["label" => "Documents", "lien" => "#"],
            ["label" => "Planning", "lien" => "#"],
            ["label" => "Réunions", "lien" => "#"],
            ["label" => "État de progression", "lien" => "#"],
            ["label" => "Suivi des soutenances", "lien" => "#"],
            ["label" => "Formations doctorales", "lien" => "#"],
            ["label" => "Réclamations", "lien" => "#"]
        ],

        "calendriers" => [
            "Soutenances",
            "Conférences",
            "Séminaires",
            "Formations Doctorales"
        ],

        "demandes" => [
            "En attente",
            "Validé",
            "Refusé"
        ],

        "suivi_progression" => [
            "Rapports annuels",
            "Réunions de suivi",
            "Avis du directeur"
        ],

        "formations" => [
            "Validées",
            "À suivre",
            "En cours"
        ],

        "stats_progression" => [
            "1ère année" => 62,
            "2ème année" => 45,
            "3ème année" => 38,
            "4ème année" => 12,
            "5ème année" => 3
        ],

        "sections_central" => [
            "État du dossier",
            "Progression académique",
            "Planning et disponibilités",
            "Encadrement",
            "Publications",
            "Documents partagés",
            "Réclamations"
        ],

        "video_link" => "https://meet.example.com/doctorant"
    ],

    "um_service-utm" => [
        "label" => "SERVICE UTM",
        "menu" => [
            ["label" => "Dashboard", "lien" => "/espace-utm"],

            [
                "label" => "Écoles Doctorales",
                "lien" => "#",
                "submenu" => [
                    ["label" => "Dashboard", "lien" => "/espace-ecoledoctorale/"],
                    ["label" => "Membres", "lien" => "#"],
                    ["label" => "Inscription & Réinscription", "lien" => "#"],
                    ["label" => "Commissions doctorales", "lien" => "#"],
                    ["label" => "Soutenances", "lien" => "#"],
                    ["label" => "Habilitations", "lien" => "#"],
                    ["label" => "Établissements & Structures", "lien" => "#"],
                    ["label" => "Budgets", "lien" => "#"],
                ]
            ],

            [
                "label" => "Master",
                "lien" => "#",
                "submenu" => [
                    ["label" => "Dashboard", "lien" => "/espace-master"],
                    ["label" => "Candidatures", "lien" => "#"],
                    ["label" => "Plans d’études", "lien" => "#"],
                    ["label" => "Stages & entreprises", "lien" => "#"],
                    ["label" => "Soutenances", "lien" => "#"]
                ]
            ],

            [
                "label" => "Laboratoires de recherche",
                "lien" => "#",
                "submenu" => [
                    ["label" => "Dashboard", "lien" => "/espace-labo"],
                    ["label" => "Laboratoires de recherche", "lien" => "/liste-de-laboratoires"],
                    ["label" => "Membres", "lien" => "#"],
                    ["label" => "Projets", "lien" => "#"],
                    ["label" => "Activités", "lien" => "#"],
                    ["label" => "Publications", "lien" => "#"],
                    ["label" => "Partenariats", "lien" => "#"],
                    ["label" => "Budgets", "lien" => "#"],
                ]
            ],

            ["label" => "USCR", "lien" => "#"],
            ["label" => "Statistiques", "lien" => "#"],
            ["label" => "Rapports", "lien" => "#"],
            ["label" => "Bibliothèque", "lien" => "#"],
            ["label" => "Budgets", "lien" => "#"],
            ["label" => "Contacts", "lien" => "#"],
            ["label" => "Réclamations", "lien" => "#"],
        ],
        "calendriers" => [
            "Manifestation",
            "Stages/Missions",
            "Journées d'étude",
            "Événements"
        ],
        "inscriptions" => [
            "En attente",
            "Validées",
            "Refusées"
        ],
        "membres_ed" => [
            "Directeurs De These Habilités",
            "Cadre Administratif",
            "Directeurs De Labo",
            "Doctorants"
        ],
        "theses_habilitations" => [
            "En cours",
            "Validées"
        ],
        "presence" => [
            "Présence au laboratoire",
            "Stages",
            "Missions"
        ],
        "fiche_labo" => [
            "Code LR" => "97GHO2",
            "Etab. de rattachement" => "FST",
            "Date de création" => "15/10/2018",
            "Direction" => "Mr. AHMED BEN AHMED"
        ],
        "financements" => [
            "Financement National" => 60,
            "International" => 15,
            "Partenariat privé" => 25
        ],
        "etat_projets" => [
            "Projet A" => 60,
            "Projet B" => 30,
            "Projet C" => 0,
            "Projet D" => 100
        ],
        "sections_central" => [
            "Activités scientifiques",
            "Réseaux de la recherche",
            "Activités quotidiennes",
            "Programmes & projets de recherche",
            "Reservation des équipements, salles",
            "GED"
        ],
        "actualites" => [
            "L’IA au service des enseignants"
        ],
        "manifestations" => [
            "Manifestations scientifiques"
        ],
        "boite_info" => [
            ["titre" => "Comment protéger ma recherche ?", "lien" => "#"],
            ["titre" => "Comment diffuser ma recherche ?", "lien" => "#"],
            ["titre" => "La charte et procédures de publication", "lien" => "#"],
            ["titre" => "Éthique, Déontologie et Intégrité", "lien" => "#"]
        ],
        "video_link" => "https://meet.example.com/service-utm"
    ],
    "um_service-etablissement" => [
        "label" => "DIRECTEUR ÉTABLISSEMENT",
        "menu" => [
            ["label" => "Dashboard", "lien" => "#"],

            [
                "label" => "Écoles Doctorales",
                "lien" => "#",
                "submenu" => [
                    ["label" => "Dashboard", "lien" => "/espace-ecoledoctorale/"],
                    ["label" => "Membres", "lien" => "#"],
                    ["label" => "Inscription & Réinscription", "lien" => "#"],
                    ["label" => "Commissions doctorales", "lien" => "#"],
                    ["label" => "Soutenances", "lien" => "#"],
                    ["label" => "Habilitations", "lien" => "#"],
                    ["label" => "Établissements & Structures", "lien" => "#"],
                    ["label" => "Budgets", "lien" => "#"],
                ]
            ],

            [
                "label" => "Master",
                "lien" => "#",
                "submenu" => [
                    ["label" => "Dashboard", "lien" => "/espace-master"],
                    ["label" => "Candidatures", "lien" => "#"],
                    ["label" => "Plans d’études", "lien" => "#"],
                    ["label" => "Stages & entreprises", "lien" => "#"],
                    ["label" => "Soutenances", "lien" => "#"]
                ]
            ],

            [
                "label" => "Laboratoires de recherche",
                "lien" => "#",
                "submenu" => [
                    ["label" => "Dashboard", "lien" => "/espace-labo"],
                    ["label" => "Membres", "lien" => "#"],
                    ["label" => "Projets", "lien" => "#"],
                    ["label" => "Activités", "lien" => "#"],
                    ["label" => "Publications", "lien" => "#"],
                    ["label" => "Partenariats", "lien" => "#"],
                    ["label" => "Budgets", "lien" => "#"],
                ]
            ],
            ["label" => "USCR", "lien" => "#"],
            ["label" => "Statistiques", "lien" => "#"],
            ["label" => "Rapports", "lien" => "#"],
            ["label" => "Bibliothèque", "lien" => "#"],
            ["label" => "Budgets", "lien" => "#"],
            ["label" => "Contacts", "lien" => "#"],
            ["label" => "Réclamations", "lien" => "#"],
        ],
        "calendriers" => [
            "Manifestation",
            "Stages/Missions",
            "Journées d'étude",
            "Événements"
        ],
        "inscriptions" => [
            "En attente",
            "Validées",
            "Refusées"
        ],
        "membres_ed" => [
            "Directeurs De These Habilités",
            "Cadre Administratif",
            "Directeurs De Labo",
            "Doctorants"
        ],
        "theses_habilitations" => [
            "En cours",
            "Validées"
        ],
        "presence" => [
            "Présence au laboratoire",
            "Stages",
            "Missions"
        ],
        "fiche_labo" => [
            "Code LR" => "97GHO2",
            "Etab. de rattachement" => "FST",
            "Date de création" => "15/10/2018",
            "Direction" => "Mr. AHMED BEN AHMED"
        ],
        "financements" => [
            "Financement National" => 60,
            "International" => 15,
            "Partenariat privé" => 25
        ],
        "etat_projets" => [
            "Projet A" => 60,
            "Projet B" => 30,
            "Projet C" => 0,
            "Projet D" => 100
        ],
        "sections_central" => [
            "Activités scientifiques",
            "Réseaux de la recherche",
            "Activités quotidiennes",
            "Programmes & projets de recherche",
            "Reservation des équipements, salles",
            "GED"
        ],
        "actualites" => [
            "L’IA au service des enseignants"
        ],
        "manifestations" => [
            "Manifestations scientifiques"
        ],
        "boite_info" => [
            ["titre" => "Comment protéger ma recherche ?", "lien" => "#"],
            ["titre" => "Comment diffuser ma recherche ?", "lien" => "#"],
            ["titre" => "La charte et procédures de publication", "lien" => "#"],
            ["titre" => "Éthique, Déontologie et Intégrité", "lien" => "#"]
        ],
        "video_link" => "https://meet.example.com/service-utm"
    ],

];

// Fusion finale du profil dynamique
$data = array_merge($base_data, $roleConfigs[$role] ?? []);

?>