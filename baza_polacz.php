<html lang="pl-PL">
<head>
<meta charset="utf-8"> 
</head>
<body>

<?php
    echo "<table border=2 width=100%><tr><th>ID</th><th>Name</th></tr>";
    // output data of each row

        echo "<tr><td>" .Kowalski. "</td><td>" .Jan. "</td></tr>";

    echo "</table>";
    
?>

// przeglądanie tablicy SELECT - projekcja
<?php
  try {
    $conn = new PDO("mysql:host=mysql.cba.pl;dbname=adrianrkaczmarek", "akk179755", "Wiewiurek04!!");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connected to the database.<br>';

    $sql = 'SELECT post_author,post_date,post_content, post_title FROM wp_posts';
    
    print "Autor posta Data posta <br>";
    foreach ($conn->query($sql) as $row) {
        $pole1=$row['post_author'];
        $pole2=$row['post_date'];
        $pole3=$row['post_content'];
        $pole4=$row['post_title'];
  //      print $row['post_author' 'post_date'] . "<br>";
        echo "$pole1 ->   $pole2   Tytuł posta: $pole4  <br>";
        echo "Zawartość: $pole3  <br>";
        echo "<br>";
    }
    $conn = null;

  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }
?>

// przeglądanie tablicy SELECT - selekcja
<form action="" method="post">
<h1>Podaj swoje dane, przeglądanie rekordów w tablicy</h1>
Zawartość do przeszukania: <input type="text" name="zawartosc" size=40 maxsize=3 /><br><br>

<input type="submit" name="akcja" value="Szukaj" />
<input type="submit" name="akcja" value="Porzuć" />
</form>

<?php
$serwer="mysql.cba.pl";
$akcja=$_POST[akcja];
if(isset($_POST['zawartosc']) && $akcja=="Szukaj")
{
    $zawartosc = $_POST ['zawartosc'];
  try {
    $conn = new PDO("mysql:host=mysql.cba.pl;dbname=adrianrkaczmarek", "akk179755", "Wiewiurek04!!");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connected to the database.<br>';

    $sql = "SELECT post_author,post_date,post_content, post_title FROM wp_posts where post_title like '%$zawartosc%'";
 
    $stmt = $conn->query($sql);
    $rows = $stmt->fetchAll();
    $num_rows = count($rows);
    echo $num_rows ;

    if ($num_rows > 0) {
        print "Zawartość tabeli wp_post <br>";
        echo "<table border=3><tr><th>ID autora posta</th><th>Data posta</th><th>Tytuł posta</th></tr>";
        foreach ($conn->query($sql) as $row) {
           $pole1=$row['post_author'];
           $pole2=$row['post_date'];
           $pole3=$row['post_content'];
           $pole4=$row['post_title'];
           echo "<tr><td>" . $pole1. "</td><td>" . $pole2. "</td><td>" . $pole4. "</td></tr>";
         }
         echo "</table>";
    }
    else
    echo "Nie znaleziono rekrów dla zadanego kryterium";
    $conn = null;
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }

}
?>

// Dodawanie rekordów do tablicy - INSERT
<form action="" method="post">
<h1>Podaj swoje dane, dodawanie rekordów do tablicy</h1>
Podaj ID autora posta, np 1: <input type="text" name="id_autora" size=3 maxsize=3 /><br><br>
Podaj datę w postaci RRRR-MM-DD, np.: 2019-03-10: <input type="text" name="data_posta" size=30 maxsize=3 /><br><br>
Podaj tytuł posta, np Post 1: <input type="text" name="tytul_posta" size=30 maxsize=3 /><br><br>
Podaj zawartość posta, np. Ipsum lorem: <input type="text" name="zawartosc_posta" size=70 maxsize=3 /><br><br>

<input type="submit" name="akcja" value="Dodaj" />
<input type="submit" name="akcja" value="Porzuć" />
</form>

<?php
$serwer="xxxxxxx";
$akcja=$_POST[akcja];
if(isset($_POST['id_autora']) && $akcja=='Dodaj')
{
    $p_post_autor = $_POST ['id_autora'];
    $p_post_date= $_POST ['data_posta'];
    $p_post_title= $_POST ['tytul_posta'];
    $p_post_content= $_POST ['zawartosc_posta'];
  try {
    $conn = new PDO("mysql:host=$serwer;dbname=krzyshau", "krzyshau", "Gosia123");

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo 'Connected to the database.<br>';
    $sql = "INSERT INTO wp_posts (post_author, post_date, post_title, post_content) VALUES ('$p_post_autor', '$p_post_date', '$p_post_title', '$p_post_content')";
  $conn->exec($sql);
    echo "Rekord został dodany do tabeli <br><br>";

    $sql = "SELECT post_author,post_date,post_content, post_title FROM wp_posts";

    print "Zawartość tabeli wp_post <br>";
        echo "<table border=3><tr><th>ID autora posta</th><th>Data posta</th><th>Tytuł posta</th></tr>";
    foreach ($conn->query($sql) as $row) {
        $pole1=$row['post_author'];
        $pole2=$row['post_date'];
        $pole3=$row['post_content'];
        $pole4=$row['post_title'];
        echo "<tr><td>" . $pole1. "</td><td>" . $pole2. "</td><td>" . $pole4. "</td></tr>";
    }
        echo "</table>";
    $conn = null;


  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }

}
?>


// Usuwanie rekordów - DELETE
<form action="" method="post">
<h1>Podaj swoje dane, usuwanie rekordów z tablicy</h1>
Podaj tytuł posta: <input type="text" name="tytul" size=40 maxsize=3 /><br><br>
<input type="submit" name="akcja" value="Usuń" />
<input type="submit" name="akcja" value="Porzuć" />
</form>
<?php
$serwer="mysql.cba.pl";
$akcja=$_POST['akcja'];
if(isset($_POST['tytul']) && $akcja=="Usuń")
{
    $tytul_usun = $_POST ['tytul'];
  try {
    $conn = new PDO("mysql:xxxxx;dbname=xxxxx", "xxxxxx", "xxxxxxxx");
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
   
   
    print "Zawartość tabeli wp_post <br>";
        echo "<table border=3><tr><th>ID autora posta</th><th>Data posta</th><th>Tytuł posta</th></tr>";
    foreach ($conn->query($sql) as $row) {
        $pole1=$row['post_author'];
        $pole2=$row['post_date'];
        $pole3=$row['post_content'];
        $pole4=$row['post_title'];
        echo "<tr><td>" . $pole1. "</td><td>" . $pole2. "</td><td>" . $pole4. "</td></tr>";
    }
        echo "</table>";
    $conn = null;
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }
}
?>


// Modyfikacja rekordów - UPDATE
<form action="" method="post">
<h1>Podaj swoje dane do modyfikacji rekordów w tablicy</h1>
Podaj "stary" tytuł posta: <input type="text" name="tytul" size=40 maxsize=3 /><br><br>
Podaj "nowy" tytuł posta: <input type="text" name="tytul_nowy" size=40 maxsize=3 /><br><br>
<input type="submit" name="akcja" value="Zmień" />
<input type="submit" name="akcja" value="Porzuć" />
</form>
<?php
$serwer="mysql.cba.pl";
$akcja=$_POST['akcja'];
if(isset($_POST['tytul'])&& $akcja=="Zmień")
{
    $tytul = $_POST ['tytul'];
       $tytul_nowy = $_POST ['tytul_nowy'];
  try {
    $conn = new PDO("mysql:host=mysql.cba.pl;dbname=adrianrkaczmarek", "akk179755", "Wiewiurek04!!");
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
    
    
    $sql = "SELECT post_author,post_date,post_content, post_title FROM wp_posts";
   
   
    print "Zawartość tabeli wp_post <br>";
        echo "<table border=3><tr><th>ID autora posta</th><th>Data posta</th><th>Tytuł posta</th></tr>";
    foreach ($conn->query($sql) as $row) {
        $pole1=$row['post_author'];
        $pole2=$row['post_date'];
        $pole3=$row['post_content'];
        $pole4=$row['post_title'];
        echo "<tr><td>" . $pole1. "</td><td>" . $pole2. "</td><td>" . $pole4. "</td></tr>";
    }
        echo "</table>";
    $conn = null;
  }
  catch(PDOException $err) {
    echo "ERROR: Unable to connect: " . $err->getMessage();
  }
}
?>





</body>
</html>
