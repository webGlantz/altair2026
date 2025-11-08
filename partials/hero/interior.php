<?php
/**
 * Hero - Interior
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */


use glantz\core; 

?>

<!-- hero: interior -->
<section class="hero hero_interior relative z-1 <?=($hero['image'] ? 'has-img' : '')?> <?=(!empty($hero['bg']) ? 'has-bg' : '')?>">
	
	<?php if(!empty($hero['bg'])) : ?>
		<!-- bg -->
		<div class="hero_interior__bg absolute inset-0 -z-1 <?=(!empty($hero['bg']) ? 'bg-black' : '')?>">
			
			<?php echo core::get_custom_srcset(
				array(
					'lazy'=>false,
					'attachment_id'=>$hero['bg'],
					'size'=>'original',
					'sizes'=>'100vw',
					'classes'=>'hero_interior__bg-img absolute inset-0 object-cover -z-1 opacity-50',
				)
			); ?>
		</div>
	<?php endif; ?>

	<div class="hero_interior__container relative z-1 container layout-grid items-start gap-24 <?=(!empty($hero['bg']) ? 'py-48 lg:py-96 xl:py-120' : '')?> ">

		<div class="hero_interior__content col-4 <?=($hero['image'] ? 'lg:col-7' : 'lg:col-6 lg:start-col-4')?> max-w-710 grid gap-12 lg:gap-24  <?=($hero['image'] ? '' : 'mx-auto text-center')?> <?=(!empty($hero['bg']) ? 'text-white' : '')?>">
			<h1 class=""><?=(isset($hero['headline']) ? $hero['headline'] : get_the_title())?></h1>

			<!-- text -->
			<?php if(!empty($hero['text'])) : ?>
				<div class="hero_interior__text relative z-1 t_wysiwyg t_body"><?=$hero['text']?></div>
			<?php endif; ?>
		</div>

		<?php if($hero['image']) : ?>
			<!-- image -->
			<div class="hero_interior__image relative col-3 lg:col-5 xl:col-4 start-col-2 lg:start-col-8 xl:start-col-9 ar-4:5">
				
				<?php echo core::get_custom_srcset(
					array(
						'lazy'=>false,
						'attachment_id'=>$hero['image'],
						'size'=>'original',
						'sizes'=>'(min-width: 1520px) 984px, (min-width: 1040px) calc(59.78vw + 87px), calc(140.28vw - 68px)',
						'classes'=>'hero_interior__img absolute inset-0 object-cover -z-1',
					)
				); ?>
			</div>
		<?php endif; ?>
	</div>
</section>