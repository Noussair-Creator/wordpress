<?php
// Charger WordPress
$wp_load = '/home/utmresearchplatform/public_html/wp-load.php';

if (file_exists($wp_load)) {
    require_once($wp_load);
} else {
    exit("❌ wp-load.php introuvable. Vérifiez le chemin absolu.\n");
}

global $wpdb;

// Slug => Nouveau titre
$pages_update = [
    'mes-doctorants_directeurth'                  => 'Mes Doctorants',
    'fiche-individuelle-du-doctorant_directeurth' => 'Fiche Individuelle du Doctorant',
    'planning-des-r-eunions_directeurth'          => 'Planning des Réunions',
    'fiche-candidatures-ed_directeurth'           => 'Fiche Candidatures ED',
    'evaluations-et-rapports_directeurth'         => 'Évaluations et Rapports',
    'fiche-d-evaluation-annuelle_directeurth'     => 'Fiche d’Évaluation Annuelle',
    'suivi-des-d-ep-ots_directeurth'              => 'Suivi des Dépôts',
    'fiche-de-d-ep-ot_directeurth'                => 'Fiche de Dépôt',
    'progression_directeurth'                     => 'Progression',
    'planification-des-soutenances_directeurth'   => 'Planification des Soutenances',
    'publications-et-communications_directeurth'  => 'Publications et Communications',
];

// Parcours des slugs à mettre à jour
foreach ($pages_update as $slug => $new_title) {

    // Récupérer l'ID de la page existante
    $post_id = $wpdb->get_var($wpdb->prepare(
        "SELECT ID FROM {$wpdb->prefix}posts WHERE post_name = %s AND post_type = 'page'",
        $slug
    ));

    if ($post_id) {
        // Mettre à jour le titre de la page
        $updated = $wpdb->update(
            "{$wpdb->prefix}posts",
            [ 'post_title' => $new_title ],
            [ 'ID' => $post_id ],
            [ '%s' ],
            [ '%d' ]
        );

        if ($updated !== false) {
            echo "✅ Page '$slug' mise à jour : nouveau titre = '$new_title'. (ID: $post_id)\n";
        } else {
            echo "⚠️ Impossible de mettre à jour le titre de la page '$slug'. (ID: $post_id)\n";
        }
    } else {
        echo "❌ Page '$slug' introuvable dans la base de données.\n";
    }

    echo "--------------------------------------------\n";
}

echo "🎯 Mise à jour des titres terminée.\n";
