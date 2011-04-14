<?php
namespace PFBC\Element;

class Radio extends \PFBC\OptionElement {
	protected $attributes = array("type" => "radio");
	protected $inline;

	public function jQueryDocumentReady() {
		if(!empty($this->inline))
			echo 'jQuery("#', $this->attributes["id"], ' .pfbc-radio:last").css("margin-right", "0");';
	}
	
	public function render() { 
		$count = 0;
		$checked = false;
		echo '<div id="', $this->attributes["id"], '">';
		foreach($this->options as $value => $text) {
			echo '<div class="pfbc-radio"><table cellpadding="0" cellspacing="0"><tr><td valign="top"><input id="', $this->attributes["id"], "-", $count, '"', $this->getAttributes(array("id", "value", "checked")), ' value="', $this->filter($value), '"';
			if(isset($this->attributes["value"]) && $this->attributes["value"] == $value)
				echo ' checked="checked"';
			echo '/></td><td><label for="', $this->attributes["id"], "-", $count, '">', $text, '</label></td></tr></table></div>';
			++$count;
		}	

		if(!empty($this->inline))
			echo '<div style="clear: both;"></div>';

		echo '</div>';
	}

	public function renderCSS() {
		if(!empty($this->inline))
			echo '#', $this->attributes["id"], ' .pfbc-radio { float: left; margin-right: 0.5em; }';
	}		

}
