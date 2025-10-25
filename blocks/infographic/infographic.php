<?php
/**
 * Block - Infographic
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

global $data;

$fields = (!empty($data) ? $data : get_fields()); 

echo CONTENT_CLOSE; 

?>

<!-- component: infographic -->
<section id="<?=(!empty($block['anchor']) ? $block['anchor'] : $block['id'])?>" class="component c_infographic relative z-1 grid gap-48 lg:gap-60 bg-blue text-white text-center">

	<!-- bg -->
	<div class="c_infographic__bg absolute -z-1 inset-0 opacity-20">
		
		<?php echo core::get_custom_srcset(
			array(
				'lazy'=>true,
				'attachment_id'=>$fields['image'],
				'size'=>'original',
				'sizes'=>'(min-width: 680px) 100vw, (min-width: 540px) calc(55vw + 297px), calc(-65vw + 931px)',
				'classes'=>'c_infographic__bg-img absolute inset-0 object-cover w-full opacity-20',
			)
		); ?>
	</div>

	<div class="c_infographic__container container container--sm grid gap-12 lg:gap-24">

		<!-- headline -->
		<?php if($fields['headline']) : ?>
			<h2 class="c_infographic__headline max-w-640 mx-auto">
				<?=$fields['headline']?>
			</h2>
		<?php endif; ?>

		<!-- text -->
		<?php if($fields['text']) : ?>
			<div class="c_infographic__text relative z-1 t_wysiwyg t_body"><?=$fields['text']?></div>
		<?php endif; ?>

	</div>

	<div class="container">

		<!-- image -->
		<div class="c_infographic__image relative">
			<?php echo core::get_custom_srcset(
				array(
					'lazy'=>true,
					'attachment_id'=>$fields['infographic_desktop'],
					'size'=>'original',
					'sizes'=>'(min-width: 680px) 100vw, (min-width: 540px) calc(55vw + 297px), calc(-65vw + 931px)',
					'classes'=>'c_infographic__img hidden lg:block',
				)
			); ?>

			<?php echo core::get_custom_srcset(
				array(
					'lazy'=>true,
					'attachment_id'=>$fields['infographic_mobile'],
					'size'=>'original',
					'sizes'=>'(min-width: 680px) 100vw, (min-width: 540px) calc(55vw + 297px), calc(-65vw + 931px)',
					'classes'=>'c_infographic__img lg:hidden',
				)
			); ?>
		</div>


	</div>


</section>

<?php 

echo CONTENT_OPEN;