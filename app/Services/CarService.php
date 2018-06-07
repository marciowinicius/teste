<?php
/**
 * Created by PhpStorm.
 * User: Márcio Winicius
 * Date: 07/06/2018
 * Time: 13:38
 */

namespace FederalSt\Services;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarService
{
    public static function getCars()
    {
        $user = Auth::user();
        $cars = DB::table('cars')->select(['id', 'user_id', 'placa', 'renavam', 'modelo', 'marca', 'ano']);
        if ($user->role != 2) {
            $cars->where(['user_id' => $user->id]);
        }

        return $cars;
    }
}