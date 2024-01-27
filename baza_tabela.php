<?php

//    $sql = "SELECT post_author,post_date,post_content, post_title FROM wp_posts";
   
   $sql = "SELECT * FROM wp_posts";

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
?>