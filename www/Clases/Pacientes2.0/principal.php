<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRADOR</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <?php
            echo '
            <div class="page-header" style="display: flex; justify-content: flex-start; background-color: red; padding: 10px;">
                <button class="btn btn-danger"><a class="text-white navbar-brand" href="../../Sesion/cerrar.php">CERRAR SESION</a></button>
            </div>
                ';
        ?>
    </header>
    <body>
        <?php
        $html = '
        <div class="card" style="background-color: #f6f1f1; color: white;">
        <div class="card-header">
        <ul class="nav nav-tabs justify-content-center" role="tablist">
            <table>
            
                <tr>
                    <td>
                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pacientes" role="tab">
                                    <i></i> PACIENTES
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
                
            </table>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content text-center">
                <div class="tab-pane" id="pacientes" role="tabpanel">
                    <iframe src="../Pacientes/pacientes.php" style="width: 95%; height: 890px; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>
    
';

    echo $html;

    ?>

    <!-- Script para manejar los tabs -->
    <script>
        $(document).ready(function () {
            $(".nav-tabs a").click(function () {
                $(this).tab("show");
            });
        });
    </script>
    </body>

    <footer>
        <!-- Footer -->
        <footer class="bg-light text-center text-lg-start">
            <div class="text-center p-3">
            &copy; 2023 Sitio Creado Por Kevin Topon y Luis Garcia. Derechos reservados Espe.
            </div>
        </footer>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
