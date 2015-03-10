<?php

//=============================================================================
//  出力処理
//=============================================================================

// トップ画面 - カテゴリ「おすすめ」に属する物だけ一覧化
if (is_home()) {
  // 変数 $wp_query を上書き
/**
  $wp_query = get_recommend(array('paged' => $paged));
  while ($wp_query->have_posts()) {
    $wp_query->the_post();
    get_template_part('loop','base');
  }
}
*/
  while (have_posts()) {
    the_post();
    get_template_part('loop','base');
  }
}
// 詳細画面/カテゴリ一覧など
else {
  while (have_posts()) {
    the_post();
    get_template_part('loop','base');
  }
}
