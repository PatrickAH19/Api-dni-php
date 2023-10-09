<?php
// Datos
$token = 'apis-token-5674.wjgApo01mujr2trWBmzILxYO6Q2MF4zV';
// $dni = '46027897';
$dni = $_POST['dni'];

// Iniciar llamada a API
$curl = curl_init();

// Buscar dni
curl_setopt_array($curl, array(
  // para user api versión 2
  CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $dni,
  // para user api versión 1
  // CURLOPT_URL => 'https://api.apis.net.pe/v1/dni?numero=' . $dni,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 2,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Referer: https://apis.net.pe/consulta-dni-api',
    'Authorization: Bearer ' . $token
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// Datos listos para usar
$persona = json_decode($response);
var_dump($persona);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <section>
        <h1>Buscar N° DNI</h1>
        <form method="POST" action="">
            <div class="container">
                <div class="input">
                    <input class="dni" name="dni" placeholder="Número de DNI" type="number">
                </div>
                <div class="button">
                    <button id="boton" type="submit">Buscar</button>
                </div>
            </div>
        </form>
        <!-- <div class="resultado">
            <?php
            if (isset($persona)) {
                echo '<h2>Resultados de la consulta:</h2>';
                echo '<p>Número de DNI: ' . $persona->numeroDocumento . '</p>';
                echo '<p>Nombres: ' . $persona->nombres . '</p>';
                echo '<p>Apellido paterno: ' . $persona->apellidoPaterno . '</p>';
                echo '<p>Apellido materno: ' . $persona->apellidoMaterno . '</p>';
                echo '<p>Direccion: ' . $persona->direccion . '</p>';
            } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                echo '<p>No se encontraron resultados para el DNI proporcionado.</p>';
            }
            ?>
        </div> -->

        <div class="resultado">
    <?php
    if (isset($persona)) {
        echo '<h2>Resultados de la consulta:</h2>';
        
        if (isset($persona->numeroDocumento)) {
            echo '<p>Número de DNI: ' . '<b>' . $persona->numeroDocumento . '</b>' . '</p>';
        } else {
            echo '<p>Número de DNI: <b>No disponible</b></p>';
        }
        
        if (isset($persona->nombres)) {
            echo '<p>Nombres: ' . '<b>' . $persona->nombres . '</b>' . '</p>';
        } else {
            echo '<p>Nombres: <b>No disponibles</b></p>';
        }
        
        if (isset($persona->apellidoPaterno)) {
            echo '<p>Apellido paterno: ' . '<b>' . $persona->apellidoPaterno . '</b>' . '</p>';
        } else {
            echo '<p>Apellido paterno: <b>No disponible</b></p>';
        }
        
        if (isset($persona->apellidoMaterno)) {
            echo '<p>Apellido materno: ' . '<b>' . $persona->apellidoMaterno . '</b>' . '</p>';
        } else {
            echo '<p>Apellido materno: <b>No disponible</b></p>';
        }
        
        if (isset($persona->direccion)) {
            echo '<p>Direccion: ' . '<b>' . $persona->direccion . '</b>' . '</p>';
        } else {
            echo '<p>Direccion: <b>No disponible</b></p>';
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo '<p>No se encontraron resultados para el DNI proporcionado.</p>';
    }
    ?>
</div>
    </section>
    <script src="js/Main.js" type="text/javascript"></script>
</body>
</html>
