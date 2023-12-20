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
	<meta name="description" content="大阪心斎橋のアメリカ村に位置するダンススタジオ「Studio AX」。初心者向けやキッズプログラム、プロダンサーまで各レべルに応じたクラスレッスンを行っております。ダンスだけでなく、ヨガやピラティスなどのボディバランスの為のレッスンも行うなど、毎週約100の幅広いレッスンを開催しております。">
	<!--OGP FaceBook用 -->
  <meta property="fb:app_id" content="2238083329541347" />
  <!--OGP Twitter用 -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="Studio AX" />
  <meta name="twitter:description" content="大阪心斎橋のアメリカ村に位置するダンススタジオ「Studio AX」。初心者向けやキッズプログラム、プロダンサーまで各レべルに応じたクラスレッスンを行っております。ダンスだけでなく、ヨガやピラティスなどのボディバランスの為のレッスンも行うなど、毎週約100の幅広いレッスンを開催しております。" />
  <meta name="twitter:image" content="" />

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
<body id="body" class="Top__body">
	<header id="header">
		<a class="old__logo Pc__on" href="/index.php">
				<img id="logo" src="/wp-content/themes/studio-ax/src/images/common/ax_logo.svg">
			</a>
		<div class="Header__wrap">

			<h1>
				<a class="old_logo" href="/index.php">
					<img id="logo" src="/wp-content/themes/studio-ax/src/images/header/logo.png">
				</a>
			</h1>		
			<nav class="Header__nav">
				<ul class="Header__nav__1">
					<li><a class="Hover__border" href="/index.php">TOP</a></li>
					<li><a class="Hover__border" href="/about">ABOUT</a></li>
					<li><a class="Hover__border" href="/instructor">INSTRUCTOR</a></li>
					<li><a class="Hover__border" href="/price">PRICE</a></li>
				</ul>
				<ul class="Header__nav__2">
					<li><a class="Hover__border" href="/schedule">SCHEDULE</a></li>
					<li><a class="Hover__border" href="/rentalstudio">STUDIO</a></li>
					<li><a class="Hover__border" href="/blog">BLOG</a></li>
					<li><a class="Hover__border" href="/contact#access">ACCESS</a></li>
				</ul>
			</nav>
			<div class="Header__nav__button">
				<a href="/index.php">
					<img id="logo" src="/wp-content/themes/studio-ax/src/images/common/ax_logo.svg">
				</a>
				<div class="drawer">
					<div class="drbtn">
						<span class="hambarg"></span>
						<span class="hambarg"></span>
						<span class="hambarg"></span>
						<span class="hambarg"></span>
					</div><!--drbtn-->
				</div><!--drawer-->
				<img class="Naviimg" src="/wp-content/themes/studio-ax/src/images/header/navi.png">
			</div>
		</div>
	</header>
	<div class="Header__nav__mobile">
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
						<li><i class="fa fa-angle-right"></i><a href="https://studio-ax.co.jp/info/dance-mania-masterpiece">RECITAL INFO</a></li>
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
	<main>
		<div class="Ignition__block Ignition__top1" id="fade-top-1"></div>
		<div class="Ignition__block Ignition__top2" id="fade-top-2"></div>
		<div class="Ignition__block Ignition__top3" id="fade-top-3"></div>
		<section class="Firstview first-view-top" id="first-view1">
			<div class="Top" >
			<!-- <div class="Top" id="slide"> -->
				<!-- <div id="Top-img" class="Top__img__3"></div> -->
				<div id="Top-img" class="Top__img__1"></div>
				<!-- <a href="https://docs.google.com/forms/d/e/1FAIpQLSe2dBgTCFil-VM9xdnRrXKLm3ErzG69R9xTBAVHXKNQRBMTeA/viewform?vc=0&c=0&w=1&flr=0" target="_blank" style="display: block;"><div id="Top-img" class="Top__img__3"></div></a> -->
			</div>
		</section>
		<section class="Info">
			<img class="Max__img Pc__on" src="/wp-content/themes/studio-ax/src/images/top/info_bg-min.png">
			<div class="Info__bg White__bg Max__width fade-in">
				<div class="Section__title">
					<h2 class="Section__title__h2">INFORMATION<span>インフォメーション</span></h2>
					<div class="Section__title__mirror Info__title">INFORMATION</div>
				</div>
				<div id="Graphic__body">	
					<div class="Graphic__body">
						<div class="Slideshow">
							<div class="Slideshow__head">
								<?php
								$hogehogehoge = get_posts( array(
							      'category' => '2,3,7', // 取得したいカテゴリーの ID を入れる
							      'posts_per_page' => 5
							  ));
								$count = 1;
								foreach( $hogehogehoge as $post ):
									setup_postdata( $post );

							    $cat = get_the_category(); // カテゴリーを配列で取得し
							    $cat = $cat[0]; // カテゴリー名（カテゴリースラッグ）を指定し
							    $cat_slug = $cat -> slug; // $cat_slug に入れる
							    
							    ?>
							    <article class="Slideshow__head__item" <?php post_class( $classes ); ?>>
							    	<a class="Info__article__first Scaleup" href="<?php the_permalink(); ?>">
							    		<div class="Article__a__left">
							    			<div class="Article__a__date">
							    				<time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
							    					<?php echo get_the_date( 'Y.m.d' ); ?>
							    				</time>
							    			</div>
							    			<div>
							    				<h3><?php the_title(); ?></h3>
							    			</div>
							    		</div>
							    		<div class="Article__a__cover">
							    			<img src="<?php echo mythumb( 'full' ); ?>" alt="">
							    			<?php
							    			$cat = get_the_category();
							    			$catslug = $cat[0]->slug;
							    			?>
							    			<div class="Article__category Category__label <?php echo $catslug; ?>">
							    				<?php $cats = get_the_category(); 
							    				echo $cats[0]->name; ?>
							    			</div>
							    		</div>
							    	</a>
							    </article>
							    <?php 
							endforeach;
							wp_reset_postdata();
							?>
						</div>
					</div>
					<div id="Slideshow__indicator" class="Slideshow__indicator">
						<?php
						$hogehogehoge = get_posts( array(
							      'category' => '2,3,7', // 取得したいカテゴリーの ID を入れる
							      'posts_per_page' => 4
							  ));
						$count = 1;
						foreach( $hogehogehoge as $post ):
							setup_postdata( $post );

							    $cat = get_the_category(); // カテゴリーを配列で取得し
							    $cat = $cat[0]; // カテゴリー名（カテゴリースラッグ）を指定し
							    $cat_slug = $cat -> slug; // $cat_slug に入れる
							    ?>
							    <a class="Article__a__cover Scaleup topindicator">
							    	<img src="<?php echo mythumb( 'full' ); ?>" alt="">	
							    </a>
							    <?php 
							endforeach;
							wp_reset_postdata();
							?>
						</div>
					</div>
				</div>
			</div>

		</section>
		<section class="News">
			<img class="Max__img Pc__on" src="/wp-content/themes/studio-ax/src/images/top/news_bg-min.png">
			<div class="News__bg White__bg fadein-left fade-in">
				<div class="News__wrap Max__width Pc__on nonenone">
					<div class="News__left">
						<div class="News__topictitle">
							<img class="Max__img" src="/wp-content/themes/studio-ax/src/images/top/news_head.png">
							<div class="Section__title">
								<h2 class="Section__title__h2">TOPICS<span>トピックス</span></h2>
								<div class="Section__title__mirror News__title">TOPICS</div>
							</div>
						</div>
						<div class="News__under">		
							<a class="Scaleup News__Dancemania" href="https://studio-ax.co.jp/info/dance-mania-masterpiece" target="_blank">RECITAL INFO</a>
							<a class="Scaleup News__Dancemania" href="/bbs" target="_blank">BBS</a>
							<a class="Scaleup News__Dancemania" target="_blank" href="http://studio-ax.co.jp/wp-content/uploads/2024/schedule2024.pdf">年間スケジュール</a>
							<a class="Scaleup News__Dancemania" href="https://studio-ax.co.jp/bigginer/6594" target="_blank">JAZZ超初心者コース</a>
							<a class="Scaleup News__Dancemania" href="https://studio-ax.co.jp/newlesson/choushoshinnshamemberbishuutyuu" target="_blank">HIPHOP超初心者コース</a>
<!-- 							<a class="Scaleup News__Dancemania" href="https://studio-ax.co.jp/bigginer/4063" target="_blank">オンラインレッスンに関しまして</a> -->
						</div>	
					</div>
					<div class="News__right News__acting">
							<div class="News__acting__title">
								代講・休講情報
							</div>
							<div class="News__acting__list">
								<?php
								$newslist = get_posts( array(
								    'category_name' => 'acting', //特定のカテゴリースラッグを指定
								    'posts_per_page' => -1, //取得記事件数
								    'orderby' => 'date', //取得記事件数
								    'order' => 'DESC',//取得記事件数
								));
								foreach( $newslist as $post ):
									setup_postdata( $post );
									?>
									<article <?php post_class( $classes ); ?>>
										<div class="Article__a Scaleup" href="<?php the_permalink(); ?>">
											<div>
												<h3><?php the_title(); ?></h3>
											</div>
										</div>
									</article>
									<?php
								endforeach;
								wp_reset_postdata();
								?>
							</div>
						</div>   
					
				</div>
				<div class="News__wrap Max__width Tablet__on">
					<div class="News__left">
						<div class="News__acting">
							<div class="News__acting__title">
								代講・休講情報
							</div>
							<div class="News__acting__list">
								<?php
								$newslist = get_posts( array(
								    'category_name' => 'acting', //特定のカテゴリースラッグを指定
								    'posts_per_page' => -1, //取得記事件数
								    'orderby' => 'date', //取得記事件数
								    'order' => 'DESC',//取得記事件数
								));
								foreach( $newslist as $post ):
									setup_postdata( $post );
									?>
									<article <?php post_class( $classes ); ?>>
										<div class="Article__a Scaleup" href="<?php the_permalink(); ?>">
											<div>
												<h3><?php the_title(); ?></h3>
											</div>
										</div>
									</article>
									<?php
								endforeach;
								wp_reset_postdata();
								?>
							</div>
						</div>    
						<div class="News__under">		
							<a class="Scaleup News__Dancemania" href="https://studio-ax.co.jp/info/dance-mania-masterpiece" target="_blank">RECITAL INFO</a>
							<a class="Scaleup News__Dancemania" href="/bbs" target="_blank">BBS</a>
							<a class="Scaleup News__Dancemania" target="_blank" href="http://studio-ax.co.jp/wp-content/uploads/2024/schedule2024.pdf">年間スケジュール</a>
							<a class="Scaleup News__Dancemania" href="https://studio-ax.co.jp/bigginer/6594" target="_blank">JAZZ超初心者コース</a>
							<a class="Scaleup News__Dancemania" href="https://studio-ax.co.jp/newlesson/choushoshinnshamemberbishuutyuu" target="_blank">HIPHOP超初心者コース</a>
<!-- 							<a class="Scaleup News__Dancemania" href="https://studio-ax.co.jp/bigginer/4063" target="_blank">オンラインレッスンに関しまして</a> -->
						</div>	
					</div>
					<div class="News__right">
						<img class="Max__img" src="/wp-content/themes/studio-ax/src/images/top/news_head.png">
						<div class="Section__title">
							<h2 class="Section__title__h2">TOPICS<span>トピックス</span></h2>
							<div class="Section__title__mirror News__title">TOPICS</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="BlogRental">
			<section class="Area">
				<div class="Section__wrap Area__wrap Max__width">
					<div class="Area__head">
						<div class="Section__title">
							<h2 class="Section__title__h2">AREA No.1</h2>
							<div class="Section__title__mirror Area__title">AREA No.1</div>
						</div>
						<p class="Pc__on">個々の目標を達成できる環境を提供する、関西最大級のダンススタジオです。</p>
						<p class="Mobile__on">個々の目標を達成できる環境を提供する、<br>関西最大級のダンススタジオです。</p>
					</div>
					<div class="Area__body">
						<div id="area-item1" class="Area__body__item White-box">
							<div class="Back__number">01</div>
							<i class="fa fa-object-group"></i>
							<h3>充実したレッスンプログラム</h3>
							<p>初心者向けやキッズプログラム、プロダンサーまで各レべルに応じたクラスレッスンを行っております。
							ダンスだけでなく、ヨガやピラティスなどのボディバランスの為のレッスンも行うなど、毎週約100の幅広いレッスンを開催しております。</p>
							<a class="AX__Button Absolute-center" href="/schedule">レッスンスケジュール<i class="fa fa-angle-right"></i></a>
						</div>
						<div id="area-item2" class="Area__body__item White-box">
							<div class="Back__number">02</div>
							<i class="fa fa-users"></i>
							<h3>一流の指導</h3>
							<p>各ジャンルで活躍中のインストラクターが多数在籍しております。メディア出演をされている方や、ジャパンダンスディライトの上位入賞者など、様々なジャンルのインストラクターの指導を受けて頂けます。</p>
							<a class="AX__Button Absolute-center" href="/instructor">インストラクター紹介<i class="fa fa-angle-right"></i></a>
						</div>
						<div id="area-item3" class="Area__body__item White-box">
							<div class="Back__number">03</div>
							<i class="fa fa-file-text"></i>
							<h3>多彩な受講システム</h3>
							<p>全てのレッスン受講できるALL会員や17:30以降の全レッスンが受けられるNIGHT会員、個別受講まで、お客様に合った会員種別をお選び頂けます。</p>
							<a class="AX__Button Absolute-center" href="/price">料金システム<i class="fa fa-angle-right"></i></a>
						</div>
					</div>
				</div>
			</section>
			<section class="Blog">
				<div class="Section__title">
					<h2 class="Section__title__h2">BLOG</h2>
					<div class="Section__title__mirror Blog__title">BLOG</div>
				</div>
				<div class="Blog__wrap Max__width">
					<?php
					$hogehogehoge = get_posts( array(
					      'category' => '2,3,7,8', // 取得したいカテゴリーの ID を入れる
					      'posts_per_page' => 3
					  ));

					foreach( $hogehogehoge as $post ):
						setup_postdata( $post );

					    $cat = get_the_category(); // カテゴリーを配列で取得し
					    $cat = $cat[0]; // カテゴリー名（カテゴリースラッグ）を指定し
					    $cat_slug = $cat -> slug; // $cat_slug に入れる
					    ?>

					    <?php get_template_part( 'gaiyou', 'medium' ); ?>

					    <?php
					endforeach;
					wp_reset_postdata();
					?>
				</div>
				<a class="AX__Button Center" href="/blog">BLOG一覧はコチラ<i class="fa fa-angle-right"></i></a>
			</section>
		</section>
	</main>
	<script type="text/javascript">
		jQuery(window).load(function() {
			var ua = navigator.userAgent;
			if (ua.indexOf('iPhone') > 0 || ua.indexOf('iPod') > 0 || ua.indexOf('iPad') > 0 || ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0) {
				$offset2 = jQuery( '#fade-top-2' ).offset();
		    	jQuery( window ).scroll( function () {
		    		if( jQuery( window ).scrollTop() > $offset2.top ) {
		                jQuery('#area-item1').css('opacity','1');//TOP
		                jQuery('#area-item1').css('margin-top','0');//TOP
		                jQuery('#area-item2').css('opacity','1');//TOP
		                jQuery('#area-item2').css('margin-top','0');//TOP
		                jQuery('#area-item3').css('opacity','1');//TOP
		                jQuery('#area-item3').css('margin-top','0');//TOP
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
	                jQuery('.Header__wrap').css('padding-top','30px');//TOP
	                jQuery('.Header__wrap').css('padding-bottom','10px');//TOP
	            }else{
	            	jQuery('#header').css('background','transparent');//TOP
	            	jQuery('.Header__nav').css('top','62%');//TOP
	            	jQuery('.Header__wrap').css('padding-top','40px');//TOP
	                jQuery('.Header__wrap').css('padding-bottom','0px');//TOP
	            }
	        });
	        $offset2 = jQuery( '#fade-top-2' ).offset();
	    	jQuery( window ).scroll( function () {
	    		if( jQuery( window ).scrollTop() > $offset2.top ) {
	                jQuery('#area-item1').css('opacity','1');//TOP
	                jQuery('#area-item1').css('margin-top','0');//TOP
	                jQuery('#area-item2').css('opacity','1');//TOP
	                jQuery('#area-item2').css('margin-top','0');//TOP
	                jQuery('#area-item3').css('opacity','1');//TOP
	                jQuery('#area-item3').css('margin-top','0');//TOP
	            }
	        });
	    }
	});
</script>
<!-- <div class="Fix_reserv_3 Header__nav__button_top Pc__on nonenone">
  <a href="http://studio-ax.co.jp/info/studioax20%E5%91%A8%E5%B9%B4%EF%BC%81%E3%80%90%E3%82%B9%E3%82%BF%E3%82%B8%E3%82%AA%E3%83%AC%E3%83%B3%E3%82%BF%E3%83%AB%E3%82%AD%E3%83%A3%E3%83%B3%E3%83%9A%E3%83%BC%E3%83%B3%E9%96%8B%E5%82%AC%E3%80%91" target="_blank">
    <img class="Max__img" src="/wp-content/themes/studio-ax/src/images/top/axbannertop.png">
  </a>
</div> -->
<div class="Fix_reserv Header__nav__button_top">
  <a href="/contact">
    <img src="/wp-content/themes/studio-ax/src/images/common/axcontacton.svg">
  </a>
</div>
<div class="Fix_reserv_2 Header__nav__button_top">
  <a href="/rentalstudio">
    <img src="/wp-content/themes/studio-ax/src/images/common/axreserv.svg">
  </a>
</div>
<div class="Fix_reserv_3 Header__nav__button_top">
  <a href="https://studio-ax.hacomono.jp/" target="_blank">
    <img src="/wp-content/themes/studio-ax/src/images/common/axlesson.svg">
  </a>
</div>
<?php get_footer(); ?>