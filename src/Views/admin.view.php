<?php
	include APPVIEWS.'/templates/head.tpl.php';
?>

<body>
	<?php	include APPVIEWS.'/templates/header-user.tpl.php'; ?>
	<?php	include APPVIEWS.'/templates/navbar-user.tpl.php'; ?>
	<section id="containeradmin">
    <p id="admin-query-results"><?=$lastQuery_results ?? ""?></p>
    <div class="tabs">
        <button class="tabbutton" onclick="openTab('Users')">USERS</button>
        <button class="tabbutton" onclick="openTab('Books')">BOOKS</button>
        <button class="tabbutton" onclick="openTab('Bookrent')">RENT BOOKS</button>
    </div>
    <div class="tables">
      <div id="Users" class="container tab">
        <table class= "tableadmin">
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Balance</th>
          </tr>
          <?php foreach($users as $user):?>
            <tr>
              <th><h3><?=$user->id;?></h3></th>
              <th><h3><?=$user->username;?></h3></th>
              <th><h3><?=$user->email;?></h3></th>
              <th><h3>
                <?=["User","Manager", "Admin"][$user->userRole];?>
              </h3></th> 
              <th><h3><?=$user->balance;?></h3></th>
            </tr>
          <? endforeach; ?>
        </table>
          <!-- <h3>User configuration</h3> -->
        <form id="config-form" action="/admin/delUser" method="post" id="">
          <div class="form-field">
            <label for="iduser">ID user:</label>
            <input type="text" name="iduser" placeholder="Input user ID here">
          </div>
          <button class="deletebt" type="submit">DELETE</button>
        </form>
      </div>  
      <div id="Books" class="container tab" style="display:none">
        <table class= "tableadmin">
          <tr>
            <th>ID</th>
            <th>ISBN</th>
            <th>Title</th>
            <th>Edition</th>
            <th>Edition Date</th>
            <th>Image</th>
          </tr>
          <?php foreach($cataleg as $llibre):?>
            <tr>
              <th><h3><?=$llibre->id;?></h3></th>
              <th><h3><?=$llibre->isbn;?></h3></th>
              <th><h3><?=$llibre->title;?></h3></th>
              <th><h3><?=$llibre->editionName;?></h3></th>
              <th><h3><?=$llibre->editionDate;?></h3></th>
              <th><img src="<?=$llibre->img;?>" alt=""></th> 
            </tr>
          <? endforeach; ?>
        </table>
        <form id="config-form" action="/admin/delBook" method="post" id="">
          <div class="form-field">
            <label for="">Book ID:</label>
            <input type="text" name="idbook" placeholder="Write book ID">
          </div>
          <button class="deletebt" type="submit">DELETE</button>
        </form>
        <form id="config-form" action="">
          <div class="form-field">
            <label for="">ISBN</label>
            <input type="text" name="" placeholder="Write book ISBN">
          </div>
          <div class="form-field">
            <label for="">Title</label>
            <input type="text" name="" placeholder="Write book title">
          </div>
          <div class="form-field">
            <label for="">Edition</label>
            <input type="text" name=""  placeholder="Write book edition">
          </div>
          <button class="deletebt" type="submit">ADD/MODIFY</button>
        </form>
      </div>              
      <div id="Bookrent" class="container tab" style="display:none">
        <table class= "tableadmin">
          <tr>
            <th>ID User</th>
            <th>ID Book</th>
            <th>User</th>
            <th>Title</th>
            <th>Data inici</th>
            <th>Data previst retornada</th>
            <th>Data retorn</th>
            <th>Data retorn extés</th>
            <th>Preu</th>
            <th>Estat ID</th>
            <th>Image</th>
          </tr>
          <?php foreach($rent as $prestamo):?>
            <tr>
              <th><h3><?=$prestamo->userId;?></h3></th>
              <th><h3><?=$prestamo->bookId;?></h3></th>
              <th><h3><?=$prestamo->username;?></h3></th>
              <th><h3><?=$prestamo->title;?></h3></th>
              <th><h3><?=$prestamo->initDate;?></h3></th>
              <th><h3><?=$prestamo->returnDateScheduled;?></h3></th>
              <th><h3><?=$prestamo->returnDateActual ?? "-";?></h3></th>
              <th><h3><?=$prestamo->returnDateExtended ?? "-";?></h3></th>
              <th><h3><?=$prestamo->price;?></h3></th>
              <th><h3><?=$prestamo->codeName;?></h3></th>
              <th><img src="<?=$prestamo->img;?>" alt=""></th> 
            </tr>
          <? endforeach; ?>
        </table>
        <form id="config-form" action="/admin/delRent" method="post" id="">
          <div class="form-field">
            <label for="">User ID:</label>
            <input type="text" name="delRent_userId" placeholder="Input User ID here">
            <label for="">Book ID:</label>
            <input type="text" name="delRent_bookId" placeholder="Input Book ID here">
          </div>
          <button class="deletebt" type="submit">DELETE</button>
        </form>
        <form id="config-form" action="">
          <div class="form-field">
            <label for="">Return date extended</label>
            <input type="text" name="" placeholder="Write return date">
          </div>
          <div class="form-field">
            <label for="">Return date</label>
            <input type="text" name="" placeholder="Write REAL return date">
          </div>
          <div class="form-field">
            <label for="">Price</label>
            <input type="number" name="">
          </div>
          <button class="deletebt" type="submit">ADD/MODIFY</button>
        </form>
      </div>  
    </div>
  </section>
  <script>
    function openTab(name) {
      var i;
      var x = document.getElementsByClassName("tab");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
      }
      document.getElementById(name).style.display = "block";  
    }
  </script>
</body>
</html>