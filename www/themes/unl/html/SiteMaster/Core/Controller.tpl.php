<?php
use UNL\Templates\Templates;

$page = Templates::factory('Fixed', Templates::VERSION_5);

$wdn_include_path = \SiteMaster\Core\Util::getRootDir();
if (file_exists($wdn_include_path . '/wdn/templates_5.0')) {
    $page->setLocalIncludePath($wdn_include_path);
}

$url     = \SiteMaster\Core\Config::get('URL');
$site_title = \SiteMaster\Core\Config::get('SITE_TITLE');

//Titles
$page->doctitle = '<title>' . $site_title . ' | University of Nebraska-Lincoln</title>';
$page->titlegraphic = '<a class="dcf-txt-h5" href="' . $url . '">' . $site_title . '</a>';
$page->pagetitle = '<h1>' . $context->output->getPageTitle() . '</h1>';
$page->affiliation = '';

// Add WDN Deprecated Styles
$page->head .= '<link rel="preload" href="https://unlcms.unl.edu/wdn/templates_5.0/css/deprecated.css" as="style" onload="this.onload=null;this.rel=\'stylesheet\'"> <noscript><link rel="stylesheet" href="https://unlcms.unl.edu/wdn/templates_5.0/css/deprecated.css"></noscript>';

//Navigation
$page->breadcrumbs  = '
<ol>
    <li><a href="http://www.unl.edu/">Nebraska</a></li>
    <li><a href="' . $url . '">' . $site_title . '</a></li>
    <li>' . $context->output->getPageTitle() . '</li>
</ol>
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

    // idm.displayNotice not in version 5 of idm
    /*
    if ($plugin->getProviderMachineName() !== 'unl.edu') {
        $page->addScriptDeclaration('
            require(["idm"], function(idm) {
              idm.displayNotice("'.$user->getName(true).'");
            });
        ');
    }
    */
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
$page->maincontentarea = '<div class="dcf-bleed dcf-pb-8"><div class="dcf-wrapper">';

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
$page->contactinfo = $savvy->render($context, 'SiteMaster/Core/localfooter.tpl.php');

$page->addScriptDeclaration(
    "(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-3203435-18', 'auto');
ga('send', 'pageview');");

// Render any dynamic body src scripts loaded for page
foreach($savvy->getScripts($savvy::SCRIPT_LOCATION_ANY) as $script) {
    if ($script instanceof SiteMaster\Core\Script) {
        $page->addScript($script->url(), $script->type(), $script->appendToHead());
    }
}

// Render any dynamic body script declarartions loaded for page
foreach($savvy->getScriptDeclarations($savvy::SCRIPT_LOCATION_ANY) as $script) {
    if ($script instanceof SiteMaster\Core\ScriptDeclaration) {
        $page->addScriptDeclaration($script->content(), $script->type(), $script->appendToHead());
    }
}

echo $page;
