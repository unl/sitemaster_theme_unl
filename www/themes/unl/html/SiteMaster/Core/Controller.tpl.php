<?php
use UNL\Templates\Templates;

$page = Templates::factory('Fixed', Templates::VERSION_4_1);

$url     = \SiteMaster\Core\Config::get('URL');
$site_title = \SiteMaster\Core\Config::get('SITE_TITLE');

$page->doctitle     = '<title>' . $site_title . ' | University of Nebraska-Lincoln</title>';
$page->titlegraphic = $site_title;
$page->pagetitle     = '<h1>' . $context->output->getPageTitle() . '</h1>';
$page->breadcrumbs  = '
<ul>
    <li><a href="http://www.unl.edu/">UNL</a></li>
    <li>' . $site_title . '</li>
</ul>
';

$page->addScriptDeclaration('
    require(["idm"], function(idm) {
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

$page->maincontentarea = '<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(["_setAccount", "UA-3203435-18"]); //replace with your unique tracker id
_gaq.push(["_setDomainName", ".unl.edu"]);
_gaq.push(["_setAllowLinker", true]);
_gaq.push(["_trackPageview"]);
</script>';

$page->maincontentarea .= '<div class="'.strtolower(str_replace('\\', '_', $context->options['model'])).'">';
foreach ($app->getFlashBagMessages() as $message) {
    $page->maincontentarea .= $savvy->render($message);
}

if (isset($app->options['site_id'])) {
    $site = \SiteMaster\Core\Registry\Site::getByID($app->options['site_id']);
    if ($site) {
        $siteNav = \SiteMaster\Core\Plugin\PluginManager::getManager()->dispatchEvent(
            \SiteMaster\Core\Events\Navigation\SiteCompile::EVENT_NAME,
            new \SiteMaster\Core\Events\Navigation\SiteCompile($site)
        );

        $page->maincontentarea .= $savvy->render($siteNav);
    }
}

$prepend = \SiteMaster\Core\Plugin\PluginManager::getManager()->dispatchEvent(
    \SiteMaster\Core\Events\Theme\PrependOutput::EVENT_NAME,
    new \SiteMaster\Core\Events\Theme\PrependOutput($context->output->getRawObject(), $app->options['format'])
);

foreach ($prepend->getPrepend() as $item) {
    $page->maincontentarea .= $savvy->render($item);
}
$page->maincontentarea .= $savvy->render($context->output);
$page->maincontentarea .= '</div>';

$page->leftcollinks = '
<span role="heading" class="wdn-footer-heading">Related Links</span>
<ul>
<li><a href="http://wdn.unl.edu/">Web Developer Network</a></li>
<li><a href="http://iim.unl.edu/">Internet and Interactive Media</a></li>
<li><a href="http://ucomm.unl.edu/">University Communications</a></li>
<li><a href="http://its.unl.edu/">Information Technology Services</a></li>
</ul>';

echo $page;
