<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\PageColours;


use Piwik\Settings\SystemSetting;

/**
 * Defines Settings for PageColours.
 *
 * Usage like this:
 * $settings = new Settings('PageColours');
 * $settings->autoRefresh->getValue();
 * $settings->defaultColour->getValue();
 *
 */
class Settings extends \Piwik\Plugin\Settings
{
    /** @var UserSetting */
    public $defaultColour;

    /** @var UserSetting */
    public $customColours;
    

    protected function init()
    {    	

        $this->setIntroduction('Here you can define custom page colours. The following are per-user settings.');

        // Default Colours
        $this->createdefaultColourSetting();

        // Additional Colours
        $this->createcustomColoursSetting();
        
    }
    

    private function createdefaultColourSetting()
    {
        $this->defaultColour        = new SystemSetting('defaultColour', 'Default page colour');
        $this->defaultColour->readableByCurrentUser = true;
        $this->defaultColour->type  = static::TYPE_STRING;
        $this->defaultColour->uiControlType = static::CONTROL_SINGLE_SELECT;
        $this->defaultColour->availableValues  = array_diff(scandir('plugins/PageColours/assets/icons/'), array('..', '.'));;
		$this->defaultColour->inlineHelp = 
'Add new colours by adding files to: /piwik/plugins/PageColours/assets/icons/';
        $this->addSetting($this->defaultColour);
    }

    private function createcustomColoursSetting()
    {
        $this->customColours = new SystemSetting('customColours', 'Custom page colours');
        $this->customColours->readableByCurrentUser = true;
        $this->customColours->uiControlType = static::CONTROL_TEXTAREA;
        $this->customColours->inlineHelp = 
'A JSON encoded string of custom page colours.
Use the following format:
        
{
    "string to match": [
        "match type",
        "colour"
    ],
    "second string": [
        "match type",
        "colour"
    ]
}

Match Types:
= matches url exatly (including http:// and domain)
~ matches any of a whitespace-separated list of urls exactly
^ matches urls that start with string
$ matches urls the end with string
* matches urls that contain string

For colour, use the file name of the icon file in piwik/plugins/PageColours/assets/icons/ (also shown in select list above)';
        $this->addSetting($this->customColours);
    }

  
}
