<?php

try{
    $pdo = new PDO("mysql:hostname=localhost;dbname=terminarz", "root", "");
} catch(PDOException $e){
    die("Nie udalo sie polaczyc z baza danych: " . $e);
}

?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Zadania na lipiec</title>
        <link rel="stylesheet" href="styl6.css">
    </head>
    <body>
        <header>
            <div>
                <img src="logo1.png" alt="lipiec">
            </div>
            <div>
                <h1>TERMINARZ</h1>
                <p>
                    najbliższe zadania:
                    <?php

                    $result = $pdo->query("SELECT DISTINCT wpis FROM zadania WHERE dataZadania BETWEEN '2020-07-01' AND '2020-07-7' AND wpis NOT LIKE ''");
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        echo $row['wpis'] . "; ";
                    }

                    ?>
                </p>
            </div>
        </header>
        <main>
            <?php
            
            $result = $pdo->query("SELECT dataZadania, wpis FROM zadania WHERE miesiac LIKE 'lipiec'");
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                echo '
                <div class="calendar_tile">
                    <h6>'.$row['dataZadania'].'</h6>
                    <p>'.$row['wpis'].'</p>
                </div>
                ';
            }

            ?>
        </main>
        <footer>
            <a href="sierpien.html">Terminarz na sierpień</a>
            <p>Stronę wykonał: 00000000000</p>
        </footer>
    </body>
</html>

<?php

$pdo = null;

?>