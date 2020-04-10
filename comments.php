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
                wp_list_comments(
                    array(
                        'avatar_size' => 48,
                        'callback'  => 'add_theme_comments'
                    )
                );
            ?>
        </ul>
    <?php if(!comments_open() && '0' != get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments"><?php _e('Comments are closed.', 'dazzling'); ?></p>
    <?php endif; ?>
</div>
<hr>
<?php
    $comments_args = array(
    // change the title of send button
    'label_submit'=>'Send',
    // change the title of the reply section
    'title_reply'=>'Write a Reply or Comment',
    // remove "Text or HTML to be displayed after the set of comment
    //fields"
    'comment_notes_after'=>'',
    // redefine your own textarea (the comment body)
    'comment_field'=>'<p class="comment-form-comment"><label for="comment">' ._x('Comment', 'noun') . '</label><br/>
    <textarea class="form-control" id="comment" name="comment" aria-required="true"></textarea></p>',
    );
    comment_form($comments_args);