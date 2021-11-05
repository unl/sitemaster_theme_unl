<?php
$type = 'dcf-notice-info';
$title = 'Info';
switch ($context->type) {
    case \SiteMaster\Core\FlashBagMessage::TYPE_ERROR:
        $type = 'dcf-notice-danger';
        $title = 'ERROR';
        break;
    case \SiteMaster\Core\FlashBagMessage::TYPE_SUCCESS:
        $type = 'dcf-notice-success';
        $title = 'SUCCESS';
        break;
}
?>

<div class="dcf-notice <?php echo $type ?>" hidden>
    <h2><?php echo $title ?></h2>
    <div>
        <p><?php echo $context->message ?></p>
    </div>
</div>
