<?php


$current_user = wp_get_current_user();
$roles = (array) $current_user->roles;
$role = $roles[0] ?? null;
global $wpdb;



$base_data = [
  'user' => get_user_meta($current_user->ID, 'first_name', true) . ' ' . get_user_meta($current_user->ID, 'last_name', true),
  'photo' => get_avatar_url($current_user->ID),
];

$profil_id = get_user_meta($current_user->ID, 'profil_id', true);
$base_data['profil_id'] = $profil_id;


$profil_nom = $wpdb->get_var($wpdb->prepare("SELECT nom FROM utm_profils WHERE id = %d", $profil_id));
$base_data['profil_nom'] = $profil_nom ?: '';

// 2. Récupérer les titres des rubriques associées à ce profil
$titres_rubriques = [];

if ($profil_id) {
   
     $titres_rubriques = $wpdb->get_col($wpdb->prepare("
        SELECT r.titre
        FROM utm_profils_rubriques pr
        JOIN utm_rubriques r ON r.id = pr.rubrique_id
        WHERE pr.profil_id = %d and `type` = 'menu'
    ", $profil_id));

      $titres_rubriques = $titres_rubriques ?: [];
}

$base_data['rubriques'] = $titres_rubriques ?: [];


// Configuration dynamique par rôle
$roleConfigs = [

  "um_directeur_laboratoire" => [
  "label" => "DIRECTEUR DU LABO DE RECHERCHE",
  "menu" => [
      ["label" => "Dashboard",                 "lien" => "/espace-directeur-labo"],
      ["label" => "Membres",                   "lien" => "#"],
      ["label" => "Projets",                   "lien" => "#"],
      ["label" => "Activités",                 "lien" => "#"],
      ["label" => "Bibliothèque",              "lien" => "#"],
      ["label" => "Publications",              "lien" => "#"],
      ["label" => "Partenariats",              "lien" => "#"],
      ["label" => "Budgets",                   "lien" => "#"],
      ["label" => "Rapports",                  "lien" => "#"],
      ["label" => "Réunions",                  "lien" => "#"],
      ["label" => "Contacts",                  "lien" => "#"],
      ["label" => "Réclamations",              "lien" => "#"]
  ],
  "calendriers" => [
      "Colloques",
      "Conférences",
      "Séminaires",
      "Journées d'étude"
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
  "video_link" => "https://meet.example.com/directeur-labo"
],
"um_chercheur" => [
  "label" => "CHERCHEUR",
  "menu" => [
      ["label" => "Dashboard",                                       "lien" => "/espace-chercheur"],
      ["label" => "Membres",                                         "lien" => "#"],
      ["label" => "Projets",                                         "lien" => "#"],
      ["label" => "Activités",                                       "lien" => "#"],
      ["label" => "Bibliothèque",                                    "lien" => "#"],
      ["label" => "Publications",                                    "lien" => "#"],
      ["label" => "Partnerships",                                    "lien" => "#"],
      ["label" => "Budgets",                                         "lien" => "#"],
      ["label" => "Rapports",                                        "lien" => "#"],
      ["label" => "Réunions",                                        "lien" => "#"],
      ["label" => "Contacts",                                        "lien" => "#"],
      ["label" => "Réclamations",                                    "lien" => "#"],
      ["label" => "Réservation des équipements, salles et ateliers", "lien" => "#"],
      
  ],
  "calendriers" => [
      "Colloques",
      "Conférences",
      "Séminaires",
      "Journées d'étude"
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
      "Financement National" => 63,
      "International" => 0,
      "Partenariat privé" => 0
  ],
  "etat_projets" => [
      "Phase 1" => 70,
      "Phase 2" => 50,
      "Phase 3" => 85,
      "Phase 4" => 65,
      "Phase 5" => 52
  ],
  "sections_central" => [
      "Activités scientifiques",
      "Membres du laboratoire",
      "Programmes & projets de recherches",
      "GED",
      "Activités quotidiennes",
      "Partenaires & coopérations"
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
  "video_link" => "https://meet.example.com/chercheur"
],

    "um_service-utm" => [
        "label" => "SERVICE UTM",
        "menu" => [
            ["label" => "Dashboard", "lien" => "/espace-utm"],

            [
                "label" => "Écoles Doctorales", "lien" => "#", "submenu" => [
                    ["label" => "Dashboard",                   "lien" => "/espace-ecoledoctorale/"],
                    ["label" => "Membres",                     "lien" => "#"],
                    ["label" => "Inscription & Réinscription", "lien" => "#"],
                    ["label" => "Commissions doctorales",      "lien" => "#"],
                    ["label" => "Soutenances",                 "lien" => "#"],
                    ["label" => "Habilitations",               "lien" => "#"],
                    ["label" => "Établissements & Structures", "lien" => "#"],
                    ["label" => "Budgets",                     "lien" => "#"],
                ]
            ],

            [
                "label" => "Master", "lien" => "#", "submenu" => [
                    ["label" => "Dashboard",           "lien" => "/espace-master"],
                    ["label" => "Candidatures",        "lien" => "#"],
                    ["label" => "Plans d’études",      "lien" => "#"],
                    ["label" => "Stages & entreprises","lien" => "#"],
                    ["label" => "Soutenances",         "lien" => "#"]
                ]
            ],

            [
                "label" => "Laboratoires de recherche", "lien" => "#", "submenu" => [
                    ["label" => "Dashboard",     "lien" => "/espace-labo"],
                    ["label" => "Membres",       "lien" => "#"],
                    ["label" => "Projets",       "lien" => "#"],
                    ["label" => "Activités",     "lien" => "#"],
                    ["label" => "Publications",  "lien" => "#"],
                    ["label" => "Partenariats",  "lien" => "#"],
                    ["label" => "Budgets",       "lien" => "#"],
                ]
            ],

            ["label" => "USCR",          "lien" => "#"],
            ["label" => "Statistiques",  "lien" => "#"],
            ["label" => "Rapports",      "lien" => "#"],
            ["label" => "Bibliothèque",  "lien" => "#"],
            ["label" => "Budgets",       "lien" => "#"],
            ["label" => "Contacts",      "lien" => "#"],
            ["label" => "Réclamations",  "lien" => "#"],
        ],
        "calendriers" => [
            "Colloques",
            "Conférences",
            "Séminaires",
            "Journées d'étude"
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
                "label" => "Écoles Doctorales", "lien" => "#", "submenu" => [
                    ["label" => "Dashboard",                   "lien" => "/espace-ecoledoctorale/"],
                    ["label" => "Membres",                     "lien" => "#"],
                    ["label" => "Inscription & Réinscription", "lien" => "#"],
                    ["label" => "Commissions doctorales",      "lien" => "#"],
                    ["label" => "Soutenances",                 "lien" => "#"],
                    ["label" => "Habilitations",               "lien" => "#"],
                    ["label" => "Établissements & Structures", "lien" => "#"],
                    ["label" => "Budgets",                     "lien" => "#"],
                ]
            ],

            [
                "label" => "Master", "lien" => "#", "submenu" => [
                    ["label" => "Dashboard",           "lien" => "/espace-master"],
                    ["label" => "Candidatures",        "lien" => "#"],
                    ["label" => "Plans d’études",      "lien" => "#"],
                    ["label" => "Stages & entreprises","lien" => "#"],
                    ["label" => "Soutenances",         "lien" => "#"]
                ]
            ],

            [
                "label" => "Laboratoires de recherche", "lien" => "#", "submenu" => [
                    ["label" => "Dashboard",     "lien" => "/espace-labo"],
                    ["label" => "Membres",       "lien" => "#"],
                    ["label" => "Projets",       "lien" => "#"],
                    ["label" => "Activités",     "lien" => "#"],
                    ["label" => "Publications",  "lien" => "#"],
                    ["label" => "Partenariats",  "lien" => "#"],
                    ["label" => "Budgets",       "lien" => "#"],
                ]
            ],
            ["label" => "USCR",          "lien" => "#"],
            ["label" => "Statistiques",  "lien" => "#"],
            ["label" => "Rapports",      "lien" => "#"],
            ["label" => "Bibliothèque",  "lien" => "#"],
            ["label" => "Budgets",       "lien" => "#"],
            ["label" => "Contacts",      "lien" => "#"],
            ["label" => "Réclamations",  "lien" => "#"],
        ],
          "calendriers" => [
                "Colloques",
                "Conférences",
                "Séminaires",
                "Journées d'étude"
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

// Filtrage direct du menu selon les rubriques autorisées
if ($role === 'um_chercheur' && !empty($data['menu']) && !empty($titres_rubriques)) {
    $authorized_titles = array_map('strtolower', $titres_rubriques);

    $data['menu'] = array_filter($data['menu'], function($item) use ($authorized_titles) {
        return in_array(strtolower($item['label']), $authorized_titles);
    });

    $data['menu'] = array_values($data['menu']); // Réindexation propre
}


?>