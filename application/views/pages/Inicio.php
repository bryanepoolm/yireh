<?php if ($this->session->has_userdata('current-order')) : ?>
    <div class="alert alert-warning" role="alert">
        <strong>Orden abierta</strong>
    </div>
<?php endif ?>


<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-10">
                <div class="card">
                    <div class="card-body">
                        <form id="form-agregar-cliente">
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nombre-cliente" name="nombre-cliente" placeholder="Nombre del cliente">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Direccion</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="direccion-cliente" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Telefono</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="telefono-cliente">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary"><i class="bi-person-plus"></i> Agregar a la orden</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="row">
                    <button class="btn btn-primary mb-2">Reiniciar orden</button>
                </div>
                <form action="<?= base_url('inicioController') ?>" method="POST">
                    <input type="hidden" name="cerrar-orden">
                    <div class="row">
                        <button type="submit" class="btn btn-danger mb-2">Cerrar orden</button>
                    </div>
                </form>

                <div class="row">
                    <button class="btn btn-warning"><i class="bi-cloud-download"></i> Exportar orden</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <hr>
        <div class="card">
            <div class="card-body">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Direccion</th>
                            <th>Telefono</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="table-clientes">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        loadTablaClientes();

    });
    $("#form-agregar-cliente").submit((e) => {
        e.preventDefault();
        const request = $.post("<?= base_url('InicioController/postAgregarClienteOrden') ?>", $("#form-agregar-cliente").serialize());
        request.done((response) => {
            $("#form-agregar-cliente")[0].reset();
            loadTablaClientes();
        });
        request.fail((jqXHR) => {
            console.log(jqXHR);
        });
    });

    const loadTablaClientes = () => {
        let table = $("#table-clientes");
        const request = $.get("<?= base_url('ordenesController/getOrdenActual') ?>");

        request.done((response) => {
            table.empty();
            $.each(response, (i, v) => {
                table.append(`
                    <tr>
                        <td>${v.nombre}</td>
                        <td>${v.direccion}</td>
                        <td>${v.telefono}</td>
                        <td>
                            <a href="javascript:void(0)" onclick="eliminarClienteOrden(${v.id_cliente})" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar de la orden">
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

    const eliminarClienteOrden = (id) => {
        const request = $.post("<?= base_url('ordenesController/deleteClienteOrden') ?>", {
            'id-cliente': id
        });
        request.done((response) => loadTablaClientes());
        request.fail((jqXHR) => {});
    }

    $("#nombre-cliente").autocomplete({
        source: "<?= base_url('clientesController/getClientes') ?>"
    });
</script>