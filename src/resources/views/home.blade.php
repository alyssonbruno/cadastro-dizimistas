@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{!! route('dizimista.index') !!}" class="page-link">Atualizar Dizimistas!</a>
                    <!--a href="{!! route('dizimista.index') !!}" class="page-link">Cadastrar Novos Dizimistas!</a-->
                </div>
            </div>
            <div class="card-footer">
                <a href="{!! route('dizimista.todos') !!}" class="alert-link">Todos os Dizimistas!</a>
            </div>
        </div>
    </div>
</div>
@endsection
