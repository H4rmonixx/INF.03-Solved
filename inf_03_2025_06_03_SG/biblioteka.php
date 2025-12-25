<?php

try{
    $pdo = new PDO("mysql:hostname=localhost;dbname=biblioteka", "root", "");
} catch(PDOException $e){
    die("Nie udalo sie polaczyc z baza danych: " . $e);
}

?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BIBLIOTEKA SZKOLNA</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <header>
            <h2>TRONA  BIBLIOTEKI SZKOLNEJ WIEDZAMIN</h2>
        </header>
        <section>
            <h3>Nasze dzisiejsze propozycje:</h3>
            <table>
                <thead>
                    <th>Autor</th>
                    <th>Tytuł</th>
                    <th>Katalog</th>
                </thead>
                <tbody>
                    <?php

                    $result = $pdo->query("SELECT autor, tytul, kod FROM ksiazki ORDER BY RAND() LIMIT 5");
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        echo '
                        <tr>
                            <td>'.$row['autor'].'</td>
                            <td>'.$row['tytul'].'</td>
                            <td>'.$row['kod'].'</td>
                        </tr>
                        ';
                    }

                    ?>
                </tbody>
            </table>
        </section>
        <main>
            <article id="art1">
                <img src="ksiazka1.jpg" alt="okładka książki">
                <p>Według rónych podań najpaskudniejsza ropucha nosi w głowie piękny, cenny klejnot.</p>
            </article>
            <article id="art2">
                <img src="ksiazka2.jpg" alt="okładka książki">
                <p>Panna Stefcia i Maryla nie są to zbyt grzeczne damy, nawet nie słuchają mamy...</p>
            </article>
            <article id="art3">
                <img src="ksiazka3.jpg" alt="okładka książki">
                <p>Ratuj mnie, przyjacielu, w ostatniej potrzebie: Kocham piękną Irenę. Rodzice i ona...</p>
            </article>
        </main>
        <footer>
            Stronę wykonał: 00000000000
        </footer>
    </body>
</html>
<?php

$pdo = null;

?>