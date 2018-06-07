<?php

namespace FederalSt\Http\Controllers;

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use FederalSt\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CarController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \DaveJamesMiller\Breadcrumbs\Facades\DuplicateBreadcrumbException
     */
    public function indexCarAdmin()
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
     * @param $productId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \DaveJamesMiller\Breadcrumbs\Facades\DuplicateBreadcrumbException
     */
    public function edit($productId)
    {
        Breadcrumbs::register('federaist', function ($breadcrumbs) use ($productId) {
            $breadcrumbs->push('Início', route('home'));
            $breadcrumbs->push('Listar', route('indexProduct'));
            $breadcrumbs->push('Editar', route('editProduct', ['id' => $productId]));
        });
        $product = Product::find($productId)->toArray();
        $shoppings = ShoppingService::getAll();
        $company = Company::find($product['company_id']);
        $companies = Company::where(['shopping_id' => $company['shopping_id']])->get();
        $situations = ProductService::getAllSituation();
        $all_swap_rules = SwapRule::where(['type' => 'product', 'status' => TRUE, 'excluded' => FALSE])->get()->toArray();
        $all_use_rules = UseRule::where(['type' => 'product', 'status' => TRUE, 'excluded' => FALSE])->get()->toArray();
        Session::flash('title', 'Produtos');
        return view('products.edit', compact('product', 'shoppings', 'situations', 'companies', 'company', 'edit', 'all_swap_rules', 'add', 'all_use_rules'));
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, ProductService $productService)
    {
        try {
            $data = $request->except(['shopping_id']);
            $data = $productService->convertDataStore($data);
            $validator = $productService->validate($data);
            if ($validator->fails()) {
                return redirect()->route('addProduct')->withErrors($validator->errors())->withInput();
            }
            $file = $data['image'];
            $data['image'] = uniqid('product_') . '.' . $file->getClientOriginalExtension();
            DB::beginTransaction();
            $product = new Product();
            $product->fill($data)->save();
            DB::commit();
            $filePath = UtilitiesService::$AWS_DIR_PRODUCTS . $data['image'];
            Storage::put($filePath, file_get_contents($request->file('image')));
            Session::flash('flash_success', 'Produto cadastrado com sucesso.');
            return redirect()->route('indexProduct');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Update de produto
     * @param Request $request
     * @param $productId
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $productId, ProductService $productService)
    {
        try {
            $data = $request->except(['shopping_id']);
            $data = $productService->convertDataUpdate($data);
            $validator = $productService->validate($data, TRUE);
            if ($validator->fails()) {
                return redirect()->route('editProduct', ['id' => $productId])->withErrors($validator->errors())->withInput();
            }
            $product = Product::find($productId);
            if ($request->has('image')) {
                Storage::delete(UtilitiesService::$AWS_DIR_PRODUCTS . $product->image);
                $file = $data['image'];
                $data['image'] = uniqid('product_') . '.' . $file->getClientOriginalExtension();
                $filePath = UtilitiesService::$AWS_DIR_PRODUCTS . $data['image'];
                Storage::put($filePath, file_get_contents($request->file('image')));
            }
            DB::beginTransaction();
            $product->fill($data)->save();
            DB::commit();
            Session::flash('flash_success', 'Produto atualizado com sucesso.');
            return redirect()->route('indexProduct');
        } catch (\Exception $e) {
            dd($e->getMessage());
            Session::flash('flash_error', 'Erro ao salvar o produto!');
            return redirect()->route('editProduct', ['id' => $productId])->withErrors($e)->withInput();
        }
    }

    /**
     * @param $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function disable($productId)
    {
        try {
            $user = UsersAdm::find(Auth::user()->id);
            $product = Product::find($productId);
            if (!is_null($product)) {
                if ($user->isSuperUser()) {
                    $product->excluded = TRUE;
                    $product->save();
                    return response()->json('success');
                } else {
                    $product = $product->where(['company_id' => $user->company_id])->first();
                    if (!is_null($product)) {
                        $product->excluded = TRUE;
                        $product->save();
                        return response()->json('success');
                    }
                }
            }
            throw new Exception('Produto não excluído.');

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
