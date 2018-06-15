# kwc-notification-box

## Notification Box
Provides a Popup which ca be used to show changes for website users. Disappears when a user closes the box or after 30 days.

Has to be included as a box and made editable:
```
$ret['generators']['notificationBox'] = array(
    'class' => 'Kwf_Component_Generator_Box_Static',
    'component' => 'KwcPolicy_Kwc_NotificationBox_Component',
    'inherit' => true,
    'unique' => true,
);
$ret['editComponents'][] = 'notificationBox';
```

## Policy Text
Provides a component which can be used to assign a centralized text with a link to the policy page.

Has to be included in the Root-Component (no box!) and made editable:
```
$ret['generators']['policyText'] = array(
    'class' => 'Kwf_Component_Generator_Static',
    'component' => 'KwcPolicy_Kwc_PolicyText_Component',
);
$ret['editComponents'][] = 'policyText';
```

* Usage in a non-Frontend-Form-Component:
    In getTemplateVars() just call the following:
    ```
    $ret['policyText'] = KwcPolicy_Kwc_PolicyText_Component::getPolicyText($this->getData(), $renderer);
    ```
* Usage in a Field of a Frontend-Form-Component:
    1. Add the field where the text should appear as usual when defining the frontend form but leave the text empty:
        ```
        $this->add(new Kwf_Form_Field_Checkbox('terms_and_conditions'))
            ->setAllowBlank(false)
            ->setHideLabel(true);
        ```
    2. In getTemplateVars() before calling parent you have to set the Text:
        ```
        $policyText = KwcPolicy_Kwc_PolicyText_Component::getPolicyText($this->getData(), $renderer);
        $this->getForm()->fields->getByName('terms_and_conditions')
            ->setBoxLabel($policyText);
        ```
