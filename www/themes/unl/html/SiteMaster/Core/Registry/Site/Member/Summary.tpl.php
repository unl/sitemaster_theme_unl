<?php
$user = $context->getUser();
$roles = $context->getRoles();
?>
<li>
    <a href="https://directory.unl.edu/people/<?php echo $user->uid ?>"><?php echo $user->getName(); ?></a> (<?php echo $user->uid ?>)
    <?php if ($roles->count()): ?>
        <ul>
            <?php foreach ($roles as $role): ?>
                <li><?php echo $role->getRole()->role_name;?></li>
            <?php endforeach; ?>
        </ul>
  <?php endif; ?>
</li>