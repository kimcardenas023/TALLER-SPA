<?php

declare(strict_types=1); //estricto con los tipos de datos

// INICIO DEL PROGRAMA

// CONFIGURACION

// CONSTANTES NO CAMBIAN DURANTE LA EJECU..

const la_hora_minima = 8;
const la_hora_maxima = 18;
const comision_alta= 0.12;
const comision_baja = 0.08;
const citas_minimas = 6;
const bono_facturacion = 50000;
const dias_de_la_semana = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado'];



// CATALOGO DE SERVICIOS
// arreglo multidimensional asociativo

$servicios = [
    1 => ['nombre' => 'Limpieza facial', 'precio' => 80000, 'duracion' => 2],
    2 => ['nombre' => 'Manicure', 'precio' => 35000, 'duracion' => 1],
    3 => ['nombre' => 'Pedicure', 'precio' => 40000, 'duracion' => 1],
    4 => ['nombre' => 'Masaje relajante', 'precio' => 90000, 'duracion' => 1],
    5 => ['nombre' => 'Masaje descontracturante', 'precio' => 100000, 'duracion' => 1],
    6 => ['nombre' => 'Exfoliacion corporal', 'precio' => 60000, 'duracion' => 1],
    7 => ['nombre' => 'Tratamiento antiedad', 'precio' => 120000, 'duracion' => 2],
];

// AGENDA

$agenda = []; //NOHAYEMPLE.. empleado 1/ nombre/  especialidad/  citas

// ESTADO DE DATOS DE PRUEBA

//variable booleana
$datos_prueba_cargados = false; //PARA EL DP cambia a true


// FUNCION DE FORMATO //


// funcion: FORMATEAR MONEDA

function formatear_moneda(int $valor): string //la funcion devuelve un string
{
    return '$' . number_format($valor, 0, ',', '.');
}



                                   // FUNCIONES DE VALIDACION //

//  solicitar_texto()
//  solicitar_respuesta_si_no()
//  solicitar_numero_empleado()
//  solicitar_hora()
//  solicitar_dia()
//  solicitar_servicio()

//  REALIZAN -> pedir → validar → repetir si esta mal → devolver si esta bien







// funcion: SOLICITAR TEXTO

function solicitar_texto(string $mensaje): string
{
    do { //EJECUTA EL CODIGO POR AL MENOS UNA VEZ
        $texto = trim(readline($mensaje));
        //TRIM -> Elimina espacios al principio y final
        if ($texto === '') {
            echo "Mi vida el campo no puede estar vacio.\n";
        }
    } while ($texto === '');

    return $texto;
}


// funcion: SOLICITAR RESPUESTA SI O NO

function solicitar_respuesta_si_no(string $mensaje): string
{
    do {//EJECUTA EL CODIGO POR AL MENOS UNA VEZ
        $respuesta = strtolower(trim(readline($mensaje)));
                //strtolower -> convierte la respuesta a minusculas
                //trim -> elimina espacios

        if ($respuesta !== 's' && $respuesta !== 'n') {
             //!== -> es Diferente de 

            echo "Respuesta invalida mi vida porfavor escribe s o n.\n";
        }
    } while ($respuesta !== 's' && $respuesta !== 'n');

    return $respuesta;
}


// funcion: SOLICITAR EMPLEADO

function solicitar_numero_empleado(array $agenda): int 
//verificar si el empleado existe y esta recibe un array $agenda y devuelve un int
{
    do {
        $entrada = trim(readline("Selecciona el numero del empleado: ")); //string

        if (!ctype_digit($entrada)) {
            //comprueba si el texto contiene solamente numeros
           //!ctype_digit -> verificar que sean solo numeros
           // ! -> NO

            echo "Debe ingresar un numero valido Mi vida.\n";
            continue; //vuelve  a pedir el dato si es incorrecto
        }

        $numero_empleado = (int) $entrada; //convierte $entrada de string por int

        if (!isset($agenda[$numero_empleado])) {
            //verifica que el empleado exista

            echo "Ese empleado no existe Mi vida.\n";
            continue;//vuelve  a pedir el dato si es incorrecto
        }

        return $numero_empleado;
    } while (true);
}

// funcion: SOLICITAR HORA

function solicitar_hora(): int //no necesita recibir informacion, ella pide inf al usuario 
{
    do {
        $entrada = trim(readline("Ingrese la hora para agendar su cita,
         Recuerde que nuestro horario de atencion es de 8am a 18 pm: "));

        if (!ctype_digit($entrada)) { 
           //comprueba si el texto contiene solamente numeros
           //!ctype_digit -> verificar que sean solo numeros
           // ! -> NO

            echo "La hora debe ser un numero.\n";
            continue;//vuelve  a pedir el dato si es incorrecto
        }

        $hora = (int) $entrada; //convierte $entrada de string por int y ...
                                //se la asigna a la variable $hora

        if ($hora < la_hora_minima || $hora > la_hora_maxima) {
            echo "Recuerda mi vida que la hora debe estar entre 8 y 18.\n";
            continue;//vuelve  a pedir el dato si es incorrecto
        }

        return $hora; // retorna la hora si es valido
    } while (true);
}


// funcion: SOLICITAR DIA

function solicitar_dia(): string // no recibe parametro pero debe 
                                 // devolver un dato de tipo string
{
    do {
        $dia = strtolower(trim(readline("Ingresa el dia que quieres agendar Mi vida recuerda que es de lunes a sabado): ")));
               //strtolower -> convierta lo escrito a minusculas


        if ($dia === 'miercoles') { //Valor + tipo de dato o sea tiene...
                                    // que ser el mismo valor y el mismo tipo

            $dia = 'miercoles'; //asigna
        }

        if ($dia === 'sabado') {
            $dia = 'sabado'; //asigna
        }

        if (!in_array($dia, dias_de_la_semana, true)) {
            //!in_array -> Si el dia NO esta en la lista
            // true -> compara de manera estricta y verificando 
            //         el valor y tambien el tipo de dato


            echo "dia invalido recuerde que debe ser de lunes a sabado.\n";
            continue;//Salta el resto del ciclo y vuelve al inicio del do
        }

        return $dia; //si es valido retorne el dia
    } while (true);
}


// funcion: SOLICITAR SERVICIO 


function solicitar_servicio(array $servicios): int
              //array $servicios -> recibe el catalogo de servicios
{
    do {
        $entrada = trim(readline("Seleccione el numero del servicio: "));
        //trim -> elimina espacios


        if (!ctype_digit($entrada)) {
           //!ctype_digit -> verificar que sean solo numeros
           // ! -> NO

            echo "Debe ingresar un numero valido.\n";
            continue;//Salta el resto del ciclo y vuelve al inicio del do
    }

        $numero_servicio = (int) $entrada; //convierte de string a int

        if (!isset($servicios[$numero_servicio])) {
            // [ ] -> buscar un elemento dentro de un array
            //!isset -> verifica que exista

            echo "Ese servicio no existe en el catalogo.\n";
            continue;//Salta el resto del ciclo y vuelve al inicio del do
                    }

        return $numero_servicio;
 } while (true);
}





                                // FUNCIONES DE MOSTRAR INFORMACION //
// mostrar_empleados()
// mostrar_servicios()



 
// funcion: MOSTRAR EMPLEADOS
function mostrar_empleados(array $agenda): void{  //no devuelve ningun valor 
    echo "\n";
    echo "====== EMPLEADOS ======\n";
    echo "N° | Nombre | Especialidad\n"; 
    echo "-------------------------\n";

    foreach ($agenda as $numero_empleado => $empleado) {
      //aqui PHP va a recorrer uno por uno los 
      // empleados que estan dentro de $agenda y muestra los datos de este

        echo $numero_empleado . " | ";
        echo $empleado['nombre'] . " | ";
        echo $empleado['especialidad'] . "\n";}
    echo "-------------------------\n";
}

// funcion: MOSTRAR SERVICIOS

function mostrar_servicios(array $servicios): void{
    echo "\n";
    echo "====== SERVICIOS ======\n";
    echo "N° | Servicio | Precio | Duración\n";
    echo "---------------------------------\n";

    foreach ($servicios as $numero_servicio => $servicio) {
        echo $numero_servicio . " | ";
        echo $servicio['nombre'] . " | "; //busca el campo nombre
        echo formatear_moneda($servicio['precio']) . " | ";
        echo $servicio['duracion'] . " hr)\n";}
    echo "---------------------------------\n";
}






                           // FUNCIONES DE CALCULO //

// calcular_duracion_cita()
// calcular_total_cita()
// obtener_nombres_servicios()


// FUNCIONES DE CALCULO

// funcion: CALCULAR DURACION DE UNA CITA


function calcular_duracion_cita(array $cita, array $servicios): int
//estamos recorriendo solamente los servicios que cierta cita

{
    $duracion_total = 0; //acumulador para sumar las duraciones

    foreach ($cita['servicios'] as $numero_servicio) { //arreglo de la cita e ind de serv..
        $duracion_total += $servicios[$numero_servicio]['duracion'];
        // += -> sumarle algo a lo que ya tiene la variable

    }

    return $duracion_total;
}



// funcion: CALCULAR TOTAL DE UNA CITA

function calcular_total_cita(array $cita, array $servicios): int
{
    $total = 0; //vamos a ir sumando los precios

    foreach ($cita['servicios'] as $numero_servicio) {
        //$cita['servicios']->  Dame los servicios que tiene la cita
        // as $numero_servicio) -> variable guarda cada servicio mientras recorre el array

        $total += $servicios[$numero_servicio]['precio'];
        // busca el precio del servicio actual y lo suma al total

    }

    return $total;
}


// funcion: OBTENER NOMBRES DE SERVICIOS

function obtener_nombres_servicios(array $cita, array $servicios): string //masaje - manicure
{
    $nombres = [];

    foreach ($cita['servicios'] as $numero_servicio) {
        $nombres[] = $servicios[$numero_servicio]['nombre'];
    }

    return implode(', ', $nombres);
    //implode -> unir los elementos de un arreglo en un solo texto

}



// REGISTRO DE EMPLEADOS

// funcion: REGISTRAR EMPLEADO

function registrar_empleado(array &$agenda): void //no devuelve nada
//& -> La funcion puede modificar directamente el $agenda original
//REALIZA -> Agregar empleados a la agenda

{
    do { //Ejecuta estas instrucciones por lo menos una vez
        $nombre = solicitar_texto("Ingrese el nombre del empleado: ");
        //lo que se escribio en esa funcion lo guardo en $nombre

        $especialidad = solicitar_texto("Ingrese la especialidad: ");

        $numero_empleado = count($agenda) + 1;
        //count -> contar cuantos elementos hay en un array


        //clave - valor 
        $agenda[$numero_empleado] = [
            'nombre' => $nombre,
            'especialidad' => $especialidad,
            'citas' => [], //vacio para guardar las citas de ese empleado
        ];

        echo "\nEmpleado registrado correctamente.\n";

        $registrar_otro = solicitar_respuesta_si_no("¿Desea registrar otro empleado? (s/n): " );
    } while ($registrar_otro === 's'); //sea exactamente 's' 
}




// REGISTRO DE CITAS

// funcion: REGISTRAR CITA
//Pide y valida el numero del servicio

function registrar_cita(array &$agenda, array $servicios): void
{
    if (count($agenda) === 0) {
        echo "\nNo hay empleados registrados.\n";
        echo "Primero debe registrar un empleado.\n";
        return;
    }

    mostrar_empleados($agenda);

    $numero_empleado = solicitar_numero_empleado($agenda);

    $cliente = solicitar_texto("Ingrese el nombre del cliente: ");
    $dia = solicitar_dia();
    $hora = solicitar_hora();

    $servicios_cita = [];

    do {
        mostrar_servicios($servicios);

        $numero_servicio = solicitar_servicio($servicios);
        $servicios_cita[] = $numero_servicio;

        $agregar_otro = solicitar_respuesta_si_no(
            "¿Desea agregar otro servicio? (s/n): "
        );
    } while ($agregar_otro === 's');

    $agenda[$numero_empleado]['citas'][] = [
        'cliente' => $cliente,
        'dia' => $dia,
        'hora' => $hora,
        'servicios' => $servicios_cita,
    ];

    echo "\nCita registrada correctamente.\n";
}

// FACTURACIÓN

// funcion: CALCULAR FACTURACIÓN

function calcular_facturacion_empleados(array $agenda, array $servicios): array
{
    $facturacion = [];

    foreach ($agenda as $numero_empleado => $empleado) {
        $total = 0;

        foreach ($empleado['citas'] as $cita) {
            $total += calcular_total_cita($cita, $servicios);
        }

        $facturacion[$numero_empleado] = $total;
    }

    arsort($facturacion); //ordena la facturacion de mayor a menor 

    return $facturacion;
}

// funcion: MOSTRAR Facturacion

function mostrar_total_facturado(array $agenda, array $servicios): void
{
    if (count($agenda) === 0) {
        echo "\nNo hay empleados registrados.\n";
        return;
    }

    $facturacion = calcular_facturacion_empleados($agenda, $servicios);

       echo "\n";
    echo "========= FACTURACIÓN =========\n";
    echo "Empleado | Citas | Total facturado\n";
    echo "----------------------------------\n";

    foreach ($facturacion as $numero_empleado => $total) {
       
    $cantidad_citas = count($agenda[$numero_empleado]['citas']);
echo $agenda[$numero_empleado]['nombre'] . " | ";
        echo $cantidad_citas . " | ";
        echo formatear_moneda($total) . "\n";
    }
echo "----------------------------------\n";
}

// SERVICIO MAS SOLICITADO

// funcion: CALCULAR SERVICIOS SOLICITADOS

function calcular_servicios_solicitados(array $agenda, array $servicios): array
{
    $estadisticas = [];

    foreach ($servicios as $numero_servicio => $servicio) {
        $estadisticas[$numero_servicio] = [
            'cantidad' => 0,
            'total' => 0,
        ];
    }

    foreach ($agenda as $empleado) {
        foreach ($empleado['citas'] as $cita) {
            foreach ($cita['servicios'] as $numero_servicio) {
                $estadisticas[$numero_servicio]['cantidad']++;
                $estadisticas[$numero_servicio]['total'] += $servicios[$numero_servicio]['precio'];
            }
        }
    }

    return $estadisticas;
}

// funcion: MOSTRAR SERVICIO MÁS SOLICITADO

function mostrar_servicio_mas_solicitado(array $agenda, array $servicios): void
{
    if (count($agenda) === 0) {
        echo "\nNo hay datos registrados.\n";
        return;
    }

    $estadisticas = calcular_servicios_solicitados($agenda, $servicios);

    $servicio_mas_solicitado = null;
    $mayor_cantidad = 0;

    foreach ($estadisticas as $numero_servicio => $estadistica) {
        if ($estadistica['cantidad'] > $mayor_cantidad) {
            $mayor_cantidad = $estadistica['cantidad'];
            $servicio_mas_solicitado = $numero_servicio;
        }
    }

    if ($servicio_mas_solicitado === null) {
        echo "\nNo hay servicios registrados.\n";
        return;
    }

    $total_facturado = $estadisticas[$servicio_mas_solicitado]['total'];

     echo "\n";
    echo "====== SERVICIO MAS SOLICITADO ======\n";
    echo "Servicio | Veces | Total facturado\n";
    echo "------------------------------------\n";

    echo $servicios[$servicio_mas_solicitado]['nombre'] . " | ";
    echo $mayor_cantidad . " | ";
    echo formatear_moneda($total_facturado) . "\n";

    echo "------------------------------------\n";
}

// AGENDA POR DIA

// funcion: OBTENER CITAS DEL DIA

function obtener_citas_del_dia(array $agenda, string $dia): array
{
    $citas_del_dia = [];

    foreach ($agenda as $numero_empleado => $empleado) {
        foreach ($empleado['citas'] as $cita) {
            if ($cita['dia'] === $dia) {
                $citas_del_dia[] = [
                    'empleado' => $empleado['nombre'],
                    'cliente' => $cita['cliente'],
                    'hora' => $cita['hora'],
                    'servicios' => $cita['servicios'],
                ];
            }
        }
    }

    usort($citas_del_dia, function (array $cita_a, array $cita_b): int {
        //ordenar las citas por hora con usort 
        return $cita_a['hora'] <=> $cita_b['hora']; //operador de comparacion para ordenar
    });

    return $citas_del_dia;
}

// funcion: MOSTRAR AGENDA DEL DIA

function mostrar_agenda_dia(array $agenda, array $servicios): void
{
    if (count($agenda) === 0) {
        echo "\nNo hay datos registrados.\n";
        return;
    }

    $dia = solicitar_dia();
    $citas = obtener_citas_del_dia($agenda, $dia);

    echo "\n";
    echo "========== AGENDA DEL DIA: " . strtoupper($dia) . " ==========\n"; 
    //strtoupper -> convertir un texto completo a MAYUSCULAS 

    if (count($citas) === 0) {
        echo "No hay citas registradas para este dia.\n";
        return;
    }

    echo "Hora | Empleado | Cliente | Servicios\n";
    echo "--------------------------------------\n";

    foreach ($citas as $cita) {
        echo $cita['hora'] . ":00 | ";
        echo $cita['empleado'] . " | ";
        echo $cita['cliente'] . " | ";
        echo obtener_nombres_servicios($cita, $servicios) . "\n";
    }

    echo "--------------------------------------\n";
}

// Deteccion de conflictos

// funcion: DETECTAR CONFLICTOS

function detectar_conflictos(array $agenda, array $servicios): array
{
    $conflictos = [];

    foreach ($agenda as $numero_empleado => $empleado) {
        $citas = $empleado['citas'];
        $cantidad_citas = count($citas);

        for ($indice_a = 0; $indice_a < $cantidad_citas; $indice_a++) {
            $cita_a = $citas[$indice_a];

            $inicio_a = $cita_a['hora'];
            $duracion_a = calcular_duracion_cita($cita_a, $servicios);
            $fin_a = $inicio_a + $duracion_a;

            for ($indice_b = $indice_a + 1; $indice_b < $cantidad_citas; $indice_b++) {
                $cita_b = $citas[$indice_b];

                if ($cita_a['dia'] !== $cita_b['dia']) {
                    continue;
                }

                $inicio_b = $cita_b['hora'];
                $duracion_b = calcular_duracion_cita($cita_b, $servicios);
                $fin_b = $inicio_b + $duracion_b;

                $hay_solapamiento = $inicio_a < $fin_b && $inicio_b < $fin_a;

                if ($hay_solapamiento) {
                    $conflictos[] = [
                    'empleado' => $empleado['nombre'],
                    'dia' => $cita_a['dia'],
                    'cliente_a' => $cita_a['cliente'],
                    'inicio_a' => $inicio_a,
                     'fin_a' => $fin_a,
                    'cliente_b' => $cita_b['cliente'],
                    'inicio_b' => $inicio_b,
                    'fin_b' => $fin_b,
                    ];
  }
 }
} 
 }
    return $conflictos;
}

// funcion: MOSTRAR CONFLICTOS

function mostrar_conflictos(array $agenda, array $servicios): void
{
    if (count($agenda) === 0) {
        echo "\nNo hay datos registrados.\n";
        return;
    }

    $conflictos = detectar_conflictos($agenda, $servicios);

    echo "\n";
    echo "=========== CONFLICTOS DE AGENDA ===========\n";

    if (count($conflictos) === 0) {
        echo "No se encontraron conflictos de agenda.\n";
        return;
    }

      echo "Empleado | dia | Cita 1 | Cita 2\n";
    echo "----------------------------------\n";

    foreach ($conflictos as $conflicto) {

        $cita_1 = $conflicto['cliente_a'] . " (" .
                  $conflicto['inicio_a'] . ":00-" .
                  $conflicto['fin_a'] . ":00)";

        $cita_2 = $conflicto['cliente_b'] . " (" .
                  $conflicto['inicio_b'] . ":00-" .
                  $conflicto['fin_b'] . ":00)";

        echo $conflicto['empleado'] . " | ";
        echo $conflicto['dia'] . " | ";
        echo $cita_1 . " | ";
        echo $cita_2 . "\n";
    }

    echo "----------------------------------\n";
}

// liquidacion DE comisiones

// funcion: CALCULAR COMISIONES

function calcular_comisiones(array $agenda, array $servicios): array
{
    $facturacion = calcular_facturacion_empleados($agenda, $servicios);


    //if - else rapido
    //condicion -v -f 
    //operad... tern..

    $mayor_facturacion = count($facturacion) > 0 ? max($facturacion) : 0;// obtener la maxima...
    //facturacion  de lo contrario poner cero
// operador ternario

    $comisiones = [];

    foreach ($agenda as $numero_empleado => $empleado) {
        $cantidad_citas = count($empleado['citas']);
        $total_facturado = $facturacion[$numero_empleado];

        if ($cantidad_citas >= citas_minimas) {
            $porcentaje = comision_alta;
        } else {
            $porcentaje = comision_baja;
        }

        $comision = (int) round($total_facturado * $porcentaje);// round -> Redondea el resultado
        $bono = 0;

        if ($total_facturado === $mayor_facturacion && $mayor_facturacion > 0) {
            $bono = bono_facturacion;
        }

        $comisiones[$numero_empleado] = [
       'citas' => $cantidad_citas,
        'facturado' => $total_facturado,
     'porcentaje' => $porcentaje,
     'comision' => $comision,
     'bono' => $bono,
     'total' => $comision + $bono,
        ];
    }

    return $comisiones;
}

// funcion:mostrar liquidaciomm

function mostrar_liquidacion_comisiones(array $agenda, array $servicios): void
{
    if (count($agenda) === 0) {
        echo "\nNo hay datos registrados.\n";
        return;
    }

    $comisiones = calcular_comisiones($agenda, $servicios);

    echo "\n";
    echo "============= COMISIONES =============\n";
    echo "Empleado | Citas | Facturado | comision | Bono | Total\n";
    echo "-------------------------------------------------------\n";

    foreach ($comisiones as $numero_empleado => $datos) {

        echo $agenda[$numero_empleado]['nombre'] . " | ";
        echo $datos['citas'] . " | ";
        echo formatear_moneda($datos['facturado']) . " | ";
        echo formatear_moneda($datos['comision']) . " | ";
        echo formatear_moneda($datos['bono']) . " | ";
        echo formatear_moneda($datos['total']) . "\n";
    }

    echo "-------------------------------------------------------\n";
}

// DATOS DE PRUEBA

// funcion: CARGAR DATOS DE PRUEBA

function cargar_datos_prueba(array &$agenda, bool &$datos_prueba_cargados): void
{
    $agenda = [
        1 => [
            'nombre' => 'Laura',
            'especialidad' => 'Masajes',
            'citas' => [
                ['cliente' => 'María', 'dia' => 'lunes', 'hora' => 9, 'servicios' => [4, 2]],
                ['cliente' => 'Carlos', 'dia' => 'lunes', 'hora' => 11, 'servicios' => [5]],
                ['cliente' => 'Ana', 'dia' => 'martes', 'hora' => 9, 'servicios' => [4, 3]],
                ['cliente' => 'Sofía', 'dia' => 'miercoles', 'hora' => 10, 'servicios' => [5, 6]],
                ['cliente' => 'Daniel', 'dia' => 'jueves', 'hora' => 9, 'servicios' => [4]],
                ['cliente' => 'Paula', 'dia' => 'viernes', 'hora' => 10, 'servicios' => [2, 3]],
            ],
        ],
        2 => [
            'nombre' => 'Camila',
            'especialidad' => 'Manicure y Pedicure',
            'citas' => [
                ['cliente' => 'Valentina', 'dia' => 'lunes', 'hora' => 8, 'servicios' => [2, 3]],
                ['cliente' => 'Juliana', 'dia' => 'martes', 'hora' => 11, 'servicios' => [2]],
                ['cliente' => 'Andrés', 'dia' => 'miercoles', 'hora' => 8, 'servicios' => [3]],
                ['cliente' => 'Natalia', 'dia' => 'jueves', 'hora' => 11, 'servicios' => [2, 3]],
            ],
        ],
        3 => [
            'nombre' => 'Sofía',
            'especialidad' => 'Tratamientos faciales',
            'citas' => [
                ['cliente' => 'Isabella', 'dia' => 'lunes', 'hora' => 14, 'servicios' => [1]],
                ['cliente' => 'Mateo', 'dia' => 'martes', 'hora' => 13, 'servicios' => [7, 6]],
                ['cliente' => 'Luciana', 'dia' => 'miercoles', 'hora' => 14, 'servicios' => [1]],
            ],
        ],
        4 => [
            'nombre' => 'Daniela',
            'especialidad' => 'Estética corporal',
            'citas' => [
                ['cliente' => 'Gabriela', 'dia' => 'lunes', 'hora' => 10, 'servicios' => [6, 4]],
                ['cliente' => 'Sebastián', 'dia' => 'lunes', 'hora' => 11, 'servicios' => [5]],
            ],
        ],
    ];

    $datos_prueba_cargados = true;

    echo "\n";
    echo "==========================================\n";
    echo " DATOS DE PRUEBA CARGADOS CORRECTAMENTE\n";
    echo "==========================================\n";
    echo "4 empleados registrados.\n";
    echo "15 citas registradas.\n";
    echo "Hay citas con multiples servicios.\n";
    echo "Hay un conflicto intencional.\n";
    echo "==========================================\n";
}

// menu principal

// funcion: MOSTRAR MENU

function mostrar_menu(): void
{
    echo "\n";
    echo "==========================================\n";
    echo "              ADSO-SPA\n";
    echo "==========================================\n";
    echo "1. Registrar empleado\n";
    echo "2. Registrar cita\n";
    echo "3. Total facturado por empleado\n";
    echo "4. Servicio mas solicitado\n";
    echo "5. Agenda de un día\n";
    echo "6. deteccion de conflictos\n";
    echo "7. liquidacion de comisiones\n";
    echo "8. Salir\n";
    echo "==========================================\n";
}

// funcion PRINCIPAL

// INICIAR PROGRAMA

function iniciar_programa(array &$agenda, array $servicios, bool &$datos_prueba_cargados): void
{
    do {
        mostrar_menu();

        $opcion = strtolower(trim(readline("Seleccione una opcion: ")));

             //strtolower -> convierte la respuesta a minusculas
        switch ($opcion) { //elige entre dif opcio
            case '1': //representa cd opc de switch 
                if ($datos_prueba_cargados) {
                    echo "\nLa opcion 1 no esta disponible.\n";
                    echo "Los datos de prueba ya fueron cargados.\n";
                    break;
                }

                registrar_empleado($agenda);
                break;

            case '2':
                if ($datos_prueba_cargados) {
                    echo "\nLa opcion 2 no esta disponible.\n";
                    echo "Los datos de prueba ya fueron cargados.\n";
                    break;
                }

                registrar_cita($agenda, $servicios);
                break;

            case '3':
                mostrar_total_facturado($agenda, $servicios);
                break;

            case '4':
                mostrar_servicio_mas_solicitado($agenda, $servicios);
                break;

            case '5':
                mostrar_agenda_dia($agenda, $servicios);
                break;

            case '6':
                mostrar_conflictos($agenda, $servicios);
                break;

            case '7':
                mostrar_liquidacion_comisiones($agenda, $servicios);
                break;

            case '8':
                echo "\nPrograma finalizado.\n";
                break;

            case 'dp':
                if ($datos_prueba_cargados) {
                    echo "\nLa opcion dp no esta disponible.\n";
                    echo "Los datos de prueba ya fueron cargados.\n";
                    break;
                }

                cargar_datos_prueba($agenda, $datos_prueba_cargados);
                break;

            default:
                echo "\n opcion invalida.\n";
                echo "Seleccione una opcion del 1 al 8.\n";
                break;
        }
    } while ($opcion !== '8');
}

// EJECUTAR DEL PROGRAMA

iniciar_programa($agenda, $servicios, $datos_prueba_cargados);