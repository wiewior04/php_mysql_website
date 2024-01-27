<html lang="pl-PL">
<head>
<meta charset="utf-8"> 
</head>
<body>


// Dodawanie rekordów do tablicy - INSERT
<form action="" method="post">
<h1>Podaj swoje dane, dodawanie rekordów do tablicy</h1>
Podaj ID autora posta, np 1: <input type="text" name="id_autora" size=3 maxsize=3 /><br><br>
Podaj datę w postaci RRRR-MM-DD, np.: 2019-03-10: <input type="date" name="data_posta" size=30 maxsize=3 /><br><br>
Podaj tytuł posta, np Post 1: <input type="text" name="tytul_posta" size=30 maxsize=3 /><br><br>
Podaj zawartość posta, np. Ipsum lorem: <input type="text" name="zawartosc_posta" size=70 maxsize=3 /><br><br>

<input type="submit" name="akcja" value="Dodaj" />
<input type="submit" name="akcja" value="Porzuć" />
</form>

<?php

$akcja=$_POST[akcja];
if(isset($_POST['id_autora']) && $akcja=='Dodaj')
{
    $p_post_autor = $_POST ['id_autora'];
    $p_post_date= $_POST ['data_posta'];
    $p_post_title= $_POST ['tytul_posta'];
    $p_post_content= $_POST ['zawartosc_posta'];
  try {
        include "baza_link.php";

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connected to the database.<br>';
    $sql = "INSERT INTO wp_posts (post_author, post_date, post_title, post_content) VALUES ('$p_post_autor', '$p_post_date', '$p_post_title', '$p_post_content')";
  $conn->exec($sql);
    echo "Rekord został dodany do tabeli <br><br>";

    include 'baza_tabela.php';
    $conn = null;


  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }

}

?>
<br>
<a href="baza_menu.php"> Powrót </a>
</body>
</html>