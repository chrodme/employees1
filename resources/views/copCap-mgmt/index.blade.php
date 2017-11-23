@extends('copCap-mgmt.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">Cuadro de Asignacion de Personal</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('copCap-management.create') }}">Agregar Nuevo Registro CAP</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('copCap-management.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Busqueda'])
         @component('layouts.two-cols-search-row', ['items' => ['Sede', 'Dependencia'],
         'oldVals' => [isset($searchingVals) ? $searchingVals['sede'] : '', isset($searchingVals) ? $searchingVals['dependencia'] : '']])
         @endcomponent
         </br>
          @component('layouts.two-cols-search-row', ['items' => ['Plaza', 'Apellidos y Nombres'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['rotulo'] : '', isset($searchingVals) ? $searchingVals['apellidos'] : '']])
          @endcomponent
          @endcomponent
      </form>
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
                        <a href="{{ route('copCap-management.details', ['id' => $copCap->id]) }}" class="btn btn-info col-sm-3 col-xs-5 btn-margin">
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
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Mostrando 1 -  {{count($copCaps)}} de {{count($copCaps)}} registros</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $copCaps->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
  </div>
@endsection