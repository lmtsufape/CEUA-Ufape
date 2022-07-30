@extends('layouts.app')

@section('content')
    <div class="row mb-4 borda-bottom">
        <div class="col-md-12">
            <h3 class="text-center titulo">Minhas Avaliações</h3>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center" scope="col">Solicitante</th>
            <th class="text-center" scope="col">Titulo</th>
            <th class="text-center" scope="col">Tipo</th>
            <th class="text-center" scope="col">Status</th>
            <th class="w-25 text-center" scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach($avaliacoes as $avaliacao)
            <tr>
                <td class="text-center">{{$avaliacao->solicitacao->user->name}}</td>
                <td class="text-center">{{$avaliacao->solicitacao->titulo_pt}}</td>
                <td class="text-center">{{$avaliacao->solicitacao->tipo}}</td>
                <td class="text-center">@if($avaliacao->status == 'nao_realizado')Não Avaliado @elseif($avaliacao->status == 'aprovado') Aprovado @else Recusado @endif</td>
                <td class="text-center">
                    @if($avaliacao->status == 'nao_realizado')
                        <a href="#">Avaliar</a>
                    @else
                        <a href="#">Editar</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script>
        $('.table').DataTable({
            searching: true,
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "info": "Exibindo página _PAGE_ de _PAGES_",
                "search": "Pesquisar",
                "infoEmpty": "",
                "zeroRecords": "Você não possui solicitações.",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Próximo"
                }
            },
            "order": [0, 1, 2, 3],
            "columnDefs": [{
                "targets": [4],
                "orderable": false
            }]
        });
    </script>
@endsection