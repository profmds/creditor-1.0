@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edição de Recursos Educacionais</h1>

        <form action="{{route('oer.update', ['oer'=>$oer->id])}}" method="post">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group row">
                <label for="uri" class="col-md-4 col-form-label text-md-right">{{ __('URI') }}</label>

                <div class="col-md-6">
                    <input id="uri" type="text" class="form-control{{ $errors->has('uri') ? ' is-invalid' : '' }}" name="uri" value="{{ $oer->uri }}" required autofocus>

                    @if ($errors->has('uri'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('uri') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Título') }}</label>

                <div class="col-md-6">
                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ $oer->title }}" required autofocus>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Autor') }}</label>

                <div class="col-md-6">
                    <select class="form-control{{ $errors->has('author') ? ' is-invalid' : '' }}" name="author" id="author" required autofocus>
                        @foreach($users as $u)
                            <option value="{{$u->id}}"
                                @if($oer->author == $u->id) selected @endif
                            >{{$u->name}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('author'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Atualizar') }}
                    </button>
                </div>
            </div>

        </form>
    </div>
@endsection
