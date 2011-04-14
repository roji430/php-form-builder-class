<?php
namespace PFBC;

abstract class Base {
	public function configure(array $properties = null) {
        if(!empty($properties)) {
			$class = get_called_class();

			/*The property_reference lookup array is created so that properties can be set
			case-insensitively.*/
            $available = array_keys(get_class_vars($class));
            $property_reference = array();
            foreach($available as $property)
                $property_reference[strtolower($property)] = $property;

            $available = get_class_methods($class);
            $method_reference = array();
            foreach($available as $method)
                $method_reference[strtolower($method)] = $method;
			
            foreach($properties as $property => $value) {
				$property = strtolower($property);
				if($property != "attributes") {
					if(isset($method_reference["set" . $property]))
						$this->$method_reference["set" . $property]($value);
					elseif(isset($property_reference[$property]))
						$this->$property_reference[$property] = $value;
					elseif(isset($property_reference["attributes"]))
						$this->attributes[$property] = $value;
				}
            }
        }
        return $this;
    }

	public function debug() {
		echo "<pre>", print_r($this, true), "</pre>";
	}

	protected function filter($str) {
		return htmlentities($str, ENT_QUOTES);
	}

	public function getAttributes($ignore = "") {
        $str = "";
        if(!is_array($ignore))
            $ignore = array($ignore);
        $attributes = array_diff(array_keys($this->attributes), $ignore);
        foreach($attributes as $attribute)
            $str .= ' ' . $attribute . '="' . $this->filter($this->attributes[$attribute]) . '"';
        return $str;
    }
}
?>
