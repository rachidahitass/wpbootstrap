<?php get_header(); ?>
<div class="container index">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                <h3 class="panel-title">Blog Posts</h3>
                </div>
            <?php if( have_posts() ): ?> 
            <?php while(have_posts()):the_post() ?>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <?php if( has_post_thumbnail() ): ?>
                                <?php the_post_thumbnail() ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-9">
                            <?php the_title('<h3>','</h3>'); ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
            </div>
        </div>
    <?php if( is_active_sidebar('sidebar') ): ?>
        <div class="col-md-4">
            <?php dynamic_sidebar('sidebar'); ?>
        </div>
    <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>