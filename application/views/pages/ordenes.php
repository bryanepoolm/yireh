<table class="table table-striped table-inverse table-responsive">
    <thead class="thead-inverse">
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="table-ordenes">

    </tbody>
</table>

<script>
    $(document).ready(function() {
        loadTablaOrdenes();
    });
    const loadTablaOrdenes = () => {
        let table = $("#table-ordenes");
        const request = $.get("<?= base_url('ordenesController/getOrdenes') ?>");

        request.done((response) => {
            table.empty();
            $.each(response, (i, v) => {
                table.append(`
                    <tr>
                        <td>${v.id}</td>
                        <td>${v.fecha}</td>
                        <td>${v.status}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="eliminar(${v.id})" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar de la orden">
                                <i style="font-size: 1rem;" class="bi-dash-circle"></i>
                            </a>
                            <a href="<?= base_url('ordenesController/downloadOrden/') ?>${v.id}" target="_blank" download class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar lista">
                                <i style="font-size: 1rem;" class="bi-cloud-download"></i>
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
    const eliminar = (id) => {
        if (confirm('Eliminar orden?')) {
            const request = $.get(`<?= base_url('ordenesController/deleteOrden/') ?>${id}`);
            request.done((response) => {
                loadTablaOrdenes();
            })
            request.fail((jqXHR) => alert(jqXHR.responseText));
        }
    }
</script>