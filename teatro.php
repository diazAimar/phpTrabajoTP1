<?php
    class Teatro{
        /* Atributos */
        private $nombre;
        private $direccion;
        private $funciones;

        /**
        *   constructor del objeto
        *   @param string $nom
        *   @param string $dir
        *   @param array $func
        */
        public function __construct($nom, $dir, $func){
            $this -> nombre = $nom;
            $this -> direccion = $dir;
            $this -> funciones = $func;
        }

        /* GET y SET del nombre del teatro */
        public function getNombreTeatro(){
            return $this -> nombre;
        }
        public function setNombreTeatro($nom){
            $this -> nombre = $nom;
        }

        /* GET y SET de la direccion del teatro */
        public function getDireccionTeatro(){
            return $this -> direccion;
        }
        public function setDireccionTeatro($dir){
            $this -> direccion = $dir;
        }

        /* GET y SET de las funciones del teatro */
        public function getFuncionesTeatro(){
            return $this -> funciones;
        }
        public function setFuncionesTeatro($func){
            $this -> funciones = $func;
        }

        /* SET del nombre y precio de una funcion especifica*/
        /**
        *   @param string $nombre
        *   @param int $num
        */
        public function setNombreFuncion($nombre, $num){
            $this -> funciones[($num-1)]["nombre"] = $nombre;
        }
        public function setPrecioFuncion($precio, $num){
            $this -> funciones[($num-1)]["precio"] = $precio;
        }

        /**
        *   funcion que realiza el cambio del nombre del teatro, tomando como parametro el nuevo nombre del teatro
        *   @param string $nuevoNombre
        *   @return string
        */
        public function cambiarNombreTeatro($nuevoNombre){
            if($nuevoNombre != $this -> getNombreTeatro()){
                $msg = "\033[00;32mNombre del teatro cambiado a " . $nuevoNombre . ".\033[0m\n";
                $this -> setNombreTeatro($nuevoNombre);
            }
            else $msg = "\033[00;31mEl teatro ya se llama de esta forma.\033[0m\n";
            return $msg;
        }

        /**
        *   funcion que realiza el cambio de la direccion del teatro, tomando como parametro la nueva direccion del teatro
        *   @param string $nuevaDireccion
        *   @return string
        */
        public function cambiarDireccionTeatro($nuevaDireccion){
            if($nuevaDireccion != $this -> getDireccionTeatro()){
                $msg = "\033[00;32mDireccion del teatro cambiada a " . $nuevaDireccion . ".\033[0m\n";
                $this -> setDireccionTeatro($nuevaDireccion);
            }
            else $msg = "\033[00;31mLa nueva direccion del teatro es la misma que la actual.\033[0m\n";
            return $msg;
        }

        /**
        *   funcion que realiza el cambio del nombre de una funcion especifica, tomando como parametro el nuevo nombre y la funcion
        *   @return string
        */
        public function cambiarNombreFuncion($nuevaFuncion, $pos){
            $existeFuncion = false;
            $i = 0;
            do {
                if ($this -> getFuncionesTeatro()[$i]["nombre"] == $nuevaFuncion) {
                    $existeFuncion = true;
                    $msg = "\033[00;31mLa funcion ingresada ya se encuentra en el repertorio disponible.\033[0m\n";
                }
                $i++;
            } while ($existeFuncion == false && $i < count($this -> funciones ));
            if (!$existeFuncion) {
                $msg = "\033[00;32mCambio el nombre de la funcion de " . $this -> getFuncionesTeatro()[($pos-1)]["nombre"] . " a " . $nuevaFuncion . "\033[0m.\n";
                $this -> setNombreFuncion($nuevaFuncion, $pos);
            }
            return $msg;
        }

        /**
        *   funcion que realiza el cambio del precio de una funcion especifica, tomando como parametro el nuevo precio y la funcion
        *   @param int $nuevoPrecio
        *   @param int $pos
        *   @return string
        */
        public function cambiarPrecioFuncion($nuevoPrecio, $pos){
            $msg = "\033[00;32mCambio el precio de la funcion de " . $this -> getFuncionesTeatro()[($pos-1)]["precio"] . " a " . $nuevoPrecio . ".\033[0m\n";
            $this -> setPrecioFuncion($nuevoPrecio, $pos);
            return $msg;
        }
    }