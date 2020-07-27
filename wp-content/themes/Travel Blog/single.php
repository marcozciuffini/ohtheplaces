<?php get_header(); 
 

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        
        <div class="section-heading">
            <h2 class="page-date"><?php the_date(); ?></h2>
        </div>
        <div class="page-container">
            <section class="page-post">
                <h3><?php the_title(); ?></h3>
                <?php the_content(); ?>
            </section>
        </div>
        <div class="section-footer">
            
        </div>
 
<?php 
endwhile;
endif;
  
  
get_footer(); ?>
