<?php

    /**
     * Template Name: Archive
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
				
				<h1 class="page-title"><?php echo post_type_archive_title( '', false ); ?></h1>
				<nav class="showcase-cat-nav">
    				
    				<ul>
        				<?php displayTermNav(); ?>
                    </ul>
    				
				</nav>
			</header><!-- .page-header -->

            <h2 class="secondary-title">Recent Work</h2>
            
            <div class="showcase-entries">
			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post(); ?>
        
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <div class="entry-thumb">
                        <?php
                            
                            if ( has_post_thumbnail() ) {
                                
                        ?>

                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full', array( 'class' => 'showcase-thumb' ) ); ?></a>
	
                        <?php
                                
                            } else {
                                
                                echo displayDefaultThumb();
                                
                            }
                                
                        ?>
                    </div>
                    
                	<header class="entry-header">
                    	
                		<?php
                    		
                    		// get the title
                			if ( is_single() ) {
                    			
                    			the_title( '<h3 class="entry-title">', '</h3>' );
                    			
                			} else {
                    			
                    			the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
                    			
                			}
                			
                		?>
                		
                	</header>
                
                	<div class="entry-content">
                		<?php
                    		
                			the_excerpt();
                
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
                
<!--                 	<footer class="entry-footer"></footer> --><!-- .entry-footer -->
                
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
		
			echo 'No entries found!';

		endif;
		?>
        </div>

		</main><!-- .site-main -->
	</section><!-- .content-area -->
    
    <?php get_footer(); ?>