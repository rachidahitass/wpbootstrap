<?php get_header(); ?>
<div class="container index">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Blog Posts</h3>
                </div>
            <?php if( have_posts() ): ?> 
            <?php $i=0 ?>
            <?php while(have_posts()):the_post() ?>
                <div class="panel-body">
                    <div class="row">
                        <article <?php post_class('post-'.$i) ?>>
                            <?php if( has_post_thumbnail() ): ?>
                                <div class="col-md-3">
                                    <?php $attr = array(
                                        'class' => 'img-responsive' 
                                    ) ?>
                                    <?php the_post_thumbnail('', $attr); ?>
                                </div>
                            <?php endif; ?>
                                <div class="<?php echo has_post_thumbnail() ? 'col-md-9' : 'col-md-12'  ?>">
                                    <?php the_title('<h3 class="post-title"><a href="'.get_the_permalink().'">','</a></h3>'); ?>
                                    <ul class="meta list-inline well well-sm">
                                        <li>Posted on: <?php the_time() ?></li>
                                        <li>At: <?php the_date('F d, Y'); ?></li>
                                        <li>By: <?php the_author(); ?></li>
                                    </ul>
                                    <div class="content">
                                    <?php the_excerpt(); ?>
                                    </div>
                                </div>
                        </article>
                    </div>
                </div><!-- End Panel Body -->
                <?php $i++ ?>
                <?php endwhile; ?>
                <?php endif; ?>
            </div><!-- End Panel -->
        </div><!-- End Content Area -->
        <?php if( is_active_sidebar('sidebar') ): ?>
        <div class="col-md-3">
            <?php dynamic_sidebar('sidebar'); ?>
        </div><!-- End Sidebar -->
        <?php endif; ?>
    </div><!-- End Top Row -->
</div><!-- End Top Container -->
<?php get_footer(); ?>