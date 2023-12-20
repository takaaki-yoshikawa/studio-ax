<?php


//スマホ版のみ表示件数10件  
add_action('pre_get_posts','change_limit_mobile');
 
function change_limit_mobile($query){
 
    $new_limit = 4;
 
    $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    $ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
 
    if (( $iphone || $android || $ipad || $ipod || $berry ) && $query->is_main_query()){
        set_query_var('posts_per_page',$new_limit);
    }
}
//抜粋の文字数
function my_length($length){
  return 50;
}

add_filter('excerpt_mblength','my_length');

//抜粋の省略記号
function my_more($more){
  return '…';
}

add_filter('excerpt_more','my_more');

//コンテンツの最大幅
if(!isset($content_width)){
  $content_width = 747;
}

//Youtubeのビデオ : <div>でマークアップ
function ytwrapper($return,$data,$url){
  if($data->provider_name == "YouTube"){
    return '<div class="ytvideo">'.$return.'</div>';
  }else{
    return $return;
  }
}

add_filter('oembed_dataparse','ytwrapper',10,3);

//Youtubeのビデオ：キャッシュをクリア
function clear_ytwrapper($post_id){
  global $wp_embed;
  $wp_embed->delete_oembed_caches($post_id);
}

add_action('pre_post_update', 'clear_ytwrapper');

//アイキャッチ画像
add_theme_support('post-thumbnails');

//編集画面設定エラーなる
//(見出し１)の削除
function custom_editor_settings( $initArray ){
  $initArray['block_formats'] = "段落=p; 見出し2=h2; 見出し3=h3; 見出し4=h4; 見出し5=h5; 見出し6=h6;";

  //スタイル
  $style_formats = array(
    array(
      'title' => '補足情報',
      'block' => 'div',
      'classes' => 'point',
    ),
    array(
      'title' => '注意書き',
      'block' => 'div',
      'classes' => 'attention',
    ),
    array(
      'title' => 'ハイライト',
      'inline' => 'span',
      'classes' => 'highlight',
    ),
    array(
      'title' => '目次',
      'inline' => 'div',
      'classes' => 'mokuji',
    )
  );
  $initArray['style_formats'] = json_encode($style_formats);

  return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );

//スタイルメニューを有効化
function add_stylemenu($buttons){
  array_splice($buttons,1,0,'styleselect');
  return $buttons;
}
add_filter('mce_buttons_2','add_stylemenu' );

//エディタスタイルシート
add_editor_style( get_template_directory_uri() . '/editor-style.css?ver='.date('U') );
add_editor_style('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

//サムネイル画像
function mythumb($size){
  global $post;

  if(has_post_thumbnail() ){

    $postthumb = wp_get_attachment_image_src(get_post_thumbnail_id(),$size);
    $url = $postthumb[0];

  }elseif(preg_match('/wp-image-(\d+)/s',$post->post_content,$thumbid)){

    $postthumb = wp_get_attachment_image_src($thumbid[1],$size);
    $url = $postthumb[0];

  }else{
    $url = get_template_directory_uri() . '/graphic_img2.png';
  }
  return $url;
}

//カスタムメニュー
register_nav_menu('sitenav','サイトナビゲーション');
register_nav_menu('pickupnav','おすすめ記事');

//前後の記事に関するメタデータの出力を禁止
remove_action('wp_head','adjacent_posts_rel_link_wp_head',10,0);

//クローラーからのアクセスを判別
function is_bot(){
  $ua = $_SERVER['HTTP_USER_AGENT'];
  $bots = array(
    "googlebot",
    "msnbot",
    "yahoo"
  );
  foreach($bots as $bot){
    if(stripos($ua,$bot )!== false){
      return true;
    }
  }
  return false;
}

//ウィジェットエリア
register_sidebar( array(
  'id' => 'submenu',
  'name' => 'サブメニュー',
  'description' => 'サイドバーに表示するウィジェットを指定。',
  'before_widget' => '<aside id="%1$s" class="mymenu widget %2$s">',
  'after_widget' => '</aside>',
  'before_title' => '<h2 class="widgettitle">',
  'after_title' => '</h2>'
));

//検索フォーム
add_theme_support('html5',array('search-form') );

//ビジュアルエディタに目次ボタン追加   
function editor_add_buttons($array) {
  array_push($array, 'styleselect','fontsizeselect');
  return $array;
}
add_filter('mce_buttons', 'editor_add_buttons');