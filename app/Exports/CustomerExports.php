<?php 

namespace App\Exports;

//use App\Invoice;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerExports implements FromView
{
    public function view(): View
    {
        return view('admin.partner.export', [
            'customers' => Customer::all()
        ]);
    }
}