<!doctype html>
<html <?php language_attributes(); ?> >
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <title><?php wpa_title(); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php /* favicon */ ?>
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo theme(); ?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="<?php echo theme(); ?>/img/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="<?php echo theme(); ?>/img/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="<?php echo theme(); ?>/img/favicon/manifest.json">
    <link rel="mask-icon" href="<?php echo theme(); ?>/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="theme-color" content="#181818">
	<?php /* end favicon */ ?>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<div id="wrap">
    <header class="header">
        <div class="row1540 flex v-center">
            <?php $header_logo = get_field('header_logo', 'options');
            if($header_logo) { ?>
                <a href="<?php echo site_url(); ?>/" id="logo">
                    <img src="<?php echo $header_logo['url']; ?>" alt="logo">
                </a>
            <?php } ?>
            <nav class="main_nav  mobile_hide">
				<?php
				$main_nav = array(
					'theme_location' => 'main_menu',
					'menu'           => '',
					'container'      => false,
					'menu_class'     => 'level_a'
				);
				wp_nav_menu( $main_nav );
				?>
            </nav>
            <div class="icons">
                <div class="icon search-box">
                    <i class="fa fa-search search-icon" aria-hidden="true"></i>
                    <?php get_search_form(); ?>
                </div>
                <a href="#" class="icon account">
                    <img src="<?php echo theme(); ?>/img/user-icon.svg" alt="user">
                    <?php get_search_form(); ?>
                </a>
                <nav class="mobile-main-menu">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'main_menu',
                        'menu'           => '',
                        'container'      => false,
                        'menu_class'     => 'level_a'
                    ) ); ?>
                </nav>
                <div class="menu-burger"></div>
            </div>
        </div>
    </header>
