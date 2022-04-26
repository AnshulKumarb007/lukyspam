<?php 

namespace App\Exports;

//use App\Invoice;
use App\Models\ServiceCustomer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ServiceCustomere implements FromView
{
    public function view(): View
    {
        return view('admin.ServiceCustomer.expo', [
            'customers' => ServiceCustomer::all()
        ]);
    }
}