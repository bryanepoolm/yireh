<div class="row">
    <div class="col-12">
        <div class="float-end mx-2 row">
            <button class="btn btn-primary mb-2">Reiniciar orden</button>
            <button class="btn btn-warning"><i class="bi-cloud-download"></i> Exportar orden</button>
        </div>
        <div class="card">
            <div class="card-body">
                <form id="form-agregar-cliente">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nombre-cliente" placeholder="Nombre del cliente">
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
                    <tbody>
                        <tr>
                            <td>Bryan Edilberto Pool Mercado</td>
                            <td>Calle 20x13 s/n</td>
                            <td>9992495964</td>
                            <td>
                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Borrar de la orden">
                                    <i style="font-size: 1rem;" class="bi-dash-circle"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $("#form-agregar-cliente").submit((e) => {
        e.preventDefault();
        const request = $.post("<?= base_url('InicioController/postAgregarClienteOrden') ?>", $("#form-agregar-cliente").serialize());
        console.log($(this).serialize())
        request.done((response) => {

        });
        request.fail((jqXHR) => {

        });
    });
</script>