<?php
	include APPVIEWS.'/templates/head.tpl.php';
?>

<body>
	<?php	include APPVIEWS.'/templates/header-user.tpl.php'; ?>
	<?php	include APPVIEWS.'/templates/navbar-user.tpl.php'; ?>
	<main id="maindashboard">
		<h2 class="maintitle">WELCOME TO YOUR DASHBOARD</h2>
  </main>
  <!--
    <p style="color:white"><?= var_dump($rents); ?></p>
  -->
  <div>
    <section id="userdashboard-rents-section">
      <?= (count($rents)>0)?(""):("<h2>You haven't booked any books yet!</h2>") ?>
      <?php foreach($rents as $llibre):?>
      <div class="book">
        <div class="rent-book-cover">
          <img src="<?=$llibre->img;?>" alt="">
        </div>
        <h3><?=$llibre->title;?></h3>
        <p>Rent date: <b><?=$llibre->initDate;?></b></p>
        <p>Must be returned on: <b><?=$llibre->returnDateScheduled;?></b></p>
        <p><?=$llibre->returnDateActual ?? "-";?></p>
        <p><?=$llibre->returnDateExtended ?? "-";?></p>
        <p><?=$llibre->price;?></p>
        <p><?=$llibre->statusId;?></p>
      </div>
      <? endforeach; ?>
    </section>
  </div>
  
</body>
</html>