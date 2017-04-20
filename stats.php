<?php
require_once('config.php');
require_once('functions.php');
require_once('class.cycle.php');

$res=dbQuery("
    SELECT
    COUNT(*) as value,
    DATE(start_moment) as jour
    FROM cycle
    GROUP BY
        DATE(start_moment)
    ");
?><!DOCTYPE html>
<html>
<head>
	<title>Les Stats - Timer Pomodoro TROBI1.0</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
</head>
<body>
<section class="container-fluid">
    <div class="row">
<div id="myfirstchart" style="height: 250px;"></div>
    </div>
</section>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function() {
    new Morris.Area({
    // ID of the element in which to draw the chart.
    element: 'myfirstchart',
    // Chart data records -- each entry in this array corresponds to a point on
    // the chart.
    data: <?php
    echo JSON_encode($res);
    ?>,
    // The name of the data record attribute that contains x-values.
    xkey: 'jour',
    dateFormat : function (x) { 
        var date = new Date(x);
        var jour = date.getDate();
        var mois = date.getMonth() + 1;
        switch(mois) {
            case 1:
                mois = "Janvier";
                break;
            case 2:
                mois = "Février";
                break;
            case 3:
                mois = "Mars";
                break;
            case 4:
                mois = "Avril";
                break;
            case 5:
                mois = "Mai";
                break;
            case 6:
                mois = "Juin";
                break;
            case 7:
                mois = "Juillet";
                break;
            case 8:
                mois = "Août";
                break;
            case 9:
                mois = "Septembre";
                break;
            case 10:
                mois = "Octobre";
                break;
            case 11:
                mois = "Novembre";
                break;
            case 12: 
                mois = 'Décembre';
                break;
        }
        return jour+' '+mois;
    },
    // A list of names of data record attributes that contain y-values.
    ykeys: ['value'],
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    labels: ['Total']
    });
});
</script>
</body>
</html>