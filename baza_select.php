<html lang="pl-PL">
<head>
<meta charset="utf-8">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@100&display=swap" rel="stylesheet">
</head>
<body>
<style>
.h1{
color: white;
text-align: center;
display: flex;
flex-direction: column;
justify-content: center;
text-align: center;
font-family: 'Sora', sans-serif;
margin-top: 5em;
font-size: 30;}

body{
background-color: #454854;
}


.div{
color: white;
text-align: center;
display: flex;
flex-direction: column;
justify-content: center;
text-align: center;
font-family: 'Sora', sans-serif;
margin-top: 5em;
font-size: 30;}
}
</style>
<div class='div'>
<form action="" method="post">
<h1 class='h1'>Wybierz rodzaj przeglądania wierszy w tabeli</h1>
<input type="radio" name="wyswietl" 
<?php if (isset($wyswietl) && $wyswietl=="Ogólny") echo "checked";?>
 value="Ogólny">Ogólny

<input type="radio" name="wyswietl"
<?php if (isset($wyswietl) && $wyswietl=="Szczegółowy") echo "checked";?>
value="Szczegółowy">Szczegółowy
<br>
<input type="submit" name="akcja" value="OK" />
<input type="submit" name="akcja" value="Porzuć" />
</form>
</div>
   


<!-- // przeglądanie tablicy SELECT - projekcja  -->
<?php
$wybrany=$_POST['wyswietl'];
// echo "$wybrany";

$akcja=$_POST['akcja'];
if($akcja=="OK")
{

  try {
    $rodzaj_przegladu=$_POST['przeglad'];
     include "baza_link.php";

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Poprawne połączenie z bazą.<br>';



    $sql = 'SELECT post_author,post_date,post_content, post_title FROM wp_posts';
    $p_lp=0;
    print "Przeglądanie zawartości tablicy <br>";
    foreach ($conn->query($sql) as $row) {
        $pole1=$row['post_author'];
        $pole2=$row['post_date'];
        $pole3=$row['post_content'];
        $pole4=$row['post_title'];
        $p_lp++;
  //      print $row['post_author' 'post_date'] . "<br>";
        echo "Rekord w tablicy numer $p_lp :   Autor posta: $pole1   Data posta: $pole2   Tytuł posta: $pole4  <br>";
        if ($wybrany=="Szczegółowy")
             echo "Zawartość: $pole3  <br>";
        echo "<br>";
    }
    $conn = null;

  }
  catch(PDOException $err) {
    echo "Błąd połączenia z bazą: " . $err->getMessage();
  }
}
?>
<br>
<a href="baza_menu.php">Powrót </a>

</body>
</html>