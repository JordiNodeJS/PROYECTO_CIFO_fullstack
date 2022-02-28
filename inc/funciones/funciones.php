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
    require_once 'conexion.php';
    try {
        return $conn->query('SELECT id, nombre FROM proyectos');

    } catch(Exception $e){
        echo "Eror : " . $e->getMessage();
        return false;
    }
}

function obtenerNombreProyecto($id = null){
    include 'conexion.php';
    try {
        return $conn->query("SELECT nombre FROM proyectos WHERE id= {$id}");
    } catch(Exception $e) {
        echo "Error en la conexion ".$e->getMessage();
        return false;
    }
}

function obtenerTareaProyecto($id = null){
    include 'conexion.php';
    try {
        return $conn->query("SELECT id, nombre, estado FROM tareas WHERE id_proyecto= {$id}");
    } catch(Exception $e) {
        echo "Error en la conexion ".$e->getMessage();
        return false;
    }
}
