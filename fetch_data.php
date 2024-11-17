<?php
include("conexion.php");

header('Content-Type: application/json');

$queryType = $_GET['query'];

switch ($queryType) {
    case 'topCountriesByPopulation':
        $sql = "SELECT Name, Population FROM country ORDER BY Population DESC LIMIT 5";
        break;
    case 'topCitiesByPopulation':
        $sql = "SELECT Name, Population FROM city ORDER BY Population DESC LIMIT 5";
        break;
    case 'topCountriesBySurfaceArea':
        $sql = "SELECT Name, SurfaceArea FROM country ORDER BY SurfaceArea DESC LIMIT 5";
        break;
    case 'languagesByCountryCount':
        $sql = "SELECT Language, COUNT(Name) AS name_count
                FROM (
                    SELECT Language, Name 
                    FROM country 
                    JOIN countrylanguage ON Code = CountryCode
                ) AS subquery
                GROUP BY Language
                ORDER BY name_count DESC
                LIMIT 5";
        break;
    case 'topCitiesInSpain':
        $sql = "SELECT Name, Population FROM city WHERE CountryCode='ESP' ORDER BY Population DESC LIMIT 5";
        break;
    default:
        echo json_encode([]);
        exit;
}

$result = $conn->query($sql);
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
?>
