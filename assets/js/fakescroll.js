;(function(root, factory){
    var define = define || {};
    if( typeof define === 'function' && define.amd )
        define([], factory);
    else if( typeof exports === 'object' && typeof module === 'object' )
        module.exports = factory();
    else if(typeof exports === 'object')
        exports["FakeScroll"] = factory()
    else
        root.FakeScroll = factory()
  }(this, function(){
    raf = window.requestAnimationFrame || function(cb) { return window.setTimeout(cb, 1000 / 60) };

    function FakeScroll(targetElm, settings){
        if( !targetElm ) return;

        this.settings = Object.assign({}, this.defaults, settings || {})

        this.state = {}
        this.listeners = {}

        this.DOM = this.build(targetElm)
        this.events.binding.call(this, this.DOM)

        // run "moveBar" once
        setTimeout(this.events.callbacks.onScrollResize.bind(this))
    }

    FakeScroll.prototype = {
        defaults : {
            classname : "",
            track     : false // "smooth" will enable smooth scroll
        },

        /**
         * Build the DOM needed
         */
        build( targetElm ){
            var DOM = {};
                scopeHTML = `<div class='fakeScroll__wrap'>
                                <div class='fakeScroll__content'></div>
                             </div>
                            <div class='fakeScroll__controls container flex items-center gap-24 lg:gap-48'>

                                <div class='fakeScroll__track ${this.settings.classname}'>
                                    <div class='fakeScroll__bar'></div>
                                </div>

                                <div class='fakeScroll__nav flex items-center gap-12'>
                                    <button class='fakeScroll__navigation fakeScroll__prev fa-solid fa-arrow-left'></button>
                                    <button class='fakeScroll__navigation fakeScroll__next fa-solid fa-arrow-right'></button>
                                </div>
                            </div>
                             `,
                fragment = document.createDocumentFragment();

            // move all the children of the target element into a fragment
            while( targetElm.childNodes.length ){
                fragment.appendChild(targetElm.childNodes[0]);
            }

            targetElm.insertAdjacentHTML('afterbegin', scopeHTML);

            DOM.scope = targetElm;
            DOM.scrollWrap = targetElm.querySelector('.fakeScroll__wrap');
            DOM.scrollContent = DOM.scrollWrap.querySelector('.fakeScroll__content');
            DOM.scrollContent.appendChild(fragment);

            DOM.track = targetElm.querySelector('.fakeScroll__track');
            DOM.bar = targetElm.querySelector('.fakeScroll__bar');
            DOM.prev = targetElm.querySelector('.fakeScroll__prev');
            DOM.next = targetElm.querySelector('.fakeScroll__next');
            DOM.items = targetElm.querySelectorAll('.fakeScroll__item');
            DOM.current = 0;

            DOM.scope.classList.add("fakeScroll");

            return DOM;
        },

        destroy(){
            this.events.off.call(this, window, 'resize', 'onScrollResize');
        },

        get scrollRatio(){
            return this.state.scrollRatio
        },

        events : {
            on(elm, eName, cbName){
                // to be able tp unbind the events, callback refferece must be saved somewhere
                eName.split(' ').forEach(e => {
                    if( !(cbName in this.events.callbacks) ) console.warn(cbName, " doesn't exist in Callbacks: ", this.events.callbacks);

                    this.listeners[e] = this.events.callbacks[cbName].bind(this);
                    elm.addEventListener(e, this.listeners[e])
                });

                return this.events;
            },

            off(elm, eName, cbName){
                eName.split(' ').forEach(e => elm.removeEventListener(e, this.listeners[e]))
                return this.events;
            },

            binding(DOM){
                this.events.on.call(this, DOM.scrollContent, 'scroll', 'onScrollResize')
                           .on.call(this, DOM.scope, 'mouseenter', 'onScrollResize')
                           .on.call(this, DOM.bar, 'mousedown', 'onBarMouseDown')
                           .on.call(this, window, 'resize', 'onScrollResize')
                           .on.call(this, DOM.prev, 'click', 'onPrevClick')
                           .on.call(this, DOM.next, 'click', 'onNextClick')

                if( this.settings.track )
                    this.events.on.call(this, DOM.track, 'click', 'onTrackClick')
            },

            /**
             * events only binded when Bar element gets a "mousedown" event
             * @param  {[type]} onOff [description]
             * @return {[type]}       [description]
             */
            drag(onOff){
                this.events[onOff].call(this, document, 'mousemove', 'onDrag')
                           [onOff].call(this, document, 'mouseup', 'onStopDrag')
            },

            callbacks : {
                onScrollResize(){
                    this.moveBar.call(this);
                    this.DOM.scope.classList.toggle('fakeScroll--hasBar', this.state.ratio < 1)

                    // debounce - get track bounds
                    clearTimeout(this.listeners.timeout__resize);
                    this.listeners.timeout__resize = setTimeout(this.getTrackBounds.bind(this), 200)
                },

                onDrag(e){
                    var delta = e.pageX - this.state.lastPageX;

                    raf(() => {
                        var sLeft = document.documentElement.scrollLeft,
                            isDragWithinTrackBounds = e.pageX >= (this.state.trackBounds.left + sLeft) && e.pageX <= (this.state.trackBounds.right + sLeft);

                        if( isDragWithinTrackBounds )
                            this.DOM.scrollContent.scrollLeft = this.state.drag + delta / this.state.ratio;
                        // update variables when mouse position is outside the Track bounds
                        else{
                            this.state.drag = this.DOM.scrollContent.scrollLeft;
                            this.state.lastPageX = e.pageX;
                        }
                    });
                },

                onStopDrag(e){
                    [this.DOM.bar, document.body].map(el => el.classList.remove('fakeScroll--grabbed'))
                    this.events.drag.call(this, 'off');
                    setTimeout(()=>{ this.state.drag = false })
                },

                onBarMouseDown(e){
                    this.state.drag = this.DOM.scrollContent.scrollLeft;
                    this.state.lastPageX = e.pageX;

                    [this.DOM.bar, document.body].map(el => el.classList.add('fakeScroll--grabbed'))
                    this.events.drag.call(this, 'on');
                },

                onTrackClick(e){
                   

                    if( this.state.drag ) return;

                    var perc         = (e.clientX - this.state.trackBounds.left) / (this.state.trackBounds.width - this.state.trackBounds.leftPad - this.state.trackBounds.rightPad),
                        scrollWidth = this.DOM.scrollContent.scrollWidth,
                        ownWidth    = this.DOM.scrollWrap.clientWidth,
                        newScrollLeft = perc * (scrollWidth - ownWidth);

                    if( this.settings.track == 'smooth' ){
                        this.DOM.scrollContent.style.scrollBehavior = 'smooth';
                        setTimeout(()=>{ this.DOM.scrollContent.style.scrollBehavior = 'unset' }, 500)
                    }

                    this.DOM.scrollContent.scrollLeft = newScrollLeft;
                },

                onPrevClick(e) {
                    this.scrollNavigation(-1);
                },

                 onNextClick(e) {
                    this.scrollNavigation(1);
                }
            }
        },

        getTrackBounds(){
            var bounds = this.DOM.track.getBoundingClientRect(),
                styles = window.getComputedStyle(this.DOM.track, null);

            bounds.leftPad = parseInt(styles.paddingLeft, 10);
            bounds.rightPad = parseInt(styles.paddingRight, 10);

            this.state.trackBounds = bounds;
            return bounds;
        },

        moveBar(){
            // if( !this.DOM.scrollContent ) return false;

            var _scrollContent = this.DOM.scrollContent,
                scrollWidth = _scrollContent.scrollWidth,
                ownWidth   = this.DOM.scrollWrap.clientWidth;

            this.state.ratio = this.DOM.track.clientWidth / scrollWidth
            this.state.scrollRatio = this.DOM.scrollContent.scrollLeft / (_scrollContent.scrollWidth - ownWidth)


            // update fake scrollbar location on the x axis using requestAnimationFrame
            raf(()=> {
                var width = (ownWidth / scrollWidth) * 100,
                    left = (_scrollContent.scrollLeft / scrollWidth ) * 100;

                this.DOM.bar.style.cssText = `width  : ${width}%;
                                              left     : ${left}%;
                                              display : ${scrollWidth <= ownWidth ? 'none' : ''}`;

                this.settings.onChange && this.settings.onChange({scrollRatio:this.state.scrollRatio });
            });

        },

        scrollNavigation(direction) {

            var next = this.DOM.current + direction;
            var measure = (1 === direction ? this.DOM.current : this.DOM.current - 1);

            if(this.DOM.items[next]) {
                

                var width = this.DOM.items[measure].offsetWidth;
                var gap = 24;

                var fr = width + gap;
                var scroll = this.DOM.scrollContent.scrollLeft;

                var newScroll = scroll + (fr * direction);

                this.DOM.scrollContent.scroll({
                    top: 0,
                    left: newScroll,
                    behavior: 'smooth'
                });

                this.DOM.current = next;
            }


            
        }
    }

    /**
     * Extend the DOM with "fakeScroll" method. The chances of the same name already be taken are slim to none,
     * But you should now; it's your code you're putting this into.
     */
    Element.prototype.fakeScroll = function( settings ){
        this._fakeScroll = this._fakeScroll || new FakeScroll(this, settings || {});
        return this._fakeScroll;
    }

    return FakeScroll
}));