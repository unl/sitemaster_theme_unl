<div class="dcf-notice dcf-notice-danger" hidden>
    <h2>Validation Error</h2>
    <div>
        <ul>
        <?php foreach ($context->messages as $element=>$message): ?>
            <li><a href="#<?php echo $element ?>"><?php echo $message ?></a></li>
        <?php endforeach ?>
        </ul>
    </div>
</div>
