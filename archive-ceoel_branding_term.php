<?php

    /**
     * Template Name: Term Archive
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
        				<li><a class="branding-view-all" href="<?php echo get_post_type_archive_link( 'branding' ); ?>">View All</a></li>
        				<?php displayTermNav(); ?>
                    </ul>
    				
				</nav>
				
			</header><!-- .page-header -->
            <article >
            <div class="branding-entries">
                
                <h2 class="branding_term_title"><?php echo single_term_title( '', false ); ?></h2>
                
                <ul class="branding_items_wrapper">
			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post(); ?>
                
                
                <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                	<?php
                    	
                    	if ( has_post_thumbnail() ) {
                            		
                    		echo '<a href="' . get_permalink() . '" title="' . esc_attr( get_the_title() ) . '">' . get_the_post_thumbnail( $posts->ID, 'full', array( 'class' => 'brand-thumb' ) ) . '</a>';
                    		
                		} else {
                    		
                    		echo '<a href="'.get_permalink().'">' . get_the_title() . '</a>';
                    		
                		}
                    	
                    ?>
                    
                	</li>
                				
        <?php endwhile; ?>
        
			</ul>
			
			<?php
			
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous', 'branding' ),
				'next_text'          => __( 'Next', 'branding' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'branding' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
		
			get_template_part( 'content', 'none' );

		endif;
		?>
        </div>
        <article >

    </main><!-- .site-main -->

    
    <?php get_footer(); ?>