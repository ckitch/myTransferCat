<?php
    require_once("./block.php"); //Requiring the Block class
    date_default_timezone_set('America/New_York'); //Used for the getTime() output - can be changed.
    
    // Creates a blockchain with necessary functions
    class BlockChain
    {
        public function getTime()
        {
            $date = date('m-d-Y h:i:s a', time());
            return $date;
        }

        // Instantiates the blockchain
        public function __construct()
        {
            $this->chain = [$this->createGenesisBlock()];
            $this->difficulty = 4;
        }

        // Creates the Genesis block, which in theory should NEVER change when blockchain is implemented.
        private function createGenesisBlock()
        {
            return new Block(0, $this->getTime(), "Genesis Block");
        }

        // Returns the most recently added block in the chain.
        public function getLastBlock()
        {
            return $this->chain[count($this->chain)-1];
        }

        /*
        Pushes a new block onto existing chain using the mine() function 
        (or first Genesis block if new chain is being created)
        This will be called each time a transaction is made.
        */
        public function push($block)
        {
            $block->previousHash = $this->getLastBlock()->hash;
            $this->mine($block);
            array_push($this->chain, $block);
        }

        // Mines an individual block. This is where a block object is created.
        public function mine($block)
        {
            while (substr($block->hash, 0, $this->difficulty) !== str_repeat("0", $this->difficulty))
            {
                $block->nonce++;
                $block->hash = $block->calculateHash();
            }

            echo "Block mined: ".$block->hash."\n";
        }
        
        /*
        Function that compares two block object's hashes, checking discrepancy;
        returning true or false depending on validity.
        Ideally would be an interval function, running often.
        */
        public function isValid()
        {
            for ($i = 1; $i < count($this->chain); $i++)
            {
                $currentBlock = $this->chain[$i];
                $previousBlock = $this->chain[$i-1];

                if ($currentBlock->hash != $currentBlock->calculateHash())
                {
                    return false;
                }

                if ($currentBlock->previousHash != $previousBlock->hash)
                {
                    return false;
                }
            }
            return true;
        }
    }
?>