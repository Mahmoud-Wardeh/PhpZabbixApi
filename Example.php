<?php

echo "<title>Zabbix Status</title>";
require 'ZabbixApi.class.php';
use ZabbixApi\ZabbixApi ;

$username = "yourusername";
$password = "yourpassword";
$url = "https://****/zabbix/api_jsonrpc.php";


try {

     //connect to Zabbix API;
     $api = new ZabbixApi($url, $username, $password);

     // get trigger
     $triggers = $api->triggerGet(array(
                                     'expandDescription'        =>TRUE,
                                     'withUnacknowledgedEvents' =>TRUE,
                                     'only_true'                =>TRUE,
                                     'monitored'                =>TRUE,
                                     'expandDescription'        =>TRUE,
                                     'output'                   => array(  
                                     'sortfield'                => 'priority','description'),
                                     'selectHosts'              => array(
                                                                         'hostid',
                                                                         'name') ,  
 ) );

    
    foreach($triggers as $trigger) {

         echo "<pre>";

        
         //print_r($trigger);
         echo "<li>".json_encode($trigger, JSON_PRETTY_PRINT)."</li>"; //JSON_NUMERIC_CHECK (line)
         echo "</br>";
         echo "\n";
       echo "</pre>";

   }
    
} catch(Exception $e) {

     //Exception in ZabbixApi catched;
     echo $e->getMessage();

}
