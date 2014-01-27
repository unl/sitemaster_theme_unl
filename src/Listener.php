<?php
namespace SiteMaster\Plugins\Theme_Unl;

use SiteMaster\Core\Plugin\PluginListener;
use SiteMaster\Core\Events\RegisterTheme;

class Listener extends PluginListener
{
    public function onRegisterTheme(RegisterTheme $event)
    {
        if ($event->getTheme() == 'unl') {
            $event->setPlugin($this->plugin);
        }
    }
}