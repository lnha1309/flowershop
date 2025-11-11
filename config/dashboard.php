<?php

return [
    'kpi_targets' => [
        'orders' => env('KPI_TARGET_ORDERS', 10),
        'expenses' => env('KPI_BUDGET_EXPENSES', 50000000), // VND
        'income' => env('KPI_TARGET_INCOME', 75000000), // VND
    ],
];
