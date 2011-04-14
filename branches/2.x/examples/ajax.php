<?php
session_start();
error_reporting(E_ALL);
include("../PFBC/Form.php");

if(isset($_POST["form"])) {
	if(PFBC\Form::isValid($_POST["form"])) {
		header("Content-type: application/json");
		echo file_get_contents("http://maps.google.com/maps/api/geocode/json?address=" . urlencode($_POST["Address"]) . "&sensor=false");
	}
	else
		PFBC\Form::renderAjaxErrorResponse("example2");
	exit();
}	

include("../header.php");
?>

<h2 class="first">Ajax</h2>
<p></p>

<?php
$form = new PFBC\Form("ajax", 400);
$form->configure(array(
	"ajax" => 1,
	"ajaxCallback" => "parseJSONResponse",
));
$form->addElement(new PFBC\Element\Hidden("form", "ajax"));
$form->addElement(new PFBC\Element\Textbox("Address:", "Address", array("required" => 1)));
$form->addElement(new PFBC\Element\HTMLExternal('<div id="GoogleGeocodeAPIReaponse" style="display: none;">'));
$form->addElement(new PFBC\Element\Textbox("Latitude/Longitude:", "LatitudeLongitude", array("readonly" => "readonly")));
$form->addElement(new PFBC\Element\HTMLExternal('</div>'));
$form->addElement(new PFBC\Element\Button("Geocode"));
$form->render();
?>

<script type="text/javascript">
function parseJSONResponse(latlng) {
	var form = document.getElementById("ajax");
	if(latlng.status == "OK") {
		var result = latlng.results[0];
		form.LatitudeLongitude.value = result.geometry.location.lat + ', ' + result.geometry.location.lng;
	}
	else
		form.LatitudeLongitude.value = "N/A";

	document.getElementById("GoogleGeocodeAPIReaponse").style.display = "block";
}
</script>

<?php
echo '<pre>', highlight_string('<?php
$form = new PFBC\Form("ajax", 400);
$form->configure(array(
	"ajax" => 1,
	"ajaxCallback" => "parseJSONResponse",
));
$form->addElement(new PFBC\Element\Hidden("form", "ajax"));
$form->addElement(new PFBC\Element\Textbox("Address:", "Address", array("required" => 1)));
$form->addElement(new PFBC\Element\HTMLExternal(\'<div id="GoogleGeocodeAPIReaponse" style="display: none;">\'));
$form->addElement(new PFBC\Element\Textbox("Latitude/Longitude:", "LatitudeLongitude", array("readonly" => "readonly")));
$form->addElement(new PFBC\Element\HTMLExternal(\'</div>\'));
$form->addElement(new PFBC\Element\Button("Geocode"));
$form->render();
?>

<script type="text/javascript">
function parseJSONResponse(latlng) {
	var form = document.getElementById("ajax");
	if(latlng.status == "OK") {
		var result = latlng.results[0];
		form.LatitudeLongitude.value = result.geometry.location.lat + \', \' + result.geometry.location.lng;
	}
	else
		form.LatitudeLongitude.value = "N/A";

	document.getElementById("GoogleGeocodeAPIReaponse").style.display = "block";
}
</script>
?>', true), '</pre>';

include("../footer.php");
?>
