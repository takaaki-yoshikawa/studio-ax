<?php dynamic_sidebar('submenu'); ?>
<!-- <aside class="mymenu widget widget_categories">
<h4 class="widgettitle">CATEGORY</h4>
	<ul>
	<?php
	    $cats = wp_list_categories('echo=0&show_count=1&title_li=');
	    $cats = preg_replace('/ title=\"(.*?)\"/','', $cats);
	    $cats = preg_replace('/ class=\"(.*?)\"/','', $cats);
	    $cats = preg_replace('/<\/a> (\([0-9]*\))/', ' $1</a>', $cats);
	    $cats = str_replace(array('(',')'), array('<span class="count">','</span>'), $cats);
	    echo $cats;
	?>
	</ul>
</aside> -->
<!--新着一覧-->
	

<aside class="mymenu widget widget_postlist">
<h2 class="widgettitle">NEW POSTS<span>最新の記事</span></h2>
	<!--記事を3つ表示する-->
	<?php query_posts('posts_per_page=3'); ?>
	<?php while (have_posts()) : the_post(); ?>
	<ul>
		<li>
			<!--サムネイル画像-->
			<div class="new-img">
				<a class="Scaleup" href="<?php the_permalink(); ?>"><?php if( has_post_thumbnail() ): ?>
				<?php the_post_thumbnail(); ?>
				<?php else: ?>
				    <img src="<?php echo get_template_directory_uri(); ?>/thumb.jpg" alt="" width="100" height="100">
				<?php endif; ?></a>
			</div>
			<div class="under">
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
				<!--記事タイトル-->
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
		</li>
	</ul>
<?php endwhile;?>
</aside>
<!--新着一覧終了-->

<aside id="archives-2" class="mymenu widget widget_archive">
<h2 class="widgettitle">ARCHIVE<span>月別アーカイブ</span></h2>
<ul>
  <?php wp_get_archives(); ?>
</ul>
</aside>
