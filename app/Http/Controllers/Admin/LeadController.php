<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function index(){
        $user = auth()->user();
        $leadStatus = request()->lead_status;
        if($user->role == User::ADMIN_ROLE){
            $leads = Lead::with('agent');
            if(isset($leadStatus) && !empty($leadStatus) && $leadStatus != "all"){
                if($leadStatus == "closed"){
                    $leads = $leads->where('lead_status', $leadStatus);
                }else{
                    $leads = $leads->where('lead_status', 'LIKE', '%'.$leadStatus.'%');
                }
            }
            $leads = $leads->orderBy('id', 'desc')->get();
        }else{
            $leads = Lead::with('agent')->where('agent_id', $user->id);
            if(isset($leadStatus) && !empty($leadStatus) && $leadStatus != "all"){
                if($leadStatus == "closed"){
                    $leads = $leads->where('lead_status', $leadStatus);
                }else{
                    $leads = $leads->where('lead_status', 'LIKE', '%'.$leadStatus.'%');
                }
            }
            $leads = $leads->orderBy('id', 'desc')->get();
        }
        $agents = User::where(['role' => User::AGENT_ROLE, 'is_active' => 1])->get();
        return view('admin.leads.index', compact('leads', 'user', 'agents', 'leadStatus'));
    }

    public function addEditLead($leadId=""){
        $user = auth()->user();
        $lead = Lead::find(FakerURL::id_d($leadId));
        if (!empty($lead)){
            if($user->role == User::AGENT_ROLE){
                if($lead->agent_id != $user->id){
                    abort(404);
                }
            }
        }
        return view('admin.leads.add_edit_lead', compact('lead'));
    }

    public function viewLead($leadId){
        $user = auth()->user();
        $lead = Lead::findOrFail(FakerURL::id_d($leadId));
        if($user->role == User::AGENT_ROLE){
            if($lead->agent_id != $user->id){
                abort(404);
            }
        }
        return view('admin.leads.view_lead', compact('lead'));
    }

    public function deleteLead($leadId){
        Lead::where('id', FakerURL::id_d($leadId))->delete();
        return response()->json(['status' => 'success'], 200);
    }

    public function assignLead($leadId){
        $lead = Lead::findOrFail(FakerURL::id_d($leadId));
        if (!empty($lead)){
            $lead->update([
                'agent_id' => request()->agent_id,
            ]);
        }
        return response()->json(['status' => 'success'], 200);
    }

    public function leadData(Request $request){
        $search = $request->input('search.value', '');
        $orderArray = ['id', 'first_name'];
        $orderByColumn = $orderArray[$request->input('order.0.column', 0)];
        $orderBy = $request->input('order.0.dir', 'asc');
        $leads = Lead::with(['agent']);
        if (!empty($search)) {
            $leads = $leads->where(function ($query) use ($search) {
                $query
                    ->orWhere('first_name', 'like', '%'. $search . '%')
                    ->orWhere('last_name', 'like', '%'. $search . '%');
            });
        }
        if (isset($request->lead_status)){
            $leads->where('lead_status', $request->lead_status);
        }
        $leads = $leads->orderBy($orderByColumn, $orderBy);
        $count = $leads->count();
        $leads = $leads
            ->skip($request->start ?? 0)->take($request->length ?? 10)->get();
        return response()->json([
            'statusCode' => 200,
            'message' => 'Fetched successfully.',
            'recordsTotal' => $count,
            'data' => $leads,
            'recordsFiltered' => $count
        ], 200);
    }

    public function createUpdateLead($leadId=""){
        $request = request()->all();
        $rules = [
            "first_name" => "required|max:255",
            "last_name" => "required|max:255",
            "email" => "required|max:255|email",
            "phone" => "required|max:255",
            "lead_status" => "required|in:unprocessed,appointment,not_reached_1,not_reached_2,not_reached_3,not_reached_4,not_reached_5,deadline,closed,not_closed,no_interests",
            "gender" => "required|in:Frau,Herr",
            "investment_amount" => "required",
            "reachability" => "required",
            "interested_in" => "required",
        ];
        $validator = Validator::make($request, $rules);
        if ($validator->fails()){
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }
        if(!empty($leadId)){
            $lead = Lead::find(FakerURL::id_d($leadId));
            if (!empty($lead)){
                $request['is_pdf_generated'] = 0;
                $lead->update($request);
            }
            return response()->json(['status' => 'success', 'message' => "Lead has been updated."], 200);
        }else{
            $request['agent_id'] = (auth()->user()->role == User::AGENT_ROLE) ? auth()->id() : null;
            Lead::create($request);
            return response()->json(['status' => 'success', 'message' => "Lead has been created."], 200);
        }
    }

    public function generatePdf($leadId){
        $dompdf = new DOMPDF();
        $dompdf->setPaper(array(0, 0, 700, 850));
        $lead = Lead::with('agent')->findOrFail(FakerURL::id_d($leadId));
        $html = view('admin.pdf', compact('lead'))->render();
        $dompdf->loadHtml($html);
        $dompdf->render();
        $output = $dompdf->output();
        $fileName = public_path('/pdf/lead-'.$lead->faker_id.'.pdf');
        file_put_contents($fileName, $output);
        $lead->update([
            'is_pdf_generated' => 1
        ]);
        return response()->json(['status' => 'success', 'message' => "PDF has been generated successfully."], 200);
    }
}
