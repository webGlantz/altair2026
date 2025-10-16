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

$path = parse_url(get_post_type_archive_link($post->post_type))['path'];
$archive = get_page_by_path($path);
$hero = core::get_hero($archive->ID);


$filters = get_terms('category', array(
	'orderby' => 'term_order',
	'hide_empty' => true,   
));

$exclude = get_field('exclude_category', $archive->ID);

if(is_tag()) :
	$hero['headline'] = 'Posts tagged &ldquo;' . single_tag_title('', false) . '&rdquo;';
	$hero['featured_post'] = null;

elseif(is_category()) :
	$hero['featured_post'] = null;

elseif(is_search()) :
	$hero['featured_post'] = null;

elseif(is_author()) :
	$hero['headline'] = 'Posts by ' . get_the_author();
	$hero['featured_post'] = null;
else :
	$arcontent = $archive->post_content;
endif;

get_header();

if (have_posts()) :

	// Hero. 
	if($hero) :
		include locate_template('partials/hero/' . $hero['style'] . '.php', false, false);
	endif; ?>

	<section id="feed" class="component c_feed relative z-1 grid gap-48 lg:gap-60">

		<div class="c_feed__filters container layout-grid gap-24">
			
			<!-- filters -->
			<div class="col-4 lg:col-5 flex">
				<div class="flex items-center gap-48 border-b-2 border-blue-light pb-12">
					<div class="t_label nowrap">Filter By</div>
					<div class="flex items-center gap-24 flex-auto">
						<a href="<?=get_post_type_archive_link('post')?>" class="c_feed__filter t_body t_body--sm <?=(!is_category() && !is_tag() && !is_search() && !is_author() ? 'is-active' :'')?>">All</a>
						<?php if(!empty($filters)) :
							foreach($filters as $cat) : 
								if(!in_array($cat->term_id, $exclude)) : ?>
									<a href="<?=get_term_link($cat->term_id)?>" class="c_feed__filter t_body t_body--sm nowrap <?=(is_category($cat->term_id) ? 'is-active' : '')?>">
										<?=$cat->name?>
									</a>
								<?php endif; 
							endforeach; 
						endif; ?>
					</div>
				</div>
			</div>

			<!-- search -->
			<div class="col-4 lg:col-2 lg:start-col-11">
				<?php 
				$location = 'blog';
				include locate_template('partials/misc/search-form.php', false, false);
				?>
			</div>
		</div>

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

			endwhile; ?>
		
		</div>

		<div class="container layout-grid"><?php include locate_template('partials/misc/pagination.php', false, false); ?></div>


	</section>

	<?php 
	if(!empty($arcontent)) :
		echo apply_filters('the_content', $arcontent);
	endif;

else :
	get_template_part('partials/misc/404');

endif;

get_footer();
