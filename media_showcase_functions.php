<?php
    
    // exit if access directly
    if ( !defined( 'ABSPATH' ) ) exit;
    
    require_once 'media_showcase_term_walker.php';
    
    function get_showcase_terms( $id, $taxonomy, $before = '', $sep = ', ', $after = '' ) {
        
        $terms = the_terms( $id, $taxonomy, $before, $sep, $after );
        
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
            'taxonomy' => 'media_types',
            'title_li' => '',
            'walker' => new Term_Nav_Walker()
        ) );
        
    }
    
?>