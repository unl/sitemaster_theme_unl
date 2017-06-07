<?php
$user = $context->getUser();
$roles = $context->getRoles();
?>
<li>
    <?php if ($user->provider === 'unl.edu'): ?>
        <a href="https://directory.unl.edu/people/<?php echo $user->uid ?>"><?php echo $user->getName(); ?></a> (<?php echo $user->uid ?>)
    <?php else: ?>
        <?php echo $user->getName(); ?>
    <?php endif; ?>
    
    <?php if ($roles->count()): ?>
        <ul>
            <?php foreach ($roles as $role): ?>
                <li><?php echo $role->getRole()->role_name;?></li>
            <?php endforeach; ?>
        </ul>
  <?php endif; ?>
</li>