<?php
    /******************************************
        DIAZ AIMAR, FEDERICO; FAI-2859
    ******************************************/

    /* REPOSITORIO: 

    https://github.com/diazAimar/phpTrabajoTP1.git */

    /**
     *   ALGORITMO PRINCIPAL
     *   
     */
    include_once "teatro.php";       
    $objetoTeatro = crearObjetoTeatro();
    do {
        $opcion = seleccionarOpcion();
        switch($opcion){
            case 1: /* Ver informacion Actual */
                imprimirInformacionActual($objetoTeatro);
                break;
            case 2: /* Cambiar el nombre del teatro */
                do {
                    echo "Ingrese el nuevo nombre del teatro (no puede estar vacio): ";
                    $nuevoNombreTeatro = trim(fgets(STDIN));
                } while(empty($nuevoNombreTeatro));
                $mensaje = $objetoTeatro -> cambiarNombreTeatro($nuevoNombreTeatro);
                echo $mensaje;  
                break;
            case 3: /* Cambiar la direccion del teatro */
                do {
                    echo "Ingrese la nueva direccion del teatro (no puede estar vacio): ";
                    $nuevaDireccionTeatro = trim(fgets(STDIN));
                } while (empty($nuevaDireccionTeatro));
                $mensaje = $objetoTeatro -> cambiarDireccionTeatro($nuevaDireccionTeatro);
                echo $mensaje;
                break;
            case 4: /* Cambiar el nombre de una funcion */
                do {
                    echo "Ingrese el numero de la funcion a la cual desea cambiarle el nombre (del 1 al 4): ";
                    $posFun = trim(fgets(STDIN));
                } while(!is_numeric($posFun) || ($posFun < 1 || $posFun > 4));
                do {
                    echo "Ingrese el nuevo nombre de la funcion (no puede estar vacio): ";
                    $nuevoNombreFuncion = trim(fgets(STDIN));
                } while(empty($nuevoNombreFuncion));
                $mensaje = $objetoTeatro -> cambiarNombreFuncion($nuevoNombreFuncion, $posFun);
                echo $mensaje;
                break;
            case 5: /* Cambiar el precio de una funcion */
                do {
                    echo "Ingrese el numero de la funcion a la cual desea cambiarle el precio (del 1 al 4): ";
                    $posFun = trim(fgets(STDIN));
                } while(!is_numeric($posFun) || ($posFun < 1 || $posFun > 4));
                do {
                    echo "Ingrese el nuevo precio de la funcion (debe ser mayor que 1): ";
                    $nuevoPrecioFuncion = trim(fgets(STDIN));
                } while(!is_numeric($nuevoPrecioFuncion) || $nuevoPrecioFuncion < 1);
                $mensaje = $objetoTeatro -> cambiarPrecioFuncion($nuevoPrecioFuncion, $posFun);
                echo $mensaje;
                break;
            case 6: /* Salir */
                echo "Saliendo del programa.\n";
        }
    } while ($opcion < 6);

    /**
    *   crea el objeto teatro, con su nombre, direccion, y funciones.
    *   @return object
    */
    function crearObjetoTeatro(){
        echo "\n\n\033[00;32mBienvenido al programa del teatro. Para comenzar, necesitamos que ingrese la informacion principal: \033[0m\n\n";
        do{
            echo "Ingrese el nombre del teatro: ";
            $nombreTeatro = trim(fgets(STDIN));
        } while ($nombreTeatro == "");
        do {
            echo "Ingrese la direccion del teatro: ";
            $direccionTeatro = trim(fgets(STDIN));
        } while ($direccionTeatro == "");
        $funcionesTeatro = array();
        for($i = 0; $i<4; $i++) {
            echo "\n\n\033[00;31mFuncion " . ($i+1) . "\033[0m\n";
            do {
                echo "Ingrese el nombre de la funcion " . ($i+1) . ": ";
                $funcionesTeatro[$i]["nombre"] = trim(fgets(STDIN));
            } while($funcionesTeatro[$i]["nombre"] == "");
            do{
                $esNum = false;
                echo "Ingrese el precio de la funcion " . ($i+1) . ": ";
                $funcionesTeatro[$i]["precio"] = trim(fgets(STDIN));
                if (is_numeric($funcionesTeatro[$i]["precio"])) {
                    $esNum = true;
                }
                else {
                    echo "\033[00;31mPor favor ingrese un numero para el precio de la funcion.\033[0m\n";
                }
            } while (!$esNum);
        }
        $nuevoTeatro = new Teatro($nombreTeatro, $direccionTeatro, $funcionesTeatro);
        return $nuevoTeatro;
    }

    /**
    *   muestra por pantalla un menu interactivo y retorna la eleccion realizada por el usuario.
    *   @return int
    */
    function seleccionarOpcion(){
        echo "\n\033[01;33m--------------------------------------------------------------\033[0m\n";
        echo "\033[01;33m---------------------------\033[0m \033[00;32mMenu\033[0m \033[01;33m-----------------------------\033[0m";
        echo "\n\n( 1 ) Ver informacion actual.";
        echo "\n( 2 ) Cambiar el nombre del teatro.";
        echo "\n( 3 ) Cambiar la direccion del teatro.";
        echo "\n( 4 ) Cambiar el nombre de una funcion";
        echo "\n( 5 ) Cambiar el precio de una funcion";
        echo "\n( 6 ) Salir\n\n";
        echo "\033[01;33m--------------------------------------------------------------\033[0m\n";
        echo "\033[01;33m--------------------------------------------------------------\033[0m\n";
        echo "Ingrese la opcion a elegir: ";
        do {
            $opcionElegida = trim(fgets(STDIN));
        } while ($opcionElegida >= 1 && $opcionElegida <= 6 && is_int($opcionElegida));
        return $opcionElegida;
    }

    /**
    *   muestra por pantalla la informacion actual que contiene el objeto.
    *   @param object $objTeatro
    */
    function imprimirInformacionActual($objTeatro){
        echo "\n\n\033[01;33m--------------------------------------------------------------\033[0m\n";
        echo "\033[01;33m--------------------- \033[00;32mInformacion Actual\033[0m \033[01;33m---------------------\033[0m\n\n";
        echo "\033[00;31mTeatro\033[0m: \n";
        echo "Nombre del Teatro: " . $objTeatro -> getNombreTeatro() . "\n";
        echo "Direccion del Teatro: " . $objTeatro -> getDireccionTeatro() . "\n";
        echo "\n\033[00;31mFunciones\033[0m: \n";
        for($i=0; $i<4; $i++) {
            echo "\033[00;36mFuncion " . ($i+1) . "\033[0m: " . $objTeatro -> getFuncionesTeatro()[$i]["nombre"] . ", $" . $objTeatro -> getFuncionesTeatro()[$i]["precio"] . ".\n";
        }        
    }