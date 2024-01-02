<?php

test('No debugging statements are left in the code')
    ->expect(['var_dump'])
    ->not->toBeUsed();
