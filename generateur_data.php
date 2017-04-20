<?php
/* 
*
*   Générateur de données de test
*
*/

require_once('config.php');
require_once('functions.php');
require_once('class.cycle.php');

//$time = 1482306734;
//$time = time() - (3600*24*365) - (3600*24*67); // Date il y a un an
$achievedArray = [FALSE, TRUE, TRUE];
$durationArray = [300,300,300,900,1500,1500,1500,1500,1500,1500]; // Nos trois durées pondérées

$nbCycleAchieved = 0;

// On utilise $duration, $achieved et $time à chaque itération de la boucle for pour déterminer les valeurs d'un cycle


for($i=0;$i<1000;$i++) {
    
    // On détermine le startMoment grâce à $time
    if(isset($duration)) {
        // On ajoute le temps du cycle précédent à notre variable $time
        $time = $time + $duration;
        
        // Si il est plus de 18h, on reprend le prochain pomodoro le lendemain
        if(date('H',$time) >= 18) {
            $time = $time + (3600*14) + rand(-780,780);
            // On ajoute plus ou moins 12 minutes à l'heure de départ du lendemain
        }

        // Si il est midi, on prend une pause d'au moins une heure et de maximum 2h
        if(date('H',$time) >= 12) {
            $time = $time + rand(3600,3600*2);
        }
        
        // On ajoute entre 0 et 10 minutes de décalage entre la fin du précédent cycle et le début du nouveau
        $time = $time + rand(0,600);
        
        // Si le cycle précédent n'est pas achevé, on réduit $time d'un nombre de secondes au hasard compris entre 0 et la durée du cycle précédent
        if($achieved == FALSE) {
    //  if(!$achieved) {
            $time = $time - rand(0,$duration);
        }
    }

    // if-else détermine la valeur de $duration
    if(!isset($duration)) {
        $duration = 1500;
    }
    else {
        // On utilise les valeurs du cycle précédent pour déterminer les nouvelles valeurs de ce nouveau cycle
        switch($duration) {
            case 1500:
                if($achieved == TRUE && $nbCycleAchieved < 3) {
                    $duration = 300;
                    $nbCycleAchieved++;
                }
                elseif($achieved == TRUE && $nbCycleAchieved == 3) {
            //  elseif($achieved && $nbCycleAchieved == 3) {
                    $duration = 900;
                    $nbCycleAchieved = 0;
                }
                else {
                    $duration = $durationArray[rand(0,9)];
                    $nbCycleAchieved = 0;
                }
                break;
            case 300:
            case 900:
                $duration = 1500;
                break;
        }
    }
    
    // On détermine au hasard la valeur de $achieved
    //$achieved = rand(0,1)==0?FALSE:TRUE;
    $achieved = $achievedArray[rand(0,2)];
    
    
    
    $cycle = new Cycle();
    $cycle->setStartMoment(date('Y-m-d H:i:s',$time));
    $cycle->setAchieved($achieved);
    $cycle->setDuration($duration);
    $cycle->updateDb();
}