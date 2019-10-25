<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>🚛Calcul routier🚛</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <style>
        h1 {text-align: center;}
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1 class='col-lg-12'>🚛Calcul distance/carte routier🚛</h1>          
        </div>
    <div class="row">
    <form class="col s12" method="post">
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Ville de depart ici :" id="depart" name="depart" type="text" class="validate">
          <label for="depart">Ville de départ :</label>
        </div>
        <div class="input-field col s6">
          <input placeholder="Ville d'arriver ici :" id="arriver" name="arriver" type="text" class="validate">
          <label for="arriver">Ville d'arriver :</label>
        </div>
      </div> 
        <center><button class="btn waves-effect waves-light" type="submit" name="action">Submit</button></center>
        </form>
    </div>
  </div>




 <?php
     if (isset($_POST["depart"]) && isset($_POST["arriver"]) && !empty($_POST["depart"]) && !empty($_POST["arriver"])) {   
$depart = $_POST["depart"]; $arriver = $_POST["arriver"];
$codesource = file_get_contents("https://www.bonnesroutes.com/widget/v1/route?defaultFrom=&defaultTo=&defaultVia=&defaultFuelConsumption=&defaultFuelPrice=&defaultSpeedLimitMotorway=&defaultSpeedLimitOther=&showVia=0&showSpeedProfile=0&showFuelCalc=0&showResultLength=1&showResultDrivingTime=0&showResultFuelAmount=0&showResultFuelCost=0&showResultCustomizedCost=0&showResultMap=0&showResultScheme=0&onlyCountries=FR&preferCountries=FR&css=https%3A%2F%2Fwww.bonnesroutes.com%2Fwidget%2Fv1%2Fwidget.css%3Fpc%3D269adb%26bc%3Dffffff%26tc%3D000000%26ff%3D-apple-system%252C%2520BlinkMacSystemFont%252C%2520%2522Segoe%2520UI%2522%252C%2520Roboto%252C%2520%2522Helvetica%2520Neue%2522%252C%2520Arial%252C%2520%2522Noto%2520Sans%2522%252C%2520sans-serif%252C%2520%2522Apple%2520Color%2520Emoji%2522%252C%2520%2522Segoe%2520UI%2520Emoji%2522%252C%2520%2522Segoe%2520UI%2520Symbol%2522%252C%2520%2522Noto%2520Color%2520Emoji%2522%26fs%3D16px&currency=EUR&measure=metric&customizedCostFormula=&customizedCostLabel=&from=" . $depart . "&to=" . $arriver . "&v=&sm=90&so=90&fc=8.00");
                
preg_match("#<div id=\"total_distance\">.+</div>#", $codesource, $datascreen);
preg_match("#<div>...</div>#", $datascreen[0], $distanceall);

                
if (isset($distanceall[0])) 
{
$distance = intval(strip_tags($distanceall[0]));
                    

//http://fechain-athletisme.fr/calculs/vitessek.htm
// En 9min --> 0 à 90km/h -->  13.5km   
// Donc en 2h --> 180km
 $calcdist = $distance;
$times = 0; // temps en minutes
while ($calcdist > 0) {
if ($calcdist > 180) {
$calcdist -= 180;
$times += 135;
} else if ($calcdist < 180) {
if ($calcdist <= 13.5) { 
$times += ($calcdist / 90);
$calcdist = 0;
} else { // $calculdist > 13.5
$times += 9;
$calcdist -= 13.5;
$times += ($calcdist / 90);
$calcdist = 0;
}
} else { // $calculdist == 180
$calcdist -= 180;
$times += 120;
}
}
 $time = $times * 60; // minutes en secondes

date_default_timezone_set('UTC'); //Permet de se mettre à l'heure EU
                    
echo "<table>";
echo "<thead><tr><th>Départ</th><th>Arrivée</th><th>Trajet (km)</th><th>Temps du trajet (Heure:minute(s))</th></tr></thead>";
echo "<tr><td>" . $depart . "</td><td>" . $arriver .  "</td><td>" . $distance . "</td><td>" . date("G:i", $time) . "</td></tr>";
echo "</table>";
} 
}
?>
        
    </div>
</body>
</html>
