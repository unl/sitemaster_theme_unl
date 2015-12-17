<div class="wdn-grid-set wdn-footer-links-local">
    <div class="bp960-wdn-col-two-thirds">
        <div class="wdn-footer-module">
            <span role="heading" class="wdn-footer-heading">About UNL MediaHub</span>
            <?php
            if ($file = @file_get_contents(\SiteMaster\Core\Util::getRootDir() . '/tmp/iim-app-footer.html')) {
                echo $file;
            } else {
                echo file_get_contents('http://iim.unl.edu/iim-app-footer?format=partial');
            }
            ?>
            <p>
                UNL WebAudit is administrated by the <a href="http://wdn.unl.edu/wdn-shared-governance-board-0">WDN Governance Board</a>.
            </p>
        </div>
    </div>
    <div class="bp960-wdn-col-one-third">
        <div class="wdn-footer-module">
            <span role="heading" class="wdn-footer-heading">Related Links</span>
            <ul class="wdn-related-links-v1">
                <li><a href="http://wdn.unl.edu/">Web Developer Network</a></li>
                <li><a href="http://iim.unl.edu/">Internet and Interactive Media</a></li>
                <li><a href="http://ucomm.unl.edu/">University Communications</a></li>
                <li><a href="http://its.unl.edu/">Information Technology Services</a></li>
            </ul>
        </div>
    </div>
</div>

<script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(["_setAccount", "UA-3203435-18"]); //replace with your unique tracker id
    _gaq.push(["_setDomainName", ".unl.edu"]);
    _gaq.push(["_setAllowLinker", true]);
    _gaq.push(["_trackPageview"]);
</script>
