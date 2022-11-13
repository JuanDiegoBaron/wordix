<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/*Baron Juan Diego - 3284 - TUDW - juandiegobaron19@gmail.com - JuanDiegoBaron*/
/*Antinao Nicolas - 4353 - TUDW - nicoantinao1998@gmail.com - Nico13A*/
/*Matias Olate - 3255 - TUDW - olatemat15@gmail.com - MatiasOlate*/ 



/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "JAMON", "PALMA", "PERRO", "TARRO", "TECHO"
    ];

    return ($coleccionPalabras);
}

/** 
* Inicializa la coleccion de partidas
* @return array
*/
function cargarPartidas(){

    $coleccionPartidas=[
        ["palabraWordix"=>"RASGO","jugador"=>"Pedro","intentos"=>6,"puntaje"=>0],
        ["palabraWordix"=>"CASAS","jugador"=>"Juan","intentos"=>4,"puntaje"=>13],
        ["palabraWordix"=>"GATOS","jugador"=>"Miguel","intentos"=>2,"puntaje"=>15],
        ["palabraWordix"=>"FUEGO","jugador"=>"Nicolas","intentos"=>3,"puntaje"=>11],
        ["palabraWordix"=>"RASGO","jugador"=>"Nicolas","intentos"=>5,"puntaje"=>12],
        ["palabraWordix"=>"QUESO","jugador"=>"Juan","intentos"=>1,"puntaje"=>15],
        ["palabraWordix"=>"MUJER","jugador"=>"Marta","intentos"=>1,"puntaje"=>16],
        ["palabraWordix"=>"YUYOS","jugador"=>"Fernanda","intentos"=>6,"puntaje"=>0],
        ["palabraWordix"=>"JAMON","jugador"=>"Ramon","intentos"=>5,"puntaje"=>11],
        ["palabraWordix"=>"PALMA","jugador"=>"Juan","intentos"=>3,"puntaje"=>13],
    ];
    return $coleccionPartidas;
}

/**
 * guarda una partida en la coleccion de partidas
 * @param array $coleccionPartidas
 * @param array $partida
 * @return array
 */
function guardarPartida($coleccionPartidas,$partida){
    $coleccionPartidas = array_push($partida);
    return $coleccionPartidas;
}

/**
 * Imprime el resultado de la partida
 * @param $partida
 */
function imprimirResultadoPartida($partida){
    echo "Partida finalizada";
    echo "-----------------------------";
    echo "Palabra: ". $partida["palabraWorddix"];
    echo "Jugador: ". $partida["jugador"];
    echo "Intentos: ". $partida["intentos"];
    echo "Puntaje: ". $partida["puntaje"];
    echo "-----------------------------";
}


/** ----------  REVISAR --------------
 * Juega una partida con una palabra elegida por el jugador (OPCION 1)
 * @param array $coleccionPartidas
 * @param array $coleccionPalabras
 */
function jugarWordixConPalabraElegida($coleccionPartidas,$coleccionPalabras){
    // String $nombreJugador
    $nombreJugador = solicitarJugador();
    do{
        echo "Ingresa un numero entre 0 y ".COUNT($coleccionPalabras)." :";
        $numeroPalabra = solicitarNumeroEntre(0,COUNT($coleccionPalabras));
        $palabra = $coleccionPalabras[$numeroPalabra];
        for($i=0;$i<COUNT($coleccionPartidas);$i++){
            if ($coleccionPartidas[$i]["nombre"]==$nombreJugador){
                if($coleccionPartidas[$i]["palabraWordix"]==$palabra){
                    echo "Ya has jugado con esa palabra.";
                    $usada = TRUE;
                } 
                else{
                    $usada = FALSE;
                }   
            } 
        }
        
    } while($usada);
    
    $partida = jugarWordix($palabra, $nombreJugador);
    print_r($partida);
    imprimirResultadoPartida($partida);
    $coleccionPartidas = guardarPartida($coleccionPartidas,$partida);

}



/**
 * Devuelve el nombre del jugador ingresado por el usuario en minuscula si solo ingreso letras.
 * @return string
 */
function solicitarJugador(){
    //String $nombre
    echo "Ingrese el nombre de un jugador: ";
    $nombre = trim(fgets(STDIN));
    $nombre = strtolower($nombre);
    while (!esPalabra($nombre)) {
        echo "Ingrese el nombre de un jugador y solo utilice letras: ";
        $nombre = strtolower(trim(fgets(STDIN)));
    }
    return $nombre;
}

/**
 * Muestra las opciones del menu en pantalla y devuelve el numero de opcion.
 * @return int
 */
function seleccionarOpcion($coleccionPalabras,$coleccionPartidas) {
    //int $numOpcion
    echo "-------------------------------------------------------------------";
    echo "1) Jugar al Wordix con una palabra elegida \n";
    echo "2) Jugar al Wordix con una palabra aleatoria \n";
    echo "3) Mostrar una partida \n";
    echo "4) Mostrar la primer partida ganadora \n";
    echo "5) Mostrar resumen de Jugador \n";
    echo "6) Mostrar listado de partidas ordenadas por jugador y por palabra \n";
    echo "7) Agregar una palabra de 5 letras a Wordix \n";
    echo "-------------------------------------------------------------------";
    echo "Ingrese un numero de opcion: ";
    $numOpcion = solicitarNumeroEntre(1, 8);
    switch ($numOpcion) {
        case 1:
            echo "Jugar al Wordix con una palabra elegida \n";
            jugarWordixConPalabraElegida($coleccionPalabras,$coleccionPartidas);
            break;
        case 2:
            echo "Jugar al Wordix con una palabra aleatoria \n";
            break;
        case 3:
            echo "Mostrar una partida \n";
            break;
        case 4:
            echo "Mostrar la primer partida ganadora \n";
            break;
        case 5:
            echo "Mostrar resumen de Jugador \n";
            break;
        case 6:
            echo "Mostrar listado de partidas ordenadas por jugador y por palabra \n";
            break;
        case 7:
            // echo "Agregar una palabra de 5 letras a Wordix \n";
            $coleccionPalabras = agregarPalabra($coleccionPalabras,leerPalabra5Letras());
            break;
        default:
            echo "Salir \n";
            break;
    }
    return $numOpcion . "\n";
}



/**
 * Verifica si la palabra ya se encuentra en la coleccion.
 * @param array $unaColeccion
 * @param string $unaPalabra
 * @return boolean
 */
function palabraRepetida($unaColeccion, $unaPalabra) {
    //Boolean $valida;
    if (in_array($unaPalabra, $unaColeccion)) {
        $valida = false;
    }
    else {
        $valida = true;
    }
    return $valida;
}


/**
 * Agrega una palabra a la coleccion ingresada.
 * @param array $coleccionPalabras
 * @param string $nuevaPalabra
 * @return array
 */
function agregarPalabra($coleccionPalabras, $nuevaPalabra) {
    while (!palabraRepetida($coleccionPalabras, $nuevaPalabra)) {
        echo "Esta palabra ya esta en la coleccion \n";
        $nuevaPalabra = leerPalabra5Letras();
    }
    array_push($coleccionPalabras, $nuevaPalabra);
    return $coleccionPalabras;
}




/*
 * 
 * 
 * 
*/
function resumenJugador($coleccionPartidas){
    $puntajeTotal=0;
    $numeroPartidas=0;
    $victorias=0;
    $intento1=0;
    $intento2=0;
    $intento3=0;
    $intento4=0;
    $intento5=0;
    $intento6=0;

    echo "Ingresar nombre de jugador: ";
    $nombreJugador = trim(fgets(STDIN));
    for($i=0;$i<COUNT($coleccionPartidas);$i++){
        if($coleccionPartidas[$i]["jugador"]==$nombreJugador){
            
            $numeroPartidas++;
            $puntajeTotal+= $coleccionPartidas[$i]["puntaje"];
            
            if ($coleccionPartidas[$i]["intento"]<=6){
                $victorias++;
            }
            
            switch($coleccionPartidas[$i]["intento"]){
                case 1: 
                    $intento1++;
                    break;
                case 2: 
                    $intento2++;
                    break;
                case 3: 
                    $intento3++;
                    break;
                case 4: 
                    $intento4++;
                    break;
                case 5: 
                    $intento5++;
                    break;
                case 6: 
                    $intento6++;
                    break;            
            }
        
        }
    }
    // $porcentajeVictorias = ($victorias*100)/$partidas;
    // Se crea un arreglo $resumenJugador con todos los datos 
    $resumenJugador = ["nombreJugador"=>$nombreJugador,
                        "partidas"=>$numeroPartidas, 
                        "puntaje"=>$puntajeTotal,
                        "victorias"=>$victorias,
                        "intento1"=>$intento1,
                        "intento2"=>$intento2,
                        "intento3"=>$intento3,
                        "intento4"=>$intento4,
                        "intento5"=>$intento5,
                        "intento6"=>$intento6];

    return $resumenJugador;                    
}

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:



//Inicialización de variables:

$coleccionPalabras = cargarColeccionPalabras();
$coleccionPartidas= cargarPartidas();

//Proceso:

$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);



/*
do {
    $opcion = ...;

    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != X);
*/
