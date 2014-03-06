<?php
$previous_scan = $context->getPreviousScan();
$site = $context->getSite();
$pages = $context->getPages();
?>

<div class="scan">
    <header>
        <h2>Scan: <?php echo date("n-j-y g:i a", strtotime($context->start_time)); ?></h2>
        <div class="sub-info">
            Status: <?php echo $context->status;?>
            <?php
            if (!$context->isComplete()) {
                echo $savvy->render($context->getProgress());
            }
            ?>
        </div>
    </header>
    <?php
    if (!$context->isComplete()) {
        ?>
        <div class="panel notice">
            This scan has not finished yet.  This page will automatically refresh when the scan has completed.
        </div>
    <?php
    }
    ?>
    <section class="wdn-grid-set dashboard-metrics">
        <div class="bp1-wdn-col-one-third">
            <div class="visual-island gpa">
                <span class="dashboard-value"><?php echo $context->gpa ?></span>
                <span class="dashboard-metric">GPA</span>
            </div>
        </div>
        <div class="bp1-wdn-col-one-third">
            <div class="visual-island">
                <span class="dashboard-value"><?php echo $context->getABSNumberOfChanges() ?></span>
                <span class="dashboard-metric">Changes</span>
            </div>
        </div>
        <div class="bp1-wdn-col-one-third">
            <div class="visual-island">
                <span class="dashboard-value"><?php echo $pages->count() ?></span>
                <span class="dashboard-metric">Pages</span>
            </div>
        </div>
    </section>
    
    <section>
        <?php
        if ($previous_scan) {
            echo $savvy->render($context->getChangedMetricGrades());
        } else {
            //This is the first scan, don't the change list would probably be huge
            ?>
            <p class="change-list-first">
                Normally, a list of changes would be here.  However, this is the first time that we scanned your site.  In the future, you can see changes here.
            </p>
        <?php
        }
        ?>

        <div class="wdn-grid-set">
            <div class="bp1-wdn-col-one-third">
                <section class="hot-spots info-section">
                    <header>
                        <h3>Hot Spots</h3>
                        <div class="subhead">
                            These are areas on your site that need some love
                        </div>
                    </header>
                    <?php
                    foreach ($plugin_manager->getMetrics() as $metric) {
                        $metric_record = $metric->getMetricRecord();
                        $grades = $context->getHotSpots($metric_record->id);
                        ?>
                        <h4><?php echo $metric->getName()?></h4>
                        <?php echo $savvy->render($grades); ?>
                    <?php
                    }
                    ?>
                </section>
            </div>
            <div class="bp1-wdn-col-two-thirds">
                <?php
                echo $savvy->render($pages);
                ?>

            </div>
        </div>
    </section>
</div>
