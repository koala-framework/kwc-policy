<?php

class KwcNotificationBox_Kwc_Box_Component extends Kwc_Abstract_Composite_Component
{
    public static function getSettings($param = null)
    {
        $ret = parent::getSettings($param);
        $ret['rootElementClass'] = 'kwfUp-webStandard';
        $ret['componentName'] = trlKwfStatic('NotificationBox');
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

        $privacyPolicyComponents = Kwf_Component_Data_Root::getInstance()->getComponentsByClass(
            'PoiDealerWebsitePlugin_Kwc_DealerContent_PrivacyPolicy_Component',
            array('subroot' => $this->getData()));
        $ret['privacyPolicyComponent'] = count($privacyPolicyComponents) ? $privacyPolicyComponents[0] : null;

        return $ret;
    }

    public static function getReplaceContent($componentClass, $dealer, $language, $dealerContentConfig, $content) {
        $output = preg_replace('/<!-- NonDealerContentStart -->.*?<!-- NonDealerContentEnd -->/s', '', $content);

        $url = "/dataprotection/1.0/{$dealer->country}/{$dealer->bnr}";
        $results = PoiDealerWebsitePlugin_AutohausApiCachedRequest::request($url);

        // get policy with lastEssentialModification closest to now
        $nextAlterationDate = date('c');
        $nextPolicyAlteration = '';
        if (is_array($results) && count($results) > 0) {
            foreach ($results as $result) {
                if (time() - strtotime($nextAlterationDate) < time() - strtotime($result['lastEssentialModification'])) {
                    $nextAlterationDate = $result['lastEssentialModification'];
                    $nextPolicyAlteration = $result;
                }
            }
        }

        // set date of last essential modification
        $nextAlterationDate = date("Y-m-d H:i:s", strtotime('2018-05-26'));
        $output = preg_replace('/(?<=data-date=").*?(?=")/', $nextAlterationDate, $output);

        // set essential modification text
        preg_match('/<!-- dataprivacyLink\((.*?)\) -->/s', $output, $dataprivacyLink);
        $essentialModificationText = str_replace('${dataprotection/dataprivacyLink}', $dataprivacyLink[1], $nextPolicyAlteration['essentialModificationText']);
        $output = preg_replace('/<!-- replaceWithDealerTextStart -->.*?<!-- replaceWithDealerTextEnd -->/s', $essentialModificationText, $output);

        return $output;
    }
}
