<?php

    $city = !empty($_GET['city']) ? $_GET['city'] : 'Paris';
    $country = !empty($_GET['country']) ? $_GET['country'] : '';
    $url = 'http://api.openweathermap.org/data/2.5/forecast?q='.$city.''.$country.'&units=metric&APPID=d0d6af3970aaedbcc600aea99bf24ec5';
    $path = '../cache/'.md5($url);
    

    // Check the cache
    if(file_exists($path) && time() - filemtime($path) < 10)
    {
        $forecast = json_decode(file_get_contents($path));
    }
    else
    {
        $forecast = json_decode(file_get_contents($url));
        file_put_contents($path, json_encode($forecast));
    }

    $country = $forecast->city->country; //Country

    $temp_glo = 0; //Global temperature
    $id_glo = 0; //Global weather

    // Rain function
    function rain(){
        echo "
        <script>
            const theBody = document.querySelector('.the-body')
            theBody.style.background = 'rgb(50, 56, 60)'
            let nbDrop = 800; 
            const rain = document.querySelector('.rain')
            const randRange = ( minNum, maxNum) => {
            return (Math.floor(Math.random() * (maxNum - minNum + 1)) + minNum)
            }

            const createRain = () => {
            
                for( i=0 ; i < nbDrop ; i++) {
                    let dropLeft = randRange(0,theBody.clientWidth)
                    let dropTop = randRange(-1000,5000)
                    const div = document.createElement('div')
                    rain.append(div)
                    div.setAttribute('class','drop')
                    div.setAttribute('id','drop'+i)
                    div.style.left = dropLeft + 'px'
                    div.style.top = dropTop + 'px'
                }
            
            }
            createRain();
        </script>";
    } 


?>

    <!DOCTYPE html>
    <html lang='en'>

    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i' rel='stylesheet'>
        <link rel='stylesheet' href='../css/reset.css'>
        <link rel='stylesheet' href='../css/style.css'>
        <!-- <link rel='stylesheet' href='../css/weather.css'> -->
        <link rel="apple-touch-icon" sizes="180x180" href="../assets/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicons/favicon-16x16.png">
        <link rel="manifest" href="../assets/favicons/site.webmanifest">
        <link rel="mask-icon" href="../assets/favicons/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <title>Weather Forecast</title>
    </head>

    <body class='the-body'>

        <div class='weather'>
            <section class="rain"></section>

            <!-- Form -->
            <form action='weather.php' method='get'>
                <h3> Other weather : </h2>
                    <input class='city' type='text' value='<?= $city; ?>' name='city'>
                    <input class='city-submit' type='submit'>
            </form>

            <!-- Results -->
            <div class='results'>
                <!-- City and country(ISO) -->
                <h2>Forecast:
                    <?= $city; ?> ,
                        <?= $country; ?>
                </h2>
                <a href='index_country.php' title='wrong counrty'>Wrong country ?</a>

                <?php foreach($forecast->list as $_forecast): ?>
                <div class='day'>
                    <!-- Date -->
                    <div class="day-date">
                        <?= date('d-m-Y H:i', $_forecast->dt); ?>
                    </div>
                    <!-- Main weather -->
                    <div class="day-weather">Weather :
                        <?php foreach($_forecast->weather as $_weather){ 
                        echo $_weather->main;
                        $id = $_weather->id;} ?>
                    </div>
                    <!-- Temperature -->
                    <div class="day-temp">
                        <?= $_forecast->main->temp; ?>°C
                    </div>
                    <!-- Humidity -->
                    <div class="day-humid">Humidity :
                        <?= $_forecast->main->humidity; ?>%
                    </div>

                    <?php
                        // Add temperatures to a variable
                        $temptemp = $_forecast->main->temp;
                        $temp_glo = $temp_glo + $temptemp;
                        $id_glo = $id_glo + $id;

                        // Change the icon according to the weather
                        if(200 <= $id && $id <= 232){
                            $icon = 'storm';
                        }else if(300 <= $id && $id <= 321){
                            $icon = 'rain-1';  
                        }else if(500 <= $id && $id <= 531){
                            $icon = 'rain-2';  
                        }else if(600 <= $id && $id <= 622){
                            $icon = 'hail';  
                        }else if(700 <= $id && $id <= 781){
                            $icon = 'wind';  
                        }else if($id == 801){
                            $icon = 'cloudy';  
                        }else if(801 < $id && $id <= 804){
                            $icon = 'clouds';  
                        }else if($id == 800){
                            $icon = 'sun';  
                        }else if($id == 900){
                            $icon = 'tornado';  
                        }else{
                            $icon = 'planet-earth';  
                        }
                        echo '<img class="weather-icon" src="../assets/'.$icon.'.png" />';
                    ?>

                </div>
                <?php endforeach; ?>

                <?php
                    $id_glo = $id_glo / 40; // Global weather depending the id
                    // Make it rain on the website if it rains a lot in the forecast
                    if($id_glo < 630){
                        rain();
                    }
                    $temp_glo = $temp_glo / 40; // Global temperature
                    if($temp_glo < 14){
                        $temp_gif = 'cold';
                    } else {
                        $temp_gif = 'hot';
                    }
                    // Generate a random gif depending the temperature
                    $giphy = json_decode(file_get_contents('http://api.giphy.com/v1/gifs/random?tag='.$temp_gif.'&rating=g&api_key=1PdshaHQE20BEID0l75U3Z6HAUNva3KG&limit=1'));
                    $gif = $giphy->data->images->fixed_height->url;
                 ?>

                    <!-- Gif -->
                    <div class='gif'>
                        <h2>Here is your weather in one GIF :</h2>
                        <img src='<?= $gif; ?>' />
                    </div>

                    <!-- Clouds -->
                    <div class="weather-loader"></div>
                    <div class="weather-loader weather-loader-two"></div>
                    <div class="weather-loader weather-loader-three"></div>
                    <div class="weather-loader weather-loader-four"></div>

            </div>
        </div>

    </body>

    </html>