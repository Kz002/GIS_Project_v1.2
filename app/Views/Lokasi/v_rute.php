<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="">Jarak (*Meter)</label>
            <input class="form-control" name="jarak" id="Jarak">
        </div>
    </div>
</div>
<br>
<div id="map" style="width: 100%; height: 100vh;" class="leaflet-map-pane"></div>

<style>
  .leaflet-popup-content button {
    display: block;
    width: 100%;
    margin-bottom: 5px;
    padding: 8px;
    text-align: center;
    cursor: pointer;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
  }
</style>
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
    'Topo Map' : openTopoMap
};

const overlays = {
	'Cities': cities
};

const layerControl = L.control.layers(baseLayers,null,{collapsed:true})
.addTo(map);

//pemetaan lokasi dipanggil dari database
<?php foreach ($lokasi as $key => $value) { ?>
    L.marker([<?= $value['latitude'] ?>, <?= $value['longitude'] ?>])
    .bindPopup('<img src="<?= base_url('foto/'. $value['foto_lokasi']) ?>" width="250px">' + 
        '<h4><?= $value['nama_lokasi'] ?></h4>' +
        'Alamat : <?= $value['alamat_lokasi'] ?><br>' +
        '<button class="btn btn-info" onclick="return keSini([<?= $value['latitude'] ?>, <?= $value['longitude'] ?>])">Tujuan</button>' +
        '<button class="btn btn-info" onclick="return mulai([<?= $value['latitude'] ?>, <?= $value['longitude'] ?>])">Mulai</button>')
    .addTo(map);
<?php } ?>

//rute
var routingControl = L.Routing.control({
  waypoints: [
    L.latLng(-0.4809067745284627, 100.6379615346594),  //asal
    // L.latLng(-0.9468796322548746, 100.41744287223345) //tujuan
  ],
    geocoder: L.Control.Geocoder.nominatim(),
    routeWhileDragging: true,
    reverseWaypoints: true,
    showAlternatives: true,
    altLineOptions: {
        styles: [
            {color: 'black', opacity: 0.15, weight: 9},
            {color: 'white', opacity: 0.8, weight: 6},
            {color: 'blue', opacity: 0.5, weight: 2}
        ]
    }
})
routingControl.addTo(map);

function keSini(latLng){
    var latLng=L.latLng(latLng);
    routingControl.spliceWaypoints(routingControl.getWaypoints().length - 1, 1, latLng);
} 
function mulai(latLng){
    var latLng=L.latLng(latLng);
    routingControl.spliceWaypoints(0, 1, latLng);
} 

//mengambil jarak
routingControl.on('routesfound', function(e) {
    var routes = e.routes;
    var summary = routes[0].summary;
    var totalDistance = summary.totalDistance;
    //kirim nilai jarak ke input
    document.getElementById('Jarak').value = totalDistance;
    // animasiCar(routes[0]);
});

// membuat animasi perjalanan
// function animasiCar(route) {
//     var iconCar = L.icon({
//     iconUrl: '?= base_url('images/car.png') ?>',
//     iconSize: [30, 40], // size of the icon
//     });

// var car = L.marker([route.coordinates[0].lat, route.coordinates[0].lng], {
//     icon: iconCar
// }).addTo(map);

// var index=0;
// var maxIndex = route.coordinates.length - 1;

// function animate() {
//     car.setLatLng([route.coordinates[index].lat, route.coordinates[index].lng]);
//     index++;
//     if (index > maxIndex) {
//         index = 0;
//     }  
//     setTimeout(animate, 200);
// }
// animate();
// }

</script>