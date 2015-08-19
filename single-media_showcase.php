<?php

    /**
     * Template Name: Single
     * @package Media Showcase
     * @since 1.0.0
     */
    
    // includes
    require_once 'media_showcase_functions.php';
    
    $post_ID = get_the_ID();
    
    get_header();
    
    
?>

    <div id="primary" class="content-area">
        
		<main id="main" class="site-main" role="main">
    		
    		<header class="page-header">
    			
    			<h1 class="page-title"><?php echo displayPageTitle(); ?></h1>
				<nav class="showcase-cat-nav">
    				
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
                		<?php get_showcase_terms( $post_ID, 'media_types' ); ?>
            		</div>
            		
            	</header>
            
            	<div class="entry-content">
            		<?php
            			/* translators: %s: Name of current post */
            			the_content( sprintf(
            				__( 'Continue reading %s', 'showcase' ),
            				the_title( '<span class="screen-reader-text">', '</span>', false )
            			) );
            
            			wp_link_pages( array(
            				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'showcase' ) . '</span>',
            				'after'       => '</div>',
            				'link_before' => '<span>',
            				'link_after'  => '</span>',
            				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'showcase' ) . ' </span>%',
            				'separator'   => '<span class="screen-reader-text">, </span>',
            			) );
            			
            			edit_post_link( __( 'Edit', 'showcase' ), '<span class="edit-link">', '</span>' );
            		?>
            	</div><!-- .entry-content -->
            
            	<footer class="entry-footer">
                    <?php get_showcase_terms( $post_ID, 'participants', '<strong>Participants:</strong> ' ); ?><br />
                    <?php get_showcase_terms( $post_ID, 'showcase_tags', '<strong>Tags:</strong> ' ); ?>
            	</footer><!-- .entry-footer -->
            
            </article>
			
        <?php

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			// Previous/next post navigation.
/*
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'showcase' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Next post:', 'showcase' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'showcase' ) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous post:', 'showcase' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );
*/

		// End the loop.
		endwhile;
		?>

		</main>
		
	</div>

<?php get_footer(); ?>