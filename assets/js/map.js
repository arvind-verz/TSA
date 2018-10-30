/*!
 *  GMAP3 Plugin for jQuery
 *  Version  : 7.2
 *  Date     : 2016/12/03
 *  Author   : DEMONTE Jean-Baptiste
 *  Contact  : jbdemonte@gmail.com
 *  Web site : http://gmap3.net
 *  Licence  : GPL-3.0+
 */
!function(n,t,e){"use strict";function o(n){return S(!0,{},n||{})}function r(){var n=Array.prototype.slice,t=n.call(arguments,1);return n.apply(arguments[0],t)}function i(n){return"undefined"==typeof n}function u(t){return O.apply(n,t)}function a(n){return O().then(function(){return n})}function c(n,t){var e=Math,o=e.PI,r=o*n.lat()/180,i=o*n.lng()/180,u=o*t.lat()/180,a=o*t.lng()/180,c=e.cos,s=e.sin;return 6371e3*e.acos(e.min(c(r)*c(u)*c(i)*c(a)+c(r)*s(i)*c(u)*s(a)+s(r)*s(u),1))}function s(n){"loading"!=e.readyState?n():e.addEventListener("DOMContentLoaded",n)}function f(n){return v(n).map(function(t){return encodeURIComponent(t)+"="+encodeURIComponent(n[t])}).join("&")}function p(n){return D[n]||(D[n]=l(n)),D[n]}function l(n){function t(n){return e.apply(this,n)}var e=E[n];return t.prototype=e.prototype,new t(r(arguments,1))}function g(n){var t=$();return"string"==typeof n&&(n={address:n}),p("Geocoder").geocode(n,function(n,e){e===E.GeocoderStatus.OK?t.resolve(n[0].geometry.location):t.reject(e)}),t}function d(n,t){h(n.split(" "),t)}function h(n,t){(R(n)?n:[n]).forEach(t)}function v(n){return Object.keys(n)}function y(n){return v(n).map(function(t){return n[t]})}function m(n,t){return n=o(n),n.bounds&&(n.bounds=P(n.bounds)),a(t(n))}function L(n,t,e){var r=$();return n=o(n),O().then(function(){var e=n.address;return e?(delete n.address,g(e).then(function(e){n[t]=e})):void(n[t]=x(n[t]))}).then(function(){r.resolve(e(n))}).fail(function(n){r.reject(n)}),r}function w(n,t,e){return n=o(n),n[t]=(n[t]||[]).map(x),a(e(n))}function x(n,t){return R(n)?new E.LatLng(n[0],n[1]):!t||!n||n instanceof E.LatLng?n:new E.LatLng(n.lat,n.lng)}function P(n,t){return R(n)?new E.LatLngBounds({lat:n[2],lng:n[3]},{lat:n[0],lng:n[1]}):t&&!n.getCenter?new E.LatLngBounds({lat:n.south,lng:n.west},{lat:n.north,lng:n.east}):n}function b(t,o){function r(){function n(n){return e.getProjection().fromLatLngToDivPixel(n)}var e=this,r=[];i.call(e),e.setMap(t),e.onAdd=function(){var n=e.getPanes();n.overlayMouseTarget.appendChild(u[0])},o.position?(e.getPosition=function(){return o.position},e.setPosition=function(n){o.position=n,e.draw()},e.draw=function(){var t=n(o.position);u.css({left:t.x+o.x+"px",top:t.y+o.y+"px"})}):(e.getBounds=function(){return o.bounds},e.setBounds=function(n){o.bounds=n,e.draw()},e.draw=function(){var t=n(o.bounds.getSouthWest()),e=n(o.bounds.getNorthEast());u.css({left:t.x+o.x+"px",top:e.y+o.y+"px",width:e.x-t.x+o.x+"px",height:t.y-e.y+o.y+"px"})}),e.onRemove=function(){r.map(function(n){E.event.removeListener(n)}),u.remove(),e.$=u=null},e.$=u}var i=E.OverlayView,u=n(e.createElement("div")).css({border:"none",borderWidth:0,position:"absolute"}).append(o.content);return o=S({x:0,y:0},o),o.position?o.position=x(o.position,!0):o.bounds&&(o.bounds=P(o.bounds,!0)),r.prototype=new i,new r}function M(n){function t(){var n=this;return n.onAdd=n.onRemove=n.draw=function(){},E.OverlayView.call(n)}t.prototype=new E.OverlayView;var e=new t;return e.setMap(n),e.getProjection()}function B(n,t,e,o){var r=this;r.cluster=n,r.markers=t,r.$=e.$,r.overlay=e,e.getBounds=function(){return l("LatLngBounds",o.getSouthWest(),o.getNorthEast())}}function C(n,t){function e(){var t=l("Circle",{center:n.getCenter(),radius:1.15*c(n.getCenter(),n.getBounds().getNorthEast())});return t.getBounds()}function i(n){var t=d.fromLatLngToDivPixel(n);return l("LatLngBounds",d.fromDivPixelToLatLng(l("Point",t.x-P,t.y+P)),d.fromDivPixelToLatLng(l("Point",t.x+P,t.y-P)))}function u(){var u,a,c,s,f,p,d=n.getZoom(),y={},x=[],P={};p=""+d,d>3&&(a=e(),h(w,function(n,t){a.contains(n.getPosition())||(p+="-"+t,P[t]=!0,n.getMap()&&n.setMap(null))})),m&&h(w,function(n,t){P[t]||m(n)||(p+="-"+t,P[t]=!0,n.getMap()&&n.setMap(null))}),p!==g&&(g=p,h(w,function(e,p){P[p]||(u=[p],a=i(e.getPosition()),C&&h(r(w,p+1),function(n,t){t+=p+1,!P[t]&&a.contains(n.getPosition())&&(u.push(t),P[t]=!0)}),s=u.join("-"),y[s]=!0,T[s]||(f=u.map(function(n){return w[n]}),c=t.cb(r(f)),c?(a=l("LatLngBounds"),h(f,function(n){a.extend(n.getPosition()),n.getMap()&&n.setMap(null)}),c=o(c),c.position=a.getCenter(),T[s]=new B(L,r(f),b(n,c),a),x.push(T[s])):h(f,function(t){t.getMap()||t.setMap(n)})))}),h(v(T),function(n){y[n]||(T[n].overlay.setMap(null),delete T[n])}),x.length&&h(k,function(n){n(x)}))}function a(){clearTimeout(f),f=setTimeout(u,100)}function s(){E.event.addListener(n,"zoom_changed",a),E.event.addListener(n,"bounds_changed",a),u()}var f,p,g,d,m,L=this,w=[],P=(t.size||200)>>1,C=!0,T={},k=[];t=t||{},t.markers=t.markers||[],L._b=function(n){n(y(T)),k.push(n)},L.markers=function(){return r(w)},L.groups=function(){return y(T)},L.enable=function(){C||(C=!0,g="",a())},L.disable=function(){C&&(C=!1,g="",a())},L.add=function(n){w.push(n),g="",a()},L.remove=function(n){w=w.filter(function(t){return t!==n}),g="",a()},L.filter=function(n){m!==n&&(m=n,g="",a())},t.markers.map(function(n){n.position=x(n.position),w.push(l("Marker",n))}),p=setInterval(function(){d=M(n),d&&(clearInterval(p),s())},10)}function T(n,t){var e=this;v(t[0]).forEach(function(n){e[n]=function(){var o=[],i=r(arguments);return t.forEach(function(t){o.push(t[n].apply(t,i))}),"get"===n?o.length>1?o:o[0]:e}}),e.$=n}function k(t,e){function c(){return{$:t,get:M.get}}function s(t,e,o,i){var u=arguments.length>3;u||(i=o),n.each(t,function(n,t){h(e,function(e){var a=e instanceof B,s=a||e instanceof E.OverlayView,f=s?e.$.get(0):e;E.event["add"+(s?"Dom":"")+"Listener"+(i?"Once":"")](f,n,function(n){h(t,function(t){if(A(t))if(a)t.call(c(),void 0,e,e.cluster,n);else if(u){var i=r(o);i.unshift(e),i.push(n),t.apply(c(),i)}else t.call(c(),e,n)})})})})}function f(n){return function(t){if(R(t)){var e=[],o=t.map(function(t){return n.call(M,t).then(function(n){e.push(n)})});return u(o).then(function(){return y.push(e),e})}return n.apply(M,arguments).then(function(n){return y.push(n),n})}}function g(n){return function(){var t=r(arguments);return P=P.then(function(e){return A(t[0])?O(t[0].call(c(),e)).then(function(e){return t[0]=e,n.apply(M,t)}):O(n.apply(M,t))})}}var v,y=[],P=O(),M=this;M.map=g(function(n){return v||L(n,"center",function(n){return v=l("Map",t.get(0),n),y.push(v),v})}),d("Marker:position Circle:center InfoWindow:position:0 Polyline:path Polygon:paths",function(n){n=n.split(":");var t=n[1]||"";M[n[0].toLowerCase()]=g(f(function(e){return(t.match(/^path/)?w:L)(e,t,function(t){return"0"!==n[2]&&(t.map=v),l(n[0],t)})}))}),d("TrafficLayer TransitLayer BicyclingLayer",function(n){M[n.toLowerCase()]=g(function(){var t=l(n);return y.push(t),t.setMap(v),t})}),M.kmllayer=g(f(function(n){return n=o(n),n.map=v,O(l("KmlLayer",n))})),M.rectangle=g(f(function(n){return m(n,function(n){return n.map=v,l("Rectangle",n)})})),M.overlay=g(f(function(n){function t(n){return b(v,n)}return n=o(n),n.bounds?m(n,t):L(n,"position",t)})),M.groundoverlay=g(function(n,t,e){return m({bounds:t},function(t){e=o(e),e.map=v;var r=l("GroundOverlay",n,t.bounds,e);return y.push(r),r})}),M.styledmaptype=g(function(n,t,e){var o=l("StyledMapType",t,e);return y.push(o),v.mapTypes.set(n,o),o}),M.streetviewpanorama=g(function(t,e){return L(e,"position",function(e){var o=l("StreetViewPanorama",n(t).get(0),e);return v.setStreetView(o),y.push(o),o})}),M.route=g(function(n){var t=$();return n=o(n),n.origin=x(n.origin),n.destination=x(n.destination),p("DirectionsService").route(n,function(n,e){y.push(n),t.resolve(e===E.DirectionsStatus.OK?n:!1)}),t}),M.cluster=g(function(n){var t=new C(v,o(n));return y.push(t),a(t)}),M.directionsrenderer=g(function(t){var e;return t&&(t=o(t),t.map=v,t.panel&&(t.panel=n(t.panel).get(0)),e=l("DirectionsRenderer",t)),y.push(e),e}),M.latlng=g(f(function(n){return L(n,"latlng",function(n){return y.push(n.latlng),n.latlng})})),M.fit=g(function(){var n=l("LatLngBounds");return h(y,function(t){t!==v&&h(t,function(t){t&&(t.getPosition&&t.getPosition()?n.extend(t.getPosition()):t.getBounds&&t.getBounds()?(n.extend(t.getBounds().getNorthEast()),n.extend(t.getBounds().getSouthWest())):t.getPaths&&t.getPaths()?h(t.getPaths().getArray(),function(t){h(t.getArray(),function(t){n.extend(t)})}):t.getPath&&t.getPath()?h(t.getPath().getArray(),function(t){n.extend(t)}):t.getCenter&&t.getCenter()&&n.extend(t.getCenter()))})}),n.isEmpty()||v.fitBounds(n),!0}),M.wait=function(n){P=P.then(function(t){var e=$();return setTimeout(function(){e.resolve(t)},n),e})},M.then=function(n){A(n)&&(P=P.then(function(t){return O(n.call(c(),t)).then(function(n){return i(n)?t:n})}))},M["catch"]=function(n){A(n)&&(P=P.then(null,function(t){return O(n.call(c(),t))}))},d("on once",function(n,t){M[n]=function(){var n=arguments[0];n&&("string"==typeof n&&(n={},n[arguments[0]]=r(arguments,1)),P.then(function(e){if(e){if(e instanceof C)return e._b(function(e){e&&e.length&&s(n,e,t)}),s(n,e.markers(),[void 0,e],t);s(n,e,t)}}))}}),M.get=function(n){return i(n)?y.map(function(n){return R(n)?n.slice():n}):(0>n&&(n=y.length+n),R(y[n])?y[n].slice():y[n])},e&&M.map(e)}var E,j,D={},O=n.when,S=n.extend,R=n.isArray,A=n.isFunction,$=n.Deferred;O(function(){var o,r=$(),i="__gmap3";return n.holdReady(!0),s(function(){t.google&&t.google.maps||j===!1?r.resolve():(t[i]=function(){delete t[i],r.resolve()},o=e.createElement("script"),o.type="text/javascript",o.src="https://maps.googleapis.com/maps/api/js?callback="+i+(j?"&"+("string"==typeof j?j:f(j)):""),n("head").append(o))}),r}()).then(function(){n.holdReady(!1)}),n.gmap3=function(n){j=n},n.fn.gmap3=function(e){var o=[];return E=t.google.maps,this.each(function(){var t=n(this),r=t.data("gmap3");r||(r=new k(t,e),t.data("gmap3",r)),o.push(r)}),new T(this,o)}}(jQuery,window,document);

function mapConfig(mapId) {
    $.gmap3({
        key: 'AIzaSyCAyo44V823PEdTTSwswtXWTQIxmCa4--8'
    });
    var map = $("#"+ mapId);
    if (map.length > 0) {
        var address = "<div class='map-popup'>" +
            "<div class='map-popup__title'>" + map.data('title') + "</div>" +
            "<p>" + map.data('address') + "</p>" +
            "</div>"
			var markerUrl = map.data('marker');
        map.gmap3({
            address: map.data('address'),
            zoom: map.data('zoom'),
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }).marker(function (map) {
            return {
                position: map.getCenter(),
                icon: markerUrl,
				//animation: google.maps.Animation.BOUNCE
            };
        }).infowindow({
            content: address
        }).then(function (infowindow) {
            var map = this.get(0);
            var marker = this.get(1);
            marker.addListener('click', function () {
                infowindow.open(map, marker);
            });
			
			//Gray Map Style
            var styles = [{
                    stylers: [{
                            hue: "#eee"
                        },
                        {
                            saturation: -100
                        },
                        {
                            lightness: 0
                        },
                        {
                            gamma: 1.51
                        },
                    ]
                }, {
                    featureType: "road",
                    elementType: "geometry",
                    stylers: [{
                            lightness: 100
                        },
                        {
                            visibility: "simplified"
                        }
                    ]

                }, {
                    featureType: "road",
                    elementType: "labels",
                    stylers: [{
                            visibility: "simplified"
                        }

                    ]

                }

            ];

            //map.setOptions({styles: styles}); //Comment if no need Gray map style

            //Gray Map Style END
        });
    }
}

$(document).ready(function () {
	var allMaps = document.getElementsByClassName("map");
	var i;
	for (i = 0; i < allMaps.length; i++) {
		mapConfig(allMaps[i].id);
	} 
});

//<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4Mpk6qdA8uYuHFNCb3WHPQPF9FxW8XDU"></script> 
//<script type="text/javascript" src="js/map.js"></script>
//<div class="map" id="contact-map1" data-title="Title." data-address="Address" data-zoom="18" data-marker="images/map-pin.png"></div>