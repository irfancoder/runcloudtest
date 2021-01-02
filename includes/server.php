<?php

class Server{
    private $name;
    private $ipAddress;

    function __construct($name, $ipAddress){
        $this->name = $name;
        $this->ipAddress = $ipAddress;
        echo "Notice: '" . $name . "' is  initialized\n";
    }  

    function getServerName(){
        return $this->name;
    }
    function getIpAddress(){
        return $this->ipAddress;
    }
}

?>