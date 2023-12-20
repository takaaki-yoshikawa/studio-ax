<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta id="viewport" name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
	<title>大阪心斎橋 アメ村のダンススタジオ｜Studio AX</title>
	<link rel="stylesheet" href="/wp-content/themes/studio-ax/style.css?<?php echo date('Ymd-His'); ?>">
	<link rel="stylesheet" href="/wp-content/themes/studio-ax/tablet.css?<?php echo date('Ymd-His'); ?>">
	<link rel="stylesheet" href="/wp-content/themes/studio-ax/mobile-min.css?<?php echo date('Ymd-His'); ?>">
	<link rel="stylesheet" href="/wp-content/themes/studio-ax/mobile-side.css?<?php echo date('Ymd-His'); ?>">
	<script src="/wp-content/themes/studio-ax/src/js/lib/jquery-1.10.2.min.js"></script>
	<script src="/wp-content/themes/studio-ax/src/js/lib/jquery-ui-1.10.3.custom.min.js"></script>
	<script src="/wp-content/themes/studio-ax/src/js/main.js?<?php echo date('Ymd-His'); ?>"></script>
	<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD3GFp1pa6hc443Myd-ayc5HYbWC4OJ45Y"></script>
	<script type="text/javascript" src="/wp-content/themes/studio-ax/src/js/map.js"></script>
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
<body id="body">
	<header class="Header__ulayer" id="header">
		<div class="Header__wrap__ulayer Max__width">
			<a class="old__logo" href="/index.php">
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