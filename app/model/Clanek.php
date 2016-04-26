<?php
namespace App\model;
use Nette\Object;

/**
 * Trida, ktera reprezentuje Clanek
 *
 * @author Jan Cach
 */
class Clanek extends Object{
    
    private $titulek;
    private $abstrakt;
    private $doi;
    private $issn;
    private $autor;
    private $klicovaSlova;
    private $databaze;
    private $rokVytvoreni;
    private $mesicVytvoreni;
    private $hodnoceni;
    private $id;
    
    /**
     * Vytvori instaci clanku podle zadanych parametru
     * @param string $titulek
     * @param string $abstrakt
     * @param string $doi
     * @param string $issn
     * @param string $autor
     * @param string $klicovaSlova
     * @param sting $databaze
     * @param string $rokVytvoreni
     * @param string $mesicVytvoreni
     * @param string $hodnoceni
     * @param string $id
     */
    function __construct($titulek, $abstrakt, $doi, $issn, $autor, $klicovaSlova, $databaze, $rokVytvoreni, $mesicVytvoreni, $hodnoceni, $id) {
        $this->titulek = $titulek;
        $this->abstrakt = $abstrakt;
        $this->doi = $doi;
        $this->issn = $issn;
        $this->autor = $autor;
        $this->klicovaSlova = $klicovaSlova;
        $this->databaze = $databaze;
        $this->rokVytvoreni = $rokVytvoreni;
        $this->mesicVytvoreni = $mesicVytvoreni;
        $this->hodnoceni = $hodnoceni;
        $this->id = $id;
    }
    
    /**
     * Vrati titulek clanku
     * @return string titulek clanku
     */
    function getTitulek() {
        return $this->titulek;
    }
    
    /**
     * Vrati abstrakt clanku
     * @return string Abstrakt clanku
     */
    function getAbstrakt() {
        return $this->abstrakt;
    }

    /**
     * Vrati DOI clanku
     * @return string DOI clanku
     */
    function getDoi() {
        return $this->doi;
    }

    /**
     * Vrati ISSN clanku
     * @return string ISSN clanku
     */
    function getIssn() {
        return $this->issn;
    }
    
    /**
     * Vrati Autora clanku
     * @return string Autor clanku
     */
    function getAutor() {
        return $this->autor;
    }

    /**
     * Vrati klicova slova clanku
     * @return string klicova slova clanku
     */
    function getKlicovaSlova() {
        return $this->klicovaSlova;
    }

    /**
     * Vrati nazev databaze ze ktere clanek pochazi
     * @return string nazev databaze
     */
    function getDatabaze() {
        return $this->databaze;
    }

    /**
     * Vrati rok vytvoreni clanku
     * @return string rok vytvoreni clanku
     */
    function getRokVytvoreni() {
        return $this->rokVytvoreni;
    }

    /**
     * Vrati mesic vytvoreni clanku
     * @return string mesic vvytvoreni clanku
     */
    function getMesicVytvoreni() {
        return $this->mesicVytvoreni;
    }

    /**
     * Vrati hodnoceni clanku
     * @return string hodnoceni clanku
     */
    function getHodnoceni() {
        return $this->hodnoceni;
    }

    /**
     * Vrati identifikator clanku
     * @return string identifikator clanku
     */
    function getId() {
        return $this->id;
    }

 

    /**
         * Tato funkce spocita hodnoceni clanku. Podle poctu vyskytu hledaneho vyrazu v titulku, klicovych slovech a abstraktu
         * @param string $titulek
         * @param string $klicovaSlova
         * @param string $abstrakt
         * @param string $vyraz
         * @return int Pocet vyskytu vyrazu v clanku
         */
     public static function vypoctiHodnoceni($titulek, $klicovaSlova, $abstrakt, $vyraz){
       
       $pocetVTitulku = Clanek::vypocitejPocetVyskytu($titulek, $vyraz);
       $pocetVKlicovychSlovech = Clanek::vypocitejPocetVyskytu($klicovaSlova, $vyraz);
       $pocetVAbstraktu = Clanek::vypocitejPocetVyskytu($abstrakt, $vyraz);
       $hodnoceni = 3*$pocetVTitulku + 2*$pocetVKlicovychSlovech + $pocetVAbstraktu;
       return $hodnoceni;
     }
    
     
     /**
      * Funkce ktera vypocita pocet vyskytu vyrazu v textu
      * @param string $text Text ve kterem chceme hledat vyraz
      * @param string $hledanyVyraz Vyraz pro ktery chceme zjistit pocet vyskytu v textu
      * @return int pocet vyskytu vyrazu v textu
      */
         private static function vypocitejPocetVyskytu($text, $hledanyVyraz){
          
           
           $pocetVyskytu = substr_count(strtolower($text), strtolower($hledanyVyraz));
           
       return $pocetVyskytu;
         }
     }
