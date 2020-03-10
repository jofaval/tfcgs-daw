<?php

function test($name, $condition)
{
    ?>
<p>El resultado ha sido
    <?php if ($condition): ?>
    <span style="color: green; font-weight: bold;">Success</span>
    <?php else: ?>
    <span style="color: red; font-weight: bold;">Error</span>
    <?php endif;?>
</p>
<?php
}