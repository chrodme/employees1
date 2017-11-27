<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use App\copCap;
//use App\copCaf;
use App\copRotulos;
use App\copSedes;
use App\copDependencias;

class CopCafController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $copCafs = DB::table('cop_cap')
            ->leftJoin('cop_trabajadores', 'cop_cap.id_trabajador', '=', 'cop_trabajadores.id')
            ->leftJoin('cop_plazas', 'cop_cap.id_plazaCap', '=', 'cop_plazas.id')
            ->select('cop_plazas.sede', 'cop_plazas.dependencia' , 'cop_plazas.rotulo', 'cop_trabajadores.id', 'cop_trabajadores.apellidos', 'cop_trabajadores.nombres')
            ->where('cop_plazas.tipo','=','CAF')
            ->paginate(30);

        return view('copCaf-mgmt/index', ['copCafs' => $copCafs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function consultaPlaza($id)
    {   $copCafs = DB::table('cop_cap')
            ->leftJoin('cop_trabajadores', 'cop_cap.id_trabajador', '=', 'cop_trabajadores.id')
            ->leftJoin('cop_plazas', 'cop_cap.id_plazaCap', '=', 'cop_plazas.id')
            ->select('cop_plazas.sede', 'cop_plazas.dependencia' , 'cop_plazas.rotulo' )
            ->where([ ['cop_plazas.tipo','=','CAF'],['cop_cap.id_trabajador','=',$id]])
            ->paginate(1);
        return $copCafs;
    }
}
