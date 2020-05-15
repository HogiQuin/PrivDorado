<?php

namespace App\Http\Controllers;

use App\House;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listHouses() 
    {
        $houses = House::all();
        $arr_houses = array();
        $users_without_house = DB::select('select * from users where id not in (select IFNULL(user_id, 0) from houses)');

        foreach($houses as $h)
        {
            $user = User::find($h->user_id);
            $has_user = is_null($user) ? 1 : 0;
            $user_name = is_null($user) ? '' : $user->name;

            $obj_house = array(
                'id' => $h->id,
                'number' => $h->number,
                'user' => $user_name,
                'has_user' => $has_user,
                'balance' => $h->balance
            );

            array_push($arr_houses, $obj_house);
        }

        return view('admin.houses.houses', [ 'houses' => $arr_houses, 'users' => $users_without_house ]);
    }

    public function assignHouseToUser (Request $request)
    {
        $user_id = $request['user_id'];
        $house_id = $request['house_id'];

        $house = House::find($house_id);
        $user = User::find($user_id);

        $house->user_id = $user_id;

        if($house->save())
        {
            return redirect('/admin/houses/')
                ->with('status', 0)
                ->with('message', 'La casa '.$house->number.' fue asignada a '.$user->name.' correctamente!');
        } 
        else 
        {
            return redirect('/admin/houses/')
                ->with('status', 1)
                ->with('message', '**ERROR** Ocurrio un error al intentar asignar la casa');
        }
    }
}
