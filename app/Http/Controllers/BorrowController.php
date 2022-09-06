<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Borrowing;
use App\Log;
use App\submission;
use Auth;
use DataTables;
use DB;
use Validator;

class BorrowController extends Controller
{
    function doDelete(){
    	
    }

    function doEdit(){

    }

    function doEntry(Request $rq){
        $borrowing = new Borrowing;
        $borrowing->empName = $rq->empName;
        $borrowing->empUnit = $rq->empUnit;
        $borrowing->outDate = Carbon::now()->toDateString();
        $borrowing->remark =  $rq->remark;
        $borrowing->save();

        if($rq->role == 0){
            if($rq->input('formNo')){
                foreach ($rq->input('formNo') as $key => $v) {
                    $submission = Submission::where('formNbr',$rq->formNo[$key])->first();
                    if(!$submission){
                       return ['dead'];
                    }        
                }

                foreach ($rq->input('formNo') as $key => $v) {
                    $submission = Submission::where('formNbr',$rq->formNo[$key])->first();
                    $detail_borrowing = DB::table('submission_borrowing')->insert([
                       'borrowingId' => $borrowing->id,
                        'submissionId' => $submission->id, 
                    ]);        
                }
            }
        }else if($rq->role == 1){
            if($rq->input('AFLNo')){
                foreach ($rq->input('AFLNo') as $key => $v) {
                    $log = Log::where('aflNbr',$rq->AFLNo[$key])->first();
                    if(!$log){
                        return ['dead'];
                    }
                }

                foreach ($rq->input('AFLNo') as $key => $v) {
                    $log = Log::where('aflNbr',$rq->AFLNo[$key])->first();
                    $detail_borrowing = DB::table('log_borrowing')->insert([
                        'borrowingId' => $borrowing->id,
                        'logId' => $log->id, 
                    ]);
                }
            }
        }
        return ['success'];
    }

    function doLoadAllData(Request $rq){
        if($rq->role == 0){
            $borrowings = Borrowing::join('submission_borrowing','borrowings.id','=','submission_borrowing.borrowingId')
                        ->join('submissions','submissions.id','=','submission_borrowing.submissionId')
                        ->join('submission_assignments', 'submissions.id','=', 'submission_assignments.submissionId')
                        ->join('boxes', 'submission_assignments.boxId','=', 'boxes.id')
                        ->selectRaw('empName, borrowings.id, empUnit, outDate, borrowings.receivedDate, COUNT(submission_borrowing.submissionId) AS totalDoc')
                        ->groupBy('borrowings.id');

        }else if($rq->role == 1){
            $borrowings = Borrowing::join('log_borrowing','borrowings.id','=','log_borrowing.borrowingId')
                        ->join('logs','logs.id','=','log_borrowing.logId')
                        ->selectRaw('empName, borrowings.id, empUnit, outDate, borrowings.receivedDate, COUNT(log_borrowing.logId) AS totalDoc')
                        ->groupBy('borrowings.id');
        }

        return DataTables::of($borrowings)
                ->setRowId('borrowings.id')
                ->editColumn('outDate', function($borrowing){
                    return date("d-m-Y", strtotime($borrowing->outDate));
                })
                ->editColumn('receivedDate', function($borrowing){
                    if(isset ($borrowing->receivedDate)){
                        return date("d-m-Y", strtotime($borrowing->receivedDate));
                    }else{
                        return 'Not yet returned';
                    }
                })
                ->addColumn('action', function($borrowing){
                    if(isset ($borrowing->receivedDate)){
                        return '<a href="delete/'.$borrowing->id.'" style="font-weight: bold;" class="btn-sm btn-warning" onclick="return false;">X Delete</a>';
                    }else{
                        return '<a href="edit/'.$borrowing->id.'" style="font-weight: bold;" class="btn-sm btn-warning">&#x1f589; Edit</a><a href="return/'.$borrowing->id.'" style="font-weight: bold;" class="btn-sm btn-primary btn-return" onclick="return false;">&#x23ce; Return</a>';
                    }
                })
                ->rawColumns(['outDate' => 'outDate','receivedDate' => 'receivedDate','action' => 'action'])
                ->make(true);
    }

    function doReturn($id){
        $borrowing = Borrowing::where('id',$id)->first();
        $borrowing->receivedDate = Carbon::now()->toDateString();
        $borrowing->save();
        return ['success' => 'This borrowing has been returned.'];                        
    }
}
