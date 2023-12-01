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
                fillOpacity: 0,
            }
        }
    })
    .bindPopup("<img src='<?= base_url('images/mahkota.png')  ?>' width='250px'><br>" +
        "<b>Provinsi Aceh</b><br>" +
        "Penduduk : 1.000.000.000<br>" +
        "Luas     : 58.377 Km2")
    .addTo(map);
});
// Riau
$.getJSON("<?= base_url('provinsi/14.geojson') ?>", function(data){
    L.geoJson(data, {
        style : function(feature) {
            return{
                color: 'yellow',
                fillOpacity: 0,
            }
        }
    }).addTo(map);
});
// Sumatera Selatan
$.getJSON("<?= base_url('provinsi/16.geojson') ?>", function(data){
    L.geoJson(data, {
        style : function(feature) {
            return{
                color: 'green',
                fillOpacity: 0,
            }
        }
    }).addTo(map);
});
// Kepulauan Riau
$.getJSON("<?= base_url('provinsi/21.geojson') ?>", function(data){
    L.geoJson(data, {
        style : function(feature) {
            return{
                color: 'blue',
                fillOpacity: 0,
            }
        }
    }).addTo(map);
});
// Jakarta
$.getJSON("<?= base_url('provinsi/31.geojson') ?>", function(data){
    L.geoJson(data, {
        style : function(feature) {
            return{
                color: 'orange',
                fillOpacity: 0,
            }
        }
    }).addTo(map);
});
// Jawa Barat
$.getJSON("<?= base_url('provinsi/32.geojson') ?>", function(data){
    L.geoJson(data, {
        style : function(feature) {
            return{
                color: 'chocolate',
                fillOpacity: 0,
            }
        }
    }).addTo(map);
});

// Circle untuk menandakan Kota
L.circle([-0.223019540616604, 100.63301640633208], {
    radius: 100,
    color: 'green',
    fillColor: 'green',
    fillOpacity: 0.2,
})
.bindPopup("Area Wibu")
.addTo(map);
</script>