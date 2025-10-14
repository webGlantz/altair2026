document.addEventListener('alpine:init', () => {
	Alpine.data('carousel', (total = 0, autoplay = false) => ({

		active: 0,
		out: null,
		total: total,
		autoplay: autoplay,
		timeout: 5000,
		interval: null,

		goTo(slide) {
			this.pauseAutoplay();

			this.out = this.active;

			if(slide > this.total - 1) {
				this.active = 0;
			}

			else if (slide < 0) {
				this.active = this.total -1;
			}

			else {			
				this.active = slide;
			}

			clearInterval(this.interval);
			this.startAutoplay();
		},

		init() {
			this.startAutoplay();
		},

		startAutoplay() {

			if(this.autoplay) {

				var alpine = this;

				this.interval = setInterval(function() {

					alpine.out = alpine.active;

					var newSlide = alpine.active + 1;

					newSlide = (newSlide > alpine.total - 1 ? 0 : newSlide);

					alpine.active = newSlide;

				}, alpine.timeout);
			}
		},

		pauseAutoplay() {
			clearInterval(this.interval);
		},

		toggleAutoplay() {

			if(this.autoplay) {
				this.autoplay = false;
				this.pauseAutoplay();
			}

			else {
				this.autoplay = true;
				this.startAutoplay();
			}
		}		

	}));
});