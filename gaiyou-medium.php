<article <?php post_class( $classes ); ?>>
	<a class="Article__a Scaleup" href="<?php the_permalink(); ?>">
		<div class="Article__a__cover">
			<img src="<?php echo mythumb( 'full' ); ?>" alt="">
			<?php
			    $cat = get_the_category();
			    $catslug = $cat[0]->slug;
			?>
			
			<div class="Article__a__text">
				<h3><?php the_title(); ?></h3>
				<div class="Article__a__date">
					<time datetime="<?php echo get_the_date( 'Y-m-d' ); ?>">
						<?php echo get_the_date( 'Y.m.d' ); ?>
					</time>
				</div>
				<div class="Article__category Category__label <?php echo $catslug; ?>">
					<?php $cats = get_the_category(); 
					echo $cats[0]->name; ?>
				</div>
			</div>
		</div>
	</a>
</article>
