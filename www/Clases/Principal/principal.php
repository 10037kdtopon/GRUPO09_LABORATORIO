<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMINISTRADOR</title>
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
                                <a class="nav-link" data-toggle="tab" href="#medicos" role="tab">
                                    <i></i> MEDICOS
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#pacientes" role="tab">
                                    <i></i> PACIENTES
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#especialidades" role="tab">
                                    <i></i> ESPECIALIDADES
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#medicamentos" role="tab">
                                    <i></i> MEDICAMENTOS
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#consultas" role="tab">
                                    <i></i> CONSULTAS
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#usuarios" role="tab">
                                    <i></i> USUARIOS
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#recetas" role="tab">
                                    <i></i> RECETAS
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#roles" role="tab">
                                    <i></i> ROLES
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
            </table>
            </ul>
        </div>
        <div class="card-body">
            <!-- Tab panes -->
            <div class="tab-content text-center">
                <div class="tab-pane" id="especialidades" role="tabpanel">
                    <iframe src="../Especialidades/especialidades.php" style="width: 95%; height: 890px; border: none;"></iframe>
                </div>
                <div class="tab-pane active" id="medicos" role="tabpanel">
                    <iframe src="../Medicos/medicos.php" style="width: 95%; height: 890px; border: none;"></iframe>
                </div>
                <div class="tab-pane" id="pacientes" role="tabpanel">
                    <iframe src="../Pacientes/pacientes.php" style="width: 95%; height: 890px; border: none;"></iframe>
                </div>
                <div class="tab-pane" id="medicamentos" role="tabpanel">
                    <iframe src="../Medicamentos/medicamentos.php" style="width: 95%; height: 890px; border: none;"></iframe>
                </div>
                <div class="tab-pane" id="consultas" role="tabpanel">
                    <iframe src="../Consultas/consultas.php" style="width: 95%; height: 890px; border: none;"></iframe>
                </div>
                <div class="tab-pane" id="usuarios" role="tabpanel">
                    <iframe src="../Usuarios/usuarios.php" style="width: 95%; height: 890px; border: none;"></iframe>
                </div>
                <div class="tab-pane" id="recetas" role="tabpanel">
                    <iframe src="../Recetas1/recetas.php" style="width: 95%; height: 890px; border: none;"></iframe>
                </div>
                <div class="tab-pane" id="roles" role="tabpanel">
                    <iframe src="../Roles/roles.php" style="width: 95%; height: 890px; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>
  <    
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
