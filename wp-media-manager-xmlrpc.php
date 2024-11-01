<?php
/*
Plugin Name: WP Media Manager XML-RPC
Description: Adds XML-RPC methods for the Wordpress Media Manager
Version: 1.0.0
Author: Rafael Dery
Author URI: http://radykal.de
*/

function delete_files( $args ) {
    global $wp_xmlrpc_server;
    $wp_xmlrpc_server->escape( $args );

    $blog_id  = $args[0];
    $username = $args[1];
    $password = $args[2];
    $data = $args[3];
    
    $ids = $data["ids"];
    
    if ( ! $user = $wp_xmlrpc_server->login( $username, $password ) )
        return $wp_xmlrpc_server->error;

    foreach($ids as $id) {
    	wp_delete_attachment(intval($id), true);
    }
    
    return 1;
}

function new_xmlrpc_methods( $methods ) {
    $methods['rk.deleteFiles'] = 'delete_files';
    return $methods;   
}

//filters
add_filter( 'xmlrpc_methods', 'new_xmlrpc_methods');
?>
