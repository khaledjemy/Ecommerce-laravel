$ErrorActionPreference = 'Stop'
$projectRoot = (Resolve-Path (Join-Path $PSScriptRoot '..')).Path
$cachedConfig = Join-Path $projectRoot 'bootstrap/cache/config.php'
if (Test-Path -LiteralPath $cachedConfig) {
    throw 'Config is cached. Run this demo from a separate uncached checkout.'
}
if (-not (Test-Path -LiteralPath (Join-Path $projectRoot '.env'))) {
    throw 'Create a local .env and APP_KEY first. The demo does not modify it.'
}

$demoDirectory = Join-Path $projectRoot '.demo'
New-Item -ItemType Directory -Path $demoDirectory -Force | Out-Null
$demoDbPath = Join-Path $demoDirectory 'demo.sqlite'
if (-not (Test-Path -LiteralPath $demoDbPath)) {
    New-Item -ItemType File -Path $demoDbPath | Out-Null
}

$env:APP_ENV = 'local'
$env:APP_DEBUG = 'false'
$env:APP_URL = 'http://127.0.0.1:8011'
$env:DEMO_MODE = 'true'
$env:DB_CONNECTION = 'sqlite'
$env:DB_DATABASE = $demoDbPath
$env:SESSION_DRIVER = 'file'
$env:CACHE_STORE = 'file'
$env:QUEUE_CONNECTION = 'sync'
$env:MAIL_MAILER = 'log'

Push-Location $projectRoot
try {
    php artisan migrate --force
    if ($LASTEXITCODE -ne 0) { throw 'Demo database migration failed.' }
    php artisan db:seed --class=DemoStoreSeeder --force
    if ($LASTEXITCODE -ne 0) { throw 'Demo seeding failed.' }
    Write-Host 'Read-only demo: http://127.0.0.1:8011'
    php artisan serve --host=127.0.0.1 --port=8011
} finally {
    Pop-Location
}
