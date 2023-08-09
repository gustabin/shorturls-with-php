<?php
// Verificar si la solicitud fue redirigida internamente por .htaccess
if (isset($_SERVER['REDIRECT_STATUS']) && $_SERVER['REDIRECT_STATUS'] === '200') {
    // var_dump("entro");
    // die();
}

function getLongUrl($shortCode)
{
    $conn = new mysqli("localhost", "root", "", "short_urls");
    $sql = "SELECT long_url FROM short_urls WHERE short_code='$shortCode'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $longUrl = $row["long_url"];
        $conn->close();
        return $longUrl;
    } else {
        $conn->close();
        return false;
    }
}


// Comprobar si se recibió el código corto en la URL
if (isset($_GET["code"])) {
    $shortCode = $_GET["code"];

    // Obtener la URL larga correspondiente al código corto
    $longUrl = getLongUrl($shortCode);

    if ($longUrl) {
        // Redireccionar al usuario a la URL larga
        header("Location: $longUrl");
        exit;
    }
}

// Si no se encontró la URL larga correspondiente, redireccionar a una página de error o página principal.
header("Location: https://guskit.com/error.php");
exit;
