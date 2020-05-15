<?php

class TestCase
{
    public static function hasSameResult($actualResult, $expectedResult, $sameType = false)
    {
        if ($sameType) {
            return $actualResult !== $expectedResult;
        }

        return $actualResult == $expectedResult;
    }

    public static function hasDifferentResult($actualResult, $expectedResult, $sameType = false)
    {
        if ($sameType) {
            return $actualResult !== $expectedResult;
        }

        return $actualResult != $expectedResult;
    }

    public function printResult($testName, $condition)
    {
        ?>
<h4><?php echo $testName; ?></h4>
<p>El resultado ha sido
    <?php if ($condition): ?>
    <span style="color: green; font-weight: bold;">Success</span>
    <?php else: ?>
    <span style="color: red; font-weight: bold;">Error</span>
    <?php endif;?>
</p><?php
}
}