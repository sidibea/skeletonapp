(function(i){'use strict';function a(){var i=Math.ceil(Math.random()*e);return type=n[i]};function o(n,e){'random'==e&&(e=a()),i(n).removeClass('trigger infinite '+t).addClass('trigger').addClass(e).one('webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend',function(){i(this).removeClass('trigger infinite '+t)})};function s(n,e){'random'==e&&(e=a()),i(n).removeClass('trigger infinite '+t).addClass('trigger infinite').addClass(e).one('webkitAnimationEnd oAnimationEnd MSAnimationEnd animationend',function(){i(this).removeClass('trigger infinite '+t)})};!function(i){i.fn.visible=function(t,a,n){var e=i(this).eq(0),h=e.get(0),o=i(window),s=o.scrollTop(),m=s+o.height(),r=o.scrollLeft(),c=r+o.width(),d=e.offset().top,u=d+e.height(),f=e.offset().left,g=f+e.width(),w=t===!0?u:d,v=t===!0?d:u,p=t===!0?g:f,C=t===!0?f:g,l=a===!0?h.offsetWidth*h.offsetHeight:!0,n=n?n:'both';return'both'===n?!!l&&m>=v&&w>=s&&c>=C&&p>=r:'vertical'===n?!!l&&m>=v&&w>=s:'horizontal'===n?!!l&&c>=C&&p>=r:void 0},i.fn.fireAnimations=function(){function t(){i(window).width()>=960?i('.animate').each(function(n,t){var t=i(t),a=i(this).attr('data-anim-type'),e=i(this).attr('data-anim-delay');t.visible(!0)&&setTimeout(function(){t.addClass(a)},e)}):i('.animate').each(function(n,t){var t=i(t),a=i(this).attr('data-anim-type'),e=i(this).attr('data-anim-delay');setTimeout(function(){t.addClass(a)},e)})};i(document).ready(function(){i('html').removeClass('no-js').addClass('js'),t()}),i(window).scroll(function(){t(),i(window).scrollTop()+i(window).height()==i(document).height()&&t()})},i('.animate').fireAnimations()}(jQuery);var t='flash strobe shake bounce tada wave spin pullback wobble pulse pulsate heartbeat panic explode',n=[];n=t.split(' ');var e=n.length;i(window).resize(function(){i('.animate').fireAnimations()})})(jQuery);