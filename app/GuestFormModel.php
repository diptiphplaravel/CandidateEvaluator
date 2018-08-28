<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class GuestFormModel extends Model
{
    //
    public function insertGuestProfileData($request,$user_ip, $user_location)
    {
        //echo'<pre>';print_r($request);die();
        
        DB::table('profile_details')->insert([
            'candidate_name' => $request['name'],
            'candidate_email' => $request['email'],
            'candidate_web_address' => $request['webAddress'],
            'working_preference' => $request['working'],
            'user_ip' => $user_ip,
            'user_location' => $user_location
        ]);
        
        $id = DB::select("SELECT profile_id FROM profile_details ORDER BY profile_id DESC LIMIT 1");
        return $id[0]->profile_id;
    }
    
    public function updateGuestProfileData($profile_id,$attachmentPath,$coverLetterPath)
    {
        return DB::update("UPDATE profile_details SET candidate_cover_letter = '$coverLetterPath', candidate_attachment = '$attachmentPath' WHERE profile_id = '$profile_id'");
    }
    
    public function getAllUploadedProfiles()
    {
        $profile_data = DB::select("select profile_id, candidate_name,candidate_email,candidate_web_address,
            working_preference,profile_created_at from profile_details");
        return $profile_data;
    }
    
    public function getProfileDetails($profile_id)
    {
        $prodile_data = DB::select("select profile_id, candidate_name, candidate_email, candidate_web_address, candidate_cover_letter,
            candidate_attachment, working_preference, profile_created_at, user_location, user_ip 
            from profile_details where profile_id = $profile_id");
        //echo'<pre>';print_r($prodile_data);die();
        $comment_data = DB::select("select profile_id, profile_comments, profile_rating from profile_comment_details where profile_id = $profile_id");
        return array($prodile_data,$comment_data);
    }
    
    public function insertProfileComment($request)
    {
        DB::table('profile_comment_details')->insert([
            'profile_id' => $request['profile_id'],
            'user_id' => Auth::User()->id,
            'profile_rating' => $request['rating'],
            'profile_comments' => $request['comment']            
        ]);
        
        return true;
    }
}
