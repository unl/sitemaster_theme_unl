A UNL Theme for SiteMaster
====================

To install, simply clone the repository into the sitemaster/plugins directory:

`git clone git@github.com:unl/sitemaster_theme_unl.git theme_unl`

Modify `config.inc.php` to set the UNL theme:

`Config::set('THEME', 'unl');`

add a line to the PLUGINS config for the `theme_unl` plugin you just cloned.

`'theme_unl' => [],`

The wdn folder containing the templates_#.# should be symlinked to `./wdn` in the root of your project 

Then, install the plugin by running `php scripts/install.php` which will install any dependencies and add
it to the list of installed plugins.

To get the latest version of the framework includes, you will need to follow the [instructions to sync the UNLedu Framework](https://wdn.unl.edu/documentation/synchronizing-unledu-web-framework).
