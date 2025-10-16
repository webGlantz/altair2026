<?php
/**
 * Hero - Post
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */


use glantz\core; 

$path = parse_url(get_post_type_archive_link($post->post_type))['path'];
$archive = get_page_by_path($path);
$exclude = get_field('exclude_category', $archive->ID);
$categories = wp_list_pluck(get_the_terms($post->ID, 'category') ?: [], 'name');

?>

<!-- hero: post -->
<section class="hero hero_post relative z-1 text-white" style="--bg: <?=(in_array($post->ID, $exclude) ? 'var(--blue)' : 'var(--green)')?>">

	

	<div class="relative z-1 container layout-grid gap-24 lg:gap-y-96">


		<div class="hero-top hero_interior__top hero_post__top relative col-4 grid gap-24 lg:gap-48 py-24 px-gutter-x">
			
			<?php if($categories) : ?>
				<div class="t_label t_label--blog">
					<span class="underline"><?=implode('</span> <span class="underline">', $categories)?></span>	
				</div>
			<?php endif; ?>

			<h1><?=(isset($hero['headline']) ? $hero['headline'] : get_the_title())?></h1>
			

		</div>
		
	</div>

	<?php if(!empty($hero['image'])) : ?>
		<!-- bg -->
		<div class="hero_post__image relative ar-4:3">
			
			<?php echo core::get_custom_srcset(
				array(
					'lazy'=>false,
					'attachment_id'=>$hero['image'],
					'size'=>'original',
					'sizes'=>'(min-width: 1040px) 100vw, (min-width: 740px) 140.71vw, (min-width: 400px) calc(118.44vw + 276px), calc(92.5vw + 438px)',
					'classes'=>'hero_interior__bg-img absolute inset-0 object-cover -z-1',
				)
			); ?>
		</div>
	<?php endif; ?>
</section>