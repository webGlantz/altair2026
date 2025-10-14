<?php
/**
 * Block - Text + Image + CTA
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

global $data;

$fields = (!empty($data) ? $data : get_fields()); 


echo CONTENT_CLOSE;

?>

<!-- component: text + image + cta -->
<section id="<?=(!empty($block['anchor']) ? $block['anchor'] : $block['id'])?>" class="component c_ac relative z-1">

	<div class="c_ac__container c_ac__<?=$fields['layout']?> container layout-grid gap-24 lg:gap-48 xl:gap-72">

		<!-- image -->
		<div class="c_ac__image relative z-1 col-4 lg:col-6 ar-4:3 <?=('right' === $fields['layout'] ? 'lg:order-last' : '')?>">
			
			<?php echo core::get_custom_srcset(
				array(
					'lazy'=>true,
					'attachment_id'=>$fields['image'],
					'size'=>'original',
					'sizes'=>'(min-width: 1540px) 763px, (min-width: 1040px) calc(46.88vw + 51px), calc(120.28vw - 50px)',
					'classes'=>'c_ac__img absolute inset-0 object-cover w-full',
				)
			); ?>
			
		</div>

		<div class="c_ac__content relative z-1 col-4 lg:col-6 self-center">
			
			<div class="grid gap-12 lg:gap-24">

				<!-- headline -->
				<?php if($fields['headline']) : ?>
					<h2 class="c_ac__headline">
						<?=$fields['headline']?>
					</h2>
				<?php endif; ?>

				<!-- subheadline -->
				<?php if($fields['subheadline']) : ?>
					<div class="c_ac__subheadline t_h6">
						<?=$fields['subheadline']?>
					</div>
				<?php endif; ?>

				<!-- text -->
				<?php if($fields['text']) : ?>
					<div class="c_ac__text relative z-1 t_wysiwyg t_body"><?=$fields['text']?></div>
				<?php endif; ?>

				<!-- buttons -->
				<?php if($fields['buttons']) :
					$classes = 'c_ac__btns relative z-1 mt-12';
					$buttons = $fields['buttons'];
					$style = 'auto';
					include locate_template('partials/base/buttons.php', false, false);
				endif; ?>
			</div>

		</div>
	</div>


</section>

<?php 

echo CONTENT_OPEN;