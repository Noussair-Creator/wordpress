<?php
/**
 * Routes REST pour Contacts
 */
if (!defined('ABSPATH')) { exit; }


require_once dirname(__DIR__, 1) . '/services/services-contact.php';

add_action('rest_api_init', function () {
  register_rest_route('plateforme-recherche/v1', '/contact/upload', [
    'methods' => 'POST',
    'callback' => 'svc_contact_upload_image',
    'permission_callback' => function () { return is_user_logged_in(); },
  ]);
  // /contact : liste + création
  register_rest_route('plateforme-recherche/v1', '/contact', array(
    array(
      'methods'  => WP_REST_Server::READABLE,   // GET
      'callback' => 'svc_contact_list',
      'permission_callback' => function(){ return is_user_logged_in(); },
      'args' => array(
        'search'   => array('required'=>false,'type'=>'string'),
        'page'     => array('required'=>false,'type'=>'integer'),
        'per_page' => array('required'=>false,'type'=>'integer'),
      ),
    ),
    array(
      'methods'  => WP_REST_Server::CREATABLE,  // POST
      'callback' => 'svc_contact_create',
      'permission_callback' => function(){ return is_user_logged_in(); },
    ),
  ));

  // /contact/{id} : lecture + mise à jour + suppression
  register_rest_route('plateforme-recherche/v1', '/contact/(?P<id>\d+)', array(
    array(
      'methods'  => WP_REST_Server::READABLE,    // GET /{id}
      'callback' => 'svc_contact_get',
      'permission_callback' => function(){ return is_user_logged_in(); },
    ),
    array(
      'methods'  => 'PUT, PATCH',                // PUT/PATCH /{id}
      'callback' => 'svc_contact_update',
      'permission_callback' => function(){ return is_user_logged_in(); },
    ),
    array(
      'methods'  => WP_REST_Server::DELETABLE,   // DELETE /{id}
      'callback' => 'svc_contact_delete',
      'permission_callback' => function(){ return is_user_logged_in(); },
    ),
  ));

});
