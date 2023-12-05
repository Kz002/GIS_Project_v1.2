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
	center: [-0.5072974659783391, 108.16995830603405],
	zoom: 5,
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

// == geoJSON ==
// list 
// Sumatera Barat -> Sawahlunto, Padang Panjang, Padang, Solok, Tanah Datar
// Riau -> Pekanbaru, Tembilahan
// Kepulauan Riau -> Batam
// Sumatera Selatan -> Palembang
// jakarta
// Kalimantan
// Manado
// Bogor
// Bandung

// Sumatera Barat
$.getJSON("<?= base_url('provinsi/13.geojson') ?>", function(data){
    L.geoJson(data, {
        style : function(feature) {
            return{
                color: 'red',
                fillOpacity: 0.5,
            }
        }
    })
    .bindPopup("<center><img src='<?= base_url('images/sumatera-barat-icon.jpg')  ?>' width='250px'><br></center>" +
        "<center><h4><b>Sumatera Barat</b></h4></center>")
    .addTo(map);
});
// Riau
$.getJSON("<?= base_url('provinsi/14.geojson') ?>", function(data){
    L.geoJson(data, {
        style : function(feature) {
            return{
                color: 'yellow',
                fillOpacity: 0.5,
            }
        }
    })
    .bindPopup("<center><img src='<?= base_url('images/riau-icon.png')  ?>' width='250px'><br></center>" +
        "<center><h4><b>Riau</b></h4></center>")
    .addTo(map);
});
// Sumatera Selatan
$.getJSON("<?= base_url('provinsi/16.geojson') ?>", function(data){
    L.geoJson(data, {
        style : function(feature) {
            return{
                color: 'green',
                fillOpacity: 0.5,
            }
        }
    })
    .bindPopup("<center><img src='<?= base_url('images/sumatera-selatan-icon.jpg')  ?>' width='250px'><br></center>" +
        "<center><h4><b>Sumatera Selatan</b></h4></center>")
    .addTo(map);
});
// Kepulauan Riau
$.getJSON("<?= base_url('provinsi/21.geojson') ?>", function(data){
    L.geoJson(data, {
        style : function(feature) {
            return{
                color: 'blue',
                fillOpacity: 0.5,
            }
        }
    })
    .bindPopup("<center><img src='<?= base_url('images/kep-riau-icon.jpg')  ?>' width='250px'><br></center>" +
        "<center><h4><b>Kepulauan Riau</b></h4></center>")
    .addTo(map);
});

// Circle untuk menandakan Kota, Prov Sumbar
// L.circle([-0.5974628561058486, 100.73632188357192], {
//     radius: 1000,
//     color: 'green',
//     fillColor: 'green',
//     fillOpacity: 0.2,
// })
// .bindPopup("Area Wibu")
// .addTo(map);
</script>