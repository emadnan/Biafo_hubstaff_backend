<?php

namespace App\Http\Controllers;

use App\Models\ChangeRequestForm;
use App\Models\ChangeRequestSummary;
use Illuminate\Http\Request;

class ChangeRequestFormcontroller extends Controller
{
    
    
    function addChangeRequestForm()
    {
        $CRForm = new ChangeRequestForm();
        $CRForm->project_id = \Request::input('project_id');
        $CRForm->module_id = \Request::input('module_id');
        $CRForm->fsf_id = \Request::input('fsf_id');
        $CRForm->company_id = \Request::input('company_id');
        $CRForm->functional_id = \Request::input('functional_id');
        $CRForm->project_manager = \Request::input('project_manager');
        $CRForm->reference = \Request::input('reference');
        $CRForm->implementation_partner = \Request::input('implementation_partner');
        $CRForm->issuance_date = \Request::input('issuance_date');
        $CRForm->author = \Request::input('author');
        $CRForm->doc_ref_no = \Request::input('doc_ref_no');
    
        $latestCRF = ChangeRequestForm::where('project_id', $CRForm->project_id)
            ->where('module_id', $CRForm->module_id)
            ->where('fsf_id', $CRForm->fsf_id)
            ->orderBy('crf_version_float', 'desc')
            ->first();
    
        if ($latestCRF) {
            $CRForm->crf_version_float = $latestCRF->crf_version_float + 1;
            $CRForm->crf_version = $latestCRF->crf_version;

        } else {

            $existingCRF = ChangeRequestForm::where('project_id', $CRForm->project_id)
                ->where('module_id', $CRForm->module_id)
                ->orderBy('crf_version', 'desc')
                ->first();
    
            if ($existingCRF) {
                $CRForm->crf_version = $existingCRF->crf_version + 1;
            } else {
                
                $CRForm->crf_version = 1;
            }
    
            $CRForm->crf_version_float = 0;
        }
        
        $CRForm->save();

        $CRSummary = new ChangeRequestSummary();
        $CRSummary->crf_id = $CRForm->id;
        $CRSummary->requirement = \Request::input('requirement');
        $CRSummary->required_time_no = \Request::input('required_time_no');
        $CRSummary->required_time_type = \Request::input('required_time_type');
        $CRSummary->functional_resource = \Request::input('functional_resource');
        $CRSummary->Technical_resource = \Request::input('Technical_resource');
        $CRSummary->crf_title = \Request::input('crf_title');
        $CRSummary->type_of_requirement = \Request::input('type_of_requirement');
        $CRSummary->priority = \Request::input('priority');
        $CRSummary->with_in_project_scope = \Request::input('with_in_project_scope');
    
        $CRSummary->save();
    
        return response()->json(['message' => 'Add Change Request Form']);
    }
    


    function updateChangeRequestForm(){

        $id = \Request::input('id');
        $CRForm = ChangeRequestForm::where('id',$id)
        ->update([
            'project_id' => \Request::input('project_id'),
            'module_id' => \Request::input('module_id'),
            'fsf_id' => \Request::input('fsf_id'),
            'company_id' => \Request::input('company_id'),
            'functional_id' => \Request::input('functional_id'),
            'project_manager' => \Request::input('project_manager'),
            'reference' => \Request::input('reference'),
            'issuance_date' => \Request::input('issuance_date'),
            'implementation_partner' => \Request::input('implementation_partner'),
            'author' => \Request::input('author'),
            'doc_ref_no' => \Request::input('doc_ref_no')
        ]);
        
        return response()->json(['message'=>'Update Change Request Form Successfully']);
    }

    function deleteChangeRequestForm(){
        
        $id = \Request::input('id');
        $CRForm = ChangeRequestForm::where('id',$id)->delete();

        return response()->json(['message'=>'Delete Change Request Form Successfully']);
    }

    function getChangeRequestForm(){
        
        $CRForm = ChangeRequestForm::
        with('projectManagerDetails','crsDetails')
        ->get();

        return response()->json(['CRForm'=>$CRForm]);
    }

    function getChangeRequestFormById($id){

        $CRForm = ChangeRequestForm::
        where('id', $id)
        ->with('project_details','module_details','company_details','FSF_details','crsDetails','projectManagerDetails')
        ->get();

        return response()->json(['CRForm'=>$CRForm]);
    }

    function getChangeRequestFormByCompanyId($company_id){

        $CRForm = ChangeRequestForm::
            where('company_id',$company_id)
            ->with('projectManagerDetails')
            ->get();

        return response()->json(['CRForm'=>$CRForm]);
    }

    function getCrfByProjectIdModuleIdAndFsfId($project_id,$module_id,$fsf_id){

        $Crf = ChangeRequestForm::
            where('project_id',$project_id)
            ->where('module_id',$module_id)
            ->where('fsf_id',$fsf_id)
            ->with('FSF_details','projectManagerDetails')
            ->get();

        return response()->json(['Crfs'=>$Crf]);
    }

    function updateStatusAndComment(){

        $id = \Request::input('id');
        $CRForm = ChangeRequestForm::where('id',$id)
        ->update([
            'status' => \Request::input('status'),
            'comment' => \Request::input('comment')
        ]);
        
        return response()->json(['message'=>'Update Status And Comment Successfully']);
    }

    function updateComment(){

        $id = \Request::input('id');
        $CRForm = ChangeRequestForm::where('id',$id)
        ->update([
            'comment' => \Request::input('comment')
        ]);
        
        return response()->json(['message'=>'Update Comment Successfully']);
    }
    
    function updateCrfAndCrs(){

        $id = \Request::input('id');
        $CRForm = ChangeRequestForm::where('id',$id)
        ->update([
            'project_id' => \Request::input('project_id'),
            'module_id' => \Request::input('module_id'),
            'fsf_id' => \Request::input('fsf_id'),
            'company_id' => \Request::input('company_id'),
            'functional_id' => \Request::input('functional_id'),
            'project_manager' => \Request::input('project_manager'),
            'reference' => \Request::input('reference'),
            'issuance_date' => \Request::input('issuance_date'),
            'implementation_partner' => \Request::input('implementation_partner'),
            'author' => \Request::input('author'),
            'doc_ref_no' => \Request::input('doc_ref_no')
        ]);

        $CRSummary = ChangeRequestSummary::where('crf_id',$id)
        ->update([

            'crf_id' => \Request::input('crf_id'),
            'requirement' => \Request::input('requirement'),
            'required_time_no' => \Request::input('required_time_no'),
            'required_time_type' => \Request::input('required_time_type'),
            'functional_resource' => \Request::input('functional_resource'),
            'crf_title' => \Request::input('crf_title'),
            'type_of_requirement' => \Request::input('type_of_requirement'),
            'priority' => \Request::input('priority'),
            'with_in_project_scope' => \Request::input('with_in_project_scope'),
            'Technical_resource' => \Request::input('Technical_resource')
        ]);

        return response()->json(['message'=>'Update CFR And CRS Successfully']);
    }
}