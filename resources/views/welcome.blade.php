<?php //echo'<pre>';print_r($comment_data);print_R($profile_data);die();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Candidate Evaluator</title>

        <!-- Fonts -->
        	<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
		<!-- Styles -->
    		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
    		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Styles -->
        <style>
        
            .rating {
                float:left;
                width:180px;
            }
            .rating span { float:right; position:relative; }
            .rating span input {
                position:absolute;
                top:0px;
                left:0px;
                opacity:0;
            }
            .rating span label {
                display:inline-block;
                width:30px;
                height:30px;
                text-align:center;
                color:#FFF;
                background:#ccc;
                font-size:30px;
                margin-right:2px;
                line-height:30px;
                border-radius:50%;
                -webkit-border-radius:50%;
            }
            .rating span:hover ~ span label,
            .rating span:hover label,
            .rating span.checked label,
            .rating span.checked ~ span label {
                background:#F90;
                color:#FFF;
            }
            
            .ratingChecked{
                background:#F90;
                color:#FFF;
            }

            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif
			<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">First Form</div>

                <div class="panel-body">
                
                <div class="col-md-12 margin-bottom20">
                     <p class="required">All the fields are required.</p>
                </div>
                
                <div class="col-md-12 ">      
                     @if(Session::has('message'))
    				<div class="alert alert-success alert-dismissable fade in">
        			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        			{{ Session::get('message') }}
      				</div>
    				@endif
    				
    				 @if($errors->any())
    					<div class="alert alert-danger" id="error-box">
    					    Please ensure all required fields are completed.
    					</div>
    				@endif
    			</div>
                             
                    <form class="form-horizontal" method="POST" action="{{ url('/guestFormSubmit') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        @if(isset($editParam))
                        	<input type="hidden" name="rating" id="rating" value="">
                        	<input type="hidden" name="profile_id" id="profile_id" value="<?php echo $profile_data[0]->profile_id; ?>">
                        @endif
						{{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">                           
                                <input id="name" type="text" class="form-control" name="name" value="<?php if(isset($editParam))echo $profile_data[0]->candidate_name;else echo'';?>"  autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php if(isset($editParam))echo $profile_data[0]->candidate_email;else echo'';?>" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Web Address</label>

                            <div class="col-md-6">
                                <input id="webAddress" type="text" class="form-control" name="webAddress" value="<?php if(isset($editParam))echo $profile_data[0]->candidate_web_address;else echo'';?>" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Cover Letter</label>

                            <div class="col-md-6">
                            @if(isset($editParam))
                            	<a href="<?php echo env('APP_URL').$profile_data[0]->candidate_cover_letter; ?>" target="_blank"><button type="button" class="btn btn-primary">View</button></a>                            	                           
                            @else
                                <input id="coverLetter" type="file" class="form-control" name="coverLetter" value="" >
                            @endif   
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Attachment</label>

                            <div class="col-md-6">
                            @if(isset($editParam))
                            	<a href="<?php echo env('APP_URL').$profile_data[0]->candidate_attachment; ?>" target="_blank"><button type="button" class="btn btn-primary">View</button></a>                                
                            @else
                            	<input id="attachment" type="file" class="form-control" name="attachment" value="" >
                            @endif     
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Do you like working ?</label>

                            <div class="col-md-6">
                                
                          <label class="radio-inline"> 								                                             
                              <input  name="working" id="working_yes" value="1" checked type="radio"> Yes
                          </label>  
                        
                           <label class="radio-inline"> 
                             <input name="working" id="working_no" value="0" type="radio"> No
                          </label>  
								                                   
                            </div>
                        </div>
                         @if(isset($editParam))  
                         @if(isset($comment_data))
                        	<?php for($t=0;$t<sizeof($comment_data);$t++) { ?>
                        		<div class="form-group">
                                	<label class="col-md-4 control-label">Rating</label>
                                	<div class="col-md-6">
                                		<label> <?php echo $comment_data[$t]->profile_rating;?></label>
                            		</div>
        						</div>
        						
        						<div class="form-group">
                                	<label class="col-md-4 control-label">Comment</label>
        
                                    <div class="col-md-6">
                                        <textarea rows="3" cols="45" name="comment" id="comment" disabled><?php echo $comment_data[$t]->profile_comments;?></textarea>
                                    </div>
                                </div>
                        	<?php }?>
                        @endif
                                              
                        <div class="form-group">
                        	<label class="col-md-4 control-label">Rating</label>
                        	<div class="rating">
                                <span><input type="radio" name="rating" id="str5" value="5"><label for="str5"></label></span>
                                <span><input type="radio" name="rating" id="str4" value="4"><label for="str4"></label></span>
                                <span><input type="radio" name="rating" id="str3" value="3"><label for="str3"></label></span>
                                <span><input type="radio" name="rating" id="str2" value="2"><label for="str2"></label></span>
                                <span><input type="radio" name="rating" id="str1" value="1"><label for="str1"></label></span>
                            </div>
						</div>
						
						<div class="form-group">
                        	<label class="col-md-4 control-label">Comment</label>

                            <div class="col-md-6">
                                <textarea rows="3" cols="45" name="comment" id="comment"></textarea>
                            </div>
                        </div>
                        
						@endif
						
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">                                
                                @if(isset($editParam))
                                	<button class="btn btn-primary" type="submit" onclick='this.form.action="{{url('updateProfileDetails')}}";'> Update</button>
                                	<a class="btn btn-primary" href="{{url('viewProfileList')}}">Cancel</a>
                                @else
                                	<button type="submit" class="btn btn-primary"> Submit </button>	
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
            
        </div>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        // Check Radio-box
        $(".rating input:radio").attr("checked", false);

        $('.rating input').click(function () {
            $(".rating span").removeClass('checked');
            $(this).parent().addClass('checked');
        });

        $('input:radio').change(
          function(){
            var userRating = this.value;
            //alert(userRating);
            $("#rating").val(userRating);
        }); 
    });
	
  <?php  if(isset($editParam))  {
        if($profile_data[0]->working_preference == 1) 
    { ?>
        $("#working_yes").prop("checked", true);
        $("#working_no").prop("checked", false);
   <?php  }
    else
    { ?>
        $("#working_no").prop("checked", true);
        $("#working_yes").prop("checked", false);
  <?php  } }?>
    </script>
</html>