<?php
// codigo boilerplate para hacer inicio de sesion
// PDO no requiere bloques  try-catch
// https://phpdelusions.net/pdo#errors
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Consulta para obtener los datos del usuario
        $sql = "SELECT * FROM usuarios WHERE nombre_usuario = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificación de usuario y contraseña
        if ($user && $password == $user['password_user']) { // Considera cambiar la validación a password_hash()
            // Guardar datos del usuario en sesión
            $_SESSION['usuario_id'] = $user['id_usuario'];
            $_SESSION['nombre_usuario'] = $user['nombre_usuario'];
            $_SESSION['area'] = $user['area'];

            // Redirección según el área del usuario
            $area = strtolower(str_replace(' ', '_', $user['area'])); // Manejo de nombres con espacios
            $area_path = "areas/$area/splash.php";

            if (file_exists($area_path)) {
                header("Location: $area_path");
            } else {
                header("Location: index.php"); // Página por defecto si el área no existe
            }
            exit();
        } else {
            $error = "Usuario o Contraseña incorrectos";
        }
    }
?>