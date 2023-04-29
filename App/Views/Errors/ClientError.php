<div class='error-container'>
	<?php

	if (isset($errors) && count($errors) > 0) {

		echo "
			<p>an error occured:</p>
             <p>Message: " . $errors["message"] . "</p>
			</div>";
	}
