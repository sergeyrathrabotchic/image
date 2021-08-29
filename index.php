<?php
require_once("image.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="all" />
</head>
<body>
<form enctype="multipart/form-data" method="post" action="">
Изображение: <input type="file" name="image" />
<input type="submit" value="Загрузить" name="Загрузить"/>
</form>


<form method="post" action="">
<select name='image'>
<?php for($i = 0;$i<count($imgrows);$i++): ?>
  <option>Картинка <?php echo $i+1; ?></option>           
<?php endfor; ?>
<input type="submit" value="Показать" name="Показать"/>
</select>
</form>


<!--<form method="post" enctype="multipart/form-data">
<div id="box">
        <input type="text" name="Названиеуслуги" class="textadmin" placeholder="Название акции" />
        <input type="file" name="file">
        <input type="submit" name="Отправить" value="Отправить" id="buttonadmin">
        
    </div>
    </form>-->

<br><br>
<img src="data:image/jpeg;base64,<?php
echo base64_encode($imgrows[$image][1]);?>" alt="" />

</body>
</html>