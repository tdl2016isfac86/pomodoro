<?php

/*******************************
 * 
 * class.cycle.php
 * 
 * class Cycle
 * 
 * *****************************/
 
 class Cycle {
    private $id;
    private $startMoment;
    private $achieved;
    private $duration;
    
    function __construct($id = 0) {
        if($id != 0) {
            $res = dbQuery("SELECT * FROM cycle WHERE id='".$id."'");
            $cycle = $res[0];
            $this->id = $cycle['id'];
            $this->startMoment = $cycle['start_moment'];
            $this->achieved = $cycle['achieved'];
            $this->duration = $cycle['duration'];
        }
        else {
            $this->achieved = 'FALSE';
        }
    }
    
    function getId() {
        return $this->id;
    }

    function getStartMoment() {
        return $this->startMoment;
    }
    
    function setStartMoment($var) {
        $timestamp = strtotime($var);
        if(is_int($timestamp)) {
            $this->startMoment = date('Y-m-d H:i:s',$timestamp);
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    function getAchieved() {
        return $this->achieved;
    }

    function setAchieved($var) {
        if(is_bool($var)) {
            $this->achieved = $var?'TRUE':'FALSE';
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    function getDuration() {
        return $this->duration;
    }
    
    function setDuration($var) {
        if(is_numeric($var)) {
            $this->duration = $var;
            return TRUE;
        }
        else {
            return FALSE;
        }
    }
    
    function updateDb() {
        if(is_numeric($this->id)) {
            // L'id est bien un entier,
            // donc l'objet existe en base de données
            // et il faut le mettre à jour
            $res = dbQuery("UPDATE cycle
                SET achieved = ".$this->achieved."
                WHERE id='".$this->id."'");
            return $res;
        }
        else {
            $res = dbQuery("INSERT INTO cycle VALUES (
                NULL,
                '".$this->startMoment."',
                ".$this->achieved.",
                '".$this->duration."'
                )");
            if(is_int($res)) {
                $this->id = $res; // On attribue le nouvel id à l'objet
                return TRUE;
            }
            else {
                return FALSE;
            }
            
        }
    }
 }