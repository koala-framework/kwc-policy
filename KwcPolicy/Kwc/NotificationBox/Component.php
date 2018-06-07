<?php
class KwcPolicy_Kwc_NotificationBox_Component extends Kwc_Abstract_Composite_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['rootElementClass'] = 'kwfUp-webStandard';
        $ret['componentName'] = trlKwfStatic('Policy Notification Box');
        $ret['generators']['child']['component']['linktag'] = 'Kwc_Basic_LinkTag_Component';
        $ret['extConfig'] = 'Kwf_Component_Abstract_ExtConfig_Form';
        $ret['ownModel'] = 'Kwf_Component_FieldModel';
        $ret['flags']['hasFooterIncludeCode'] = true;
        return $ret;
    }

    public function getIncludeCode()
    {
        return $this->getData();
    }

    public function getTemplateVars(Kwf_Component_Renderer_Abstract $renderer)
    {
        $ret = parent::getTemplateVars($renderer);
        $ret['showBanner'] = $this->_getRow()->show_banner;
        $ret['alterationDate'] = $this->_getRow()->alteration_date;
        $ret['headline'] = $this->_getRow()->headline;
        $ret['text'] = $this->_getRow()->text;
        $ret['moreText'] = $this->_getRow()->more_text;
        $ret['acceptText'] = $this->_getRow()->accept_text;
        return $ret;
    }
}
