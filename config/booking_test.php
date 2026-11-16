<?php

return [
    'enabled' => env('BOOKING_TEST_CHECKOUT_ENABLED', false),
    'gateway' => env('BOOKING_TEST_GATEWAY', ''),
    'pricing_version' => 'synthetic-cad-v1',
    'hold_minutes' => (int) env('BOOKING_TEST_HOLD_MINUTES', 0),
    'tax_basis_points' => 0,
    'discount_minor_units' => 0,
];
