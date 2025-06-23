<?php
class Departamento {
    //Atributos
    private $id;
    private $codigo;
    private $descripcion;
    private $localizacion;
    
    //Setters
    public function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    public function setDescripcion($descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function setLocalizacion($localizacion): void {
        $this->localizacion = $localizacion;
    }
    
    //Getters
    public function getCodigo() {
        return $this->codigo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getLocalizacion() {
        return $this->localizacion;
    }
    
}
