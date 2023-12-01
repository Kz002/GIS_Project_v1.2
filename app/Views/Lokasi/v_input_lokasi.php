<div class="row">
    <div class="col-sm-8">
        <div id="map" style="width: 100%; height: 100vh;" class="leaflet-map-pane"></div>
    </div>
    <div class="col-sm-4">
        <div class="row">
            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success" role="alert">';
                echo session()->getFlashdata('pesan');
                echo '</div>';
            }
            ?>
        <?php $errors = validation_errors() ?>
        <?php echo form_open_multipart('Lokasi/insertData') ?>
            <div class="form-group">
                <label for="">Nama Lokasi</label>
                <input class="form-control" name="nama_lokasi">
                <p class="text-danger">
                    <?= isset($errors['nama_lokasi'])== isset($errors['nama_lokasi']) ?validation_show_error('nama_lokasi') : '' ?>
                </p>
            </div>
            <div class="form-group">
                <label for="">Alamat Lokasi</label>
                <input class="form-control" name="alamat_lokasi">
                <p class="text-danger">
                    <?= isset($errors['alamat_lokasi'])== isset($errors['alamat_lokasi']) ?validation_show_error('alamat_lokasi') : '' ?>
                </p>
            </div>
            <div class="form-group">
                <label for="">Latitude</label>
                <input class="form-control" name="latitude" id="Latitude">
                <p class="text-danger">
                    <?= isset($errors['latitude'])== isset($errors['latitude']) ?validation_show_error('latitude') : '' ?>
            </p>
            </div>
            <div class="form-group">
                <label for="">Longitude</label>
                <input class="form-control" name="longitude" id="Longitude">
                <p class="text-danger">
                    <?= isset($errors['longitude'])== isset($errors['longitude']) ?validation_show_error('longitude') : '' ?>
                </p>
            </div>
            <div class="form-group">
                <label for="">Foto Lokasi</label>
                <input type="file" class="form-control" name="foto_lokasi" accept="image/*">
                <p class="text-danger">
                    <?= isset($errors['foto_lokasi'])== isset($errors['foto_lokasi']) ?validation_show_error('foto_lokasi') : '' ?>
                </p>
            </div>
            
            <br>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="reset" class="btn btn-success">Reset</button>

            <?php echo form_close() ?>
        </div>
    </div>
</div>

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

//input data
var latInput=document.querySelector("[name=latitude]");
var lngInput=document.querySelector("[name=longitude]");
var posisi=document.querySelector("[name=posisi]");
var curLocation= [-0.48070455395120976, 100.6379071623626];
map.attributionControl.setPrefix(false);

var marker = new L.marker(curLocation, {
    draggable: true,
});

//mengambil coordinate saat marker dipindah
marker.on('dragend', function(e) {
    var position = marker.getLatLng();
    marker.setLatLng(position, {
        curLocation,
    }).bindPopup(position).update();
    $("#Latitude").val(position.lat);
    $("#Longitude").val(position.lng);
    $("#Posisi").val(position.lat + ', ' + position.lng);
});

//Mengambil coordinate saat map diklik
map.on('click', function(e) {
    var lat = e.latlng.lat;
    var lng = e.latlng.lng;
    if (!marker) {
        marker = L.marker(e.latlng).addTo(map);
    }else {
        marker.setLatLng(e.latlng);
    }
    latInput.value = lat;
    lngInput.value = lng;
    posisi.value = lat + ', ' +lng;
});

map.addLayer(marker);
</script>