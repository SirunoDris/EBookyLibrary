<?php
	include APPVIEWS.'/templates/head.tpl.php';
?>

<body>
	<?php	include APPVIEWS.'/templates/header.tpl.php'; ?>
	<?php	include APPVIEWS.'/templates/navbar.tpl.php'; ?>
	<main class="homemain">
		<div class="homecontainer">
			<h1 class="hometitle">WELCOME TO EBOOKY</h1>
			<p>Your personal library to borrow any book <br> Feel free to take any books that you want</p>
			<div class="homebuttons">
				<button class="bt1"><a class="text1" href="/signup">REGISTER</a></button>
				<button class="bt1"><a class="text1" href="/auth">MY ACCOUNT</a></button>
			</div>
			
		</div>
		
	</main>
</body>
</html>