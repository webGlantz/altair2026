<?php
/**
 * Header
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

global $hero;
global $header_btn;

$header_btn = get_field('navigation_button', 'options');
$utility = get_field('utility_links', 'options');
$notification = get_field('banner_text', 'options');

?><!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Adobe Fonts -->
		<link rel="preconnect" href="use.typekit.net" crossorigin>
		<link rel="stylesheet" href="https://use.typekit.net/wzm7ykb.css">

		<!-- Font Awesome -->
		<link rel="preconnect" href="https://kit.fontawesome.com">
		<script src="https://kit.fontawesome.com/e99d6951b8.js" crossorigin="anonymous"></script>
		

		<!-- #TODO - Google site verification -->


		<!-- #TODO - Google Analytics / Tag Manager -->
		

		<?php
		wp_head();
		?>

		<script>
		/*to prevent Firefox FOUC, this must be here*/
		let FF_FOUC_FIX;
		</script>

	</head>
<body <?=body_class()?>>

		<div role="none" id="app" class="relative z-1" x-cloak x-data="{ 
					width: 0,
					height: 0,
					menu: null,
					search: false,
					subnav: null,
					toggleSearch() { (this.search ?  this.search = false : this.search = true) },
					toggleMenu() { this.menu = ! this.menu; this.submenu = null; },
					toggleSubnav(menu) { (this.subnav === menu ? this.subnav = null : this.subnav = menu)  }
				}"

				x-resize.document="width = $width; height = $height;
			">



			<!-- header -->
			<header class="h relative" :class="{ 'has:menu' : menu }" >


				<?php if($notification) : ?>
					<div class="lg:hidden py-8">
						<div class="container">
							<?php include locate_template('partials/header/notification.php', false, false); ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="hidden lg:block py-8">
					<div class="container">
						<?php include locate_template('partials/header/utility.php', false, false); ?>
					</div>
				</div>

				<div class="container flex justify-between items-center py-20">

					<a href="<?=site_url()?>" class="h_logo logo" title="Home - <?=get_bloginfo('name')?>" aria-label="Home - <?=get_bloginfo('name')?>">
						<img src="<?=THEME_URL?>/assets/svg/competition-roofing-logo.svg" width="165" height="38" class="h_logo__color" alt="<?=get_bloginfo('name')?> Logo" />
					</a>

					<button @click="toggleMenu()" class="h_menu-toggle lg:hidden flex flex-col justify-between items-center" :class="menu ? 'is-active' : ''" aria-label="Show/Hide Menu" title="Show/Hide Menu">
						<span></span>
					</button>

					<?php 

					include locate_template('partials/header/primary.php', false, false); 

					?>

				</div>
			</header>

			<!-- main -->
			<main>
