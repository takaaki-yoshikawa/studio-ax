<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta id="viewport" name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
  <title>大阪心斎橋 アメ村のダンススタジオ｜Studio AX</title>
  <link rel="stylesheet" href="/wp-content/themes/studio-ax/style.css?<?php echo date('Ymd-His'); ?>">
  <link rel="stylesheet" href="/wp-content/themes/studio-ax/tablet-min.css?<?php echo date('Ymd-His'); ?>">
  <link rel="stylesheet" href="/wp-content/themes/studio-ax/mobile-min.css?<?php echo date('Ymd-His'); ?>">
  <link rel="stylesheet" href="/wp-content/themes/studio-ax/mobile-side.css?<?php echo date('Ymd-His'); ?>">
  <script src="/wp-content/themes/studio-ax/src/js/lib/jquery-1.10.2.min.js"></script>
  <script src="/wp-content/themes/studio-ax/src/js/lib/jquery-ui-1.10.3.custom.min.js"></script>
  <script src="/wp-content/themes/studio-ax/src/js/main.js?<?php echo date('Ymd-His'); ?>"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="icon" href="/studio-ax/wp-content/themes/studio-ax/src/images/common/logo_mark-min.png" >
  <meta name="description" content="">
  <!--OGP FaceBook用 -->
  <meta property="fb:app_id" content="2238083329541347" />
  <!--OGP Twitter用 -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="Studio AX" />
  <meta name="twitter:description" content="大阪心斎橋のアメリカ村に位置するダンススタジオ「Studio AX」。初心者向けやキッズプログラム、プロダンサーまで各レべルに応じたクラスレッスンを行っております。ダンスだけでなく、ヨガやピラティスなどのボディバランスの為のレッスンも行うなど、毎週約100の幅広いレッスンを開催しております。" />
  <meta name="twitter:image" content="" />

  <!--記事の個別ページ用のメタデータ -->
  <?php if( is_single() || is_page() ): ?>
    <meta name="description" content="<?php echo wp_trim_words( $post->post_content, 100, '…' ); ?>">

    <?php if( has_tag() ): ?>
      <?php $tags = get_the_tags();
      $kwds = array();
      foreach($tags as $tag) {
        $kwds[] = $tag->name;
      } ?>
      <meta name="keywords" content="<?php echo implode( ',', $kwds ); ?>">
    <?php endif; ?>

    <meta property="og:type" content="article">
    <meta property="og:title" content="<?php the_title(); ?>">
    <meta property="og:url" content="<?php the_permalink(); ?>">
    <meta property="og:description" content="<?php echo wp_trim_words( $post->post_content, 100, '…' ); ?>">
    <meta property="og:image" content="<?php echo mythumb( 'large' ); ?>">
  <?php endif;?>
  <?php if( is_home() ): //トップページ用のメタデータ ?>
    <meta name="description" content="<?php bloginfo( 'description' ); ?>">

    <?php $allcats = get_categories();
    foreach($allcats as $allcat) {
      $kwds[] = $allcat->name;
    } ?>
    <meta name="keywords" content="<?php echo implode( ',', $kwds ); ?>">

    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo home_url( '/' ); ?>">
    <meta property="og:title" content="Studio AX">
    <meta property="og:description" content="大阪心斎橋のアメリカ村に位置するダンススタジオ「Studio AX」。初心者向けやキッズプログラム、プロダンサーまで各レべルに応じたクラスレッスンを行っております。ダンスだけでなく、ヨガやピラティスなどのボディバランスの為のレッスンも行うなど、毎週約100の幅広いレッスンを開催しております。">
    <meta property="og:image" content="">
  <?php endif; //トップページ用のメタデータ【ここまで】?>
</head>
<body class="Single__body">
  <header class="Header__ulayer">
    <div class="Header__wrap__ulayer Max__width">
      <a class="old_logo" href="/index.php">
        <img id="logo" src="/wp-content/themes/studio-ax/src/images/common/ax_logo.svg">
      </a>    
      <div class="Header__nav__ulayer">
        <div class="Header__nav__cover">
          <nav>
            <div class="Header__nav__body">
              <ul>
                <li><i class="fa fa-angle-right"></i><a href="/index.php">TOP</a></li>
                <li><i class="fa fa-angle-right"></i><a href="/about">ABOUT</a></li>
                <li><i class="fa fa-angle-right"></i><a href="/instructor">INSTRUCTOR</a></li>
                <li><i class="fa fa-angle-right"></i><a href="/price">PRICE</a></li>
                <li><i class="fa fa-angle-right"></i><a href="/schedule">SCHEDULE</a></li>
                <li><i class="fa fa-angle-right"></i><a href="/rentalstudio">STUDIO</a></li>
                <li><i class="fa fa-angle-right"></i><a href="/contact">CONTACT</a></li>
              </ul>
              <ul class="ul__small first">
                
                <li><i class="fa fa-angle-right"></i><a href="/blog">BLOG</a></li>
                <li><i class="fa fa-angle-right"></i><a href="/contact#access">ACCESS</a></li>
                <li><i class="fa fa-angle-right"></i><a href="/faq">FAQ</a></li>
                <li><i class="fa fa-angle-right"></i><a href="/link">LINK</a></li>  
              </ul>
              <ul class="ul__small">
                <li><i class="fa fa-angle-right"></i><a href="/bbs">BBS</a></li>
                <li><i class="fa fa-angle-right"></i><a href="http://studio-ax.co.jp/info/%E2%98%85dance-mania-vol-20-%E8%A9%B3%E7%B4%B0%E3%83%BB%E6%B3%A8%E6%84%8F%E4%BA%8B%E9%A0%85%E3%81%AF%E3%82%B3%E3%83%81%E3%83%A9%E2%98%85">RECITAL INFO</a></li>
                <li class="Sns__li">
                  <a href="https://twitter.com/DanceStudioAX"><i class="fa fa-twitter"></i></a>
                          <a href="https://www.facebook.com/studioaxdance/"><i class="fa fa-facebook"></i></a>
                          <a href="https://www.instagram.com/studio_ax/"><i class="fa fa-instagram"></i></a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
      <div class="Header__nav__button">
        <div class="drawer">
          <div class="drbtn">
            <span class="hambarg"></span>
            <span class="hambarg"></span>
            <span class="hambarg"></span>
            <span class="hambarg"></span>
          </div><!--drbtn-->
        </div><!--drawer-->
        <img class="Naviimg" src="/wp-content/themes/studio-ax/src/images/header/navi.svg">
      </div>
    </div>
  </header>
  <main class="Page__main Page__news">
    <div class="Ignition__block Ignition__top1" id="fade-top-1"></div>
    <div class="Bread__list Max__width Single__bread">
      <ol>
        <li><a href="/index.php">TOP</a></li>
        <li><a href="/blog">Blog</a></li>
      </ol>
    </div>
    <div class="Page__news__wrap">
      <div class="Page__contents">
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
          <article <?php post_class('kiji'); ?>>
            <!--タイトル-->
            <div class="Page__contents__top">
              <div class="Article__a__date">
                <time datetime="<?php echo get_post_time( 'Y' ); ?>">
                  <?php echo get_post_time( 'Y' ); ?>
                </time>
                <time datetime="<?php echo get_post_time( 'M' ); ?>">
                  <?php echo get_post_time( 'M' ); ?>
                </time>
                <time datetime="<?php echo get_post_time( 'd' ); ?>">
                  <?php echo get_post_time( 'd' ); ?>
                </time>
              </div>
              <?php
              $cat = get_the_category();
              $catslug = $cat[0]->slug;
              ?>
              <div class="Article__category Category__label <?php echo $catslug; ?>">
                <?php $cats = get_the_category(); 
                echo $cats[0]->name; ?>
              </div>
            </div>
            <!--アイキャッチ-->
            <?php if(has_post_thumbnail() && $page ==1):?>
              <div class="Page__catch Article__a__cover">
                <?php the_post_thumbnail('full'); ?>
              </div>
            <?php endif; ?>
            <h1 class="Page__title"><?php the_title(); ?></h1>
            <hr>
            <div class="share share_top">
              <ul>
                <li class="shareLi"><a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( get_the_title().'-'.
                get_bloginfo('name') ); ?>&amp;url=<?php echo urlencode( get_permalink() ); ?>" onclick="window.open(this.href,'SNS','width=500,height=300,menubar=no,toolbar=no,scrollbars=yes');return false;" class="share-tw">
                <i class="fa fa-twitter"></i>
                <span>シェア</span>
              </a></li>
              <li class="shareLi"><a href="https://facebook.com/share.php?u=<?php echo urlencode( get_permalink() ); ?>"
                onclick="window.open(this.href,'SNS','width=500,height=500,menubar=no,toolbar=no,scrollbars=yes'); return false;" class="share-fb">
                <i class="fa fa-facebook"></i>
                <span>シェア</span>
              </a></li>
              <li class="shareLi"><a href="http://line.me/R/msg/text/?<?php the_title(); ?><?php the_permalink(); ?>" target="_blank" class="line-button share-line"><img src="/wp-content/themes/studio-ax/src/images/common/icons8-line_main.svg" alt="LINEでシェア" class="line_img">
                <span>シェア</span>
              </a></li>
              <li class="shareLi"><a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink() ); ?>"
                onclick="window.open(this.href,'SNS','width=500,height=500,menubar=no,toolbar=no,scrollbars=yes'); return false;" class="share-gp">
                <i class="fa fa-google-plus"></i>
                <span>シェア</span>
              </a></li>
              <li class="shareLi">
                <a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" class="share-hb">
                  <i class="fa-hatebu"></i>
                  <span>シェア</span>
                </a>
              </li>
            </ul>
          </div>

          <!--本文-->
          <div class="Page__body">
            <?php the_content(); ?>

          </div>
          <?php wp_link_pages(
            array(
              'before' => '<div class="pagination"><ul><li>',
              'separator' => '</li><li>',
              'after' => '</li></ul></div>',
              'pagelink' => '<span>%</span>'
            )
            ); ?>
            <div class="share share_top">
             <ul>
              <li class="shareLi"><a href="https://twitter.com/intent/tweet?text=<?php echo urlencode( get_the_title().'-'.
              get_bloginfo('name') ); ?>&amp;url=<?php echo urlencode( get_permalink() ); ?>" onclick="window.open(this.href,'SNS','width=500,height=300,menubar=no,toolbar=no,scrollbars=yes');return false;" class="share-tw">
              <i class="fa fa-twitter"></i>
              <span>シェア</span>
            </a></li>
            <li class="shareLi"><a href="https://facebook.com/share.php?u=<?php echo urlencode( get_permalink() ); ?>"
              onclick="window.open(this.href,'SNS','width=500,height=500,menubar=no,toolbar=no,scrollbars=yes'); return false;" class="share-fb">
              <i class="fa fa-facebook"></i>
              <span>シェア</span>
            </a></li>
            <li class="shareLi"><a href="http://line.me/R/msg/text/?<?php the_title(); ?><?php the_permalink(); ?>" target="_blank" class="line-button share-line"><img src="/wp-content/themes/studio-ax/src/images/common/icons8-line_main.svg" alt="LINEでシェア" class="line_img">
              <span>シェア</span>
            </a></li>
            <li class="shareLi"><a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink() ); ?>"
              onclick="window.open(this.href,'SNS','width=500,height=500,menubar=no,toolbar=no,scrollbars=yes'); return false;" class="share-gp">
              <i class="fa fa-google-plus"></i>
              <span>シェア</span>
            </a></li>
            <li class="shareLi">
              <a href="http://b.hatena.ne.jp/add?mode=confirm&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" class="share-hb">
                <i class="fa-hatebu"></i>
                <span>シェア</span>
              </a>
            </li>
          </ul>
        </div>
        <a class="AX__Button Center Single__button" href="/blog">BLOG一覧に戻る<i class="fa fa-angle-right"></i></a>
      </article>
      <!--関連記事-->
            <?php if(has_category() ){//この記事にカテゴリが設定されていたら
              $cats = get_the_category();//カテゴリ取得
              $catskwds = array();//カテゴリ情報を配列に格納
              foreach($cats as $cat){
                $catkwds[] = $cat->term_id;
              }
            } ?>
            <?php
            $myposts = get_posts( array(
              'post_type' => 'post',
              'post_per_page' => '6', //4件
              'post__not_in' => array($post->ID),
              'category__in' => $catkwds,
              'orderby' => 'rand'
            ) );
            $count = 0;
            if( $myposts ): ?>
            <aside id="related_post" class="Related__post">
              <h2 class="Section__title">RELATED POST<span>関連記事</span></h2>
              <ol>
                <?php foreach($myposts as $post):

                if($count < 4):
                  //1件記事セット
                  setup_postdata($post); ?>
                  <li>
                    <?php get_template_part( 'gaiyou', 'medium' ); ?>
                  </li>
                  <?php ++$count;?>
                <?php endif; endforeach; ?>
              </ul>
            </aside>
            <?php wp_reset_postdata(); endif;?>
          <?php endwhile; endif; ?>
        </div>
      </div>
    </main>
    <script type="text/javascript">
      jQuery(window).load(function() {
        var ua = navigator.userAgent;
        if (ua.indexOf('iPhone') > 0 || ua.indexOf('iPod') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0) {
          jQuery(window).on('scroll', function() {
            if(jQuery(window).scrollTop() > 30) {
              jQuery('#fade-h2-1').css('opacity','1');
            }
          });
        } else if (ua.indexOf('iPad') > 0 || ua.indexOf('Android') > 0) {
          // タブレット用コード
          jQuery(window).on('scroll', function() {
            if(jQuery(window).scrollTop() > 30) {
              jQuery('#fade-h2-1').css('opacity','1');
            }
          });
        } else {
          $offset1 = jQuery( '#fade-top-1' ).offset();
          jQuery( window ).scroll( function () {
            if( jQuery( window ).scrollTop() > $offset1.top ) {
                  jQuery('#header').css('background','black');//TOP
                  jQuery('.Header__nav').css('top','40%');//TOP
                  jQuery('.Header__wrap').css('padding-top','20px');//TOP
                  jQuery('.Header__wrap').css('padding-bottom','20px');//TOP
                }else{
                jQuery('#header').css('background','transparent');//TOP
                jQuery('.Header__nav').css('top','75%');//TOP
                jQuery('.Header__wrap').css('padding-top','40px');//TOP
                  jQuery('.Header__wrap').css('padding-bottom','0px');//TOP
                }
              });
          jQuery( window ).scroll( function () {
            if( jQuery( window ).scrollTop() < $offset1.top ) {
                jQuery('#header').css('background','none');//TOP
              }
            });
        }
      });
    </script>
    <?php get_footer(); ?>

<?php //アクセス数の記録
if(!is_bot() && !is_user_logged_in() ){//クローラーかつログイン中のユーザじゃなければカウント
  $count_key = 'postviews';
  $count = get_post_meta($post->ID,$count_key,true);
  $count++;
  update_post_meta($post->ID,$count_key,$count);
}
?>
