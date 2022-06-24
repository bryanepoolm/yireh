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
        const request = $.get("<?= base_url('clientesController/getClientes') ?>");

        request.done((response) => {
            table.empty();
            $.each(response, (i, v) => {
                table.append(`
                    <tr>
                        <td>${v.id}</td>
                        <td>${v.nombre}</td>
                        <td>${v.direccion}</td>
                        <td>${v.telefono}</td>
                        <td>
                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar de la orden">
                                <i style="font-size: 1rem;" class="bi-dash-circle"></i>
                            </a>
                        </td>
                    </tr>
                `);
            });
        });
        request.fail((jqXHR) => {
            table.html('<center>Sin registros</center>');
        });

    }
</script>