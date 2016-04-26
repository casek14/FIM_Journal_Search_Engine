<?php
namespace App\model;
use Nette\Object;

/**
 * Trida, ktera reprezentuje Detail o clanku
 *
 * @author Jan Cach
 */
class DetailClanku extends Object{
   
    private $titulek;
    private $nazevZdroje;
    private $nazevCasopisu;
    private $linkNaCasopis;
    private $rocnikCasopisu;
    private $cisloCasopisu;
    private $rozsahStranek;
    private $datumPublikace;
    private $autori;
    private $doi;
    private $abstrakt;
    private $klicovaSlova;
    private $odkaz;
    
    /**
     * 
     * @param type $titulek
     * @param type $nazevZdroje
     * @param type $nazevCasopisu
     * @param type $linkNaCasopis
     * @param type $rocnikCasopisu
     * @param type $cisloCasopisu
     * @param type $rozsahStranek
     * @param type $datumPublikace
     * @param type $autori
     * @param type $doi
     * @param type $abstrakt
     * @param type $klicovaSlova
     * @param type $odkaz
     */
    function __construct($titulek, $nazevZdroje, $nazevCasopisu, $linkNaCasopis, $rocnikCasopisu, $cisloCasopisu, $rozsahStranek, $datumPublikace, $autori, $doi, $abstrakt, $klicovaSlova, $odkaz) {
        $this->titulek = $titulek;
        $this->nazevZdroje = $nazevZdroje;
        $this->nazevCasopisu = $nazevCasopisu;
        $this->linkNaCasopis = $linkNaCasopis;
        $this->rocnikCasopisu = $rocnikCasopisu;
        $this->cisloCasopisu = $cisloCasopisu;
        $this->rozsahStranek = $rozsahStranek;
        $this->datumPublikace = $datumPublikace;
        $this->autori = $autori;
        $this->doi = $doi;
        $this->abstrakt = $abstrakt;
        $this->klicovaSlova = $klicovaSlova;
        $this->odkaz = $odkaz;
    }

    /**
     * Vrati titulek detailu clanku
     * @return string detailu clanku
     */
    function getTitulek() {
        return $this->titulek;
    }
    
    /**
     * Vrati Nazev vydavatele Casopisu
     * @return nazev vydavatel casopisu
     */
    function getNazevZdroje() {
        return $this->nazevZdroje;
    }

    
    /**
     * Vrati Nazev casopisu ze ktereho clanek pochazi
     * @return nazev casopisu
     */
    function getNazevCasopisu() {
        return $this->nazevCasopisu;
    }

    /**
     * Vrati odkaz na home page casopisu
     * @return string url stranky casopisu
     */
    function getLinkNaCasopis() {
        return $this->linkNaCasopis;
    }

    /**
     * Vrati rocnik casopisu (Volume)
     * @return string Rocnik casopisu
     */
    function getRocnikCasopisu() {
        return $this->rocnikCasopisu;
    }

    /**
     * Vrati Cisclo casopisu (Issue)
     * @return string Cislo casopisu
     */
    function getCisloCasopisu() {
        return $this->cisloCasopisu;
    }

    /**
     * Vrati stranky casopisu na kterych se clanek nachazi
     * @return string rozsah stranek (format: prvni_stranka-posledni_stranka)
     */
    function getRozsahStranek() {
        return $this->rozsahStranek;
    }

    /**
     * Vrati datum publikace
     * @return string
     */
    function getDatumPublikace() {
        return $this->datumPublikace;
    }

    /**
     * Vrati seznam autoru spolecne s jejich organizaci do ktere patri
     * @return array() seznam autoru
     */
    function getAutori() {
        return $this->autori;
    }

    /**
     * Vrati DOI casopisu
     * @return string DOI casopisu
     */
    function getDoi() {
        return $this->doi;
    }

    /**
     * Vrati abstrakt Clanku
     * @return string Abstrakt
     */
    function getAbstrakt() {
        return $this->abstrakt;
    }

    /**
     * Vrati seznam klicovych slov clanku
     * @return array() seznam klicovych slov
     */
    function getKlicovaSlova() {
        return $this->klicovaSlova;
    }

    /**
     * Vrati odkaz na clanek
     * @return string url clanku
     */
    function getOdkaz() {
        return $this->odkaz;
    }


    
}
