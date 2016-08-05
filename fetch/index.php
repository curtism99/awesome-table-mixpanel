<?php
header('Access-Control-Allow-Origin: *');
require('mixpanel-library.php');

if(isset($_GET["toDate"])) {
    $toDate = $_GET['toDate'];
} else {
    $toDate = '2016-08-01';
};
if(isset($_GET["fromDate"])) {
    $fromDate = $_GET['fromDate'];
} else {
    $fromDate = '2016-02-15';
};

$api_secret = 'MIXPANEL_SECRET_KEY';

$mp = new Mixpanel($api_secret);
$data = $mp->request(array(
    'from_date' => $fromDate,
    'to_date' => $toDate
));


?>
