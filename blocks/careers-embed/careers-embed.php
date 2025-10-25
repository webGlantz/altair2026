<?php
/**
 * Block - Careers Embed
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

global $data;

$fields = (!empty($data) ? $data : get_fields()); 

echo CONTENT_CLOSE; 

?>

<!-- component: careers embed -->
<section id="<?=(!empty($block['anchor']) ? $block['anchor'] : $block['id'])?>" class="component c_embed relative z-1 grid gap-48 lg:gap-60 bg-grey text-center">


	<div class="c_embed__container container container--xs grid gap-12 lg:gap-24">

		<!-- headline -->
		<?php if($fields['headline']) : ?>
			<h2 class="c_embed__headline">
				<?=$fields['headline']?>
			</h2>
		<?php endif; ?>

		<!-- text -->
		<?php if($fields['text']) : ?>
			<div class="c_embed__text relative z-1 t_wysiwyg t_body"><?=$fields['text']?></div>
		<?php endif; ?>
		
	</div>

	<div class="container">
		<?=$fields['embed_code']?>
	</div>


</section>

<?php 

echo CONTENT_OPEN;