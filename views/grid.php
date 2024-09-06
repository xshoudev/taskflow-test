<div id="new-container" class="container">
    <span id="loader" class="loader"></span>
</div>

<div class="floating-button" data-type="addtask" id="agregarTarea">
    +
</div>

<div class="main-grid">
    <div class="task-nav">
        <div class="welcome">
            <div class="img-welcome"></div>
            <span class="label-welcome">Bienvenido,
                <span class="welcome-username">
                    <?php echo $_SESSION['nombre']; ?>
                </span></span>
        </div>
        <div class="logout">
            <span class="log-out-span" onclick="logout();">
                <span class="material-symbols-outlined logout-icon">logout</span>
                Cerrar sesión
            </span>
        </div>
    </div>
    <div class="task-container">
        <div class="task-header">
            <div class="options-task pending-task">
                <div class="options-left-container">
                    <div class="options-count">7</div>
                    <div class="options-text">Pendiente</div>
                </div>
                <div class="options-right-container">
                    <span class="material-symbols-outlined custom-icons">
                        pending_actions
                    </span>
                </div>
            </div>
            <div class="options-task completed-task">
                <div class="options-left-container">
                    <div class="options-count">3</div>
                    <div class="options-text">Completado</div>
                </div>
                <div class="options-right-container">
                    <span class="material-symbols-outlined custom-icons">
                        fact_check
                    </span>
                </div>
            </div>
            <div class="options-task current-task">
                <div class="options-left-container">
                    <div class="options-count">5</div>
                    <div class="options-text">En progreso</div>
                </div>
                <div class="options-right-container">
                    <span class="material-symbols-outlined custom-icons">
                        library_books
                    </span>
                </div>
            </div>
            <div class="options-task archived-task">
                <div class="options-left-container">
                    <div class="options-count">0</div>
                    <div class="options-text">Archivados</div>
                </div>
                <div class="options-right-container">
                    <span class="material-symbols-outlined custom-icons">
                        archive
                    </span>
                </div>
            </div>
        </div>
        <div class="task-content">
            <div class="task-table">
                <table class="table table-responsive" id="table-main">
                    <thead>
                        <tr>
                            <th style="display: none;">ID</th>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Status</th>
                            <th>Prioridad</th>
                            <th>Fecha limite</th>
                            <th>Editar</th>
                            <th>Borrar</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body">
                <form id="task" class="mb-2" method="POST">
                    <div class="form-group">
                        <label for="nombre_tarea">Tipo de Tarea</label>
                        <select class="form-control" id="nombre_tarea" name="nombre_tarea" required>
                            <option value="Proyecto">Proyecto</option>
                            <option value="Tarea">Tarea</option>
                            <option value="Ejercicio">Ejercicio</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="descripcion">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                            style="resize: none; required"></textarea>
                    </div>
                    <div class="form-group mb-2">
                        <label for="status">Estado</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Completado">Completado</option>
                            <option value="En progreso">En progreso</option>
                            <option value="Archivado">Archivado</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="prioridad">Prioridad</label>
                        <select class="form-control" id="prioridad" name="prioridad" required>
                            <option value="Alta">Alta</option>
                            <option value="Media">Media</option>
                            <option value="Baja">Baja</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="fecha_limite">Fecha Límite</label>
                        <input type="hidden" id="id_usuario" name="id_usuario" value="<?php echo $_SESSION['id'] ?>">
                        <input type="datetime-local" class="form-control" id="fecha_limite" name="fecha_limite" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary custom-save">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-body-edit">

            
            </div>
        </div>
    </div>
</div>