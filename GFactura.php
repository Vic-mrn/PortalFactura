<?php
// include autoloader
require_once 'librerias/dompdf/autoload.inc.php';
require_once "script.php";
require_once "clases/conexion.php";

use Dompdf\Dompdf;
use Dompdf\Options;

$obj = new conectar();
$conexion = $obj->conexion();

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos de la factura (puedes ajustar la consulta según tu base de datos)
$idP = 3;//$_GET['idP']; // ID de factura pasado como parámetro
$sql = "SELECT * FROM padres WHERE id = $idP";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Factura no encontrada");
}

// Obtener los datos de la factura (puedes ajustar la consulta según tu base de datos)
$idA = 2;//$_GET['idA']; // ID de factura pasado como parámetro
$sql2 = "SELECT * FROM alumnos WHERE id = $idA";
$result2 = $conexion->query($sql2);

if ($result->num_rows > 0) {
    $row2 = $result->fetch_assoc();
} else {
    die("Factura no encontrada");
}

// // Obtener datos adicionales relacionados (receptor, conceptos, etc.)
// $conceptos_sql = "SELECT * FROM conceptos WHERE factura_id = $factura_id";
// $conceptos_result = $conn->query($conceptos_sql);

// Iniciar Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Generar el contenido HTML
ob_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura <?php echo $row['numero_factura']; ?></title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }

    .factura {
        border: 1px solid #000;
        padding: 20px;
        width: 800px;
        margin: 0 auto;
    }

    .encabezado,
    .receptor,
    .conceptos,
    .totales {
        margin-bottom: 20px;
    }

    .conceptos table {
        width: 100%;
        border-collapse: collapse;
    }

    .conceptos table,
    .conceptos th,
    .conceptos td {
        border: 1px solid #000;
    }

    .conceptos th,
    .conceptos td {
        padding: 8px;
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="factura">
        <div class="encabezado">
            <h1>Factura <?php echo $row['numero_factura']; ?></h1>
            <p><strong>Fecha de emisión:</strong> <?php echo $row['fecha_emision']; ?></p>
            <p><strong>Nombre:</strong> <?php echo $row['Nombre'].' '.$row['ApellidoP'].' '.$row['ApellidoM']; ?></p>
            <p><strong>RFC Emisor:</strong> <?php echo $row['RFC']; ?></p>
            <p><strong>Régimen fiscal:</strong> 
            <?php 
            if($row['RegimenFiscal'] == '1'){
                echo 'Sueldos y Salarios e Ingresos Asimilados a Salarios, Clave: 605';
            } else if($row['RegimenFiscal'] == '2'){
                echo 'Simplificado de Confianza';
            } else if($row['RegimenFiscal'] == '3'){
                echo 'Persona Física con Actividad Empresarial, Clave: 612';
            }
        
            ?></p>
        </div>

        <div class="receptor">
            <h2>Receptor</h2>
            <p><strong>RFC:</strong> MOAV021002Q99</p>
            <p><strong>Nombre:</strong> Moreno Arellano Victor Manuel</p>
            <p><strong>Domicilio fiscal:</strong> Av. Lopez Mateos No. 3 Col. Universidad CP: 39992</p>
        </div>

        <div class="conceptos">
            <h2>Conceptos</h2>
            <table>
                <thead>
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
                    <?php while ($concepto = $conceptos_result->fetch_assoc()): ?>
                    <tr>
                        <td>1</td>
                        <td>Unidad de servicio</td>
                        <td>021002</td>
                        <td><?php echo $concepto['descripcion']; ?></td>
                        <td><?php echo number_format($concepto['precio_unitario'], 2); ?></td>
                        <td><?php echo number_format($concepto['importe'], 2); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="totales">
            <h2>Totales</h2>
            <p><strong>Subtotal:</strong> $<?php echo number_format($row['subtotal'], 2); ?></p>
            <p><strong>Descuentos:</strong> $<?php echo number_format($row['descuentos'], 2); ?></p>
            <p><strong>Total:</strong> $<?php echo number_format($row['total'], 2); ?></p>
        </div>
    </div>
</body>

</html>
<?php
$html = ob_get_clean();

// Generar el PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Enviar el PDF al navegador
$dompdf->stream("Factura_" . $row['numero_factura'] . ".pdf", ["Attachment" => false]);

$conn->close();
?>