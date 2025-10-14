let lastKnownScrollPosition = 0;
let ticking = false;

function wpClean() {

	/* iframes clean up */
	var iframes = document.querySelectorAll('.t_wysiwyg iframe');

	for(var i = 0; i < iframes.length; i++) {
		var item = iframes[i];
		var parent = item.parentNode;

		parent.classList.add('has-iframe');
	}

	/* wysiwyg clean up */
	var wysiwyg = document.querySelectorAll('.component_wysiwyg');

	for(var i = 0; i < wysiwyg.length; i++) {

		var container = wysiwyg[i].querySelector('.component_wysiwyg__container'); 

		if(container && !container.children.length) {
			wysiwyg[i].remove();
		}
	}
}

function scrollTo(selector) {
	var elem = document.querySelector(selector);
	var header = document.querySelector('.h');
	var eTop = elem.getBoundingClientRect().top + window.scrollY;
	var buffer = 48;

	window.scroll({
		top: eTop - buffer,
		left: 0,
		behavior: 'smooth'
	});
}

function headerHeight() {
	let header = document.querySelector('.h');
	let body = document.querySelector('body');
	let hero_top = document.querySelector('.hero-top');
	
	body.style.setProperty('--header-height', header.offsetHeight + 'px');

	if(hero_top) {
		let hero = document.querySelector('.hero');
		hero.style.setProperty('--hero-top-height', hero_top.offsetHeight + 'px');

	}
}

document.addEventListener("DOMContentLoaded", () => {

	// WP Clean.
	wpClean();
	headerHeight();

});

// Capture header height
window.addEventListener("resize", (event) => {
	headerHeight();
});