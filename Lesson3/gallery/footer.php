<div class="footer">
<hr>
<?php
if ($_SERVER['PHP_SELF'] == '/admin.php') {
    echo '<a class="switch icon icon-picture" href="index.php"> Перейти во фронтэнд</a>';
} else {
    echo '<a class="switch icon icon-edit" href="admin.php"> Войти в админку</a>';
}
mysqli_close($dbLink);
?>
</div>
