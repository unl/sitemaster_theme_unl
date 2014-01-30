<?php
$type = '';
$title = 'Info';
switch ($context->type) {
    case \SiteMaster\Core\FlashBagMessage::TYPE_ERROR:
        $type = 'negate';
        $title = 'ERROR';
        break;
    case \SiteMaster\Core\FlashBagMessage::TYPE_SUCCESS:
        $type = 'affirm';
        $title = 'SUCCESS';
        break;
}
?>

<div class="wdn_notice overlay-maincontent <?php echo $type ?>">
    <div class="close">
        <a href="#" title="Close this notice">Close this notice</a>
    </div>
    <div class="message">
        <h4><?php echo $title ?></h4>
        <p><?php echo $context->message ?></p>
    </div>
</div>