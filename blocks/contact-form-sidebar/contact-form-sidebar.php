<?php
/**
 * Block - Contact Form + Sidebar
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

$fields = get_fields();

$fields['phone_number'] = get_field('phone', 'options');
$fields['email_address'] = get_field('email', 'options');
$fields['address'] = get_field('address', 'options');
$fields['google_maps_url'] = get_field('google_maps_url', 'options');
$fields['google_maps_embed_code'] = get_field('google_maps_embed_code', 'options');


echo CONTENT_CLOSE;

?>

<!-- component: contact form + sidebar -->
<section id="<?=(!empty($block['anchor']) ? $block['anchor'] : $block['id'])?>" class="component c_form relative z-1">

	<div class="c_form__container container layout-grid gap-24 lg:gap-48">

			
		<!-- contact information -->
		<div class="c_form__info col-4 flex flex-col gap-12 lg:gap-24">


			<?php if($fields['phone_number']) : ?>
				<!-- phone -->
				<a href="tel:<?=$fields['phone_number']?>" class="contact-item c_form__info-item flex items-start gap-12 group">
					<i class="fa-sharp fa-fw fa-solid fa-phone"></i>
					<span class="font-bold hover:underline"><?=$fields['phone_number']?></span>
				</a>
			<?php endif; ?>

			<?php if($fields['email_address']) : ?>
				<!-- email -->
				<a href="mailto:<?=$fields['email_address']?>" class="contact-item c_form__info-item flex items-start gap-12 group">
					<i class="fa-sharp fa-fw fa-solid fa-envelope"></i>
					<span class="font-bold hover:underline">Email us</span>
				</a>
			<?php endif; ?>

			<?php if($fields['address']) : ?>
				<!-- address -->
				<a href="<?=$fields['google_maps_url']?>" class="contact-item c_form__info-item flex items-start gap-12 group" target="_blank">
					<i class="fa-sharp fa-fw fa-solid fa-location-dot"></i>
					<span class="font-bold hover:underline"><?=$fields['address']?></span>
				</a>
			<?php endif; ?>

			<div class="c_form__map relative overflow-hidden ar ar-4:3">
				<?=$fields['google_maps_embed_code']?>
			</div>

		</div>


		<!-- form -->
		<div class="p-36 lg:p-48 relative col-4 lg:col-7 xl:col-8">
			<?=do_shortcode('[gravityform id="' . $fields['form'] . '" title="false" ajax="true"]')?>
		</div>
	</div>

		

</section>

<?php 

echo CONTENT_OPEN;