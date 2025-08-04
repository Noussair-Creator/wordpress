<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class CandidatureService {
    public static function insertCandidature(PDO $pdo, array $data): int {
        $sql = "INSERT INTO utm_master_candidats (
            nom, nom_ar, prenom, prenom_ar,
            date_naissance, lieu_naissance, lieu_naissance_ar,
            nationalite, nationalite_ar, cin, passport, IdentifiantUnique,
            email1, email2, telephone, sexe, statut_etudiant, photo_path
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
        $stmt = $pdo->prepare($sql);
    
        $stmt->execute([
            $data['nom'],
            $data['nom_ar'],
            $data['prenom'],
            $data['prenom_ar'],
            $data['datenaissance'],
            $data['lieunaissance'],
            $data['lieunaissance_ar'],
            $data['nationalite'],
            $data['nationalite_ar'],
            $data['cin'],
            $data['cne'],
            $data['IdentifiantUnique'],
            $data['email'],
            $data['email2'],
            $data['telephone'],
            $data['sexe'] ?? null,
            $data['statut_etudiant'] ?? null,
            $data['photo_path'] ?? null
        ]);

    

    
        return $pdo->lastInsertId();
    }
    

    public static function insertAdresse(PDO $pdo, int $candidat_id, array $data, string $type = 'personnelle'): void {
        $sql = "INSERT INTO utm_master_candidats_adresses (
            candidat_id, type_adresse, adresse_fr, adresse_ar, gouvernorat_fr, gouvernorat_ar,
            delegation_fr, delegation_ar, code_postal
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $candidat_id, $type,
            $data['adresse'], $data['adresseAr'],
            $data['gouvernorat'], $data['gouvernoratAr'],
            $data['delegation'], $data['delegationAr'],
            $data['code_postal']
        ]);
    }

    // get Nationalites
    public static function getNationalites(PDO $pdo): array {
        $stmt = $pdo->query("SELECT id, intitule, intitule_ar FROM utm_master_nationalites ORDER BY intitule");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


