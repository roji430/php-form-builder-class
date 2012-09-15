<?php
session_start();
error_reporting(E_ALL);
include("../PFBC/Form.php");

if(isset($_POST["form"])) {
	Form::isValid($_POST["form"]);
	header("Location: " . $_SERVER["PHP_SELF"]);
	exit();	
}

include("../header.php");

?>
<div class="page-header">
	<h1>HTML5</h1>
</div>

<p>PFBC has support for 13 HTML5 form elements: Phone, Search, Url, Email, DateTime, Date, 
Month, Week, Time, DateTimeLocal, Number, Range, and Color.  Each of these fallback to textboxes
in the event that the HTML5 input type isn't supported in the user's web browser.</p>

<?php
$form = new Form("html5");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery")
));
$form->addElement(new Element_Hidden("form", "html5"));
$form->addElement(new Element_HTML('<legend>Attributes</legend>'));
$form->addElement(new Element_Textbox("Required Attribute:", "Required", array(
	"required" => 1, 
	"shortDesc" => "Highlights field in red when focussed"
)));
$form->addElement(new Element_Textbox("Placeholder Attribute:", "Placeholder", array(
	"placeholder" => "my placeholder",
	"shortDesc" => "Provides example or hint",
	"longDesc" => 'The form\'s labelToPlaceholder property can be used to convert each element\'s 
	label to its placeholder.  This strategy keeps your php source cleaner when building forms.  
	Check out the <a href="views.php">Vertical View</a> example to see the labelToPlaceholder 
	property in action.'
)));
$form->addElement(new Element_Textbox("Pattern Attributes:", "Pattern", array(
	"pattern" => "^pfbc.*",
	"title" => "Must start with \"pfbc\"",
	"shortDesc" => "Provides native, client-side validation",
	"longDesc" => "This input's pattern attribute is set to the following regular expression: ^pfbc.*"
)));
$form->addElement(new Element_HTML('<legend>Elements</legend>'));
$form->addElement(new Element_Phone("Phone:", "Phone"));
$form->addElement(new Element_Search("Search:", "Search"));
$form->addElement(new Element_Url("Url:", "Url"));
$form->addElement(new Element_Email("Email:", "Email"));
$form->addElement(new Element_DateTime("DateTime:", "DateTime"));
$form->addElement(new Element_Date("Date:", "Date"));
$form->addElement(new Element_Month("Month:", "Month"));
$form->addElement(new Element_Week("Week:", "Week"));
$form->addElement(new Element_Time("Time:", "Time"));
$form->addElement(new Element_DateTimeLocal("DateTime-Local:", "DateTimeLocal"));
$form->addElement(new Element_Number("Number:", "Number"));
$form->addElement(new Element_Range("Range:", "Range"));
$form->addElement(new Element_Color("Color:", "Color"));
$form->addElement(new Element_Button);
$form->addElement(new Element_Button("Cancel", "button", array(
	"onclick" => "history.go(-1);"
)));
$form->render();

echo '<pre>', highlight_string('<?php
$form = new Form("html5");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery")
));
$form->addElement(new Element_Hidden("form", "html5"));
$form->addElement(new Element_HTML(\'<legend>Attributes</legend>\'));
$form->addElement(new Element_Textbox("Required Attribute:", "Required", array(
	"required" => 1, 
	"shortDesc" => "Highlights field in red when focussed"
)));
$form->addElement(new Element_Textbox("Placeholder Attribute:", "Placeholder", array(
	"placeholder" => "my placeholder",
	"shortDesc" => "Provides example or hint",
	"longDesc" => \'The form\\\'s labelToPlaceholder property can be used to convert each element\\\'s 
	label to its placeholder.  This strategy keeps your php source cleaner when building forms.  
	Check out the <a href="views.php">Vertical View</a> example to see the labelToPlaceholder 
	property in action.\'
)));
$form->addElement(new Element_Textbox("Pattern Attributes:", "Pattern", array(
	"pattern" => "^pfbc.*",
	"title" => "Must start with \"pfbc\"",
	"shortDesc" => "Provides native, client-side validation",
	"longDesc" => "This input\'s pattern attribute is set to the following regular expression: ^pfbc.*"
)));
$form->addElement(new Element_HTML(\'<legend>Elements</legend>\'));
$form->addElement(new Element_Phone("Phone:", "Phone"));
$form->addElement(new Element_Search("Search:", "Search"));
$form->addElement(new Element_Url("Url:", "Url"));
$form->addElement(new Element_Email("Email:", "Email"));
$form->addElement(new Element_DateTime("DateTime:", "DateTime"));
$form->addElement(new Element_Date("Date:", "Date"));
$form->addElement(new Element_Month("Month:", "Month"));
$form->addElement(new Element_Week("Week:", "Week"));
$form->addElement(new Element_Time("Time:", "Time"));
$form->addElement(new Element_DateTimeLocal("DateTime-Local:", "DateTimeLocal"));
$form->addElement(new Element_Number("Number:", "Number"));
$form->addElement(new Element_Range("Range:", "Range"));
$form->addElement(new Element_Color("Color:", "Color"));
$form->addElement(new Element_Button);
$form->addElement(new Element_Button("Cancel", "button", array(
	"onclick" => "history.go(-1);"
)));
$form->render();
?>', true), '</pre>';

include("../footer.php");
