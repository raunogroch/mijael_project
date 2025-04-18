<?php 
// Establece el código de respuesta HTTP 404
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada - 404</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .error-container {
            max-width: 600px;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 4rem;
            margin: 0;
            color: #dc3545;
        }
        h2 {
            margin-top: 0;
            color: #6c757d;
        }
        p {
            margin-bottom: 2rem;
        }
        a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #0056b3;
        }
        .error-details {
            margin-top: 2rem;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>404</h1>
        <h2>Página no encontrada</h2>
        <p>Lo sentimos, la página que estás buscando no existe o ha sido movida.</p>
        <a href="/">Volver al inicio</a>
        
        <div class="error-details">
            <p>URL solicitada: <?php echo htmlspecialchars($_SERVER['REQUEST_URI'] ?? ''); ?></p>
            <?php if (isset($_SERVER['HTTP_REFERER'])): ?>
            <p>Vienes desde: <?php echo htmlspecialchars($_SERVER['HTTP_REFERER']); ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>