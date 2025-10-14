document.addEventListener('alpine:init', () => {
	Alpine.data('serviceCard', () => ({

		hover: false,
		size: 0,
		breakpoint: 1024,
		
		isShown() {
			if(true === this.hover || this.breakpoint > this.size) {
				return true;
			}

			return false;
		}

	}));
});