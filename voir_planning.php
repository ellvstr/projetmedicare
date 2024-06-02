<!DOCTYPE html>
<html>
<head>
    <title>Planning du Docteur</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .filled {
            background-color: #87CEFA;
        }
    </style>
</head>
<body>

<table>
    <thead>
        <tr>
            <th rowspan="2">Spécialité</th>
            <th rowspan="2">Médecin</th>
            <th colspan="2">Lundi</th>
            <th colspan="2">Mardi</th>
            <th colspan="2">Mercredi</th>
            <th colspan="2">Jeudi</th>
            <th colspan="2">Vendredi</th>
            <th colspan="2">Samedi</th>
        </tr>
        <tr>
            <th>AM</th>
            <th>PM</th>
            <th>AM</th>
            <th>PM</th>
            <th>AM</th>
            <th>PM</th>
            <th>AM</th>
            <th>PM</th>
            <th>AM</th>
            <th>PM</th>
            <th>AM</th>
            <th>PM</th>
        </tr>
    </thead>
    <tbody>

<?php
// Définir les données du planning
$schedule = [
    "Lundi" => [
        "AM" => ["09:00", "09:20", "09:40", "10:00", "10:20", "10:40", "11:00", "11:20", "11:40", "12:00", "12:20", "12:40", "13h00"],
        "PM" => ["14:00", "14:20", "14:40", "15:00", "15:20", "15:40", "16:00", "16:20", "16:40", "17:00", "17:20", "17:40", "18:00"]
    ],
    "Mardi" => [
        "AM" => ["09:00", "09:20", "09:40", "10:00", "10:20", "10:40", "11:00", "11:20", "11:40", "12:00", "12:20", "12:40", "13h00"],
        "PM" => ["14:00", "14:20", "14:40", "15:00", "15:20", "15:40", "16:00", "16:20", "16:40", "17:00", "17:20", "17:40", "18:00"]
    ],
    "Mercredi" => [
        "AM" => ["09:00", "09:20", "09:40", "10:00", "10:20", "10:40", "11:00", "11:20", "11:40", "12:00", "12:20", "12:40", "13h00"],
        "PM" => ["14:00", "14:20", "14:40", "15:00", "15:20", "15:40", "16:00", "16:20", "16:40", "17:00", "17:20", "17:40", "18:00"]
    ],
    "Jeudi" => [
        "AM" => ["09:00", "09:20", "09:40", "10:00", "10:20", "10:40", "11:00", "11:20", "11:40", "12:00", "12:20", "12:40", "13h00"],
        "PM" => ["14:00", "14:20", "14:40", "15:00", "15:20", "15:40", "16:00", "16:20", "16:40", "17:00", "17:20", "17:40", "18:00"]
    ],
    "Vendredi" => [
        "AM" => ["09:00", "09:20", "09:40", "10:00", "10:20", "10:40", "11:00", "11:20", "11:40", "12:00", "12:20", "12:40", "13h00"],
        "PM" => ["14:00", "14:20", "14:40", "15:00", "15:20", "15:40", "16:00", "16:20", "16:40", "17:00", "17:20", "17:40", "18:00"]
    ],
    "Samedi" => [
        "AM" => ["09:00", "09:20", "09:40", "10:00", "10:20", "10:40", "11:00", "11:20", "11:40", "12:00", "12:20", "12:40", "13h00"],
        "PM" => ["14:00", "14:20", "14:40", "15:00", "15:20", "15:40", "16:00", "16:20", "16:40", "17:00", "17:20", "17:40", "18:00"]
    ]
];

// Parcourir les données du planning et remplir le tableau
echo "<td rowspan=\"2\">Médecine générale</td>";
echo "<td rowspan=\"2\">BOUREE, Patrice</td>";
echo "<tr>";
foreach ($schedule as $jour => $horaires) {
    foreach ($horaires as $periode => $creneaux) {
        echo "<td>";
        foreach ($creneaux as $creneau) {
            echo $creneau . "<br><br>";
        }
        echo "</td>";
    }
}
echo "</tr>";
?>

    </tbody>
</table>

</body>
</html>