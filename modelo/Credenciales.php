<?php
class Credenciales {
    //Atributos
    private $id;
    private $usuario;
    private $contraseña;
    
    //Setters
    public function setUsuario($usuario): void {
        $this->usuario = $usuario;
    }

    public function setContraseña($contraseña): void {
        $this->contraseña = $contraseña;
    }
    
    //Getters
    public function getUsuario() {
        return $this->usuario;
    }

    public function getContraseña() {
        return $this->contraseña;
    }
    
}