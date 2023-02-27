<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FakerURL;
use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    public function index(){
        if(auth()->user()->role == User::ADMIN_ROLE){
            $allData = User::where('id', '!=', auth()->id())->get();
            return view('admin.agents.index', compact('allData'));
        }
        abort(404);
    }

    public function deleteAgent($agentId){
        $user = User::where('id', FakerURL::id_d($agentId))->first();
        if (!empty($user)){
            $leads = Lead::where('agent_id', $user->id)->get();
            if (count($leads) == 0){
                $user->delete();
                return response()->json(['status' => 'success']);
            }
            return response()->json(['status' => 'error', 'message' => "This agent has leads, you can't delete this agent, you can only deactivate this agent."]);
        }
        return response()->json(['status' => 'error', 'message' => "Something went wrong!"]);
    }

    public function latestActiveAgent(){
        $agents = User::where('role', User::AGENT_ROLE)->orderBy('last_activity', 'desc')->get();
        return view('admin.partials.latest_agent', compact('agents'))->render();
    }

    public function registerAdminAgent(){
        if(auth()->user()->role == User::ADMIN_ROLE) {
            return view('admin.agents.register');
        }
        abort(404);
    }

    public function settingAccount($agentId=null){
        $user = auth()->user();
        if (!empty($agentId)){
            if(auth()->user()->role == User::ADMIN_ROLE){
                $user = User::findOrFail(FakerURL::id_d($agentId));
            }else{
                abort(404);
            }
        }
        return view('admin.profile.settings', compact('user'));
    }

    public function userProfile($agentId=null){
        $user = auth()->user();
        if (!empty($agentId)){
            if(auth()->user()->role == User::ADMIN_ROLE){
                $user = User::findOrFail(FakerURL::id_d($agentId));
            }else{
                abort(404);
            }
        }
        if($user->role == User::ADMIN_ROLE){
            $unProcessedLeads = Lead::where('lead_status', Lead::UNPROCESSED)->count();
            $appointmentLeads = Lead::where('lead_status', Lead::APPOINTMENT)->count();
            $deadlineLeads = Lead::where('lead_status', Lead::DEADLINE)->count();
            $closedLeads = Lead::where('lead_status', Lead::CLOSED)->count();
            $notClosedLeads = Lead::where('lead_status', Lead::NOT_CLOSED)->count();
            $noInterestLeads = Lead::where('lead_status', Lead::NO_INTEREST)->count();
            $notReachedLeads = Lead::where('lead_status', 'LIKE', '%'.Lead::NOT_REACHED.'%')->count();
            $leads = Lead::with('agent')->orderBy('id', 'desc')->get();
        }else{
            $unProcessedLeads = Lead::where(['lead_status' => Lead::UNPROCESSED, 'agent_id' => $user->id])->count();
            $appointmentLeads = Lead::where(['lead_status' => Lead::APPOINTMENT, 'agent_id' => $user->id])->count();
            $deadlineLeads = Lead::where(['lead_status' => Lead::DEADLINE, 'agent_id' => $user->id])->count();
            $closedLeads = Lead::where(['lead_status' => Lead::CLOSED, 'agent_id' => $user->id])->count();
            $notClosedLeads = Lead::where(['lead_status' => Lead::NOT_CLOSED, 'agent_id' => $user->id])->count();
            $noInterestLeads = Lead::where(['lead_status' => Lead::NO_INTEREST, 'agent_id' => $user->id])->count();
            $notReachedLeads = Lead::where('lead_status', 'LIKE', '%'.Lead::NOT_REACHED.'%')->where('agent_id', $user->id)->count();
            $leads = Lead::with('agent')->where('agent_id', $user->id)->orderBy('id', 'desc')->get();
        }
        $agents = User::where(['role' => User::AGENT_ROLE, 'is_active' => 1])->get();
        return view('admin.profile.index', compact(
        'user',
            'unProcessedLeads',
            'appointmentLeads',
            'deadlineLeads',
            'closedLeads',
            'notClosedLeads',
            'noInterestLeads',
            'notReachedLeads',
            'leads',
            'agents'
        ));
    }

    public function registerUser(){
        if(auth()->user()->role != User::ADMIN_ROLE) {
            return response()->json(['status' => 'error', "message" => 'You dont have permission to perform this task.'], 200);
        }
        $request = request()->all();
        $rules = [
            "name"      => "required|max:255",
            "surname"   => "required|max:255",
            "phone"     => "required|max:255",
            "email"     => "required|max:255|email|unique:users,email",
            "username"  => "required|max:255|unique:users,username",
            "password"  => "required|max:255|min:6",
            "is_active" => "required|in:1,0",
            "role"      => "required|in:agent,admin",
            "profile_img" => "sometimes|nullable|max:2048",
        ];
        $messages = [
            "is_active.required" => "The account status field is required.",
        ];
        $validator = Validator::make($request, $rules, $messages);
        if ($validator->fails()){
            return response()->json(['status' => 'errors', 'errors' => $validator->errors()], 422);
        }
        if(isset($request['profile_img']) && !empty($request['profile_img'])){
            $file = request()->file('profile_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move(public_path().'/profiles/', $fileName);
            $request['profile_img'] = $fileName;
        }
        User::create($request);
        return response()->json(['status' => 'success', "message" => 'New '.$request['role'].' has been created.'], 200);
    }

    public function updateSettingAccount($userId){
        $request = request()->all();
        $rules = [
            "name"      => "required|max:255",
            "surname"   => "required|max:255",
            "phone"     => "required|max:255",
            "email"     => "required|max:255|email|unique:users,email,".FakerURL::id_d($userId),
            "username"  => "required|max:255|unique:users,username,".FakerURL::id_d($userId),
            "password"  => "sometimes|nullable|max:255|min:6",
            "profile_img" => "sometimes|nullable|max:2048",
        ];
        $messages = [
            "is_active.required" => "The account status field is required.",
        ];
        $validator = Validator::make($request, $rules, $messages);
        if ($validator->fails()){
            return response()->json(['status' => 'errors', 'errors' => $validator->errors()], 422);
        }
        if(empty($request['password'])){
            unset($request['password']);
        }
        if(isset($request['profile_img']) && !empty($request['profile_img'])){
            $file = request()->file('profile_img');
            $fileName = md5($file->getClientOriginalName()) . time() . "." . $file->getClientOriginalExtension();
            $file->move(public_path().'/profiles/', $fileName);
            $request['profile_img'] = $fileName;
        }
        $user = User::findOrFail(FakerURL::id_d($userId));
        $user->update($request);
        return response()->json(['status' => 'success', "message" => 'Setting has been updated.'], 200);
    }
}
