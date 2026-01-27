<?php
/**
 * Header: Utility
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */


?>


<ul class="h_nav__utility lg:flex gap-24 xl:gap-36 justify-end">

	<li class="hidden lg:block">
		<button @click="toggleSearch()" class="h_search-toggle flex items-center gap-8 group" aria-label="Show/Hide Search" title="Show/Hide Search">
			<svg x-show="search === false" class="i" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160.29 169.47">
				<path fill="currentColor" class="cls-1" d="M160.29,163.1l-52.66-52.66c12.41-11.66,20.18-28.21,20.18-46.54C127.81,28.67,99.14,0,63.9,0S0,28.67,0,63.9s28.67,63.9,63.9,63.9c13.66,0,26.32-4.32,36.72-11.65l53.31,53.31,6.36-6.36ZM9,63.9c0-30.27,24.63-54.9,54.9-54.9s54.9,24.63,54.9,54.9-24.63,54.9-54.9,54.9S9,94.18,9,63.9Z"/>
			</svg>
			<i x-show="search === true" class="fa fa-fw fa-close"></i>
			<span class="hover:underline" x-show="search === false">Search</span>
			<span class="hover:underline" x-show="search === true">Close Search</span>
		</button>
	</li>

	<?php if(!empty($careers) && !empty($careers['url'])) : ?>
		<!-- careers -->
		<li class="h_nav__utility-icon-i hidden lg:block">
			<a href="<?=$careers['url']?>" class="flex items-center gap-12 lg:gap-8 group" target="<?=$careers['target']?>">		
				<svg class="i" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 185 166.16">
					<path fill="currentColor" d="M185,32.47c0-2.49-2.01-4.5-4.5-4.5h-53.49v-2.59c0-13.99-11.39-25.38-25.39-25.38h-18.24c-14,0-25.39,11.38-25.39,25.38v2.59H4.5c-2.49,0-4.5,2.01-4.5,4.5v24.42c0,6.87,1.51,13.39,4.19,19.26,0,.01,0,.03,0,.04v85.47c0,2.49,2.01,4.5,4.5,4.5h167.63c2.49,0,4.5-2.01,4.5-4.5v-85.47s0-.03,0-.04c2.68-5.88,4.19-12.4,4.19-19.26v-24.42ZM66.99,25.38c0-9.03,7.35-16.38,16.39-16.38h18.24c9.04,0,16.39,7.35,16.39,16.38v2.59h-51.02v-2.59ZM171.82,157.16H13.18v-67.85c8.48,8.74,20.34,14.18,33.45,14.18h18.63c-.07.5-.12,1.01-.12,1.53v15.23c0,5.81,4.73,10.54,10.53,10.54h33.65c5.81,0,10.54-4.73,10.54-10.54v-15.23c0-.52-.05-1.03-.12-1.53h18.63c13.11,0,24.97-5.44,33.45-14.18v67.85ZM74.14,120.25v-15.23c0-.85.69-1.53,1.53-1.53h33.65c.85,0,1.54.69,1.54,1.53v15.23c0,.85-.69,1.54-1.54,1.54h-33.65c-.85,0-1.53-.69-1.53-1.54ZM176,56.88c0,20.74-16.88,37.61-37.63,37.61H46.63c-20.75,0-37.63-16.87-37.63-37.61v-19.92h167v19.92Z"/>
				</svg>
				<span class="hover:underline"><?=$careers['title']?></span>
			</a>

		</li>
	<?php endif; ?>

		<!-- contant -->
		<li class="h_nav__utility-icon-i">
			<a href="/contact" class="flex items-center gap-12 lg:gap-8 group">
				<span class="hover:underline">Contact Us</span>
			</a>

		</li>


	<?php if(!empty($client_login) && !empty($client_login['url'])) : ?>
		<!-- client login -->
		<li class="h_nav__utility-i hidden lg:block">
			<a href="<?=$client_login['url']?>" class="h_nav__utility-i hover:underline" target="<?=$client_login['target']?>">		
				<?=$client_login['title']?>
			</a>
		</li>
	<?php endif; ?>

</ul>
