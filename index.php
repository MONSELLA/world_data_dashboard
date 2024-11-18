<?php
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="es-Es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Data Dashboard</title>
    <link rel="icon" href="images/world.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <nav class="bg-dark navbar navbar-expand-lg">
        <div class="container-fluid">
            <a href="https://www.uib.cat" class="navbar-brand" style="color: #fff;">
                <img src="images/UIB.svg" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">
            </a>

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#" style="color: #fff;">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://dev.mysql.com/doc/index-other.html" style="color: #fff;">Data Source</a>
                </li>
            </ul>
            <!-- Espacio para el tiempo -->
            <div class="weather-info text-white d-flex align-items-center ms-auto me-3">
                <img id="weather-icon" src="" alt="Weather Icon" width="40" height="40" class="me-2">
                <span id="weather-temp"></span>
            </div>
        </div>
    </nav>

    <div class="mt-4 mb-4 text-center">
        <h1>World Data Dashboard</h1>
    </div>
    <!-- Espacio entre filas -->
    <div class="my-5"></div>
    <div class="container text-center">
        <div class="row">
            <div class="col">
                <div id="container1" style="width:100%; height:400px;"></div>
            </div>
            <div class="col">
                <div id="container2" style="width:100%; height:400px;"></div>
            </div>
        </div>
        <!-- Espacio entre filas -->
        <div class="my-5"></div>
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
        // Obtener el tiempo de Palma de Mallorca desde OpenWeatherMap
        const apiKey = "bd5e378503939ddaee76f12ad7a97608";
        const city = "Palma de Mallorca";
        const apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${apiKey}`;

        function updateWeather() {
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.weather && data.main) {
                        const iconCode = data.weather[0].icon;
                        const temp = Math.round(data.main.temp); // Redondear la temperatura

                        // Actualizar el DOM con la información del tiempo
                        $("#weather-icon").attr("src", `https://openweathermap.org/img/wn/${iconCode}.png`);
                        $("#weather-temp").text(`${temp}°C`);

                    } else {
                        console.error("Error fetching weather data:", data);
                    }
                })
                .catch(error => console.error("Error:", error));
        }

        // Llamar a la función al cargar la página
        updateWeather();
        // Actualizar el tiempo cada 10 minutos
        setInterval(updateWeather, 600000);
    </script>

    <script>
        function fetchData(queryType, callback) {
            fetch(`fetch_data.php?query=${queryType}`)
                .then(response => {
                    console.log(`Response for ${queryType}:`, response);
                    return response.json();
                })
                .then(data => {
                    console.log(`Data received for ${queryType}:`, data);
                    if (!data || !Array.isArray(data) || data.length === 0) {
                        console.error(`No valid data received for ${queryType}.`);
                        return;
                    }
                    callback(data);
                })
                .catch(error => console.error('Error fetching data:', error));
        }


        function createOrUpdateChart1(chart) {
            fetchData('topCountriesByPopulation', function(data) {
                let countryNames = data.map(item => item.Name);
                let population = data.map(item => parseInt(item.Population, 10));

                if (!chart) {
                    // Crear el gráfico por primera vez
                    chart = Highcharts.chart('container1', {
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
                        }],
                        credits: {
                            enabled: false // Eliminar la marca de agua de Highcharts
                        }
                    });
                } else {
                    // Actualizar los datos
                    chart.xAxis[0].setCategories(countryNames);
                    chart.series[0].setData(population);
                }
            });
            return chart;
        }


        function createOrUpdateChart2(chart) {
            fetchData('topCitiesByPopulation', function(data) {
                let cityNames = data.map(item => item.Name);
                let population = data.map(item => parseInt(item.Population, 10));

                if (!chart) {
                    chart = Highcharts.chart('container4', {
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
                        }],
                        credits: {
                            enabled: false // Eliminar la marca de agua de Highcharts
                        }
                    });
                } else {
                    chart.xAxis[0].setCategories(cityNames);
                    chart.series[0].setData(population);
                }
            });
            return chart;
        }


        function createOrUpdateChart3(chart) {
            fetchData('topCountriesBySurfaceArea', function(data) {
                let countryNames = data.map(item => item.Name);
                let surfaceAreas = data.map(item => parseFloat(item.SurfaceArea));

                if (!chart) {
                    chart = Highcharts.chart('container2', {
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
                            data: countryNames.map((name, i) => ({
                                name,
                                y: surfaceAreas[i]
                            }))
                        }],
                        credits: {
                            enabled: false // Eliminar la marca de agua de Highcharts
                        }
                    });
                } else {
                    chart.series[0].setData(countryNames.map((name, i) => ({
                        name,
                        y: surfaceAreas[i]
                    })));
                }
            });
            return chart;
        }


        function createOrUpdateChart4(chart) {
            fetchData('languagesByCountryCount', function(data) {
                let languages = data.map(item => item.Language);
                let totalCountries = data.map(item => parseInt(item.name_count, 10));

                if (!chart) {
                    // Crear el gráfico por primera vez
                    chart = Highcharts.chart('container3', {
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
                        }],
                        credits: {
                            enabled: false // Eliminar la marca de agua de Highcharts
                        }
                    });
                } else {
                    // Actualizar los datos del gráfico existente
                    chart.xAxis[0].setCategories(languages);
                    chart.series[0].setData(totalCountries);
                }
            });
            return chart;
        }


        function createOrUpdateChart5(chart) {
            fetchData('topCitiesInSpain', function(data) {
                let cityNames = data.map(item => item.Name);
                let population = data.map(item => parseInt(item.Population, 10));

                if (!chart) {
                    // Crear el gráfico por primera vez
                    chart = Highcharts.chart('container5', {
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: 'Most populated cities in Spain'
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
                            color: '#cc922e'
                        }],
                        credits: {
                            enabled: false // Eliminar la marca de agua de Highcharts
                        }
                    });
                } else {
                    // Actualizar los datos del gráfico existente
                    chart.xAxis[0].setCategories(cityNames);
                    chart.series[0].setData(population);
                }
            });
            return chart;
        }


        $(document).ready(function() {
            let chart1, chart2, chart3, chart4, chart5;

            function updateCharts() {
                chart1 = createOrUpdateChart1(chart1);
                chart2 = createOrUpdateChart2(chart2);
                chart3 = createOrUpdateChart3(chart3);
                chart4 = createOrUpdateChart4(chart4);
                chart5 = createOrUpdateChart5(chart5);
            }

            // Crear los gráficos inicialmente
            updateCharts();

            // Actualizar los gráficos cada 30 segundos
            setInterval(updateCharts, 30000);
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
        <a href="https://github.com/MONSELLA/world_data_dashboard" target="_blank" class="text-white me-3">
            <img src="images/github.svg" alt="GitHub" width="30" height="30" class="d-inline-block">
        </a>
        <a href="https://www.linkedin.com/in/pau-monserrat-llabr%C3%A9s-73382929a/" target="_blank" class="text-white me-3">
            <img src="images/linkedin.png" alt="LinkedIn Pau" width="30" height="30" class="d-inline-block">
        </a>
        <a href="https://www.linkedin.com/in/marc-navarro-amengual" target="_blank" class="text-white">
            <img src="images/linkedin.png" alt="LinkedIn Marc" width="30" height="30" class="d-inline-block">
        </a>
    </div>
    <p class="mt-3 mb-0">&copy; <span id="current-year"></span> Pau Monserrat & Marc Navarro</p>
</footer>

<script>
    // Script para actualizar el año automáticamente
    $('#current-year').text(new Date().getFullYear());
</script>

</html>