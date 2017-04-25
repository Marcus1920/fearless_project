<!DOCTYPE html>
<html>
<head>
    <title>Case Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>

        #map {
            height: 100%;
        }

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<div id="map"></div>
<script>
    var map;

    function initMap() {

        mapSA = new google.maps.LatLng({{$case->gps_lat}},{{$case->gps_lng}});
        var options = {
            zoom: 20,
            center: mapSA,
            mapTypeControl: true,
            panControl: true,
            zoomControl: true,
            scaleControl: true,
            streetViewControl:true,
            overviewMapControl: true,
            navigationControlOptions: { style: google.maps.NavigationControlStyle.SMALL },
            mapTypeId: google.maps.MapTypeId.HYBRID

        };

        map = new google.maps.Map(document.getElementById('map'), options);

                @if($case->gps_lat)

        var latLng        = new google.maps.LatLng({{$case->gps_lat}},{{$case->gps_lng}})
        var contentString = "<div><p>{{$case->description}}</p></div>";

        var myinfowindow = new google.maps.InfoWindow({
            content: contentString
        });



        var image = "{{ asset('/markers/') }}/{{ $markerName }}";

        var marker = new google.maps.Marker({
            position: latLng,
            map: map,
            clickable: true,
            draggable:false,
            icon:image,
            infowindow: myinfowindow
        });


        google.maps.event.addListener(marker, 'click', function() {
            this.infowindow.open(map, this);
        });


        @endif


    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBwXS96_uM6y-6ZJZhSJGE87pO-qxpDp-Q&callback=initMap"
        async defer></script>
</body>
</html>