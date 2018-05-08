<?php
class NotificationBox_Kwc_Form extends Kwc_Abstract_Composite_Form
{
    protected function _initFields()
    {
        $this->add(new Kwf_Form_Field_Checkbox('show_banner', trlKwf('Show Banner')));
        $this->add(new Kwf_Form_Field_TextField('headline', trlKwf('Headline')))
            ->setDefaultValue(trlKwf('Headline'))
            ->setAllowBlank(true)
            ->setWidth(500);
        $this->add(new Kwf_Form_Field_TextField('text', trlKwf('Text')))
            ->setDefaultValue(trlKwf('Subtext'))
            ->setWidth(500);
        $this->add(new Kwf_Form_Field_TextField('accept_text', trlKwf('Accept Text')))
            ->setDefaultValue(trlKwf('Accept'))
            ->setWidth(500);
        $this->add(new Kwf_Form_Field_DateTimeField('change_date', trlKwf('Change Date')))
            ->setWidth(500);

        $fs = $this->add(new Kwf_Form_Container_FieldSet(trlKwf('More Info')));
        $fs->add(new Kwf_Form_Field_TextField('more_text', trlKwf('More Info Text')))
            ->setDefaultValue(trlKwf('Link to Resource'))
            ->setWidth(500);

        $fs->add($this->createChildComponentForm($this->getClass(), '-linktag', 'linktag'));
    }
}
