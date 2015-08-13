<?php

    /**
     * Template Name: Term Archive
     * @package Media Showcase
     * @since 1.0.0
     */
    
    require_once 'media_showcase_functions.php';
    
    get_header();
    
    
?>

    <section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
    			
    			<h1 class="page-title"><?php echo single_term_title( '', false ); ?></h1>
    			<div class="taxonomy-description"><?php echo term_description(); ?></div>
				<nav class="showcase-cat-nav">
    				
    				<ul>
        				<?php displayTermNav(); ?>
                    </ul>
    				
				</nav>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post(); ?>
        
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
                			
                		?>
                	</div><!-- .entry-content -->
                
                	<footer class="entry-footer"></footer><!-- .entry-footer -->
                
                </article>
        			
        <?php

			// End the loop.
			endwhile;
			
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous', 'showcase' ),
				'next_text'          => __( 'Next', 'showcase' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'showcase' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
		
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->
    
    <?php get_footer(); ?>