<?php
    $q = $_GET['q'];

    // // Connect to Database
    require('cafe_config_cotisation_cafe.php');

    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    // set the PDO error mode to exception
    }
    catch (PDOException $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

    // ******************************************************
    // SELECTIONNER UNE TABLE
    // ******************************************************
    $inDate = "SELECT * FROM `$q` INNER JOIN membres ON `$q`.ID=membres.ID;";
    $outDate = $conn->query($inDate);
    $Date = $outDate-> fetch(PDO::FETCH_ASSOC);

    echo "<table>
    <tr>
    <th>Nom</th>
    <th>Prénom</th>
    <th>Mail</th>
    <th>Cotisation</th>
    </tr>";

    do
    {
    echo "<tr>";
    echo "<td>" . $Date['Nom'] . "</td>";
    echo "<td>" . $Date['Prénom'] . "</td>";
    echo "<td>" . $Date['Mail'] . "</td>";
    echo "<td><input type='button' style='width: 100%; color: transparent;' value='".$Date['cotisation_status']."'></td>";
    echo "</tr>";
    } while($Date = $outDate-> fetch(PDO::FETCH_ASSOC));

    echo "</table>";
?>