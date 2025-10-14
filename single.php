<?php
/**
 * Single Post
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

add_action('wp_enqueue_scripts', function() {
	wp_enqueue_style('feed-blog');
	wp_enqueue_style('single-post');
	wp_enqueue_script('table-of-contents');
});

if('case-study' === $post->post_type) {

	$type = get_field('project_type');
	$location = get_field('project_location');

	add_action('wp_enqueue_scripts', function() {
		wp_enqueue_style('service-cards');
	});
}

global $hero;

$hero = core::get_hero($post->ID);

get_header();

if (have_posts()) :
		
	while (have_posts()) :
		the_post(); 

		// Hero. 
		if($hero) :

			if('case-study' === $post->post_type) : 
				$hero['eyebrow'] = $type . ($type && $location ? ',  ' : '') . $location;
			endif;

			include locate_template('partials/hero/post.php', false, false);
			 
		endif; ?>

		<section class="component" x-data="toc">
			<div class="container layout-grid items-start">

				<?php include locate_template('partials/misc/table-of-contents.php', false, false); ?>

				<div class="single-post__container toc__content col-4 lg:col-7 xl:col-8 relative">

					<div class="t_wysiwyg t_body"><?=the_content()?></div>

					<?php include locate_template('partials/post/related-articles.php', false, false); ?>
				</div>
			</div>
		</section>

	<?php endwhile;

else :
	include locate_template('partials/misc/404', false, false);

endif;

get_footer();
