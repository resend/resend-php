<?php

// Only run on PEST 2.0 or higher...
if (version_compare(Pest\version(), '2.0.0', '>=')) {
    test('No debugging statements are left in the code')
        ->expect(['var_dump'])
        ->not->toBeUsed();
}
