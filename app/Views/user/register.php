<div>

	<h1>Create New
		<small>Account</small>
	</h1>

	<form method="post" action="/user/register-submite">

		<div class="form-group"> 
			<label for="name">Name</label>
			<input type="text" name="name" class="form-control" id="name">
		</div>

		<div class="form-group"> 
			<label for="last_name">Last Name</label>
			<input type="text" name="last_name" class="form-control" id="last_name">
		</div>

		<div class="form-group"> 
			<label for="email">Email</label>
			<input type="text" name="email" class="form-control" id="email">
			<p><?= getErrors("email")?></p>
		</div>

		<div class="form-group"> 
			<label for="password">Password</label>
			<input type="password" name="password" class="form-control" id="password">
		</div>

		<div class="form-group"> 
			<label for="comf_password">Comfirm Password</label>
			<input type="password" name="comf_password" class="form-control" id="comf_password">
		</div>

		<button type="submit" class="btn btn-danger mb-4">Register</button> 
		
	</form>
</div>