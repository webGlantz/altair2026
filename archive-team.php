<?php
/**
 * Archive: Team
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */


global $data;

use glantz\core;

add_action('wp_enqueue_scripts', function() {
	wp_enqueue_style('feed-team');
});

$path = parse_url(get_post_type_archive_link($post->post_type))['path'];
$archive = get_page_by_path($path);
$hero = core::get_hero($archive->ID);


$filters = get_terms('group', array(
	'orderby' => 'term_order',
	'hide_empty' => true,   
));

$exclude = get_field('exclude_category', $archive->ID);

$arcontent = $archive->post_content;

get_header();

if (have_posts()) :

	// Hero. 
	if($hero) :
		include locate_template('partials/hero/' . $hero['style'] . '.php', false, false);
	endif; ?>

	<section
	id="feed"
	class="c_feed relative z-1 grid my-48 lg:my-60 gap-48 lg:gap-60"
	x-data="teamFeed()"
	x-init="init()"
	>
		<div class="c_feed__filters container layout-grid gap-24">
			
			<!-- filters -->
			<div class="col-4 lg:col-12">
				<div class="flex items-center justify-center gap-24 w-full border-b-2 border-blue-light pb-12">
					
					<button @click.prevent="active = 0" class="c_feed__filter t_body t_body--sm" :class="{ 'is-active' : active === 0 }">All</button>
					<?php if(!empty($filters)) :
						foreach($filters as $cat) : ?>
							<button @click.prevent="active = parseInt(<?=$cat->term_id?>)" href="<?=get_term_link($cat->term_id)?>" class="c_feed__filter t_body t_body--sm nowrap" :class="{ 'is-active' : active === parseInt(<?=$cat->term_id?>) }">
								<?=$cat->name?>
							</button>
						<?php endforeach; 
					endif; ?>
				
				</div>
			</div>
		</div>

		<div class="c_feed__container container layout-grid gap-20 lg:gap-y-48 xl:gap-y-60">

			<?php

			while(have_posts()) :
				the_post();

				$cats = get_the_terms($post->ID, 'group');

				$item = array(
					'id'=>$post->ID,
					'title'=>$post->post_title,
					'image'=>get_post_thumbnail_id($post->ID),
					'url'=>get_permalink(),
					'class'=>'',
					'size'=>'col-4 md:col-2 lg:col-3',
					'cats'=>wp_list_pluck($cats, 'term_id', null),
					'position'=>get_field('position', $post->ID),
				);

				include locate_template('partials/post/loop-team.php');

			endwhile; ?>
		
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
