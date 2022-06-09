<?php
class Cube
{ 
    private $action;
   
    public function setAction($action)
    {
        $this->action = $action;
    }
    public function getAction()
    {
        return $this->action;
    }
    function showAnimation1(){
        return "a1";
    }
    function showAnimation2(){
        return "a2";
    }
    function showAnimation3(){
        return "a3";
    }
    function showTime(){
        return "t";
    }
    function showDate(){
        return "d";
    }
    function switchOn(){
        return "on";
    }
    function switchOff(){
        return "off";
    }
    function displayInfo()
    {
        echo "Current action is: $this->action;<br>";
    }
}
?>