<?php
/*header('Content-Type: application/json');

// Connexion DB (adapter selon votre serveur)
$host = 'localhost';
$db   = 'utmsearch_w';
$user = 'phpmyadmin';
$pass = 'admin';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Requête pour récupérer les masters dont la session est publiée
    $sql = "
        SELECT 
            s.id AS session_id,
            s.master_id,
            s.intitule_session,
            s.etat,
            s.date_creation,
            s.date_modification,

            m.id AS master_id,
            m.intitule_master AS intitule_master,
            m.code_interne,
            m.parcours,
            m.domaine,
            m.nature_id,
            n.libelle AS nature_libelle,
            m.mention_id,
            mn.libelle AS mention_libelle,
            m.debut_habilitation,
            m.fin_habilitation,
            m.plan_etude_pdf,

            m.diplomes_requis,
            m.procedure_selection,
            m.nb_places,
            m.criteres_admission,
            m.public_vise,

            m.formule_score

        FROM utm_master_sessions s
        JOIN utm_master_fichemaster m ON s.master_id = m.id
        LEFT JOIN utm_master_score sc ON m.id = sc.master_id
        LEFT JOIN utm_master_nature n ON m.nature_id = n.id
        LEFT JOIN utm_master_mention mn ON m.mention_id = mn.id
        WHERE s.etat = 'publié web'
        ORDER BY s.date_creation DESC
    ";


    $stmt = $pdo->query($sql);
    $masters = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Ajouter les objectifs (généraux et spécifiques)
    foreach ($masters as &$master) {
        $master_id = $master['master_id'];

        $objStmt = $pdo->prepare("SELECT type, contenu FROM utm_master_objectifs WHERE master_id = ?");
        $objStmt->execute([$master_id]);
        $objectifs = $objStmt->fetchAll(PDO::FETCH_ASSOC);

        $master['objectifs_generaux'] = array_values(array_filter($objectifs, fn($o) => $o['type'] === 'general'));
        $master['objectifs_specifiques'] = array_values(array_filter($objectifs, fn($o) => $o['type'] === 'specifique'));
    }

    echo json_encode([
        'status' => 'success',
        'data' => $masters
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
*/


header('Content-Type: application/json');

// Connexion DB (adapter selon votre serveur)
$host = 'localhost';
$db   = 'utmsearch_w';
$user = 'phpmyadmin';
$pass = 'admin';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Base de la requête
    $where = "s.etat = 'publié web'";
    $params = [];

    // Si un institut_id est passé en paramètre GET
    if (isset($_GET['institut_id']) && is_numeric($_GET['institut_id'])) {
        $where .= " AND m.institut_id = ?";
        $params[] = $_GET['institut_id'];
    }

    // Requête avec jointures
    $sql = "
        SELECT 
            s.id AS session_id,
            s.master_id,
            s.intitule_session,
            s.etat,
            s.date_creation,
            s.date_modification,

            m.id AS master_id,
            m.intitule_master AS intitule_master,
            m.code_interne,
            m.parcours,
            m.domaine,
            m.nature_id,
            n.libelle AS nature_libelle,
            m.mention_id,
            mn.libelle AS mention_libelle,
            m.debut_habilitation,
            m.fin_habilitation,
            m.plan_etude_pdf,
            m.institut_id,

            m.diplomes_requis,
            m.procedure_selection,
            m.nb_places,
            m.criteres_admission,
            m.public_vise,

            m.formule_score

        FROM utm_master_sessions s
        JOIN utm_master_fichemaster m ON s.master_id = m.id
        LEFT JOIN utm_master_score sc ON m.id = sc.master_id
        LEFT JOIN utm_master_nature n ON m.nature_id = n.id
        LEFT JOIN utm_master_mention mn ON m.mention_id = mn.id
        WHERE $where
        ORDER BY s.date_creation DESC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $masters = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Ajouter les objectifs (généraux et spécifiques)
    foreach ($masters as &$master) {
        $master_id = $master['master_id'];

        $objStmt = $pdo->prepare("SELECT type, contenu FROM utm_master_objectifs WHERE master_id = ?");
        $objStmt->execute([$master_id]);
        $objectifs = $objStmt->fetchAll(PDO::FETCH_ASSOC);

        $master['objectifs_generaux'] = array_values(array_filter($objectifs, fn($o) => $o['type'] === 'general'));
        $master['objectifs_specifiques'] = array_values(array_filter($objectifs, fn($o) => $o['type'] === 'specifique'));
    }

    echo json_encode([
        'status' => 'success',
        'data' => $masters
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
