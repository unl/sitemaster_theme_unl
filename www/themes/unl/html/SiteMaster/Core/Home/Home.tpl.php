<p>
    Web Audit helps you maintain your site by running automatic audits that help you find and fix problems that affect user experience. We also provides a <a href="<?php echo $base_url . 'registry/' ?>">registry</a> of sites, which can be used as a WHOIS service or as a source of role assignments that can be used by other systems like <a href="http://ucommchat.unl.edu/">UNLchat</a>.
</p>
<p>
    <?php if ($user): ?>
        <a href="<?php echo $user->getURL() ?>" class="wdn-button">My sites</a>
    <?php else: ?>
        <a href="<?php echo $base_url ?>auth/unl/" class="wdn-button">My sites</a>
    <?php endif; ?>
    <a href="<?php echo $base_url ?>registry/" class="wdn-button">Find a site</a>
    <?php if ($user): ?>
        <a href="<?php echo $base_url ?>sites/add/" class="wdn-button">Add a site</a>
    <?php else: ?>
        <a href="<?php echo $base_url ?>auth/unl/?r=<?php echo urlencode($base_url . 'sites/add/') ?>" class="wdn-button">Add a site</a>
    <?php endif; ?>
</p>

<?php if (!$user): ?>
    <p>
        <a href="<?php echo $base_url ?>auth/shib/" class="wdn-button">Log in from a different institution</a>
        or
        <a href="<?php echo $base_url ?>auth/google/" class="wdn-button">Log in with Google</a>
    </p>
<?php endif ?>

<div class="wdn-grid-set">
    <div class="wdn-col-one-half">
        <h2>We are open for business!</h2>
        <p>Web Audit now supports federated login! If your institution participates in <a href="https://www.incommon.org/">InCommon</a> you can use Web Audit to start improving your sites! You can scan up to <?php echo \SiteMaster\Core\Config::getForGroup('default', 'SCAN_PAGE_LIMIT') ?> pages per site and you will have access to the following metrics.</p>

        <ul>
            <li>HTML Validation via the <a href="https://validator.w3.org/">w3c validator</a></li>
            <li>Broken link scanning</li>
            <li>Accessibility via <a href="https://github.com/dequelabs/axe-core">aXe core</a></li>
            <li>Performance testing via <a href="https://developers.google.com/speed/pagespeed/">Google PageSpeed Insights</a></li>
            <li>SEO auditing</li>
            <li>Spelling (beta)</li>
        </ul>

        <p>If you have any questions, need a higher page limit, or need any customizations, please <a href="mailto:mfairchild@unl.edu">e-mail us</a>.</p>
    </div>
    <div class="wdn-col-one-half">
        <h2>Features</h2>
        <dl>
            <dt>Audit your site against these metrics</dt>
            <dd>Link checking, accessibility, PageSpeed Insights, Spelling, SEO, and HTML Validation.</dd>
            <dt>Groups</dt>
            <dd>Custom groups can be defined for your sites, which allows for custom plugins, metrics, and configuration.</dd>
            <dt>Headless browser testing</dt>
            <dd>Our metrics use a headless browser so that modifications to the dom via JavaScript and CSS are accounted for.</dd>
            <dt>Registry</dt>
            <dd>In large organizations, it can be easy to lose track of who works on what. The registry allows assigning users with specific roles to each site, as well as an API so that other systems can integrate with it.</dd>
            <dt>Overrides</dt>
            <dd>Sometimes a notice or error is not actually a problem. We let you override them so they don't appear in future scans.</dd>
            <dt>Monthly scans</dt>
            <dd>Your sites are automatically scanned once a month, and you will receive an email if anything has changed. You can also see changes over time for each metric.</dd>
            <dt>Feature analytics</dt>
            <dd>As we scan your sites we collect data on classes and HTML elements that were found. This allows you to be informed about what is being used on your sites.</dd>
        </dl>
    </div>
</div>

<h2>Why Audit?</h2>
<div class="wdn-grid-set">
    <div class="bp1-wdn-col-two-thirds">
        <dl>
            <dt>
                TO ENSURE CONSISTENT EXPERIENCE.
            </dt>
            <dd>
                UNL’s web quality assurance effort provides developers with information needed to maintain a consistent, high-quality user experience for site visitors.
            </dd>
            <dt>
                TO ENSURE DEVICE COMPATIBILITY.
            </dt>
            <dd>
                By maintaining high compliance to international standards for code validity, unl.edu is usable on all modern, standards-compliant browsers.
            </dd>
            <dt>
                TO DO THE RIGHT THING.
            </dt>
            <dd>
                The UNLedu Web Framework, as delivered to developers, is in compliance with current web accessibility standards and laws, and incorporates some technologies that provide additional benefit to persons using assistive technologies. The framework also incorporates integrations with UNL’s single sign-on service for authentication. By ensuring that your sites meet these international standards and laws, you will ensure that everyone has equal access to the information and services you provide.
            </dd>
            <dt>
                TO MAKE WEBSITES AWESOME
            </dt>
            <dd>
                By using Web Audit, you will ensure that your site is of the highest quality. You will be notified when problems that could frustrate visitors arise.
            </dd>
        </dl>
    </div>
    <div class="bp1-wdn-col-one-third">
        <figure class="wdn-frame">
            <img src="<?php echo $base_url ?>plugins/theme_unl/www/themes/unl/html/images/example-scan.png" alt="An example report that was generated by web audit." />
            <figcaption>
                An example report that was generated by Web Audit
            </figcaption>
        </figure>
    </div>
</div>
