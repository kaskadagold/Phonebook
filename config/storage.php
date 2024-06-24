<?php

return [
    /**
     * Available types to store data: 'json', 'database'
     */
    'type' => $_ENV['STORAGE_TYPE'] ?? 'database',
];
