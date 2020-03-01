<?php
$conn = mysqli_connect("localhost", "pdmadmin", "v9Tc^n89", "PDMLeak");

$affectedRow = 0;

$xml = simplexml_load_file("input.xml") or die("Error: Cannot create object");

foreach ($xml->children() as $row) {
    $name = $row->Name;
    $citizenID = $row->CitizenID;
    $phone = $row->Phone;
    $licensePlate = $row->LicensePlate;
    $vehicle = $row->Vehicle;
    
    echo $name . " ";
    echo $citizenID . " ";
    echo $phone . " ";
    echo $licensePlate . " ";
    echo $vehicle . "<br>";
}
?>
<h2>Insert XML Data to MySql Table Output</h2>
<?php
if ($affectedRow > 0) {
    $message = $affectedRow . " records inserted";
} else {
    $message = "No records inserted";
}

?>