<?php session_start(); ?>
<?php
$conn = include "conexion/conexion.php";

// Obtener la fecha consultada
if (isset($_GET['fecha'])) {
    $fecha_consultar = $_GET['fecha'];
} else {
    // Si no se proporciona una fecha, usar la fecha actual
    $fecha_consultar = date("Y-m-d");
}

// Incluir el archivo para calcular la cuenta larga
$cuenta_larga = include 'backend/buscar/conseguir_fecha_cuenta_larga.php';

// Obtener números de la cuenta larga
$numeros = explode(".", $cuenta_larga);
?>

<head>
    <meta charset="utf-8">
    <title>Cuenta Larga</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?php include "blocks/bloquesCss.html" ?>
    <link rel="stylesheet" href="../css/cuentaLarga.css?v=<?php echo (rand()); ?>">
    <link rel="stylesheet" href="css/estilo.css?v=<?php echo (rand()); ?>" />

    <script src="../js/fondoDinamico.js"></script>
</head>

<body>
    <?php include "NavBar.php" ?>
    <div>
        <section id="inicio">
            <div id="inicioContainer" class="inicio-container">
                <div id='formulario'>
                    <h1>Cuenta Larga</h1>
                    <form action="#" method="GET" id="form-calcular">
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
                <img src="../img/cuentaLarga/cuentaLarga.png" alt="inicial" class="imagen-Inicial">
                <div class="contenedor-imagenes">
                    <!-- Imagenes para armar la imagen final de la cuenta larga -->
                    <img src="../img/cuentaLarga/Baktun.png" alt="inicial" class="imagen imagen-baktun">
                    <img src="../img/cuentaLarga/Katun.png" alt="inicial" class="imagen imagen-katun">
                    <img src="../img/cuentaLarga/Tun.png" alt="inicial" class="imagen imagen-tun">
                    <img src="../img/cuentaLarga/Uinal.png" alt="inicial" class="imagen imagen-uinal">
                    <img src="../img/cuentaLarga/Kin.png" alt="inicial" class="imagen imagen-kin">

                    <p class="resultado-cuenta-larga"><?php echo $cuenta_larga; ?></p>
                    <!-- Agrega números dinámicamente -->
                    <?php
                    // Definir las posiciones de los números en relación con los símbolos
                    $posiciones = [
                        'numero5' => ['top' => '89%', 'left' => '43%'], 
                        'numero4' => ['top' => '75%', 'left' => '49%'], 
                        'numero3' => ['top' => '75%', 'left' => '43%'], 
                        'numero2' => ['top' => '61%', 'left' => '49%'], 
                        'numero1' => ['top' => '61%', 'left' => '43%']  
                    ];

                    // Mostrar los números en el orden correcto con sus posiciones
                    foreach ($numeros as $indice => $numero) {
                        // Obtener la posición del número actual
                        $posicion = isset($posiciones['numero' . ($indice + 1)]) ? $posiciones['numero' . ($indice + 1)] : ['top' => '0', 'left' => '0'];
                        // Imprimir el número con su posición
                        echo '<img src="../img/cuentaLarga/' . $numero . '.png" alt="Número ' . $numero . '" class="numero" style="top: ' . $posicion['top'] . '; left: ' . $posicion['left'] . ';">';
                    }
                    ?>

                    <!-- Script para imprimir números en la consola -->
                    <script>
                        var numeros = <?php echo json_encode($numeros); ?>;
                        console.log("Números de la cuenta larga:", numeros);
                    </script>
                </div>

            </div>
        </section>

        <!-- Seccion para la informacion adicional sobre la cuenta larga y como interpretar la imagen -->
        <section id="informacion-adicional">
            <h2>Cuenta Larga</h2>
            <p>El sistema de calendario maya registra una serie de ciclos recurrentes de tiempo basados en los
                movimientos del Sol, la Luna y los planetas. Cualquier día en particular se repite en intervalos
                cíclicos, así como por ejemplo, el 1 de enero en el calendario gregoriano se repite cada vez que la
                Tierra completa una revolución alrededor del Sol. Un ciclo completo del calendario maya de Cuenta Larga
                dura 5.125 años. El sistema de calendario maya de Cuenta Larga establece una cronología absoluta en la
                cual cualquier fecha es única, como por ejemplo el 21 de diciembre de 2012 en el sistema de calendario
                gregoriano. El calendario de Cuenta Larga lleva la cuenta de los días que han pasado desde la fecha
                mítica de la creación maya, el 11 de agosto de 3114 a.C.</p>
            <p>La unidad básica de tiempo es el día, o el k‘in.</p>
            <ul>
                <li>20 k‘in = 1 uinal o 20 días</li>
                <li>18 uinal = 1 tun o 360 días</li>
                <li>20 tun = 1 katún o 7.200 días</li>
                <li>20 baktún o 144.000 días</li>
            </ul>
            <p>La fecha de Cuenta Larga se escribe en formato de columna como se muestra en el ejemplo a continuacion,
                con ciclos de tiempo así:</p>
            <p>12.19.19.17.19 3 Kawak | 2 K‘ank‘in | G8</p>
            <p>Esta fecha corresponde al 20 de diciembre de 2012 en el calendario gregoriano y se lee de la siguiente
                forma: baktún.katun.tun.uinal.k‘in | Tzolk‘in | Haab | Señor de la Noche</p>
                <h2>Como leer el grafico</h2>
            <img src="../img/cuentaLarga/explicacion.png" alt="Descripción de la imagen">
            <p><img src="../img/cuentaLarga/cuentaLarga.png" alt="inicial" class="imagen-Inicial"><strong>1. Glifo introductorio de la serie inicial:</strong> Este símbolo identifica que esta fecha
                pertenece al sistema de
                Cuenta Larga</p>
            <p><img src="../img/cuentaLarga/Baktun.png" alt="inicial" class="imagen imagen-baktun"><strong>2. Baktún:</strong> Un número (12 en este ejemplo) junto con el símbolo de “baktún”</p>
            <p><img src="../img/cuentaLarga/Katun.png" alt="inicial" class="imagen imagen-katun"><strong>3. Katún:</strong> Un número (19 en este ejemplo) junto con el símbolo de “katún”</p>
            <p><img src="../img/cuentaLarga/Tun.png" alt="inicial" class="imagen imagen-tun"><strong>4. Tun:</strong> Un número (19 en este ejemplo) junto con el símbolo de “tun”</p>
            <p><img src="../img/cuentaLarga/Uinal.png" alt="inicial" class="imagen imagen-uinal"><strong>5. Uinal:</strong> Un número (17 en este ejemplo) junto con el símbolo de “uinal”</p>
            <p> <img src="../img/cuentaLarga/Kin.png" alt="inicial" class="imagen imagen-kin"><strong>6. Kin:</strong> Un número (19 en este ejemplo) junto con el símbolo de “k‘in”</p>

        </section>

    </div>
    <?php include "blocks/bloquesJs1.html" ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            establecerFondoDinamico(); // Llamar a la función de establecer el fondo dinámico al cargar la página
        });
    </script>
</body>


</html>