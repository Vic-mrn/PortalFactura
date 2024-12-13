<?php
        ob_start();

        require_once "clases/conexion.php";

        $obj = new conectar();
        $conexion = $obj->conexion();

        // Verificar conexión
        if ($conexion->connect_error) {
            die("Conexión fallida: " . $conexion->connect_error);
        }

        // Obtener el ID actual del usuario
        $idP = isset($_GET['idP']) ? intval($_GET['idP']) : 1;
        // Obtener los datos de la factura (puedes ajustar la consulta según tu base de datos)
        $sql = "SELECT * FROM padres WHERE id = $idP";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            die("Factura no encontrada");
        }

        // Obtener el ID actual del usuario
        $idA = isset($_GET['idA']) ? intval($_GET['idA']) : 1;
        // Obtener los datos de la factura (puedes ajustar la consulta según tu base de datos)
        $sql2 = "SELECT * FROM alumnos WHERE id = $idA";
        $result2 = $conexion->query($sql2);

        if ($result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
        } else {
            die("Factura no encontrada");
        }

        $sql0 = "INSERT INTO FACTURA (idPadre, idHijo) VALUES ('$idP','$idA')";
        $result0 = $conexion->query($sql0);
        
        
        $sql3 = "SELECT * FROM factura WHERE idPadre = '$idP' AND idHijo = '$idA' ORDER BY FechaRegistro DESC LIMIT 1;";
        $result3 = $conexion->query($sql3);

        if ($result3->num_rows > 0) {
            $row3 = $result3->fetch_assoc();
        } else {
            die("Factura no encontrada");
        }
    ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php 
        include "script.php";
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->

    <!-- <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/PROJECT/librerias/css/bootstrap.min.css"> -->


    <style>
        body {
            margin: 1px;
            /* Ajusta el margen a tu preferencia */
            padding: 0;
            font-size: 12px;
        }

        .factura {
            padding: 1px;
            /* Espaciado interno */
        }

        @page {
            margin: 0px 0px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .factura {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .encabezado {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo {
            flex: 0 0 120px;
            /* Espacio fijo para el logo */
            text-align: center;
        }

        .logo img {
            width: 100px;
            height: auto;
        }

        .datos-emisor {
            flex: 1;
            /* Ocupa el resto del espacio */
            margin-left: 20px;
        }

        .datos-emisor p {
            margin: 2px 0;
        }

        .receptor {
            margin-bottom: 20px;
            padding: 10px;
            background: #f1f1f1;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .conceptos table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .conceptos th,
        .conceptos td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .conceptos th {
            background-color: #003366;
            color: #fff;
        }

        .totales {
            text-align: right;
        }

        .totales h2 {
            margin: 0 0 10px;
        }

        .totales p {
            margin: 2px 0;
        }

        .row {
            display: flex;
            align-items: center;
            /* Alinea el contenido verticalmente */
            justify-content: space-between;
            /* Asegura espacio entre el texto y el logo */
        }

        .col-6 {}

        .col-6 img {
            display: block;
            /* Asegura que no tenga márgenes externos */
            margin-left: auto;
            /* Empuja el logo hacia la derecha */
        }

        .border {
            border: 1px solid #ddd;
            border-radius: 25px;
            margin: 15px;
        }

        .contenedor1 {
            display: flex;
            padding: 30px;
        }

        .div1 {
            width: 100px;
            height: 100px;
            float: left;
        }

        .div2 {
            margin-top: 20px;
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="factura border p-4 rounded">
            <!-- Encabezado -->
            <label class="form-label"><strong>Factura FAC
                    <?php echo $row3['id']; ?>
                </strong></label>
            <label class="form-label">
                <strong> Fecha y hora de emision:</strong>
                <?php echo $row3['FechaRegistro']; ?>
            </label>

            <div class="contenedor1 border">
                <?php
                    $path = 'img/logo.svg';
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                ?>
                <!-- Logo -->
                <div class="div1">
                    <img src="<?php echo $base64 ?>" alt="Logo" class="media-object" style="max-width: 100px;">
                </div>
                <!-- Datos del emisor -->
                <div class="div2">
                    <label class="form-label"><strong>Emisor</strong></label><br>
                    <label class="form-label"><strong>Nombre:</strong>
                        <?php echo $row['Nombre'] . ' ' . $row['ApellidoP'] . ' ' . $row['ApellidoM']; ?>
                    </label><br>
                    <label class="form-label">
                        <strong>RFC Emisor:</strong>
                        <?php echo $row['RFC']; ?>
                    </label><br>
                    <label class="form-label"><strong>Régimen fiscal:</strong>
                        <?php 
                            if ($row['RegimenFiscal'] == '1') {
                                echo 'Sueldos y Salarios e Ingresos Asimilados a Salarios, Clave: 605';
                            } elseif ($row['RegimenFiscal'] == '2') {
                                echo 'Simplificado de Confianza';
                            } elseif ($row['RegimenFiscal'] == '3') {
                                echo 'Persona Física con Actividad Empresarial, Clave: 612';
                            }
                        ?>
                    </label>
                </div>
            </div>

            <!-- Receptor -->
            <div class="contenedor1 border">
                <label class="form-label"><strong>Receptor</strong></label><br>
                <label class="form-label"><strong>RFC: </strong>MOAV021002Q99</label><br>
                <label class="form-label"><strong>Nombre: </strong>Moreno Arellano Victor Manuel</label><br>
                <label class="form-label"><strong>Domicilio Fiscal: </strong>Av. Lopez Mateos No. 3 Col. Universidad CP:
                    39992</label>
            </div>

            <!-- Conceptos -->
            <div class="conceptos">
                <h5>Conceptos</h5>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Cantidad</th>
                            <th>Unidad</th>
                            <th>Clave</th>
                            <th>Descripción</th>
                            <th>Precio Unitario</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aquí puedes iterar sobre tus datos -->
                        <tr>
                            <td>1</td>
                            <td>Unidad</td>
                            <td>12345</td>
                            <td style="font-size: 12px;">Pago por concepto de colegiatura, del alumno:
                                <?php echo $row2['Nombre'] . ' ' . $row2['ApellidoP'] . ' ' . $row2['ApellidoM']; ?>,
                                que cursa el
                                <?php echo $row2['Grado']; ?> grado
                                de
                                <?php echo $row2['NivelEducativo']; ?>. con
                                CURP:
                                <?php echo $row2['CURP']; ?>.
                            </td>
                            <td>
                                <?php 
                                    if ($row2['NivelEducativo'] == 'Preescolar') {
                                        echo '$2,000.00';
                                    } elseif ($row2['NivelEducativo'] == 'Primaria') {
                                        echo '$2,500.00';
                                    } elseif ($row2['NivelEducativo'] == 'Secundaria') {
                                        echo '$3,500.00';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php 
                                    if ($row2['NivelEducativo'] == 'Preescolar') {
                                        echo '$2,000.00';
                                    } elseif ($row2['NivelEducativo'] == 'Primaria') {
                                        echo '$2,500.00';
                                    } elseif ($row2['NivelEducativo'] == 'Secundaria') {
                                        echo '$3,500.00';
                                    }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <label class="form-label"><strong>Alumno</strong></label><br>
                <label class="form-label"><strong>Nombre:</strong>
                    <?php echo $row2['Nombre'] . ' ' . $row2['ApellidoP'] . ' ' . $row2['ApellidoM']. '    '; ?>
                </label>

                <label class="form-label">
                    <strong> CURP:</strong>
                    <?php echo $row2['CURP']; ?>
                </label>

                <label class="form-label">
                    <strong> Nivel educativo:</strong>
                    <?php echo $row2['NivelEducativo']; ?>
                </label><br>
            </div>

            <!-- Totales -->
            <div class="totales text-end">
                <h5>Totales</h5>
                <p><strong>Subtotal:</strong>
                    <?php 
                        if ($row2['NivelEducativo'] == 'Preescolar') {
                            echo '(DOS MIL MXN 00/100) $2,000.00';
                        } elseif ($row2['NivelEducativo'] == 'Primaria') {
                            echo '(DOS MIL QUINIENTOS MXN 00/100) $2,500.00';
                        } elseif ($row2['NivelEducativo'] == 'Secundaria') {
                            echo '(TRES MIL QUINIENTOS MXN 00/100) $3,500.00';
                        }
                    ?>
                </p>
                <p><strong>Descuentos:</strong> $0.00</p>
                <p><strong>Total:</strong>
                    <?php 
                        if ($row2['NivelEducativo'] == 'Preescolar') {
                            echo '(DOS MIL MXN 00/100) $2,000.00';
                        } elseif ($row2['NivelEducativo'] == 'Primaria') {
                            echo '(DOS MIL QUINIENTOS MXN 00/100) $2,500.00';
                        } elseif ($row2['NivelEducativo'] == 'Secundaria') {
                            echo '(TRES MIL QUINIENTOS MXN 00/100) $3,500.00';
                        }
                    ?>
                </p>
            </div>

          
                
                <div class="contenedor1 border" style="" >
                    <?php
                    $path = 'img/qr.svg';
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                ?>
                <!-- Logo -->
                <div class="div1">
                    <br>
                    <img src="<?php echo $base64 ?>" alt="Logo" class="media-object" style="max-width: 100px;">
                </div>
                    <h3><strong>Sello digital del CFDI:</strong> </h3>
                   <div style="word-wrap: break-word; overflow-wrap: break-word;  font-size: 8px;">
                    dglic9wNF/56oKI9zW1dVGLIUHfvCX7TI1+N0R02pLEtamzPj8OaeAd7mxARWmVZX82jIhsJIX54eRqcFH/sG9U3ZWucfwB45A+bX/PT121
                    OCkVg9V8kzulapH3X8rXknZuooGDhz8w3oAX11dw137Y/RS/j7fFT8E/sR/71xt43eVIfxJPdMBtQXhNZYzszaelBgokFyvV4fUVXIKajCauw3
                    LlEj8FOrHXwwsTNk0IFSNmZrH6KuLe+zHorQagJMLsYaLbcQUVzu5zDeLNEZN4/U8sdqmXmVyVeBuUlcpbeaHZ/NE4rpV47fz+4kg5ESp
                    nyUjFmkMDk8t00l5DQ5A==
                   </div>
                </div>
            </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php

$html = ob_get_clean();
//echo $html;
// include autoloader
require_once './dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf();

// Iniciar Dompdf
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);


// Generar el PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Enviar el PDF al navegador
$dompdf->stream("Factura_.pdf", array("Attachment" => false));

ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn->close();
?>