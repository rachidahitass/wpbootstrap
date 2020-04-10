<?php get_header(); ?>
<div class="container index">
    <div class="row">
        <div class="col-md-9">
            <main class="main-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Blog Post</h3>
                </div>
            <?php if( have_posts() ): ?> 
            <?php $i=0 ?>
            <?php while(have_posts()):the_post() ?>
                <div class="panel-body">
                    <div class="row">
                        <article <?php post_class('post-'.$i) ?>>
                        <?php the_title('<h3>','</h3>'); ?>
                            <?php if( has_post_thumbnail() ): ?>
                                <div class="col-md">
                                    <?php $attr = array(
                                        'class' => 'img-responsive' 
                                    ) ?>
                                    <?php the_post_thumbnail('', $attr); ?>
                                </div>
                            <?php endif; ?>
                                <div class="col-md-12">
                                    
                                    <ul class="meta list-inline well well-sm">
                                        <li>Posted on: <?php the_time() ?></li>
                                        <li>At: <?php the_date('F d, Y'); ?></li>
                                        <li>By: <?php the_author(); ?></li>
                                    </ul>
                                    <div class="content">
                                    <?php the_content(); ?>
                                    </div>
                                </div>
                        </article>
                    </div>
                </div><!-- End Panel Body -->
                <?php $i++ ?>
                <?php endwhile; ?>
                <?php endif; ?>
            </div><!-- End Panel -->
            <?php if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>
            </main><!-- Main content Area -->
        </div><!-- End Content Area -->
        <?php if( is_active_sidebar('sidebar') ): ?>
        <div class="col-md-3">
            <aside class="sidebar">
                <?php dynamic_sidebar('sidebar'); ?>
            </aside><!-- end sideBar -->
        </div><!-- End Sidebar -->
        <?php endif; ?>
    </div><!-- End Top Row -->
</div><!-- End Top Container -->
<?php get_footer(); ?>