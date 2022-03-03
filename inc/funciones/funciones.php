<?php
// 3ª paso: Esta función consiste en obtener el nombre del fichero actualment
// para posteriormente utilizarlo como base para aplicar los estilos


function obtener_estilo_pagina_actual(){
    $archivo = basename($_SERVER['PHP_SELF']);
    $archivo = str_replace(".php", "", $archivo);
    return $archivo;
}


// consultas

// Obtención de los proyectos guardos en la db
function obtenerProyectos() {
    require_once 'Conexion.class.php';
    $pdo = new Conexion();
    $query = $pdo->prepare('SELECT id, nombre FROM proyectos');
    return $query->execute();



}

function obtenerNombreProyecto($id = null){
    include 'Conexion.class.php';
    $pdo = new Conexion();
    $query = $pdo->prepare('SELECT nombre FROM proyectos WHERE id= :id');

    return $query->execute([
        ':id' => $id
    ]);


}

function obtenerTareaProyecto($id = null){
    include 'Conexion.class.php';
    $pdo = new Conexion();
    $stmt = $pdo->prepare('SELECT id, nombre, estado FROM tareas WHERE id_proyecto= :id');
        return $stmt->execute([
            ':id' => $id
        ]);

}
