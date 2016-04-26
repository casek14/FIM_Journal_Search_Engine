<?php

namespace App\model;

/**
 * Rozhrani definujici metodu pro parsovani detailu clanku
 * @author Jan Cach
 */
interface IZiskaniDetailuClanku {
   
    public function vratDetailClanku($id);
}
