<?php

/*
Plugin Name:  434Marketing CTAs
Description:  Showcase call to actions throughout the site.
Version: 1.0
Author: Objectiv.
Author URI: https://objectiv.co/
*/

define('GLOBAL_CTA', dirname( __FILE__) );
define( 'GLOBAL_CTA_BASE_FILE', __FILE__ );

include_once( 'inc/helper-functions.php' );

class GLOBAL_CTA {

	public function __construct() {
		// silence be golden
	}

	function start() {
		add_action( 'init', array( $this, 'objectiv_register_call_to_action_posttype' ), 0 );
		if ( ! is_single() ) {
			add_action( 'genesis_before_footer', array( $this, 'objectiv_display_footer_cta' ) );
		}
	}

	function objectiv_register_call_to_action_posttype() {

		$labels = array(
			'name'                  => _x( 'Call To Actions', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Call To Action', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Call To Actions', 'text_domain' ),
			'name_admin_bar'        => __( 'Call To Action', 'text_domain' ),
			'archives'              => __( 'Call To Action Archives', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Call To Action:', 'text_domain' ),
			'all_items'             => __( 'All Call to Actions', 'text_domain' ),
			'add_new_item'          => __( 'Add New Call To Action', 'text_domain' ),
			'add_new'               => __( 'Add New', 'text_domain' ),
			'new_item'              => __( 'New Call To Action', 'text_domain' ),
			'edit_item'             => __( 'Edit Call To Action', 'text_domain' ),
			'update_item'           => __( 'Update Call To Action', 'text_domain' ),
			'view_item'             => __( 'View Call To Action', 'text_domain' ),
			'search_items'          => __( 'Search Call To Action', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
			'featured_image'        => __( 'Featured Image', 'text_domain' ),
			'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
			'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
			'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
			'insert_into_item'      => __( 'Insert into call to action', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Uploaded to this call to action', 'text_domain' ),
			'items_list'            => __( 'Call To Actions list', 'text_domain' ),
			'items_list_navigation' => __( 'Call To Actions list navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filter call to actions list', 'text_domain' ),
		);
		$args = array(
			'label'                 => __( 'Call To Action', 'text_domain' ),
			'description'           => __( 'Display call to actions on posts and pages.', 'text_domain' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'thumbnail', ),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 105,
			'menu_icon'             => 'dashicons-megaphone',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'call_to_action', $args );

	}

	function objectiv_display_footer_cta() {

		$args = array(
			'post_type'         => 'call_to_action',
			'posts_per_page'    => -1,
			'orderby'           => 'menu_order',
			'order'             => 'ASC'
		);

		$posts = get_posts($args);
		$page_id = get_the_ID();

		if ( is_home() ) {
			$is_blog = true;
		}

		?>

		<?php foreach( $posts as $post ):

			$id = $post->ID;
			$type = get_field( 'cta_type', $id );
			$relations = get_field( 'cta_show_on_page', $id );
			$the_content = get_field( 'cta_content', $id );
			$bg_img = get_field( 'cta_background_image', $id )['url'];
			$left_img = get_field( 'cta_left_image', $id );
			$bg_video = get_field( 'cta_bg_video', $id );
			$poster_image = get_field( 'cta_video_poster_image', $id );

			?>
			<?php foreach ( $relations as $relation ) :

				$rel_id = $relation->ID;

				?>

				<?php if ( $page_id == $rel_id ) : ?>

					<?php if ( $type === 'img-bg' && ! empty( $bg_img ) ): ?>

						<section id="call-to-action" class="call-to-action <?php echo ($is_blog) ? 'is-blog' : ''; ?> footer-cta <?php echo $type ?>" style="background-image: url('<?php echo $bg_img; ?>');">
							<div class="wrap inside-content-wrap">

								<div class="cta-content">
									<?php echo $the_content ?>
								</div>

							</div>
							<div class="cta-bg-overlay"></div>
						</section>

					<?php elseif ( $type === 'video-bg' && ! empty( $bg_video ) ) : ?>

						<section id="call-to-action" class="call-to-action <?php echo ($is_blog) ? 'is-blog' : ''; ?> footer-cta <?php echo $type ?>" style="background-image: url('<?php echo $poster_image['url']; ?>');">
							<div class="wrap inside-content-wrap">

								<div class="cta-content">
									<?php echo $the_content ?>
								</div>

							</div>

							<video class="autoplay-video" muted="" autoplay="" loop="" poster="<?php echo $poster_image['url']; ?>">
								<source src="<?php echo $bg_video['url']; ?>" type="video/mp4">
							</video>

						</section>

					<?php else: ?>

						<section id="call-to-action" class="call-to-action <?php echo ($is_blog) ? 'is-blog' : ''; ?> footer-cta <?php echo $type ?>">
							<div class="wrap inside-content-wrap">

								<div class="cta-content">
									<?php echo $the_content ?>
								</div>

							</div>
						</section>

					<?php endif; ?>

				<?php endif; ?>

			<?php  endforeach; ?>

			<?php wp_reset_postdata(); ?>

		<?php endforeach; ?>

		<?php wp_reset_postdata(); ?>

		<?php
	}
}

$GLOBAL_CTA = new GLOBAL_CTA();
$GLOBAL_CTA->start();
