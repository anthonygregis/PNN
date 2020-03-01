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
    
    $sql = "INSERT INTO transactions(name,citizenID,phone,licensePlate,vehicle) VALUES ('" . $name . "','" . $citizenID . "','" . $phone . "','" . $licensePlate . "','" . $vehicle . "')";
    
    $result = mysqli_query($conn, $sql);
    
    if (! empty($result)) {
        $affectedRow ++;
    } else {
        $error_message = mysqli_error($conn) . "\n";
    }
}
?>
<h2>Insert XML Data to MySql Table Output</h2>
<?php
if ($affectedRow > 0) {
    $message = $affectedRow . " records inserted";
} else {
    $message = "No records inserted";
}
    echo $message;

?>