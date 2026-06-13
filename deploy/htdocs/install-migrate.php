<?php

/**
 * One-time migration + seeder runner for shared hosting (no SSH).
 * Visit: https://your-domain/install-migrate.php?token=YOUR_TOKEN
 * DELETE THIS FILE immediately after migrations and seeding succeed.
 */

define('LARAVEL_START', microtime(true));

$laravelBase = __DIR__;

require $laravelBase.'/vendor/autoload.php';

$app = require_once $laravelBase.'/bootstrap/app.php';

/** @var \Illuminate\Contracts\Console\Kernel $kernel */
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

$expectedToken = env('MIGRATE_TOKEN', 'change-me-before-deploy');

if (($_GET['token'] ?? '') !== $expectedToken) {
    http_response_code(403);
    exit('Forbidden');
}

header('Content-Type: text/plain; charset=utf-8');

$migrateStatus = $kernel->call('migrate', ['--force' => true]);

echo "=== migrate ===\n";
echo "Exit code: {$migrateStatus}\n\n";
echo $kernel->output();

if ($migrateStatus !== 0) {
    echo "\n\nSeeding skipped because migrations failed.\n";
    exit($migrateStatus);
}

$seedStatus = $kernel->call('db:seed', ['--force' => true]);

echo "\n\n=== db:seed ===\n";
echo "Exit code: {$seedStatus}\n\n";
echo $kernel->output();
echo "\n\nDelete install-migrate.php after success.\n";

exit($seedStatus);
