
<div class="wdn_notice negate">
    <div class="close">
        <a href="#" title="Close this notice">Close this notice</a>
    </div>
    <div class="message">
        <h4>Validation Error</h4>
        <ul>
        <?php foreach ($context->messages as $element=>$message): ?>
            <li><a href="#<?php echo $element ?>"><?php echo $message ?></a></li>
        <?php endforeach ?>
        </ul>
    </div>
</div>