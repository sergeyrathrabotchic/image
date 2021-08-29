<?php

$time_start = microtime(true);
$pdo = new PDO( $dsn = "mysql:host=localhost;dbname=test;charset=utf8mb4",'root', 'root');
function can_upload($file){
  // если имя пустое, значит файл не выбран
    if($file['name'] == '')
    return 'Вы не выбрали файл.';
  
  /* если размер файла 0, значит его не пропустили настройки 
  сервера из-за того, что он слишком большой */
  if($file['size'] == 0)
    return 'Файл слишком большой.';
  
  // разбиваем имя файла по точке и получаем массив
  $getMime = explode('.', $file['name']);
  // нас интересует последний элемент массива - расширение
  $mime = strtolower(end($getMime));
  // объявим массив допустимых расширений
  $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
  
  // если расширение не входит в список допустимых - return
  if(!in_array($mime, $types))
    return 'Недопустимый тип файла.';
  
  return true;
  }


  function make_upload($file){	
 
  // формируем уникальное имя картинки: случайное число и name
  
  $name = mt_rand(0, 10000) . $file['name'];
    //var_dump($file['type']);

  
  }

  if(isset($_FILES['file'])) {
  
    // проверяем, можно ли загружать изображение
    $check = can_upload($_FILES['file']);
  
    if($check === true){
      // загружаем изображение на сервер
      make_upload($_FILES['file']);
      
      /*echo "<strong>Файл успешно загружен!</strong>";*/
    }
    else{
      // выводим сообщение об ошибке
      echo "<strong>$check</strong>";  
    }
  }
  

  $zagruzka= 0;
  if(isset($_POST['Загрузить'])){
  if( !empty( $_FILES['image']['name'] ) ) {

      // Проверяем, что при загрузке не произошло ошибок
      if ( $_FILES['image']['error'] == 0 ) {

    
    // Если файл загружен успешно, то проверяем - графический ли он
    if( substr($_FILES['image']['type'], 0, 5)=='image' ) {
    //Проверка загрузки файла 
    $image = addslashes(file_get_contents( $_FILES['image']['tmp_name'] ));
    $stmt = $pdo->prepare("INSERT INTO `img` ( `con`) VALUE(?)");
    $stmt->execute([$image]);
    $zagruzka =1 ;
        }
      }
    }
  }


$memcache = memcache_connect('localhost', 11211);

if ($memcache) {


$imgrows = $memcache->get("imgrows");
//echo $imgrows;
if( $imgrows ==[] || $zagruzka == 1){
$stmt = $pdo->prepare("SELECT * FROM `img`");
$stmt->execute();
$imgrows = $stmt->fetchAll();



$zagruzka = 0;
$memcache->set("imgrows", $imgrows);

echo "Кеш не загрузился";
} else {
      echo "Кеш загрузился";
      
  
  }

}
else {
  echo "Connection to memcached failed";
}
if(isset($_POST['Показать'])){
//Считаем сколько раз выводим картинку наэкран
$image = $_POST['image'];
echo "<br>";
$image = (int)str_replace('Картинка ', '', $image);
$stmt = $pdo->prepare("SELECT * FROM `quantity`");
$stmt->execute();
$namber = $stmt->fetchAll();
if(empty($namber)){
  $namber = 1;
  $stmt = $pdo->prepare("INSERT INTO `quantity` ( `quantity`) VALUE(?)");
  $stmt->execute([$namber]);
} else {
  $quantity = $namber[0][1] + 1;
  $stmt = $pdo->prepare("UPDATE `quantity` SET `quantity` = ? WHERE `id` = 1;");
  $stmt->execute([$quantity]);
}
}


$time_end = microtime(true);
$time = $time_end - $time_start;
echo "<pre>"; print_r($time); echo "</pre>";