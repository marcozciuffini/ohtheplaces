
<?php

/*
 Template Name: Photos
*/

get_header();

$galleries = array(
    array(  "photos"    => acf_photo_gallery('gallery8', $post->ID),
            "title"     =>get_post_meta($post->ID, 'gallery_title8', true),
//            "order"     => the_field('order7'),
            "name"      => "id8"
                 ),
    array(  "photos"    => acf_photo_gallery('gallery7', $post->ID),
            "title"     => get_post_meta($post->ID, 'gallery_title7', true),
//            "order"     => the_field('order6'),
            "name"      => "id7"
         ),
    array(  "photos"    => acf_photo_gallery('gallery6', $post->ID),
            "title"     => get_post_meta($post->ID, 'gallery_title6', true),
//            "order"     => the_field('order5'),
            "name"      => "id6"
                ),
    array(  "photos"    => acf_photo_gallery('gallery5', $post->ID),
            "title"     => get_post_meta($post->ID, 'gallery_title5', true),
//            "order"     => the_field('order5'),
            "name"      => "id5"
                ),
    array(  "photos"    => acf_photo_gallery('gallery4', $post->ID),
            "title"     => get_post_meta($post->ID, 'gallery_title4', true),
            "name"      => "id4",
            "order"     => the_field('order4')
                ),
    array(  "photos"    => acf_photo_gallery('gallery3', $post->ID),
            "title"     => get_post_meta($post->ID, 'gallery_title3', true),
//            "order"     => the_field('order3'),
            "name"      => "id3"
                ),
    array(  "photos"    => acf_photo_gallery('gallery2', $post->ID),
            "title"     => get_post_meta($post->ID, 'gallery_title2', true),
//            "order"     => the_field('order2'),
            "name"      => "id2"
                ),
    array(  "photos"    => acf_photo_gallery('gallery1', $post->ID),
            "title"     => get_post_meta($post->ID, 'gallery_title1', true),
//            "order"     => the_field('order1'),
            "name"      => "id1"
                ),
    array(  "photos"    => acf_photo_gallery('gallery0', $post->ID),
            "title"     => get_post_meta($post->ID, 'gallery_title0', true),
//            "order"     => the_field('order0'),
            "name"      => "id0"
                ),
);


        foreach ($galleries as $gallery) : ;
        if ( !empty($gallery['photos']) ) : ;
?>


<div class="photo-category">
    <div class="category-heading-container">
        <h2 class="category-heading">
            <?php echo $gallery['title']; ?>
        </h2>
        <p class="toggle-photos" id="<?php echo $gallery['name']; ?>">See More</p>
    </div>

    <div class="absolute photo-group <?php echo $gallery['name']; ?>">


        <?php
        $images = $gallery["photos"];

        foreach ($images as $image): ?>

        <div class="pane<?php echo(rand(1, 5));?> page-pane">
            <div class="img img-page">
                <img src="<?php echo $image['full_image_url']; ?>" alt="<?php echo $image['title']; ?>">
            </div>
            <div>
                <h4 class="photo-caption">
                    <?php echo $image['caption']; ?>
                </h4>
            </div>
        </div>

        <?php endforeach; ?>

    </div>
</div>

<?php endif; endforeach; ?>










<?php get_footer(); ?>
