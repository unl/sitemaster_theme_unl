<?php
$scan = $context->page->getScan();
$metric_grades = $context->page->getMetricGrades();
?>
<header class="page-scan-header">
    <div class="letter-grade-container">
        <span class="letter-grade unknown"><?php echo $context->page->letter_grade ?></span>
    </div>
    <div class="details">
        <span class="title">Page: <?php echo $context->page->getTitle(); ?></span>
        <span class="page-url">
            Scanned URL:
            <?php echo $context->page->uri ?>
        </span>
    </div>
</header>

<div class="dcf-grid">
    <div class="dcf-col-100% dcf-col-33%-start@md">
        <section class="in-page-nav info-section">
            <div>
                <header>
                    <h2>Scan Information</h2>
                </header>
                <ul>
                    <li><span class="scan-status">Status: <?php echo $context->page->status ?></span></li>
                    <li><span class="scanned-date">Scanned on: <?php echo $context->page->start_time ?></span></li>
                    <?php
                    if ($context->page->end_time) {
                        $start_date = new DateTime($context->page->start_time);
                        $end_date = new DateTime($context->page->end_time);
                        $dd = date_diff($end_date, $start_date);
                        echo '<li>Duration: '.$dd->format('%H:%I:%S') . '</li>';
                    }
                    ?>
                </ul>
            </div>
            <div>
                <header>
                    <h2>Links</h2>
                </header>
                <ul>
                    <li><a href="<?php echo $scan->getURL() ?>">Go back to the site scan</a></li>
                    <li><a href="<?php echo $context->page->uri; ?>" target="_blank">Go to the page <img
                                src="<?php echo \SiteMaster\Core\Config::get('URL') ?>www/images/external.png"
                                alt="link to external site"/></a></li>
                    <li><a href="<?php echo $context->getURL() . 'links-to-this/' ?>">View pages that link to this
                            page</a></li>
                </ul>
                <?php echo $savvy->render($context->page->getScanForm()) ?>
            </div>
        </section>
    </div>

    <div class="dcf-col-100% dcf-col-67%-end@md">
	    <?php if (!$context->page->isComplete()): ?>
            <div class="panel notice">
                <img src="<?php echo $base_url . 'www/images/loading.gif' ?>" alt="Page scan in process" aria-hidden="true" />
                The scan for this page has not finished yet.  This page will automatically refresh every ten seconds until page scan is complete.
            </div>
            <script>
              setTimeout(function() { location.reload(); }, 10000);
            </script>
	    <?php endif; ?>

        <section class="page-scan-content">
            <header>
                <h2>Metric Grades</h2>
            </header>
            <?php
            echo $savvy->render($metric_grades);
            ?>
        </section>
        <div class="page-scan-scoring">
            <h2>Scoring</h2>
            <table>
                <thead>
                <tr>
                    <th>Metric</th>
                    <th>Weighted Score</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($metric_grades as $metric_grade) {
                    
                    $name = 'unknown';
                    $metric_record = $metric_grade->getMetric();
                    if ($metric_record && $metric_object = $metric_record->getMetricObject()) {
                        $name = $metric_object->getName();
                    }
                    ?>
                    <tr>
                        <td><?php echo $name ?></td>
                        <td>
                            <?php if ('0.00' === $metric_grade->weight): ?>
                                Does not count toward the page grade
                            <?php else: ?>
                                <?php echo $metric_grade->weighted_grade ?>
                            <?php endif; ?>
                            
                        </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <td>
                        Total:
                    </td>
                    <td class="total">
                        <?php echo $context->page->point_grade ?>/<?php echo $context->page->points_available ?>
                        = <?php echo $context->page->letter_grade ?>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>