<?php
// 3ª paso: Esta función consiste en obtener el nombre del fichero actualment
// para posteriormente utilizarlo como base para aplicar los estilos
function obtener_estilo_pagina_actual(){
    $archivo = basename($_SERVER['PHP_SELF']);
    $archivo = str_replace(".php", "", $archivo);
    return $archivo;
}
