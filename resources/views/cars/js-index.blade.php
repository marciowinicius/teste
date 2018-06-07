<script type="text/javascript">
    $(function () {
        $.drawTable = function() {
            oTable = $('#product-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: 'datatable/',
                stateSave: false,
                lengthMenu: [[25], [25]],
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'loja'},
                    {data: 'status', searchable: false, orderable: true},
                    {
                        data: function (data) {
                            var buttonVisualizar = '<a href="/product/edit/' + data.id + '" class="waves-effect waves-circle waves-light btn-floating btn-list-default" title="Visualizar"><i class="material-icons" id="icom-list">remove_red_eye</i></a>'
                            // var buttonEditar = '<a href="/product/edit/' + data.id + '" class="waves-effect waves-circle waves-light btn-floating btn-list-default" title="Editar"><i class="material-icons" id="icom-list">mode_edit</i></a>'
                            var buttonInativar = '<a class="waves-effect waves-circle waves-light btn-floating btn-list-default" onclick="disable(' + data.id + ');" title="Excluir"><i class="material-icons" id="icom-list">delete</i></a>';
                            return buttonVisualizar + buttonInativar;
                        }, orderable: false, searchable: false
                    }
                ]
            });
        };

        $.drawTable();
    });

    /*Função para desativar */
    function disable(id) {
        $.confirm({
            useBootstrap: false,
            closeIcon: true,
            title: '<i class="material-icons">warning</i> Atenção ...',
            content: 'Tem certeza que deseja excluir o produto selecionado ?',
            type: 'blue',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Confirmar',
                    action: function () {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('input[name="csrf-token"]').attr('value')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: '{{url('/product/disable')}}/' + id,
                            success: function (s)
                            {
                                if (s == 'success') {
                                    Materialize.toast('Produto excluído com sucesso.', 7000);
                                    oTable.destroy();
                                    $.drawTable();
                                } else {
                                    Materialize.toast('Problemas ao excluir produto', 7000);
                                }
                            },
                            error: function (e)
                            {
                                if (e == 'success') {
                                    Materialize.toast('Produto excluído com sucesso.', 7000);
                                    oTable.destroy();
                                    $.drawTable();
                                } else {
                                    Materialize.toast('Problemas ao excluir produto', 7000);
                                }
                            }
                        });
                    }
                }
            }
        });
    }
</script>