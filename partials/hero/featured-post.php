<?php
/**
 * Hero - Featured Post
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */


use glantz\core; 

?>

<!-- hero: featured post -->
<section class="hero hero_featured-post relative z-1 <?=(!empty($hero['featured_post']) ? 'has-post' : '')?> <?=(!empty($hero['bg']) ? 'has-bg' : '')?>">
	
	<?php if(!empty($hero['bg'])) : ?>
		<!-- bg -->
		<div class="hero_featured-post__bg absolute inset-0 -z-1">
			
			<?php echo core::get_custom_srcset(
				array(
					'lazy'=>false,
					'attachment_id'=>$hero['bg'],
					'size'=>'original',
					'sizes'=>'(min-width: 440px) 100vw, (min-width: 340px) calc(56.25vw + 184px), calc(-750vw + 2775px)',
					'classes'=>'hero_featured-post__bg-img absolute inset-0 object-cover -z-1 opacity-20',
				)
			); ?>
		</div>
	<?php endif; ?>

	<div class="hero_featured-post__container relative z-1 container layout-grid items-start gap-24 <?=(!empty($hero['bg']) ? 'py-48 lg:py-96 xl:py-120' : 'mt-48 lg:mt-96 xl:mt-120')?> ">

		<div class="hero_featured-post__content col-4 <?=(!empty($hero['featured_post']) ? 'lg:col-8 xl:col-5 self-center' : 'lg:col-6 lg:start-col-4')?> max-w-710 grid gap-12 lg:gap-24  <?=(!empty($hero['featured_post']) ? '' : 'text-center')?> <?=(!empty($hero['bg']) ? '' : '')?>">
			<h1 class=""><?=(isset($hero['headline']) ? $hero['headline'] : get_the_title())?></h1>

			<!-- text -->
			<?php if(!empty($hero['text'])) : ?>
				<div class="hero_featured-post__text relative z-1 t_wysiwyg t_body"><?=$hero['text']?></div>
			<?php endif; ?>
		</div>

		<?php if(!empty($hero['featured_post'])) :

			$featured = $hero['featured_post'][0];
			$cats = get_the_category($featured->ID); ?>

			<a href="<?=get_permalink($featured->ID)?>" class="hero_featured-post__post relative z-1 col-4 lg:col-12 xl:col-6 lg:start-col-7 flex flex-col items-start gap-12 ar-4:3 p-24 lg:p-48 text-white bg-black">
				<?php echo core::get_custom_srcset(
					array(
						'lazy'=>false,
						'attachment_id'=>get_post_thumbnail_id($featured->ID),
						'size'=>'original',
						'sizes'=>'(min-width: 1560px) 716px, (min-width: 1280px) calc(34.62vw + 182px), (min-width: 1040px) 56.36vw, (min-width: 400px) calc(112.42vw - 45px), (min-width: 340px) 423px, calc(-270vw + 1305px)',
						'classes'=>'hero_featured-post__img absolute inset-0 object-cover -z-1 zoom-hover opacity-50',
					)
				); ?>

				<?php if(!empty($cats)) : ?>
					<div class="mb-24 t_label py-12 px-24 bg-rust"><?=$cats[0]->name?></div>
				<?php endif; ?>

				<div class="mt-auto t_h4"><?=$featured->post_title?></div>

				<div class="hero_featured-post__excerpt t_body t_wysiwyg"><?=get_the_excerpt($featured->ID)?></div>
			</a>
		<?php endif; ?>
	</div>
</section>