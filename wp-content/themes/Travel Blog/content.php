<div class="section-grid all-posts-post">
    <div class="section-heading">
        <h2>
            <?php the_date(); ?>
        </h2>
    </div>
    <div class="section-container">
        <section class="last-post">
            <a href="<?php the_permalink(); ?>" class="post-link">
                <h3 class="last-heading">
                    <?php the_title(); ?>
                </h3>
            </a>

            <?php the_excerpt(); ?>

        </section>
    </div>
    <div class="section-footer">
        <a href="<?php the_permalink(); ?>" class="footer-link">
            <p>Read More</p>
        </a>
        <a href="<?php the_permalink(); ?>" class="top-view"><img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/view-icon.png" alt="view" class="view icon"></a>
    </div>
</div>

          