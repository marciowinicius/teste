<?php

namespace FederalSt\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DatatablesController extends Controller
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function carDatatable()
    {
        $user = Auth::user();
        $products = DB::table('products')->select(['id', 'name', 'situation', 'status', 'company_id'])
            ->where(['excluded' => FALSE]);
        if ($user->hasRole('product.adm') && !$user->isSuperUser()) {
            $shoppingId = Company::find($user->company_id)->shopping_id;
            $companiesIds = Company::whereShoppingId($shoppingId)->select(['id'])->get();
            $products = $products->whereIn('company_id', $companiesIds);
        } elseif (!$user->isSuperUser()) {
            $products = $products->where(['company_id' => $user->company_id]);
        }

        return Datatables::of($products)
            ->editColumn('status', function ($product) {
                return $product->status == TRUE ? 'Ativo' : 'Inativo';
            })
            ->addColumn('loja', function ($product) {
                return Company::find($product->company_id)->fantasyname;
            })
            ->orderColumn('id', '-id $1')
            ->make(true);
    }
}
