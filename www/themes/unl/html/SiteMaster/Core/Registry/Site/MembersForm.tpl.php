<?php echo $savvy->renderWithParent($context); ?>
<?php if ('unl' === $context->site->group_name): ?>
    <?php echo $savvy->render($context, 'SiteMaster/Core/Registry/Site/integration-notes.tpl.php') ?>
<?php endif; ?>
