<?php
/*
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once(__DIR__ . '/../../wp-load.php');

require_once '../db.php';
require_once '../services/CandidatureService.php';

try {
    // Récupérer les données JSON et les fichiers
    //$input = $_POST;

    $input = $_POST;



    // Champs toujours requis
    $alwaysRequired = [
        'nom', 'nom_ar', 'prenom', 'prenom_ar',
        'datenaissance', 'lieunaissance', 'lieunaissance_ar',
        'nationalite', 'nationalite_ar', 'email', 'telephone',
        'adresse', 'adresseAr', 'gouvernorat', 'gouvernoratAr',
        'delegation', 'delegationAr', 'code_postal'
    ];

    // Champs conditionnels
    $isTunisien = strtolower(trim($input['nationalite_ar'])) === '200';

    if ($isTunisien) {
        $conditionalRequired = ['cin'];
    } else {
        $conditionalRequired = ['cne', 'IdentifiantUnique'];
    }

    // Fusion
    $requiredFields = array_merge($alwaysRequired, $conditionalRequired);

    // Validation
    foreach ($requiredFields as $field) {
        if (!isset($input[$field]) || trim($input[$field]) === '') {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => "Champ requis manquant : $field"]);
            exit;
        }
    }


    // Gestion de l'upload de la photo
    $photoPath = null;
    if (!empty($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];

        if (!in_array($ext, $allowed)) {
            throw new Exception("Format de fichier non autorisé. Formats acceptés : JPG, JPEG, PNG.");
        }

        if ($_FILES['photo']['size'] > 2 * 1024 * 1024) { // 2 Mo max
            throw new Exception("Fichier trop volumineux. Taille max : 2 Mo.");
        }

        $filename = uniqid('photo_') . '.' . $ext;
        $uploadDir = __DIR__ . '/../DossierCandidats/';
        $relativePath = 'DossierCandidats/' . $filename;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $filename)) {
            $photoPath = $relativePath;
        }
    }

    $input['photo_path'] = $photoPath;

    // 1. Insertion du candidat
    $id = CandidatureService::insertCandidature($pdo, $input);

    // 2. Adresse personnelle
    CandidatureService::insertAdresse($pdo, $id, [
        'adresse'       => $input['adresse'],
        'adresseAr'     => $input['adresseAr'],
        'gouvernorat'   => $input['gouvernorat'],
        'gouvernoratAr' => $input['gouvernoratAr'],
        'delegation'    => $input['delegation'],
        'delegationAr'  => $input['delegationAr'],
        'code_postal'   => $input['code_postal']
    ], 'personnelle');

    // 3. Adresse parentale (si fournie)
    if (!empty($input['adresse_parent'])) {
        CandidatureService::insertAdresse($pdo, $id, [
            'adresse'       => $input['adresse_parent'],
            'adresseAr'     => $input['adresseAr_parent'],
            'gouvernorat'   => $input['gouvernorat_parent'],
            'gouvernoratAr' => $input['gouvernoratAr_parent'],
            'delegation'    => $input['delegation_parent'],
            'delegationAr'  => $input['delegationAr_parent'],
            'code_postal'   => $input['code_postal_parent']
        ], 'parentale');
    }

    // 4. Création de l'utilisateur WordPress
    $username = sanitize_user(strtolower($input['prenom']) . '.' . strtolower($input['nom']) . rand(100, 999));
    $email    = sanitize_email($input['email']);
    $password = wp_generate_password(10, true, true);

    $user_id = wp_create_user($username, $password, $email);

    if (!is_wp_error($user_id)) {
        wp_update_user([
            'ID' => $user_id,
            'display_name' => $input['prenom'] . ' ' . $input['nom']
        ]);
        $user = new WP_User($user_id);
        $user->set_role('um_candidat');

        // Pour le plugin email-inscription
        update_user_meta($user_id, 'registration_source', 'candidature');
        update_user_meta($user_id, 'raw_password', $password);
    } else {
        error_log('Erreur création utilisateur : ' . $user_id->get_error_message());
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Candidature enregistrée, utilisateur créé',
        'candidat_id' => $id,
        'user_id' => $user_id,
        'photo_path' => $photoPath
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

*/


header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');



require_once(__DIR__ . '/../../wp-load.php');
require_once '../db.php';
require_once '../services/CandidatureService.php';

try {
    $input = $_POST;

    // Champs requis systématiquement
    $alwaysRequired = [
        'nom', 'nom_ar', 'prenom', 'prenom_ar',
        'datenaissance', 'lieunaissance', 'lieunaissance_ar',
        'nationalite', 'nationalite_ar', 'email', 'telephone',
        'adresse', 'adresseAr', 'gouvernorat', 'gouvernoratAr',
        'delegation', 'delegationAr', 'code_postal'
    ];

    // Champs conditionnels : nationalité tunisienne = 200
    $isTunisien = trim($input['nationalite_ar']) === '200' || trim($input['nationalite']) === '200';

    $conditionalRequired = $isTunisien ? ['cin'] : ['cne', 'IdentifiantUnique'];
    $requiredFields = array_merge($alwaysRequired, $conditionalRequired);

    foreach ($requiredFields as $field) {
        if (!isset($input[$field]) || trim($input[$field]) === '') {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => "Champ requis manquant : $field"]);
            exit;
        }
    }

    // 📷 Upload photo
    $photoPath = null;
    if (!empty($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png'];
        if (!in_array($ext, $allowed)) throw new Exception("Format non autorisé.");
        if ($_FILES['photo']['size'] > 2 * 1024 * 1024) throw new Exception("Fichier trop volumineux (max 2 Mo).");

        $filename = uniqid('photo_') . '.' . $ext;
        $uploadDir = __DIR__ . '/../DossierCandidats/';
        $relativePath = 'DossierCandidats/' . $filename;
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $filename)) {
            $photoPath = $relativePath;
        }
    }

    $input['photo_path'] = $photoPath;

    // ✅ 1. Insertion candidat
    $id = CandidatureService::insertCandidature($pdo, $input);

    // ✅ 2. Adresse personnelle
    CandidatureService::insertAdresse($pdo, $id, [
        'adresse'       => $input['adresse'],
        'adresseAr'     => $input['adresseAr'],
        'gouvernorat'   => $input['gouvernorat'],
        'gouvernoratAr' => $input['gouvernoratAr'],
        'delegation'    => $input['delegation'],
        'delegationAr'  => $input['delegationAr'],
        'code_postal'   => $input['code_postal']
    ], 'personnelle');

    // ✅ 3. Adresse parentale (si présente)
    if (!empty($input['adresse_parent'])) {
        CandidatureService::insertAdresse($pdo, $id, [
            'adresse'       => $input['adresse_parent'],
            'adresseAr'     => $input['adresseAr_parent'],
            'gouvernorat'   => $input['gouvernorat_parent'],
            'gouvernoratAr' => $input['gouvernoratAr_parent'],
            'delegation'    => $input['delegation_parent'],
            'delegationAr'  => $input['delegationAr_parent'],
            'code_postal'   => $input['code_postal_parent']
        ], 'parentale');
    }

    // ✅ 4. Créer utilisateur WordPress avec login = email
    $username = sanitize_user($input['email']); // login = email
    $email    = sanitize_email($input['email']);
    $password = wp_generate_password(10, true, true);

    $user_id = wp_create_user($username, $password, $email);

    if (!is_wp_error($user_id)) {
        wp_update_user([
            'ID' => $user_id,
            'display_name' => $input['prenom'] . ' ' . $input['nom']
        ]);
        $user = new WP_User($user_id);
        $user->set_role('um_candidat');

        update_user_meta($user_id, 'registration_source', 'candidature');
        update_user_meta($user_id, 'raw_password', $password);
    } else {
        error_log('Erreur création utilisateur WP : ' . $user_id->get_error_message());
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Candidature enregistrée, utilisateur créé',
        'candidat_id' => $id,
        'user_id' => $user_id,
        'photo_path' => $photoPath
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
