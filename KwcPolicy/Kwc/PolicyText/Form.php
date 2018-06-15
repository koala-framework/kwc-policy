<?php
class KwcPolicy_Kwc_PolicyText_Form extends Kwc_Abstract_Composite_Form
{
    protected function _initFields()
    {
        $fs = $this->add(new Kwf_Form_Container_FieldSet(trlKwf('Link to Policy-Page')));
        $fs->add(new Kwf_Form_Field_Static(trlKwf('This text is used to link to the policy-page throughout the whole website')));
        $fs->add($this->createChildComponentForm($this->getClass(), '-content', 'content'));
    }
}
