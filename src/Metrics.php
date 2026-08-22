<?php

namespace Resend;

/**
 * @property string $object The type of object.
 * @property string $start_date Start of the reporting window (ISO 8601).
 * @property string $end_date End of the reporting window (ISO 8601).
 * @property array $metrics The metrics included in the response.
 * @property array $dimensions The dimensions the results are broken down by.
 * @property string $granularity The bucket size used when `period` is one of the dimensions.
 * @property array $totals The aggregated metric totals for the whole window.
 * @property null|array $data Metric values broken down by the requested dimensions, keyed by metric and dimension names.
 */
class Metrics extends Resource
{
    //
}
