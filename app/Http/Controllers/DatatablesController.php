<?php

namespace FederalSt\Http\Controllers;

use FederalSt\Services\CarService;
use FederalSt\User;
use Yajra\DataTables\DataTables;

class DatatablesController extends Controller
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function carDatatable()
    {
        $cars = CarService::getCars();

        return DataTables::of($cars)
            ->editColumn('status', function ($car) {
                return User::find($car->user_id)->name;
            })
            ->orderColumn('id', '-id $1')
            ->make(true);
    }
}
