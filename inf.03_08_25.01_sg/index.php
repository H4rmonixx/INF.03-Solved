<?php
    try{
        $pdo = new PDO("mysql:hostname=localhost;dbname=mieszalnia", "root", "");
    } catch(PDOException $e){
        die("Nie udalo sie polaczyc z baza: " . $e);
    }
?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <title>Mieszalnia farb</title>
        <link rel="shortcut icon" type="image/png" href="fav.png">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <img src="baner.png" alt="Mieszalnia farb">
        </header>
        <form action="" method="post">
            <label for="odbior_start">Data odbioru od: </label>
            <input type="date" id="odbior_start" name="odbior_start">
            <label for="odbior_stop">do: </label>
            <input type="date" id="odbior_stop" name="odbior_stop">
            <input type="submit" value="Wyszukaj" name="odbior_filtruj">
        </form>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>Nr zamówienia</th>
                        <th>Nazwisko</th>
                        <th>Imię</th>
                        <th>Kolor</th>
                        <th>Pojemność [ml]</th>
                        <th>Data odbioru</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['odbior_filtruj'])){
                        $result = $pdo->prepare("SELECT k.Nazwisko, k.Imie, z.id, z.kod_koloru, z.pojemnosc, z.data_odbioru FROM klienci k INNER JOIN zamowienia z ON k.Id = z.id_klienta WHERE z.data_odbioru BETWEEN ? AND ? ORDER BY z.data_odbioru ASC");
                        $result->execute([$_POST['odbior_start'], $_POST['odbior_stop']]);
                    } else {
                        $result = $pdo->query("SELECT k.Nazwisko, k.Imie, z.id, z.kod_koloru, z.pojemnosc, z.data_odbioru FROM klienci k INNER JOIN zamowienia z ON k.Id = z.id_klienta ORDER BY z.data_odbioru ASC");
                    }
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        echo '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['Nazwisko'].'</td>
                        <td>'.$row['Imie'].'</td>
                        <td bgcolor="'.$row['kod_koloru'].'">'.$row['kod_koloru'].'</td>
                        <td>'.$row['pojemnosc'].'</td>
                        <td>'.$row['data_odbioru'].'</td>
                        </tr>';
                    }

                    ?>
                </tbody>
            </table>
        </main>
        <footer>
            <h3>Egzamin INF.03</h3>
            <p>Autor: 00000000000</p>
        </footer>
    </body>
</html>
<?php

$pdo = null;

?>