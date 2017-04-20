<?php

require_once('config.php');
require_once('functions.php');
require_once('class.cycle.php');

if($_POST['mode'] == 'new') {
    $cycle = new Cycle();
    $cycle->setDuration($_POST['duration']);
    $cycle->setStartMoment(date('Y-m-d H:i:s'));
    $res = $cycle->updateDb();
    if($res) {
        echo $cycle->getId();
    }
    else {
        echo 'error';
    }
}
elseif($_POST['mode'] == 'done') {
    $cycle = new Cycle($_POST['cycleId']);
    $cycle->setAchieved(TRUE);
    $res = $cycle->updateDb();
    if($res) {
        echo 'ok';
    }
    else {
        echo 'error';
    }
}
