$(document).ready(function(){
    // Muestra el formulario en el modal
    cargarTareas();
    
    $('#agregarTarea').on('click', function(){
        var type = $(this).data('type');
        
        if(type == 'addtask'){
            $('#modal-title').text('Agregar nueva tarea.');
            
        }
        
        $('#exampleModal').modal('show');
    });

    //Agregar tarea
    $(document).on('submit', '#task', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'backend/agregar_tarea.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                response = JSON.parse(response);
                console.log(response);
                if (response.success) {

                    $('#nombre_tarea').prop('selectedIndex', 0);
                    $('#descripcion').val('');
                    $('#status').prop('selectedIndex', 0);
                    $('#prioridad').prop('selectedIndex', 0);
                    $('#fecha_limite').val('');

                    Swal.fire({
                        icon: 'success',
                        title: 'Tarea agregada',
                        text: 'La tarea ha sido agregada exitosamente.',
                        confirmButtonText: 'Ok'
                    });
    
                    $('#table-main tbody').append(`
                        <tr id="row-${response.tarea.id}">
                            <td>${response.tarea.nombre_tarea}</td>
                            <td>${response.tarea.descripcion}</td>
                            <td>${response.tarea.status}</td>
                            <td>${response.tarea.prioridad}</td>
                            <td>${response.tarea.fecha_limite}</td>
                            <td class="right-td">
                                <span class="material-symbols-outlined grid-icon" onclick="editTask(${response.tarea.id})">
                                    edit
                                </span>
                            </td>
                            <td class="right-td">
                                <span class="material-symbols-outlined grid-icon" onclick="deleteTask(${response.tarea.id})">
                                    delete
                                </span>
                            </td>
                        </tr>
                    `);
    
                    $('#exampleModal').modal('hide');
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al agregar la tarea.'
                });
            }
        });
    });
    

    $('#icon-edit').on('click', function(){
        $('#editModal').modal('show');
    })

    // $(document).on('#table-main', 'td').on('click', function (e){
    //     console.log("hey?");
    // })
});

//Cargamos las tareas
function cargarTareas() {
    $.ajax({
        url: 'backend/consultar_tareas.php',
        type: 'POST',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                let tasks = response.tasks;
                let tableBody = '';

                tasks.forEach(function(task) {
                    tableBody += `
                        <tr id="row-${task.id}">
                            <td>${task.nombre_tarea}</td>
                            <td>${task.descripcion}</td>
                            <td>${task.status}</td>
                            <td>${task.prioridad}</td>
                            <td>${task.fecha_limite}</td>
                            <td class="right-td">
                                <span class="material-symbols-outlined icon-delete" onclick="editTask(${task.id})">edit</span>
                            </td>
                            <td class="right-td">
                                <span class="material-symbols-outlined icon-edit" onclick="deleteTask(${task.id})">delete</span>
                            </td>
                        </tr>
                    `;
                });
                

                // Insertar las filas en la tabla
                $('#table-main tbody').html(tableBody);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
        },

    });
}

//Editamos la tarea
function editTask(id) {

    $.ajax({
        url: 'backend/consultar_tareas.php',
        type: 'POST',
        data: { task_id: id },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const task = response.tasks[0];

                $('#modal-body-edit').html(`
                    <form id="task-form-edit" class="mb-2" method="POST">
                        <div class="form-group">
                            <label for="nombre_tarea">Tipo de Tarea</label>
                            <select class="form-control" id="nombre_tarea-edit" name="nombre_tarea-edit" required>
                                <option value="Proyecto" ${task.nombre_tarea === 'Proyecto' ? 'selected' : ''}>Proyecto</option>
                                <option value="Tarea" ${task.nombre_tarea === 'Tarea' ? 'selected' : ''}>Tarea</option>
                                <option value="Ejercicio" ${task.nombre_tarea === 'Ejercicio' ? 'selected' : ''}>Ejercicio</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion-edit" name="descripcion-edit" rows="3"
                             style="resize: none;" required>${task.descripcion}</textarea>
                        </div>
                        <div class="form-group mb-2">
                            <label for="status">Estado</label>
                            <select class="form-control" id="status-edit" name="status-edit"> required
                                <option value="Pendiente" ${task.status === 'Pendiente' ? 'selected' : ''}>Pendiente</option>
                                <option value="Completado" ${task.status === 'Completado' ? 'selected' : ''}>Completado</option>
                                <option value="En progreso" ${task.status === 'En progreso' ? 'selected' : ''}>En progreso</option>
                                <option value="Archivado" ${task.status === 'Archivado' ? 'selected' : ''}>Archivado</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="prioridad">Prioridad</label>
                            <select class="form-control" id="prioridad-edit" name="prioridad-edit"> required
                                <option value="Alta" ${task.prioridad === 'Alta' ? 'selected' : ''}>Alta</option>
                                <option value="Media" ${task.prioridad === 'Media' ? 'selected' : ''}>Media</option>
                                <option value="Baja" ${task.prioridad === 'Baja' ? 'selected' : ''}>Baja</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label for="fecha_limite">Fecha Límite</label>
                            <input type="datetime-local" class="form-control" id="fecha_limite-edit" name="fecha_limite-edit" value="${task.fecha_limite}" required>
                        </div>
                        <input type="hidden" id="task_id" name="task_id" value="${task.id}">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </form>
                `);

                $('#editModal').modal('show');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al obtener los datos de la tarea.'
            });
        }
    });
}

// Enviamos la actualización
$('#modal-body-edit').on('submit', '#task-form-edit', function(e) {
    e.preventDefault();

    $.ajax({
        url: 'backend/editar_tarea.php',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Actualizada',
                    text: response.message
                });

                const task_id = $('#task_id').val();
                const nombre_tarea = $('#nombre_tarea-edit').val();
                const descripcion = $('#descripcion-edit').val();
                const status = $('#status-edit').val();
                const prioridad = $('#prioridad-edit').val();
                const fecha_limite = $('#fecha_limite-edit').val();

                // Actualizando los valores en la fila correspondiente
                const row = $(`#row-${task_id}`);
                row.find('td').eq(0).text(nombre_tarea);
                row.find('td').eq(1).text(descripcion);
                row.find('td').eq(2).text(status);
                row.find('td').eq(3).text(prioridad);
                row.find('td').eq(4).text(fecha_limite);

                // Cerrar modal
                $('#editModal').modal('hide');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al intentar actualizar la tarea.'
            });
        }
    });
});

//Eliminamos tarea
function deleteTask(id) {
    // Mostramos SweetAlert para confirmar la eliminación
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esto eliminará tu tarea.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, procedemos con la eliminación
            $.ajax({
                url: 'backend/eliminar_tarea.php',
                type: 'POST',
                data: { task_id: id },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Mostrar SweetAlert de éxito
                        Swal.fire({
                            icon: 'success',
                            title: 'Tarea eliminada con éxito',
                            text: response.message
                        });

                        // Eliminamos la fila de la tarea en la tabla
                        $(`#row-${id}`).remove();
                    } else {
                       
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al intentar eliminar la tarea.'
                    });
                }
            });
        }
    });
}
