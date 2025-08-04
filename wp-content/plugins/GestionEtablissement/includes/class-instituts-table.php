<?php
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class GE_Instituts_Table extends WP_List_Table {

 

    public function get_columns() {
        return [
            'id'                => 'ID',
            'universite_nom'    => 'Université',
            'nom'               => 'Nom Institut',
            'code_institut'     => 'Code',
            'responsable_nom'   => 'Responsable',
            'date_creation'     => 'Date création',
            'action'            => 'Action', // <- nouvelle colonne
        ];
    }
    
/*
    public function prepare_items() {
        global $wpdb;

        $table = $wpdb->prefix . GE_MODULE . '_instituts';
        $univ_table = $wpdb->prefix . GE_MODULE . '_universites';

        $data = $wpdb->get_results("
            SELECT i.*, u.nom as universite_nom
            FROM $table i
            LEFT JOIN $univ_table u ON i.universite_id = u.id
            ORDER BY i.id DESC
        ", ARRAY_A);

        $columns = $this->get_columns();
        $this->_column_headers = [$columns, [], []];
        $this->items = $data;
    }

   
    */

    public function prepare_items() {
        global $wpdb;
    
        $search = isset($_REQUEST['s']) ? sanitize_text_field($_REQUEST['s']) : '';
        $table = $wpdb->prefix . GE_MODULE . '_instituts';
        $univ_table = $wpdb->prefix . GE_MODULE . '_universites';
    
        $sql = "
            SELECT i.*, u.nom as universite_nom
            FROM $table i
            LEFT JOIN $univ_table u ON i.universite_id = u.id
        ";
    
        if (!empty($search)) {
            $sql .= $wpdb->prepare("
                WHERE i.nom LIKE %s OR i.code_institut LIKE %s OR u.nom LIKE %s
            ", "%$search%", "%$search%", "%$search%");
        }
    
        $sql .= " ORDER BY i.id DESC";
    
        $data = $wpdb->get_results($sql, ARRAY_A);
    
        $columns = $this->get_columns();
        $this->_column_headers = [$columns, [], []];
        $this->items = $data;
    }
    

    public function column_nom($item) {
        $edit_url = admin_url('admin.php?page=modifier-etablissement&id=' . $item['id']);

        $actions = [
            'edit' => '<a href="' . esc_url($edit_url) . '">Modifier</a>',
        ];

        return sprintf(
            '<strong>%s</strong> %s',
            esc_html($item['nom']),
            $this->row_actions($actions)
        );
    }

    public function column_default($item, $column_name) {
        return isset($item[$column_name]) ? esc_html($item[$column_name]) : '';
    }

    public function column_action($item) {
        $edit_url = admin_url('admin.php?page=modifier-etablissement&id=' . $item['id']);
        return '<a class="button" href="' . esc_url($edit_url) . '">Modifier</a>';
    }
    
}
