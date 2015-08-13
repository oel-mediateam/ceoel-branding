<?php

class Term_Nav_Walker extends Walker_Category {
    
    function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        
        extract( $args );
        
        $cat_name = esc_attr( $category->name );
        $cat_name = apply_filters( 'list_cats', $cat_name, $category );
        $termchildren = get_term_children( $category->term_id, $category->taxonomy );
        
        $classes = 'cat-item cat-item-' . $category->term_id;
        
        if ( count( $termchildren ) > 0 ) {

			$classes .=  ' cat-parent';

        }
        
        if ( !empty( $current_category ) ) {

            $_current_category = get_term( $current_category, $category->taxonomy );

            if ( $category->term_id == $current_category ) {
                
                 $classes .=  ' current-cat';
                
            }  elseif ( $category->term_id == $_current_category->parent ) {
                
                $classes .=  ' current-cat-parent';
                
            }    

        }
        
        $link = '<a href="' . esc_url( get_term_link( $category ) ) . '">' . $cat_name . '</a>';
        
        if ( !empty( $show_count ) ) {
            
            $link .= ' (' . intval( $category->count ) . ')';
            
        }
        
        $output .= '<li class="' . $classes . '">' . $link;
    }
    
    function end_el( &$output, $item, $depth=0, $args=array() ) {
        
        $output .= "</li>\n";
        
    }

}    
    
?>