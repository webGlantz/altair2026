<?php
/**
 * Footer - Newsletter
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

$headline = get_field('footer_newsletter_headline', 'options');
$form = get_field('footer_newsletter_form', 'options');

?>

<div class="f_newsletter">

	<?php if($headline) : ?>
		<h2 class="t_body font-normal"><?=$headline?></h2>
	<?php endif; ?>

	<!-- form -->
	<?=do_shortcode('[gravityform id="' . $form . '" title="false" ajax="true"]')?>

</div>