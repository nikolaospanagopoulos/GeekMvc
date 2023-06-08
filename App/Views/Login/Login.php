<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<div class="container">
	<?php

	if (isset($errors) && !empty($errors)) {
		echo '<ol class="list-group list-group-numbered mb-3">';
		foreach ($errors as $error) {
			echo ' <li  class="list-group-item"  >' . $error . '</li>';
		}
		echo '</ol>';
	}

	?>





	<h2 class="text-center mb-3">Sign up</h2>
	<form id="login-form" method="post" action="/login/create" autocomplete="off">
		<div class="mb-3">
			<label for="inputEmail1" class="form-label">Email address</label>
			<input autocomplete="off" type="email" class="form-control" name="email" id="inputEmail1" value="<?php echo (isset($email) ? $email : "") ?>" aria-describedby="emailHelp">
			<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
		</div>
		<div class="mb-3">
			<label for="inputPassword" class="form-label">Password</label>
			<input name="password" type="password" autocomplete="off" class="form-control" id="inputPassword">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

	<script>
		var constraints = {
			email: {
				email: true,
				presence: true
			},
			password: {
				presence: true,
				length: {
					minimum: 6,
					message: "must be at least 6 characters"
				}
			},
		};


		var form = document.querySelector('#login-form')
		form.addEventListener('submit', function(e) {

			e.preventDefault()

			form.querySelectorAll(".invalid-feedback").forEach(el => el.remove())
			form.querySelectorAll('input').forEach(el => {
				if (el.classList.contains('is-invalid')) {
					el.classList.remove('is-invalid')
				}
			})





			const formValues = validate.collectFormValues(form)
			const errors = validate({
				password: formValues.password,
				email: formValues.email,


			}, constraints)

			if (!errors) {
				form.submit()
				return
			} else {
				Object?.entries(errors).forEach(el => {
					console.log(el[0])
					var inputEl = document.getElementsByName(el[0])[0]
					inputEl.classList.add("is-invalid")
					inputEl.insertAdjacentHTML('afterend',
						`
						  <div  class="invalid-feedback">${el[1]}</div>
						`

					)

				})
			}




		})
	</script>

</div>
