<?php
require_once 'inc/funciones/sesiones.php';
require_once 'inc/funciones/funciones.php';
require_once 'inc/templates/header.php';
require_once 'inc/templates/barra.php';

// Obtener el ID de la URL
(isset($_GET['id_proyecto'])) ? $id_proyecto = $_GET['id_proyecto'] : $id_proyecto = null;

?>



<div class="contenedor">
    <?php
    require_once 'inc/templates/sidebar.php';
    ?>

    <main class="contenido-principal">
        <h1>
            <?php
            // echo "<pre>";
            // var_dump( obtenerNombreProyecto($id_proyecto) );
            // echo "</pre>";
            //   echo "<span>". obtenerNombreProyecto($id_proyecto) . "</span>"  ;
            $proyecto = obtenerNombreProyecto($id_proyecto);


            if ($proyecto) : ?>
                <?php foreach ($proyecto as $item) : ?>
                    <span><?= $item['nombre']; ?></span>

                <?php endforeach; ?>


        </h1>

        <form action="#" class="agregar-tarea">
            <div class="campo">
                <label for="tarea">Tarea:</label>
                <input type="text" placeholder="Nombre Tarea" class="nombre-tarea">
            </div>
            <div class="campo enviar">
                <input type="hidden" id="id_proyecto" value="<?= $id_proyecto ?>">
                <input type="submit" class="boton nueva-tarea" value="Agregar">
            </div>
        </form>

    <?php
            else :
                echo "Selecciona un proyecto";
            endif;


    ?>


    <h2>Listado de tareas:</h2>

    <div class="listado-pendientes">
        <ul>
            <?php
            // Fetching currents takses FROM proyecto
            $tareas = obtenerTareaProyecto($id_proyecto);
            // echo "<pre>";
            //     var_dump($tareas);
            // echo "</pre>";
            if ($tareas !== false){
                if ($tareas->num_rows > 0) {
                    // si hay tareas
                    foreach ($tareas as $tarea) : ?>
                        <li id="tarea_<?= $tarea['id']; ?>" class="tarea">
                            <p><?= $tarea['nombre']; ?></p>
                            <div class="acciones">
                                <i class="fas fa-check-circle <?= ($tarea['estado'] == 1)? 'checked': ''; ?>"></i>
                                <i class="fas fa-trash"></i>
                            </div>
                        </li>

                <?php endforeach;
                } else {
                    // no hay tareas
                    echo "<p>No hay tareas</p>";
                }
            }
            ?>


        </ul>
    </div>
    </main>
</div>
<!--.contenedor-->


<?php
require_once 'inc/templates/footer.php'
?>
