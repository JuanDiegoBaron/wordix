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
 * Inicializa la colección de palabras (Punto 1)
 * @return array
 */
function cargarColeccionPalabras(){

    // array $coleccionPalabras

    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "JAMON", "PALMA", "PERRO", "TARRO", "TECHO"
    ];

    return $coleccionPalabras;
}

/** 
* Inicializa la colección de partidas (Punto 2)
* @return array
*/
function cargarPartidas(){

    // array $coleccionPartidas

    $coleccionPartidas=[
        ["palabraWordix"=>"RASGO","jugador"=>"pedro","intentos"=>6,"puntaje"=>0],
        ["palabraWordix"=>"CASAS","jugador"=>"juan","intentos"=>4,"puntaje"=>13],
        ["palabraWordix"=>"GATOS","jugador"=>"miguel","intentos"=>2,"puntaje"=>15],
        ["palabraWordix"=>"FUEGO","jugador"=>"nicolas","intentos"=>3,"puntaje"=>11],
        ["palabraWordix"=>"RASGO","jugador"=>"nicolas","intentos"=>5,"puntaje"=>12],
        ["palabraWordix"=>"QUESO","jugador"=>"juan","intentos"=>1,"puntaje"=>15],
        ["palabraWordix"=>"MUJER","jugador"=>"marta","intentos"=>1,"puntaje"=>16],
        ["palabraWordix"=>"YUYOS","jugador"=>"fernanda","intentos"=>6,"puntaje"=>0],
        ["palabraWordix"=>"JAMON","jugador"=>"ramon","intentos"=>5,"puntaje"=>11],
        ["palabraWordix"=>"PALMA","jugador"=>"juan","intentos"=>3,"puntaje"=>13],
    ];
    return $coleccionPartidas;
}

/**
 * Imprime el resultado de la partida jugada
 * @param $partida
 */
function imprimirResultadoPartida($partida){
    echo "-----------------------------\n";
    echo "Palabra: ". $partida["palabraWordix"]."\n";
    echo "Jugador: ". $partida["jugador"]."\n";
    if ($partida["intentos"]==0) {
        echo "Intentos: Usted no adivino la palabra en 6 intentos. \n";
    }
    else {
        echo "Intentos: ". $partida["intentos"]."\n";
    }
    echo "Puntaje: ". $partida["puntaje"]."\n";
    echo "-----------------------------\n";
}

/** 
 * Juega una partida de wordix con una palabra elegida por el jugador (OPCION 1)
 * @param array $coleccionPartidas
 * @param array $coleccionPalabras
 */
function jugarWordixConPalabraElegida($coleccionPartidas,$coleccionPalabras){
    
    // String $nombreJugador, palabra
    // Int $numeroPalabra
    // boolean $usada
    // array $partida
    
    $nombreJugador = solicitarJugador();
    $usada = TRUE;
    do{

        echo "Ingresa un numero entre 0 y ".(count($coleccionPalabras)-1).": ";
        $numeroPalabra = solicitarNumeroEntre(0,COUNT($coleccionPalabras)-1);
        $palabra = $coleccionPalabras[$numeroPalabra];
        $usada=palabraUsada($nombreJugador,$palabra,$coleccionPartidas);
        if ($usada) {
            echo "Ya has jugado con esta palabra \n";
        }
    } while($usada);
    
    $partida = jugarWordix($palabra, $nombreJugador);
    echo "Partida finalizada! \n";
    imprimirResultadoPartida($partida);
    array_push($coleccionPartidas,$partida);
    return $coleccionPartidas;

}

/** -
 * Juega una partida de wordix con una palabra aleatoria (OPCION 2)
 * @param array $coleccionPartidas
 * @param array $coleccionPalabras
 */
function jugarWordixConPalabraAleatoria($coleccionPartidas,$coleccionPalabras){
    
    // String $nombreJugador, $palabra
    // Int $i
    // Boolean $usada
    // array $partida

    $nombreJugador = solicitarJugador();
    $usada=TRUE;
    do{
        $palabra=$coleccionPalabras[array_rand($coleccionPalabras,1)];
        // Verifica si el usuario ya jugo con esa palabra.
        $usada=palabraUsada($nombreJugador,$palabra,$coleccionPartidas);
        if ($usada) {
            echo "Ya has jugado con esta palabra \n";
        }
    }while($usada);

    $partida = jugarWordix($palabra, $nombreJugador);
    echo "Partida finalizada!\n";
    imprimirResultadoPartida($partida);
    array_push($coleccionPartidas,$partida);
    return $coleccionPartidas;
}

/**
 * muestra una partida segun un numero ingresado (OPCION 3)
 * @param $coleccionPartidas
 */
function mostrarPartida($coleccionPartidas){
    
    // Int $numeroPartida
    // array $partida
    
    echo "Ingresa un numero entre 0 y ".(count($coleccionPartidas)-1)." : ";
    $numeroPartida = solicitarNumeroEntre(0,COUNT($coleccionPartidas)-1);
    $partida = $coleccionPartidas[$numeroPartida];
    echo "***********************\n";
    echo "Partida Wordix ". $numeroPartida. ": palabra ". $partida["palabraWordix"]."\n";
    echo "jugador: ". $partida["jugador"]."\n";
    echo "puntaje: ". $partida["puntaje"]. " puntos\n";
    if ($partida["intentos"]==0){
        echo "Intentos: Usted no adivino la palabra en 6 intentos. \n";
    }
    else {
        echo "Intentos: ". $partida["intentos"]."\n"; 
    }
    echo "***********************\n";
}  



/**
 * Devuelve verdadero si el jugador ya se encuentra en la coleccion.
 * @param string $nombreJugador
 * @param array $coleccionPartidas
 * @return boolean
 */
function jugadorExiste($nombreJugador, $coleccionPartidas) {
    //boolean $existe
    $existe = true;
    foreach ($coleccionPartidas as $value) {
        if ($value["jugador"]==$nombreJugador) {
            $existe = true;
            break;
        }
        else {
            $existe = false;
        }
    }
    return $existe;
}


/**
 * Muestra la primer partida que gano un jugador (OPCION 4)
 * @param $coleccionPartidas
 */
function mostrarPrimerVictoria($coleccionPartidas){
    // String $jugador
    // Array $partida
    $jugador = solicitarJugador();
    if (jugadorExiste($jugador, $coleccionPartidas)) {
        if (indicePrimerPartidaGanada($coleccionPartidas,$jugador)==-1) {
            echo "El jugador no gano ninguna partida\n";
        }
        else {
            $partida=$coleccionPartidas[indicePrimerPartidaGanada($coleccionPartidas,$jugador)];
            imprimirResultadoPartida($partida);
        }
    }
    else {
        echo "No existe jugador \n";
    }
}


/**
 * muestra el resumen de un jugador (Opcion 5)
 * @param array
 */
function mostrarResumenJugador($resumenJugador){

    // Float $porcentajeVictorias
    if($resumenJugador["partidas"]!=0){
        $porcentajeVictorias= ($resumenJugador["victorias"]*100)/$resumenJugador["partidas"];
    }
    else{
        $porcentajeVictorias=0;
    }
    echo "*************************************\n";
    echo "Jugador: ". $resumenJugador["nombreJugador"]."\n";
    echo "Partidas: ". $resumenJugador["partidas"]."\n";
    echo "Puntaje Total: ". $resumenJugador["puntaje"]."\n";
    echo "Victorias: ". $resumenJugador["victorias"]."\n";
    echo "Porcentaje Victorias: ". $porcentajeVictorias."%\n";
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
 * @param array $coleccionPalabras
 * @param array $coleccionPartidas
 * @return int
 */
function seleccionarOpcion($coleccionPalabras,$coleccionPartidas) {
    
    //int $numOpcion
    
    do{
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
                //echo "\n";
                //echo "Antes de llamar a la Funcion palabra elegida";
                //echo "\n";
                //print_r($coleccionPartidas);
                //echo "\n";
                $coleccionPartidas = jugarWordixConPalabraElegida($coleccionPartidas,$coleccionPalabras);
                //echo "\n";
                //echo "despues de llamar a la funcion palabra elegida";
                //echo "\n";
                //print_r($coleccionPartidas);
                //echo "\n";
                break;
            case 2:
                //echo "Jugar al Wordix con una palabra aleatoria \n";
                $coleccionPartidas = jugarWordixConPalabraAleatoria($coleccionPartidas,$coleccionPalabras);
                break;
            case 3:
                //echo "Mostrar una partida \n";
                mostrarPartida($coleccionPartidas);
                break;
            case 4:
                //echo "Mostrar la primer partida ganadora \n";
                mostrarPrimerVictoria($coleccionPartidas);
                break;
            case 5:
                //echo "Mostrar resumen de Jugador \n";
                mostrarResumenJugador(resumenJugador($coleccionPartidas));
                break;
            case 6:
                //echo "Mostrar listado de partidas ordenadas por jugador y por palabra \n";
                mostrarPartidaOrdenada($coleccionPartidas);
                break;
            case 7:
                // echo "Agregar una palabra de 5 letras a Wordix \n";
                $coleccionPalabras = agregarPalabra($coleccionPalabras,leerPalabra5Letras());
                // echo "coleccion palabras actualizada"."\n";
                print_r($coleccionPalabras);
                break;
            default:
                //echo "Salir \n";
                break;
        }
    }while($numOpcion!=8);
}

/**
 * devuelve el indice de la primer partida ganada por un jugador
 * @param array $coleccionPartidas
 * @param string $nombreJugador
 * @return int
 */
function indicePrimerPartidaGanada($coleccionPartidas,$nombreJugador){
    
    // Int $indice
    
    for($i=0; $i<COUNT($coleccionPartidas);$i++){
        if($coleccionPartidas[$i]["jugador"]==$nombreJugador){
            if($coleccionPartidas[$i]["puntaje"]>0){
                $indice = $i;
                break;
            }
            else {
                $indice = -1;
            }
        }
    }
    return $indice;
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
 * Verifica si una palabra fue usada por un jugador
 * @param string $jugador
 * @param string $palabra
 * @param array $coleccionPartidas
 * @return boolean
 */
function palabraUsada($jugador,$palabra,$coleccionPartidas){
    
    // boolean $usada
    
    $usada = false;
    for ($i=0;$i<COUNT($coleccionPartidas);$i++){
        if ($coleccionPartidas[$i]["jugador"]==$jugador){
            if($coleccionPartidas[$i]["palabraWordix"]==$palabra){
                $usada = TRUE;
                break;
            }
            else{
                $usada = FALSE;
            }
        }
    }
    return $usada;
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
    
    // Int $puntajeTotal, $numeroPartidas, $victorias, $intento1, $intento2, $intento3, $intento4, $intento5, $intento6
    // String $nombreJugador
    // array $resumenJugador

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
            
            switch($coleccionPartidas[$i]["intentos"]){
                case 1: 
                    $intento1++;
                    $victorias++;
                    break;
                case 2: 
                    $intento2++;
                    $victorias++;
                    break;
                case 3: 
                    $intento3++;
                    $victorias++;
                    break;
                case 4: 
                    $intento4++;
                    $victorias++;
                    break;
                case 5: 
                    $intento5++;
                    $victorias++;
                    break;
                case 6: 
                    $intento6++;
                    $victorias++;
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
    //INT $orden 
    //ARRAY $a, $b
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
$coleccionPartidas = cargarPartidas();

//Proceso:
seleccionarOpcion($coleccionPalabras,$coleccionPartidas);



//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);



/*

propuesta:

palabrasJugador= ["MELON","TARRO","MUJER"];

*/