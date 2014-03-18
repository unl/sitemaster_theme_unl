A UNL Theme for SiteMaster
====================

To install, simply clone the repository into the sitemaster/plugins directory:

`git clone git@github.com:unl/sitemaster_theme_unl.git theme_unl`

Modify `config.inc.php` to set the UNL theme:

`Config::set('THEME', 'unl');`

add a line to the PLUGINS config for the `theme_unl` plugin you just cloned.

`'theme_unl' => array(),`

Then, install the plugin by running `php scripts/install.php` which will install any dependencies and add
it to the list of installed plugins.
