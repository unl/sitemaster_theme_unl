<?php
\UNL_Templates::$options['version']        = 4.0;
\UNL_Templates::$options['sharedcodepath'] = dirname(__FILE__).'/sharedcode';

$url     = \SiteMaster\Core\Config::get('URL');

$page    = UNL_Templates::factory('Fixed');

$page->doctitle     = '<title>SiteMaster | University of Nebraska-Lincoln</title>';
$page->titlegraphic = 'SiteMaster';
$page->pagetitle     = '<h1>' . $context->output->getPageTitle() . '</h1>';
$page->breadcrumbs  = '
<ul>
    <li><a href="http://www.unl.edu/">UNL</a></li>
    <li>SiteMaster</li>
</ul>
';

$page->addScriptDeclaration('
    WDN.jQuery(function() {
      WDN.setPluginParam("idm", "login", "' . $url . 'auth/unl/");
      WDN.setPluginParam("idm", "logout","' . $url . 'auth/unl/logout/");
    });
');

$scripts_event = \SiteMaster\Core\Plugin\PluginManager::getManager()->dispatchEvent(
    \SiteMaster\Core\Events\Theme\RegisterScripts::EVENT_NAME,
    new \SiteMaster\Core\Events\Theme\RegisterScripts()
);

foreach ($scripts_event->getScripts() as $url=>$type) {
    $page->addScript($url, $type);
}

$style_sheets_event = \SiteMaster\Core\Plugin\PluginManager::getManager()->dispatchEvent(
    \SiteMaster\Core\Events\Theme\RegisterStyleSheets::EVENT_NAME,
    new \SiteMaster\Core\Events\Theme\RegisterStyleSheets()
);

foreach ($style_sheets_event->getStyleSheets() as $url=>$media) {
    $page->addStyleSheet($url, $media);
}

$mainNav = \SiteMaster\Core\Plugin\PluginManager::getManager()->dispatchEvent(
    \SiteMaster\Core\Events\Navigation\MainCompile::EVENT_NAME,
    new \SiteMaster\Core\Events\Navigation\MainCompile()
);

$page->navlinks = '<ul>' . $savvy->render($mainNav) . '</ul>';

$page->loadSharedCodeFiles();

$page->maincontentarea = '<div class="'.strtolower(str_replace('\\', '_', $context->options['model'])).'">';
$page->maincontentarea .= $savvy->render($context->output);
$page->maincontentarea .= '</div>';

echo $page;
