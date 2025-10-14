<?php
/**
 * Block - Article Cards
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

global $data;

$fields = (!empty($data) ? $data : get_fields()); 

$config = ('default' === $fields['configuration'] ? get_field('article_cards', 'options') : $fields['article_cards']);

$args = array(
	'display'=>$config['display'],
	'showposts'=>3,
	'post_type'=>'post',
	'exclude'=>null,
);

$fields = array_merge($fields, $config, $args);

$items = core::post_selector($fields);

if(!$items) :
	return;
endif; 

echo CONTENT_CLOSE;

?>

<!-- component: article cards -->
<section id="<?=(!empty($block['anchor']) ? $block['anchor'] : $block['id'])?>" class="component c_blog relative z-1">

	<div class="c_blog__container container grid gap-24 lg:gap-48">


		<div class="grid gap-12 lg:gap-24 lg:flex justify-between items-end pt-24">
			<!-- headline -->
			<?php if($fields['headline']) : ?>
				<h2 class="c_blog__headline">
					<?=$fields['headline']?>
				</h2>
			<?php endif; ?>

			<!-- buttons -->
			<?php if($fields['button']) :
				
				$classes = 'c_blog__btns relative z-1';
				$buttons = array(array('link'=>$fields['button']));
				$style = 'btn--secondary';
				include locate_template('partials/base/buttons.php', false, false);
	
			endif; ?>
		</div>

		<div class="loop-post__grid layout-grid gap-20">
			<?php 

			foreach($items as $index=>$post) :

				setup_postdata($post);

				$thumb = get_post_thumbnail_id($post->ID);

				$item = array(
					'id'=>$post->ID,
					'title'=>$post->post_title,
					'image'=>$thumb,
					'url'=>get_permalink($post->ID),
					'size'=>'col-4',
				);

				include locate_template('partials/post/loop.php');

			endforeach;

			wp_reset_postdata();

			?>
		</div>
		
	</div>

</section>

<?php

echo CONTENT_OPEN;