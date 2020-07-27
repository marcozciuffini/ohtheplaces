<?php

/*
template name: home
*/

get_header();


$count = 0;

				$query = new WP_Query(array(
							  'posts_per_page'   => 10
						  ));

						  while ($query->have_posts()): $query->the_post();

if ($count == 0) : ?>


<div class="section-grid" id="last-post">
    <div class="section-heading">
        <h2>
            Last Post
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


<div class="section-grid" id="posts">
    <div class="section-heading">
        <h2>4 More</h2>
    </div>
    <div class="section-container">
        <section class="posts">
            <?php
endif; 
if ( $count == 1 ) : ?>

            <div class="top-post post">
                <a href="<?php the_permalink(); ?>" class="post-link">
                    <h3>
                        <?php the_title(); ?>
                    </h3>
                    <div class="view-container"><img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/view-icon.png" alt="view" class="view posts-view"></div>
                </a>
            </div>
            <?php               
                    endif;
            ?>

            <?php if ( $count >= 2 ) : ?>

            <div class="post">
                <a href="<?php the_permalink(); ?>" class="post-link">
                    <h3>
                        <?php the_title(); ?>
                    </h3>
                    <div class="view-container"><img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/view-icon.png" alt="view" class="view posts-view"></div>
                </a>
            </div>
            <?php               
                    endif;
                    $count++; 
                    endwhile;
                    wp_reset_query(); 
                    ?>
        </section>
    </div>

    <div class="section-footer">
        <a href="http://localhost/wordpress/posts/" class="footer-link">
            <p>View All</p>
        </a>
    </div>
</div>



<div class="section-grid" id="me">

    <div class="section-heading">
        <h2>Me</h2>
    </div>
    <div class="section-container">
        <section>
            <div class="grid-container me-container">
                <img src="<?php the_field('me_img'); ?>" alt="Me!" class="me-jpg">
                <div class="me-description"><strong>
                        <p>
                            <?php echo get_post_meta($post->ID, 'about_me', true); ?>
                        </p>
                    </strong>
                </div>
            </div>
        </section>
    </div>
    <div class="section-footer">
        <a href="<?php the_field('facebook'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/facebook-icon.png" class="tray-icon"></a>
        <a href="<?php the_field('instagram'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/insta-icon.png" class="tray-icon"></a>
        <a href="<?php the_field('twitter'); ?>" target="_blank"><img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/twitter-icon.png" class="tray-icon"></a>
    </div>
</div>


<div class="section-grid" id="photos">

    <div class="section-heading">
        <h2>Photos</h2>
    </div>
    <div class="section-container photo-container">
        <section class="photos">
            <div id="tinderslide">
                <ul>

<?php $images = acf_photo_gallery('home_gallery', $post->ID);
                   
foreach ($images as $image) {
    if( !empty($image) ): ?>
                    <li class="pane<?php echo(rand(1, 5));?>">
                        <div class="img">
                            <img src="<?php echo $image['full_image_url']; ?>" alt="<?php echo $image['title']; ?>" />
                        </div>
                        <div>
                            <h4>
                                <?php echo $image['caption']; ?>
                            </h4>
                        </div>
                        <div class="like"></div>
                        <div class="dislike"></div>
                    </li><?php
                 endif;
                };
    
                ?>                
                    
                </ul>
            </div>

        </section>
    </div>

    <div class="actions section-footer">
        <a href="#" class="dislike"><img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/dislike-icon.png" class="icon"></a>
        <a href="http://localhost/wordpress/photos" class="view-all">
            <p>View All</p>
        </a>
        <a href="#" class="like"><img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/like-icon.png" class="icon"></a>
    </div>
</div>

<div class="section-grid" id="currently">
    <div class="section-heading">
        <h2>Currently</h2>
    </div>
    <div class="section-container">
        <section>
            <div class="grid-container">
                <div class="media-type show" id="book">
                    <div class="media-heading">
                        <img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/book-icon.png" alt="book-icon" class="icon">
                        <h4>Reading</h4>
                    </div>

                    <img src="<?php the_field('book_image'); ?>" alt="title" class="media-image">

                    <table class="table">
                        <tr>
                            <th>Title :</th>
                            <td>
                                <?php echo get_post_meta($post->ID, 'book_title', true); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Author :</th>
                            <td>
                                <?php echo get_post_meta($post->ID, 'book_author', true); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Genre :</th>
                            <td>
                                <?php the_field('book_genre'); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Rating :</th>
                            <td>
                                <?php echo get_post_meta($post->ID, 'book_rating', true); ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="media-type" id="music">
                    <div class="media-heading">
                        <img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/music-icon.png" alt="music-icon" class="icon">
                        <h4>Listening</h4>

                    </div>

                    <img src="<?php the_field('music_image'); ?>" alt="<?php echo get_post_meta($post->ID, 'music_title', true); ?>" class="music-image">

                    <table class="table">
                        <tr>
                            <th>Title :</th>
                            <td>
                                <?php echo get_post_meta($post->ID, 'music_title', true); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Artist :</th>
                            <td>
                                <?php echo get_post_meta($post->ID, 'music_artist', true); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Genre :</th>
                            <td>
                                <?php the_field('music_genre'); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Rating :</th>
                            <td>
                                <?php echo get_post_meta($post->ID, 'music_rating', true); ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="media-type" id="film">
                    <div class="media-heading">
                        <img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/film-icon.png" alt="film-icon" class="icon">
                        <h4>Watching (Film)</h4>

                    </div>

                    <img src="<?php the_field('film_image'); ?>" alt="<?php echo get_post_meta($post->ID, 'film_title', true); ?>
" class="media-image">

                    <table class="table">
                        <tr>
                            <th>Title :</th>
                            <td>
                                <?php echo get_post_meta($post->ID, 'film_title', true); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Director :</th>
                            <td>
                                <?php echo get_post_meta($post->ID, 'film_director', true); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Genre :</th>
                            <td>
                                <?php the_field('film_genre'); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Rating :</th>
                            <td>
                                <?php echo get_post_meta($post->ID, 'film_rating', true); ?>
                            </td>
                        </tr>
                    </table>
                </div>


                <div class="media-type" id="series">
                    <div class="media-heading">
                        <img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/tv-icon.png" alt="tv-icon" class="icon">
                        <h4>Watching
                            (Series)</h4>
                    </div>

                    <img src="<?php the_field('series_image'); ?>" alt="<?php echo get_post_meta($post->ID, 'series_title', true); ?>" class="media-image">

                    <table class="table">
                        <tr>
                            <th>Title :</th>
                            <td>
                                <?php echo get_post_meta($post->ID, 'series_title', true); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Platform :</th>
                            <td>
                                <?php echo get_post_meta($post->ID, 'series_platform', true); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Genre :</th>
                            <td>
                                <?php the_field('series_genre'); ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Rating :</th>
                            <td>
                                <?php echo get_post_meta($post->ID, 'series_rating', true); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <div class="section-footer media-footer">
        <a class="icon-container"><img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/film-icon.png" alt="film-icon" id="tray-film" data="film" class="tray-icon media-icon"></a>
        <a class="icon-container"><img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/music-icon.png" alt="music-icon" id="tray-music" data="music" class="tray-icon media-icon"></a>
        <a class="icon-container"><img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/tv-icon.png" alt="tv-icon" id="tray-series" data="series" class="tray-icon media-icon"></a>
        <a class="icon-container"><img src="<?php echo get_bloginfo('template_directory'); ?>/pictures/book-icon.png" alt="book-icon" id="tray-book" data="book" class="tray-icon media-icon"></a>
    </div>
</div>

<div class="section-grid" id="been">
    <div class="section-heading">
        <h2><?php the_field('box_title'); ?></h2>
    </div>
    <div class="section-container">
        <section>
            <img src="<?php the_field('been_'); ?>" alt="been-map" class="been">
        </section>
    </div>
    <div class="section-footer">
        <a href="<?php the_field('link'); ?>" class="footer-link">
            <p>Download App</p>
        </a></div>
</div>


<?php get_footer(); ?>
