<?php
namespace SiteMaster\Plugins\Theme_unl;

use SiteMaster\Core\Plugin\PluginListener;
use SiteMaster\Core\Events\RegisterTheme;
use SiteMaster\Core\Events\Theme\RegisterScripts;
use SiteMaster\Core\Events\Theme\RegisterStyleSheets;
use SiteMaster\Core\Config;

class Listener extends PluginListener
{
    public function onRegisterTheme(RegisterTheme $event)
    {
        if ($event->getTheme() == 'unl') {
            $event->setPlugin($this->plugin);
        }
    }

    /**
     * @param RegisterStyleSheets $event
     */
    public function onThemeRegisterStyleSheets(RegisterStyleSheets $event)
    {
        if (Config::get('THEME') != 'unl') {
            return;
        }

        $event->addStyleSheet(Config::get('URL') . 'plugins/theme_unl/www/themes/unl/html/css/all.css');
    }

    /**
     * @param \SiteMaster\Core\Events\Theme\RegisterScripts $event
     */
    public function onThemeRegisterScripts(RegisterScripts $event)
    {
        if (Config::get('THEME') != 'unl') {
            return;
        }

        //Remove the modernizer script that is set by core.  It breaks our templates
        $event->removeScript(Config::get('URL') . 'www/js/vendor/modernizr.js');

        //Add scripts
        $event->addScript(Config::get('URL') . 'plugins/theme_unl/www/themes/unl/html/js/all.js');
    }
}