<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $user = auth()->user();
        if($user->role == User::ADMIN_ROLE){
            $totalLeads = Lead::count();
            $unProcessedLeads = Lead::where('lead_status', Lead::UNPROCESSED)->count();
            $appointmentLeads = Lead::where('lead_status', Lead::APPOINTMENT)->count();
            $deadlineLeads = Lead::where('lead_status', Lead::DEADLINE)->count();
            $closedLeads = Lead::where('lead_status', Lead::CLOSED)->count();
            $notClosedLeads = Lead::where('lead_status', Lead::NOT_CLOSED)->count();
            $noInterestLeads = Lead::where('lead_status', Lead::NO_INTEREST)->count();
            $notReachedLeads = Lead::where('lead_status', 'LIKE', '%'.Lead::NOT_REACHED.'%')->count();
        }else{
            $totalLeads = Lead::where('agent_id', $user->id)->count();
            $unProcessedLeads = Lead::where(['lead_status' => Lead::UNPROCESSED, 'agent_id' => $user->id])->count();
            $appointmentLeads = Lead::where(['lead_status' => Lead::APPOINTMENT, 'agent_id' => $user->id])->count();
            $deadlineLeads = Lead::where(['lead_status' => Lead::DEADLINE, 'agent_id' => $user->id])->count();
            $closedLeads = Lead::where(['lead_status' => Lead::CLOSED, 'agent_id' => $user->id])->count();
            $notClosedLeads = Lead::where(['lead_status' => Lead::NOT_CLOSED, 'agent_id' => $user->id])->count();
            $noInterestLeads = Lead::where(['lead_status' => Lead::NO_INTEREST, 'agent_id' => $user->id])->count();
            $notReachedLeads = Lead::where('lead_status', 'LIKE', '%'.Lead::NOT_REACHED.'%')->where('agent_id', $user->id)->count();
        }
        return view('admin.dashboard', compact(
           'totalLeads',
            'unProcessedLeads',
            'appointmentLeads',
            'deadlineLeads',
            'closedLeads',
            'notClosedLeads',
            'noInterestLeads',
            'notReachedLeads'
        ));
    }

    public function latestLeadPartial(){
        $user = auth()->user();
        if($user->role == User::ADMIN_ROLE){
            $leads = Lead::with('agent')->orderBy('updated_at', 'desc')->limit(5)->get();
        }else{
            $leads = Lead::with('agent')->where('agent_id', $user->id)->orderBy('updated_at', 'desc')->limit(5)->get();
        }
        return view('admin.partials.latest_lead_partial', compact('leads'))->render();
    }
}
