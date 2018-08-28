<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GuestFormModel;
use Session;

class GuestFormController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');       
        $this->guestModelObject = new GuestFormModel();
    }
    
    public function submitGuestFormData(Request $request)
    {
        //echo'<pre>';print_R($request->all());die();
        $user_ip= \Request::ip();
        $user_location = \Location::get($user_ip);  
        
        $this->validate($request, [       
            'name' => 'required|regex:/(^[A-Za-z ]+$)+/|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'webAddress' => 'required|string',
            'coverLetter' => 'required',
            'attachment' => 'required',
        ]);
        
        $profile_id = $this->guestModelObject->insertGuestProfileData($request->except(['_token']), $user_ip, $user_location->countryName);
        
        $coverLetterPath ='';
        $attachmentPath = '';
        if ($request->hasFile('coverLetter'))
        {
            if ($request->file('coverLetter')->isValid())
            {
                $file = $request->file('coverLetter');
                $extension = $file->getClientOriginalExtension();
                mkdir('CandidateDocuments/'.$profile_id, 0777, true);
                $dir = 'CandidateDocuments/'.$profile_id;
                $filename = $profile_id.'_CoverLetter-'.date('dmy').'.'.$extension;
        
                $coverLetterPath = $dir.'/'.$filename;          
                $request->file('coverLetter')->move($dir, $filename);
            }
        }
        
        if ($request->hasFile('attachment'))
        {
            if ($request->file('attachment')->isValid())
            {
                $file = $request->file('attachment');
                $extension = $file->getClientOriginalExtension();
                
                if (!file_exists('CandidateDocuments/'.$profile_id)) {
                    mkdir('CandidateDocuments/'.$profile_id, 0777, true);
                }
                $dir = 'CandidateDocuments/'.$profile_id;
                $filename = $profile_id.'_Attachment-'.date('dmy').'.'.$extension;
        
                $attachmentPath = $dir.'/'.$filename;
                $request->file('attachment')->move(public_path($dir), $filename);
            }
        }
        
        $this->guestModelObject->updateGuestProfileData($profile_id,$attachmentPath,$coverLetterPath);
        
        Session::flash('message','Profile Details Inserted Successfully..!');
        return view('welcome');
    }
    
    public function viewProfileList()
    {
        $profile_data = $this->guestModelObject->getAllUploadedProfiles();
        return view('viewProfileList',['profile_data'=>$profile_data]);
    }
    
    public function editProfileDetail($profile_id,$editParam)
    {
        list($profile_data,$comment_data) = $this->guestModelObject->getProfileDetails($profile_id);
        return view('welcome',['profile_data'=>$profile_data,'editParam'=>$editParam,'comment_data'=>$comment_data]);
    }
    
    public function updateProfileDetails(Request $request)
    {
        //echo'<pre>';print_R($request->all());die();
        $this->guestModelObject->insertProfileComment($request->except(['_token']));
        return redirect()->action('GuestFormController@viewProfileList');
    }
}
