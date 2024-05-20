<?php session_start(); ?>
<?php
$conn = include "conexion/conexion.php";

// Función para calcular el ángulo de rotación basado en el nahual
function calcularAnguloPorNahual($nahual)
{
    // Define el mapeo de nahual a ángulo
    $mapeoNahual = [
        "Tzi'kin" => -73,
        "Ajmaq" => -90,
        "No'j" => -110,
        "Tijax" => -125,
        "Kawoq" => -145,
        "Ajpu" => -163,
        "Imox" => -180,
        "Iq'" => -198,
        "Aq'ab'al" => -218,
        "K'at" => -235,
        "Kan" => -255,
        "Kame" => -270,
        "Kej" => -290,
        "Q'anil" => -305,
        "Toj" => -325,
        "Tz'i'" => -345,
        "B'atz" => -360,
        "E" => -380,
        "Aj" => -397,
        "Ix" => -415,
    ];

    // Verifica si el nahual está en el mapeo
    if (isset($mapeoNahual[$nahual])) {
        return $mapeoNahual[$nahual]; // Devuelve el ángulo de rotación correspondiente al nahual
    } else {
        return 0; // Si no se encuentra el nahual en el mapeo, devuelve un ángulo predeterminado (0)
    }
}

// Función para calcular el ángulo de rotación basado en el numero
function calcularAnguloPorNumero($energia)
{
    // Define el mapeo de nahual a ángulo
    $mapeoEnergia = [
        "1" => -140,
        "2" => -116,
        "3" => -85,
        "4" => -55,
        "5" => -30,
        "6" => -360,
        "7" => 30,
        "8" => 55,
        "9" => 85,
        "10" => 110,
        "11" => 136,
        "12" => 165,
        "13" => 195,



    ];

    // Verifica si el nahual está en el mapeo
    if (isset($mapeoEnergia[$energia])) {
        return $mapeoEnergia[$energia]; // Devuelve el ángulo de rotación correspondiente al nahual
    } else {
        return 0; // Si no se encuentra el nahual en el mapeo, devuelve un ángulo predeterminado (0)
    }
}

// Función para calcular el simbolo de Haab
function obtenerImagenHaab($nombre_uinal) {
    $mapeoHaab = [
        "Pop" => "../img/haab/1_pop.png",
        "Woo" => "../img/haab/2_uo_haab.png",
        "Zip" => "../img/haab/sip.png",
        "Sotz'" => "../img/haab/4_zotz.png",
        "Tzek" => "../img/haab/5_tzec.png",
        "Xul" => "../img/haab/6_xul.png",
        "Yaxk'in" => "../img/haab/7_yaxkin.png",
        "Mol" => "../img/haab/8_mol.png",
        "Ch'en" => "../img/haab/chen.png",
        "Yax" => "../img/haab/10_yax.png",
        "Sak" => "../img/haab/11_zac.png",
        "Keh" => "../img/haab/12_ceh.png",
        "Mak" => "../img/haab/13_mac.png",
        "K'ank'in" => "../img/haab/14_kankin.png",
        "Muwan" => "../img/haab/15_muan.png",
        "Pax" => "../img/haab/16_pax.png",
        "K'ayab'" => "../img/haab/17_kayab.png"
    ];

    return isset($mapeoHaab[$nombre_uinal]) ? $mapeoHaab[$nombre_uinal] : "../img/calendario.png";
}

// Función para calcular la imagen del dia de Haab
function obtenerNumeroHaab($diauinal) {
    $mapeoHaab = [
        1 => "../img/cuentaLarga/1.png",
        2 => "../img/cuentaLarga/2.png",
        3 => "../img/cuentaLarga/3.png",
        4 => "../img/cuentaLarga/4.png",
        5 => "../img/cuentaLarga/5.png",
        6 => "../img/cuentaLarga/6.png",
        7 => "../img/cuentaLarga/7.png",
        8 => "../img/cuentaLarga/8.png",
        9 => "../img/cuentaLarga/9.png",
        10 => "../img/cuentaLarga/10.png",
        11 => "../img/cuentaLarga/11.png",
        12 => "../img/cuentaLarga/12.png",
        13 => "../img/cuentaLarga/13.png",
        14 => "../img/cuentaLarga/14.png",
        15 => "../img/cuentaLarga/15.png",
        16 => "../img/cuentaLarga/16.png",
        17 => "../img/cuentaLarga/17.png",
        18 => "../img/cuentaLarga/18.png",
        19 => "../img/cuentaLarga/19.png",
    ];

    return isset($mapeoHaab[$diauinal]) ? $mapeoHaab[$diauinal] : "../img/calendario.png";
}


// Variable para almacenar la fecha consulltada
$fecha_consultar = "";

// Verifica si se envió una fecha a través del formulario
if (isset($_GET['fecha'])) {
    $fecha_consultar = $_GET['fecha'];
} else {
    // Si no se envió una fecha, usa la fecha actual
    date_default_timezone_set('US/Central');
    $fecha_consultar = date("Y-m-d");
}

//Variables de calculos
$nahual = include 'backend/buscar/conseguir_nahual_nombre.php';
$energia = include 'backend/buscar/conseguir_energia_numero.php';
$haab = include 'backend/buscar/conseguir_uinal_nombre.php';
$cuenta_larga = include 'backend/buscar/conseguir_fecha_cuenta_larga.php';
$cholquij = $nahual . " " . strval($energia);
$nombreNahual = $nahual;
$dia = strval($energia);
list($nombre_uinal, $diauinal) = explode(' ', $haab, 2);
$imagenHaab = obtenerImagenHaab($nombre_uinal);
$imagenDia = obtenerNumeroHaab($diauinal);

//echo "Nombre Uinal: " . $haab . "<br>";
//echo "Imagen Haab: " . $imagenHaab . "<br>";

?>

<head>
    <meta charset="utf-8">
    <title>Rueda Calendarica</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?php include "blocks/bloquesCss.html" ?>
    <link rel="stylesheet" href="../css/ruedaCalendarica.css?v=<?php echo (rand()); ?>">
    <link rel="stylesheet" href="css/estilo.css?v=<?php echo (rand()); ?>" />

    <script src="../js/fondoDinamico.js"></script>
</head>

<body>

    <?php include "NavBar.php" ?>
    <div>

        <section id="inicio">
            <div id="inicioContainer" class="inicio-container">

                <div id='formulario'>
                    <h1>Rueda</h1>
                    <h1>Calendarica</h1>
                    <form action="#" method="GET" id="form-calcular-tzolkin">
                        <div class="mb-1">
                            <input type="date" class="form-control" name="fecha" id="fecha"
                                value="<?php echo isset($fecha_consultar) ? $fecha_consultar : ''; ?>">
                        </div>
                        <button type="submit" class="btn btn-get-started" id="calcular-tzolkin"><i
                                class="fas fa-calculator"></i> Calcular</button>
                        <a href="#informacion-adicional" class="btn btn-get-started informacion"><i></i> Info</a>

                    </form>

                </div>
                <!-- Recuadro de color sólido detrás de las imágenes -->
                <div class="color-background"></div>
                <div class="contenedor-imagenes">
                    <!-- Imagen de rueda de numeros Tzolkin -->
                    <img src="../img/B6_tzolkin.png" alt="numeros" class="imagen imagen-numeros">
                    <div class="resaltado resaltado-numeros"></div>

                    <!-- Imagen de rueda de simbolos Tzolkin -->
                    <img src="../img/A11_tzolkin.png" alt="tzolqin" class="imagen imagen-tzolqin">
                    <div class="resaltado resaltado-tzolqin"></div>

                    <!-- Imagen de Haab -->
                    <img src="../img/haab/Haab_gears.png" alt="engranaje" class="imagen imagen-engranaje">
                    <img src="<?php echo $imagenDia; ?>" alt="dia" class="imagen imagen-haab-dia">
                    <img src="<?php echo $imagenHaab; ?>" alt="haab" class="imagen imagen-haab">
            

                </div>



            </div>
        </section>

        <!-- Seccion para la informacion adicional sobre la rueda calendarica -->
        <section id="informacion-adicional">
            <h2>Rueda Calendarica</h2>
            <p>Es el resultado de la combinación del sistema Tzolkin de 260 días y el sistema Haab.
                Los dos calendarios se compaginan, al igual que los nombres y los días del Tzolkin, dando lugar a 18.980
                días únicos que, sumados, tardan en cumplirse un total de 52 años.

                Es uno de los ciclos más importantes y sirve para interpretar la sucesión de los períodos de 52 años,
                que
                eran celebrados con la ceremonia del Fuego Nuevo.

                Cada uno de estos ciclos, equivalía, por tanto, a 52 vueltas del Haab y 73 vueltas de Tzolkin, y se
                consideraban como el equivalente al nuevo siglo.</p>

            <h2>Funcionamiento del Calendario Maya</h2>

            <p>La mayor parte de las fechas del calendario maya son el resultado de la combinación del sistema Tzolkín y
                Haab que, juntos, forman La Rueda Calendárica. Está compuesta por tres ruedas o círculos: uno pequeño,
                uno
                mediano y otro grande.</p>
            <img src="../img/rueda.jpg" alt="Descripción de la imagen">
            <p> El círculo más pequeño contiene 13 números y el mediano está constituido por los 20 símbolos o glifos,
                ambos
                forman parte del sistema Tozlkín.</p>
            <p>Después, otra rueda más grande que atiende a los 18 meses de 20 días y un mes corto de 5, del sistema
                Haab.
            </p>
            <p>En algunas representaciones contemporáneas del calendario maya, las tres ruedas engranadas dan lugar a
                una
                combinación de 18.980 días diferentes que regresan al mismo punto cuando la rueda más grande ha
                completado
                52 vueltas.

                Para ello la rueda pequeña y la mediana (Tozkín) giran en sentido a las agujas del reloj, mientras que
                la
                grande lo hace en sentido contrario a las agujas del reloj. Este sistema sirve para comprender su
                funcionamiento, en cambio, los mayas no emplearon tales engranajes.

                El tiempo en el Calendario Maya se cumple de manera cíclica, es decir, cada 52 años mayas vuelve a
                comenzar.

                Según las cuentas que existen dentro del propio calendario, este se inició entre el día 1 y 11 de agosto
                del
                año 3114 a. C y finalizó el 21 de diciembre de 2012 (en nuestro equivalente calendario gregoriano). </p>

        </section>
    </div>

    <?php include "blocks/bloquesJs1.html" ?>

    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            // Obtener los parámetros de la URL
            const urlParams = new URLSearchParams(window.location.search);
            const fecha = urlParams.get('fecha');
            // Si hay una fecha en la URL, calcular el Tzolk'in y girar las imágenes
            if (fecha) {
                //console.log('Fecha seleccionada:', <?php echo $fecha_consultar; ?>);

                //console.log('Cholq\'ij calculado:', "<?php echo isset($cholquij) ? $cholquij : ''; ?>");
                var nahual = "<?php echo $nombreNahual; ?>"; // Obtener el nahual del PHP
                var angulo = <?php echo calcularAnguloPorNahual($nombreNahual); ?>; // Calcular el ángulo de rotación basado en el nahual
                //console.log('angulo', angulo);
                var anguloNum = <?php echo calcularAnguloPorNumero($dia); ?>;
                //console.log('anguloNumero', anguloNum);


                var imagen = document.querySelector(".imagen-numeros");
                var currentRotation = parseFloat(imagen.dataset.rotation) || 0; // Obtener el ángulo de rotación actual
                currentRotation += anguloNum; // Sumar el ángulo de rotación correspondiente al nahual
                imagen.style.transformOrigin = "center center"; // Establecer el punto de transformación en el centro de la imagen
                imagen.style.transform = "translate(-100%, -40%) rotate(" + currentRotation + "deg)"; // Aplicar la rotación y traslación
                imagen.dataset.rotation = currentRotation; // Guardar el nuevo ángulo de rotación en el atributo "data-rotation"


                var imagen = document.querySelector(".imagen-tzolqin");
                var currentRotation = parseFloat(imagen.dataset.rotation) || 0; // Obtener el ángulo de rotación actual
                currentRotation += angulo; // Sumar el ángulo de rotación correspondiente al nahual
                imagen.style.transformOrigin = "center center"; // Establecer el punto de transformación en el centro de la imagen
                imagen.style.transform = "translate(100%, -47%) rotate(" + currentRotation + "deg)"; // Aplicar la rotación y traslación
                imagen.dataset.rotation = currentRotation; // Guardar el nuevo ángulo de rotación en el atributo "data-rotation"

                
            }
        });



        document.addEventListener('DOMContentLoaded', function () {
            establecerFondoDinamico(); // Llamar a la función de establecer el fondo dinámico al cargar la página
        });

    </script>


</body>

</html>