$(document).ready(function () {
    var timer = 25*60; // Probablement 1500 secondes
    var interval = 0; // On initialise interval, qui identifie le timer lancé par setInterval()
    var listePeriodes = [25,5,25,5,25,5,25,15];
    var periode = 0;
    var actualCycleId;
    
    var updateTimer = function (timer) {
        var minute = Math.floor(timer/60);
        var seconde = timer%60;
        if(seconde < 10) {
            seconde = '0'+seconde
        } 
        $('#timer').text(minute+':'+seconde);
    };
    
    var logCycle = function(mode, additional) {
        // mode : new|done
        // additional : Soit la durée du cycle (duration), soit son id (cycleId)
        /* Première méthode
        var data;
        if(mode === 'new') {
            data = {
                mode: 'new',
                duration : additional
            };
        }
        else {
            data = {
                mode: 'done',
                cycleId : additional
            };
        }
        */
        var data= {};
        data.mode = mode;
        if(mode === 'new') {
            data.duration = additional;
        }
        else {
            data.cycleId = additional;
        }
        var ajaxResponse;
        $.ajax({
            url: "log_cycle.php",
            method : 'POST',
            data : data,
            async : false,
            success : function(response) {
                console.log(data);
                console.log(response);
                if(response == 'error') {
                    // Le code PHP retourne 'error', c'est-à-dire que la requête SQL ne s'est pas exécutée correctement
                    alert('Désolé, une erreur est survenue lors de l\'enregistrement du cycle en base de données');
                    ajaxResponse = false;
                }
                else if(response == 'ok') {
                    // Si on reçoit 'ok', nous étions alors en mode 'done' et tout s'est bien déroulé
                    console.log('Cycle achevé et mis à jour');
                    ajaxResponse = true;
                }
                else {
                    // Dans le dernier cas, nous recevons l'id du cycle nouvellement créé. Nous l'attribuons à la variable actualCycleId sous forme d'entier
                    ajaxResponse = parseInt(response,10);
                }
            },
            error : function() {
                alert('Désolé, une erreur est survenue lors de la requête ajax');
            },
            complete : function() {
                console.log('Requête Ajax exécutée');
            }
        });
        return ajaxResponse;
    };
    
    $('#reset-btn').click(function() {
        timer = 25*60;
        periode = 0;
        updateTimer(timer);
        window.clearInterval(interval); 
        interval = 0;
    });
    
    $('#start-btn').click(function() {
        if(interval == 0) {
            actualCycleId = logCycle('new', timer);
            interval = window.setInterval(function() {
                if(timer != 0) {
                    timer = timer-1;
                    updateTimer(timer);
                }
                else {
                    logCycle('done', actualCycleId);
                    window.clearInterval(interval);
                    interval = 0;
                    if(periode ==7) {
                        periode = 0;
                    }
                    else {
                        periode = periode+1;
                    }
                    timer = listePeriodes[periode]*60;
                    updateTimer(timer);
                }
            }, 10);
        }
    });
    $('#stop-btn').click(function() {
        window.clearInterval(interval);
        interval = 0;
    });
});