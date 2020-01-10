<!DOCTYPE html>
<html>
    <head>
        <title>Simple map2</title>
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
        <div id="map" style="height:500px; width: 50%; margin: 2rem auto 0;"></div>
            <!-- jqueryの読み込み -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <!-- js -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAofu9qs3_u1qwWEi76xgTdjp_0dje5iIA&callback=initMap"></script>
        <script type="text/javascript">
            var map;
            function initMap() {
            map = new google.maps.Map(document.getElementById('map'), { // #sampleに地図を埋め込む
                center: { // 地図の中心を指定
                    lat: 34.7019399, // 緯度
                    lng: 135.51002519999997 // 経度
                },
                zoom: 19 // 地図のズームを指定
            });
            }
        </script>
    </body>
</html>