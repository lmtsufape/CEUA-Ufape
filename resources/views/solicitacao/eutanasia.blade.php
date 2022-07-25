<div class="card shadow-lg p-3 bg-white" style="border-radius: 10px">
    <div class="row">
        <div class="col-md-12">
            <h1 class="borda-bottom text-center titulo">Solicitação - Eutanásia</h1>
        </div>
    </div>
    <form method="POST" action="{{route('solicitacao.eutanasia.criar')}}">
        @csrf
        <input type="hidden" name="solicitacao_id" value="{{$solicitacao->id}}">
        <div class="row col-md-12">
            <h3 class="subtitulo">Especificação</h3>

            <div class="col-sm-6 mt-2">
                <label for="eutanasia">Eutanásia:</label>
                <div class="row ml-1">
                    <div class="col-sm-2">
                        <input class="form-check-input" type="radio" name="eutanasia" id="eutanasia" value="sim">
                        <label class="form-check-label" for="eutanasia">Sim</label>
                    </div>
                    <div class="col-sm-2">
                        <input class="form-check-input" type="radio" name="eutanasia" id="eutanasia" value="nao" checked>
                        <label class="form-check-label" for="eutanasia">
                            Não
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 mt-2">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control @error('descricao') is-invalid @enderror" name="descricao" id="descricao"
                          autocomplete="descricao" autofocus required disabled>{{old('descricao')}}</textarea>
                @error('descricao')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>

            <div class="col-sm-12 mt-2">
                <label for="metodo">Substância, dose, via:</label>
                <textarea class="form-control @error('metodo') is-invalid @enderror" name="metodo" id="metodo"
                          autocomplete="metodo" autofocus required disabled>{{old('metodo')}}</textarea>
                @error('metodo')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>

            <div class="col-sm-12 mt-2">
                <label for="justificativa_metodo">Caso método restrito, justifique:</label>
                <textarea class="form-control @error('justificativa_metodo') is-invalid @enderror"
                          name="justificativa_metodo" id="justificativa_metodo" autocomplete="justificativa_metodo"
                          autofocus required disabled>{{old('justificativa_metodo')}}</textarea>
                @error('justificativa_metodo')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>

            <h3 class="subtitulo">Outras informações</h3>

            <div class="col-sm-12 mt-2">
                <label for="destino">Destino dos animais mortos e/ou tecidos/fragmentos:</label>
                <textarea class="form-control @error('destino') is-invalid @enderror" name="destino" id="destino"
                          autocomplete="destino" autofocus required>{{old('destino')}}</textarea>
                @error('destino')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>

            <div class="col-sm-12 mt-2">
                <label for="descarte">Forma de descarte da carcaça:</label>
                <textarea class="form-control @error('descarte') is-invalid @enderror" name="descarte" id="descarte"
                          autocomplete="descarte" autofocus required>{{old('descarte')}}</textarea>
                @error('descarte')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>


        </div>
        @include('component.botoes_form')
    </form>
</div>

<script>
    $(document).ready(function () {

        $('input[type=radio][name=eutanasia]').on('change', function() {
            if($(this).val() == 'sim') {
                $('#descricao').removeAttr('disabled');
                $('#justificativa_metodo').removeAttr('disabled');
                $('#metodo').removeAttr('disabled');
            }else {
                $('#descricao').attr('disabled',true);
                $('#justificativa_metodo').attr('disabled',true);
                $('#metodo').attr('disabled',true);
            }
        });

    });
</script>
