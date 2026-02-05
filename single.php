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
});

global $hero;

$hero = core::get_hero($post->ID);

get_header();

if (have_posts()) :
		
	while (have_posts()) :
		the_post(); 

		// Hero. 
		if($hero) :

			include locate_template('partials/hero/post.php', false, false);
			 
		endif; ?>

		<section class="component single-post__wrapper">
			<div class="container layout-grid gap-y-48">

				<div class="single-post__share col-4 lg:col-2">
					<!-- AddToAny BEGIN -->
					<div class="a2a_kit a2a_kit_size_32 a2a_default_style t_h6 flex lg:grid gap-12">
						<a class="a2a_button_email"><i class="fa fas fa-share"></i></a>
						<a class="a2a_button_facebook"><i class="fa fa-brands fa-square-facebook"></i></a>
						<a class="a2a_button_linkedin"><i class="fa fa-brands fa-square-linkedin"></i></a>
					</div>
					
					<!-- AddToAny END -->
				</div>

				<div class="col-4 lg:col-7 lg:start-col-4 grid gap-48">
					<div class="single-post__date t_label"><?=get_the_date()?></div>
					<div class="t_wysiwyg t_body t_body--sm"><?=the_content()?></div>
				</div>

					
				
			</div>
		</section>

	<?php endwhile;

else :
	include locate_template('partials/misc/404', false, false);

endif;

get_footer(); ?>

<script defer src="https://static.addtoany.com/menu/page.js"></script>
