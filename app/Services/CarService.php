<?php
/**
 * Created by PhpStorm.
 * User: Márcio Winicius
 * Date: 07/06/2018
 * Time: 13:38
 */

namespace FederalSt\Services;


use FederalSt\Notifications\CarCreated;
use FederalSt\Notifications\CarEdited;
use FederalSt\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CarService
{
    public static function getCars()
    {
        $user = Auth::user();
        $cars = DB::table('cars')->select(['id', 'user_id', 'placa', 'renavam', 'modelo', 'marca', 'ano']);
        if ($user->role != User::ROLE_ADMIN) {
            $cars->where(['user_id' => $user->id]);
        }

        return $cars;
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validate($data, $carId = 0)
    {
        return Validator::make($data, [
            'user_id' => 'required',
            'placa' => [
                'required',
                'regex:/^[A-Z]{3}\-[0-9]{4}$/',
                'unique:cars,placa,' . $carId,
            ],
            'renavam' => 'required|string|size:20',
            'modelo' => 'required|string|max:250',
            'marca' => 'required|string|max:250',
            'ano' => 'required|date_format:"Y"',
        ]);
    }

    public function sendNotification($user_id, $car_id, $create = TRUE)
    {
        $user = User::find($user_id);
        if ($create == TRUE) {
            $user->notify(new CarCreated($car_id));
        } else {
            $user->notify(new CarEdited($car_id));
        }
    }
}