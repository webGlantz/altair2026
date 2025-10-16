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

		<section class="component bg-white">
			<div class="container ">

				

				<div class="t_wysiwyg t_body"><?=the_content()?></div>

					
				
			</div>
		</section>

	<?php endwhile;

else :
	include locate_template('partials/misc/404', false, false);

endif;

get_footer();
