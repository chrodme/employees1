<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\copPlazas;
use Illuminate\Support\Facades\DB;
//use App\copCap;
//use App\copCaf;
use App\copRotulos;
use App\copSedes;
use App\copDependencias;


class CopPlazasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cap_Plazas = copPlazas::where('tipo','=','CAP')
                        ->paginate(20);
        //$users = User::where('votes', '>', 100)->paginate(15);

        return view('copPlazas-mgmt/index', ['capPlazas' => $cap_Plazas]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        /*return view('employees-mgmt/create', ['cities' => $cities, 'states' => $states, 'countries' => $countries,
            'departments' => $departments, 'divisions' => $divisions]);
        */
        $sede = copSedes::all();
        $dependencia = copDependencias::all();
        $rotulo = copRotulos::all();

        return view('copPlazas-mgmt/create', ['sedes' => $sede, 'dependencias' => $dependencia, 'rotulos' => $rotulo]);
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
        //$this->validateInput($request);
        // Upload image
        $keys = ['id','sede', 'dependencia', 'rotulo', 'modalidad'];
        $input = $this->createQueryInput($keys, $request);
        copPlazas::create($input);
        return redirect()->intended('/copPlazas-management');
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
    {   $copPlaza = copPlazas::find($id);
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

        return view('copPlazas-mgmt/edit', ['copPlaza' => $copPlaza, 'sedes' => $sede, 'dependencias' => $dependencia, 'rotulos' => $rotulo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   //$employee = Employee::findOrFail($id);
        $copPlaza = copPlazas::findOrFail($id);
        //$this->validateInput($request);
        // Upload image
        /*$keys = ['lastname', 'firstname', 'middlename', 'address', 'city_id', 'state_id', 'country_id', 'zip',
            'age', 'birthdate', 'date_hired', 'department_id', 'department_id', 'division_id'];*/
        $keys = ['sede', 'dependencia', 'rotulo', 'modalidad'];
        $input = $this->createQueryInput($keys, $request);

        copPlazas::where('id', $id)
            ->update($input);

        return redirect()->intended('/copPlazas-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        copPlazas::where('id', $id)->delete();
        return redirect()->intended('/copPlazas-management');
    }
    public function search(Request $request)
    {
        $constraints = [
            'sede' => $request['sede'],
            'rotulo' => $request['rotulo']
        ];
        $capPlaza = $this->doSearchingQuery($constraints);
        $constraints['sede'] = $request['rotulo'];
        return view('copPlazas-mgmt/index', ['capPlazas' => $capPlaza, 'searchingVals' => $constraints]);
    }
    private function doSearchingQuery($constraints)
    {   $query = copPlazas::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint)
        {   if ($constraint != null)
            {   $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }
            $index++;
        }
        return $query->paginate(400);
    }
    private function validateInput($request) {
        $this->validate($request, [
            'lastname' => 'required|max:60',
            'firstname' => 'required|max:60',
            'middlename' => 'required|max:60',
            'address' => 'required|max:120',
            'city_id' => 'required',
            'state_id' => 'required',
            'country_id' => 'required',
            'zip' => 'required|max:10',
            'age' => 'required',
            'birthdate' => 'required',
            'date_hired' => 'required',
            'department_id' => 'required',
            'division_id' => 'required'
        ]);
    }
    private function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }

        return $queryInput;
    }
}
