<?php
require_once('Vehicle.php');
require_once(__DIR__ . '/../../../wp-config.php');
header('Content-Type: text/json');

//echo "," . DB_HOST . ",\n";
//echo "," . DB_USER . ",\n";
//echo "," . DB_PASSWORD . ",\n";
//echo "," . DB_NAME . ",\n";

/*print_R($_POST);*/



function createVehicleObj($row)
{
    $myVehicle = new UsedVehicle();

    $myVehicle->setMake($row['make']);
    $myVehicle->setModel($row['model']);
    $myVehicle->setVehicleType($row['vehicle_type']);
    $myVehicle->setCategory($row['category']);
    $myVehicle->setManufactorYear($row['manufactor_year']);
    $myVehicle->setNoOfSeats($row['no_of_seats']);
    $myVehicle->setVehicleEngine($row['vehicle_engine']);
    $myVehicle->setNoOfCylinder($row['no_of_cylinder']);
    $myVehicle->setGearbox($row['gearbox']);
    $myVehicle->setNoOfSpeeds($row['no_of_speeds']);
    $myVehicle->setMaxPerformance($row['max_performance']);
    $myVehicle->setMaxTorque($row['max_torque']);
    $myVehicle->setSunroof($row['sunroof']);
    $myVehicle->setPanoramaRoof($row['panorama_roof']);
    $myVehicle->setFrontFogLamps($row['front_fog_lamps']);
    $myVehicle->setBackFogLamps($row['back_fog_lamps']);
    $myVehicle->setFrontLedLamps($row['front_led_lamps']);
    $myVehicle->setBackLedLamps($row['back_led_lamps']);
    $myVehicle->setXenonLamps($row['xenon_lamps']);
    $myVehicle->setElectricMirror($row['electric_mirror']);
    $myVehicle->setElectricJoinMirror($row['electric_join_mirror']);
    $myVehicle->setSportRims($row['sport_rims']);
    $myVehicle->setRimsSize($row['rims_size']);
    $myVehicle->setPowerSteering($row['power_steering']);
    $myVehicle->setMultiFunctionWheel($row['multi_function_wheel']);
    $myVehicle->setElectricFrontWindow($row['electric_front_window']);
    $myVehicle->setElectricBackWindow($row['electric_back_window']);
    $myVehicle->setCruiseControl($row['cruise_control']);
    $myVehicle->setLeatherCoveredWheel($row['leather_covered_wheel']);
    $myVehicle->setLeatherDressing($row['leather_dressing']);
    $myVehicle->setFrontChairArmrest($row['front_chair_armrest']);
    $myVehicle->setBackChairArmrest($row['back_chair_armrest']);
    $myVehicle->setAutomaticLightSystem($row['automatic_light_system']);
    $myVehicle->setLambLevelAdjustment($row['lamb_level_adjustment']);
    $myVehicle->setSmartLighting($row['smart_lighting']);
    $myVehicle->setRainSensors($row['rain_sensors']);
    $myVehicle->setLightsensingInternalMirror($row['lightsensing_internal_mirror']);
    $myVehicle->setColoredGlass($row['colored_glass']);
    $myVehicle->setElectricalOutput($row['electrical_output']);
    $myVehicle->setTirePressureStatment($row['tire_pressure_statment']);
    $myVehicle->setBackAcVents($row['back_ac_vents']);
    $myVehicle->setEnterEngineKeyless($row['enter_engine_keyless']);
    $myVehicle->setBlutoothPhoneConnection($row['blutooth_phone_connection']);
    $myVehicle->setFrontParkingSensor($row['front_parking_sensor']);
    $myVehicle->setBackParkingSensor($row['back_parking_sensor']);
    $myVehicle->setBackTrunkCapacity($row['back_trunk_capacity']);
    $myVehicle->setElectricChair($row['electric_chair']);
    $myVehicle->setBackCamera($row['back_camera']);
    $myVehicle->setGearboxWheel($row['gearbox_wheel']);
    $myVehicle->setFuelConsumption($row['fuel_consumption']);
    $myVehicle->setTankCapacity($row['tank_capacity']);
    $myVehicle->setAbs($row['abs']);
    $myVehicle->setElectronicParking($row['electronic_parking']);
    $myVehicle->setAirbags($row['airbags']);
    $myVehicle->setEncryptedKey($row['encrypted_key']);
    $myVehicle->setRadioCd($row['radio_cd']);
    $myVehicle->setMp3($row['mp3']);
    $myVehicle->setAux($row['aux']);
    $myVehicle->setUsb($row['usb']);
    $myVehicle->setSpeakers($row['speakers']);
    $myVehicle->setInfoScreen($row['info_screen']);
    $myVehicle->setUsedVehicleId($row['id']);
    $myVehicle->setPrice($row['price']);
    $myVehicle->setOutOfFactoryYear($row['out_of_factory_year']);
    $myVehicle->setKm($row['km']);
    $myVehicle->setSellerUserIdIndex($row['seller_user_id']);
    $myVehicle->setComment($row['comment']);
    $myVehicle->setLocationLatitude($row['location_latitude']);
    $myVehicle->setLocationLongitude($row['location_longitude']);
    $myVehicle->setimageurl("http://127.0.0.1/RAWAJ/wp-content/themes/rawaj/img/".$myVehicle->getUsedVehicleId().".png");
    return $myVehicle;
}

function constructSearchObj(){
    $statement = "SELECT * FROM UsedVehicle INNER JOIN Vehicle ON Vehicle.id = UsedVehicle.vehicle_id WHERE make REGEXP ? AND ".
        "vehicle_type REGEXP ? AND model REGEXP ? AND gearbox REGEXP ? AND manufactor_year REGEXP ? ".
        "AND price BETWEEN ? AND ? ".
        "AND km BETWEEN ? AND ?";
    //echo "<br/>Query:".$statement."<br/>";
    return $statement;
}
function prepereSearchStatment($xstatement){

    //print_r($_REQUEST);

    $make = $_REQUEST['make'];
    $vehicle_type = $_REQUEST['structure'];
    $model = $_REQUEST['model'];
    $gearbox = $_REQUEST['gearbox'];
    $manufactor_year = $_REQUEST['manufactor_year'];
    $minPrice = $_REQUEST['minPrice'];
    $maxPrice = $_REQUEST['maxPrice'];
    $minkm = $_REQUEST['minkm'];
    $maxkm = $_REQUEST['maxkm'];

    $makeValue = ($make ==null || $make=="") ? ".*" : str_replace(",", "|", $make);
    $modelValue = ($model ==null || $model=="") ? ".*" : str_replace(",", "|", $model);
    $vehicle_typeValue = ($vehicle_type ==null || $vehicle_type=="") ? ".*" : str_replace(",", "|", $vehicle_type);
    $gearboxValue = ($gearbox ==null || $gearbox=="") ? ".*" : str_replace(",", "|", $gearbox);
    $manufactor_yearValue = ($manufactor_year ==null || $manufactor_year=="" || $manufactor_year==0) ? ".*" : str_replace(",", "|", $manufactor_year);
    $minPriceValue = ($minPrice ==null || $minPrice=="") ? "-1" : $minPrice;
    $maxPriceValue = ($maxPrice ==null || $maxPrice=="") ? "50000000" : $maxPrice;
    $minkmValue = ($minkm ==null || $minkm=="") ? "-1" : $minkm;
    $maxkmValue = ($maxkm ==null || $maxkm=="") ? "50000000" : $maxkm;


    $xstatement->bind_param('sssssdddd', $makeValue, $vehicle_typeValue, $modelValue, $gearboxValue, $manufactor_yearValue,$maxPriceValue,$minPriceValue,$maxkmValue,$minkmValue);

    return $xstatement;
}

#$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die('Error connecting to MySQL server.');


$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$mysqli->set_charset('utf8');
$mysqli->query("SET collation_connection = utf8_general_ci");

$usedVehicleMaxPrice2 = $mysqli->query("SELECT max(price) FROM UsedVehicle")->fetch_array(MYSQLI_ASSOC)['max(price)'];
$usedVehicleMinPrice2 = $mysqli->query("SELECT min(price) FROM UsedVehicle")->fetch_array(MYSQLI_ASSOC)['min(price)'];
$usedVehicleMaxKm2 = $mysqli->query("SELECT max(km) FROM UsedVehicle")->fetch_array(MYSQLI_ASSOC)['max(km)'];
$usedVehicleMinKm2 = $mysqli->query("SELECT min(km) FROM UsedVehicle")->fetch_array(MYSQLI_ASSOC)['min(km)'];

$query = constructSearchObj();
//$query = "SELECT * FROM Vehicle;";


$statement = $mysqli->prepare($query);
$pStatment = prepereSearchStatment($statement);
$pStatment->execute();
$res = $pStatment->get_result();

$myArray = [];

if ($res == null) {
    printf("Errorcode: %d\n", $mysqli->errno);
    printf($mysqli->error);
    return;
}
while($row = $res->fetch_array(MYSQLI_ASSOC)) {
    //echo $row['make'];
    //print_r($row);
    $myVehicle = createVehicleObj($row);

    array_push($myArray, $myVehicle);
    //echo json_encode($row, 128);

}

echo json_encode($myArray);

?>
