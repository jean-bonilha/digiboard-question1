@extends('people.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Mostrar detalhes</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('people.index') }}"> Voltar</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $person->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Matricula:</strong>
                {{ $person->registration }}
            </div>
        </div>
    </div>
    <h4 class="font-weight-light text-center text-lg-left mt-4 mb-0">Galeria de imagens</h4>
    <div class="panel panel-primary">
        <div class="panel-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Opa!</strong> Algo deu errado ao enviar suas imagens.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="id_person" value="{{ $person->id }}">
                        <input type="file" name="images[]" class="form-control" multiple>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Enviar imagem</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr class="mt-2 mb-5">
    <div class="row text-center text-lg-left">
        @foreach ($person->photos as $photo)
            <div class="col-lg-3 col-md-4 col-6">
                <img class="img-fluid img-thumbnail" src="{{ asset($photo->path_storage) }}" alt="">
            </div>
        @endforeach
    </div>
@endsection
