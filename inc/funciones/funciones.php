<?php
// 3ª paso: Esta función consiste en obtener el nombre del fichero actualment
// para posteriormente utilizarlo como base para aplicar los estilos
include 'Conexion.class.php';

function obtener_estilo_pagina_actual(){
    $archivo = basename($_SERVER['PHP_SELF']);
    $archivo = str_replace(".php", "", $archivo);
    return $archivo;
}


// consultas
// Obtención de los proyectos guardos en la db
function obtenerProyectos() {
    $pdo = new Conexion();
    $stmt = $pdo->prepare('SELECT id, nombre FROM proyectos');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pdo = null;
    return $result;

}

function obtenerNombreProyecto($id = null){

    $pdo = new Conexion();
    $stmt = $pdo->prepare('SELECT nombre FROM proyectos WHERE id= :id');
    $stmt->execute([
        ':id' => $id
    ]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pdo = null;
    return $result;

}

function obtenerTareaProyecto($id = null){
    $pdo = new Conexion();
    $stmt = $pdo->prepare('SELECT id, nombre, estado FROM tareas WHERE id_proyecto= :id');
    $stmt->execute([
            ':id' => $id
        ]);
    $result =  $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pdo = null;
    return $result;

}
