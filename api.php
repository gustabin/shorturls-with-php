<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


function generateShortCode($longUrl)
{
    return substr(hash('crc32b', $longUrl), 0, 6);
    // Puedes ajustar el tamaño del código corto cambiando el segundo parámetro de substr.
}

function saveShortUrl($longUrl, $shortCode)
{
    $conn = new mysqli("localhost", "root", "", "short_urls");
    $sql = "INSERT INTO short_urls (long_url, short_code) VALUES ('$longUrl', '$shortCode')";
    $conn->query($sql);
    $conn->close();
}


// Comprobar si la solicitud es para acortar una URL
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data["long_url"])) {
        // Obtener la URL larga desde la solicitud POST
        $longUrl = $data["long_url"];

        // Generar un código corto a partir de la URL larga
        $shortCode = generateShortCode($longUrl);

        // Guardar la URL larga y el código corto en la base de datos
        saveShortUrl($longUrl, $shortCode);

        // Devolver la URL corta como respuesta en formato JSON
        $response = ["short_url" => "http://localhost/shortUrls/$shortCode"];
        // $response = ["short_url" => "https://guskit.com/$shortCode"];
        header("Content-Type: application/json");
        echo json_encode($response);
        exit;
    }
}

// Si no se cumplió la condición anterior, devolver un error
// http_response_code(400);
$response = ["error" => "Bad Request"];
header("Content-Type: application/json");
echo json_encode($response);
