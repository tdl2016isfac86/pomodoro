<!DOCTYPE html>
<html>
<head>
	<title>Timer Pomodoro TROBI1.0</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<section class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-md-12 col-xs-12 col-lg-offset-2">
            <h1 class="text-center">Pomodoro Timer</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-12 col-xs-12 col-lg-offset-2">
            <div id="timer" class="text-center">25:00</div>
        </div>
    </div>
    <div class="row">
        <div id="start-btn" class="col-lg-4 col-md-6 col-xs-6 col-lg-offset-2 btn btn-success">
            Start
        </div>
        <div id="stop-btn" class="col-lg-4 col-md-6 col-xs-6 btn btn-danger">
            Stop
        </div>
    </div>
    <div class="row">
        <div id="reset-btn" class="col-lg-8 col-md-6 col-xs-6 col-lg-offset-2 col-md-offset-3 col-xs-offset-3 btn btn-info">
            Reset
        </div>
    <div class="row">
        <div id="stats-btn" class="col-lg-8 col-md-6 col-xs-6 col-lg-offset-2 col-md-offset-3 col-xs-offset-3">
            <a href="stats.php">Stats</a>
        </div>
    </div>
</section>

<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript" src="script.js"></script>
</body>
</html>