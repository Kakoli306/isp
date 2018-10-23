<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Session;
use App\Customer;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
class ExcelController extends Controller
{
    /**
     * @return BinaryFileResponse
     */

    public function importExport()
    {
        return view('superadmin.includes.importExport');
    }

    public function downloadExcel($type)
    {
        $customer_array[] = array('Customer Name','Email','Mobile Number', 'Blood Group','National Id','Occupation', 'Address','Zone Name', 'IP Address'
        ,'Connection Charge','Connection Date','Speed');
        $data = DB::table('customers')
             ->join('zones', 'customers.zone_id', '=', 'zones.id')
           ->select('customers.*', 'zones.zone_name')
           ->orderBy('id', 'asc')
           ->get()
            ->toArray();

        foreach($data as $customer)
{
$customer_array[] = array(
'Customer Name'  => $customer->customer_name,
    'Email'  => $customer->email,
    'Mobile Number'    => $customer->mobile_no,
    'Blood Group'   => $customer->blood_group,
    'National Id' => $customer->national_id,
    'Occupation' => $customer->occupation,
    'Address' => $customer->address,
    'Zone Name'   => $customer->zone_name,
    'IP Address' => $customer->ip_address,
    'Connection Charge' => $customer->connection_charge,
    'Connection Date' => $customer->connection_date,
    'Speed' => $customer->speed

);
}
        return Excel::create('excelfile', function($excel) use ($customer_array) {
            $excel->sheet('mySheet', function($sheet) use ($customer_array)
            {
                $sheet->fromArray($customer_array);
            });
        })->download($type);
    }

    public function importExcel(Request $request)
    {
        $data = DB::table('customers')
            ->join('zones', 'customers.zone_id', '=', 'zones.id')
            ->select('customers.*', 'zones.zone_name')
            ->orderBy('id', 'asc')
            ->get()
            ->toArray();

        if($request->hasFile('import_file'))
        {
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                print_r($reader) ;
                foreach ($reader->toArray() as $key => $row) {
                    $data['address'] = $row['address'];
                    $data['speed'] = $row['speed'];
                    $data['mobile_no'] = $row['mobile_no'];
                    $data['bill_amount'] = $row['bill_amount'];
                    $data['connection_date'] = $row['connection_date'];
                    $data['ip_address'] = $row['ip_address'];

                    if(!empty($data)) {
                        DB::table('customers')->insert($data);
                    }
                }
            });
        }

        Session::put('success', 'Your file successfully import in database!!!');

        return back();
    }


}

