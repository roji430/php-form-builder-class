<?php
class View_Standard extends View {
	public function render() {
		$form = $this->getForm();
		echo '<form', $form->getAttributes(), '>';
		$form->getError()->render();

		$elements = $form->getElements();
		$elementSize = sizeof($elements);
		for($e = 0; $e < $elementSize; ++$e) {
			$element = $elements[$e];

			if($element instanceof Element_Hidden || $element instanceof Element_HTMLExternal)
                $element->render();
            elseif($element instanceof Element_Button) {
                if($e == 0 || !$elements[($e - 1)] instanceof Element_Button)
                    echo '<div class="pfbc-element pfbc-buttons">';
                $element->render();
                if(($e + 1) == $elementSize || !$elements[($e + 1)] instanceof Element+Button)
                    echo '</div>';
            }
            else {
				echo '<div class="pfbc-element">';
				$this->renderLabel($element);
				$element->render();
				echo '</div>';
			}
		}

		echo '</form>';
    }

	public function renderCSS() {
		$form = $this->getForm();
		$id = $form->getId();
		$width = $form->getWidth();
		$widthSuffix = $form->getWidthSuffix();

		parent::renderCSS();
		echo <<<CSS
#$id { width: $width{$widthSuffix}; }
#$id .pfbc-element { margin-bottom: 1em; padding-bottom: 1em; border-bottom: 1px solid #f4f4f4; }
#$id .pfbc-label { margin-bottom: .25em; }
#$id .pfbc-label label { display: block; }
#$id .pfbc-textbox, #$id .pfbc-textarea, #$id .pfbc-select { width: $width{$widthSuffix}; }
#$id .pfbc-buttons { text-align: right; }
CSS;
	}
}
