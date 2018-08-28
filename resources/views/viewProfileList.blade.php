<!DOCTYPE html>
<html lang="en">
<?php
//echo'<pre>';print_r($profile_data);die();
?>


<head>

  <title>View Profile List</title>
  <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE; chrome=1" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="refresh" content="900">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Talentserv">
  <link rel="icon"  type="image/png"  href="images/core-favicon.png">
        
  <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />	  
</head>



<body class="sticky-header">

<section>



<!-- main content start-->
<div class="main-content">



       <!--body wrapper start-->
        <div class="wrapper">
           
            <div class="row">
                <div class="col-md-12" style="margin-bottom:20px;">
	               <div class="page-heading">
			          <h3 style="margin: 0;"> View Profile List </h3>
			       </div>
		        
                </div>
              
                <div class="col-md-12">
                    
                      <section class="panel">
                        <div class="panel-body">

                             
                              <div class="col-md-12">
	                                  <table class="display" id="example" width="100%">
				                          <thead>
					                        <tr>
					                            <th>Name</th>
					                            <th>Email</th>
					                            <th>Web Address</th>
					                            <th>Working Preference</th>					                            					                            
					                            <th>Created Date</th>					                            
					                            <th>Action</th>
					                           
					                        </tr>
					                      </thead>
					                      <tbody>
					                      	@foreach($profile_data as $profile)					                      	
					                      	<tr>
					                           <td>{{$profile->candidate_name}}</td>					                           					                           					                          
					                           <td>{{$profile->candidate_email}}</td>
					                           <td>{{$profile->candidate_web_address}}</td>
					                           <?php if($profile->working_preference == 1)
					                                       $preference = 'Yes';
					                                  else
					                                      $preference = 'No';
					                               ?>
					                           <td><?php echo $preference;?></td>					                           					                           					                           	                           					                           
					                           <td><span style="display: none">{{$profile->profile_created_at}}</span>{{date('d-m-Y', strtotime($profile->profile_created_at))}}</td>
					                           <td><a href="editProfileDetail/{{$profile->profile_id}}/editprofile" class="btn btn-primary btn-sm">View</a></td>					                           				                            
					                        </tr>				                      					                  
				                       		 @endforeach
					                      </tbody>
					                      
					                      
				                    </table>
			                    
                             </div>
                             
                        </div>
                        
                     </section>
                        
                        
                        
              </div>
                
          </div>
         <!--Row Ends-->
            
     </div>
    <!--body wrapper ends-->
 
     
</div>
<!-- main content Ends-->

</section>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


<script>
$(document).ready(function() {
	
    $('#example').DataTable( {
    	"processing": true,
        "serverSide": true,
    } );
} );

</script>

</body>

</html>