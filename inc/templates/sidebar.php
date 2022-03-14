<aside class="contenedor-proyectos">
        <div class="panel crear-proyecto">
            <a href="#" class="boton">Nuevo Bookmark <i class="fas fa-plus"></i> </a>
        </div>

        <div class="panel lista-proyectos">
            <h2>Bookmarks</h2>
            <ul id="proyectos">
            <?php
                $proyectos = CRUD::obtenerProyectos();

                if ($proyectos) {
                    foreach($proyectos as $proyecto){ ?>
                        <li class="flex red">
                            <a href="index.php?id_proyecto=<?= $proyecto['id'] ?>" id="<?= $proyecto['id'] ?>">
                                <?= $proyecto['nombre'] ?>
                            </a>
                            <i id="proyectoId_<?= $proyecto['id'] ?>" class="fas fa-trash"></i>
                        </li>

        <?php  }

            }
        ?>

            </ul>
        </div>
    </aside>
