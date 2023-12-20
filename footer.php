<footer class="Footer Nav__button__off">
	<img class="Max__img Tablet__on" src="/wp-content/themes/studio-ax/src/images/footer/footer_bg_tb.png">
	<div class="Footer__wrap Max__width">
		<div class="Footer__logo">
			<a href="/index.php">
				<img id="logo" src="/wp-content/themes/studio-ax/src/images/common/ax_logo.svg">
			</a>	
		</div>
		<?php
			//①get_pageを利用して情報を得る
			$page = get_page(get_the_ID());
			//②プロパティからスラッグ名を取得する
			$slug = $page->post_name;
		?>
		<div class="Footer__middle">
			<ul class="Footer__ul__1_1">
				<li>
					<?php if($slug=="about"): ?>
						<a class="Hover__border Navnow" href="/about">ABOUT</a>
					<?php else:?>
						<a class="Hover__border" href="/about">ABOUT</a></li>
					<?php endif;?>
				<li>
					<?php if($slug=="instructor"): ?>
						<a class="Hover__border Navnow" href="/instructor">INSTRUCTOR</a>
					<?php else:?>
						<a class="Hover__border" href="/instructor">INSTRUCTOR</a></li>
					<?php endif;?>
				<li>
					<?php if($slug=="price"): ?>
						<a class="Hover__border Navnow" href="/price">PRICE</a>
					<?php else:?>
						<a class="Hover__border" href="/price">PRICE</a></li>
					<?php endif;?>
			</ul>
			<ul class="Footer__ul__1_2">
				<li>
					<?php if($slug=="schedule"): ?>
						<a class="Hover__border Navnow" href="/schedule">SCHEDULE</a>
					<?php else:?>
						<a class="Hover__border" href="/schedule">SCHEDULE</a></li>
					<?php endif;?>
				<li>
					<?php if($slug=="rentalstudio"): ?>
						<a class="Hover__border Navnow" href="/rentalstudio">STUDIO</a>
					<?php else:?>
						<a class="Hover__border" href="/rentalstudio">STUDIO</a></li>
					<?php endif;?>
				<li>
					<?php if($slug=="contact"): ?>
						<a class="Hover__border Navnow" href="/contact">CONTACT</a>
					<?php else:?>
						<a class="Hover__border" href="/contact">CONTACT</a></li>
					<?php endif;?>
			</ul>
		</div>
		<div class="Footer__under Pc__on">
			<ul class="Footer__ul__2_1">
				<li>
					<?php if($slug=="blog"): ?>
						<a class="Hover__border Navnow" href="/blog">BLOG</a>
					<?php else:?>
						<a class="Hover__border" href="/blog">BLOG</a></li>
					<?php endif;?>
				<li>
					<?php if($slug=="faq"): ?>
						<a class="Hover__border Navnow" href="/faq">FAQ</a>
					<?php else:?>
						<a class="Hover__border" href="/faq">FAQ</a></li>
					<?php endif;?>
			</ul>
			<ul class="Footer__ul__2_2">
				<li>
					<?php if($slug=="link"): ?>
						<a class="Hover__border Navnow" href="/link">LINK</a>
					<?php else:?>
						<a class="Hover__border" href="/link">LINK</a></li>
					<?php endif;?>
				<li class="Sns__li">
					<a href="https://twitter.com/DanceStudioAX"><i class="fa fa-twitter"></i></a>
	              	<a href="https://www.facebook.com/studioaxdance/"><i class="fa fa-facebook"></i></a>
	              	<a href="https://www.instagram.com/studio_ax/"><i class="fa fa-instagram"></i></a>
				</li>
			</ul>
		</div>
		<div class="Footer__under Mobile__on">
			<ul class="Footer__ul__2_1">
				<li>
					<?php if($slug=="blog"): ?>
						<a class="Hover__border Navnow" href="/blog">BLOG</a>
					<?php else:?>
						<a class="Hover__border" href="/blog">BLOG</a></li>
					<?php endif;?>
				<li>
					<?php if($slug=="faq"): ?>
						<a class="Hover__border Navnow" href="/faq">FAQ</a>
					<?php else:?>
						<a class="Hover__border" href="/faq">FAQ</a></li>
					<?php endif;?>
				<li>
					<?php if($slug=="link"): ?>
						<a class="Hover__border Navnow" href="/link">LINK</a>
					<?php else:?>
						<a class="Hover__border" href="/link">LINK</a></li>
					<?php endif;?>
			</ul>
			<div class="Sns__li">
				<a href="https://twitter.com/DanceStudioAX"><i class="fa fa-twitter"></i></a>
              	<a href="https://www.facebook.com/studioaxdance/"><i class="fa fa-facebook"></i></a>
              	<a href="https://www.instagram.com/studio_ax/"><i class="fa fa-instagram"></i></a>
			</div>
		</div>
	<small>
		Copyright © 2018 StudioAX All Rights Reserved.
	</small>
</footer>
<script src="/wp-content/themes/studio-ax/src/js/validation.js?<?php echo date('Ymd-His'); ?>"></script>
<script src="/wp-content/themes/studio-ax/src/js/carendar_val.js?<?php echo date('Ymd-His'); ?>"></script>
<script src="/wp-content/themes/studio-ax/src/js/slide-min.js?<?php echo date('Ymd-His'); ?>"></script>
</body>
</html>