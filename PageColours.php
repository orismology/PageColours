<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\PageColours;

use Piwik\Plugin;
use Piwik\Plugins\PageColours\API as PCAPI;

/**
 */
class PageColours extends \Piwik\Plugin
{

public function getListHooksRegistered()
    {
        return array(
            'AssetManager.getStylesheetFiles' => 'getStylesheetFiles',
            'Settings.PageColours.settingsUpdated' => 'refreshColours'
        );
        
    }
    

    
 public function refreshColours() 
	{
	
	$settings = new Settings('PageColours');
    $default  = $settings->defaultColour->getValue();
    $custom  = $settings->customColours->getValue();
	
	$colourlist = scandir('plugins/PageColours/assets/icons/');
	
	$default = $colourlist[$default];
	
	
    $rules = json_decode($custom,true);
    if($rules == null){
    $rules = array();}
    
    
    $css = 
'#visitsLive .settings img[src*=\'plugins/Live/images/file\'] {
     content:url(../assets/icons/'.$default.');
}
';

	foreach($rules as $match => $rule) {
	
	if ($rule[0] != "=") { $rule[0]=substr($rule[0],0,1)."="; }
	
	$cssrule = '#visitsLive .settings a[href'.$rule[0].'"'.$match.'"] img{
     content:url(../assets/icons/'.$rule[1].');
}
';
	
	$css = $css.$cssrule;
	}

    file_put_contents ('plugins/PageColours/styles/style.css',$css);

	}
    
 public function getStylesheetFiles(&$stylesheets)
    {
    
      $stylesheets[] = "plugins/PageColours/styles/style.css";
      $stylesheets[] = "plugins/PageColours/styles/pagecolours.css";
    }

}
