<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title>Google Maps</title>

	<script src="/js/jquery/core.js" type="text/javascript"></script>
	<!-- Loading GoogleMaps API -->
	<script src="http://maps.google.com/maps?file=api&v=2&key=<?php echo $key_googlemaps; ?>" type="text/javascript"></script>

	<script type="text/javascript">

	var outputArray = new Array(); // Массив для выдачи на сервер

	function saveData()
	{
		$.post("/latlng2pix/save_poss_x_y",
			{ arr: outputArray },
			function(data) {
				if('ok'==data) {
					$("#map_canvas").remove();
					window.location = "http://www.google.com/"
				}
			},
			'text'
		);
	}

	function initialize()
	{
		// Loading table gyms from server
		$.post("/latlng2pix/loading_latlng_array",
			function(data) {
				k=0;
				for(one in data) // foreach elements from array id, Longitude, posLatitude
				{
					var posxy = googleFromLatLngToPixel(data[one]['posLongitude'], data[one]['posLatitude']);

					var arr_poss = posxy.split(',');

					outputArray[k] = {
						gymID: data[one]['gymID'],
						posX: arr_poss[0], // Position X px
						posY: arr_poss[1]  // Position Y px
					};
					k++;
				}

				saveData();
		}, "json");
	}

	function googleFromLatLngToPixel(longitude, latitude)
	{
		if (GBrowserIsCompatible()) {
			var map = new GMap2(document.getElementById("map_canvas"));
			map.setCenter(new GLatLng(0,0), 2);
		}

		//var oPoint = new GLatLng(55.752, 37.616); // Создаём объект точки. Москва
		var oPoint = new GLatLng(longitude, latitude); // Создаём объект точки. Москва

		var oMarker = new GMarker(oPoint);

		map.addOverlay(oMarker); // Наложение на карту маркера

		var currentProjection = G_NORMAL_MAP.getProjection();

		var tilePoint = currentProjection.fromLatLngToPixel(oPoint, map.getZoom());

		var X = Math.floor(tilePoint.x );
		var Y = Math.floor(tilePoint.y );

		return X + ',' + Y;
	}

	$(document).ready(function() {
		initialize();
	});

    </script>
</head>

<body onunload="GUnload()">
	<!-- map Google not visabled -->
	<div id="map_canvas" style="width: 1600px; height: 1000px; display: none"></div>
</body>

</html>