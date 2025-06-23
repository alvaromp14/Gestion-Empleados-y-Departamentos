<?php
class Antiguos_empleados {
    //Atributos
    private $id;
    private $codigo;
    private $nif;
    private $apellidos;
    private $nombre;
    private $profesion;
    private $salario;
    private $fechaNac;
    private $fechaIng;
    private $idDepartamento;
    private $tipoBaja;
    
    //Setters
    public function setCodigo($codigo): void {
        $this->codigo = $codigo;
    }

    public function setNif($nif): void {
        $this->nif = $nif;
    }

    public function setApellidos($apellidos): void {
        $this->apellidos = $apellidos;
    }

    public function setNombre($nombre): void {
        $this->nombre = $nombre;
    }

    public function setProfesion($profesion): void {
        $this->profesion = $profesion;
    }

    public function setSalario($salario): void {
        $this->salario = $salario;
    }

    public function setFechaNac($fechaNac): void {
        $this->fechaNac = $fechaNac;
    }

    public function setFechaIng($fechaIng): void {
        $this->fechaIng = $fechaIng;
    }
    
    public function setIdDepartamento($idDepartamento) {
        $this->idDepartamento = $idDepartamento;
    }
    
    public function setTipoBaja($tipoBaja) {
        $this->tipoBaja = $tipoBaja;
    }
    
    //Getters
    public function getCodigo() {
        return $this->codigo;
    }

    public function getNif() {
        return $this->nif;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getProfesion() {
        return $this->profesion;
    }

    public function getSalario() {
        return $this->salario;
    }

    public function getFechaNac() {
        return $this->fechaNac;
    }

    public function getFechaIng() {
        return $this->fechaIng;
    }
    
    public function getIdDepartamento() {
        return $this->idDepartamento;
    }
    
    public function getTipoBaja() {
        return $this->tipoBaja;
    }
    
}
