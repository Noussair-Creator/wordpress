-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for utmsearch_w
CREATE DATABASE IF NOT EXISTS `utmsearch_w` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `utmsearch_w`;

-- Dumping structure for table utmsearch_w.demo_entity
CREATE TABLE IF NOT EXISTS `demo_entity` (
  `id` bigint NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.msg_attachments
CREATE TABLE IF NOT EXISTS `msg_attachments` (
  `id` bigint unsigned NOT NULL,
  `message_id` bigint unsigned NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mime_type` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `file_size` bigint unsigned NOT NULL,
  `storage_url` varchar(1024) COLLATE utf8mb4_general_ci NOT NULL,
  `sha256` char(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.msg_drafts
CREATE TABLE IF NOT EXISTS `msg_drafts` (
  `id` bigint unsigned NOT NULL,
  `thread_id` bigint unsigned DEFAULT NULL,
  `author_id` bigint unsigned NOT NULL,
  `body` mediumtext COLLATE utf8mb4_general_ci,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.msg_labels
CREATE TABLE IF NOT EXISTS `msg_labels` (
  `id` bigint unsigned NOT NULL,
  `owner_user_id` bigint unsigned NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `color` char(7) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.msg_messages
CREATE TABLE IF NOT EXISTS `msg_messages` (
  `id` bigint unsigned NOT NULL,
  `thread_id` bigint unsigned NOT NULL,
  `sender_id` bigint unsigned NOT NULL,
  `body` mediumtext COLLATE utf8mb4_general_ci,
  `body_plain` text COLLATE utf8mb4_general_ci,
  `reply_to_id` bigint unsigned DEFAULT NULL,
  `has_attachments` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.msg_message_labels
CREATE TABLE IF NOT EXISTS `msg_message_labels` (
  `message_id` bigint unsigned NOT NULL,
  `label_id` bigint unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.msg_message_mentions
CREATE TABLE IF NOT EXISTS `msg_message_mentions` (
  `message_id` bigint unsigned NOT NULL,
  `mentioned_user_id` bigint unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.msg_read_receipts
CREATE TABLE IF NOT EXISTS `msg_read_receipts` (
  `message_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `read_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.msg_threads
CREATE TABLE IF NOT EXISTS `msg_threads` (
  `id` bigint unsigned NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_group` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `archived_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.msg_thread_participants
CREATE TABLE IF NOT EXISTS `msg_thread_participants` (
  `thread_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `role` enum('owner','member','guest') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'member',
  `notif_pref` enum('all','mentions','none') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'all',
  `joined_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `left_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.rm_ck_user_permissions
CREATE TABLE IF NOT EXISTS `rm_ck_user_permissions` (
  `id` int NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `etablissement_id` int NOT NULL,
  `module_key` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `action_key` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.test_access_table
CREATE TABLE IF NOT EXISTS `test_access_table` (
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_actionscheduler_actions
CREATE TABLE IF NOT EXISTS `utm_actionscheduler_actions` (
  `action_id` bigint unsigned NOT NULL,
  `hook` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `scheduled_date_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `scheduled_date_local` datetime DEFAULT '0000-00-00 00:00:00',
  `priority` tinyint unsigned NOT NULL DEFAULT '10',
  `args` varchar(191) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `schedule` longtext COLLATE utf8mb4_unicode_520_ci,
  `group_id` bigint unsigned NOT NULL DEFAULT '0',
  `attempts` int NOT NULL DEFAULT '0',
  `last_attempt_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `last_attempt_local` datetime DEFAULT '0000-00-00 00:00:00',
  `claim_id` bigint unsigned NOT NULL DEFAULT '0',
  `extended_args` varchar(8000) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_actionscheduler_claims
CREATE TABLE IF NOT EXISTS `utm_actionscheduler_claims` (
  `claim_id` bigint unsigned NOT NULL,
  `date_created_gmt` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_actionscheduler_groups
CREATE TABLE IF NOT EXISTS `utm_actionscheduler_groups` (
  `group_id` bigint unsigned NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_actionscheduler_logs
CREATE TABLE IF NOT EXISTS `utm_actionscheduler_logs` (
  `log_id` bigint unsigned NOT NULL,
  `action_id` bigint unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `log_date_gmt` datetime DEFAULT '0000-00-00 00:00:00',
  `log_date_local` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_candidats_annees_blanches
CREATE TABLE IF NOT EXISTS `utm_candidats_annees_blanches` (
  `id` int NOT NULL,
  `candidat_id` int NOT NULL,
  `nbannee` int DEFAULT NULL,
  `piece_jointe_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cause` text COLLATE utf8mb4_general_ci,
  `annee_ref` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_candidats_parcours_annees
CREATE TABLE IF NOT EXISTS `utm_candidats_parcours_annees` (
  `id` int NOT NULL,
  `candidat_id` int NOT NULL,
  `annee_academique` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `niveau` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `universite` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `etablissement` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `session` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mention` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `moyenne` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `credit` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `piece_jointe_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `piece_jointe_path_attestation` varchar(2000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `piece_jointe_path_releve` varchar(2000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_candidats_score_values
CREATE TABLE IF NOT EXISTS `utm_candidats_score_values` (
  `id` int NOT NULL,
  `candidature_id` int NOT NULL,
  `score_id` int NOT NULL,
  `template_id` int NOT NULL,
  `valeur_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `date_soumission` datetime DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `utm_candidats_score_values_chk_1` CHECK (json_valid(`valeur_json`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_candidats_score_valuesold
CREATE TABLE IF NOT EXISTS `utm_candidats_score_valuesold` (
  `id` int NOT NULL,
  `candidature_id` int NOT NULL,
  `score_id` int NOT NULL,
  `template_id` int NOT NULL,
  `valeur_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `date_soumission` datetime DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT `utm_candidats_score_valuesold_chk_1` CHECK (json_valid(`valeur_json`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_candidats_situation_academique
CREATE TABLE IF NOT EXISTS `utm_candidats_situation_academique` (
  `id` int NOT NULL,
  `candidat_id` int NOT NULL,
  `parcours` int NOT NULL,
  `cycle` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `annee_academique` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `baccalaureat` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `etablissement` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `session` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mention` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `moyenne` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `piece_jointe_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ajouter_annee_blanche` tinyint(1) DEFAULT '0',
  `nb_annees_blanche` int DEFAULT '0',
  `piece_jointe_blanche_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cause_blanche` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_candidatures_score_criteres
CREATE TABLE IF NOT EXISTS `utm_candidatures_score_criteres` (
  `id` int NOT NULL,
  `candidature_id` int NOT NULL,
  `critere_id` int DEFAULT NULL,
  `score_id` int DEFAULT NULL,
  `champ` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `valeur` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_candidature_choix
CREATE TABLE IF NOT EXISTS `utm_candidature_choix` (
  `id` int NOT NULL,
  `master_id` int DEFAULT NULL,
  `candidature_id` int DEFAULT NULL,
  `choix` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_candidature_decisions
CREATE TABLE IF NOT EXISTS `utm_candidature_decisions` (
  `id` int NOT NULL,
  `candidature_id` int NOT NULL,
  `type_decision` enum('préselection','finale','recours') COLLATE utf8mb4_general_ci NOT NULL,
  `statut` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `commentaire` text COLLATE utf8mb4_general_ci,
  `date_decision` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_candidature_entretiens
CREATE TABLE IF NOT EXISTS `utm_candidature_entretiens` (
  `id` int NOT NULL,
  `candidature_id` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `contenu` text COLLATE utf8mb4_general_ci,
  `date_entretien` date NOT NULL,
  `heure_entretien` time NOT NULL,
  `lieu` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `heure_effective` time DEFAULT NULL,
  `etat` enum('prévu','effectué','annulé') COLLATE utf8mb4_general_ci DEFAULT 'prévu',
  `commentaire` text COLLATE utf8mb4_general_ci,
  `note` float DEFAULT NULL,
  `document_joint` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_candidature_statuts_log
CREATE TABLE IF NOT EXISTS `utm_candidature_statuts_log` (
  `id` int NOT NULL,
  `candidature_id` int NOT NULL,
  `type_action` enum('dossier','decision') COLLATE utf8mb4_general_ci NOT NULL,
  `statut` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `commentaire` text COLLATE utf8mb4_general_ci,
  `user_id` int DEFAULT NULL,
  `date_action` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_candidat_reclamation
CREATE TABLE IF NOT EXISTS `utm_candidat_reclamation` (
  `id` int NOT NULL,
  `id_candidat` int NOT NULL,
  `topic` text COLLATE utf8mb4_general_ci NOT NULL,
  `email` text COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` text COLLATE utf8mb4_general_ci NOT NULL,
  `nom` text COLLATE utf8mb4_general_ci NOT NULL,
  `sujet` text COLLATE utf8mb4_general_ci NOT NULL,
  `message` int NOT NULL,
  `tel` text COLLATE utf8mb4_general_ci NOT NULL,
  `priorité` int NOT NULL,
  `due` datetime NOT NULL,
  `piece_jointe_path` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_categories_etablissements
CREATE TABLE IF NOT EXISTS `utm_categories_etablissements` (
  `id` int NOT NULL,
  `libelle` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_commentmeta
CREATE TABLE IF NOT EXISTS `utm_commentmeta` (
  `meta_id` bigint unsigned NOT NULL,
  `comment_id` bigint unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_comments
CREATE TABLE IF NOT EXISTS `utm_comments` (
  `comment_ID` bigint unsigned NOT NULL,
  `comment_post_ID` bigint unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_author_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `comment_karma` int NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'comment',
  `comment_parent` bigint unsigned NOT NULL DEFAULT '0',
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_id` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_contacts
CREATE TABLE IF NOT EXISTS `utm_contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `laboratoire_id` int unsigned NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `domaine` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact_tel` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `org_email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `org_tel` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logo_url` text COLLATE utf8mb4_general_ci,
  `contact_avatar_url` text COLLATE utf8mb4_general_ci,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_delegations
CREATE TABLE IF NOT EXISTS `utm_delegations` (
  `id` int NOT NULL,
  `gouvernorat_id` int NOT NULL,
  `nom_fr` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_ar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_diplome
CREATE TABLE IF NOT EXISTS `utm_diplome` (
  `id` int NOT NULL,
  `diplome` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `master_id` int DEFAULT NULL,
  `annee` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_creation` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_diplomes
CREATE TABLE IF NOT EXISTS `utm_diplomes` (
  `id` int NOT NULL,
  `diplome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_institut` int DEFAULT NULL,
  `annee` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_diplome_master
CREATE TABLE IF NOT EXISTS `utm_diplome_master` (
  `id` int NOT NULL,
  `utm_diplome_id` int NOT NULL,
  `master_id` int NOT NULL,
  `annee` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_directeur_de_labo_laboratoire_old
CREATE TABLE IF NOT EXISTS `utm_directeur_de_labo_laboratoire_old` (
  `id` bigint NOT NULL,
  `logo_laboratoire` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `etablissement` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `directeur_du_laboratoire_id` bigint unsigned NOT NULL,
  `date_de_creation` date DEFAULT NULL,
  `etat` enum('actif','inactif') COLLATE utf8mb4_general_ci DEFAULT 'actif',
  `objectif_general` text COLLATE utf8mb4_general_ci,
  `axes_de_recherche` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_ed_demande_bourse
CREATE TABLE IF NOT EXISTS `utm_ed_demande_bourse` (
  `id` bigint unsigned NOT NULL,
  `doctorant_id` bigint unsigned NOT NULL,
  `objet_demande` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `intitule_mission` text COLLATE utf8mb4_general_ci,
  `structure_type` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'Entreprise',
  `structure_nom` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `pays` varchar(100) COLLATE utf8mb4_general_ci DEFAULT '',
  `date_depart` date DEFAULT '0000-00-00',
  `date_retour` date DEFAULT '0000-00-00',
  `duree_totale` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `encadrant` varchar(255) COLLATE utf8mb4_general_ci DEFAULT '',
  `modalite_presence` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'Présentiel',
  `montant_estime` varchar(50) COLLATE utf8mb4_general_ci DEFAULT '',
  `financement_compl` varchar(10) COLLATE utf8mb4_general_ci DEFAULT 'Oui',
  `assurance` varchar(20) COLLATE utf8mb4_general_ci DEFAULT 'Fourni',
  `fichier_lettre_motivation` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fichier_lettre_accueil` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fichier_cv` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fichier_plan_travail` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fichier_attestation_insc` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `commentaire` text COLLATE utf8mb4_general_ci,
  `statut` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'Brouillon',
  `date_update` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_ed_demande_stage
CREATE TABLE IF NOT EXISTS `utm_ed_demande_stage` (
  `id` int unsigned NOT NULL,
  `doctorant_id` bigint unsigned NOT NULL,
  `type_demande` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Stage (long séjour)',
  `objet_mission` text COLLATE utf8mb4_general_ci NOT NULL,
  `date_depart` date NOT NULL,
  `date_retour` date NOT NULL,
  `duree_totale` varchar(50) COLLATE utf8mb4_general_ci GENERATED ALWAYS AS (concat(((to_days(`date_retour`) - to_days(`date_depart`)) + 1),_utf8mb4' jours')) VIRTUAL,
  `pays` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `structure_type` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'Entreprise',
  `structure_nom` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `autorisation` enum('Oui','Non') COLLATE utf8mb4_general_ci DEFAULT 'Oui',
  `type_financement` enum('Personnel','Subvention') COLLATE utf8mb4_general_ci DEFAULT 'Personnel',
  `assurance` enum('Fourni','À souscrire') COLLATE utf8mb4_general_ci DEFAULT 'Fourni',
  `fichier_lettre_invitation` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fichier_programme` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fichier_attestation` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fichier_autorisation_encadrant` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `commentaire` text COLLATE utf8mb4_general_ci,
  `statut` enum('Brouillon','Soumise','Approuvée','Refusée') COLLATE utf8mb4_general_ci DEFAULT 'Brouillon',
  `date_update` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_ed_theses_doctorants
CREATE TABLE IF NOT EXISTS `utm_ed_theses_doctorants` (
  `id` bigint unsigned NOT NULL,
  `doctorant_id` bigint unsigned NOT NULL,
  `sujet` text COLLATE utf8mb4_general_ci NOT NULL,
  `specialite` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_debut` date NOT NULL,
  `directeur_id` bigint unsigned NOT NULL,
  `laboratoire` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type_these` enum('Nationale','Internationale') COLLATE utf8mb4_general_ci DEFAULT 'Nationale',
  `cotutelle` enum('Oui','Non') COLLATE utf8mb4_general_ci DEFAULT 'Non',
  `statut` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'En cours',
  `date_update` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fichier_diplome` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fichier_releve_notes` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fichier_cv` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fichier_lettre` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fichier_accord_encadrant` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fichier_attestation_financement` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_email_notifications_config
CREATE TABLE IF NOT EXISTS `utm_email_notifications_config` (
  `id` int NOT NULL,
  `smtp_host` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `smtp_port` int DEFAULT NULL,
  `smtp_username` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `smtp_password` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `smtp_secure` enum('ssl','tls') COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `smtp_from` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `smtp_from_name` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_email_notifications_log
CREATE TABLE IF NOT EXISTS `utm_email_notifications_log` (
  `id` int NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `email_to` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `body` longtext COLLATE utf8mb4_unicode_520_ci,
  `status` enum('sent','error') COLLATE utf8mb4_unicode_520_ci DEFAULT 'sent',
  `error_message` text COLLATE utf8mb4_unicode_520_ci,
  `sent_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_email_notification_templates
CREATE TABLE IF NOT EXISTS `utm_email_notification_templates` (
  `id` int NOT NULL,
  `nom_modele` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sujet` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `corps` longtext COLLATE utf8mb4_general_ci,
  `actif` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_etablissements
CREATE TABLE IF NOT EXISTS `utm_etablissements` (
  `id` int NOT NULL,
  `universite_id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `categorie` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code_institut` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adresse` text COLLATE utf8mb4_general_ci,
  `gouvernorat` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_contact` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone_contact` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `responsable_nom` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `responsable_email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_creation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_e_events
CREATE TABLE IF NOT EXISTS `utm_e_events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `event_data` text COLLATE utf8mb4_unicode_520_ci,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_gouvernorats
CREATE TABLE IF NOT EXISTS `utm_gouvernorats` (
  `id` int NOT NULL,
  `nom_fr` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_ar` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_grade
CREATE TABLE IF NOT EXISTS `utm_grade` (
  `id` int unsigned NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intitule` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intitule_ar` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intitule_en` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorie` enum('Enseignant-Chercheur','Chercheur','Personnel de soutien','Doctorant/Étudiant') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ordre` smallint unsigned NOT NULL DEFAULT '100',
  `est_enseignant` tinyint(1) NOT NULL DEFAULT '0',
  `est_chercheur` tinyint(1) NOT NULL DEFAULT '1',
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_labo_laboratoire
CREATE TABLE IF NOT EXISTS `utm_labo_laboratoire` (
  `id` int NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denomination` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_id` int NOT NULL,
  `date_creation` date DEFAULT NULL,
  `directeur_id` int DEFAULT NULL,
  `etat` enum('Actif','Inactif') COLLATE utf8mb4_unicode_ci DEFAULT 'Actif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_links
CREATE TABLE IF NOT EXISTS `utm_links` (
  `link_id` bigint unsigned NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_image` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_target` varchar(25) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_description` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_visible` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'Y',
  `link_owner` bigint unsigned NOT NULL DEFAULT '1',
  `link_rating` int NOT NULL DEFAULT '0',
  `link_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `link_rel` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `link_notes` mediumtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `link_rss` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`link_id`),
  KEY `link_visible` (`link_visible`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_liste_master
CREATE TABLE IF NOT EXISTS `utm_liste_master` (
  `id` int NOT NULL,
  `ordre` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `listes` text COLLATE utf8mb4_general_ci,
  `date_creation` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_liste_master_diplome
CREATE TABLE IF NOT EXISTS `utm_liste_master_diplome` (
  `id` int NOT NULL,
  `liste_master_id` int DEFAULT NULL,
  `master_id` int DEFAULT NULL,
  `diplome_id` int DEFAULT NULL,
  `date_creation` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_admission
CREATE TABLE IF NOT EXISTS `utm_master_admission` (
  `id` int NOT NULL,
  `master_id` int NOT NULL,
  `diplomes_requis` text COLLATE utf8mb4_general_ci,
  `procedure_selection` text COLLATE utf8mb4_general_ci,
  `nb_places` int DEFAULT NULL,
  `criteres_admission` text COLLATE utf8mb4_general_ci,
  `public_vise` text COLLATE utf8mb4_general_ci,
  `niveau` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_appels_candidature
CREATE TABLE IF NOT EXISTS `utm_master_appels_candidature` (
  `id` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `nb_max` int DEFAULT '0',
  `fichier_joint` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_appels_masters
CREATE TABLE IF NOT EXISTS `utm_master_appels_masters` (
  `id` int NOT NULL,
  `appel_id` int NOT NULL,
  `master_id` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_appels_sessions
CREATE TABLE IF NOT EXISTS `utm_master_appels_sessions` (
  `id` int NOT NULL,
  `appel_id` int DEFAULT NULL,
  `nom_session` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_candidats
CREATE TABLE IF NOT EXISTS `utm_master_candidats` (
  `id` int NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nom_ar` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom_ar` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `lieu_naissance` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lieu_naissance_ar` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nationalite` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nationalite_ar` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cin` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `passport` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `IdentifiantUnique` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email1` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email2` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sexe` enum('Homme','Femme') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statut_etudiant` enum('Interne','Externe') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `a_besoin_specifique` varchar(200) COLLATE utf8mb4_general_ci DEFAULT '0',
  `type_besoin_specifique` text COLLATE utf8mb4_general_ci,
  `cycle` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo_path` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_candidats_adresses
CREATE TABLE IF NOT EXISTS `utm_master_candidats_adresses` (
  `id` int NOT NULL,
  `candidat_id` int NOT NULL,
  `type_adresse` enum('personnelle','parent') COLLATE utf8mb4_general_ci DEFAULT 'personnelle',
  `adresse_fr` text COLLATE utf8mb4_general_ci,
  `adresse_ar` text COLLATE utf8mb4_general_ci,
  `gouvernorat_fr` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gouvernorat_ar` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `delegation_fr` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `delegation_ar` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code_postal` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_candidatures
CREATE TABLE IF NOT EXISTS `utm_master_candidatures` (
  `id` int NOT NULL,
  `candidat_id` int NOT NULL,
  `master_id` int DEFAULT NULL,
  `niveau` varchar(10) COLLATE utf8mb4_general_ci DEFAULT 'M1',
  `etat` enum('En attente','brouillon','soumis','accepté','refusé') COLLATE utf8mb4_general_ci DEFAULT 'brouillon',
  `score` decimal(5,2) DEFAULT NULL,
  `date_soumission` datetime DEFAULT CURRENT_TIMESTAMP,
  `statut_dossier` varchar(50) COLLATE utf8mb4_general_ci DEFAULT 'en cours',
  `statut_decision_finale` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `libelle_resultat` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `motif_decision` text COLLATE utf8mb4_general_ci,
  `user_validation_id` int DEFAULT NULL,
  `user_decision_id` int DEFAULT NULL,
  `date_validation` datetime DEFAULT NULL,
  `date_decision_finale` datetime DEFAULT NULL,
  `institut_id` int DEFAULT NULL,
  `type_candidature` varchar(200) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_coordinateurs
CREATE TABLE IF NOT EXISTS `utm_master_coordinateurs` (
  `id` int NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `coordinateur_id` bigint unsigned NOT NULL,
  `master_id` int NOT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `date_affectation` datetime NOT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_departement
CREATE TABLE IF NOT EXISTS `utm_master_departement` (
  `id` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_diplome
CREATE TABLE IF NOT EXISTS `utm_master_diplome` (
  `id` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_documentfichemaster
CREATE TABLE IF NOT EXISTS `utm_master_documentfichemaster` (
  `id` int NOT NULL,
  `master_id` int NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `fichier_url` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `date_ajout` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_domaines
CREATE TABLE IF NOT EXISTS `utm_master_domaines` (
  `id` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_etablissements
CREATE TABLE IF NOT EXISTS `utm_master_etablissements` (
  `id` int NOT NULL,
  `universite_id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `code_institut` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `adresse` text COLLATE utf8mb4_unicode_520_ci,
  `email_contact` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `telephone_contact` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `responsable_nom` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `responsable_email` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `date_creation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_fichemaster
CREATE TABLE IF NOT EXISTS `utm_master_fichemaster` (
  `id` int NOT NULL,
  `institut_id` int NOT NULL,
  `intitule_master` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `langue` varchar(200) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `code_interne` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `parcours` text COLLATE utf8mb4_unicode_520_ci,
  `domaine` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `debut_habilitation` date DEFAULT NULL,
  `fin_habilitation` date DEFAULT NULL,
  `diplomes_requis` varchar(200) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `nature_id` int DEFAULT NULL,
  `mention_id` int DEFAULT NULL,
  `departement_id` int DEFAULT NULL,
  `diplome_id` int DEFAULT NULL,
  `specialite_id` int DEFAULT NULL,
  `procedure_selection` text COLLATE utf8mb4_unicode_520_ci,
  `nb_places` int DEFAULT NULL,
  `criteres_admission` text COLLATE utf8mb4_unicode_520_ci,
  `public_vise` text COLLATE utf8mb4_unicode_520_ci,
  `formule_score` text COLLATE utf8mb4_unicode_520_ci,
  `plan_etude_pdf` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `annee_universitaire` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `debut_annee_habilitation` varchar(200) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `fin_annee_habilitation` varchar(200) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_fichemaster2
CREATE TABLE IF NOT EXISTS `utm_master_fichemaster2` (
  `id` int NOT NULL,
  `institut_id` int NOT NULL,
  `intitule_master` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `code_interne` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `parcours` text COLLATE utf8mb4_unicode_520_ci,
  `domaine` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `debut_habilitation` date DEFAULT NULL,
  `fin_habilitation` date DEFAULT NULL,
  `nature_master` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `mention` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `diplomes_requis` text COLLATE utf8mb4_unicode_520_ci,
  `procedure_selection` text COLLATE utf8mb4_unicode_520_ci,
  `nb_places` int DEFAULT NULL,
  `criteres_admission` text COLLATE utf8mb4_unicode_520_ci,
  `public_vise` text COLLATE utf8mb4_unicode_520_ci,
  `formule_score` text COLLATE utf8mb4_unicode_520_ci,
  `plan_etude_pdf` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `annee_universitaire` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `nature_id` int DEFAULT NULL,
  `mention_id` int DEFAULT NULL,
  `departement_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_fichemasterold
CREATE TABLE IF NOT EXISTS `utm_master_fichemasterold` (
  `id` int NOT NULL,
  `institut_id` int NOT NULL,
  `intitule_master` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `code_interne` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `parcours` text COLLATE utf8mb4_unicode_520_ci,
  `domaine` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `debut_habilitation` date DEFAULT NULL,
  `fin_habilitation` date DEFAULT NULL,
  `nature_master` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `mention` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `diplomes_requis` text COLLATE utf8mb4_unicode_520_ci,
  `procedure_selection` text COLLATE utf8mb4_unicode_520_ci,
  `nb_places` int DEFAULT NULL,
  `criteres_admission` text COLLATE utf8mb4_unicode_520_ci,
  `public_vise` text COLLATE utf8mb4_unicode_520_ci,
  `formule_score` text COLLATE utf8mb4_unicode_520_ci,
  `plan_etude_pdf` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `annee_universitaire` varchar(20) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `date_creation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_instituts
CREATE TABLE IF NOT EXISTS `utm_master_instituts` (
  `id` int NOT NULL,
  `universite_id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `code_institut` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `adresse` text COLLATE utf8mb4_unicode_520_ci,
  `email_contact` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `telephone_contact` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `responsable_nom` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `responsable_email` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `logo` varchar(2555) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_mention
CREATE TABLE IF NOT EXISTS `utm_master_mention` (
  `id` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_nationalites
CREATE TABLE IF NOT EXISTS `utm_master_nationalites` (
  `id` bigint NOT NULL,
  `intitule` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intitule_ar` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_nature
CREATE TABLE IF NOT EXISTS `utm_master_nature` (
  `id` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_objectifs
CREATE TABLE IF NOT EXISTS `utm_master_objectifs` (
  `id` int NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contenu` varchar(10000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `master_id` int NOT NULL,
  `objectifs_generaux` text COLLATE utf8mb4_general_ci,
  `objectifs_specifiques` text COLLATE utf8mb4_general_ci,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score
CREATE TABLE IF NOT EXISTS `utm_master_score` (
  `id` int NOT NULL,
  `master_id` int NOT NULL,
  `niveau` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `diplome` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `titre` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `formule` varchar(2000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `source_templates` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `commentaire` text COLLATE utf8mb4_general_ci,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `validation_service_master` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `editable` tinyint(1) DEFAULT '1',
  `date_validation` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_service_master` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `formule_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin COMMENT 'Structure JSON complète de la formule dynamique (opérations, pondérations, champs, etc.)',
  `date_validation_utm` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_utm` int DEFAULT NULL,
  CONSTRAINT `utm_master_score_chk_1` CHECK (json_valid(`source_templates`)),
  CONSTRAINT `utm_master_score_chk_2` CHECK (json_valid(`formule_json`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_bonus_mention
CREATE TABLE IF NOT EXISTS `utm_master_score_bonus_mention` (
  `id` int NOT NULL,
  `score_id` int NOT NULL,
  `condition_mention` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `valeur` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_bonus_session
CREATE TABLE IF NOT EXISTS `utm_master_score_bonus_session` (
  `id` int NOT NULL,
  `score_id` int NOT NULL,
  `session` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `valeur` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_config
CREATE TABLE IF NOT EXISTS `utm_master_score_config` (
  `id` int NOT NULL,
  `score_id` int NOT NULL,
  `section` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `actif` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_credits
CREATE TABLE IF NOT EXISTS `utm_master_score_credits` (
  `id` int NOT NULL,
  `score_id` int NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `valeur` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_criteres
CREATE TABLE IF NOT EXISTS `utm_master_score_criteres` (
  `id` int NOT NULL,
  `score_id` int NOT NULL,
  `template_id` int NOT NULL,
  `config_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `ordre` int DEFAULT '0',
  CONSTRAINT `utm_master_score_criteres_chk_1` CHECK (json_valid(`config_json`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_criteres2
CREATE TABLE IF NOT EXISTS `utm_master_score_criteres2` (
  `id` int NOT NULL,
  `master_id` int NOT NULL,
  `champ` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ponderation` decimal(5,2) NOT NULL DEFAULT '0.00',
  `type_valeur` enum('Numérique','Textuelle') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Numérique',
  `operation` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '+',
  `ordre` int NOT NULL DEFAULT '1',
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_criteres_old
CREATE TABLE IF NOT EXISTS `utm_master_score_criteres_old` (
  `id` int NOT NULL,
  `master_id` int NOT NULL,
  `score_id` int DEFAULT NULL,
  `champ` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_entretien
CREATE TABLE IF NOT EXISTS `utm_master_score_entretien` (
  `id` int NOT NULL,
  `score_id` int NOT NULL,
  `note` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_interruption
CREATE TABLE IF NOT EXISTS `utm_master_score_interruption` (
  `id` int NOT NULL,
  `score_id` int NOT NULL,
  `condition_texte` text COLLATE utf8mb4_general_ci,
  `valeur` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_malus
CREATE TABLE IF NOT EXISTS `utm_master_score_malus` (
  `id` int NOT NULL,
  `score_id` int NOT NULL,
  `condition_texte` text COLLATE utf8mb4_general_ci,
  `valeur` decimal(5,2) DEFAULT NULL,
  `exclu_cycle_preparatoire` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_matieres
CREATE TABLE IF NOT EXISTS `utm_master_score_matieres` (
  `id` int NOT NULL,
  `score_id` int NOT NULL,
  `matiere` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `annee` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `note` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_moyenne
CREATE TABLE IF NOT EXISTS `utm_master_score_moyenne` (
  `id` int NOT NULL,
  `score_id` int NOT NULL,
  `moyenne_generale` float DEFAULT NULL,
  `nb_annees` int DEFAULT NULL,
  `niveau_etude` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_pfe
CREATE TABLE IF NOT EXISTS `utm_master_score_pfe` (
  `id` int NOT NULL,
  `score_id` int NOT NULL,
  `condition_texte` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `valeur` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_templates
CREATE TABLE IF NOT EXISTS `utm_master_score_templates` (
  `id` int NOT NULL,
  `nom_template` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `titre_affiche` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `config_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `ordre_affichage` int DEFAULT '0',
  `actif` tinyint(1) DEFAULT '1',
  `display` int DEFAULT '1',
  `created_by` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `institut_id` int DEFAULT NULL,
  CONSTRAINT `utm_master_score_templates_chk_1` CHECK (json_valid(`config_json`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_score_templates2
CREATE TABLE IF NOT EXISTS `utm_master_score_templates2` (
  `id` int NOT NULL,
  `nom_template` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `titre_affiche` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `config_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `ordre_affichage` int DEFAULT '0',
  `actif` tinyint(1) DEFAULT '1',
  `created_by` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `institut_id` int DEFAULT NULL,
  CONSTRAINT `utm_master_score_templates2_chk_1` CHECK (json_valid(`config_json`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_sessions
CREATE TABLE IF NOT EXISTS `utm_master_sessions` (
  `id` int NOT NULL,
  `master_id` int NOT NULL,
  `intitule_session` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `etat` enum('brouillon','publié web') COLLATE utf8mb4_general_ci DEFAULT 'brouillon',
  `date_creation` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_modification` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_session_universitaire
CREATE TABLE IF NOT EXISTS `utm_master_session_universitaire` (
  `id` int NOT NULL,
  `intitule` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `annee_debut` year NOT NULL,
  `annee_fin` year NOT NULL,
  `est_active` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_specialite
CREATE TABLE IF NOT EXISTS `utm_master_specialite` (
  `id` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_master_universites
CREATE TABLE IF NOT EXISTS `utm_master_universites` (
  `id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `code_universite` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adresse` text COLLATE utf8mb4_general_ci,
  `email_contact` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone_contact` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `site_web` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_options
CREATE TABLE IF NOT EXISTS `utm_options` (
  `option_id` bigint unsigned NOT NULL,
  `option_name` varchar(191) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `option_value` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `autoload` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'yes',
  UNIQUE KEY `option_name` (`option_name`),
  KEY `autoload` (`autoload`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_pays
CREATE TABLE IF NOT EXISTS `utm_pays` (
  `id` int NOT NULL,
  `code_iso2` char(2) COLLATE utf8mb4_general_ci NOT NULL,
  `code_iso3` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  `intitule` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `intitule_ar` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `intitule_en` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `telephone_code` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `actif` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_postmeta
CREATE TABLE IF NOT EXISTS `utm_postmeta` (
  `meta_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `post_id` (`post_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_posts
CREATE TABLE IF NOT EXISTS `utm_posts` (
  `ID` bigint unsigned NOT NULL AUTO_INCREMENT,
  `post_author` bigint unsigned NOT NULL DEFAULT '1',
  `post_date` datetime DEFAULT NULL,
  `post_date_gmt` datetime DEFAULT NULL,
  `post_content` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_title` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_excerpt` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'open',
  `post_password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `post_name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `to_ping` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `pinged` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_modified` datetime DEFAULT NULL,
  `post_modified_gmt` datetime DEFAULT NULL,
  `post_content_filtered` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `post_parent` bigint unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `menu_order` int NOT NULL DEFAULT '0',
  `post_type` varchar(20) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `comment_count` bigint NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=InnoDB AUTO_INCREMENT=759 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_profils
CREATE TABLE IF NOT EXISTS `utm_profils` (
  `id` int NOT NULL,
  `nom` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_profils_rubriques
CREATE TABLE IF NOT EXISTS `utm_profils_rubriques` (
  `id` int NOT NULL,
  `profil_id` int DEFAULT NULL,
  `rubrique_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_rechercheold_chercheur
CREATE TABLE IF NOT EXISTS `utm_rechercheold_chercheur` (
  `id` bigint NOT NULL,
  `email` varchar(190) COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `grade` varchar(120) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `laboratoire_id` bigint DEFAULT NULL,
  `orcid` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `site_web` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `specialite` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_activite_doc
CREATE TABLE IF NOT EXISTS `utm_recherche_activite_doc` (
  `id` bigint NOT NULL,
  `activite_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_activite_indicateur
CREATE TABLE IF NOT EXISTS `utm_recherche_activite_indicateur` (
  `id` bigint NOT NULL,
  `activite_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `resultat_obtenu` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_activite_quotidienne
CREATE TABLE IF NOT EXISTS `utm_recherche_activite_quotidienne` (
  `id` bigint NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `heure_debut` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `heure_fin` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `membre_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type_activite` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_activite_scientifique
CREATE TABLE IF NOT EXISTS `utm_recherche_activite_scientifique` (
  `id` bigint NOT NULL,
  `annee` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `titre_reference` varchar(10000) COLLATE utf8mb4_general_ci NOT NULL,
  `type_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Source` varchar(5000) COLLATE utf8mb4_general_ci NOT NULL,
  `piece_jointe_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_activite_scientifique_doc
CREATE TABLE IF NOT EXISTS `utm_recherche_activite_scientifique_doc` (
  `id` bigint NOT NULL,
  `activite_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_actualite
CREATE TABLE IF NOT EXISTS `utm_recherche_actualite` (
  `id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_actualite_labo
CREATE TABLE IF NOT EXISTS `utm_recherche_actualite_labo` (
  `id` bigint NOT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_publication` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_assiduite
CREATE TABLE IF NOT EXISTS `utm_recherche_assiduite` (
  `id` bigint unsigned NOT NULL,
  `laboratoire_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `grade` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_jour` date NOT NULL,
  `statut` enum('Présent','Mission','Stage') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Présent',
  `justification_text` text COLLATE utf8mb4_general_ci,
  `justification_path` text COLLATE utf8mb4_general_ci,
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` bigint unsigned DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_categorie_equipement
CREATE TABLE IF NOT EXISTS `utm_recherche_categorie_equipement` (
  `id` int NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `intitule` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `intitule_ar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `actif` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_conditions_entretien
CREATE TABLE IF NOT EXISTS `utm_recherche_conditions_entretien` (
  `id` bigint NOT NULL,
  `fichier_contrat` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `periodicite` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `consignes` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_recherche_equipement` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_disponibilite_equipement
CREATE TABLE IF NOT EXISTS `utm_recherche_disponibilite_equipement` (
  `id` int NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `intitule` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `intitule_ar` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `actif` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_document
CREATE TABLE IF NOT EXISTS `utm_recherche_document` (
  `id` bigint NOT NULL,
  `fichier_path` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `chercheur_id` bigint DEFAULT NULL,
  `date_upload` date DEFAULT NULL,
  `type` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `visibility` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_documents
CREATE TABLE IF NOT EXISTS `utm_recherche_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `laboratoire_id` bigint unsigned NOT NULL,
  `owner_user_id` bigint unsigned NOT NULL,
  `reference` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `categorie` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_520_ci,
  `file_id` bigint unsigned DEFAULT NULL,
  `file_url` text COLLATE utf8mb4_unicode_520_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_labo` (`laboratoire_id`),
  KEY `idx_owner` (`owner_user_id`),
  KEY `idx_cat` (`categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_enseignement
CREATE TABLE IF NOT EXISTS `utm_recherche_enseignement` (
  `id` bigint NOT NULL,
  `annee_universitaire` varchar(9) COLLATE utf8mb4_general_ci NOT NULL,
  `ue` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `volume_horaire` int NOT NULL,
  `chercheur_id` bigint DEFAULT NULL,
  `niveau` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `semestre` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_equipement
CREATE TABLE IF NOT EXISTS `utm_recherche_equipement` (
  `id` bigint NOT NULL,
  `categorie_id` int NOT NULL,
  `disponibilite_id` int NOT NULL,
  `modele` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nom_appareil` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `spcification_technique` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_equipement_protocole
CREATE TABLE IF NOT EXISTS `utm_recherche_equipement_protocole` (
  `id` bigint NOT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_recherche_equipement` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_laboratoire
CREATE TABLE IF NOT EXISTS `utm_recherche_laboratoire` (
  `id` bigint NOT NULL,
  `logo_id` bigint DEFAULT NULL,
  `logo_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `denomination` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `code_lr` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `etablissement_id` bigint DEFAULT NULL,
  `etablissement_label` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  `directeur_nom` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `directeur_email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `directeur_user_id` bigint DEFAULT NULL,
  `statut` enum('Actif','Inactif','Suspendu') COLLATE utf8mb4_general_ci DEFAULT 'Actif',
  `objectif_general` mediumtext COLLATE utf8mb4_general_ci,
  `axes_recherche` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `site_web` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_contact` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `domaine` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint DEFAULT NULL,
  `updated_by` bigint DEFAULT NULL,
  `meta_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  CONSTRAINT `utm_recherche_laboratoire_chk_1` CHECK (json_valid(`axes_recherche`)),
  CONSTRAINT `utm_recherche_laboratoire_chk_2` CHECK (json_valid(`meta_json`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_maintenance
CREATE TABLE IF NOT EXISTS `utm_recherche_maintenance` (
  `id` bigint NOT NULL,
  `date_debut` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_fin` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `equipement_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type_maintenance` enum('preventive','corrective','curative','inspection','autre') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'corrective',
  `motif` text COLLATE utf8mb4_general_ci,
  `fichier_rapport` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo_equipement` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_manifestation
CREATE TABLE IF NOT EXISTS `utm_recherche_manifestation` (
  `id` bigint NOT NULL,
  `date` date NOT NULL,
  `intitule` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `chercheur_id` bigint DEFAULT NULL,
  `lieu` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `preuve_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_membre
CREATE TABLE IF NOT EXISTS `utm_recherche_membre` (
  `id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL COMMENT 'ID de l’utilisateur',
  `laboratoire_id` bigint unsigned NOT NULL COMMENT 'ID du laboratoire',
  `grade` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Ex: Doctorant, Maître-Assistant, Professeur…',
  `specialite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Domaine/Spécialité',
  `api` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nom/clé de l’API source ou endpoint',
  `service` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nom du microservice/module',
  `user_created` bigint unsigned DEFAULT NULL COMMENT 'ID du créateur de l’enregistrement',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_notification
CREATE TABLE IF NOT EXISTS `utm_recherche_notification` (
  `id` bigint NOT NULL,
  `lu` tinyint(1) NOT NULL,
  `chercheur_id` bigint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_participation_request
CREATE TABLE IF NOT EXISTS `utm_recherche_participation_request` (
  `id` bigint NOT NULL,
  `decision` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_projet
CREATE TABLE IF NOT EXISTS `utm_recherche_projet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_debut` date NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type_projet_id` int DEFAULT NULL,
  `budget` decimal(12,2) DEFAULT NULL,
  `chercheur_id` bigint DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `resume` text COLLATE utf8mb4_general_ci,
  `statut` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `objectifs` varchar(2555) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `budget_piece` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `convention_piece` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type_financement` varchar(120) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_projet_depenses
CREATE TABLE IF NOT EXISTS `utm_recherche_projet_depenses` (
  `id` int NOT NULL,
  `projet_id` int NOT NULL,
  `ref` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `montant` decimal(15,2) DEFAULT '0.00',
  `date_depense` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_projet_livrables
CREATE TABLE IF NOT EXISTS `utm_recherche_projet_livrables` (
  `id` int NOT NULL,
  `projet_id` int NOT NULL,
  `ref` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type_livrable` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `date_prevue` date DEFAULT NULL,
  `fichier_url` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_projet_membre
CREATE TABLE IF NOT EXISTS `utm_recherche_projet_membre` (
  `id` bigint NOT NULL,
  `membre_id` bigint NOT NULL,
  `projet_id` bigint NOT NULL,
  `role_projet` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_projet_membres
CREATE TABLE IF NOT EXISTS `utm_recherche_projet_membres` (
  `id` int NOT NULL,
  `projet_id` int NOT NULL,
  `user_id` int NOT NULL,
  `role_dans_projet` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `grade` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_projet_objectifs
CREATE TABLE IF NOT EXISTS `utm_recherche_projet_objectifs` (
  `id` int NOT NULL,
  `projet_id` int NOT NULL,
  `type` enum('general','specifique') COLLATE utf8mb4_general_ci DEFAULT 'general',
  `objectif` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_projet_pieces
CREATE TABLE IF NOT EXISTS `utm_recherche_projet_pieces` (
  `id` int NOT NULL,
  `projet_id` int NOT NULL,
  `ref_doc` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type_doc` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `fichier_url` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `version` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_doc` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_publication
CREATE TABLE IF NOT EXISTS `utm_recherche_publication` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date_publication` date NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(120) COLLATE utf8mb4_general_ci NOT NULL,
  `chercheur_id` bigint DEFAULT NULL,
  `laboratoire_id` int DEFAULT NULL,
  `doi` varchar(80) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fichier_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `isbn` varchar(40) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `revue` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `statut` enum('En attente','Validée','Rejetée') COLLATE utf8mb4_general_ci DEFAULT 'En attente',
  `validated_by` bigint DEFAULT NULL,
  `validated_at` datetime DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `updated_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `resume` longtext COLLATE utf8mb4_general_ci,
  `commentaire` longtext COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_rapport_aq
CREATE TABLE IF NOT EXISTS `utm_recherche_rapport_aq` (
  `id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_rapport_reservations
CREATE TABLE IF NOT EXISTS `utm_recherche_rapport_reservations` (
  `id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_rapport_scientifique
CREATE TABLE IF NOT EXISTS `utm_recherche_rapport_scientifique` (
  `id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_reseaux
CREATE TABLE IF NOT EXISTS `utm_recherche_reseaux` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `laboratoire_id` bigint unsigned NOT NULL,
  `institution` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pays` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `type_collab` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_nom` varchar(180) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_email` varchar(180) COLLATE utf8mb4_general_ci NOT NULL,
  `contact_tel` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date DEFAULT NULL,
  `convention_signee` tinyint(1) NOT NULL DEFAULT '0',
  `statut` enum('Actif','Occasionnel','En cours','Clos') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Actif',
  `piece_jointe_id` bigint unsigned DEFAULT NULL,
  `piece_jointe_path` varchar(512) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `projets_associes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_by` bigint unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `site_web` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `adresse_org` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `logo_url` text COLLATE utf8mb4_general_ci,
  `avatar_url` text COLLATE utf8mb4_general_ci DEFAULT (NULL),
  `contact_fonction` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `utm_recherche_reseaux_chk_1` CHECK (json_valid(`projets_associes`))
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_reseaux_projets
CREATE TABLE IF NOT EXISTS `utm_recherche_reseaux_projets` (
  `id` bigint unsigned NOT NULL,
  `reseau_id` bigint unsigned NOT NULL,
  `projet_id` bigint unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_reseaux_stats
CREATE TABLE IF NOT EXISTS `utm_recherche_reseaux_stats` (
  `id` bigint unsigned NOT NULL,
  `laboratoire_id` bigint unsigned NOT NULL,
  `annee` int NOT NULL,
  `pays` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nb_reseaux` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_reservation
CREATE TABLE IF NOT EXISTS `utm_recherche_reservation` (
  `id` bigint NOT NULL,
  `statut` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'en_attente',
  `status_updated_by` bigint unsigned DEFAULT NULL,
  `status_updated_at` timestamp NULL DEFAULT NULL,
  `categorie` enum('equipement','salle') COLLATE utf8mb4_general_ci NOT NULL,
  `resource_id` bigint unsigned NOT NULL,
  `resource_label` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_reservation` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `objectif` text COLLATE utf8mb4_general_ci,
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_reunionold
CREATE TABLE IF NOT EXISTS `utm_recherche_reunionold` (
  `id` bigint NOT NULL,
  `date` datetime NOT NULL,
  `sujet` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `chercheur_id` bigint DEFAULT NULL,
  `compte_rendu_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lien_visio` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_source_financement
CREATE TABLE IF NOT EXISTS `utm_recherche_source_financement` (
  `id` int NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `intitule` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `intitule_ar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `type` enum('National','International','Privé','Institutionnel') COLLATE utf8mb4_general_ci DEFAULT 'National',
  `actif` tinyint(1) DEFAULT '1',
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_these
CREATE TABLE IF NOT EXISTS `utm_recherche_these` (
  `id` bigint NOT NULL,
  `date_debut` date NOT NULL,
  `doctorant_nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sujet` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_soutenance` date DEFAULT NULL,
  `encadrant_id` bigint DEFAULT NULL,
  `statut` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_type_activite_scientifique
CREATE TABLE IF NOT EXISTS `utm_recherche_type_activite_scientifique` (
  `id` int NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `libelle_fr` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `libelle_en` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `actif` tinyint(1) DEFAULT '1',
  `ordre_affichage` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_recherche_type_projet
CREATE TABLE IF NOT EXISTS `utm_recherche_type_projet` (
  `id` int NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `intitule` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `intitule_ar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `actif` tinyint(1) DEFAULT '1',
  `date_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_reclamations
CREATE TABLE IF NOT EXISTS `utm_reclamations` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `owner_user_id` bigint unsigned NOT NULL,
  `etudiant_id` bigint unsigned DEFAULT NULL,
  `type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sujet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `piece_jointe_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `piece_jointe_id` bigint unsigned NOT NULL DEFAULT '0',
  `is_anonymous` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statut_reponse` enum('En attente','Accepté','Refusé') COLLATE utf8mb4_unicode_ci DEFAULT 'En attente',
  `message_reponse` text COLLATE utf8mb4_unicode_ci,
  `reponse_user_id` bigint unsigned DEFAULT NULL,
  `reponse_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_reunion
CREATE TABLE IF NOT EXISTS `utm_reunion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sujet` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_reunion` date NOT NULL,
  `duree` int DEFAULT NULL,
  `fichier` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `etablissement_id` int NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_reunion_participants
CREATE TABLE IF NOT EXISTS `utm_reunion_participants` (
  `id` int NOT NULL,
  `reunion_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `statut` enum('invité','confirmé','refusé') COLLATE utf8mb4_general_ci DEFAULT 'invité',
  `etablissement_id` int NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_rm_ck_actions
CREATE TABLE IF NOT EXISTS `utm_rm_ck_actions` (
  `id` int NOT NULL,
  `action_key` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `module_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_rm_ck_modules
CREATE TABLE IF NOT EXISTS `utm_rm_ck_modules` (
  `id` int NOT NULL,
  `module_key` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `module_label` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_rm_ck_roles
CREATE TABLE IF NOT EXISTS `utm_rm_ck_roles` (
  `id` int NOT NULL,
  `role_key` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `role_label` varchar(100) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_rm_ck_role_permissions
CREATE TABLE IF NOT EXISTS `utm_rm_ck_role_permissions` (
  `id` int NOT NULL,
  `role_key` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `module_key` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `action_key` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_rm_ck_user_permissions
CREATE TABLE IF NOT EXISTS `utm_rm_ck_user_permissions` (
  `id` int NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `etablissement_id` int NOT NULL,
  `module_key` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `action_key` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_rubriques
CREATE TABLE IF NOT EXISTS `utm_rubriques` (
  `id` int NOT NULL,
  `titre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `type` enum('menu','composant') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'menu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_specialites
CREATE TABLE IF NOT EXISTS `utm_specialites` (
  `id` int NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `intitule` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `domaine` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_statuts_dossier
CREATE TABLE IF NOT EXISTS `utm_statuts_dossier` (
  `id` int NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `libelle` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `ordre_affichage` int DEFAULT '0',
  `actif` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_statuts_resultats
CREATE TABLE IF NOT EXISTS `utm_statuts_resultats` (
  `id` int NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `libelle_ar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ordre` int DEFAULT '0',
  `actif` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_statut_master
CREATE TABLE IF NOT EXISTS `utm_statut_master` (
  `id` int NOT NULL,
  `master_id` int NOT NULL,
  `statut_coordinateur` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_statut_coordinateur` datetime DEFAULT NULL,
  `user_statut_coordinateur` bigint unsigned DEFAULT NULL,
  `statut_service_master` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_statut_service_master` datetime DEFAULT NULL,
  `user_statut_service_master` bigint unsigned DEFAULT NULL,
  `etat_publication` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_etat_publication` datetime DEFAULT NULL,
  `user_etat_publication` bigint unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_termmeta
CREATE TABLE IF NOT EXISTS `utm_termmeta` (
  `meta_id` bigint unsigned NOT NULL,
  `term_id` bigint unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`meta_id`),
  KEY `term_id` (`term_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_terms
CREATE TABLE IF NOT EXISTS `utm_terms` (
  `term_id` bigint unsigned NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `slug` varchar(200) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `term_group` bigint NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  KEY `slug` (`slug`(191)),
  KEY `name` (`name`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_term_relationships
CREATE TABLE IF NOT EXISTS `utm_term_relationships` (
  `object_id` bigint unsigned NOT NULL DEFAULT '0',
  `term_taxonomy_id` bigint unsigned NOT NULL DEFAULT '0',
  `term_order` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`object_id`,`term_taxonomy_id`),
  KEY `term_taxonomy_id` (`term_taxonomy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_term_taxonomy
CREATE TABLE IF NOT EXISTS `utm_term_taxonomy` (
  `term_taxonomy_id` bigint unsigned NOT NULL,
  `term_id` bigint unsigned NOT NULL DEFAULT '0',
  `taxonomy` varchar(32) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `description` longtext COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `parent` bigint unsigned NOT NULL DEFAULT '0',
  `count` bigint NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_taxonomy_id`),
  UNIQUE KEY `term_id_taxonomy` (`term_id`,`taxonomy`),
  KEY `taxonomy` (`taxonomy`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_um_metadata
CREATE TABLE IF NOT EXISTS `utm_um_metadata` (
  `umeta_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  `um_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `um_value` longtext COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_universites
CREATE TABLE IF NOT EXISTS `utm_universites` (
  `id` int NOT NULL,
  `nom_universite` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_usermeta
CREATE TABLE IF NOT EXISTS `utm_usermeta` (
  `umeta_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `meta_value` longtext COLLATE utf8mb4_unicode_520_ci,
  PRIMARY KEY (`umeta_id`),
  KEY `user_id` (`user_id`),
  KEY `meta_key` (`meta_key`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_users
CREATE TABLE IF NOT EXISTS `utm_users` (
  `ID` bigint unsigned NOT NULL,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_pass` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  `user_status` int NOT NULL DEFAULT '0',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`),
  KEY `user_email` (`user_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for table utmsearch_w.utm_wf_sn_tests
CREATE TABLE IF NOT EXISTS `utm_wf_sn_tests` (
  `id` bigint unsigned NOT NULL,
  `testid` varchar(30) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `timestamp` datetime NOT NULL,
  `title` text COLLATE utf8mb4_unicode_520_ci,
  `status` tinyint NOT NULL,
  `score` tinyint NOT NULL,
  `runtime` float DEFAULT NULL,
  `msg` text COLLATE utf8mb4_unicode_520_ci,
  `details` text COLLATE utf8mb4_unicode_520_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- Data exporting was unselected.

-- Dumping structure for view utmsearch_w.v_msg_last_message
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_msg_last_message` (
	`id` BIGINT(20) UNSIGNED NOT NULL,
	`thread_id` BIGINT(20) UNSIGNED NOT NULL,
	`sender_id` BIGINT(20) UNSIGNED NOT NULL,
	`body` MEDIUMTEXT NULL COLLATE 'utf8mb4_general_ci',
	`body_plain` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`reply_to_id` BIGINT(20) UNSIGNED NULL,
	`has_attachments` TINYINT(1) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`edited_at` DATETIME NULL,
	`deleted_at` DATETIME NULL
) ENGINE=MyISAM;

-- Dumping structure for view utmsearch_w.v_msg_search_messages
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_msg_search_messages` (
	`id` BIGINT(20) UNSIGNED NOT NULL,
	`thread_id` BIGINT(20) UNSIGNED NOT NULL,
	`sender_id` BIGINT(20) UNSIGNED NOT NULL,
	`created_at` DATETIME NOT NULL,
	`body_plain` TEXT NULL COLLATE 'utf8mb4_general_ci',
	`subject` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for table utmsearch_w.v_msg_unread_counts
CREATE TABLE IF NOT EXISTS `v_msg_unread_counts` (
  `thread_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `unread_count` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for trigger utmsearch_w.trg_msg_messages_ad
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `trg_msg_messages_ad` AFTER DELETE ON `msg_messages` FOR EACH ROW BEGIN
  DECLARE last_ts DATETIME;
  SELECT COALESCE(MAX(created_at), NOW()) INTO last_ts
  FROM msg_messages WHERE thread_id = OLD.thread_id AND deleted_at IS NULL;
  UPDATE msg_threads SET updated_at = last_ts WHERE id = OLD.thread_id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger utmsearch_w.trg_msg_messages_ai
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
DELIMITER //
CREATE TRIGGER `trg_msg_messages_ai` AFTER INSERT ON `msg_messages` FOR EACH ROW BEGIN
  UPDATE msg_threads SET updated_at = NEW.created_at WHERE id = NEW.thread_id;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for view utmsearch_w.v_msg_last_message
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_msg_last_message`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_msg_last_message` AS select `m1`.`id` AS `id`,`m1`.`thread_id` AS `thread_id`,`m1`.`sender_id` AS `sender_id`,`m1`.`body` AS `body`,`m1`.`body_plain` AS `body_plain`,`m1`.`reply_to_id` AS `reply_to_id`,`m1`.`has_attachments` AS `has_attachments`,`m1`.`created_at` AS `created_at`,`m1`.`edited_at` AS `edited_at`,`m1`.`deleted_at` AS `deleted_at` from (`msg_messages` `m1` join (select `msg_messages`.`thread_id` AS `thread_id`,max(`msg_messages`.`created_at`) AS `last_created` from `msg_messages` where (`msg_messages`.`deleted_at` is null) group by `msg_messages`.`thread_id`) `lm` on(((`lm`.`thread_id` = `m1`.`thread_id`) and (`lm`.`last_created` = `m1`.`created_at`))));

-- Dumping structure for view utmsearch_w.v_msg_search_messages
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `v_msg_search_messages`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `v_msg_search_messages` AS select `m`.`id` AS `id`,`m`.`thread_id` AS `thread_id`,`m`.`sender_id` AS `sender_id`,`m`.`created_at` AS `created_at`,`m`.`body_plain` AS `body_plain`,`t`.`subject` AS `subject` from (`msg_messages` `m` join `msg_threads` `t` on((`t`.`id` = `m`.`thread_id`))) where (`m`.`deleted_at` is null);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
