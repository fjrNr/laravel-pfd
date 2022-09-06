<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Borrower;
use Auth;
use Validator;

class BorrowerController extends Controller
{
    function doEntry(Request $rq){
        if(Auth::user()->group == 'ADMIN' || Auth::user()->group == 'SUBM OFC'){
            $validator = Validator::make($rq->all(), [
                'empNbr' => 'nullable|digits:6',
                'empName' => 'required',
                'empUnit' => 'required|max:10'
            ]);

            if ($validator->passes()) {
                $borrower = new Borrower;
                $borrower->empName = $rq->empName;
                $borrower->empNbr = $rq->empNbr;
                $borrower->empUnit = $rq->empUnit;
         		$borrower->save();
                return redirect('/borrowing/entry');
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    function doSearch(Request $rq){
    	if(Auth::user()->group == 'ADMIN' || Auth::user()->group == 'SUBM OFC'){
    		$query = $rq->get('term', '');
            $crews = Borrower::where('empName', 'LIKE', '%'.$query.'%')->paginate(5);
            $data = [];
            foreach ($crews as $key => $crew){
                $data[] = [
                	'value'=> $crew->empName,
                	'nbr'=> $crew->empNbr,
                	'unit'=> $crew->empUnit,
                ];
            }

            if(count($data)){
                return response($data);
            }else{
                return ['value' => 'No result found'];
            }
    	}
    }
}
