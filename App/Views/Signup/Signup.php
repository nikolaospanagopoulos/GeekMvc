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
	<form id="signup-form" method="post" action="/signup/create">
		<div class="mb-3">
			<label for="inputName" class="form-label">Name</label>
			<input name="name" type="text" class="form-control" value="<?php echo (isset($user->name) ? $user->name : "") ?>" id="inputName">
		</div>
		<div class="mb-3">
			<label for="inputUsername" class="form-label">Username</label>
			<input name="username" type="text" value="<?php echo (isset($user->username) ? $user->username : "") ?>" class="form-control" id="inputUsername">
		</div>
		<div class="mb-3">
			<label for="inputEmail1" class="form-label">Email address</label>
			<input type="text" class="form-control" name="email" id="inputEmail1" value="<?php echo (isset($user->email) ? $user->email : "") ?>" aria-describedby="emailHelp">
			<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
		</div>
		<div class="mb-3">
			<label for="inputPassword" class="form-label">Password</label>
			<input name="password" type="password" class="form-control" id="inputPassword">
		</div>
		<div class="mb-3">
			<label for="inputPasswordConfirmation" class="form-label">Password Confirmation</label>
			<input name="passwordConfirmation" type="password" class="form-control" id="inputPasswordConfirmation">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>

	<script>
		var constraints = {
			name: {
				presence: true
			},
			username: {
				presence: true,
			},
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
			passwordConfirmation: {
				equality: "password"
			}
		};

		var form = document.querySelector('#signup-form')
		form.addEventListener('submit', function(e) {

			e.preventDefault()
			form.querySelectorAll(".invalid-feedback").forEach(el => el.remove())
			form.querySelectorAll('input').forEach(el => {
				if (el.classList.contains('is-invalid')) {
					el.classList.remove('is-invalid')
				}
			})
			const formValues = validate.collectFormValues(form)
			console.log(formValues)
			const errors = validate({
				name: formValues.name,
				username: formValues.username,
				password: formValues.password,
				email: formValues.email,
				passwordConfirmation: formValues.passwordConfirmation


			}, constraints)

			if (Object.keys(errors).length == 0) {
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
