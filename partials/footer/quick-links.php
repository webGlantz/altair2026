<?php
/**
 * Footer - Quick Links
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

global $header_btn;

$links = glantz\core::get_nav('footer-quick-links');
		
foreach($links as $i) : ?>

	<div class="f_right__i f_nav__li grid gap-12">

		<a href="<?=$i['url']?>" class="f_nav__a font-bold hover:underline <?=implode(' ', $i['classes'])?>" target="<?=$i['target']?>">
			<?=$i['title']?>
		</a>

		<?php if($i['sub']) : ?>

			<ul class="f_subnav grid gap-12">
				<?php foreach($i['sub'] as $kid) : ?>

					<!-- subnav item -->
					<li class="f_subnav__i">
						<a href="<?=$kid['url']?>" class="hover:underline <?=implode(' ', $kid['classes'])?> <?=($kid['current'] ? 'is-active' : '')?>" target="<?=$kid['target']?>">
							<?=$kid['title']?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>

		<?php endif; ?>

	</div>
<?php endforeach; 

if($header_btn) : ?>
	<div class="f_right__i f_nav__li grid lg:hidden gap-12">
		<a href="<?=$header_btn['url']?>" class="btn w-full" target="<?=$header_btn['target']?>">
			<?=$header_btn['title']?>
		</a>
	</div>

	<div class="f_right__i f_nav__li hidden lg:grid gap-12">
		<a href="<?=$header_btn['url']?>" class="f_nav__a font-bold hover:underline" target="<?=$header_btn['target']?>">
			<?=$header_btn['title']?>
		</a>
	</div>
<?php endif; ?>

