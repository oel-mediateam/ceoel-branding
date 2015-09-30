<?php

    /**
     * Template Name: Single
     * @package CEOEL Branding
     * @since 1.0.0
     */
    
    // includes
    require_once 'ceoel_branding_functions.php';
    
    $post_ID = get_the_ID();
    
    get_header();
    
    
?>
        <header class="page-header">
    			
            <h1 class="page-title"><?php echo displayPageTitle() . ' Guidelines'; ?></h1>
			<nav class="branding-cat-nav">
				
				<ul>
    				<li><a class="branding-view-all" href="<?php echo get_post_type_archive_link( 'branding' ); ?>">View All</a></li>
    				<?php displayTermNav(); ?>
                </ul>
				
			</nav>
			
		</header><!-- .page-header -->
        
        <div class="content-side-bar-wrap">
		<main class="content" role="main">
			
			<?php genesis_breadcrumb(); ?>

		<?php while ( have_posts() ) : the_post(); ?>
        
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            	<header class="entry-header">
                	
            		<?php
                		
                		// get the title
            			if ( is_single() ) {
                			
                			the_title( '<h1 class="entry-title">', '</h1>' );
                			
            			} else {
                			
                			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
                			
            			}

            		?>
            		
            	</header>
            
            	<div class="entry-content">
            		<?php
            			/* translators: %s: Name of current post */
            			the_content( sprintf(
            				__( 'Continue reading %s', 'branding' ),
            				the_title( '<span class="screen-reader-text">', '</span>', false )
            			) );
            
            			wp_link_pages( array(
            				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'branding' ) . '</span>',
            				'after'       => '</div>',
            				'link_before' => '<span>',
            				'link_after'  => '</span>',
            				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'branding' ) . ' </span>%',
            				'separator'   => '<span class="screen-reader-text">, </span>',
            			) );
            			
            		?>
            	</div><!-- .entry-content -->
            
            	<footer class="entry-footer">
                    <?php edit_post_link( __( 'Edit', 'branding' ), '<span class="edit-link">', '</span>' ); ?>
            	</footer><!-- .entry-footer -->
            
            </article>
			
        <?php

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		// End the loop.
		endwhile;
		?>

		</main>
		<aside class="sidebar sidebar-primary widget-area" role="complementary">
    		
    		<?php
        		
        		$arg = array(
                        
                    'orderby' => 'id',
                    'hide_empty' => 1,
                    'hierarchical' => 0,
                    
                );
                $terms = get_terms( 'branding_guideline', $arg );
                
                foreach( $terms as $cat ) {
                    
                    echo '<section class="widget">';
                    echo '<div class="widget-wrap">';
                    echo '<h4 class="widget-title widgettitle">' .$cat->name . '</h4>' ;
                    
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
                    	echo '<ul class="menu">';
                    	while ( $posts->have_posts() ) {
                    		$posts->the_post();
                        		
                    		echo '<li><a href="'.get_permalink($posts->ID).'">' . get_the_title() . '</a></li>';
                    		
                    	}
                    	echo '</ul>';
                    	
                    }
                    
                    echo '<div class="widget-wrap">';
                    echo '</section>';
                    
                    wp_reset_postdata();
                    
                }
        		
            ?>
    		
		</aside>
        </div>

<?php get_footer(); ?>