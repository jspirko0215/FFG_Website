<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title>Google Maps</title>

	<script src="/js/jquery/core.js" type="text/javascript"></script>

	<script type="text/javascript">

	$(document).ready(function() {

	});

	</script>
</head>

<body>
	<div id="map">

		<div style="position: absolute; left: 0; top: 0;">

			<img src="/images/worldmap_dx.png" style="left:0px; top:0px;" />

			<?php foreach ($points as $item): ?>

				<!-- Одна точечка в заданой позиции-->
				<div style="position: absolute; z-index:100; height:4px; width: 4px; background: red; left: <?php echo abs($item['posX']); ?>px;  top: <?php echo abs($item['posY']); ?>px;"></div>

			<?php endforeach; ?>
		</div>
	</div>
</body>

</html>