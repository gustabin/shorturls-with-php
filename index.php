<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acortador de URL</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        .form-container {
            width: 300px;
        }
    </style>

<body>
    <div class="container-fluid d-flex justify-content-center align-items-center vh-100 bg-warning">
        <div class="text-center">
            <h1 class="my-5">🔪Url shortener</h1>
            <form id="urlShortenerForm" class="form-container">
                <div class="form-floating mb-3">
                    <input type="url" placeholder="http://www.domain.com" class="form-control" id="longUrl" name="long_url" maxlength="255" required>
                    <label for="longUrl">Enter the URL http://www.domain.com </label>
                </div>
                <button type="submit" class="btn btn-primary">Shorten the url</button>
            </form>
            <div id="shortUrlResult"></div>
        </div>
    </div>

    <div class="container fixed-bottom">
        <div class="text-center">
            <a href="https://www.stackcodelab.com" style="text-decoration: none;">🛒</a> Developed by: <a href="mailto:gustavoarias@outlook.com">Gustavo Arias</a>
        </div>
    </div>
    <script>
        document.getElementById("urlShortenerForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            fetch("http://localhost/shortUrls/api.php", {
                    // fetch("https://guskit.com/shortUrls/api.php", {
                    method: "POST",
                    body: JSON.stringify(Object.fromEntries(formData)),
                    headers: {
                        "Content-Type": "application/json",
                    },
                })
                .then((response) => response.json())
                .then((data) => {
                    const shortUrlResult = document.getElementById("shortUrlResult");
                    shortUrlResult.innerHTML = `<p class="my-5">Short url: <a href="${data.short_url}" target="_blank">${data.short_url}</a> <i class="far fa-copy copy-icon ml-2" style="cursor: pointer;"></i></p>`;
                })
                .catch((error) => {
                    console.error("Error al acortar la URL:", error);
                });
        });


        // Agregar la funcionalidad de copiar al hacer clic en el ícono
        document.getElementById("shortUrlResult").addEventListener("click", function(event) {
            if (event.target.classList.contains("copy-icon")) {
                const urlElement = event.target.previousElementSibling;
                const url = urlElement.getAttribute("href");
                copyToClipboard(url);
                showCopiedMessage(urlElement);
            }
        });

        // Función para copiar al portapapeles
        function copyToClipboard(text) {
            const textarea = document.createElement("textarea");
            textarea.value = text;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");
            document.body.removeChild(textarea);
        }

        // Función para mostrar un mensaje de URL copiada
        function showCopiedMessage(element) {
            const originalText = element.textContent;
            element.textContent = "URL copied to clipboard!";
            setTimeout(() => {
                element.textContent = originalText;
            }, 1500);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>