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
 * Obtiene una colección de palabras (Punto 1)
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
* Inicializa la coleccion de partidas (Punto 2)
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
 * Guarda una partida en la coleccion de partidas.
 * @param array $coleccionPartidas
 * @param array $partida
 * @return array
 */
function guardarPartida($coleccionPartidas,$partida){
    $coleccionPartidas = array_push($coleccionPartidas, $partida);
    return $coleccionPartidas;
}

/**
 * Imprime el resultado de la partida jugada
 * @param $partida
 */
function imprimirResultadoPartida($partida){
    echo "-----------------------------\n";
    echo "Palabra: ". $partida["palabraWorddix"]."\n";
    echo "Jugador: ". $partida["jugador"]."\n";
    echo "Intentos: ". $partida["intentos"]."\n";
    echo "Puntaje: ". $partida["puntaje"]."\n";
    echo "-----------------------------\n";
}

/** 
 * Juega una partida de wordix con una palabra elegida por el jugador (OPCION 1)
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
            if ($coleccionPartidas[$i]["jugador"]==$nombreJugador){
                if($coleccionPartidas[$i]["palabraWordix"]==$palabra){
                    echo "Ya has jugado con esa palabra.\n";
                    $usada = TRUE;
                } 
                else{
                    $usada = FALSE;
                    break;
                }   
            } 
        }
        
    } while($usada);
    
    $partida = jugarWordix($palabra, $nombreJugador);
    //print_r($partida);
    echo "Partida finalizada!";
    imprimirResultadoPartida($partida);
    $coleccionPartidas = guardarPartida($coleccionPartidas,$partida);

}

/** -
 * Juega una partida de wordix con una palabra aleatoria (OPCION 2)
 * @param array $coleccionPartidas
 * @param array $coleccionPalabras
 */
function jugarWordixConPalabraAleatoria($coleccionPalabras,$coleccionPartidas){
    // String $nombreJugador
    // Int $i
    // Boolean $usada
    $nombreJugador = solicitarJugador();
    $i=0;
    do{
        $palabra=$coleccionPalabras[$i];
        // Verifica si el usuario ya jugo con esa palabra.
        for ($j=0;$j<COUNT($coleccionPartidas);$j++){
            if ($coleccionPartidas[$j]["jugador"==$nombreJugador]){
                if($coleccionPalabras[$j]["palabraWordix"]==$palabra){
                    $usada = TRUE;
                }
                else{
                    $usada = FALSE;
                    break;
                }
            }
        }
        $i++;
    }while($usada);

    $partida = jugarWordix($palabra, $nombreJugador);
    //print_r($partida);
    echo "Partida finalizada!";
    imprimirResultadoPartida($partida);
    $coleccionPartidas = guardarPartida($coleccionPartidas,$partida);
    
}

/**
 * muestra una partida segun un numero ingresado (OPCION 3)
 * @param $coleccionPartidas
 */
function mostrarPartida($coleccionPartidas){
    // Int $numeroPartida
    $numeroPartida = solicitarNumeroEntre(0,COUNT($coleccionPartidas));
    $partida = $coleccionPartidas[$numeroPartida];
    echo "***********************\n";
    echo "Partida Wordix ". $numeroPartida. ": palabra ". $partida["palabraWordix"]."\n";
    echo "jugador: ". $partida["jugador"]."\n";
    echo "puntaje: ". $partida["puntaje"]. " puntos\n";
    if ($partida["puntaje"]==6){
        echo "Intento: No adivino la palabra\n";
    }
    else {
        echo "Intento: ". $partida["puntaje"]."\n"; 
    }
    echo "***********************";
}   

/**
 * muestra la primer partida que gano un jugador (OPCION 4)
 * @param $coleccionPartidas
 */
function mostrarPrimerVictoria($coleccionPartidas){
    // String $jugador
    // Array $partida
    $jugador = solicitarJugador();
    $partida=$coleccionPartidas[indicePrimerPartidaGanada($coleccionPartidas,$jugador)];  
    imprimirResultadoPartida($partida);
}

/**
 * muestra el resumen de un jugador (Opcion 5)
 * @param array
 */
function mostrarResumenJugador($resumenJugador){
    $porcentajeVictorias= ($resumenJugador["victorias"]*100)/$resumenJugador["partidas"];
    echo "*************************************\n";
    echo "Jugador: ". $resumenJugador["nombreJugador"]."\n";
    echo "Partidas: ". $resumenJugador["partidas"]."\n";
    echo "Puntaje Total: ". $resumenJugador["puntaje"]."\n";
    echo "Victorias: ". $resumenJugador["victorias"]."\n";
    echo "Porcentaje Victorias: ". $porcentajeVictorias."\n";
    echo "Adivinadas\n";
    echo "      Intento 1: ". $resumenJugador["intento1"]."\n";
    echo "      Intento 2: ". $resumenJugador["intento2"]."\n";
    echo "      Intento 3: ". $resumenJugador["intento3"]."\n";
    echo "      Intento 4: ". $resumenJugador["intento4"]."\n";
    echo "      Intento 5: ". $resumenJugador["intento5"]."\n";
    echo "      Intento 6: ". $resumenJugador["intento6"]."\n";
    echo "*************************************\n";
}

/**
 * Muestra las opciones del menu en pantalla y devuelve el numero de opcion. (Punto 3)
 * @return int
 */
function seleccionarOpcion($coleccionPalabras,$coleccionPartidas) {
    //int $numOpcion
    echo "------------------------------------------------------------------- \n";
    echo "1) Jugar al Wordix con una palabra elegida \n";
    echo "2) Jugar al Wordix con una palabra aleatoria \n";
    echo "3) Mostrar una partida \n";
    echo "4) Mostrar la primer partida ganadora \n";
    echo "5) Mostrar resumen de Jugador \n";
    echo "6) Mostrar listado de partidas ordenadas por jugador y por palabra \n";
    echo "7) Agregar una palabra de 5 letras a Wordix \n";
    echo "8) Salir.\n";
    echo "------------------------------------------------------------------- \n";
    echo "Ingrese un numero de opcion: ";
    $numOpcion = solicitarNumeroEntre(1, 8);
    switch ($numOpcion) {
        case 1:
            //echo "Jugar al Wordix con una palabra elegida \n";
            jugarWordixConPalabraElegida($coleccionPalabras,$coleccionPartidas);
            return 1;
            break;
        case 2:
            //echo "Jugar al Wordix con una palabra aleatoria \n";
            jugarWordixConPalabraAleatoria($coleccionPalabras,$coleccionPartidas);
            return 2;
            break;
        case 3:
            //echo "Mostrar una partida \n";
            mostrarPartida($coleccionPartidas);
            return 3;
            break;
        case 4:
            //echo "Mostrar la primer partida ganadora \n";
            mostrarPrimerVictoria($coleccionPartidas);
            return 4;
            break;
        case 5:
            //echo "Mostrar resumen de Jugador \n";
            mostrarResumenJugador(resumenJugador($coleccionPartidas));
            return 5;
            break;
        case 6:
            //echo "Mostrar listado de partidas ordenadas por jugador y por palabra \n";
            mostrarPartidaOrdenada($coleccionPartidas);
            return 6;
            break;
        case 7:
            // echo "Agregar una palabra de 5 letras a Wordix \n";
            $coleccionPalabras = agregarPalabra($coleccionPalabras,leerPalabra5Letras());
            //print_r($coleccionPalabras);
            return 7;
            break;
        default:
            //echo "Salir \n";
            return 8;
            break;
    }
    return $numOpcion . "\n";
}

/**
 * devuelve el indice de la primer partida ganada por un jugador
 * @param array $coleccionPartidas
 * @param string $nombreJugador
 * @return int
 */
function indicePrimerPartidaGanada($coleccionPartidas,$nombreJugador){
    for($i=0; $i<COUNT($coleccionPartidas);$i++){
        if($coleccionPartidas[$i]["jugador"]==$nombreJugador){
            if($coleccionPartidas[$i]["puntaje"]>0){
                return $i;
            }
        }
    }
    return -1;
}

/**
 * Devuelve el nombre del jugador ingresado por el usuario en minuscula si solo ingreso letras.
 * @return string
 */
function solicitarJugador(){
    //String $nombre
    echo "Ingrese el nombre de un jugador: \n";
    $nombre = trim(fgets(STDIN));
    $nombre = strtolower($nombre);
    while (!esPalabra($nombre)) {
        echo "Ingrese el nombre de un jugador y solo utilice letras: \n";
        $nombre = strtolower(trim(fgets(STDIN)));
    }
    return $nombre;
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

/**
 * Devuelve un array con el resumen de un jugador.
 * @param array $coleccionPartidas
 * @return array
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

    echo "Ingresar nombre de jugador: \n";
    $nombreJugador = trim(fgets(STDIN));
    // Busca el nombre del jugador ingresado en la coleccion de partidas.
    for($i=0;$i<COUNT($coleccionPartidas);$i++){
        if($coleccionPartidas[$i]["jugador"]==$nombreJugador){
            
            $numeroPartidas++;
            $puntajeTotal+= $coleccionPartidas[$i]["puntaje"];
            
            if ($coleccionPartidas[$i]["intentos"]<=6){
                $victorias++;
            }
            
            switch($coleccionPartidas[$i]["intentos"]){
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
    // Se crea un arreglo $resumenJugador con todos los datos del jugador ingresado.
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

/**
 * Ordena una coleccion en base al nombre de los jugadores y las palabras.
 * @param array $coleccionPartidas
 */
function mostrarPartidaOrdenada($coleccionPartidas){
    //INT $orden, ARRAY $a, $b
    function comparacionJugador($a, $b) {
            if ($a["jugador"] == $b["jugador"]) {
                $orden = 0;
            }
            elseif($a["jugador"] < $b["jugador"]) {
                $orden = -1;
            }
            else {
                $orden = 1;
            }
            return $orden;
    }
    array_multisort($coleccionPartidas, SORT_ASC);
    uasort($coleccionPartidas, "comparacionJugador");
    print_r($coleccionPartidas);
}



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:

// array $coleccionPalabras, $coleccionPartidas

//Inicialización de variables:

$coleccionPalabras = cargarColeccionPalabras();
$coleccionPartidas= cargarPartidas();

//Proceso:
do{
    $opcion = seleccionarOpcion($coleccionPalabras,$coleccionPartidas);
}while($opcion!=8);


//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);
