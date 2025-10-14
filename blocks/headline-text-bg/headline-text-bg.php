<?php
/**
 * Block - Headline + Text + BG
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

global $data;

$fields = (!empty($data) ? $data : get_fields()); 

echo CONTENT_CLOSE; 

?>

<!-- component: headline + text + bg -->
<section id="<?=(!empty($block['anchor']) ? $block['anchor'] : $block['id'])?>" class="component c_bg relative z-1 bg-blue-lightest text-center">

	<!-- image -->
	<div class="c_bg__image absolute -z-1 inset-0 opacity-20">
		
		<?php echo core::get_custom_srcset(
			array(
				'lazy'=>true,
				'attachment_id'=>$fields['image'],
				'size'=>'original',
				'sizes'=>'(min-width: 680px) 100vw, (min-width: 540px) calc(55vw + 297px), calc(-65vw + 931px)',
				'classes'=>'c_bg__img absolute inset-0 object-cover w-full',
			)
		); ?>
	</div>

	<div class="c_bg__container container container--xs grid gap-12 lg:gap-24 py-48 lg:py-96">

		<!-- headline -->
		<?php if($fields['headline']) : ?>
			<h2 class="c_bg__headline">
				<?=$fields['headline']?>
			</h2>
		<?php endif; ?>

		<!-- text -->
		<?php if($fields['text']) : ?>
			<div class="c_bg__text relative z-1 t_wysiwyg t_body"><?=$fields['text']?></div>
		<?php endif; ?>

		<!-- buttons -->
		<?php if($fields['buttons']) :
			$classes = 'c_bg__btns relative z-1 mt-12 justify-center';
			$buttons = $fields['buttons'];
			$style = 'auto';
			include locate_template('partials/base/buttons.php', false, false);
		endif; ?>


	</div>


</section>

<?php 

echo CONTENT_OPEN;