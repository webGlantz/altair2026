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


<!-- contact information -->
<div class="flex flex-col gap-12 lg:gap-24">

	<?php if($phone_number) : ?>
		<!-- phone -->
		<a href="tel:<?=$phone_number?>" class="contact-item flex items-start gap-12 group">
			<i class="fa-sharp fa-fw fa-solid fa-phone"></i>
			<span class="hover:underline"><?=$phone_number?></span>
		</a>
	<?php endif; ?>

	<?php if($email_address) : ?>
		<!-- email -->
		<a href="mailto:<?=$email_address?>" class="contact-item flex items-start gap-12 group">
			<i class="fa-sharp fa-fw fa-solid fa-envelope"></i>
			<span class="hover:underline">Email us</span>
		</a>
	<?php endif; ?>

	<?php if($address) : ?>
		<!-- address -->
		<a href="<?=$google_maps_url?>" class="contact-item flex items-start gap-12 group" target="_blank">
			<i class="fa-sharp fa-fw fa-solid fa-location-dot"></i>
			<span class="hover:underline"><?=$address?></span>
		</a>
	<?php endif; ?>

</div>


