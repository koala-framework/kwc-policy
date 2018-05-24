<?php
class KwcNotificationBox_Kwc_Box_Form extends Kwc_Abstract_Composite_Form
{
    protected function _initFields()
    {
        $this->add(new Kwf_Form_Field_DateTimeField('alteration_date', trlKwf('Alteration date')))
            ->setWidth(500);
        $this->add(new Kwf_Form_Field_Static(trlKwf('Setting an alteration date will determine a point in time when new content becomes relevant. At this date the box will be shown to notify users of a content change.')));
        $this->add(new Kwf_Form_Field_Checkbox('show_banner', trlKwf('Show Banner')));
        $this->add(new Kwf_Form_Field_TextField('headline', trlKwf('Headline')))
            ->setAllowBlank(true)
            ->setWidth(500);
        $this->add(new Kwf_Form_Field_TextField('text', trlKwf('Text')))
            ->setWidth(500);
        $this->add(new Kwf_Form_Field_TextField('accept_text', trlKwf('Accept Text')))
            ->setWidth(500);

        $fs = $this->add(new Kwf_Form_Container_FieldSet(trlKwf('More Info')));
        $fs->add(new Kwf_Form_Field_TextField('more_text', trlKwf('More Info Text')))
            ->setWidth(500);

        $fs->add($this->createChildComponentForm($this->getClass(), '-linktag', 'linktag'));
    }
}
