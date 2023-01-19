<?php
	include APPVIEWS.'/templates/head.tpl.php';
?>

<body>
	<?php	include APPVIEWS.'/templates/header.tpl.php'; ?>
	<?php	include APPVIEWS.'/templates/navbar-user.tpl.php'; ?>
	<main>
		<h2></h2>
		
	</main>
<div class="card">
  <h3><?=$user->nom;?></h3>
  <h4>llibre reservat</h4>
  <h6><?=$llibre->titol;?></h6>
  <div>
  <a href="dashboard"><button class="btn">Volver al dashboard</button></a>
  </div>
</div>
  </div>
</body>
</html>