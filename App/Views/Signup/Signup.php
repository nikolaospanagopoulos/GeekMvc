<div class="container">
	<h2 class="text-center mb-3">Sign up</h2>
	<form method="post" action="/signup/create">
		<div class="mb-3">
			<label for="inputName" class="form-label">Name</label>
			<input name="name" type="text" class="form-control" id="inputName">
		</div>
		<div class="mb-3">
			<label for="inputUsername" class="form-label">Username</label>
			<input name="username" type="text" class="form-control" id="inputUsername">
		</div>
		<div class="mb-3">
			<label for="inputEmail1" class="form-label">Email address</label>
			<input type="email" class="form-control" name="email" id="inputEmail1" aria-describedby="emailHelp">
			<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
		</div>
		<div class="mb-3">
			<label for="inputPassword" class="form-label">Password</label>
			<input name="password" type="password" class="form-control" id="inputPassword">
		</div>
		<div class="mb-3">
			<label for="inputPasswordConfirmation" class="form-label">Password Confirmation</label>
			<input type="password" class="form-control" id="inputPasswordConfirmation">
		</div>
		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>
