@extends('people.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Mostrar dados</h2>
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
    </div>
    <h4 class="font-weight-light text-center text-lg-left mt-4 mb-0">Galeria de imagens</h4>
    <hr class="mt-2 mb-5">
    <div class="row text-center text-lg-left">
        <div class="col-lg-3 col-md-4 col-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/pWkk7iiCoDM/400x300" alt="">
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/aob0ukAYfuI/400x300" alt="">
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/EUfxH-pze7s/400x300" alt="">
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/M185_qYH8vg/400x300" alt="">
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/sesveuG_rNo/400x300" alt="">
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/AvhMzHwiE_0/400x300" alt="">
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/2gYsZUmockw/400x300" alt="">
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/EMSDtjVHdQ8/400x300" alt="">
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/8mUEy0ABdNE/400x300" alt="">
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/G9Rfc1qccH4/400x300" alt="">
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/aJeH0KcFkuc/400x300" alt="">
            </a>
        </div>
        <div class="col-lg-3 col-md-4 col-6">
            <a href="#" class="d-block mb-4 h-100">
                <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/p2TQ-3Bh3Oo/400x300" alt="">
            </a>
        </div>
    </div>
@endsection
