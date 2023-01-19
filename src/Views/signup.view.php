<?php
	include APPVIEWS.'/templates/head.tpl.php';
?>

<body>
	<?php	include APPVIEWS.'/templates/header.tpl.php'; ?>
	<?php	include APPVIEWS.'/templates/navbar.tpl.php'; ?>
	<form action="/signup/signup" method="post" id="auth-form">
		<h1>SIGN UP</h1>
		<div class="form-field">
			<label for="username">Username:</label>
			<input type="text" name="username" id="auth-username" placeholder="Enter your username here" required>
		</div>
		<div class="form-field">
			<label for="email">Email:</label>
			<input type="email" name="email" id="auth-email" placeholder="Enter your email here" required>
		</div>
		<div class="form-field">
			<label for="passwd">Password:</label>
			<input type="password" name="passwd" id="auth-passwd" placeholder="Enter your password here" required>
		</div>
		<div class="form-field">
			<label for="passwd-confirm">Confirm your password:</label>
			<input type="password" name="passwd-confirm" id="auth-passwd-confirm" placeholder="Confirm your password here" required>
		</div>
		<div class="form-field">
			<label for="user-role">Role:</label>
			<select name="user-role" id="auth-user-role" required>
				<option value="0">Usuari</option>
				<option value="2">Administrador</option>
			</select>
		</div>
		<button type="submit">SIGN UP</button>
	</form>
</body>
</html>