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

    <div id="primary" class="content-area">
        
		<main id="main" class="site-main" role="main">
    		
    		<header class="page-header">
    			
    			<h1 class="page-title"><?php echo displayPageTitle(); ?></h1>
    			<div><a class="branding-view-all" href="<?php echo get_post_type_archive_link( 'branding' ); ?>"><span class="dashicons dashicons-screenoptions"></span> View All</a></div>
				<nav class="branding-cat-nav">
    				
    				<ul>
        				<?php displayTermNav(); ?>
                    </ul>
    				
				</nav>
			</header><!-- .page-header -->

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
            		
            		<div class="entry-meta">
                		<?php echo get_branding_terms( $post_ID, 'branding_category' ); ?>
            		</div>
            		
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
		
	</div>

<?php get_footer(); ?>