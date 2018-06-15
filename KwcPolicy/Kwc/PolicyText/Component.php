<?php
class KwcPolicy_Kwc_PolicyText_Component extends Kwc_Abstract_Composite_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['rootElementClass'] = 'kwfUp-webStandard';
        $ret['componentName'] = trlKwfStatic('Policy Text');
        $ret['generators']['child']['component']['content'] = 'Kwc_Basic_Text_Component';
        $ret['extConfig'] = 'Kwf_Component_Abstract_ExtConfig_Form';
        return $ret;
    }

    public static function getPolicyText(Kwf_Component_Data $subroot, Kwf_Component_Renderer_Abstract $renderer)
    {
        $component = Kwf_Component_Data_Root::getInstance()->getComponentByClass(
            array('KwcPolicy_Kwc_PolicyText_Component'),
            array('subroot' => $subroot, 'limit' => 1)
        );
        if (!$component) throw new Kwf_Exception_Client('Could not find KwcPolicy_Kwc_PolicyText_Component');

        $helper = new Kwf_Component_View_Helper_Component();
        $helper->setRenderer($renderer);
        return $helper->component($component->getChildComponent('-content'));
    }
}
