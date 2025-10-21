<?php
/**
 * Block - Image + Text
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

global $data;

$fields = (!empty($data) ? $data : get_fields()); 


?>

<!-- component: image + text -->
<div class="c_image-text layout-grid items-start gap-24 lg:gap-48">

	<!-- image -->
	<div class="c_image-text__image relative z-1 col-4 lg:col-6 grid gap-12">
		
		<?php echo core::get_custom_srcset(
			array(
				'lazy'=>true,
				'attachment_id'=>$fields['image'],
				'size'=>'original',
				'sizes'=>'(min-width: 1520px) 633px, (min-width: 1040px) calc(38.26vw + 57px), calc(119.86vw - 47px)',
				'classes'=>'c_image-text__img',
			)
		); ?>

		<?php if(!empty($fields['caption'])) : ?>
			<div class="wp-element-caption"><?=$fields['caption']?></div>
		<?php endif; ?>
		
	</div>
		
	<div class="c_image-text__content relative z-1 col-4 lg:col-6 lg:start-col-7 flex flex-col gap-24 self-center">
		
			<div  class="grid gap-12 lg:gap-24 lg:mb-24 max-w-560">

				<!-- text -->
				<?php if($fields['text']) : ?>
					<div class="c_image-text__text relative z-1 t_wysiwyg t_body t_body--sm"><?=$fields['text']?></div>
				<?php endif; ?>

			</div>

		

	</div>

</div>