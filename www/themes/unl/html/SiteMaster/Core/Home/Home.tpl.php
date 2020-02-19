<div class="dcf-pb-8 dcf-w-max-lg">
  <p class="dcf-txt-lg">Web Audit helps you maintain your site by running automatic audits that help you find and fix problems that affect user experience. We also provides a <a href="<?php echo $base_url . 'registry/' ?>">registry</a> of sites, which can be used as a <abbr class="dcf-txt-sm" title="who is">WHOIS</abbr> service or as a source of role assignments that can be used by other systems like <a href="https://ucommchat.unl.edu/">UNLchat</a>.</p>
  <div class="dcf-mt-4">
      <?php if ($user): ?>
          <a class="dcf-btn dcf-btn-secondary" href="<?php echo $user->getURL() ?>">My sites</a>
      <?php else: ?>
          <a class="dcf-btn dcf-btn-secondary" href="<?php echo $base_url ?>auth/unl/">My sites</a>
      <?php endif; ?>
      <a class="dcf-btn dcf-btn-secondary" href="<?php echo $base_url ?>registry/">Find a site</a>
      <?php if ($user): ?>
          <a class="dcf-btn dcf-btn-secondary" href="<?php echo $base_url ?>sites/add/">Add a site</a>
      <?php else: ?>
          <a class="dcf-btn dcf-btn-secondary" href="<?php echo $base_url ?>auth/unl/?r=<?php echo urlencode($base_url . 'sites/add/') ?>">Add a site</a>
      <?php endif; ?>
  </div>
  <?php if (!$user): ?>
      <div class="dcf-mt-4">
          <a class="dcf-btn dcf-btn-secondary" href="<?php echo $base_url ?>auth/shib/">Log in from a different institution</a>
          <span class="dcf-mr-2 dcf-ml-2 dcf-txt-xs dcf-italic unl-dark-gray">or</span>
          <a class="dcf-btn dcf-btn-secondary" href="<?php echo $base_url ?>auth/google/">Log in with Google</a>
      </div>
  <?php endif ?>
</div>
<div class="dcf-bleed dcf-wrapper dcf-pt-9 dcf-pb-9 unl-bg-lightest-gray">
    <div class="dcf-w-max-lg">
        <h2 class="dcf-txt-h3 dcf-mb-2">Web Audit now supports federated login</h2>
        <p>If your institution participates in <a href="https://www.incommon.org/">InCommon</a> you can use Web Audit to start improving your sites. You can scan up to <?php echo \SiteMaster\Core\Config::getForGroup('default', 'SCAN_PAGE_LIMIT') ?> pages per site and you will have access to the following metrics.</p>
        <ul>
            <li><abbr class="dcf-txt-sm" title="Hypertext Markup Language">HTML</abbr> validation via the <a href="https://validator.w3.org/">W3C validator</a></li>
            <li>Broken link scanning</li>
            <li>Accessibility via <a href="https://github.com/dequelabs/axe-core">aXe core</a></li>
            <li>Performance via <a href="https://developers.google.com/speed/pagespeed/">Google PageSpeed Insights</a></li>
            <li><abbr class="dcf-txt-sm" title="Search Engine Optimization">SEO</abbr> auditing</li>
            <li>Spelling <small class="dcf-badge dcf-badge-roundrect unl-font-sans">beta</small></li>
        </ul>
        <p>If you have any questions, need a higher page limit, or need any customizations, please <a href="mailto:dxg@listserv.unl.edu">e-mail us</a>.</p>
    </div>
</div>
<div class="dcf-pt-9 dcf-pb-9">
    <h2 class="dcf-txt-h3 dcf-mb-2" id="features-heading">Features</h2>
    <dl class="dcf-columns-auto dcf-mb-0" aria-labelledby="features-heading">
        <dt>Audit your site against these metrics</dt>
        <dd>Link checking, accessibility, PageSpeed Insights, spelling, <abbr class="dcf-txt-sm" title="Search Engine Optimization">SEO</abbr>, and <abbr class="dcf-txt-sm" title="Hypertext Markup Language">HTML</abbr> validation.</dd>
        <dt>Groups</dt>
        <dd>Custom groups can be defined for your sites, which allows for custom plugins, metrics, and configuration.</dd>
        <dt>Headless browser testing</dt>
        <dd>Our metrics use a headless browser so that modifications to the <abbr class="dcf-txt-sm" title="Document Object Model">DOM</abbr> via JavaScript and <abbr class="dcf-txt-sm" title="Cascading Stylesheets">CSS</abbr> are accounted for.</dd>
        <dt>Registry</dt>
        <dd>In large organizations, it can be easy to lose track of who works on what. The registry allows assigning users with specific roles to each site, as well as an <abbr class="dcf-txt-sm" title="Application Programming Interface">API</abbr> so that other systems can integrate with it.</dd>
        <dt>Overrides</dt>
        <dd>Sometimes a notice or error is not actually a problem. We let you override them so they don&rsquo;t appear in future scans.</dd>
        <dt>Monthly scans</dt>
        <dd>Your sites are automatically scanned once a month, and you will receive an email if anything has changed. You can also see changes over time for each metric.</dd>
        <dt>Feature analytics</dt>
        <dd>As we scan your sites we collect data on classes and <abbr class="dcf-txt-sm" title="Hypertext Markup Language">HTML</abbr> elements that were found. This allows you to be informed about what is being used on your sites.</dd>
    </dl>
</div>
<div class="dcf-bleed dcf-wrapper dcf-pt-9 dcf-pb-9 unl-bg-lightest-gray">
    <h2 class="dcf-txt-h3 dcf-mb-2" id="why-audit-heading">Why audit?</h2>
    <div class="dcf-grid dcf-col-gap-vw dcf-row-gap-5">
        <div class="dcf-col-100% dcf-col-67%-start@md">
            <dl class="dcf-mb-0" aria-labelledby="why-audit-heading">
                <dt>To ensure consistent experience</dt>
                <dd>University of Nebraska&ndash;Lincoln&rsquo;s web quality assurance effort provides developers with information needed to maintain a consistent, high-quality user experience for site visitors.</dd>
                <dt>To ensure device compatibility</dt>
                <dd>By maintaining high compliance to international standards for code validity, unl.edu is usable on all modern, standards-compliant browsers.</dd>
                <dt>To do the right thing</dt>
                <dd>The UNLedu Web Framework, as delivered to developers, is in compliance with current web accessibility standards and laws, and incorporates some technologies that provide additional benefit to persons using assistive technologies. The framework also incorporates integrations with Nebraska&rsquo;s single sign-on service for authentication. By ensuring that your sites meet these international standards and laws, you will ensure that everyone has equal access to the information and services you provide.</dd>
                <dt>To make websites awesome</dt>
                <dd>By using Web Audit, you will ensure that your site is of the highest quality. You will be notified when problems that could frustrate visitors arise.</dd>
            </dl>
        </div>
        <div class="dcf-col-100% dcf-col-33%-end@md">
            <figure>
                <img class="dcf-w-100% dcf-b-1 dcf-b-solid unl-b-light-gray" src="<?php echo $base_url ?>plugins/theme_unl/www/themes/unl/html/images/example-scan.png" alt="An example report that was generated by Web Audit.">
                <figcaption class="dcf-figcaption">An example report that was generated by Web Audit</figcaption>
            </figure>
        </div>
    </div>
</div>
