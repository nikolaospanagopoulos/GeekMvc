<div class='error-container'>
	<?php

	if (isset($errors) && count($errors) > 0) {

		echo "
			<p>an exception occured:</p>
             <p>Message: " . $errors["message"] . "</p>
             <p>Stack trace: <pre>" . $errors["stackTrace"] . "</pre></p>
			<p>Thrown in " . $errors["file"] . "</p>
             <p>on line: " . $errors["line"] . "</p>
			</div>";
	}
