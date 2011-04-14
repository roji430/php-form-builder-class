<?php
namespace PFBC;

abstract class Element extends Base {
	private $errors = array();
	private $form;

	protected $attributes;
	protected $label;
	protected $description;
	protected $validation = array();

	public function __construct($label, $name, array $properties = null) {
		$configuration = array(
			"label" => $label,
			"name" => $name
		);

		if(is_array($properties))
			$configuration = array_merge($configuration, $properties);
		
		$this->configure($configuration);
	}

	/*When an element is serialized and stored in the session, this function prevents any non-essential
	information from being included.*/
	public function __sleep() {
		return array("attributes", "label", "validation");
	}

	public function getCSSFiles() {}

	public function getDescription() {
		return $this->description;
	}

	public function getErrors() {
		return $this->errors;
	}	

	public function getForm() {
		return $this->form;
	}	

	public function getID() {
		if(!empty($this->attributes["id"]))
			return $this->attributes["id"];
		else
			return "";
	}

	public function getJSFiles() {}

	public function getLabel() {
		return $this->label;
	}

	public function getName() {
		return $this->attributes["name"];
	}

	public function isRequired() {
		if(!empty($this->validation)) {
			foreach($this->validation as $validation) {
				if($validation instanceof Validation\Required)
					return true;
			}
		}
		return false;
	}

	public function isValid($value) {
		$valid = true;
		if(!empty($this->validation)) {
			if(!empty($this->label)) {
				$element = $this->label;
				if(substr($element, -1) == ":")
					$element = substr($element, 0, -1);
			}   
			else
				$element = $this->attributes["name"];

			foreach($this->validation as $validation) {
				if(!$validation->isValid($value)) {
					$this->errors[] = str_replace("%element%", $element, $validation->getMessage());
					$valid = false;
				}	
			}
		}
		return $valid;
	}

	public function jQueryDocumentReady() {}

	public function jQueryOptions() {
		if(!empty($this->jQueryOptions)) {
            $options = "";
            foreach($this->jQueryOptions as $option => $value) {
                if(!empty($options))
                    $options .= ", ";
                $options .= $option . ': ';
                if(is_string($value) && substr($value, 0, 3) == "js:")
                    $options .= substr($value, 3);
                else
                    $options .= var_export($value, true);
            }
            echo "{ ", $options, " }";
        }
	}

	public function setForm(Form $form) {
		$this->form = $form;
	}

	public function setID($id) {
		$this->attributes["id"] = $id;
	}

	public function setValue($value) {
		$this->attributes["value"] = $value;
	}

	public function setRequired($required) {
		if(!empty($required))
			$this->validation[] = new Validation\Required;
	}

	public function setValidation($validation) {
		if(!is_array($validation))
			$validation = array($validation);
		foreach($validation as $object) {
			if($object instanceof Validation) {
				$this->validation[] = $object;
			}	
		}	
	}

	public function render() {
		echo '<input', $this->getAttributes(), '/>';
	}

	public function renderCSS() {}
	public function renderJS() {}
}
