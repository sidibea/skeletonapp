/*!
 * classie - class helper functions
 * from bonzo https://github.com/ded/bonzo
 * 
 * classie.has( elem, 'my-class' ) -> true/false
 * classie.add( elem, 'my-new-class' )
 * classie.remove( elem, 'my-unwanted-class' )
 * classie.toggle( elem, 'my-class' )
 */
(function(s){'use strict';function c(s){return new RegExp('(^|\\s+)'+s+'(\\s+|$)')};var e,n,a;if('classList' in document.documentElement){e=function(s,e){return s.classList.contains(e)};n=function(s,e){s.classList.add(e)};a=function(s,e){s.classList.remove(e)}}
else{e=function(s,e){return c(e).test(s.className)};n=function(s,n){if(!e(s,n)){s.className=s.className+' '+n}};a=function(s,e){s.className=s.className.replace(c(e),' ')}};function i(s,t){var c=e(s,t)?a:n;c(s,t)};var t={hasClass:e,addClass:n,removeClass:a,toggleClass:i,has:e,add:n,remove:a,toggle:i};if(typeof define==='function'&&define.amd){define(t)}
else{s.classie=t}})(window);