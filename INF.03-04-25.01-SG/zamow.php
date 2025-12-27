<?php
try{
    $pdo = new PDO("mysql:hostname=localhost;dbname=obuwie", "root", "");
} catch(PDOException $e){
    die("Nie udalo sie polaczyc z baza danych: " . $e);
}
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Obuwie</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <h1>Obuwie męskie</h1>
        </header>
        <main>
            <h2>Zamówienie</h2>
            <?php

            if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['model']) && isset($_POST['size']) && isset($_POST['count'])){
                $stmt = $pdo->prepare("SELECT b.nazwa, b.cena, p.kolor, p.kod_produktu, p.material, p.nazwa_pliku FROM buty b INNER JOIN produkt p ON b.model = p.model WHERE b.model LIKE ?");
                $stmt->execute([$_POST['model']]);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $stmt->closeCursor();

                echo '<img src="'.$data['nazwa_pliku'].'" alt="but męski">';
                echo '<h2>'.$data['nazwa'].'</h2>';
                echo '<p>cena za '.$_POST['count'].' par: '.((int)$_POST['count'] * (float)$data['cena']).' zł</p>';
                echo '<p>Szczegóły produktu: '.$data['kolor'].', '.$data['material'].'</p>';
                echo '<p>Rozmiar: '.$_POST['size'].'</p>';

            }

            ?>
            <a href="index.php">Strona główna</a>
        </main>
        <footer>
            <p>Autor strony: 00000000000</p>
        </footer>
    </body>
</html>
<?php
$pdo = null;
?>