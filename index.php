<?php
    $city = !empty($_GET['city']) ? $_GET['city'] : 'ex : Paris';
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="apple-touch-icon" sizes="180x180" href="assets/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/favicons/favicon-16x16.png">
        <link rel="manifest" href="assets/favicons/site.webmanifest">
        <link rel="mask-icon" href="assets/favicons/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <title>Weather Forecast</title>
    </head>

    <body>
        <div class="container">
            <h1>Weather Forecast</h1>
            <p>Enter a city and see the weather forecast.</p>
            <!-- Form -->
            <form action="pages/weather.php" method="get">
                <input class="city" type="text" value="<?= $city; ?>" name="city">
                <input class="city-submit" type="submit">
            </form>
        </div>
        <script>
            let $colors = ['linear-gradient(to right, #22c1c3, #fdbb2d)', 'linear-gradient(to right, #283c86, #45a247)',
                'linear-gradient(to right, #00f260, #0575e6)', 'linear-gradient(to right, #34e89e, #0f3443)',
                'linear-gradient(to right, #4568dc, #b06ab3)', 'linear-gradient(to right, #c0c0aa, #1cefff)',
                'linear-gradient(to right, #a770ef, #cf8bf3, #fdb99b)',
                'linear-gradient(to right, #fceabb, #f8b500)', 'linear-gradient(to right, #56ab2f, #a8e063)'
            ]
            let $background = $colors[Math.floor(Math.random() * $colors.length)]
            const $container = document.querySelector('.container')

            // random linear gradient for the home page
            $container.style.background = $background
        </script>
    </body>

    </html>