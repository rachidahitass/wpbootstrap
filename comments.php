<div class="comments">
    <?php if( comments_open() || get_comment_count() ): ?>
        <h3 class="comments-title">
            <?php 
            switch( get_comments_number() ){
                case '0':
                    echo "No comment";
                break;
                case '1':
                    echo get_comments_number() . ' comment';
                break;
                default:
                echo get_comments_number() . ' comments';
            }
            ?>
        </h3>
        <?php endif; ?>
        <ul class="row comments-lists">
            <?php
            $args = array(
                'avatar-size' => '64',
                'callback'  => 'add_theme_comments'
            );
                wp_list_comments();
            ?>
        </ul>
</div>