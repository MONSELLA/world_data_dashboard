<?php
include("conexion.php");

// Definir la consulta SQL
$sql1 = "SELECT Name, Population 
        FROM country
        ORDER BY Population DESC
        LIMIT 5";

$sql2 = "SELECT Name, Population 
        FROM city
        ORDER BY Population DESC
        LIMIT 5";

$sql3 = "SELECT Name,SurfaceArea 
        FROM country
        ORDER BY SurfaceArea DESC
        LIMIT 5";

$sql4 = "SELECT Language, COUNT(Name) AS name_count
        FROM (
            SELECT Language, Name 
            FROM country 
            JOIN countrylanguage ON Code = CountryCode
        ) AS subquery
        GROUP BY Language
        ORDER BY name_count DESC
        LIMIT 5";

$sql5 = "SELECT Name, Population 
        FROM City
        WHERE CountryCode='ESP'
        ORDER BY Population DESC
        LIMIT 5";

// Ejecutar la consulta
$result1 = $conn->query($sql1);
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
$result4 = $conn->query($sql4);
$result5 = $conn->query($sql5);
?>

<!DOCTYPE html>
<html lang="es-Es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Data Dashboard</title>
    <link rel="icon" href="world.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <nav class="bg-dark navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="https://www.uib.cat" class="navbar-brand" style="color: #fff;">
                <img src="UIB.svg" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">
            </a>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" style="color: #fff;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://dev.mysql.com/doc/index-other.html" style="color: #fff;">Data Source</a>
                </li>

        </div>
    </nav>

    <div class="mt-4 mb-4 text-center">
        <h1>World Data Dashboard</h1>
    </div>

    <div class="container text-center">
        <div class="row">
            <div class="col">
                <div id="container1" style="width:100%; height:400px;"></div>
            </div>
            <div class="col">
                <div id="container2" style="width:100%; height:400px;"></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div id="container3" style="width:100%; height:400px;"></div>
            </div>
            <div class="col">
                <div id="container4" style="width:100%; height:400px;"></div>
            </div>
            <div class="col">
                <div id="container5" style="width:100%; height:400px;"></div>
            </div>
        </div>
    </div>

    <script>
        function createChart1(containerId) {
            let countryNames = [];
            let population = [];

            <?php
            while ($row = $result1->fetch_assoc()) {
                echo "countryNames.push('" . addslashes($row["Name"]) . "');\n";
                echo "population.push(" . $row["Population"] . ");\n";
            }
            ?>

            Highcharts.chart(containerId, {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Countries with Higher Population'
                },
                xAxis: {
                    categories: countryNames
                },
                yAxis: {
                    title: {
                        text: 'Population'
                    }
                },
                series: [{
                    name: 'Population',
                    data: population
                }]
            });
        }

        function createChart2(containerId) {
            let cityNames = [];
            let population = [];

            <?php
            while ($row = $result2->fetch_assoc()) {
                echo "cityNames.push('" . addslashes($row["Name"]) . "');\n";
                echo "population.push(" . $row["Population"] . ");\n";
            }
            ?>

            Highcharts.chart(containerId, {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Cities with Higher Population'
                },
                xAxis: {
                    categories: cityNames
                },
                yAxis: {
                    title: {
                        text: 'Population'
                    }
                },
                series: [{
                    name: 'Population',
                    data: population,
                    color: '#2ecc71'
                }]
            });
        }

        function createChart3(containerId) {
            let countryNames = [];
            let surfaceArea = [];

            <?php
            while ($row = $result3->fetch_assoc()) {
                echo "countryNames.push('" . addslashes($row["Name"]) . "');\n";
                echo "surfaceArea.push(" . $row["SurfaceArea"] . ");\n";
            }
            ?>

            Highcharts.chart(containerId, {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Countries with Higher Surface Area'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        },
                        showInLegend: true
                    }
                },
                series: [{
                    name: 'Surface Area',
                    colorByPoint: true,
                    data: [{
                            name: countryNames[0],
                            y: surfaceArea[0]
                        },
                        {
                            name: countryNames[1],
                            y: surfaceArea[1]
                        },
                        {
                            name: countryNames[2],
                            y: surfaceArea[2]
                        },
                        {
                            name: countryNames[3],
                            y: surfaceArea[3]
                        },
                        {
                            name: countryNames[4],
                            y: surfaceArea[4]
                        }
                    ]
                }]
            });
        }

        function createChart4(containerId) {
            let languages = [];
            let totalCountries = [];

            <?php
            while ($row = $result4->fetch_assoc()) {
                echo "languages.push('" . addslashes($row["Language"]) . "');\n";
                echo "totalCountries.push(" . $row["name_count"] . ");\n";
            }
            ?>

            Highcharts.chart(containerId, {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Languages spoken in more countries'
                },
                xAxis: {
                    categories: languages
                },
                yAxis: {
                    title: {
                        text: 'Countries'
                    }
                },
                series: [{
                    name: 'Countries',
                    data: totalCountries,
                    color: '#a569bd'
                }]
            });
        }

        function createChart5(containerId) {
            let cityName = [];
            let population = [];

            <?php
            while ($row = $result5->fetch_assoc()) {
                echo "cityName.push('" . addslashes($row["Name"]) . "');\n";
                echo "population.push(" . $row["Population"] . ");\n";
            }
            ?>

            Highcharts.chart(containerId, {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Most populated cities in Spain'
                },
                xAxis: {
                    categories: cityName
                },
                yAxis: {
                    title: {
                        text: 'Population'
                    }
                },
                series: [{
                    name: 'Population',
                    data: population,
                    color: '#cc922e'
                }]
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            createChart1('container1');
            createChart2('container4');
            createChart3('container2');
            createChart4('container3');
            createChart5('container5');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
</body>

<footer class="bg-dark text-center text-white py-3">
    <div class="d-flex justify-content-center align-items-center">
        <a href="https://github.com/maarcnavarro9/World-Data-Dashboard" target="_blank" class="text-white me-3">
            <img src="github.svg" alt="GitHub" width="30" height="30" class="d-inline-block">
        </a>
        <a href="https://www.linkedin.com/in/pau-monserrat-llabr%C3%A9s-73382929a/" target="_blank" class="text-white me-3">
            <img src="linkedin.png" alt="LinkedIn Pau" width="30" height="30" class="d-inline-block">
        </a>
        <a href="https://www.linkedin.com/in/marc-navarro-amengual" target="_blank" class="text-white">
            <img src="linkedin.png" alt="LinkedIn Marc" width="30" height="30" class="d-inline-block">
        </a>
    </div>
    <p class="mt-3 mb-0">&copy; <span id="current-year"></span> Pau Monserrat & Marc Navarro</p>
</footer>

<script>
    // Script para actualizar el año automáticamente
    document.getElementById('current-year').textContent = new Date().getFullYear();
</script>

</html>