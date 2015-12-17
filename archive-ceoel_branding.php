<?php

    /**
     * Template Name: Archive
     * @package CEOEL Branding
     * @since 1.0.0
     */
    
    require_once 'ceoel_branding_functions.php';
    
    get_header();
    
    
?>

	<main class="content full-width" role="main">

	<?php if ( have_posts() ) : ?>

		<header class="page-header">
			
			<h1 class="page-title"><?php echo displayPageTitle() . ' Guidelines'; ?></h1>
			<nav class="branding-cat-nav">
				
				<ul>
    				<?php displayTermNav(); ?>
                </ul>
				
			</nav>
		</header><!-- .page-header -->
		
        <article >
                <div class="branding-entries">
                
                <?php
                    
                    $arg = array(
                        
                        'orderby' => 'name',
                        'hide_empty' => 1,
                        'hierarchical' => 0,
                        
                    );
                    $terms = get_terms( 'branding_guideline', $arg );
                    
                    foreach( $terms as $cat ) {
                        
                        echo '<h2 class="branding_term_title" data-term-id="' . $cat->term_taxonomy_id . '">' .$cat->name . '</h2>' ;
                        
                        $posts = new WP_Query( array(
                            
                            'post_type' => 'branding',
                            'post_status' => 'publish',
                            'orderby' => 'id',
                            'order' => 'ASC',
                            'nopaging' => true,
                            'tax_query' => array(
                                
                                array(
                                    
                                    'taxonomy' => 'branding_guideline',
                                    'field' => 'term_id',
                                    'terms' => $cat->term_taxonomy_id
                                    
                                )
                                
                            )
                            
                        ) );
                        
                        if ( $posts->have_posts() ) {
                        	echo '<ul class="branding_items_wrapper">';
                        	while ( $posts->have_posts() ) {
                        		$posts->the_post();
                        		
                        		if ( has_post_thumbnail() ) {
                            		
                            		echo '<li><a href="' . get_permalink($posts->ID) . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_post_thumbnail( $posts->ID, 'full', array( 'class' => 'brand-thumb' ) ) . '</a></li>';
                            		
                        		} else {
                            		
                            		echo '<li><a href="'.get_permalink($posts->ID).'">' . get_the_title() . '</a></li>';
                            		
                        		}
                        		
                        	}
                        	echo '</ul>';
                        }
                        
                        wp_reset_postdata();
                        
                    }
    			
        		else :
        		
        			echo 'No entries found!';
        
        		endif;
    		    ?>
            </div>
        </article>

	</main><!-- .site-main -->
    
    <?php get_footer(); ?>