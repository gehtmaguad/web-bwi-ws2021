<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="10" ;>
    <title>Citybikes</title>
</head>
<?php

$url = 'http://dynamisch.citybikewien.at/citybike_xml.php?json';

header('Content-type: charset=UTF-8');
$content = file_get_contents($url);
$json = json_decode($content, true);

?>

<html>

<head>
</head>

<body>
    <table border=1>
        <th>Station</th>
        <th>free boxes</th>
        <th>free bikes</th>

        <?php

        foreach ($json as $data) {

            echo '<tr><td>';
            echo utf8_decode($data['name']);
            echo '</td>';
            echo '<td>';
            echo utf8_decode($data['free_boxes']);
            echo '</td>';
            echo '<td>';
            echo utf8_decode($data['free_bikes']);
            echo '</td>';
            echo '</tr>';
        }

        ?>

    </table>
</body>

</html>