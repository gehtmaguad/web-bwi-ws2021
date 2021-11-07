<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>

<body>
    <?php
    //Hier ist ein PHP Kommentar
    echo "<h1>Das ist eine Ausgabe.</h1>";

    $x = 24;
    $y = 2;

    $Zahl1 = 0;
    $zahl1 = 1.7;


    echo "$x + $y = " . ($x + $y);

    echo "<p>Neue Ausgabe.</p>";
    echo "Text1<br>";
    echo "Text2<br>";

    if ($x == 24) {
        echo "Wir sind im if";
    } else {
        echo "Wir sind im else";
    }

    ?>


    <ul>

        <?php
        for ($i = 1; $i <= 5; $i++) {
            echo "<li>Item $i</li>";
        }

        $counter = 1;
        while ($counter < 5) {
            echo "<li>Element $counter</li>";
            $counter++;
        }
        ?>

    </ul>

    <!-- Das ist ein HTML Kommentar -->


    <?php
    function subtract($a, $b)
    {
        return $a - $b;
    }

    ?>

    <?php
    echo "$x - $y = " . subtract($x, $y);
    echo "$a, $b";

    ?>



</body>

</html>