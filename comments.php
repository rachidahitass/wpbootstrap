<?php ?>
<div class="comments">
    <?php if( comments_open() || get_comment_count() ): ?>
        <h3 class="comments-title">
            <?php if(get_comment_count() == 1):
                echo get_comment_count( ) . ' comment';
                else:
                echo get_comment_count() . 'comments';
                endif;
            ?>
    <?php endif; ?>
</div>