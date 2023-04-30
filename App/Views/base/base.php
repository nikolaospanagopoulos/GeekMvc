<!DOCTYPE html>
<html lang='en'>

<head>
	<meta charset="utf-8" ; />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title> <?php

			if (isset($title)) {
				echo $title;
			} else {
				echo "Document";
			}
			?> </title>

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
	<?php if (isset($cssFiles) && count($cssFiles) > 0) {
		foreach ($cssFiles as $css)
			echo "<link rel='stylesheet' href='" . $mainUrl . $css . "'>";
	}
	?>


	<?php if (isset($scripts) && count($scripts) > 0) {
		foreach ($scripts as $script)
			echo "<script src=" . $mainUrl . $script . "  defer ></script>";
	}
	?>
</head>

<body>
	<?php include_once("header.php");     ?>

	<?php include(dirname(__DIR__) . '/' . $template);

	?>

	<footer>
	</footer>
</body>

</html>
