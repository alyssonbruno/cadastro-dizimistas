@extends('layouts.app')

@section('content')
<div class="container">
    <div>
        @if (Session::has('mensagem-sucesso') )
            <span class="alert-success alert">{{ Session::get('mensagem-sucesso') }}</span>
        @endif

        @if (Session::has('mensagem-falha') )
            <span class="alert-danger alert">{{ Session::get('mensagem-falha') }}</span>
        @endif

    </div>
    <div class="row">
        @forelse ($dizimistas as $dizimista)
            @if ($loop->first)
                <table class="table">
                <thead class="thead-light text-center">
                    <th>Nome</th>
                    <th>WhatsApp</th>
                    <th>Comunidade</th>
                    <th>Opções</th>
                </thead>
            @endif
                <tbody class="table-bordered table-striped">
                    <tr class="d-lg-table-row">
                        <td>{{ $dizimista->nome }}</td>
                        <td>{{ $dizimista->numero_whatsapp }}</td>
                        <td>{{ $dizimista->comunidade }}</td>
                        <td><a href='{!! route('dizimista.show', [$dizimista->id]) !!}'>Atualizar</a> </td>
                    </tr>
            @if ($loop->last)
                </tbody>
                </table>
            @endif
        @empty
            <h5>Nenhum dizimista para atualizar!</h5>
        @endforelse

    </div>
</div>

@endsection
