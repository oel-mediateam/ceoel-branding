<?php
/*
Plugin Name: UWEX CEOEL Branding
Plugin URI: https://github.com/oel-mediateam/ceoel-branding
Description: A custom post type for branding documentation derived from Media Showcase code base.
Version: 1.0.0
Author: Ethan Lin
Author URI: http://www.ethanslin.com
License: GPLv2
*/
/*  Copyright 2015  Ethan Lin  (email : ethan.lin.05@gmail.com)

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

// exit if access directly
if ( !defined( 'ABSPATH' ) ) exit;

class BrandingCPT {
    
    private $post_type = 'branding';
    private $plural = 'Brandings';
    private $singular = 'Branding';
    private $slug = 'branding';
    private $menu_icon = 'dashicons-layout';
    private $style = 'css/ceoel_branding.css';
    private $customStyle = 'css/custom.css';
    private $script = 'scripts/ceoel_branding.js';
    private $single_template = 'single-ceoel_branding.php';
    private $archive_template = 'archive-ceoel_branding.php';
    private $term_template = 'archive-ceoel_branding_term.php';
    private $taxonomies = array(
        
        array(
            
            'taxonomy_name' => 'branding_guideline',
            'singular' => 'Guideline',
            'plural' => 'Guidelines',
            'slug' => 'guidelines',
            'hierarchical' => false
            
        )
        
    );
    
    public function __construct() {
        
        // register taxonomies
        $this->add_action( 'init', array( &$this, 'register_taxonomies' ) );
        
        // register the custom post type
        $this->add_action( 'init', array( &$this, 'register_custom_post' ) );
        
        // add styles and scripts
        $this->add_action( 'wp_enqueue_scripts', array( &$this, 'include_styles_scripts' ), 15 );
        
        // add single view template
        $this->add_filter( 'template_include', array( &$this, 'include_templates' ), 1 );
        
        // set post excerpt more text
        $this->add_filter( 'body_class', array( &$this, 'add_term_class' ) );
        
        // on activation
        register_activation_hook( __FILE__, array( &$this, 'flush_rewrite') );
        
    }
	
	private function add_action( $hook, $function, $priority = 10, $accepted_args = 1 ) {
    	
    	add_action( $hook, $function, $priority, $accepted_args );
    	
	}
	
	private function add_filter( $hook, $function, $priority = 10, $accepted_args = 1 ) {
    	
    	add_filter( $hook, $function, $priority, $accepted_args );
    	
	}
    
    public function register_custom_post() {
    
        register_post_type( $this->post_type,
            array(
                
                'labels' => array(
                    
                    'name' => $this->plural,
                    'singular_name' => $this->singular,
                    'add_new' => 'Add New',
                    'add_new_item' => 'Add New ' . $this->singular,
                    'edit' => 'Edit',
                    'edit_item' => 'Edit ' . $this->singular,
                    'view' => 'View',
                    'view_item' => 'View ' . $this->singular,
                    'search_item' => 'Search ' . $this->plural,
                    'not_found' => 'No ' . $this->plural . ' found',
                    'not_found_in_trash' => 'No ' . $this->plural . ' found in Trash',
                    'Parent' => 'Parent '  . $this->singular
                    
                ),
                
                'public' => true,
                'menu_position' => 20,
                'menu_icon' => $this->menu_icon,
                'supports' => array(
                    
                    'title',
                    'editor',
                    'thumbnail',
                    'revisions'
                    
                ),
                'has_archive' => $this->slug,
                'rewrite' => array(
                    
                    'slug' => $this->slug,
                    'with_front' => false
                    
                )
                
            ) );
        
    }
    
    public function register_taxonomies() {
        
        foreach ( $this->taxonomies as $taxonomy ) {
            
            $options = array();
            
            foreach ( $taxonomy as $key => $value ) {
                
                $options[$key] = $value;
                
            }
            
            if ( $options['hierarchical'] ) {
                
                $labels = array(
                        
                    'name' => $options['plural'],
                    'singular_name' => $options['singular'],
                    'menu_name' => $options['plural'],
                    'all_items' => 'All ' . $options['plural'],
                    'edit_item' => 'Edit ' . $options['singular'],
                    'view_item' => 'View' . $options['singular'],
                    'update_item' => 'Update ' . $options['singular'],
                    'add_new_item' => 'Add New ' . $options['singular'],
                    'new_item_name' => 'New ' . $options['singular'] . 'Name',
                    'parent_item' => 'Parent ' . $options['plural'],
                    'parent_item_colon' => 'Parent ' . $options['plural'],
                    'search_item' => 'Search ' . $options['plural'],
                    'popular_items' => 'Popular ' . $options['plural'],
                    'separate_items_with_commas' => 'Separate ' . $options['plural'] . ' with commas',
                    'add_or_remove_items' => 'Add or remove ' . $options['plural'],
                    'choose_from_most_used' => 'Choose from most used ' .$options['plural'],
                    'not_found' => 'No ' . $options['plural'] . ' found'
                    
                );
                
                $args = array(
                    
                    'labels' => $labels,
                    'public' => true,
                    'hierarchical' => $options['hierarchical'],
                    'rewrite' => array(
                        
                        'slug' => $this->slug . '/' . $options['slug'],
                        'with_front' => false,
                        'ep_mask' => EP_PERMALINK
                        
                    ),
                    'show_ui' => true,
                    'show_admin_column' => true,
                    'query_var' => true
                    
                );
                
            } else {
                
                $labels = array(
                        
                    'name' => $options['plural'],
                    'singular_name' => $options['singular'],
                    'menu_name' => $options['plural'],
                    'all_items' => 'All ' . $options['plural'],
                    'edit_item' => 'Edit ' . $options['singular'],
                    'view_item' => 'View' . $options['singular'],
                    'update_item' => 'Update ' . $options['singular'],
                    'add_new_item' => 'Add New ' . $options['singular'],
                    'new_item_name' => 'New ' . $options['singular'] . 'Name',
                    'parent_item' => null,
                    'parent_item_colon' => null,
                    'search_item' => 'Search ' . $options['plural'],
                    'popular_items' => 'Popular ' . $options['plural'],
                    'separate_items_with_commas' => 'Separate ' . $options['plural'] . ' with commas',
                    'add_or_remove_items' => 'Add or remove ' . $options['plural'],
                    'choose_from_most_used' => 'Choose from most used ' . $options['plural'],
                    'not_found' => 'No ' . $options['plural'] . ' found'
                    
                );
                
                $args = array(
                    
                    'labels' => $labels,
                    'public' => true,
                    'hierarchical' => $options['hierarchical'],
                    'rewrite' => array(
                        
                        'slug' => $this->slug . '/' . $options['slug'],
                        'with_front' => false,
                        'ep_mask' => EP_PERMALINK
                        
                    ),
                    'show_ui' => true,
                    'show_admin_column' => true,
                    'query_var' => true,
                    'update_count_callback' => '_update_post_term_count'
                    
                );
                
            }
            
            register_taxonomy( $options['taxonomy_name'], $this->post_type, $args);
            

            
        } // end loop
        
    }
    
    public function include_styles_scripts() {
        
        wp_enqueue_style( 'dashicons' );
        wp_enqueue_style( $this->post_type, plugins_url( $this->style, __FILE__ ) );
        wp_enqueue_style( $this->post_type . '-custom', plugins_url( $this->customStyle, __FILE__ ) );
        
        // add scripts
		wp_enqueue_script( $this->post_type, plugins_url( $this->script, __FILE__ ) );
        
    }
    
    public function include_templates( $path ) {
    
        if ( get_post_type() == $this->post_type ) {
            
            if ( is_single() ) {
                
                $path =  plugin_dir_path( __FILE__ ) . '/' . $this->single_template;
                
            } elseif ( is_post_type_archive( $this->post_type ) ) {
                
                $path =  plugin_dir_path( __FILE__ ) . '/' . $this->archive_template;
                
            } elseif ( is_tax() ) {
                
                $path =  plugin_dir_path( __FILE__ ) . '/' . $this->term_template;
                
            }
            
        }
        
        return $path;
        
    }
    
    public function add_term_class( $classes ) {
        
        if( is_tax( 'branding_guideline' ) ) {
            
            global $taxonomy;
            
            if( !in_array( $taxonomy, $classes ) ) {
                
                $classes[] = 'branding-term';
                
            }
                
        }
        return $classes;
        
    }
    
    public function flush_rewrite() {
        
        
        $this->register_taxonomies();
        $this->register_custom_post();
        
        flush_rewrite_rules();
        
    }

    
} // end class

new BrandingCPT();
	
?>