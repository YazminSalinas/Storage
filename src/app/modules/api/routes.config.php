<?php
    return [
        'middleware' => 'security@verifyApiKey',
        'get' => [
            ['handler' => 'archivos', 'uri' => '/files', 'method' => 'descargar', 'verifyToken' => false]
        ],
        'post' => [
            ['handler' => 'archivos', 'uri' => '/files', 'method' => 'agregar', 'verifyToken' => false]
        ],
        'delete' => [
            ['handler' => 'archivos', 'uri' => '/files', 'method' => 'eliminar', 'verifyToken' => false]
        ]
    ];
?>