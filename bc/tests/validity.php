<?php
    require_once(__DIR__.'/../blockchain.php');

    /*
    This test will mine two blocks, printing a JSON version of the current chain. Then, we 
    change the data block #1 holds, thus changing its hash. The function will compare which previous hash block #2
    has to the NEW hash of block #1, showing there is a validity problem.
    */

    $testCoin = new BlockChain();

    echo "mining block 1...\n";
    $testCoin->push(new Block(1, $testCoin->getTime(), 1000));

    echo "mining block 2...\n";
    $testCoin->push(new Block(2, $testCoin->getTime(), 15000));

    echo json_encode($testCoin, JSON_PRETTY_PRINT);

    echo "Chain valid: ".($testCoin->isValid() ? "true" : "false")."\n";

    echo "\nChanging second block data...\n";
    $testCoin->chain[1]->data = 412048;
    $testCoin->chain[1]->hash = $testCoin->chain[1]->calculateHash();

    echo json_encode($testCoin, JSON_PRETTY_PRINT);

    echo "\nChain valid: ".($testCoin->isValid() ? "true" : "false")."\n";
?>
