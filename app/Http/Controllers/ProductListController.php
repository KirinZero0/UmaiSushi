<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductIn;
use App\Models\ProductList;
use App\Models\ProductOut;
use App\Models\ProductStock;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductListController extends Controller
{
    public function index()
    {
        $productLists = ProductList::where(function ($query) {
            $search = \request()->get('search');
            $query->where('code', 'like', '%' . $search . '%')
                ->orWhere('name', 'like', '%' . $search . '%');
        })
            ->orderBy('id', 'DESC')
            ->paginate(10);

         return view('admin.pages.productList.index', [
            'productLists' => $productLists
     ]);
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('admin.pages.productList.create', [
            'suppliers' => $suppliers
        ]);
    }

    public function edit(ProductList $productList)
    {
        return view('admin.pages.productList.edit', [
            'productList' => $productList
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:product_lists,code',
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'type' => 'sometimes|string|max:255',
            'supplier_id' => 'required|integer|exists:suppliers,id',
        ]);

        $productList = new ProductList();
        $productList->fill($validated);

        $productList->saveOrFail();

        return redirect(route('admin.product_list.index'));
    }


    public function update(Request $request, ProductList $productList)
    {
        $productList->fill($request->all());
        $productList->saveOrFail();

        return redirect(route('admin.product_list.index'));
    }

    public function destroy(ProductList $productList)
    {

        ProductIn::where('product_list_id', $productList->id)->delete();
        ProductOut::where('product_list_id', $productList->id)->delete();
        ProductStock::where('product_list_id', $productList->id)->delete();

        $productList->delete();

        return redirect(route('admin.product_list.index'));
    }
}
