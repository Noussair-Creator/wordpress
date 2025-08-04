<?php
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class GE_FicheMaster_Table extends WP_List_Table {

    public function get_columns() {
        return [
            'id'                   => 'ID',
            'intitule_master'      => 'Intitulé',
            'code_interne'         => 'Code Interne',
            'domaine'              => 'Domaine',
            'nature_libelle'       => 'Nature',
            'mention_libelle'      => 'Mention',
            'departement_libelle'  => 'Département',
            'diplome_libelle'      => 'Diplôme',
            'specialite_libelle'   => 'Spécialité',
            'etablissement_nom'    => 'Établissement',
            'annee_universitaire'  => 'Année Univ.',
            'date_creation'        => 'Date Création',
            'actions'              => 'Actions'
        ];
    }
    

    public function prepare_items() {
        global $wpdb;
        $fiche_table = $wpdb->prefix . GE_MODULE . '_fichemaster';
        $etab_table  = $wpdb->prefix . GE_MODULE . '_instituts';


        // Gestion suppression
        if (isset($_GET['action']) && $_GET['action'] === 'supprimer' && isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $wpdb->delete($fiche_table, ['id' => $id]);
            wp_redirect(admin_url('admin.php?page=gestion-fiches-master'));
            exit;
        }


        $current_user = wp_get_current_user();
        $user_institut_id = get_user_meta($current_user->ID, 'institut_id', true);

        $where_sql = '';
        if (in_array('um_admin_etablissement', $current_user->roles) && $user_institut_id) {
            $where_sql = 'WHERE f.institut_id = ' . intval($user_institut_id);
        }

        $prefix = $wpdb->prefix . GE_MODULE . '_';

        $data = $wpdb->get_results("
            SELECT 
                f.*, 
                e.nom AS etablissement_nom,
                n.libelle AS nature_libelle,
                m.libelle AS mention_libelle,
                dpt.libelle AS departement_libelle,
                dp.libelle AS diplome_libelle,
                sp.libelle AS specialite_libelle
            FROM {$prefix}fichemaster f
            LEFT JOIN {$prefix}instituts e ON f.institut_id = e.id
            LEFT JOIN {$prefix}nature n ON f.nature_id = n.id
            LEFT JOIN {$prefix}mention m ON f.mention_id = m.id
            LEFT JOIN {$prefix}departement dpt ON f.departement_id = dpt.id
            LEFT JOIN {$prefix}diplome dp ON f.diplome_id = dp.id
            LEFT JOIN {$prefix}specialite sp ON f.specialite_id = sp.id
            $where_sql
        ", ARRAY_A);


       
        $columns = $this->get_columns();
        $hidden = [];
        $sortable = [];

        $this->_column_headers = [$columns, $hidden, $sortable];
        $this->items = $data;
    }

    public function column_default($item, $column_name) {
        if ($column_name === 'actions') {
            $edit_url = admin_url('admin.php?page=ajouter-fiche-master&edit=' . $item['id']);
            $delete_url = admin_url('admin.php?page=gestion-fiches-master&action=supprimer&id=' . $item['id']);

            return '<a href="' . esc_url($edit_url) . '">✏️ Modifier</a> | ' .
                   '<a href="' . esc_url($delete_url) . '" onclick="return confirm(\'Supprimer cette fiche ?\');">🗑️ Supprimer</a>';
        }

        return isset($item[$column_name]) ? esc_html($item[$column_name]) : '';
    }
}
