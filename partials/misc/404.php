<?php
/**
 * 404
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

?>

<section class="my-36 lg:my-96 component_wysiwyg relative z-1">
	<div class="component_wysiwyg__container container grid t_wysiwyg t_body text-center">

		<h1><?=__('Oops, this page doesn\'t exist', TEXTDOMAIN)?></h1>

		<p><?=__('Try searching for another page', TEXTDOMAIN)?></p>

		<div style="max-width: 420px; width: 100%; margin: 30px auto 0;">
			<?php 
			$location = 'four-oh-four';
			include locate_template('partials/misc/search-form.php', false, false); ?>
		</div>

	</div>
</section>