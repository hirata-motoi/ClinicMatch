<?php
/**
 * PECO functions and definitions
 *
 *
 * @package WordPress
 * @subpackage PECO Original
 * @author PECO <info@peco-japan.com>
 * @version PECO Original Theme 1.0
 * @since PECO Original Theme 1.0
 */

//=============================================================================
//  デフォルトの表示や機能を上書きする処理
//=============================================================================

  /**
   * メンテナンスモード
   *
   * @since PECO Original Theme 1.0
   */
  // add_action('get_header', 'wp_maintenance_mode');
  function wp_maintenance_mode()
  {
    if (!current_user_can('edit_themes') || !is_user_logged_in())
    {
      wp_die('<h1>ただいまメンテナンス中です。</h1>');
    }
  }

  /**
   * wp_head から不要なものを削除
   *
   * @since PECO Original Theme 1.0
   */
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'index_rel_link');
  remove_action('wp_head', 'start_post_rel_link');
  remove_action('wp_head', 'parent_post_rel_link');
  remove_action('wp_head', 'adjacent_posts_rel_link');

  /**
   * インラインスタイルを削除
   *
   * @since PECO Original Theme 1.0
   */
  add_action('widgets_init', 'remove_recent_comments_style');
  function remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action('wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ));
  }

  /**
   * 抜粋文の表示文字数を100から500に変更
   *
   * @since PECO Original Theme 1.0
   */
  add_filter('excerpt_mblength', 'new_excerpt_mblength');
  function new_excerpt_mblength($length) {
    return 500;
  }

  /**
   * html タグ自動挿入解除
   *
   * @since PECO Original Theme 1.0
   */
  remove_filter('the_content', 'wpautop');
  remove_filter('the_excerpt', 'wpautop');
  remove_filter('the_content', 'make_clickable');

  /**
   * アイキャッチ画像の追加
   *
   * @since PECO Original Theme 1.0
   */
  add_theme_support('post-thumbnails');
  add_image_size('original-thumbnail-OGP', 640, 640, true);

  /**
   * メインクエリの内容を変更する
   *
   * @since PECO Original Theme 1.0
   */
  add_action('pre_get_posts', 'modify_main_queries');
  function modify_main_queries($query)
  {
    if (!is_admin() && $query->is_main_query())
    {
      if ($query->is_home())
      {
        $query->set('post_type', array('post')); // ★
      }
    }
  }

  /**
   * WPが用意したjQueryを読み込まない
   *
   * @since PECO Original Theme 1.0
   */
  add_action('wp_print_scripts', 'deregister_jquery');
  function deregister_jquery()
  {
    if(!is_admin())
    {
      wp_deregister_script('jquery');
    }
  }

  /**
   * 投稿時のimageタグから要らない記述を消す
   *
   * @since PECO Original Theme 1.0
   */
  add_filter('get_image_tag','remove_img_attr', 10, 6);
  add_filter('post_thumbnail_html', 'remove_img_attr', 10);
  function remove_img_attr($html)
  {
    $html = preg_replace('/title=[\'"]([^\'"]+)[\'"]/i', '', $html);
    $html = preg_replace('/ class=[\'"]([^\'"]+)[\'"]/i', '', $html);
    $html = preg_replace('/(height)="\d*"\s/', '', $html);
    return $html;
  }

  /**
   * プラグインのCSSを読み込まない
   *
   * @since PECO Original Theme 1.0
   */
  // add_action('wp_print_styles', 'deregister_wp_print_styles', 100);
  // function deregister_wp_print_styles() {
  //   wp_deregister_style('hoge');
  // }

  /**
   * プラグインのJavaScriptを読み込まない
   *
   * @since PECO Original Theme 1.0
   */
  // add_action( 'wp_print_scripts', 'deregister_wp_print_script', 100 );
  // function deregister_wp_print_script() {
  //   wp_deregister_script('hoge');
  // }

  /**
   * セルフピングバックを停止
   *
   * @since PECO Original Theme 1.0
   */
  add_action('pre_ping', 'no_self_ping');
  function no_self_ping(&$links)
  {
    $home = get_option('home');
    foreach ($links as $l => $link)
      if (0 === strpos( $link, $home))
        unset($links[$l]);
  }

//=============================================================================
//  関数
//=============================================================================

  /**
   * アイキャッチ画像のURLを取得
   *
   * @param string $image_size アイキャッチ画像の名前
   * @param string $type echoするなら 'e' を第二引数に渡す
   * @return string アイキャッチ画像のURL
   * @since PECO Original Theme 1.0
   */
  function get_featured_image_url($image_size, $type = '')
  {
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src($image_id, $image_size, true);

    if ($type === 'e')
    {
      echo $image_url[0];
    }
    else
    {
      return $image_url[0];
    }
  }

  /**
   * 記事内最初の画像のURLを取得
   *
   * @param string $image_size アイキャッチ画像の名前
   * @param string $type echoするなら 'e' を第二引数に渡す
   * @return string 記事内最初の画像のURL
   * @since PECO Original Theme 1.0
   */
  function get_first_image_url($type = '') {

    global $post, $posts;

    $image_url = '';
    if (preg_match('/<img.+?src=([\'"])([^\1]+?)\1/i', $post->post_content, $matches)) {
      $image_url = $matches[2];
    }

    if ($type === 'e')
    {
      echo $image_url;
    }
    else
    {
      return $image_url;
    }
  }

  /**
   * 記事内最初の画像のURLを取得
   *
   * @param string $image_size アイキャッチ画像の名前
   * @param string $type echoするなら 'e' を第二引数に渡す
   * @return string 記事内最初の画像のURL
   * @since PECO Original Theme 1.0
   */
  function get_first_image_url_by_id($post_id) {
    $post = get_post($post_id);
    setup_postdata($post);

    $image_url = '';
    if (preg_match('/<img.+?src=([\'"])([^\1]+?)\1/i', $post->post_content, $matches)) {
      $image_url = $matches[2];
    }

    wp_reset_postdata();

    return $image_url;
  }

  /**
   * IDを指定して抜粋分を取得する
   *
   * @param string $post_id 記事ID
   * @return string 指定されたIDの抜粋文
   * @since PECO Original Theme 1.0
   */
  function get_excerpt_by_id($post_id) {
    $post = get_post($post_id);
    setup_postdata($post);

    $excerpt = get_the_excerpt();

    wp_reset_postdata();

    return $excerpt;
  }

  /**
   * タグクラウドの出力を調整
   *
   * @since PECO Original Theme 1.0
   */
  function original_tag_list()
  {
    $tags = wp_tag_cloud(
      array(
        'format' => 'array',
        'smallest' => '10',
        'largest' => '10',
        'number' => 45,//'10',
        'order' => 'DESC',
        'orderby' => 'count'
      )
    );

    if ($tags) {
      echo '<ul>'."\n";
      foreach ($tags as $tag) {
        preg_match('/href=\'http:\/\/.+?\'/', $tag, $matche);
        $href = $matche[0];
        // preg_match('/style=\'.+?\'/', $tag, $matche);
        // $score = round(floatval(preg_replace('/[^0-9\.]/', '', $matche[0])));
        // $class_score = "tag-score-{$score}";
        preg_match('/title=\'.+?\'/', $tag, $matche);
        $title = $matche[0];
        $name  = strip_tags($tag);
        $count = mb_ereg_replace('[^0-9]', '', $title);
        $post_count = 1;
        echo '<li><a '.$href.' '.$title.'>'.$name.' ('.$count.')</a></li>'."\n";
        $post_count++;
      }
      echo '</ul>'."\n";
    } else {
      echo '<p>タグがありません</p>'."\n";
    }
  }

  /**
   * ピックアップされている記事を取得します。
   *
   * 取得した記事は、内部でキャッシュし、以降はキャッシュしたデータを返します。
   *
   * @return WP_Query 取得結果
   */
  function get_pickup()
  {
    static $pickup;

    if (!isset($pickup)) {
      $args = array(
        'category__and'  => array(
          //get_category_by_slug('recommend')->term_id,
          get_category_by_slug('pickup')->term_id,
        ),
        'posts_per_page' => 3,
      );

      $pickup = new WP_Query($args);
    }

    return $pickup;
  }

  /**
   * おすすめの記事を取得します。
   *
   * @param  array $options 追加パラメータ
   * @return WP_Query 取得結果
   */
  function get_recommend(array $options = array())
  {
    $ignore = array();
    $pickup = get_pickup();
    if ($pickup->have_posts()) {
      foreach ($pickup->posts as $post) {
        $ignore[] = $post->ID;
      }
    }

    $args = array_merge($options, array(
      'category_name' => 'recommend',
      'post__not_in'  => $ignore,
    ));

    $result = new WP_Query($args);
    return $result;
  }

  /**
   * テンプレートを読み込みます。
   *
   * Usage:
   *   get_template_part_ex('slug', 'name', array('foo' => 'bar'));
   *   
   * @param  string slug
   * @param  string|null|array $name
   * @param  array data
   * @return void
   * @see get_template_part
   */
  function get_template_part_ex($slug, $name = null, array $data = array())
  {
    if (is_array($name))
    {
      $data = $name;
      $name = null;
    }

    do_action("get_template_part_{$slug}", $slug, $name);
    $template = array();
    $name = (string) $name;
    if ('' !== $name) {
      $templates[] = "{$slug}-{$name}.php";
    }
    $templates[] = "{$slug}.php";

    ob_start();
    extract($data);
    include locate_template($templates);
    echo ob_get_clean();
  }

  /**
   * UA分岐
   *
   * @return boolean true かfalseを返す
   * @since PECO Original Theme 1.0
   */
  $agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";
  // iPhone
  function is_iphone()
  {
    global $agent;
    return( preg_match('/iPhone/',$agent) || preg_match('/iPod/',$agent));
  }
  // iPad
  function is_ipad()
  {
    global $agent;
    return( preg_match('/iPad/',$agent));
  }
  // Android
  function is_android()
  {
    global $agent;
    return( preg_match('/Android/',$agent));
  }
  // Windows
  function is_windows()
  {
    global $agent;
    return( preg_match('/Windows/',$agent));
  }
  // Mac
  function is_mac()
  {
    global $agent;
    return( preg_match('/Mac/',$agent));
  }
  // IE6
  function is_ie6()
  {
    global $agent;
    return( preg_match('/MSIE 6/',$agent));
  }
  // IE7
  function is_ie7()
  {
    global $agent;
    return( preg_match('/MSIE 7/',$agent));
  }
  // IE8
  function is_ie8()
  {
    global $agent;
    return( preg_match('/MSIE 8/',$agent));
  }
  // IE9
  function is_ie9()
  {
    global $agent;
    return( preg_match('/MSIE 9/',$agent));
  }
  // Firefox
  function is_firefox()
  {
    global $agent;
    return( preg_match('/Firefox/',$agent));
  }
  // Chrome
  function is_chrome()
  {
    global $agent;
    return( preg_match('/Chrome/',$agent));
  }
  // Safari
  function is_safari()
  {
    global $agent;
    return( preg_match('/AppleWebKit/',$agent)&& !preg_match('/iPhone/',$agent)&& !preg_match('/iPod/',$agent));
  }
  // IE
  function is_ie()
  {
    return(is_ie6() || is_ie7() || is_ie8() || is_ie9());
  }
  // PC
  function is_pc()
  {
    return(is_ie() || is_firefox() || is_chrome() || is_safari());
  }
  // FeaturePhone
  function is_featurephone()
  {
    return(is_docomo() || is_au() || is_softbank());
  }
  // SmartPhones
  function is_smartphone()
  {
    return(is_iphone() || is_android());
  }

//=============================================================================
//  拡張機能にかかる設定
//=============================================================================

  /**
   * Widget を追加する
   *
   * @since PECO Original Theme 1.0
   */
  if (function_exists('register_sidebar'))
    register_sidebar(array(
    'name' => 'PECO_Widget_1',
    'before_widget' => '<aside class="blk-articleList">'."\n",
    'after_widget' => '</aside>'."\n",
    'before_title' => '<h2 class="title"><span class="icon-pad-org">',
    'after_title' => '</span></h2>'."\n"
  ));
  if (function_exists('register_sidebar'))
    register_sidebar(array(
    'name' => 'PECO_Widget_2',
    'before_widget' => '<aside class="blk-pageList">'."\n",
    'after_widget' => '</aside>'."\n",
    'before_title' => '<h2 class="title"><span class="icon-pad-org">',
    'after_title' => '</span></h2>'."\n"
  ));

//=============================================================================
//  管理画面制御
//=============================================================================

  /**
   * デフォルトのエディタを HTML エディタにする
   *
   * @since PECO Original Theme 1.0
   */
  add_filter('wp_default_editor', create_function('', 'return "html";'));

  /**
   * 表示制御用 CSS を読み込む
   *
   * @since PECO Original Theme 1.0
   */
  // add_action('admin_head', 'wp_custom_admin_css', 100);
  // function wp_custom_admin_css()
  // {
  //   $dir = get_bloginfo('template_url').'/shared/css/';
  //   echo "\n".'<link rel="stylesheet" href="'.$dir.'admin.css'.'" />';
  // }

  /**
   * 表示制御用 JS を読み込む
   *
   * @since PECO Original Theme 1.0
   */
  // add_action('admin_head', 'wp_custom_admin_js', 100);
  // function wp_custom_admin_js()
  // {
  //   $dir = get_bloginfo('template_url').'/shared/js/';
  //   echo "\n".'<script src="'.$dir.'admin.js"></script>'."\n";
  // }

  /**
   * 投稿一覧にサムネイルを表示
   *
   * @since PECO Original Theme 1.0
   */
  // add_filter('manage_posts_columns', 'custom_manage_columns');
  // add_action('manage_posts_custom_column', 'custom_add_columns', 10, 2);
  // function custom_manage_columns($columns)
  // {
  //   $columns['thumbnail'] = __('Thumbnail');
  //   return $columns;
  // }
  // function custom_add_columns($clumns, $post_id)
  // {
  //   // アイキャッチ取得
  //   if ($clumns == 'thumbnail')
  //   {
  //     $thumbnail = get_the_post_thumbnail($post_id, array(50,50), 'thumbnail');
  //   }
  //   // 使用していない場合「なし」を表示
  //   if (isset($thumbnail) && $thumbnail)
  //   {
  //     echo $thumbnail;
  //   }
  //   else
  //   {
  //     echo __('None');
  //   }
  // }

?>
