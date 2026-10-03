/**
 * Sulekha KPO front-end behaviour.
 */
( function () {
	'use strict';

	var body = document.body;
	var header = document.getElementById( 'site-header' );
	var toggle = document.querySelector( '.nav-toggle' );
	var nav = document.getElementById( 'primary-nav' );
	var toTop = document.querySelector( '.fab-top' );
	var reduceMotion = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	// Mobile navigation.
	function closeNav() {
		body.classList.remove( 'nav-open' );
		if ( toggle ) {
			toggle.setAttribute( 'aria-expanded', 'false' );
		}
	}

	if ( toggle && nav ) {
		toggle.addEventListener( 'click', function () {
			var open = body.classList.toggle( 'nav-open' );
			toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
		} );
		nav.addEventListener( 'click', function ( e ) {
			if ( e.target.closest( 'a' ) ) {
				closeNav();
			}
		} );
		document.addEventListener( 'click', function ( e ) {
			if ( body.classList.contains( 'nav-open' ) && ! e.target.closest( '#primary-nav, .nav-toggle' ) ) {
				closeNav();
			}
		} );
		document.addEventListener( 'keydown', function ( e ) {
			if ( 'Escape' === e.key ) {
				closeNav();
			}
		} );
	}

	// Header shadow and back-to-top visibility.
	function onScroll() {
		var y = window.scrollY;
		if ( header ) {
			header.classList.toggle( 'is-scrolled', y > 8 );
		}
		if ( toTop ) {
			toTop.classList.toggle( 'is-visible', y > 600 );
		}
	}
	window.addEventListener( 'scroll', onScroll, { passive: true } );
	onScroll();

	// Hero slider.
	var hero = document.querySelector( '[data-slider]' );
	if ( hero ) {
		var slides = hero.querySelectorAll( '.hero-slide' );
		var dots = hero.querySelectorAll( '.hero-dot' );
		var current = 0;
		var delay = 6500;
		var timer = null;

		hero.style.setProperty( '--slide-ms', delay + 'ms' );

		var go = function ( index ) {
			if ( slides.length < 2 ) {
				return;
			}
			index = ( index + slides.length ) % slides.length;
			slides.forEach( function ( slide, i ) {
				var active = i === index;
				slide.classList.toggle( 'is-active', active );
				slide.setAttribute( 'aria-hidden', active ? 'false' : 'true' );
				slide.querySelectorAll( 'a' ).forEach( function ( a ) {
					if ( active ) {
						a.removeAttribute( 'tabindex' );
					} else {
						a.setAttribute( 'tabindex', '-1' );
					}
				} );
			} );
			dots.forEach( function ( dot, i ) {
				// Re-trigger the progress animation.
				dot.classList.remove( 'is-active' );
				if ( i === index ) {
					void dot.offsetWidth;
					dot.classList.add( 'is-active' );
				}
			} );
			current = index;
		};

		var play = function () {
			if ( reduceMotion || slides.length < 2 ) {
				return;
			}
			clearInterval( timer );
			timer = setInterval( function () {
				go( current + 1 );
			}, delay );
			hero.classList.remove( 'is-paused' );
		};

		var pause = function () {
			clearInterval( timer );
			hero.classList.add( 'is-paused' );
		};

		var restart = function ( index ) {
			go( index );
			play();
		};

		dots.forEach( function ( dot ) {
			dot.addEventListener( 'click', function () {
				restart( parseInt( dot.getAttribute( 'data-slide' ), 10 ) );
			} );
		} );

		var prev = hero.querySelector( '[data-prev]' );
		var next = hero.querySelector( '[data-next]' );
		if ( prev ) {
			prev.addEventListener( 'click', function () {
				restart( current - 1 );
			} );
		}
		if ( next ) {
			next.addEventListener( 'click', function () {
				restart( current + 1 );
			} );
		}

		hero.addEventListener( 'mouseenter', pause );
		hero.addEventListener( 'mouseleave', play );
		hero.addEventListener( 'focusin', pause );
		hero.addEventListener( 'focusout', play );

		// Swipe.
		var startX = null;
		hero.addEventListener( 'touchstart', function ( e ) {
			startX = e.touches[ 0 ].clientX;
		}, { passive: true } );
		hero.addEventListener( 'touchend', function ( e ) {
			if ( null === startX ) {
				return;
			}
			var dx = e.changedTouches[ 0 ].clientX - startX;
			if ( Math.abs( dx ) > 50 ) {
				restart( dx < 0 ? current + 1 : current - 1 );
			}
			startX = null;
		} );

		document.addEventListener( 'visibilitychange', function () {
			if ( document.hidden ) {
				pause();
			} else {
				play();
			}
		} );

		play();
	}

	// Testimonials carousel arrows.
	var track = document.querySelector( '[data-t-track]' );
	if ( track ) {
		var step = function ( dir ) {
			var card = track.querySelector( '.t-card' );
			var amount = card ? card.getBoundingClientRect().width + 24 : track.clientWidth * 0.8;
			var atEnd = track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;
			if ( dir > 0 && atEnd ) {
				track.scrollTo( { left: 0 } );
			} else if ( dir < 0 && track.scrollLeft <= 4 ) {
				track.scrollTo( { left: track.scrollWidth } );
			} else {
				track.scrollBy( { left: dir * amount } );
			}
		};
		var tPrev = document.querySelector( '[data-t-prev]' );
		var tNext = document.querySelector( '[data-t-next]' );
		if ( tPrev ) {
			tPrev.addEventListener( 'click', function () {
				step( -1 );
			} );
		}
		if ( tNext ) {
			tNext.addEventListener( 'click', function () {
				step( 1 );
			} );
		}
	}

	// Quote dialog.
	var dialog = document.getElementById( 'quote-dialog' );
	if ( dialog && 'function' === typeof dialog.showModal ) {
		document.addEventListener( 'click', function ( e ) {
			var opener = e.target.closest( '[data-open-quote]' );
			if ( opener ) {
				e.preventDefault();
				closeNav();
				dialog.showModal();
				var first = dialog.querySelector( 'input[name="name"]' );
				if ( first ) {
					first.focus();
				}
				return;
			}
			if ( e.target.closest( '[data-close-quote]' ) || e.target === dialog ) {
				dialog.close();
			}
		} );
	}

	// Animate numbers like "250+", "99.5%", "12".
	function countUp( el ) {
		var raw = el.getAttribute( 'data-count' ) || '';
		var match = raw.match( /^([^0-9]*)([0-9][0-9,]*(?:\.[0-9]+)?)(.*)$/ );
		if ( ! match ) {
			return;
		}
		var prefix = match[ 1 ];
		var number = match[ 2 ].replace( /,/g, '' );
		var grouped = match[ 2 ].indexOf( ',' ) !== -1;
		var target = parseFloat( number );
		var decimals = ( number.split( '.' )[ 1 ] || '' ).length;
		var suffix = match[ 3 ];
		var format = function ( n ) {
			return grouped ? n.toLocaleString( 'en-US', { minimumFractionDigits: decimals, maximumFractionDigits: decimals } ) : n.toFixed( decimals );
		};
		var start = null;
		var duration = 1600;

		function frame( t ) {
			if ( null === start ) {
				start = t;
			}
			var p = Math.min( ( t - start ) / duration, 1 );
			var eased = 1 - Math.pow( 1 - p, 3 );
			el.textContent = prefix + format( target * eased ) + suffix;
			if ( p < 1 ) {
				requestAnimationFrame( frame );
			}
		}
		requestAnimationFrame( frame );
	}

	// Reveal on scroll.
	var revealEls = document.querySelectorAll( '.reveal' );

	if ( ! ( 'IntersectionObserver' in window ) || reduceMotion ) {
		revealEls.forEach( function ( el ) {
			el.classList.add( 'is-visible' );
		} );
		return;
	}

	var observer = new IntersectionObserver(
		function ( entries ) {
			entries.forEach( function ( entry ) {
				if ( ! entry.isIntersecting ) {
					return;
				}
				var el = entry.target;
				var index = el.parentElement ? Array.prototype.indexOf.call( el.parentElement.children, el ) : 0;
				el.style.transitionDelay = Math.min( index, 6 ) * 80 + 'ms';
				el.classList.add( 'is-visible' );
				var stat = el.querySelector( '[data-count]' );
				if ( stat ) {
					countUp( stat );
				}
				observer.unobserve( el );
			} );
		},
		{ rootMargin: '0px 0px -8% 0px', threshold: 0.1 }
	);

	revealEls.forEach( function ( el ) {
		observer.observe( el );
	} );
}() );
