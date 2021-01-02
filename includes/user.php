<?php
include 'plan.php';
include 'server.php';

class User
{
    private $name;
    private $plan;
    private $servers = [];

    function __construct($name)
    {
        $this->name = $name;
        echo "Notice: User '" . $name . "' initialized\n";
    }

    function subscribe($plan)
    {
        if (!is_null($this->plan)) {
            if ($this->plan->getPlanName() == $plan->getPlanName()) {
                // duplicate subscription; output: error
                echo "Error: user already subscribed to existing plan\n";
            } else {
                // upgrade/downgrade plan; output: ok
                $this->plan = $plan;
                echo "Success: '" . $this->name . "' is subscribed to " . $this->plan->getPlanName() . "\n";
            }
        } else {
            // initial plan subscription; output: ok
            $this->plan = $plan;
            echo "Success: '" . $this->name . "' is subscribed to " . $this->plan->getPlanName() . "\n";
        }
    }

    function connectServer($server)
    {
        if (!is_null($this->plan)) {

            if (count($this->servers) >= $this->plan->getServerCount()) {
                // reached max quota for current plan; output: error
                echo "Error: User has exceed the number of servers to connect. To connect, please upgrade to Pro/Business Plan\n";
            } else {
                if (isset($this->servers[$server->getIpAddress()])) {
                    // server is already connected; output: error
                    echo "Error: " . $server->getServerName() . " is already connected\n";
                    
                } else {
                    // new server to be added; output: ok
                    $this->servers[$server->getIpAddress()] = $server;
                    echo "Success: '" . $server->getServerName() . "' is connected\n";
                }
            }
        } else {
            // no plan found; output: error
            echo "Error: Connection attempt failed. User is not subscribed to any plan\n";
        }
    }

    function unsubscribe()
    {
        // remove current plan subscription; output: ok
        echo "Success: '" . $this->plan->getPlanName() . "' subscription removed\n";
        $this->plan = null;
    }


    function getCurrentPlan()
    {
        // [debug commmand] display current plan; output: ok
        if (!is_null($this->plan)) {
            echo "Notice: User '" . $this->name . "' is subscribed to " . $this->plan->getPlanName() . "\n";
        } else {
            echo "Notice: No subscription found \n";
        }
    }

    function printServers()
    {
         // [debug commmand] connected servers; output: ok
        echo "Name             IP Address\n";
        foreach ($this->servers as $server) {
            echo $server->getServerName() . " -------- " . $server->getIpAddress() . "\n";
        }
    }
}

/*
* debug commands
*/
// $test = new User("irfan");
// $protest = new BasicPlan();
// $test-> subscribe($protest);
// $test->getCurrentPlan();


// $servertest = new Server('Server 1', '192.168.0.1');
// $servertest2 = new Server('Server 2', '192.168.0.2');
// $test->connectServer($servertest);
// $test->connectServer($servertest);
// $test->connectServer($servertest2);
// $test->printServers();
