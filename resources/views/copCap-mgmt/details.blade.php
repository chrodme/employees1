@extends('copPlazas-mgmt.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Detalles de registro CAP</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('copPlazas-management.update', ['id' => $copPlaza->id]) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Sede</label>
                            <div class="col-md-6">
                                <select class="form-control" name="sede">
                                    @foreach ($sedes as $sede)
                                        <option {{$copPlaza->sede == $sede->sede ? 'selected' : ''}} value="{{$sede->sede}}">{{$sede->sede}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Dependencia</label>
                            <div class="col-md-6">
                                <select class="form-control" name="dependencia">
                                    @foreach ($dependencias as $dependencia)
                                        <option {{$copPlaza->dependencia == $dependencia->dependencia ? 'selected' : ''}} value="{{$dependencia->dependencia}}">{{$dependencia->dependencia}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Plaza</label>
                            <div class="col-md-6">
                                <select class="form-control" name="rotulo">
                                    @foreach ($rotulos as $rotulo)
                                        <option {{$copPlaza->rotulo == $rotulo->rotulo ? 'selected' : ''}} value="{{$rotulo->rotulo}}">{{$rotulo->rotulo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('modalidad') ? ' has-error' : '' }}">
                            <label for="modalidad" class="col-md-4 control-label">Modalidad</label>

                            <div class="col-md-6">
                                <input id="modalidad" type="text" class="form-control" name="modalidad" value="{{ $copPlaza->modalidad }}" required>

                                @if ($errors->has('modalidad'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('modalidad') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
