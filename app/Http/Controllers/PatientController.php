<?php
/*
 * author Arya Permana - Kirin
 * created on 14-12-2024-11h-11m
 * github: https://github.com/KirinZero0
 * copyright 2024
*/

namespace App\Http\Controllers;

use App\Enums\TransactionStatusEnum;
use App\Exports\LaporanBarangExport;
use App\Models\Patient;
use App\Models\Product;
use App\Models\ProductIn;
use App\Models\ProductList;
use App\Models\ProductStock;
use App\Models\Supplier;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::where(function ($query) {
            $search = \request()->get('search');
            $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
        })
        ->orderBy('id', 'DESC')
        ->paginate(10);
    
        return view('admin.pages.supplier.index', [
            'patients' => $patients
        ]);
    }

    public function show(Patient $patient)
    {
        $checkups = $patient->checkups;
        $transactions = $patient->transactions;

        return view('admin.pages.supplier.edit', [
            'patient' => $patient,
            'checkups' => $checkups,
            'transactions'  => $transactions
        ]);
    }

    public function store(Request $request)
    {
        $patient = new Patient();
        $patient->fill([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);
        $patient->saveOrFail();

        return redirect(route('admin.supplier.index'));
    }

    public function update(Patient $patient, Request $request)
    {
        $patient->fill($request->all());
        $patient->saveOrFail();

        return redirect(route('admin.supplier.index'));
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect(route('admin.supplier.index'));
    }
}
