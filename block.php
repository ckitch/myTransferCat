<?php

    // Block class, used to create a block object.

    class Block
    {
        public $nonce;

        public function __construct($index, $timestamp, $data, $previousHash = null)
        {
            $this->index = $index;
            $this->timestamp = $timestamp;
            $this->data = $data;
            $this->previousHash = $previousHash;
            $this->hash = $this->calculateHash();
            $this->nonce = 0;
        }

    /*
    Creates the blocks hash using SHA-256.
    Documentation for various hash algorithms: 
    https://csrc.nist.gov/csrc/media/publications/fips/180/2/archive/2002-08-01/documents/fips180-2.pdf
    */

        public function calculateHash()
        {
            return hash("sha256", $this->index.$this->previousHash.$this->timestamp.((string)$this->data).$this->nonce);
        }
    }
?>