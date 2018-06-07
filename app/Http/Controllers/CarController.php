<?php

namespace FederalSt\Http\Controllers;

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use FederalSt\Car;
use FederalSt\Services\CarService;
use FederalSt\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CarController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \DaveJamesMiller\Breadcrumbs\Facades\DuplicateBreadcrumbException
     */
    public function indexAdmin()
    {
        Breadcrumbs::register('federaist', function ($breadcrumbs) {
            $breadcrumbs->push('Início', route('admin.homeAdmin'));
            $breadcrumbs->push('Listar', route('admin.indexCarAdmin'));
        });
        Session::flash('title', 'Veículos');
        return view('cars.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \DaveJamesMiller\Breadcrumbs\Facades\DuplicateBreadcrumbException
     */
    public function indexUser()
    {
        Breadcrumbs::register('federaist', function ($breadcrumbs) {
            $breadcrumbs->push('Início', route('home'));
            $breadcrumbs->push('Listar', route('cars.indexCarUser'));
        });
        Session::flash('title', 'Veículos');
        return view('cars.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \DaveJamesMiller\Breadcrumbs\Facades\DuplicateBreadcrumbException
     */
    public function add()
    {
        Breadcrumbs::register('federaist', function ($breadcrumbs) {
            $breadcrumbs->push('Início', route('admin.homeAdmin'));
            $breadcrumbs->push('Listar', route('admin.indexCarAdmin'));
            $breadcrumbs->push('Cadastrar', route('admin.addCar'));
        });
        $users = User::all()->toArray();
        Session::flash('title', 'Veículos');
        return view('cars.add', compact('users'));
    }

    /**
     * @param $carId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($carId)
    {
        Breadcrumbs::register('federaist', function ($breadcrumbs) use ($carId) {
            $breadcrumbs->push('Início', route('admin.homeAdmin'));
            $breadcrumbs->push('Listar', route('admin.indexCarAdmin'));
            $breadcrumbs->push('Editar', route('admin.editCar', ['id' => $carId]));
        });
        $users = User::all()->toArray();
        $car = Car::find($carId)->toArray();
        Session::flash('title', 'Veículos');
        return view('cars.edit', compact('users', 'car'));
    }

    /**
     * @param $carId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($carId)
    {
        Breadcrumbs::register('federaist', function ($breadcrumbs) use ($carId) {
            $breadcrumbs->push('Início', route('admin.homeAdmin'));
            $breadcrumbs->push('Listar', route('admin.indexCarAdmin'));
            $breadcrumbs->push('Editar', route('admin.editCar', ['id' => $carId]));
        });
        $car = Car::find($carId)->toArray();
        Session::flash('title', 'Veículos');
        return view('cars.view', compact('car'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, CarService $carService)
    {
        try {
            $data = $request->all();
            $validator = $carService->validate($data);
            if ($validator->fails()) {
                return redirect()->route('admin.addCar')->withErrors($validator->errors())->withInput();
            }
            DB::beginTransaction();
            $car = new Car();
            $car = $car->fill($data);
            $car->save();
            DB::commit();
            Session::flash('flash_success', 'Veículo cadastrado com sucesso.');
            return redirect()->route('admin.indexCarAdmin');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('flash_error', 'Falha ao cadastrar veículo.');
            return redirect()->route('admin.indexCarAdmin');
        }
    }

    /**
     * @param Request $request
     * @param $carId
     * @param CarService $carService
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update($carId, Request $request, CarService $carService)
    {
        try {
            $data = $request->all();
            $validator = $carService->validate($data, $carId);
            if ($validator->fails()) {
                return redirect()->route('admin.editCar')->withErrors($validator->errors())->withInput();
            }
            DB::beginTransaction();
            $car = Car::find($carId);
            $car->fill($data)->save();
            DB::commit();
            Session::flash('flash_success', 'Veículo alterado com sucesso.');
            return redirect()->route('admin.indexCarAdmin');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            Session::flash('flash_error', 'Falha ao alterar veículo.');
            return redirect()->route('admin.indexCarAdmin');
        }
    }

    /**
     * @param $carId
     * @return \Illuminate\Http\JsonResponse
     */
    public function disable($carId)
    {
        try {
            $car = Car::find($carId);
            $car->delete();
            return response()->json('success');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
