<?php

include 'variables.php';

//=============================================================================
//  変数など
//=============================================================================

/**
 * Pagination Modules 用 HTML タグ
 *
 * @see $startPagination
 * @see $endPagination
 */
$startPagination = <<< EOD
<div class="pagination">
EOD
;
$endPagination = <<< EOD
</div>
EOD
;

//=============================================================================
//  出力処理
//=============================================================================

/**
 * Pagination 開始
 *
 * @see $startPagination
 */
echo $startPagination."\n";

/**
 * 個別ページのページ送り
 *
 * @var $prev_post
 * @var $next_post
 */
if (is_single())
{
  $prev_post = get_previous_post();
  $next_post = get_next_post();
  $thmb_attr = array(
    'class'   => 'thumbnail'
  , 'alt'   => ''
  , 'title'   => ''
  );

  if ($next_post || $prev_post)
  {
    $thumb = $themeDir.'/resource/imgs/noimage_square.png';

    $out  = '<section>'."\n";
    $out .= '<h2 class="title"><span class="icon-pad-org">この記事と同じ頃に投稿されたおすすめの記事</span></h2>'."\n";

    // 前のページヘ
    if ($prev_post)
    {
      $title   = esc_attr( mb_substr($prev_post->post_title, 0, 30) );
      $link    = get_permalink( $prev_post->ID );
      $excerpt = get_excerpt_by_id($prev_post->ID);

      if (get_the_post_thumbnail())
      {
        $thumb_id   = get_post_thumbnail_id($prev_post->ID);
        $thumb_info = wp_get_attachment_image_src($thumb_id, 'thumbnail');
        $thumb      = $thumb_info[0];
      }
      elseif (get_first_image_url_by_id($prev_post->ID)) {
        $thumb = get_first_image_url_by_id($prev_post->ID);
      }

      $out .= '<article class="blk-orderList" itemprop="blogPost" itemscope="" itemtype="http://schema.org/BlogPosting">'."\n";
      $out .= '<figure class="blk-orderList_articleImage"><img src="'.$thumb.'" alt="" itemprop="image" title=""></figure>'."\n";
      $out .= '<div class="blk-orderList_articleBody" itemprop="description">'."\n";
      $out .= '<h1 itemprop="name"><a href="'.$link.'" itemprop="url">'.$title.'</a></h1>'."\n";
      $out .= '<p class="excerpt">'.$excerpt.'</p>'."\n";
      $out .= '</div>'."\n";
      $out .= '</article>'."\n";
    }
    // 次のページヘ
    if ($next_post)
    {
      $title   = esc_attr( mb_substr($next_post->post_title, 0, 30) );
      $link    = get_permalink( $next_post->ID );
      $excerpt = get_excerpt_by_id($next_post->ID);

      if (get_the_post_thumbnail())
      {
        $thumb_id   = get_post_thumbnail_id($next_post->ID);
        $thumb_info = wp_get_attachment_image_src($thumb_id, 'thumbnail');
        $thumb      = $thumb_info[0];
      }
      elseif (get_first_image_url_by_id($next_post->ID)) {
        $thumb = get_first_image_url_by_id($next_post->ID);
      }

      $out .= '<article class="blk-orderList" itemprop="blogPost" itemscope="" itemtype="http://schema.org/BlogPosting">'."\n";
      $out .= '<figure class="blk-orderList_articleImage"><img src="'.$thumb.'" alt="" itemprop="image" title=""></figure>'."\n";
      $out .= '<div class="blk-orderList_articleBody" itemprop="description">'."\n";
      $out .= '<h1 itemprop="name"><a href="'.$link.'" itemprop="url">'.$title.'</a></h1>'."\n";
      $out .= '<p class="excerpt">'.$excerpt.'</p>'."\n";
      $out .= '</div>'."\n";
      $out .= '</article>'."\n";
    }

    $out  .= '</section>'."\n";
    //echo $out;
  }
}

/**
 * 記事リストのページ送り
 *
 * @var $max_page
 */
else{
  global $paged;
  $max_page = $wp_query->max_num_pages;

  if (!empty($max_page))
  {
    $out  = '<ul class="blk-pagination">'."\n";
    // 前のページヘ
    if ($paged > 1)
    {
      $out .= '<li class="prev"><span>'.get_previous_posts_link('新しい記事をもっと見る').'</span></li>'."\n";
    }
    // 次のページヘ
    if ($paged < $max_page && $max_page != 1)
    {
      $out .= '<li class="next"><span>'.get_next_posts_link('古い記事をもっと見る').'</span></li>'."\n";
    }
    $out .= '</ul>'."\n";
    echo $out;
  }
}

/**
 * Pagination 終了
 *
 * @see $endPagination
 */
echo $endPagination."\n";

?>
