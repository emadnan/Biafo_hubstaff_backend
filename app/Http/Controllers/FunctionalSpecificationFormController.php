<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\FunctionalSpecificationForm;
use App\Models\FsfHasParameter;
use App\Models\FsfHasOutputParameter;
use App\Models\FsfAssignToUser;
use App\Models\Module;
use Carbon\Carbon;


use Illuminate\Http\Request;

class FunctionalSpecificationFormController extends Controller
{
    function addFunctionalSpecificationForm(){

        $Functional = new FunctionalSpecificationForm();
        $Functional->reference_id = \Request::input('reference_id');
        $Functional->module_id = \Request::input('module_id');
        $Functional->project_id = \Request::input('project_id');
        $Functional->type_of_development = \Request::input('type_of_development');
        $Functional->wricef_id = \Request::input('wricef_id');
        $Functional->functional_lead_id = \Request::input('functional_lead_id');
        $Functional->ABAP_team_lead_id = \Request::input('ABAP_team_lead_id');
        $Functional->requested_date = \Request::input('requested_date');
        $Functional->priority = \Request::input('priority');
        $Functional->usage_frequency = \Request::input('usage_frequency');
        $Functional->transaction_code = \Request::input('transaction_code');
        $Functional->authorization_role = \Request::input('authorization_role');
        $Functional->development_logic = \Request::input('development_logic');
        $Functional->input_screen = \Request::input('input_screen');
        $Functional->output_screen = \Request::input('output_screen');

        $Functional->save();

        return response()->json(['message'=>'Add Functional Specificational Form Successfully']);
    }

    function updateFunctionalSpecificationForm(){

        $id = \Request::input('id');
        $Functional = FunctionalSpecificationForm::where('id',$id)
        ->update([
            'reference_id' => \Request::input('reference_id'),
            'module_id' => \Request::input('module_id'),
            'project_id' => \Request::input('project_id'),
            'type_of_development' => \Request::input('type_of_development'),
            'requested_date' => \Request::input('requested_date'),
            'wricef_id' => \Request::input('wricef_id'),
            'functional_lead_id' => \Request::input('functional_lead_id'),
            'ABAP_team_lead_id' => \Request::input('ABAP_team_lead_id'),
            'priority' => \Request::input('priority'),
            'usage_frequency' => \Request::input('usage_frequency'),
            'transaction_code' => \Request::input('transaction_code'),
            'development_logic' => \Request::input('development_logic'),
            'input_screen' => \Request::input('input_screen'),
            'output_screen' => \Request::input('output_screen')
        ]);
        
        return response()->json(['message'=>'Update Functional Specificational Form Successfully']);
    } 

    function addFsfHasInputParameters()   {
        
        $fsfhasparameter = new FsfHasParameter();
        $fsfhasparameter->fsf_id = \Request::input('fsf_id');
        $fsfhasparameter->description = \Request::input('description');
        $fsfhasparameter->input_parameter_name = \Request::input('input_parameter_name');
        $fsfhasparameter->field_technical_name = \Request::input('field_technical_name');
        $fsfhasparameter->field_length = \Request::input('field_length');
        $fsfhasparameter->field_type = \Request::input('field_type');
        $fsfhasparameter->field_table_name = \Request::input('field_table_name');
        $fsfhasparameter->mandatory_or_optional = \Request::input('mandatory_or_optional');
        $fsfhasparameter->parameter_or_selection = \Request::input('parameter_or_selection');
        $fsfhasparameter->save();
        
        return response()->json(['message'=>'Add FSF input Parameters Successfully']);
    }
    
    function UpdateFsfHasInputParameterByFsfId(){

        $id = \Request::input('id');
        $fsf = FsfHasParameter::where('id',$id)
        ->update([

            'fsf_id' => \Request::input('fsf_id'),
            'description' => \Request::input('description'),
            'input_parameter_name' => \Request::input('input_parameter_name'),
            'field_technical_name' => \Request::input('field_technical_name'),
            'field_length' => \Request::input('field_length'),
            'field_type' => \Request::input('field_type'),
            'field_table_name' => \Request::input('field_table_name'),
            'mandatory_or_optional' => \Request::input('mandatory_or_optional'),
            'parameter_or_selection' => \Request::input('parameter_or_selection')

        ]);
        
        return response()->json(['message'=>'Update FSF Has input ParaMeter Successfully']);
    }

    function addFsfOutputParameters()   {
        
        $fsfhasparameter = new FsfHasOutputParameter();
        $fsfhasparameter->fsf_id = \Request::input('fsf_id');
        $fsfhasparameter->description = \Request::input('description');
        $fsfhasparameter->output_parameter_name = \Request::input('output_parameter_name');
        $fsfhasparameter->field_technical_name = \Request::input('field_technical_name');
        $fsfhasparameter->field_length = \Request::input('field_length');
        $fsfhasparameter->field_type = \Request::input('field_type');
        $fsfhasparameter->field_table_name = \Request::input('field_table_name');
        $fsfhasparameter->mandatory_or_optional = \Request::input('mandatory_or_optional');
        $fsfhasparameter->parameter_or_selection = \Request::input('parameter_or_selection');
        $fsfhasparameter->save();
        
        return response()->json(['message'=>'Add FSF output Parameters Successfully']);
    }

    function UpdateFsfHasOutputParameterByFsfId(){

        $id = \Request::input('id');
        $fsf = FsfHasOutputParameter::where('id',$id)
        ->update([

            'fsf_id' => \Request::input('fsf_id'),
            'description' => \Request::input('description'),
            'output_parameter_name' => \Request::input('output_parameter_name'),
            'field_technical_name' => \Request::input('field_technical_name'),
            'field_length' => \Request::input('field_length'),
            'field_type' => \Request::input('field_type'),
            'field_table_name' => \Request::input('field_table_name'),
            'mandatory_or_optional' => \Request::input('mandatory_or_optional'),
            'parameter_or_selection' => \Request::input('parameter_or_selection')

        ]);
        
        return response()->json(['message'=>'Update FSF Has output ParaMeter Successfully']);
    }

    function getFsfHasOutputParameters(){
        
        $FsfHasOutputParameters = FsfHasOutputParameter::
        get();

        return response()->json(['Fsf Has output Parameters'=>$FsfHasOutputParameters]);
    }

    function getFsfHasOutputParameterById($id){
        
        $FsfHasOutputParameters = FsfHasOutputParameter::
        where('id',$id)
        ->get();

        return response()->json(['Fsf Has output Parameter'=>$FsfHasOutputParameters]);
    }

    function deleteFunctionalSpecificationForm(){
        
        $id = \Request::input('id');
        $Functional = FunctionalSpecificationForm::where('id',$id)->delete();

        return response()->json(['message'=>'Delete Functional Specificational Form Successfully']);
    }

    function getFunctionalSpecificationForm(){
        
        $Functional = FunctionalSpecificationForm::
            with('getFsfParameter')
            ->get();

        return response()->json(['Functional'=>$Functional]);
    }

    function getFunctionalSpecificationFormById(){
        
        $fsf = \Request::input('fsf');
        // print_r($fsf);
        // exit();
        $Functional = FunctionalSpecificationForm::
        where('id',$fsf)
        ->with('team_lead_details','function_lead_details','getFsfParameter')
        ->get();

        return response()->json(['Functional'=>$Functional]);
    }

    function getFsfHasParameterById($id){
        
        $fsf = FsfHasParameter::where('id',$id)->get();

        return response()->json(['fsf'=>$fsf]);
    }

    function getFsfHasParameterByFsfId($fsf_id){

        $fsf = FsfHasParameter::where('fsf_id',$fsf_id)
        ->get();

        return response()->json(['fsf_has_parameter'=>$fsf]);
    }

    function DeleteFsfHasParameterByFsfId(){

        $id = \Request::input('id');

        $fsf = FsfHasParameter::where('id',$id)
        ->delete();

        return response()->json(['fsf_has_parameter'=>'delete parameters Successfully']);
    }

     

    function getFunctionalSpecificationFormByTeamLeadId(){

        $Functional = FunctionalSpecificationForm::select('users.*','functional_specification_form.*')
            ->join('users','users.id','=','functional_specification_form.functional_lead_id')
            ->with('getFsfParameter')
            ->get();

        return response()->json(['Functional'=>$Functional]);
    }

    public function fsfAssignToUsers(Request $request){
           
        $user_ids = $request->user_ids;
        $fsf_id = \Request::input('fsf_id');
        $dead_line = \Request::input('dead_line');
        $assign = FsfAssignToUser::where('fsf_id',$fsf_id)->delete();
        foreach($user_ids as $user_id)
        {
            $assign = new FsfAssignToUser;
            $assign->fsf_id = $fsf_id;
            $assign->user_id = $user_id;
            $assign->dead_line = $dead_line;
            $assign->save();
        }
        return response()->json(['message'=>' FSF Assign To Users Successfully']);
    }

    function getFsfAssignToUsersByFsfId($fsf_id){

        $fsf = FsfAssignToUser::where('fsf_id',$fsf_id)
        ->get();

        return response()->json(['fsf_Assign_to_users'=>$fsf]);
    }

    function getFunctionalSpecificationFormBylogin(){
        
        $userId = Auth::id();
        $Functional = FunctionalSpecificationForm::select('fsf_assign_to_users.*','functional_specification_form.*')
        ->join('fsf_assign_to_users','fsf_assign_to_users.fsf_id','=','functional_specification_form.id')
        
        ->where('fsf_assign_to_users.user_id',$userId)
        ->with('team_lead_details','function_lead_details','getFsfParameter')
        ->get();

        return response()->json(['Functional'=>$Functional]);
    }
    function getFsfAssignToUserByLogin(){
        $userId = Auth::id();

        $fsf_Assign_to_users = FsfAssignToUser::where('user_id',$userId)
        ->get();

        return response()->json(['fsf_Assign_to_users'=>$fsf_Assign_to_users]);

    }  

    function updateStatusByLogin(){

        $userId = Auth::id();
        if(!$userId){
            return response()->json(['message'=>'user not login']);
        }
        $fsf_id = \Request::input('fsf_id');

        $fsf_Assign_to_users = FsfAssignToUser::where('fsf_id',$fsf_id)
        ->where('user_id',$userId)
        ->update([
            'status' => \Request::input('status'),
            'comment' => \Request::input('comment')
        ]);
        
        return response()->json(['message'=>'Update Status of Fsf Successfully']);
    }

    function updateStatusByTeamLogin(){

        $userId = Auth::id();

        $fsf_id = \Request::input('fsf_id');

        $fsf_Assign_to_users = FunctionalSpecificationForm::where('id',$fsf_id)
        ->where('team_lead_id',$userId)
        ->update([
            'status' => \Request::input('status'),
            'comment' => \Request::input('comment')
        ]);
        
        return response()->json(['message'=>'Update Status of Fsf Successfully']);
    }

    function getFsfAssignToUserByFsfIdAndLogin($fsf_id){
        $userId = Auth::id();
        
        // $fsf_id = \Request::input('fsf_id');
        $fsf_Assign_to_users = FsfAssignToUser::where('user_id',$userId)
        ->where('fsf_id',$fsf_id)
        ->get();

        return response()->json(['fsf_Assign_to_users'=>$fsf_Assign_to_users]);
    }

    function getFsfAssignToteamleadByFsfIdAndLogin($fsf_id){
        $id = Auth::id();
        
        // $fsf_id = \Request::input('fsf_id');
        $fsf_Assign_to_users = FunctionalSpecificationForm::where('team_lead_id',$id)
        ->where('id',$fsf_id)
        ->get();

        return response()->json(['fsf_Assign_to_users'=>$fsf_Assign_to_users]);
    }

    function getFsfFromAssignToteamleadByFsfIdAndLogin($fsf_id){
        
        // $fsf_id = \Request::input('fsf_id');
        $fsf_Assign_to_users = FsfAssignToUser::
        join('users','users.id','=','fsf_assign_to_users.user_id')
        ->where('fsf_id',$fsf_id)
        ->get();

        return response()->json(['fsf_Assign_to_users'=>$fsf_Assign_to_users]);
    }

    function getModules(){
        $Module = Module::
            get();
        return response()->json(['Module'=>$Module]);
    }
}
