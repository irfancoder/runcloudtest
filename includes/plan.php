<?php 

    class PricingPlan{
        
        function __construct(){
         
        }
    }

    class BasicPlan extends PricingPlan{ 
        function getPlanName(){
            return "BasicPlan";
        }
        function getServerCount(){
            return 1;
        }
    }
    class ProPlan extends PricingPlan{ 
        function getPlanName(){
            return "ProPlan";
        }
        function getServerCount(){
            return 999;
        }
    }

    // $test = new ProPlan();
    // echo $test->getServerCount();
?>