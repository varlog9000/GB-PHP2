<?php include_once "../controllers/Admin.php"; ?>
<? include "../templates/menu.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset='UTF-8'>
<title>Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>



</head>
<body>
<div class="operationWrap">
        <button class="btn btn-primary" onclick="addNewGood()">Добавить товар</button>
			
		<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#scanDirLoadFiles">
 Добавить много товаров
</button>
        <!-- Modal -->
<div class="modal fade" id="scanDirLoadFiles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Вы уверены?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
        <button type="button" class="btn btn-primary" onclick="scanDirLoadFiles()"  >Загрузить файлы</button>
      </div>
    </div>
  </div>
</div>
 </div>  


 
 
 
<div class='mainTable'>
<script>
$(document).ready(function() {
renderAdminAjax ();
});
</script>
</div>
<script src='../js/my.js'></script>

</body>
</html>



