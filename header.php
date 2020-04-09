<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Photogenic
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html lang="<?php bloginfo('language');?>">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="profile" href="https://gmpg.org/xfn/11" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
<div class="container">
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo esc_url(home_url()); ?>">
                    <?php bloginfo('name'); ?>
                </a>
            </div>
            <?php
            wp_nav_menu( array(
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker())
            );
            ?>
                <!-- /.navbar-collapse -->
                <form method="get" action="<?php echo esc_url(home_url('/')) ?>" role="search" class="navbar-form navbar-left">
                    <div class="form-group">
                        <label for="navbar-search" class="sr-only"><?php _e('Search', 'textdomain'); ?></label>
                    <div class="form-group">
                        <input type="text" class="form-control" name="s" id="navbar-search" placeholder="search...">
                    </div>
                    <button type="submit" class="btn btn-default"><?php _e('Search', 'textdomain'); ?></button>
                </form>
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</div>
