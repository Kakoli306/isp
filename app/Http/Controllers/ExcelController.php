<?php

namespace App\Http\Controllers;
use App\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use File;
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

        $data = Customer::get()->toArray();
        return Excel::create('customers', function($excel) use ($data) {
            $excel->sheet('mySheet', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download($type);

//        $customer_array[] = array('id','Customer Name','Email','Mobile Number', 'Blood Group','National Id','Occupation', 'Address','Zone Name', 'IP Address'
//        ,'Connection Charge','Connection Date','Speed');
//        $data = DB::table('customers')
//             ->join('zones', 'customers.zone_id', '=', 'zones.id')
//           ->select('customers.*', 'zones.zone_name')
//           ->orderBy('id', 'asc')
//           ->get()
//            ->toArray();
//
//        foreach($data as $customer)
//{
//$customer_array[] = array(
//    'id' => $customer->id,
//    'Customer Name'  => $customer->customer_name,
//    'Email'  => $customer->email,
//    'Mobile Number'    => $customer->mobile_no,
//    'Blood Group'   => $customer->blood_group,
//    'National Id' => $customer->national_id,
//    'Occupation' => $customer->occupation,
//    'Address' => $customer->address,
//    'Zone Name'   => $customer->zone_name,
//    'IP Address' => $customer->ip_address,
//    'Connection Charge' => $customer->connection_charge,
//    'Connection Date' => $customer->connection_date,
//    'Speed' => $customer->speed
//
//);
//}
//        return Excel::create('excelfile', function($excel) use ($customer_array) {
//            $excel->sheet('mySheet', function($sheet) use ($customer_array)
//            {
//                $sheet->fromArray($customer_array);
//            });
//        })->download($type);


    }

    // public function importExcel(Request $request)
    // {
    //     $request->validate([
    //         'import_file' => 'required'
    //     ]);

    //     $path = $request->file('import_file')->getRealPath();
    //     $data = Excel::load($path)->get();

    //    // return $data;

    //     if($data->count()){
    //         foreach ($data as $key => $value) {
    //             $arr[] = [

    //                'customer_name' => $value[0]->customer_name,
    //                 'email' => $value[0]->email,
    //                 'mobile_no' => $value[0]->mobile_no,
    //                 'blood_group' => $value[0]->blood_group,
    //                 'national_id' => $value[0]->national_id,
    //                 'ip_address' => $value[0]->ip_address,
    //                 'connection_charge' => $value[0]->connection_charge,
    //                 'speed' => $value[0]->speed,
    //                 'zone_id' => $value[0]->zone_id,
    //                 'occupation' => $value[0]->occupation,
    //                 'address' => $value[0]->address,
    //                 'month_amount' => $value[0]->month_amount,
    //                 'bill_amount' => $value[0]->bill_amount,
    //                 'connection_date' => $value[0]->connection_date,
    //                 'status' => $value[0]->status

    //             ];
    //         }

    //         if(!empty($arr)){
    //        //  return $arr;
    //             Customer::insert($arr);
    //         }
    //     }

    //     return back()->with('success', 'Insert Record successfully.');
    // }


    public function importExcel(Request $request)
    {

        // dd($request->hasFile('import_file'));

        // if($request->hasFile('import_file'))
        // {
        //     Excel::load($request->file('import_file')->getRealPath(), function ($reader) {

        // if($request->hasFile('import_file')){
        //  $extension = File::extension($request->import_file->getClientOriginalExtension());
        //  if ($extension == "xlsx" || $extension == "xls" || $extension == "csv") {

        //      $path = $request->import_file->getRealPath();
        //      $data = Excel::load($path, function($reader) {
        //      })->get();
        //      //   return $path;
        //      if(!empty($data) && $data->count()){


        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();
//return $data[0];

        // $data = $data[0];

        //  return $data;


        foreach ($data as $value) {
            $insert[] = [
                'zone_id' => $value->zone_id,
                'customer_name' =>$value->customer_name,
                'mobile_no' => $value->mobile_no,
                'email' => $value->email,
                'blood_group' => $value->blood_group,
                'national_id' => $value->national_id,
                'occupation' => $value->occupation,
                'month_amount' => $value->month_amount,
                'bill_amount' => $value->bill_amount,
                'connection_charge' => $value->connection_charge,
                'ip_address' => $value->ip_address,
                'connection_date' =>date('d-m-Y', strtotime($value->connection_date)),
                'address' => $value->address,

                'speed' => $value->speed,
                'status' => $value->status,
            ];
        }

        if(!empty($insert)){

            $insertData = DB::table('customers')->insert($insert);
            if ($insertData) {
                Session::flash('success', 'Your Data has successfully imported');
            }else {
                Session::flash('error', 'Error inserting the data..');
                return back();
            }

            // $data['zone_id'] = '';
            // $data['customer_name'] = $row['customer_name1'];
            // $data['mobile_no'] = $row['mobile_no'];
            // $data['email'] = $row['email'];
            // $data['blood_group'] = $row['blood_group'];
            // $data['national_id'] = $row['national_id'];
            // $data['occupation'] = $row['occupation'];
            // $data['address'] = $row['address'];
            // $data['month_amount'] = $row['month_amount'];
            // $data['bill_amount'] = $row['bill_amount'];
            // $data['connection_charge'] = $row['connection_charge'];
            // $data['ip_address'] = $row['ip_address'];
            // $data['connection_date'] = $row['connection_date'];
            // $data['speed'] = $row['speed'];
            // $data['status'] = $row['status'];

            // if(!empty($data)) {
            //     DB::table('customers')->insert($data);
            // }


            // DB::table('customers')->insert([

            //    'zone_id' => '',
            //    'customer_name' => '',
            //    'mobile_no' => $row['mobile_no'],
            //    'email' => $row['email'],
            //    'blood_group' => $row['blood_group'],
            //    'national_id' => $row['national_id'],
            //    'occupation' => $row['occupation'],
            //    'month_amount' => $row['month_amount'],
            //    'bill_amount' => $row['bill_amount'],
            //    'connection_charge' => $row['connection_charge'],
            //    'ip_address' => $row['ip_address'],
            //    'connection_date' => $row['connection_date'],
            //    'speed' => $row['speed'],
            //    'status' => $row['status'],




            //    ]);

            //   return $row['mobile_no'];

            // $user = new Customer();

            // $user->zone_id ='';
            // $user->customer_name = '';
            // $user->mobile_no = $value->mobile_no;
            // $user->email =$value->email;
            // $user->blood_group = $value->blood_group;
            // $user->national_id = $value->national_id;
            // $user->occupation = $value->occupation;
            // $user->month_amount = $value->month_amount;
            // $user->bill_amount = $value->bill_amount;
            // $user->connection_charge = $value->connection_charge;
            // $user->ip_address = $value->ip_address;
            // $user->connection_date =$value->mobile_no;
            // $user->speed = $value->speed;
            // $user->status = $value->status;
            // $user->save();




//                 }

//         }
//     }
// }
        }
        Session::put('success', 'Your file successfully import in database!!!');

        // return back();



    }
}
