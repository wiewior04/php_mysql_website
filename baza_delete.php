<html lang="pl-PL">
<head>
<meta charset="utf-8"> 
</head>
<body>
// Usuwanie rekordów - DELETE
<form action="" method="post">
<h1>Podaj swoje dane, usuwanie rekordów z tablicy</h1>
Podaj tytuł posta: <input type="text" name="tytul" size=40 maxsize=3 /><br><br>
<input type="submit" name="akcja" value="Usuń" />
<input type="submit" name="akcja" value="Porzuć" />
</form>
<?php
$akcja=$_POST['akcja'];
if(isset($_POST['tytul']) && $akcja=="Usuń")
{
    $tytul_usun = $_POST ['tytul'];
  try {
    include "baza_link.php";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connected to the database.<br>';
    $sql = "DELETE FROM wp_posts where post_title='$tytul_usun'";
     $sql1 = "select * FROM wp_posts where post_title='$tytul_usun'";
 // use exec() because no results are returned
    
      $stmt = $conn->query($sql1);
  $rows = $stmt->fetchAll();
  $num_rows = count($rows);
  echo $num_rows ;

if ($num_rows > 0) {
    
    
    $conn->exec($sql);
    echo "Record deleted successfully";
}
  else  
    echo "Brak rekordów do usunięcia dla podanych warunków";    
    
    
    $sql = "SELECT post_author,post_date,post_content, post_title FROM wp_posts";
   
   
    include 'baza_tabela.php';
    $conn = null;
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }
}
?>
<br>
<a href='baza_menu.php'>Powrót</a>

</body>
</html>