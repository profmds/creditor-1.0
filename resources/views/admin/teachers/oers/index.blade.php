@extends('layouts.app')
@section('content')
    <div class="container">
        <a href="{{route('oer.new')}}" class="float-right btn btn-success">Novo REA</a>
        <h1 class="float-left">Meus REAs</h1>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Título</th>
                <th>Criado em</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($oers->sortBy('title') as $o)
                <tr>                    
                    <td><a href="https://www.youtube.com/watch?v={{$o->uri}}">{{$o->title}}</a></td>
                    <td>{{$o->created_at}}</td>
                    <td><a href="{{route('oer.edit', ['oer'=>$o->id])}}" class="btn btn-primary">editar</a>
                        <a href="{{route('oer.remove', ['id'=>$o->id])}}" class="btn btn-danger">excluir</a>
                        <a href="{{route('oer.view', ['uri'=>$o->uri])}}" class="btn btn-dark">visualizar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
