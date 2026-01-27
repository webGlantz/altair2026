<?php
/**
 * Block - Image + Text Cards Scroll
 *
 * @package JMB Insurance
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

$fields = get_fields();

echo CONTENT_CLOSE; ?>

<!-- component: image-text-cards-scroll  -->
<section id="<?=(!empty($block['anchor']) ? $block['anchor'] : $block['id'])?>" class="component c_cards-scroll relative z-1 grid gap-48 lg:gap-72"x-data="timeline">

	<div class="c_cards-scroll__container container ">
		

		<div class="c_cards-scroll__content relative z-1 layout-grid grid items-end gap-12 lg:gap-24">

			<!-- headline -->
			<?php if($fields['headline']) : ?>
				<h2 class="c_cards-scroll__headline col-4 lg:col-6 pr-96">
					<?=$fields['headline']?>
				</h2>
			<?php endif; ?>

			<!-- text -->
			<?php if($fields['text']) : ?>
				<div class="c_cards-scroll__text relative z-1 col-4 lg:col-5 lg:start-col-7 t_wysiwyg t_body"><?=$fields['text']?></div>
			<?php endif; ?>

		</div>
	</div>


	<div class="c_cards-scroll__grid grid gap-24 lg:gap-48">

		<?php foreach($fields['items'] as $i) : ?>
			<div class="c_cards-scroll__i fakeScroll__item grid lg:flex items-start">

				<?php if(!empty($i['image'])) : ?>

					<div class="c_cards-scroll__image relative">
						<?php echo core::get_custom_srcset(
							array(
								'lazy'=>true,
								'attachment_id'=>$i['image'],
								'size'=>'original',
								'sizes'=>'(min-width: 1400px) 643px, (min-width: 1040px) calc(37.35vw + 128px), calc(132.5vw - 54px)',
								'classes'=>'c_cards-scroll__img absolute inset-0 object-cover',
							)
						); ?>
					</div>
				<?php endif; ?>

				<div class="c_cards-scroll__slide-content grid gap-24 py-24 lg:pt-48 lg:pb-0 self-start">

					<?php if(!empty($i['eyebrow'])) : ?>
						<div class="t_label text-rust"><?=$i['eyebrow']?></div>
					<?php endif; ?>

					<?php if(!empty($i['headline'])) : ?>
						<h3 class=""><?=$i['headline']?></h3>
					<?php endif; ?>

					<?php if(!empty($i['text'])) : ?>
						<div class="t_body"><?=$i['text']?></div>
					<?php endif; ?>
				</div>

				

			</div>
		<?php endforeach; ?>
		
	</div>

</section>

<?php
echo CONTENT_OPEN;