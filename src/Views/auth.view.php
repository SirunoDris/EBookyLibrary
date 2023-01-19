<?php
	include APPVIEWS.'/templates/head.tpl.php';
?>

<body>
	<?php	include APPVIEWS.'/templates/header.tpl.php'; ?>
	<?php	include APPVIEWS.'/templates/navbar.tpl.php'; ?>
	
	<form action="/auth/signin" method="post" id="auth-form">
	<h1>SIGN IN</h1>
		<div class="form-field">
			<label for="email">Email:</label>
			<input type="email" name="email" id="auth-email" placeholder="Enter your email here" required>
		</div>
		<div class="form-field">
			<label for="passwd">Password:</label>
			<input type="password" name="passwd" id="auth-passwd" placeholder="Enter your password here" required>
		</div>
		<button type="submit">LOG IN</button>
		<p>Don't have an account yet? <a href="/signup">Sign up here.</a></p>
	</form>
</body>
</html>