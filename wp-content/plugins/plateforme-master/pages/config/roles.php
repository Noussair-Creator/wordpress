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
  "um_service-master" => [
    "label" => "SERVICE MASTER",
    "menu" => [
      ["label" => "Dashboard",       "lien" => "/espace-service"],
      ["label" => "Candidatures",    "lien" => "/candidature"],
      ["label" => "Statistiques",    "lien" => "#"],
      ["label" => "Stages",          "lien" => "#"],
      ["label" => "Soutenances",     "lien" => "#"],
      ["label" => "Rapports",        "lien" => "#"],
      ["label" => "Bibliothèque",    "lien" => "#"],
      ["label" => "Contacts",        "lien" => "#"],
      ["label" => "Réclamations",    "lien" => "#"],
    ],
    "calendriers" => [
      "Candidature",
      "Inscription",
      "Examen",
      "Inscription sujet",
      "Dépôt de soutenance"
    ],
    "assiduite" => ["Présence", "Stages"],
    "video_link" => "https://meet.example.com/service-master"
  ],

  "um_coordonnateur-master" => [
    "label" => "COORDINATEUR MASTER",
    "menu" => [
      ["label" => "Dashboard",                "lien" => "/espace-coordinateur"],
      ["label" => "Candidatures",             "lien" => "/candidature"],
      ["label" => "Entretiens",             "lien" => "/entretien"],
      ["label" => "Encadrements",             "lien" => "#"],
      ["label" => "Statistiques",             "lien" => "#"],
      ["label" => "Conventions & entreprises","lien" => "#"],
      ["label" => "Soutenances",              "lien" => "#"],
      ["label" => "Sujets des mémoires",      "lien" => "#"],
      ["label" => "Rapports",                 "lien" => "#"],
      ["label" => "Bibliothèque",             "lien" => "#"],
      ["label" => "Contacts",                 "lien" => "#"],
      ["label" => "Réclamations",             "lien" => "#"],
    ],
    "calendriers" => [
      "Candidature",
      "Inscription",
      "Examen",
      "Dépôt de soutenance"
    ],
    "assiduite" => ["Présence", "Stages"],
    "video_link" => "https://meet.example.com/coordinateur"
  ],
  "um_student_master" => [
      "label" => "ÉTUDIANT(E) MASTER",
       "menu" => [
        ["label" => "Dashboard",              "lien" => "/MASTER/DashboardStudent.php"],
        ["label" => "Détails Master",         "lien" => "#"],
        ["label" => "Supports pédagogiques",  "lien" => "#"],
        ["label" => "Statistiques",           "lien" => "#"],
        ["label" => "Service Administratifs", "lien" => "#"],
        ["label" => "Direction des stages",   "lien" => "#"],
        ["label" => "Soutenances",            "lien" => "#"],
        ["label" => "Rapports",               "lien" => "#"],
        ["label" => "Bibliothèque",           "lien" => "#"],
        ["label" => "Contacts",               "lien" => "#"],
        ["label" => "Réclamations",           "lien" => "#"],
      ],
      "calendriers" => [
        "Examens",
        "Rattrapage",
        "Soutenances"
      ],
      "assiduite" => ["Présence", "Stages"],
      "video_link" => "https://meet.example.com/etudiant"
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
            "Candidature",
            "Inscription",
            "Examen",
            "Inscription sujet",
            "Depot de soutenance"
        ],
        "assiduite" => ["Présence", "Stages"],
        "master_stats" => [
            ["label" => "Master professionnel", "count" => 12],
            ["label" => "Master de recherche", "count" => 11],
            ["label" => "Master é distance", "count" => 7]
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
            "Candidature", "Inscription", "Examen", "Inscription sujet", "Dépôt de soutenance"
        ],
        "assiduite" => ["Présence", "Stages"],
        "video_link" => "https://meet.example.com/service-utm"
    ],


];

// Fusion finale du profil dynamique
$data = array_merge($base_data, $roleConfigs[$role] ?? []);

?>