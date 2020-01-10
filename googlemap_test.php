<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
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
    <div id="map" style="height: 500px; width: 80%; margin: 2rem auto 0;"></div>


    <!-- jqueryの読み込む -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- google map api -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAofu9qs3_u1qwWEi76xgTdjp_0dje5iIA"
    ></script>
    <!-- js -->
    <script type="text/javascript">
      var map = new google.maps.Map(document.getElementById('map'), {
        center: {
          lat: 34.679534, //緯度を設定
          lng: 135.469919 //経度を設定
        },
        zoom: 8 //地図のズームを設定
      });
    </script>
  </body>
</html>