<?php
/**
 * Archive: Blog
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

add_action('wp_enqueue_scripts', function() {
	wp_enqueue_style('feed-blog');
});

$hero = array();
$cats = core::get_terms_by_post_type();

if(is_tag()) :
	$hero['style'] = 'none';
	$hero['headline'] = 'Posts tagged &ldquo;' . single_tag_title('', false) . '&rdquo;';

elseif(is_search()) :
	$hero['style'] = 'none';
	$hero['headline'] = $wp_query->found_posts . ' posts with &ldquo;' . get_search_query() . '&rdquo;';

elseif(is_author()) :
	$hero['style'] = 'none';
	$hero['headline'] = 'Posts by ' . get_the_author();

else :
	$path = parse_url(get_post_type_archive_link($post->post_type))['path'];
	$archive = get_page_by_path($path);
	$arcontent = $archive->post_content;
	$hero = core::get_hero($archive->ID);
	$featured_post = get_field('featured_post', $archive->ID);
	$feed_headline = get_field('feed_headline', $archive->ID);
endif;


get_header();

if (have_posts()) :

	// Hero. 
	if($hero) :
		include locate_template('partials/hero/' . $hero['style'] . '.php', false, false);
	endif; ?>

	<section class="component c_feed relative z-1 grid gap-24 lg:gap-48">

		<div class="c_feed__container container layout-grid gap-20">

			<?php

			while(have_posts()) :
				the_post();

				$thumb = get_post_thumbnail_id($post->ID);
				$cats = get_the_category($post->ID);

				$item = array(
					'id'=>$post->ID,
					'title'=>$post->post_title,
					'text'=>('case-study' == $post->post_type ? get_field('project_type') . ', ' . get_field('project_location') : ''),
					'image'=>$thumb,
					'cats'=>$cats,
					'url'=>get_permalink(),
					'class'=>'',
					'size'=>'col-4',
				);

				include locate_template('partials/post/loop.php');

			endwhile;

			include locate_template('partials/misc/pagination.php', false, false); ?>
		
		</div>


	</section>

	<?php 
	if(!empty($arcontent)) :
		echo apply_filters('the_content', $arcontent);
	endif;

else :
	get_template_part('partials/misc/404');

endif;

get_footer();
