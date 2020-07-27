<!DOCTYPE html>
<html>

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mazil</title>
    <meta name="mazil" content="a blog template for touring the world">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <?php wp_head();?>
</head>

<body>

    <header>
        <a href="<?php echo get_bloginfo( 'wpurl' );?>"><h1 class="title"><?php echo get_bloginfo( 'name' ); ?></h1></a>
        
        <p class="header-text"><?php echo get_bloginfo( 'description' ); ?></p>
    </header>
    
    <div class="grid">
        <nav class="nav-home">
            	<?php wp_list_pages( '&title_li=' ); ?>
        </nav>