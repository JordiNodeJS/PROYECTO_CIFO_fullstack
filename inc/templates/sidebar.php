<aside class="contenedor-proyectos">
        <div class="panel crear-proyecto">
            <a href="#" class="boton">Nuevo Bookmark <i class="fas fa-plus"></i> </a>
        </div>

        <div class="panel lista-proyectos">
            <h2>Bookmarks</h2>
            <ul id="proyectos">
            <?php
                $proyectos = obtenerProyectos();
                echo "<pre>";
                print_r($proyectos);
                echo "</pre>";
                if ($proyectos) {
                    foreach($proyectos as $proyecto){ ?>
                                 <li>
                            <a href="index.php?id_proyecto=<?= $proyecto['id'] ?>" id="<?= $proyecto['id'] ?>">
                                <?= $proyecto['nombre'] ?>
                            </a>
                        </li>

        <?php  }

            }
        ?>

            </ul>
        </div>
    </aside>
