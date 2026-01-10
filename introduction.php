<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

</head>
<style>
  body{
    height: 100vh;
    background-color: yellow;
    font-size: 20px;
  }
  .for{
    width: 300px;
    height: 100px;
    background-color: royalblue;
  }
.for input{
  padding: 10px;
  border: 2px solid green;
  border-radius: 15px;
  
}
.for label
{
  align-items: center;
  font-size: 22px;
}
.for .btn{
justify-content: center;
align-items: center;
padding: 8px;
background-color: yellowgreen;
border-radius: 10px;
}
</style>
<body>
  <form action="" method="POST">
  <div class="for">
    <label for="">Entrer un nombre</label>
    <input type="text" name="val">
    <button class="btn" type="submit" name="btnAffiche">Afficher la table</button>
  </div>
  </form>
 <?php 


if(isset($_POST['btnAffiche'])){//isset verifie l'existance d'une variable
 $nombre = $_POST['val'];
  multiplicationTable($nombre);
}

 echo"===========================<br><br><br>";

 echo"Intraduction";
 echo"<br>";
 echo"<h1>Hello word</h1>";
 echo'<h1>Hello word <br><br><br></h1>';

echo"===========================<br>";

$a="5";
$b="10";
echo"a =$a <br>b=$b  <br>";
echo'a=$a et b=$b  <br>';
echo'a=' .$a. 'et b=' .$b. '<br>';

echo"===========================<br><br><br>";

if ($a > $b){
  echo" $a est superieur a $b";
}
elseif($a < $b){
  echo" $a est inferieur a $b";
}


function multiplicationTable($a){
  for($i=1;$i<10;$i++){
    echo "$a x $i = " . ($a * $i) . "<br>";
  }
  return true;
}
// Removed: echo using \$i outside of its scope (undefined variable)
 ?>



</body>
</html>