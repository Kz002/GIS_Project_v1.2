<div id="map" style="width: 100%; height: 100vh;" class="leaflet-map-pane"></div>

<!-- default leaflet -->
<script>
const cities = L.layerGroup();
// const mLittleton = L.marker([39.61, -105.02]).bindPopup('This is Littleton, CO.').addTo(cities);
// const mDenver = L.marker([39.74, -104.99]).bindPopup('This is Denver, CO.').addTo(cities);
// const mAurora = L.marker([39.73, -104.8]).bindPopup('This is Aurora, CO.').addTo(cities);
// const mGolden = L.marker([39.77, -105.23]).bindPopup('This is Golden, CO.').addTo(cities);
const osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 19,
	attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
});

const osmHOT = L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
	maxZoom: 19,
	attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Tiles style by <a href="https://www.hotosm.org/" target="_blank">Humanitarian OpenStreetMap Team</a> hosted by <a href="https://openstreetmap.fr/" target="_blank">OpenStreetMap France</a>'
});

const map = L.map('map', {
	center: [-0.48070455395120976, 100.6379071623626],
	zoom: 10,
	layers: [osm, cities]
});

const openTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
	maxZoom: 19,
	attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="http://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
});

const baseLayers = {
	'OpenStreetMap': osm,
	'OpenStreetMap.HOT': osmHOT,
    'Topologi Map' : openTopoMap
};

const overlays = {
	'Cities': cities
};

const layerControl = L.control.layers(baseLayers,null,{collapsed:true})
.addTo(map);

//== Marker ==
L.marker([-0.48090207068895996, 100.63787782846228])
    .bindPopup("<center><img src='<?= base_url('images/mahkota.png')  ?>'width='200px'></center><br>" +
        "<h4><center>MAHKOTA KERUPUK</center></h4>" +
        "<b>Alamat: </b>Saruaso, Kec. Tj. Emas, Kab. Tanah Datar, Sumatera Barat<br>") 
    .addTo(map);

//== polygon ==
L.polygon([
    [-0.48089137419797784, 100.6376259817223],
    [-0.4809991617108263, 100.63767247993664],
    [-0.4809315303304076, 100.63791553878436],
    [-0.48080472149033815, 100.63788594901158]
], {
    color: 'green',
    fillColor: 'green',
    fillOpacity: 1,
}).addTo(map)
</script></center>