<?php

class person{
  var $name;        // mint public

  public $pub;      // nincs tiltas
  private $pri;     // csak ez az abjektum eri el
  protected $pro;   // ez az objekum es a leszarmazott is

  function __construct($n=""){
    if ((isset($n))and($n<>"")){
      $this->name=$n;
    }
  }

  function set_name($new_name){
    $this->name=$new_name;
    $this->pri="private-".$new_name;
    $this->pro="protected-".$new_name;
  }

  function get_name(){
    return($this->name);
  }

  public function get_pub_name(){
    return("Public func-".$this->name);
  }

  public function get_protpub_name(){
    $this->name=$this->get_prot_name();
    return("Public func-".$this->name);
  }

  // csak ez az objektum eri el, oroklodeskor nem oroklodik
  private function get_priv_name(){
    return("Private func-".$this->name);
  }

  // csak ez az objektum eri el, de oroklodik, oroklott objektumban is megvan
  // csak objektumon belulrol erheto el
  protected function get_prot_name(){
    return("Protected func-".$this->name);
  }

}


// oroklodes

class manyperson extends person{

  // eredeti objektumtol orokli v valtozokat, metodusokat
  function __construct($n=""){
    if ((isset($n))and($n<>"")){
      $this->name=$n;
    }
  }

  // felulirva az eredeti vedett
  protected function get_prot_name(){
    // megadva a szulo objektum nevet
    $this->name="Extend protected func-".person::get_prot_name();
    // csak hivatkozva a szulo objektumra....
    $this->name="Extend protected func-".parent::get_prot_name();
    return($this->name);
  }

}



?>