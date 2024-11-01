<?php
/*
Plugin Name:  Simple Glossary
Version: 0.2
Plugin URI: http://www.lawrencestewart.ca/
Description: Creates a simple glossary using custom post types
Author: Lawrence Stewart
Author URI: http://www.lawrencestewart.ca/
License: Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Create Glossary post type

add_action( 'init', 'my_cpt_init' );
function my_cpt_init() {
	$labels = array(
		'name' => _x('Glossary', 'post type general name'),
		'singular_name' => _x('Glossary', 'post type singular name'),
    	'add_new' => _x('Add New', 'glossary'),
    	'add_new_item' => __('Add New Definition'),
    	'edit_item' => __('Edit Definition'),
    	'new_item' => __('New Definition'),
    	'all_items' => __('All Definitions'),
    	'view_item' => __('View Definitions'),
    	'search_items' => __('Search Definitions'),
    	'not_found' =>  __('No Definitions found'),
    	'not_found_in_trash' => __('No definitions found in Trash'), 
    	'parent_item_colon' => '',
    	'menu_name' => 'Glossary'
	);
    $args = array(
    	'labels' => $labels,
    	'public' => true,
    	'publicly_queryable' => true,
    	'show_ui' => true, 
    	'show_in_menu' => true, 
    	'query_var' => true,
    	'rewrite' => true,
    	'capability_type' => 'post',
    	'has_archive' => true, 
    	'hierarchical' => false,
    	'menu_position' => null,
    	'supports' => array( 'title', 'editor', 'thumbnail' )
	); 
    register_post_type( 'glossary',$args );
}

// Flushes rewrite so permalinks work
register_activation_hook( __FILE__, 'gnarly_glossary_rewrite_flush' );
function gnarly_glossary_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    my_cpt_init();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}


/** Activate the plugin */
register_activation_hook( __FILE__, 'gnarly_glossary_activation_hook' );
function gnarly_glossary_activation_hook(){
	}


/**Deactive the plugin */
register_deactivation_hook( __FILE__, 'gnarly_glossary_deactivation_hook' );
function gnarly_glossary_deactivation_hook(){
	
}

//** Uninstall the Plugin8/
register_uninstall_hook(__FILE__, 'gnarly_glossary_uninstall_hook');
 
function gnarly_glossary_uninstall_hook()
{
    }

?>