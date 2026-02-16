<?php
/**
 * Block - Service Cards
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

global $data;

$fields = (!empty($data) ? $data : get_fields()); 

echo CONTENT_CLOSE;

?>

<!-- component: service cards -->
<section id="<?=(!empty($block['anchor']) ? $block['anchor'] : $block['id'])?>" class="component c_service cards relative z-1">

	<div class="c_service-cards__container container grid gap-48 lg:gap-60">
		

		<div class="c_service-cards__content relative z-1 layout-grid grid items-end gap-12 lg:gap-24">

			<!-- headline -->
			<?php if($fields['headline']) : ?>
				<h2 class="c_service-cards__headline col-4">
					<?=$fields['headline']?>
				</h2>
			<?php endif; ?>

			<!-- text -->
			<?php if($fields['text']) : ?>
				<div class="c_service-cards__text relative z-1 col-4 lg:col-5 t_wysiwyg t_body"><?=$fields['text']?></div>
			<?php endif; ?>

		</div>


		<?php if($fields['cards']) : ?>
			<div class="c_service-cards__grid relative layout-grid gap-0 text-center text-white" 
			data-aos="fade-right"
			data-aos-duration="1000">
				<?php foreach($fields['cards'] as $c) : ?>
					<a href="<?=$c['link']['url']?>" @mouseenter="hover = true" @mouseleave="hover = false" class="c_service-card relative z-1 col-4 lg:col-4 flex items-center ar-1:1 lg:ar-4:7 py-72 px-60 lg:px-24 xl:px-72 group overflow-hidden" target="<?=$c['link']['target']?>" x-data="serviceCard" x-resize.document="size = $width;">

						<div class="grid gap-20 w-full">
							<!-- image -->
							<div class="c_service-card__image absolute inset-0 -z-1">
								
								<?php echo core::get_custom_srcset(
									array(
										'lazy'=>true,
										'attachment_id'=>$c['image'],
										'size'=>'original',
										'sizes'=>'(min-width: 1540px) 1135px, (min-width: 1280px) calc(68.33vw + 95px), (min-width: 1140px) calc(230vw - 1921px), (min-width: 1040px) calc(213.75vw - 1750px), calc(149.86vw - 60px)',
										'classes'=>'c_service-card__img absolute inset-0 object-cover w-full',
									)
								); ?>
							</div>

							<h3><?=$c['headline']?></h3>

							<div x-show="isShown" x-collapse class="c_service-card__text t_body t_body--sm t_wysiwyg">
								<?=$c['text']?>
							</div>

							<div class="btn-group flex items-center justify-center">
								<div class="btn">
									<span><?=$c['link']['title']?></span>
									<i class="fa fas fa-arrow-right"></i>
								</div>
							</div>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>


</section>

<?php 

echo CONTENT_OPEN;