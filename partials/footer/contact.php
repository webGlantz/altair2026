<?php
/**
 * Footer - Contact
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

$phone_number = get_field('phone', 'options');
$email_address = get_field('email', 'options');
$address = get_field('address', 'options');
$google_maps_url = get_field('google_maps_url', 'options');
		
?>


<div class="grid gap-20">
	<div class="t_h5 flex gap-8 items-center"><a class="hover:underline" href="/contact"><?=_e('Contact Us', TEXTDOMAIN)?></a><i style="font-size: 18px;" class="fa fas fa-arrow-right"></i></div>

	<ul class="f__list grid gap-20 t_body">

		<?php if($phone_number) : ?>
			<!-- phone -->
			<a href="tel:<?=$phone_number?>" class="hover:underline">
				<?=$phone_number?>
			</a>
		<?php endif; ?>

		<?php if($email_address) : ?>
			<!-- email -->
			<a href="mailto:<?=$email_address?>" class="hover:underline">
				Email us
			</a>
		<?php endif; ?>

		<?php if($address) : ?>
			<!-- address -->
			<a href="<?=$google_maps_url?>" class="hover:underline" target="_blank">
				<?=$address?>
			</a>
		<?php endif; ?>
	</ul>

	<?php include locate_template('partials/footer/newsletter.php', false, false); ?>

</div>


