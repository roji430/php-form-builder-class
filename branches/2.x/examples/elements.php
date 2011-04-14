<?php
session_start();
error_reporting(E_ALL);
include("../PFBC/Form.php");

if(isset($_POST["form"])) {
	if(PFBC\Form::isValid($_POST["form"])) {
		/*The form's submitted data has been validated.  Your script can now proceed with any 
		further processing required.*/
		header("Location: " . $_SERVER["PHP_SELF"]);
	}
	else {
		/*Validation errors have been found.  We now need to redirect back to the 
		script where your form exists so the errors can be corrected and the form
		re-submitted.*/
		header("Location: " . $_SERVER["PHP_SELF"]);
	}
	exit();
}	

include("../header.php");
?>

<h2 class="first">Elements</h2>
<p></p>

<?php
$options = array("Option #1", "Option #2", "Option #3");
$form = new PFBC\Form("elements", 400);
$form->addElement(new PFBC\Element\Hidden("form", "elements"));
$form->addElement(new PFBC\Element\Textbox("Textbox:", "Textbox"));
$form->addElement(new PFBC\Element\Textarea("Textarea:", "Textarea"));
$form->addElement(new PFBC\Element\Select("Select:", "Select", $options));
$form->addElement(new PFBC\Element\Radio("Radio:", "Radio", $options));
$form->addElement(new PFBC\Element\Password("Password:", "Password"));
$form->addElement(new PFBC\Element\Checkbox("Checkbox:", "Checkbox", $options));
$form->addElement(new PFBC\Element\YesNo("Yes / No:", "YesNo"));
$form->addElement(new PFBC\Element\Checksort("Checksort:", "Checksort", $options));
$form->addElement(new PFBC\Element\Sort("Sort:", "Sort", $options));
$form->addElement(new PFBC\Element\State("State:", "State"));
$form->addElement(new PFBC\Element\Email("Email:", "Email"));
$form->addElement(new PFBC\Element\Date("Date:", "Date"));
$form->addElement(new PFBC\Element\Captcha("Captcha:"));
$form->addElement(new PFBC\Element\Button);
$form->render();

echo '<pre>', highlight_string('<?php
$options = array("Option #1", "Option #2", "Option #3");
$form = new PFBC\Form("elements", 400);
$form->addElement(new PFBC\Element\Hidden("form", "elements"));
$form->addElement(new PFBC\Element\Textbox("Textbox:", "Textbox"));
$form->addElement(new PFBC\Element\Textarea("Textarea:", "Textarea"));
$form->addElement(new PFBC\Element\Select("Select:", "Select", $options));
$form->addElement(new PFBC\Element\Radio("Radio:", "Radio", $options));
$form->addElement(new PFBC\Element\Password("Password:", "Password"));
$form->addElement(new PFBC\Element\Checkbox("Checkbox:", "Checkbox", $options));
$form->addElement(new PFBC\Element\YesNo("Yes / No:", "YesNo"));
$form->addElement(new PFBC\Element\Checksort("Checksort:", "Checksort", $options));
$form->addElement(new PFBC\Element\Sort("Sort:", "Sort", $options));
$form->addElement(new PFBC\Element\State("State:", "State"));
$form->addElement(new PFBC\Element\Email("Email:", "Email"));
$form->addElement(new PFBC\Element\Date("Date:", "Date"));
$form->addElement(new PFBC\Element\Captcha("Captcha:"));
$form->addElement(new PFBC\Element\Button);
$form->render();
?>', true), '</pre>';

$form = new PFBC\Form("webeditors", 650);
$form->configure(array(
	"prevent" => array("focus", "jQuery", "jQueryUI")
));
$form->addElement(new PFBC\Element\Hidden("form", "webeditors"));
$form->addElement(new PFBC\Element\TinyMCE("TinyMCE:", "TinyMCE"));
$form->addElement(new PFBC\Element\CKEditor("CKEditor:", "CKEditor"));
$form->addElement(new PFBC\Element\Button);
$form->render();

echo '<pre>', highlight_string('<?php
$form = new PFBC\Form("webeditors", 650);
$form->addElement(new PFBC\Element\Hidden("form", "webeditors"));
$form->addElement(new PFBC\Element\TinyMCE("TinyMCE:", "TinyMCE"));
$form->addElement(new PFBC\Element\CKEditor("CKEditor:", "CKEditor"));
$form->addElement(new PFBC\Element\Button);
$form->render();
?>', true), '</pre>';

include("../footer.php");
?>
