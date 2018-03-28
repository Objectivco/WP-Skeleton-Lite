<?php

/**
 * Display the Call to Action
 *
 */

function objectiv_display_cta() {
	$args = array(
		'post_type'         => 'call_to_action',
		'posts_per_page'    => -1,
		'orderby'           => 'menu_order',
		'order'             => 'ASC'
	);
	$posts = get_posts($args);
	$page_id = get_the_ID();
	?>
	<?php foreach( $posts as $post ):
		$id = $post->ID;
		$img = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'full' )[0];
		$content = get_field( 'cta_content', $id );
		$relations = get_field( 'cta_show_on_page', $id );
		$bg_color = get_field( 'cta_bg_color_overlay', $id );
		$show_ci = get_field( 'cta_use_content_image', $id);
		$content_img = get_field( 'cta_content_image', $id );
		$content_ipos = get_field( 'cta_content_image_position', $id );
		$show_border = get_field ( 'cta_show_border', $id );
		$border_color = get_field( 'cta_border_color', $id );;
		$position = get_field( 'cta_position', $id );
		?>
		<?php foreach ( $relations as $relation ):
			$rel_id = $relation->ID;
			?>
			<?php if ( $page_id == $rel_id ): ?>
				<?php if ( $position == false ): ?>
					<section id="call-to-action" class="call-to-action <?php echo ($is_blog) ? 'is-blog' : ''; ?>" style="background-image: url('<?php echo $img; ?>'); background-color: <?php echo $bg_color; ?>">
						<?php if($show_border): ?>
						 <div class="border" style="border: 1px solid <?php echo $border_color; ?>"></div>
						<?php endif; ?>
						<div class="wrap">
							<div class="cta-content <?php echo ($show_ci) ? 'has-table' : ''; ?>">
								<?php if($show_ci): ?>
									<?php if($content_ipos == 'left'): ?>
										<div class="img-left cell">
											<img src="<?php echo $content_img['url']; ?>" />
										</div>
										<div class="text-right cell"><?php echo do_shortcode($content); ?></div>
									<?php else: ?>
										<div class="text-left cell"><?php echo do_shortcode($content); ?></div>
										<div class="img-right cell">
											<img src="<?php echo $content_img['url']; ?>" />
										</div>
									<?php endif; ?>
								<?php else: ?>
									<?php echo do_shortcode($content); ?>
								<?php endif; ?>
							</div>
						</div>
					</section>
				<?php endif; ?>
			<?php endif; ?>
		<?php  endforeach; ?>
	<?php endforeach; ?>
	<?php wp_reset_postdata(); ?>
	<?php
}
