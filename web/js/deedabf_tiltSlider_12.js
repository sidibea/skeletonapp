(function(t){'use strict';Modernizr.addTest('csstransformspreserve3d',function(){var e=Modernizr.prefixed('transformStyle'),i='preserve-3d',n;if(!e)return!1;e=e.replace(/([A-Z])/g,function(t,e){return'-'+e.toLowerCase()}).replace(/^ms-/,'-ms-');Modernizr.testStyles('#modernizr{'+e+':'+i+';}',function(i,s){n=t.getComputedStyle?getComputedStyle(i,null).getPropertyValue(e):''});return(n===i)});var n={animations:Modernizr.cssanimations,preserve3d:Modernizr.csstransformspreserve3d,transforms3d:Modernizr.csstransforms3d},s=n.animations&&n.preserve3d&&n.transforms3d,o={'WebkitAnimation':'webkitAnimationEnd','OAnimation':'oAnimationEnd','msAnimation':'MSAnimationEnd','animation':'animationend'},i=o[Modernizr.prefixed('animation')];function r(t,e){for(var i in e){if(e.hasOwnProperty(i)){t[i]=e[i]}};return t};function e(t,e){this.el=t;this.animEffectsOut=['moveUpOut','moveDownOut','slideUpOut','slideDownOut','slideLeftOut','slideRightOut'];this.animEffectsIn=['moveUpIn','moveDownIn','slideUpIn','slideDownIn','slideLeftIn','slideRightIn'];this.items=this.el.querySelector('ol.slides').children;this.itemsCount=this.items.length;if(!this.itemsCount)return;this.current=0;this.options=r({},this.options);r(this.options,e);this._init()};e.prototype.options={};e.prototype._init=function(){this._addNavigation();this._initEvents()};e.prototype._addNavigation=function(){this.nav=document.createElement('nav');var e='';for(var t=0;t<this.itemsCount;++t){e+=t===0?'<span class="current"></span>':'<span></span>'};this.nav.innerHTML=e;this.el.appendChild(this.nav);this.navDots=[].slice.call(this.nav.children)};e.prototype._initEvents=function(){var t=this;this.navDots.forEach(function(e,i){e.addEventListener('click',function(){if(i!==t.current){t._showItem(i)}})})};e.prototype._showItem=function(t){if(this.isAnimating){return!1};this.isAnimating=!0;classie.removeClass(this.navDots[this.current],'current');var v=this,n=this.items[this.current];this.current=t;var e=this.items[this.current],f=this.animEffectsOut[Math.floor(Math.random()*this.animEffectsOut.length)],m=this.animEffectsIn[Math.floor(Math.random()*this.animEffectsOut.length)];n.setAttribute('data-effect-out',f);e.setAttribute('data-effect-in',m);classie.addClass(this.navDots[this.current],'current');var a=0,h=n.querySelector('.tiltview').children.length,u=e.querySelector('.tiltview').children.length,d=0,c=0,l=function(){++a;if(a===2){v.isAnimating=!1}},r=function(){++d;var t=function(){classie.removeClass(n,'hide');classie.removeClass(n,'current');l()};if(!s){t()}
else if(d===h){n.removeEventListener(i,r);t()}},o=function(){++c;var t=function(){classie.removeClass(e,'show');classie.addClass(e,'current');l()};if(!s){t()}
else if(c===u){e.removeEventListener(i,o);t()}};classie.addClass(n,'hide');classie.addClass(e,'show');if(s){n.addEventListener(i,r);e.addEventListener(i,o)}
else{r();o()}};t.TiltSlider=e})(window);