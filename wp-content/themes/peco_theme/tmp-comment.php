<?php
$comments = get_comments(array('status' => 'approve' ,'number' => 5));
foreach($comments as $comment):
$post = get_post($comment->comment_post_ID);
?>
<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>へのコメント
(<?php comment_author_link(); ?>より[<?php comment_date('m/d'); ?>])
<?php comment_text(); ?></li>
<?php endforeach; ?>
