<?php
// Procesamiento del formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)) {
    
    // Verificar si se envía el formulario de creación de cliente
    if (isset($_POST['procesar']) && isset($_POST['email']) && isset($_POST['name']) && isset($_POST['city']) && isset($_POST['telephone'])) {
        include "../../api/api-rest/create_client.php";  
        
        $email = $_POST['email'];
        $name = $_POST['name'];
        $city = $_POST['city'];
        $telephone = $_POST['telephone'];
        
        crearCliente($email, $name, $city, $telephone);
    }
    
    // Verificar si se envía el formulario para borrar un cliente
    if (isset($_POST['borrar']) && isset($_POST['codigo'])) {
        include "../../api/api-rest/delete_client.php";  
        borrarCliente($_POST['codigo']);
    }
    
    // Redirigir a la vista RolesV después de procesar el formulario
    echo "<script type='text/javascript'>   
              location.href = '../vista/RolesV.php'; 
          </script>";
}

// Función para llenar una lista desplegable con los clientes
function llenar_Lista_desplegable() {
    include "../../api/api-rest/get_all_client_Lista.php"; 
    
    // Obtener los datos en formato JSON y decodificarlos
    $data = json_decode(listarDatosListaDesplegable("GET"), true);
    
    // Generar la lista desplegable con los clientes
    echo "<select name='clientelist' id='clientelist'>";
    foreach ($data as $item) { 
        echo "<option value='" . $item['id'] . "'>" . $item['name'] . "</option>";
    }
    echo "</select>";
}

// Función para listar todos los clientes en una tabla
function listar() {
    include "../../api/api-rest/get_all_client.php"; 
    
    // Obtener los datos en formato JSON y decodificarlos
    $data = json_decode(listarDatos("GET"), true);
    
    // Generar la tabla con los datos de los clientes
    echo "<table border='1'>";
    echo "<tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Ciudad</th>
            <th>Teléfono</th>
          </tr>";
    
    foreach ($data as $item) {
        echo "<tr>
                <td>" . $item['id'] . "</td>
                <td>" . $item['name'] . "</td>
                <td>" . $item['email'] . "</td>
                <td>" . $item['city'] . "</td>
                <td>" . $item['telephone'] . "</td>
              </tr>";
    }
    
    echo "</table>";
}
?>
