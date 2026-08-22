<?php

namespace Resend\Broadcasts;

use Resend\Resource;

/**
 * @property string $id An opaque cursor for this row, used only for pagination. It does not identify any entity in Resend.
 * @property string $url The URL that was clicked.
 * @property int $clicks Total number of clicks on this URL.
 * @property int $unique_clicks Number of unique clicks on this URL.
 */
class ClickedLink extends Resource
{
    //
}
