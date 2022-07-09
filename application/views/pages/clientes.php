<table class="table table-striped table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Direccion</th>
            <th>Telefono</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="table-clientes">
    </tbody>
</table>

<script>
    $(document).ready(() => {
        loadTablaClientes();
    });
    const loadTablaClientes = () => {
        let table = $("#table-clientes");
        table.html('<tr><td colspan="4"><center>Cargando...</center></td></tr>');
        const request = $.get("<?= base_url('clientesController/getClientes') ?>");

        request.done((response) => {
            table.empty();
            if (response.length > 0) {
                $.each(response, (i, v) => {
                    table.append(`
                        <tr>
                            <td>${v.id}</td>
                            <td>${v.nombre}</td>
                            <td>${v.direccion}</td>
                            <td>${v.telefono}</td>
                            <td>
                                <a onclick="eliminar(${v.id})" href="javascript:void(0)" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar de la orden">
                                    <i style="font-size: 1rem;" class="bi-dash-circle"></i>
                                </a>
                            </td>
                        </tr>
                    `);
                });
            } else table.html('<tr><td colspan="4"><center>Sin clientes</center></td></tr>');
        });
        request.fail((jqXHR) => {
            table.html('<tr><td colspan="4"><center>Sin clientes</center></td></tr>');
        });

    }
    const eliminar = (id) => {
        if (confirm('Eliminar cliente?')) {
            const request = $.get(`<?= base_url('clientesController/deleteCliente/') ?>${id}`);
            request.done((response) => {
                loadTablaClientes();
            });
            request.fail((jqXHR) => {
                alert(jqXHR.responseText);
            });
        }
    }
</script>