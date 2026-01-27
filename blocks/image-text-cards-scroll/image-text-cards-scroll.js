document.addEventListener('alpine:init', () => {
	Alpine.data('timeline', () => ({

		fake: null,
		atStart: true,
		atEnd: false,

		init() {
			const grid = this.$el.querySelector('.c_cards-scroll__grid');
			if (!grid) return;

			this.fake = grid.fakeScroll({
				track: 'smooth',
				onChange: ({ scrollRatio }) => {
					// scrollRatio is 0..1
					this.atStart = scrollRatio <= 0.001;
					this.atEnd   = scrollRatio >= 0.999;

					this.syncNavDisabledClasses();
				}
			});

			// One extra sync after init (covers first paint / initial resize)
			requestAnimationFrame(() => this.syncNavDisabledClasses());
		},

		syncNavDisabledClasses() {
			const prev = this.$el.querySelector('.fakeScroll__prev');
			const next = this.$el.querySelector('.fakeScroll__next');

			if (prev) {
				prev.classList.toggle('is-disabled', this.atStart);
				prev.toggleAttribute('disabled', this.atStart);
			}

			if (next) {
				next.classList.toggle('is-disabled', this.atEnd);
				next.toggleAttribute('disabled', this.atEnd);
			}
		},

	}));
});
