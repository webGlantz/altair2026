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
<nav class="h_nav" :class="{ 'is-active' : menu }">
		
	<ul class="h_nav__ul grid lg:flex lg:gap-24 items-center" @click.outside="subnav = false">

		<li class="lg:hidden">
			<?php include locate_template('partials/header/utility.php', false, false); ?>
		</li>
		
		<?php foreach($nav as $k=>$i) : ?>

			<!-- nav item -->
			<li class="h_primary__i">

				<?php if($i['sub']) : ?>

					<!-- subnav toggle -->
					<button @click.prevent="toggleSubnav(<?=$k?>)" :class="{ 'is-active' : <?=$k?> === subnav }" class="h_subnav__toggle group <?=implode(' ', $i['classes'])?> <?=($i['current'] ? 'is-active' : '')?>">
						<span class="hover:underline"><?=$i['title']?></span>
						<i class="fa fa-chevron-down"></i>
					</button>

					<!-- subnav -->
					<ul x-show="<?=$k?> === subnav" x-collapse class="h_subnav">

						<!-- subnav overview item -->
						<li class="h_subnav__i">
							<a href="<?=$i['url']?>" class="hover:underline <?=implode(' ', $i['classes'])?> <?=($i['current'] ? 'is-active' : '')?>" target="<?=$i['target']?>">
								Overview
							</a>
						</li>

						<?php foreach($i['sub'] as $kid) : ?>

							<!-- subnav item -->
							<li class="h_subnav__i">
								<a href="<?=$kid['url']?>" class="hover:underline <?=implode(' ', $kid['classes'])?> <?=($kid['current'] ? 'is-active' : '')?>" target="<?=$kid['target']?>">
									<?=$kid['title']?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>

				<?php else : ?>

					<!-- nav link -->
					<a href="<?=$i['url']?>" class="hover:underline <?=implode(' ', $i['classes'])?> <?=($i['current'] ? 'is-active' : '')?>" target="<?=$i['target']?>">
						<?=$i['title']?>
					</a>
				<?php endif; ?>


			</li>
		<?php endforeach; ?>

		<?php if($header_btn) : ?>
			<li class="hidden lg:block">
				<?php include locate_template('partials/header/button.php', false, false); ?>
			</li>
		<?php endif; ?>


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

		<li class="hidden lg:block">
			<button @click="toggleSearch()" class="h_search-toggle flex items-center gap-8 group t_body" aria-label="Show/Hide Search" title="Show/Hide Search">
				<i x-show="search === false" class="fa fa-fw fa-search"></i>
				<i x-show="search === true" class="fa fa-fw fa-close"></i>
			</button>
		</li>

	</ul>

</nav>