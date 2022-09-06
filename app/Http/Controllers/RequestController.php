<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Requesting;
use App\Log;
use App\Submission;
use Auth;
use DataTables;
use DB;
use Validator;

class RequestController extends Controller
{
    function doEntry(Request $rq){
        $request = new Requesting;
        $request->empName = $rq->empName;
        $request->empUnit = $rq->empUnit;
        $request->copyType = $rq->fType;
        $request->requestDate = Carbon::now()->toDateString();
        $request->remark =  $rq->remark;
        $request->save();

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
                    $detail_request = DB::table('submission_request')->insert([
                        'requestId' => $request->id,
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
                    $detail_request = DB::table('log_request')->insert([
                        'requestId' => $request->id,
                        'logId' => $log->id,
                    ]);
                }
            }
        }
        return ['success'];
    }

    function doLoadAllData(Request $rq){
        if($rq->role == 0){
            $requests = Requesting::join('submission_request','requests.id','=','submission_request.requestId')
                        ->join('submissions','submissions.id','=','submission_request.submissionId')
                        ->join('submission_assignments', 'submissions.id','=', 'submission_assignments.submissionId')
                        ->join('boxes', 'submission_assignments.boxId','=', 'boxes.id')
                        ->selectRaw('empName, requests.id, empUnit, requestDate, COUNT(submission_request.submissionId) AS totalDoc')
                        ->groupBy('requests.id');
        }else if($rq->role == 1){
            $requests = Requesting::join('log_request','requests.id','=','log_request.requestId')
                        ->join('logs','logs.id','=','log_request.logId')
                        ->selectRaw('empName, requests.id, empUnit, requestDate, COUNT(log_request.logId) AS totalDoc')
                        ->groupBy('requests.id');
        }

        return DataTables::of($requests)
                ->setRowId('requests.id')
                ->editColumn('requestDate', function($request){
                    return date("d-m-Y", strtotime($request->requestDate));
                })
                ->addColumn('action', function($request){
                    return '<a href="edit/'.$request->id.'" style="font-weight: bold;" class="btn-sm btn-warning">&#x1f589; Edit</a>';
                })
                ->rawColumns(['outDate' => 'outDate','receivedDate' => 'receivedDate','action' => 'action'])
                ->make(true);
    }
}
