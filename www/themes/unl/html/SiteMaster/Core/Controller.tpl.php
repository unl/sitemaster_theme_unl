<?php
use UNL\Templates\Templates;

$page = Templates::factory('Fixed', Templates::VERSION_4_1);

$wdn_include_path = \SiteMaster\Core\Util::getRootDir();
if (file_exists($wdn_include_path . '/wdn/templates_4.1')) {
    $page->setLocalIncludePath($wdn_include_path);
}


$url     = \SiteMaster\Core\Config::get('URL');
$site_title = \SiteMaster\Core\Config::get('SITE_TITLE');

//Titles
$page->doctitle = '<title>' . $site_title . ' | University of Nebraska-Lincoln</title>';
$page->titlegraphic = $site_title;
$page->pagetitle = '<h1>' . $context->output->getPageTitle() . '</h1>';
$page->affiliation = '';

//Navigation
$page->breadcrumbs  = '
<ul>
    <li><a href="http://www.unl.edu/">Nebraska</a></li>
    <li><a href="' . $url . '">' . $site_title . '</a></li>
    <li>' . $context->output->getPageTitle() . '</li>
</ul>
';

$mainNav = \SiteMaster\Core\Plugin\PluginManager::getManager()->dispatchEvent(
    \SiteMaster\Core\Events\Navigation\MainCompile::EVENT_NAME,
    new \SiteMaster\Core\Events\Navigation\MainCompile()
);

$page->navlinks = '<ul>' . $savvy->render($mainNav) . '</ul>';

//Head
if ($user = \SiteMaster\Core\User\Session::getCurrentUser()) {
    $plugin = \SiteMaster\Core\User\Session::getCurrentAuthProviderPlugin();
    $page->addScriptDeclaration('
        require(["idm"], function(idm) {
          idm.setLoginURL("' . $plugin->getLoginURL() . '");
          idm.setLogoutURL("' . $plugin->getLogoutURL(). '");
        });
    ');
    
    if ($plugin->getProviderMachineName() !== 'unl.edu') {
        $page->addScriptDeclaration('
            require(["idm"], function(idm) {
              idm.displayNotice("'.$user->getName(true).'");
            });
        ');
    }
} else {
    //No one is logged in
    $page->addScriptDeclaration('
        require(["idm"], function(idm) {
          idm.setLoginURL("' . $url . 'auth/unl/");
          idm.setLogoutURL("' . $url . 'auth/unl/logout/");
        });
    ');
}

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


//Main Content
$page->maincontentarea = '<div class="wdn-band"><div class="wdn-inner-wrapper">';

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
$page->maincontentarea .= '</div></div></div>';

//Footer
$page->leftcollinks = $savvy->render($context, 'SiteMaster/Core/localfooter.tpl.php');

echo $page;
