<?php

namespace App\Http\Controllers;

use App\Exports\LaporanBarangExport;
use App\Models\Product;
use App\Models\ProductList;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    public function index()
    {
        $products = Product::where(function ($query) {
            $search = \request()->get('search');
            $query->where('code', 'like', '%' . $search . '%')
            ->orWhereHas('product', function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', '%' . $search . '%');
            });
    })
        ->orderBy('id', 'DESC')
        ->paginate(10);

        return view('admin.pages.barang.index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $lists = ProductList::all();

        return view('admin.pages.barang.create', [
            'code'  => rand(),
            'lists' => $lists
        ]);
    }

    public function edit(Product $product)
    {
        return view('admin.pages.barang.edit', [
            'product' => $product
        ]);
    }

    public function store(Request $request)
    {
        $list = ProductList::where('custom_id', $request->code)->first();

        $product = new Product();
        $product->fill([
            'product_list_id' => $list->id,
            'code' => $request->code,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'date' => $request->date
        ]);
        $product->saveOrFail();

        return redirect(route('admin.barang.index'));
    }

    public function update(Request $request, Product $product)
    {
        $product->fill($request->all());
        $product->saveOrFail();

        return redirect(route('admin.barang.index'));
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect(route('admin.barang.index'));
    }

    public function updateStatus(Request $request, Product $product) //this function only adds stock if the request is approved
    {
        $product->status = $request->status;
        $product->reasons = $request->reasons;
        $product->saveOrFail();

        if ($request->status === Product::APPROVED) {
            $productStock = ProductStock::where('product_list_id', $product->product_list_id)->first();
            $productStock->stock += $product->quantity;
            $productStock->saveOrFail();
        }

        return redirect(route('admin.barang.index'));
    }

    public function editStatus(Product $product)
    {
        return view('admin.pages.barang.editStatus', [
            'product' => $product
        ]);
    }
}
