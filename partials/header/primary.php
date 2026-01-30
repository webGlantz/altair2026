<?php
/**
 * Header: Primary Navigation
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */


$nav = glantz\core::get_nav('header-primary-navigation');

?>


<!-- primary navigation -->
<ul class="h_nav__primary grid lg:flex gap-24 lg:gap-36 xl:gap-48 items-center" @click.outside="subnav = false">

	<?php foreach($nav as $k=>$i) : ?>

		<!-- nav item -->
		<li class="h_nav__primary-i <?=($i['current'] ? 'is-active' : '')?>">
			<!-- nav link -->
			<a href="<?=$i['url']?>" class=" <?=implode(' ', $i['classes'])?>" target="<?=$i['target']?>">
				<?=$i['title']?>
			</a>
		</li>
	<?php endforeach; ?>

	<?php if(!empty($careers) && !empty($careers['url'])) : ?>
		<!-- careers -->
		<li class="h_nav__primary-i lg:hidden">
			<a href="<?=$careers['url']?>" target="<?=$careers['target']?>">		
				<?=$careers['title']?>
			</a>
		</li>
	<?php endif; ?>
		<!-- contact -->
		<li class="h_nav__primary-i lg:hidden">
			<a href="/contact" target="">		
				Contact Us
			</a>
		</li>

	<li class="h_search lg:hidden mt-24">
		<?php 
		$location = 'header-mobile';
		include locate_template('partials/misc/search-form.php', false, false); ?>
	</li>

	<li class="h_search hidden lg:block" x-show="search" x-collapse>
		<div class="container">
			<?php 
			$location = 'header-desktop';
			include locate_template('partials/misc/search-form.php', false, false); ?>
		</div>
	</li>

</ul>