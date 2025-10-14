##
# Build Tasks
#
# Requires "just":
# https://github.com/casey/just#installation
#
# Usage:
#   just --list
#   just <task>
#
# Most of the time, you'll just want to run:
#   just watch
##

js_dir := justfile_directory() + "/assets/js"
css_dir := justfile_directory() + "/assets/css"
scss_dir := justfile_directory() + "/assets/scss"

blocks_dir := justfile_directory() + "/blocks"


##
# Main!
##

# Watch for changes and rebuild.
@watch: build
	echo ""
	echo "👀 Watching"

	watchexec \
		--postpone \
		--no-shell \
		--watch "{{ justfile_directory() }}" \
		--debounce 1000 \
		--exts js,scss \
		--ignore "*.min.js" \
		-- just build

# Build the project.
@build: _init
	echo ""
	echo "🏡 Building"
	

	# Clean 
	find "{{ js_dir }}" "{{ css_dir }}" -name "*.min.*" -type f -delete

	# Javascript.
	just _js "{{ js_dir }}/accordion.js"
	just _js "{{ js_dir }}/carousel.js"
	just _js "{{ js_dir }}/core.js"
	just _js "{{ js_dir }}/libs.js"
	find "{{ blocks_dir }}" -name "*.js" -type f -exec just _js {} "block-" \;

	# SCSS.
	just _scss "{{ scss_dir }}/carousel.scss"
	just _scss "{{ scss_dir }}/clean-editor.scss"
	just _scss "{{ scss_dir }}/core.scss"
	just _scss "{{ scss_dir }}/feed-blog.scss"
	just _scss "{{ scss_dir }}/single-post.scss"
	find "{{ blocks_dir }}" -name "*.scss" -type f -exec just _scss {} "block-" \;

	echo ""
	echo "✅ Done! $( date )"
	echo ""
	echo "=============================================="


##
# Internal Helpers
##

# Minify JS.
@_js SRC PREFIX="":
	[ ! -f "{{ SRC }}" ] || esbuild \
		"{{ SRC }}" \
		--log-level=warning \
		--minify \
		--outfile="{{ js_dir }}/{{ PREFIX }}{{ replace(file_name(SRC), ".js", ".min.js") }}"

# Compile/minify SASS.
@_scss SRC PREFIX="":
	[ ! -f "{{ SRC }}" ] || sassc \
		-t compressed \
		"{{ SRC }}" \
		"{{ css_dir }}/{{ PREFIX }}{{ replace(file_name(SRC), ".scss", ".min.css") }}"


##
# Miscellaneous
##

# Install something with brew.
[no-exit-message]
@_brew PKG:
	if [ -f "$( which brew )" ]; then \
		echo "🌈 Installing: {{ PKG }}"; \
		brew install "{{ PKG }}"; \
	fi

# Print an error and exit.
[no-exit-message]
@_error MSG:
	echo "🚨 Error: {{ MSG }}"
	exit 1

# Get our ducks in a row.
[no-exit-message]
@_init:
	# esbuild.
	[ -f "$( which esbuild )" ] || just _brew esbuild || true
	[ -f "$( which esbuild )" ] || just _error "esbuild is required: https://esbuild.github.io/getting-started/"

	# sassc.
	[ -f "$( which sassc )" ] || just _brew sassc || true
	[ -f "$( which sassc )" ] || just _error "sassc is required: https://github.com/sass/sassc"

	# watchexec.
	[ -f "$( which watchexec )" ] || just _brew watchexec || true
	[ -f "$( which watchexec )" ] || just _error "watchexec is required: https://github.com/watchexec/watchexec/blob/main/doc/packages.md"
