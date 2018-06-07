<script type="text/javascript">
    $(function () {
        $.drawTable = function() {
            oTable = $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: 'datatable/',
                stateSave: false,
                lengthMenu: [[25], [25]],
                columns: [
                    {data: 'id'},
                    {data: 'user_id', searchable: false},
                    {data: 'placa'},
                    {data: 'renavam'},
                    {data: 'modelo'},
                    {data: 'marca'},
                    {data: 'ano'},
                    @if(\Illuminate\Support\Facades\Auth::user()->role == 2)
                    {
                        data: function (data) {
                            var buttonEditar = '<a href="edit/' + data.id + '" class="waves-effect waves-circle waves-light btn-floating btn-list-default" title="Editar"><i class="material-icons" id="icom-list">mode_edit</i></a>';
                            var buttonInativar = '<a class="waves-effect waves-circle waves-light btn-floating btn-list-default" onclick="disable(' + data.id + ');" title="Excluir"><i class="material-icons" id="icom-list">delete</i></a>';
                            return buttonEditar + buttonInativar;
                        }, orderable: false, searchable: false
                    }
                    @endif
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
            content: 'Tem certeza que deseja excluir o veículo selecionado ?',
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
                            url: '{{url('admin/cars/disable')}}/' + id,
                            success: function (s)
                            {
                                if (s == 'success') {
                                    Materialize.toast('Veículo excluído com sucesso.', 7000);
                                    oTable.destroy();
                                    $.drawTable();
                                } else {
                                    Materialize.toast('Problemas ao excluir veículo', 7000);
                                }
                            },
                            error: function (e)
                            {
                                if (e == 'success') {
                                    Materialize.toast('Veículo excluído com sucesso.', 7000);
                                    oTable.destroy();
                                    $.drawTable();
                                } else {
                                    Materialize.toast('Problemas ao excluir veículo', 7000);
                                }
                            }
                        });
                    }
                }
            }
        });
    }
</script>