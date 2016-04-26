<?php

namespace App\model;

/**
 * Rozhrani definujici metody pro parsovani clanku
 * @author Jan Cach
 */
interface IZiskaniClanku {
   
    public function vratSeznamClanku($vyraz);
    
}
