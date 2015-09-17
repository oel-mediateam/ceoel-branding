<?php
    
    // exit if access directly
    if ( !defined( 'ABSPATH' ) ) exit;
    
    require_once 'ceoel_branding_term_walker.php';
    
    function get_branding_terms( $id, $taxonomy, $before = '', $sep = ', ', $after = '' ) {
        
        $terms = get_the_term_list( $id, $taxonomy, $before, $sep, $after );
        
        if ( $terms ) {
            
            return $terms;
            
        }
        
        return '';
        
    }
    
    function displayTermNav() {
        
        wp_list_categories( array(
            'orderby' => 'name',
            'show_count' => 0,
            'pad_counts' => 0,
            'hierarchical' => 1,
            'hide_empty' => 1,
            'taxonomy' => 'branding_category',
            'title_li' => '',
            'walker' => new Term_Nav_Walker()
        ) );
        
    }
    
    function displayPageTitle() {
        
        $title = get_post_type_object( 'branding' );
        return $title->labels->singular_name;
        
    }
    
?>