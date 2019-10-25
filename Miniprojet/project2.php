<?php
/***
Code d'un scraper avec Curl réalisé par Insimule.com
***/
function scraper ($url) {
//permet de récupérer le contenu d'une page
// User Agent
$ua = 'Mozilla/5.0 (Windows NT 6.1; rv:22.0) Gecko/20100101 Firefox/22.0';
$ch = curl_init();
curl_setopt($ch, CURLOPT_USERAGENT, $ua);
curl_setopt($ch, CURLOPT_URL, $url );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
// le scraper suit les redirections
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$result = curl_exec($ch);
curl_close ( $ch );
return $result;
}

// fichier scapper
$codesource = file_get_contents("https://www.bonnesroutes.com/widget/v1/route?defaultFrom=&defaultTo=&defaultVia=&defaultFuelConsumption=&defaultFuelPrice=&defaultSpeedLimitMotorway=&defaultSpeedLimitOther=&showVia=0&showSpeedProfile=0&showFuelCalc=0&showResultLength=1&showResultDrivingTime=0&showResultFuelAmount=0&showResultFuelCost=0&showResultCustomizedCost=0&showResultMap=0&showResultScheme=0&onlyCountries=FR&preferCountries=FR&css=https%3A%2F%2Fwww.bonnesroutes.com%2Fwidget%2Fv1%2Fwidget.css%3Fpc%3D269adb%26bc%3Dffffff%26tc%3D000000%26ff%3D-apple-system%252C%2520BlinkMacSystemFont%252C%2520%2522Segoe%2520UI%2522%252C%2520Roboto%252C%2520%2522Helvetica%2520Neue%2522%252C%2520Arial%252C%2520%2522Noto%2520Sans%2522%252C%2520sans-serif%252C%2520%2522Apple%2520Color%2520Emoji%2522%252C%2520%2522Segoe%2520UI%2520Emoji%2522%252C%2520%2522Segoe%2520UI%2520Symbol%2522%252C%2520%2522Noto%2520Color%2520Emoji%2522%26fs%3D16px&currency=EUR&measure=metric&customizedCostFormula=&customizedCostLabel=&from=" . $depart . "&to=" . $arriver . "&v=&sm=90&so=90&fc=8.00");
                
preg_match("#<div id=\"total_distance\">.+</div>#", $codesource, $datascraped);
preg_match("#<div>...</div>#", $datascraped[0], $total_distance);
echo "<table class='table'>";
echo "<thead><tr><th scope='col'>Départ</th><th scope='col'>Arrivée</th><th scope='col'>Distance (km)</th><th scope='col'>Temps de trajet (Heure:minute(s))</th></tr></thead>";
echo "<tbody><tr><td>" . $depart . "</td><td>" . $arriver .  "</td></tr></tbody>";
echo "</table>";
?>