<?php
class Seguros_medicos {
    //Atributos
    private $id;
    private $codigo;
    private $siglas;
    
    //Setters
    public function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    public function setSiglas($siglas): void {
        $this->siglas = $siglas;
    }
    
    //Getters
    public function getCodigo() {
        return $this->codigo;
    }

    public function getSiglas() {
        return $this->siglas;
    }
    
}