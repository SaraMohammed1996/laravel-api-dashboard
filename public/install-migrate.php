<?php

/**
 * One-time migration runner for InfinityFree (no SSH).
 * Visit: https://your-domain/install-migrate.php?token=YOUR_TOKEN
 * DELETE THIS FILE immediately after migrations succeed.
 */

$expectedToken = getenv('MIGRATE_TOKEN') ?: 'change-me-before-deploy';

if (($_GET['token'] ?? '') !== $expectedToken) {
    http_response_code(403);
    exit('Forbidden');
}

define('LARAVEL_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

/** @var \Illuminate\Contracts\Console\Kernel $kernel */
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

$status = $kernel->call('migrate', ['--force' => true]);

header('Content-Type: text/plain; charset=utf-8');
echo "Exit code: {$status}\n\n";
echo $kernel->output();
echo "\n\nDelete public/install-migrate.php after success.\n";
