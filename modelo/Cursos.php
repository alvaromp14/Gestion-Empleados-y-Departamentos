<?php
class Cursos {
    //Atributos
    private $id;
    private $codigo;
    private $descripcion;
    
    //Setters
    public function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    public function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }
    
    //Getters
    public function getCodigo() {
        return $this->codigo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }
    
}