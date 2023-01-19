<?php
	include APPVIEWS.'/templates/head.tpl.php';
?>

<body>
	<?php	include APPVIEWS.'/templates/header.tpl.php'; ?>
	<?php	include APPVIEWS.'/templates/navbar-user.tpl.php'; ?>

  <div class="card">
    <h3><?=$username;?></h3>
    <h4>Estàs a punt de reservar el llibre: <?= $llibre->title;?></h4>
    <table class="rbooktable">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                </tr>
                <tr>
                    <th><img src="<?=$llibre->img;?>" alt=""></th>
                    <th><h3><?=$llibre->title;?></h3></th>
                </tr>

        </table>
    <div class= "rbook">
      <a href="/reserva/confirm/<?=$llibre->id;?>"">
        <button class="btn">Fer préstec</button>
      </a>
      <a href="/reserva/cancel">
        <button class="btn">Cancel·lar préstec</button>
      </a>
    </div>
  </div>
</body>
</html>