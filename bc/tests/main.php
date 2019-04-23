<?php
    require_once(__DIR__.'/../blockchain.php');

    /*
    Creating a blockchain using a for loop. 
    Returns specified amount of blocks along with block# in chain, time it was mined and placeholder data.
    */

    $testCoin = new BlockChain();
    for ($i = 1; $i <= 50; $i++)
    {
        echo "mining block ".$i." || ";
        $testCoin->push(new Block($i, $testCoin->getTime(), rand(0.1, 25000) * 2.75));
    }

    /*
    Returning the blockchain in a JSON format, which
    will be pulled to populate areas on the UI - ticker, recent trans, etc.
    */

    echo json_encode($testCoin, JSON_PRETTY_PRINT);

?>
