<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Customer;
class LiveSearchController extends Controller
{
    public function actives()
    {
        $customers = DB::table('customers')
            ->where('status', 1)
            ->orderBy('id', 'DESC')->paginate(8);

        $zones = DB::table('zones')->get();
        $sun = Customer::sum('bill_amount');

        return view('superadmin.customer.actives', ['customers' => $customers, 'zones' => $zones, 'sun' => $sun])
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    function action(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
            if($query != '')
            {
                $data = DB::table('customers')
                    ->join('zones', 'customers.zone_id', '=', 'zones.id')
                    ->select('customers.*', 'zones.zone_name')
                    ->where('status', 1)

                    ->where('customer_name', 'like', '%' . $query . '%')
                    ->orWhere('mobile_no', 'like', '%' . $query . '%')
                    ->orWhere('address', 'like', '%' . $query . '%')
                    ->orWhere('speed', 'like', '%' . $query . '%')
                    ->orWhere('bill_amount', 'like', '%' . $query . '%')
                    ->orWhere('ip_address', 'like', '%' . $query . '%')
                    ->orWhere('connection_date', 'like', '%' . $query . '%')
                    ->orderBy('id', 'asc')
                    ->get();

            }
            else
            {
                $data = DB::table('customers')
                    ->where('status', 1)
                    ->join('zones', 'customers.zone_id', '=', 'zones.id')
                    ->select('customers.*', 'zones.zone_name')
                    ->orderBy('id', 'desc')
                    ->get();
            }
            $i = 1;
            $total_row = $data->count();
            if($total_row > 0)
            {
                foreach($data as $row)
                {
                    $output .= '
        <tr>
         <td>'.$i++.'</td>
         <td>'.$row->customer_name.'</td>
         <td>'.$row->id.'</td>
         <td>'.$row->address.'</td>
         <td>'.$row->mobile_no.'</td>
         <td>'.$row->speed.'</td>
         <td>'.$row->bill_amount.'</td>
         <td>'.$row->connection_date.'</td>
         <td>'.$row->ip_address.'</td>

        </tr>
        ';
                }
            }
            else
            {
                $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
            }
            $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }

}
