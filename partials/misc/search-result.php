<?php
/**
 * Loop - Search Result
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

$featured = get_post_thumbnail_id();
$hero = get_field('hero');
$thumb = null;

if(isset($hero) && isset($hero['image'])) {
	$thumb = $hero['image'];
}

if($featured) {
	$thumb = $featured;
}

ob_start();
the_excerpt();
$excerpt = ob_get_clean();

$excerpt = ($excerpt ? $excerpt : $hero['text']);

?>

<div class="search-result grid gap-24 lg:gap-48 items-center">

	
	<a href="<?=get_permalink()?>" class="<?=($thumb ? 'block' : 'hidden lg:block')?> relative overflow-hidden ar-4:3 self-stretch">
		<?=core::get_custom_srcset(
			array(
				'lazy'=>false,
				'attachment_id'=>$thumb,
				'size'=>'original',
				'sizes'=>'',
				'classes'=>'loop-post__img absolute inset-0 object-cover zoom-hover',
			)
		); ?>
	</a>

	<div class="search-result__content grid gap-12">
		<h2 class="t_h4">
			<a href="<?=get_permalink()?>" class=""><?=the_title()?></a>
		</h2>

		<?php if($excerpt) : ?>
			<div class="t_body t_wysiwyg"><?=$excerpt?></div>
		<?php endif; ?>
	</div>
</div>

<hr>