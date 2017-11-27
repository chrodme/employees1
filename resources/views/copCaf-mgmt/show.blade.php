@extends('copCap-mgmt.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Detalles de registro CAP</div>
                <div class="panel-body">


                    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                    <thead>
                                    <tr role="row">
                                        <th width="8%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="ID: " aria-sort="ascending">Nº</th>
                                        <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Sede: " aria-sort="ascending">Sede</th>
                                        <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Dependencia: ">Dependencia</th>
                                        <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Plaza: ">Plaza</th>
                                        <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Regimen: ">Escalafon</th>
                                        <th width="15%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Regimen: ">Apellidos</th>
                                        <th width="15%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Regimen: ">Nombres</th>
                                        <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Acciones: ">Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($copCaps as $copCap)
                                        <tr role="row" class="odd">
                                            <td class="sorting_1">{{ $copCap->id }} </td>
                                            <td class="hidden-xs">{{ $copCap->sede }}</td>
                                            <td class="hidden-xs">{{ $copCap->dependencia }}</td>
                                            <td class="hidden-xs">{{ $copCap->rotulo }}</td>
                                            <td class="hidden-xs">{{ $copCap->id }}</td>
                                            <td class="hidden-xs">{{ $copCap->apellidos }}</td>
                                            <td class="hidden-xs">{{ $copCap->nombres }}</td>
                                            <td>
                                                <form class="row" method="POST" action="{{ route('copCap-management.destroy', ['id' => $copCap->id]) }}" onsubmit = "return confirm('Seguro?')">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <a href="{{ route('copCap-management.show', ['id' => $copCap->id]) }}" class="btn btn-info col-sm-3 col-xs-5 btn-margin">
                                                        Detalles
                                                    </a>
                                                    <a href="{{ route('copCap-management.edit', ['id' => $copCap->id]) }}" class="btn btn-warning col-sm-3 col-xs-5 btn-margin">
                                                        Modificar
                                                    </a>
                                                    <button type="submit" class="btn btn-danger col-sm-3 col-xs-5 btn-margin">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr role="row">
                                        <th width="8%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="ID: " aria-sort="ascending">Nº</th>
                                        <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Sede: " aria-sort="ascending">Sede</th>
                                        <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Dependencia: ">Dependencia</th>
                                        <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Plaza: ">Plaza</th>
                                        <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Regimen: ">Escalafon</th>
                                        <th width="15%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Regimen: ">Apellidos</th>
                                        <th width="15%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Regimen: ">Nombres</th>
                                        <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Acciones: ">Acciones</th>
                                    </tr>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
