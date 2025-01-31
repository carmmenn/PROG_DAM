<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Suscripciones</title>
    <link rel="stylesheet" href="public/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="no-blur">
    <div class="overlay"></div>
    <header class="text-center py-4">
        <h1>Gestión de Suscripciones - StreamWeb</h1>
    </header>

    <main class="container">

    <section class="mb-4">
            <h2 class="text-center" style="color: #D1E3DD;">Planes Base</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center bg-dark text-white mb-3" style="border: 2px solid #FFFFFF;">
                        <div class="card-body">
                            <h5 class="card-title">Básico</h5>
                            <p class="card-text">1 dispositivo</p>
                            <p class="card-text">9.99 €</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center bg-dark text-white mb-3" style="border: 2px solid #FFFFFF;">
                        <div class="card-body">
                            <h5 class="card-title">Estándar</h5>
                            <p class="card-text">2 dispositivos</p>
                            <p class="card-text">13.99 €</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center bg-dark text-white mb-3" style="border: 2px solid #FFFFFF;">
                        <div class="card-body">
                            <h5 class="card-title">Premium</h5>
                            <p class="card-text">4 dispositivos</p>
                            <p class="card-text">17.99 €</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="mb-4">
            <h2 class="text-center" style="color: #D1E3DD;">Paquetes Disponibles</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center bg-dark text-white mb-3" style="border: 2px solid #FFFFFF;">
                        <div class="card-body">
                            <h5 class="card-title">Deporte</h5>
                            <p class="card-text">Eventos deportivos en vivo</p>
                            <p class="card-text">6.99 €</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center bg-dark text-white mb-3" style="border: 2px solid #FFFFFF;">
                        <div class="card-body">
                            <h5 class="card-title">Cine</h5>
                            <p class="card-text">Las mejores películas y estrenos</p>
                            <p class="card-text">7.99 €</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center bg-dark text-white mb-3" style="border: 2px solid #FFFFFF;">
                        <div class="card-body">
                            <h5 class="card-title">Infantil</h5>
                            <p class="card-text">Contenido educativo y divertido para niños</p>
                            <p class="card-text">4.99 €</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="text-center" style="color: #D1E3DD;">
            <h2>Acciones disponibles</h2>
            <div class="d-flex justify-content-center gap-3">
                <a href="views/create_user.php" class="btn" style="background-color: #6C7AAB; color: white;">Crear Usuario</a>
                <a href="views/list_users.php" class="btn btn-secondary">Ver Usuarios</a>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
