@extends('layouts.app')

@section('content')
<div class="container">
    <form action='{!! route('dizimista.update', [$dizimista->id]) !!}' method="POST">
        @method('PUT')
        @csrf
        <input type="hidden" name="id" value='{!! $dizimista->id !!}'>
        <input type="hidden" name="ultimo_atualizador_id" value='{!! $dizimista->ultimo_atualizador_id !!}'>
        <input type="hidden" name="ultima_atualizacao" value='{!! $dizimista->ultima_atualizacao !!}'>

        <label for="nome" class="col-form-label">Nome:</label><input name="nome" type="text" value='{!! $dizimista->nome !!}' class="form-text">
        <label for="data_nascimento" class="col-form-label">Data de Nascimento:</label><input name="data_nascimento" type="date" value='{!! $dizimista->data_nascimento !!}' class="form-text">


        <label for="sexo" class="col-form-label">Sexo:</label>
        <select name="sexo" class="form-text" >
            <option {{ $dizimista->sexo == 'Não Informado'?'selected':'' }}>Não Informado</option>
            <option {{ $dizimista->sexo == 'Feminino'?'selected':''}}>Feminino</option>
            <option {{ $dizimista->sexo == 'Masculino'?'selected':'' }}>Masculino</option>
        </select>

        <label for="naturalidade" class="col-form-label">Naturalidade:</label><input name="naturalidade" type="text" value='{!! $dizimista->naturalidade !!}' class="form-text">
        <label for="estado_civil" class="col-form-label">Estado Civil:</label>
        <select name="estado_civil" class="form-text" onchange="mostrarConjuge(this)">
            <option {{ $dizimista->estado_civil == 'Não Informado'?'selected':'' }}>Não Informado</option>
            <option {{ $dizimista->estado_civil == 'Solteiro(a)'?'selected':''}}>Solteiro(a)</option>
            <option {{ $dizimista->estado_civil == 'Casado(a)'?'selected':'' }}>Casado(a)</option>
            <option {{ $dizimista->estado_civil == 'Divorciado(a)'?'selected':'' }}>Divorciado(a)</option>
            <option {{ $dizimista->estado_civil == 'Viúvo(a)'?'selected':'' }}>Viúvo(a)</option>
        </select>
        <label name="nome_conjuge_label" for="nome_conjuge" class="col-form-label" {{ $dizimista->estado_civil == 'Casado(a)'?'':'hidden' }}>Nome do Conjuge:</label>
        <input name="nome_conjuge" value='{!! $dizimista->nome_conjuge !!}' class="form-text" {{ $dizimista->estado_civil == 'Casado(a)'?'':'hidden' }}>
        <label name="data_nascimento_conjuge_label" for="data_nascimento_conjuge" class="col-form-label" {{ $dizimista->estado_civil == 'Casado(a)'?'':'hidden' }}>Data Nascimento Conjuge:</label>
        <input name="data_nascimento_conjuge" type="date"  value='{!! $dizimista->data_nascimento_conjuge !!}' class="form-text" {{ $dizimista->estado_civil == 'Casado(a)'?'':'hidden' }}>

        <label for="numero_whatsapp" class="col-form-label">Whatsapp:</label><input name="numero_whatsapp" value='{!! $dizimista->numero_whatsapp !!}' class="form-text">
        <label for="numero_fixo" class="col-form-label">Fixo:</label><input name="numero_fixo" value='{!! $dizimista->numero_fixo !!}' class="form-text">
        <label for="email" class="col-form-label">E-mail:</label><input name="email" value='{!! $dizimista->email !!}' class="form-text">

        <label for="endereco" class="col-form-label">Endereco:</label><input name="endereco" type="text" value='{!! $dizimista->endereco !!}' class="form-text">
        <label for="bairro" class="col-form-label">Bairro:</label><input name="bairro" type="text" value='{!! $dizimista->bairro !!}' class="form-text">
        <label for="cidade" class="col-form-label">Cidade:</label><input name="cidade" type="text" value='{!! $dizimista->cidade !!}' class="form-text">
        <label for="cep" class="col-form-label">CEP:</label><input name="cep" type="text" value='{!! $dizimista->cep !!}' class="form-text">

        <label for="comunidade" class="col-form-label">Comunidade:</label><input name="comunidade" type="text" value='{!! $dizimista->comunidade !!}' class="form-text">
        <label for="pedido_oracao" class="col-form-label">Pedido de Oracao:</label><textarea name="pedido_oracao" class="form-text"> {{ $dizimista->pedido_oracao }}</textarea>

        <label for="participa_pastoral" class="col-form-label">Participa de Pastoral?</label>
        <select name="participa_pastoral" class="form-text">
            <option {{ $dizimista->participa_pastoral?'selected':'' }} >Sim</option>
            <option {{ $dizimista->participa_pastoral?'':'selected' }} >Não</option>
        </select>
        <label for="pastoral_desejada" class="col-form-label">Pastoral Desejada:</label><input name="pastoral_desejada" type="text" value='{!! $dizimista->pastoral_desejada !!}' class="form-text">
        @if ($dizimista->atualizado)
            <label for="atualizado" class="col-form-label">Atualizado:</label>
            <select name="atualizado" class="form-text">
                <option {{ $dizimista->atualizado?'selected':'' }} >Sim</option>
                <option {{ $dizimista->atualizado?'':'selected' }} >Não</option>
            </select>
        @endif
        <button class="btn-primary">Salvar</button>
    </form>
</div>

    <script type="text/javascript">
        mostrarConjuge = function (){
            var estado_civil = document.getElementsByName('estado_civil')[0];
            var selecionado = estado_civil.selectedOptions[0];
            var label_nome = document.getElementsByName('nome_conjuge_label')[0];
            var input_nome = document.getElementsByName('nome_conjuge')[0];
            var label_data = document.getElementsByName('data_nascimento_conjuge_label')[0];
            var input_data = document.getElementsByName('data_nascimento_conjuge')[0];

            if (selecionado.value === 'Casado(a)'){
                label_data.removeAttribute('hidden');
                label_nome.removeAttribute('hidden');
                input_data.removeAttribute('hidden');
                input_nome.removeAttribute('hidden');
            }
            else{
                label_data.setAttribute('hidden',undefined);
                label_nome.setAttribute('hidden',undefined);
                input_data.setAttribute('hidden',undefined);
                input_nome.setAttribute('hidden',undefined);

            }
        }
    </script>
@endsection
