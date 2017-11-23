<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CopCapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $copCaps = DB::table('cop_cap')
            ->leftJoin('cop_trabajadores', 'cop_cap.id_trabajador', '=', 'cop_trabajadores.id')
            ->leftJoin('cop_plazas', 'cop_cap.id_plazaCap', '=', 'cop_plazas.id')
            ->select('cop_plazas.sede', 'cop_plazas.dependencia' , 'cop_plazas.rotulo', 'cop_trabajadores.id', 'cop_trabajadores.apellidos', 'cop_trabajadores.nombres')
            ->paginate(30);

        return view('copCap-mgmt/index', ['copCaps' => $copCaps]);
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

    public function search(Request $request)
    {   $constraints = [
            'sede'          => $request['sede'],
            'dependencia'   => $request['dependencia'],
            'rotulo'        => $request['rotulo'],
            'apellidos'     => $request['apellidos']
            ];

        $copCaps = $this->doSearchingQuery($constraints);
        return view('copCap-mgmt/index', ['copCaps' => $copCaps, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints)
    {
        //////////////////////////////////////
        /*
        $copCaps = DB::table('cop_cap')
            ->leftJoin('cop_trabajadores', 'cop_cap.id_trabajador', '=', 'cop_trabajadores.id')
            ->leftJoin('cop_plazas', 'cop_cap.id_plazaCap', '=', 'cop_plazas.id')
            ->select('cop_plazas.sede', 'cop_plazas.dependencia' , 'cop_plazas.rotulo', 'cop_trabajadores.id', 'cop_trabajadores.apellidos', 'cop_trabajadores.nombres')
            ->paginate(30);
        return view('copCap-mgmt/index', ['copCaps' => $copCaps]);
        */
        //////////////////////////////////////
        $query = DB::table('cop_cap')
            ->leftJoin('cop_trabajadores', 'cop_cap.id_trabajador', '=', 'cop_trabajadores.id')
            ->leftJoin('cop_plazas', 'cop_cap.id_plazaCap', '=', 'cop_plazas.id')
            ->select('cop_plazas.sede', 'cop_plazas.dependencia' , 'cop_plazas.rotulo', 'cop_trabajadores.id', 'cop_trabajadores.apellidos', 'cop_trabajadores.nombres')
            ;
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint)
        {   if ($constraint != null)
            {   $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }
            $index++;
        }
        return $query->paginate(100);
    }
    public function details($id)
    {
        $copPlaza = copPlazas::find($id);
        // Redirect to state list if updating state wasn't existed
        if ($copPlaza == null || count($copPlaza) == 0)
        {   return redirect()->intended('/copPlazas-management');
        }
        /*$cities = City::all();
        $states = State::all();
        $countries = Country::all();
        $departments = Department::all();
        $divisions = Division::all();*/
        $sede = copSedes::all();
        $dependencia = copDependencias::all();
        $rotulo = copRotulos::all();

        return view('copCap-mgmt/details', ['copPlaza' => $copPlaza, 'sedes' => $sede, 'dependencias' => $dependencia, 'rotulos' => $rotulo]);

    }
}
