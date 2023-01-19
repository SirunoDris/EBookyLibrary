<?php
	include APPVIEWS.'/templates/head.tpl.php';
?>

<body>
	<?php	include APPVIEWS.'/templates/header-user.tpl.php'; ?>
	<?php	include APPVIEWS.'/templates/navbar.tpl.php'; ?>
	<main>
      <div class="libros">
            <table>
                <tr>
                    <th>ISBN</th>
                    <th>Title</th>
                    <th>Authors</th>
                    <th>Edition</th>
                    <th class="img">Image</th>
                    <th>Reserve</th>
                </tr>
              <?php foreach($cataleg as $llibre):?>
                <tr>
                    <th><h3><?=$llibre->isbn;?></h3></th>
                    <th><h3><?=$llibre->title;?></h3></th>
                    <th><h3><?=$books__authors_view[$llibre->id];?></h3></th>
                    <th><h3><?=$llibre->editionName;?></h3></th>
                    <th><img src="<?=$llibre->img;?>" alt=""></th> 
                    <th class="catalog-rent"> 
                       <a href="/catalog/reserva/<?=$llibre->id;?>">
                         <button class="btn">Fer préstec</button>
                       </a>
                    </th>
                </tr>
              <? endforeach; ?>
            </table>
        </div>
	</main>
</body>
</html>