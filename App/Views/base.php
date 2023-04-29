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

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

	<?php include($template);

	echo $_SERVER["DOCUMENT_ROOT"];
	?>

	<footer>
	</footer>
</body>

</html>
