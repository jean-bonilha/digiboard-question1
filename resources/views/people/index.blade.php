@extends('people.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Crud de pessoas e upload de imagens | Digiboard Questao 1</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('people.create') }}"> Cria novo cadastro</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th width="4%">ID</th>
            <th width="50%">Nome</th>
            <th width="20%">Matricula</th>
            <th>Acao</th>
        </tr>
        @foreach ($people as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->registration }}</td>
                <td>
                    <form action="{{ route('people.destroy',$product->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('people.show',$product->id) }}">Fotos</a>
                        <a class="btn btn-primary" href="{{ route('people.edit',$product->id) }}">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $people->links() !!}
@endsection
