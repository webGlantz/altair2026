<?php
/**
 * Header
 *
 * @package Altair Advisers
 * @author Glantz <web@glantz.net>
 */

use glantz\core;

global $hero;

$phone = get_field('phone', 'options');
$careers = get_field('careers_link', 'options');
$client_login = get_field('client_login', 'options');

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

				<div class="container flex justify-between items-center py-20 lg:pt-36 lg:pb-72">

					<?php include locate_template('partials/header/logo.php', false, false); ?>

					<button @click="toggleMenu()" class="h_menu-toggle lg:hidden flex flex-col justify-between items-center" :class="menu ? 'is-active' : ''" aria-label="Show/Hide Menu" title="Show/Hide Menu">
						<span></span>
					</button>

					<nav class="h_nav lg:grid lg:gap-36" :class="{ 'is-active' : menu }">
						<?php 
						include locate_template('partials/header/utility.php', false, false);
						include locate_template('partials/header/primary.php', false, false); 

						?>
					</nav>

				</div>
			</header>

			<!-- main -->
			<main>
