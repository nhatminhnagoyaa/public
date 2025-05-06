<?php

/**
 * The header for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <meta name="keywords" content="WordPress, Theme, Contact, News, Tops">
    <meta name="author" content="<?php bloginfo('name'); ?>">
    <meta name="robots" content="index, follow">
    <meta name="google-site-verification" content="your-google-site-verification-code" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="destyle.css">
    <link rel="stylesheet" href="style.css">
    <title>
        <?php bloginfo('name'); ?>
    </title>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="header-container">
            <div class="site-branding">
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
                </h1>
                <p class="site-description"><?php bloginfo('description'); ?></p>
            </div>
            <nav class="main-navigation">
                <ul class="nav-menu">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">HOME</a></li>
                    <li><a href="<?php echo esc_url(home_url('/english')); ?>">ENLISH</a></li>
                    <li><a href="<?php echo esc_url(home_url('/access')); ?>">ACCESS</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>">CONTACT</a></li>
                    <li><a href="<?php echo esc_url(home_url('/sitemap')); ?>">SITEMAP</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <?php
    ?>