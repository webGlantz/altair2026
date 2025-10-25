<?php
/**
 * Footer - Social
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

$links = glantz\core::get_nav('footer-social'); ?>

<div class="grid gap-20 items-start">
	<div class="t_h5"><?=_e('Stay in Touch', TEXTDOMAIN)?></div>

	<ul class="f__list grid gap-20 t_body">
		
		<?php foreach($links as $i) : ?>

			<div class="f_nav__li grid">

				<a href="<?=$i['url']?>" class="f_nav__a hover:underline <?=implode(' ', $i['classes'])?>" target="<?=$i['target']?>">
					<?=$i['title']?>
				</a>

			</div>
		<?php endforeach; ?>

	</ul>
</div>

