<?php
/**
 * Post - Related Articles
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

$cats = get_the_category();

$display = get_field('related_display');
$category = get_field('related_category');
$post_tag = get_field('related_post_tag');
$headline = get_field('related_headline');
$button_text = get_field('related_button_text');

if(!$display || 'auto' === $display) : 
	$display = 'category';
	$category = $cats[0]->term_id;
endif;

$args = array(
	'headline'=>($headline ?  $headline : get_field('article_cards_headline', 'options')),
	'display'=>$display,
	'category'=>$category,
	'post_tag'=>$post_tag,
	'custom'=>get_field('related_custom'),
	'exclude'=>$post->ID,
	'showposts'=>2,
	'post_type'=>'post',
);

$items = core::post_selector($args);

if(!$items) :
	return;
endif; ?>

<div class="c_blog__container component grid gap-24 lg:gap-48">

	<!-- headline -->
	<?php if($args['headline']) : ?>
		<h2 class="c_blog__headline">
			<?=$args['headline']?>
		</h2>
	<?php endif; ?>

	<div class="loop-post__grid layout-grid gap-24 lg:gap-48">
		<?php 

		foreach($items as $index=>$post) :

			setup_postdata($post);

			$thumb = get_post_thumbnail_id($post->ID);

			$item = array(
				'title'=>$post->post_title,
				'image'=>$thumb,
				'url'=>get_permalink($post->ID),
				'size'=>'col-4 lg:col-6',
			);

			include locate_template('partials/post/loop.php');

		endforeach;

		wp_reset_postdata();

		?>
	</div>
</div>