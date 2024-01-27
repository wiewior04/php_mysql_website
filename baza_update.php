<html lang="pl-PL">
<head>
<meta charset="utf-8"> 
</head>
<body>

// Modyfikacja rekordów - UPDATE
<form action="" method="post">
<h1>Podaj swoje dane do modyfikacji rekordów w tablicy</h1>
Podaj "stary" tytuł posta: <input type="text" name="tytul" size=40 maxsize=3 /><br><br>
Podaj "nowy" tytuł posta: <input type="text" name="tytul_nowy" size=40 maxsize=3 /><br><br>
<input type="submit" name="akcja" value="Zmień" />
<input type="submit" name="akcja" value="Porzuć" />
</form>
<?php

$akcja=$_POST['akcja'];
if(isset($_POST['tytul'])&& $akcja=="Zmień")
{
    $tytul = $_POST ['tytul'];
       $tytul_nowy = $_POST ['tytul_nowy'];
  try {
    include "baza_link.php";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connected to the database.<br>';
    $sql_update = "UPDATE wp_posts set post_title='$tytul_nowy' where post_title='$tytul'";
    
 $sql1 = "select * FROM wp_posts where post_title='$tytul'";
 // use exec() because no results are returned
    
      $stmt = $conn->query($sql1);
  $rows = $stmt->fetchAll();
  $num_rows = count($rows);
  echo $num_rows ;

if ($num_rows > 0) {
    
    // Prepare statement
 //   $stmt = $conn->prepare($sql_update);

    // execute the query
 //   $stmt->execute();   
    
    $conn->exec($sql_update);
    echo "Rekordy zostały zmienione";
}
  else  
    echo "Brak rekordów do modyfikacji dla podanych warunków";    
    
    include 'baza_tabela.php';
    $conn = null;
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }
}
?>

<br>
<a href='baza_menu.php'> Powrót </a>



</body>
</html>
