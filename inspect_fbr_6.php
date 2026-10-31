<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$sale = App\Models\Sale::find(6);
echo "SALE 6:\n";
print_r($sale->toArray());

echo "\nSALE 6 ITEMS:\n";
foreach($sale->items as $it) {
    print_r($it->toArray());
}
