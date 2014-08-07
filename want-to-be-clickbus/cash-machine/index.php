<pre><?php
use CashMachine\Bills;
use CashMachine\Draw;

require 'bootstrap.php';

$bills = [10.00, 100.00, 50.00, 20.00];

$billsInstance = new Bills;
$billsInstance->setBills($bills);

$draw = new Draw($billsInstance);

echo "# Sacando 30.00:";
var_dump($draw->draw(30.00));

echo "# Sacando 80.00:";
var_dump($draw->draw(80.00));

echo "# Sacando 125.00:\n";
try {
    $draw->draw(125.00);
} catch (Exception $e) {

    print_r($e->__toString());
    
}

echo "\n\n";

echo "# Sacando -130.00:\n";
try {
    $draw->draw(-130.00);
} catch (Exception $e) {

    print_r($e->__toString());
    
}

echo "\n\n";

echo "# Sacando null:";
var_dump($draw->draw());
