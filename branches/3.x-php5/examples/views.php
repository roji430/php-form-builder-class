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
	<h1>Views</h1>
</div>

<p>In PFBC, views are responsible for converting a form's properties and elements into HTML, 
CSS, and Javascript for the browser to display. There are four views provided in the project's 
download: SideBySide, Vertical, Inline and Search.</p>

<?php
$form = new Form("sidebyside");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery")
));
$form->addElement(new Element_Hidden("form", "sidebyside"));
$form->addElement(new Element_HTML('<legend>SideBySide <small>default</small></legend>'));
$form->addElement(new Element_Email("Email Address:", "Email", array("required" => 1)));
$form->addElement(new Element_Password("Password:", "Password", array("required" => 1)));
$form->addElement(new Element_Checkbox("", "Remember", array("1" => "Remember me")));
$form->addElement(new Element_Button("Login"));
$form->addElement(new Element_Button("Cancel", "button", array(
	"onclick" => "history.go(-1);"
)));
$form->render();

echo '<pre>', highlight_string('<?php
$form = new Form("sidebyside");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery")
));
$form->addElement(new Element_Hidden("form", "sidebyside"));
$form->addElement(new Element_HTML(\'<legend>SideBySide <small>default</small></legend>\'));
$form->addElement(new Element_Email("Email Address:", "Email", array("required" => 1)));
$form->addElement(new Element_Password("Password:", "Password", array("required" => 1)));
$form->addElement(new Element_Checkbox("", "Remember", array("1" => "Remember me")));
$form->addElement(new Element_Button("Login"));
$form->addElement(new Element_Button("Cancel", "button", array(
	"onclick" => "history.go(-1);"
)));
$form->render();
?>', true), '</pre>';

$form = new Form("vertical");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery", "focus"),
	"view" => new View_Vertical,
	"labelToPlaceholder" => 1
));
$form->addElement(new Element_Hidden("form", "vertical"));
$form->addElement(new Element_HTML('<legend>Vertical</legend>'));
$form->addElement(new Element_Textbox("Subject", "Subject"));
$form->addElement(new Element_Textarea("Comment", "Comment", array("class" => "span6")));
$form->addElement(new Element_Button("Post Comment"));
$form->addElement(new Element_Button("Cancel", "button", array(
	"onclick" => "history.go(-1);"
)));
$form->render();

echo '<pre>', highlight_string('<?php
$form = new Form("vertical");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery", "focus"),
	"view" => new View_Vertical,
	"labelToPlaceholder" => 1
));
$form->addElement(new Element_Hidden("form", "vertical"));
$form->addElement(new Element_HTML(\'<legend>Vertical</legend>\'));
$form->addElement(new Element_Textbox("Subject", "Subject"));
$form->addElement(new Element_Textarea("Comment", "Comment", array("class" => "span6")));
$form->addElement(new Element_Button("Post Comment"));
$form->addElement(new Element_Button("Cancel", "button", array(
	"onclick" => "history.go(-1);"
)));
$form->render();
?>', true), '</pre>';

$form = new Form("inline");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery", "focus"),
	"view" => new View_Inline,
	"labelToPlaceholder" => 1
));
$form->addElement(new Element_Hidden("form", "inline"));
$form->addElement(new Element_HTML('<legend>Inline</legend>'));
$form->addElement(new Element_Email("Email Address", "Email", array("required" => 1)));
$form->addElement(new Element_Password("Password", "Password", array("required" => 1)));
$form->addElement(new Element_Checkbox("", "Remember", array("1" => "Remember me")));
$form->addElement(new Element_Button("Login"));
$form->render();

echo '<pre>', highlight_string('<?php
$form = new Form("inline");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery", "focus"),
	"view" => new View_Inline,
	"labelToPlaceholder" => 1
));
$form->addElement(new Element_Hidden("form", "inline"));
$form->addElement(new Element_HTML(\'<legend>Inline</legend>\'));
$form->addElement(new Element_Email("Email Address", "Email", array("required" => 1)));
$form->addElement(new Element_Password("Password", "Password", array("required" => 1)));
$form->addElement(new Element_Checkbox("", "Remember", array("1" => "Remember me")));
$form->addElement(new Element_Button("Login"));
$form->render();
?>', true), '</pre>';

$form = new Form("search");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery", "focus"),
	"view" => new View_Search
));
$form->addElement(new Element_Hidden("form", "search"));
$form->addElement(new Element_HTML('<legend>Search</legend>'));
$form->addElement(new Element_Search("", "Search", array("placeholder" => "Search", "append" => '<button class="btn btn-primary">Go</button>')));
$form->render();

echo '<pre>', highlight_string('<?php
$form = new Form("search");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery", "focus"),
	"view" => new View_Search
));
$form->addElement(new Element_Hidden("form", "search"));
$form->addElement(new Element_HTML(\'<legend>Search</legend>\'));
$form->addElement(new Element_Search("", "Search", array("placeholder" => "Search", "append" => \'<button class="btn btn-primary">Go</button>\')));
$form->render();
?>', true), '</pre>';

include("../footer.php");
