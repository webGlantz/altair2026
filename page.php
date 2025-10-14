<?php
/**
 * Page Builder
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

global $hero;

$hero = core::get_hero($post->ID);

get_header();

if (have_posts()) :
	while (have_posts()) :
		the_post();

		// Hero. 
		if($hero) :
			include locate_template('partials/hero/' . $hero['style'] . '.php', false, false);
		endif;

		// Content.
		echo CONTENT_OPEN;
			the_content();
		echo CONTENT_CLOSE;

	endwhile;

else :
	get_template_part('partials/misc/404');

endif;

get_footer();
