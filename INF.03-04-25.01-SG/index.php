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
            <form action="zamow.php" method="post">
                <label for="model">Model: </label>
                <select name="model" id="model" class="kontrolki">
                    <?php

                    $result = $pdo->query("SELECT model FROM produkt");
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        echo '<option value="'.$row['model'].'">'.$row['model'].'</option>';
                    }

                    ?>
                </select>
                <label for="size">Rozmiar: </label>
                <select name="size" id="size" class="kontrolki">
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                </select>
                <label for="count">Liczba par: </label>
                <input type="number" name="count" id="count" class="kontrolki">
                <input type="submit" value="Zamów" class="kontrolki">
            </form>
            <?php

            $result = $pdo->query("SELECT b.model, b.nazwa, b.cena, p.nazwa_pliku FROM buty b INNER JOIN produkt p ON b.model = p.model");
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                echo '
                <div class="buty">
                    <img src="'.$row['nazwa_pliku'].'" alt="but męski">
                    <h2>'.$row['nazwa'].'</h2>
                    <h5>Model: '.$row['model'].'</h5>
                    <h4>Cena: '.$row['cena'].'</h4>
                </div>
                ';
            }

            ?>
        </main>
        <footer>
            <p>Autor strony: 00000000000</p>
        </footer>
    </body>
</html>
<?php
$pdo = null;
?>