  <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>js/jquery-ui.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>css/jquery-ui.css">
  <script src="<?php echo base_url();?>js/jquery.validate.min.js"></script>
  <script src="<?php echo base_url();?>js/additional-methods.js"></script>
  <script type="text/javascript">
        $(document).ready(function () {

           $( "#datepicker" ).datepicker({changeYear: true,changeMonth: true, dateFormat: 'dd-mm-yy',maxDate:-365});
        $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param) 
        });
     $("#edit-profile").validate({
        // Specify the validation rules
        rules: {
            first_name: "required",
            last_name: "required",
            email: {
                required: true,
                email: true
            },
            city: {
                required: true               
            },
            gender: {
                required: true
              
            },
            mobile:{
                required: true              
               
            } 
            
        },
        
        // Specify the validation error messages
        messages: {
            first_name: "Please enter your first name",
            last_name: "Please enter your last name",
            city: {
                required: "Please enter city name"
                
            },
            gender: {
                required: "Please select gender"
               
            },
            email: "Please enter a valid email address",
            mobile:{
                required:"Please enter contact number",               
               
            }
        },
        submitHandler: function(form) {
            //form.submit();
            $.ajax({
        type: $(form).attr('method'),
        url: '<?php echo base_url();?>edit_profile',
        data: $(form).serialize(),
        dataType : 'json'
    })
    .done(function (response) {

     $('#myModal').modal('show');
        if (response.success == 'success') {               
            alert('success');                       
        } else {
            alert('fail');
        }
    });
    return false; 

        }
    });
/*****Change Password****/
$("#change_password").validate({
        // Specify the validation rules
        rules: {
            current_password: {
              required:true,
              remote: {
                type: 'post',
                url: 'check_existpassword'
              }
            },
            new_password: {
              required:true,
                minlength:5
                } ,          
            confirm_password: {
                required: true,
                equalTo : '[name="new_password"]'               
            }
            
        },
        
        // Specify the validation error messages
        messages: {
            current_password:{
              required:"Please enter current password",
              remote:"Please enter correct password"
            } ,
            new_password: {
              required:"Please enter new password",
              minlength:"Please enter atleast 5 digit password"
            },
            confirm_password: {
                required: "Please confirm password",
                equalTo : "Please enter same password as you enter above"
                
            }
        },
        submitHandler: function(form) {
            $.ajax({
        type: $(form).attr('method'),
        url: '<?php echo base_url();?>change_password',
        data: $("#change_password").serialize(),
        dataType : 'json'
    })
    .done(function (response) { 
    $('#change_password').trigger("reset"); 
         
       $('#changePassword').modal('show');
        
    });
        }
      });



 });
 
    </script>
  <div class="container">
  <ol class="breadcrumb">
			<li><a href="<?php echo base_url(); ?>">Home</a></li>
			<li class="active">My Account</li>
		</ol> 
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
    <li><a data-toggle="tab" href="#menu1">Edit Profile</a></li>
    <li><a data-toggle="tab" href="#menu3">Change Password</a></li>
    <li><a data-toggle="tab" href="#menu4">Account History</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>HOME</h3>
      <div class="row">
        <div class="col-sm-1 col-md-1">
            <img src="http://thetransformedmale.files.wordpress.com/2011/06/bruce-wayne-armani.jpg"
            alt="" class="img-rounded img-responsive" />
        </div>
        <div class="col-sm-6 col-md-6">
            <blockquote>
                <p>Bruce Wayne</p> <small><cite title="Source Title">Gotham, United Kingdom  <i class="glyphicon glyphicon-map-marker"></i></cite></small>
            </blockquote>
            <p> <i class="glyphicon glyphicon-envelope"></i> masterwayne@batman.com
                <br
                /> <i class="glyphicon glyphicon-globe"></i> www.bootsnipp.com
                <br /> <i class="glyphicon glyphicon-gift"></i> January 30, 1974</p>
        </div>
        
        
    </div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>User Profile</h3>
      <div class="row">
     <form class="form-horizontal edit-profile " id="edit-profile" method="post">
            <fieldset>
                <!-- Address form -->       
               
         <input type="hidden" name="user_id" value="<?php echo $loggedUser->id; ?>">
                <!-- first-name input-->
                <div class="control-group">
                    <label class="control-label">First Name</label><em class="required">*</em>
                    <div class="controls">
                        <input id="first-name" name="first_name" type="text" placeholder="First name"
                        class="input-xlarge" value="<?php echo $loggedUser->first_name; ?>">
                        <p class="help-block"></p>
                    </div>
                </div>
                
                <!-- last-name input-->
                <div class="control-group">
                    <label class="control-label">Last Name</label><em class="required">*</em>
                    <div class="controls">
                        <input id="last-name" name="last_name" type="text" placeholder="Last name"
                        class="input-xlarge" value="<?php echo $loggedUser->last_name; ?>">
                        <p class="help-block"></p>
                    </div>
                </div>
                
                <!-- Select Basic -->
          <div class="control-group">
            <label class="control-label" for="selectbasic">Gender</label><em class="required">*</em>
            <div class="controls">
              <select id="selectbasic" name="gender" class="input-xlarge">
                <option>Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
              </select>
            </div>
          </div>

                <div class="control-group">
                                    <label class="control-label">Date of Birth</label>
                    <div class="controls">                   
          <input type="text" name="dob" readonly="" id="datepicker" value="" size="16" class="span2" value="<?php echo $loggedUser->date_of_birth; ?>">
        <span class="add-on"><i class="icon-calendar"></i></span>
                </div>
            </div>
               
                
                <!-- city input-->
                <div class="control-group">
                    <label class="control-label">Mobile No.</label><em class="required">*</em>
                    <div class="controls">
                        <input id="mobile" name="mobile" type="text" placeholder="Mobile no." class="input-xlarge" value="<?php echo $loggedUser->contact_number; ?>">
                        <p class="help-block"></p>
                    </div>
                </div>
                
                <!-- city input-->
                <div class="control-group">
                    <label class="control-label">City / Town</label><em class="required">*</em>
                    <div class="controls">
                        <input id="city" name="city" type="text" placeholder="City" class="input-xlarge" value="<?php echo $loggedUser->city; ?>">
                        <p class="help-block"></p>
                    </div>
                </div>
                <!-- country select -->
                <div class="control-group">
                    <label class="control-label">Country</label>
                    <div class="controls">
                        <select id="country" name="country" class="input-xlarge">
                            <option value="" selected="selected">(please select a country)</option>
                            <option value="AF">Afghanistan</option>
                            <option value="AL">Albania</option>
                            <option value="DZ">Algeria</option>
                            <option value="AS">American Samoa</option>
                            <option value="AD">Andorra</option>
                            <option value="AO">Angola</option>
                            <option value="AI">Anguilla</option>
                            <option value="AQ">Antarctica</option>
                            <option value="AG">Antigua and Barbuda</option>
                            <option value="AR">Argentina</option>
                            <option value="AM">Armenia</option>
                            <option value="AW">Aruba</option>
                            <option value="AU">Australia</option>
                            <option value="AT">Austria</option>
                            <option value="AZ">Azerbaijan</option>
                            <option value="BS">Bahamas</option>
                            <option value="BH">Bahrain</option>
                            <option value="BD">Bangladesh</option>
                            <option value="BB">Barbados</option>
                            <option value="BY">Belarus</option>
                            <option value="BE">Belgium</option>
                            <option value="BZ">Belize</option>
                            <option value="BJ">Benin</option>
                            <option value="BM">Bermuda</option>
                            <option value="BT">Bhutan</option>
                            <option value="BO">Bolivia</option>
                            <option value="BA">Bosnia and Herzegowina</option>
                            <option value="BW">Botswana</option>
                            <option value="BV">Bouvet Island</option>
                            <option value="BR">Brazil</option>
                            <option value="IO">British Indian Ocean Territory</option>
                            <option value="BN">Brunei Darussalam</option>
                            <option value="BG">Bulgaria</option>
                            <option value="BF">Burkina Faso</option>
                            <option value="BI">Burundi</option>
                            <option value="KH">Cambodia</option>
                            <option value="CM">Cameroon</option>
                            <option value="CA">Canada</option>
                            <option value="CV">Cape Verde</option>
                            <option value="KY">Cayman Islands</option>
                            <option value="CF">Central African Republic</option>
                            <option value="TD">Chad</option>
                            <option value="CL">Chile</option>
                            <option value="CN">China</option>
                            <option value="CX">Christmas Island</option>
                            <option value="CC">Cocos (Keeling) Islands</option>
                            <option value="CO">Colombia</option>
                            <option value="KM">Comoros</option>
                            <option value="CG">Congo</option>
                            <option value="CD">Congo, the Democratic Republic of the</option>
                            <option value="CK">Cook Islands</option>
                            <option value="CR">Costa Rica</option>
                            <option value="CI">Cote d'Ivoire</option>
                            <option value="HR">Croatia (Hrvatska)</option>
                            <option value="CU">Cuba</option>
                            <option value="CY">Cyprus</option>
                            <option value="CZ">Czech Republic</option>
                            <option value="DK">Denmark</option>
                            <option value="DJ">Djibouti</option>
                            <option value="DM">Dominica</option>
                            <option value="DO">Dominican Republic</option>
                            <option value="TP">East Timor</option>
                            <option value="EC">Ecuador</option>
                            <option value="EG">Egypt</option>
                            <option value="SV">El Salvador</option>
                            <option value="GQ">Equatorial Guinea</option>
                            <option value="ER">Eritrea</option>
                            <option value="EE">Estonia</option>
                            <option value="ET">Ethiopia</option>
                            <option value="FK">Falkland Islands (Malvinas)</option>
                            <option value="FO">Faroe Islands</option>
                            <option value="FJ">Fiji</option>
                            <option value="FI">Finland</option>
                            <option value="FR">France</option>
                            <option value="FX">France, Metropolitan</option>
                            <option value="GF">French Guiana</option>
                            <option value="PF">French Polynesia</option>
                            <option value="TF">French Southern Territories</option>
                            <option value="GA">Gabon</option>
                            <option value="GM">Gambia</option>
                            <option value="GE">Georgia</option>
                            <option value="DE">Germany</option>
                            <option value="GH">Ghana</option>
                            <option value="GI">Gibraltar</option>
                            <option value="GR">Greece</option>
                            <option value="GL">Greenland</option>
                            <option value="GD">Grenada</option>
                            <option value="GP">Guadeloupe</option>
                            <option value="GU">Guam</option>
                            <option value="GT">Guatemala</option>
                            <option value="GN">Guinea</option>
                            <option value="GW">Guinea-Bissau</option>
                            <option value="GY">Guyana</option>
                            <option value="HT">Haiti</option>
                            <option value="HM">Heard and Mc Donald Islands</option>
                            <option value="VA">Holy See (Vatican City State)</option>
                            <option value="HN">Honduras</option>
                            <option value="HK">Hong Kong</option>
                            <option value="HU">Hungary</option>
                            <option value="IS">Iceland</option>
                            <option value="IN">India</option>
                            <option value="ID">Indonesia</option>
                            <option value="IR">Iran (Islamic Republic of)</option>
                            <option value="IQ">Iraq</option>
                            <option value="IE">Ireland</option>
                            <option value="IL">Israel</option>
                            <option value="IT">Italy</option>
                            <option value="JM">Jamaica</option>
                            <option value="JP">Japan</option>
                            <option value="JO">Jordan</option>
                            <option value="KZ">Kazakhstan</option>
                            <option value="KE">Kenya</option>
                            <option value="KI">Kiribati</option>
                            <option value="KP">Korea, Democratic People's Republic of</option>
                            <option value="KR">Korea, Republic of</option>
                            <option value="KW">Kuwait</option>
                            <option value="KG">Kyrgyzstan</option>
                            <option value="LA">Lao People's Democratic Republic</option>
                            <option value="LV">Latvia</option>
                            <option value="LB">Lebanon</option>
                            <option value="LS">Lesotho</option>
                            <option value="LR">Liberia</option>
                            <option value="LY">Libyan Arab Jamahiriya</option>
                            <option value="LI">Liechtenstein</option>
                            <option value="LT">Lithuania</option>
                            <option value="LU">Luxembourg</option>
                            <option value="MO">Macau</option>
                            <option value="MK">Macedonia, The Former Yugoslav Republic of</option>
                            <option value="MG">Madagascar</option>
                            <option value="MW">Malawi</option>
                            <option value="MY">Malaysia</option>
                            <option value="MV">Maldives</option>
                            <option value="ML">Mali</option>
                            <option value="MT">Malta</option>
                            <option value="MH">Marshall Islands</option>
                            <option value="MQ">Martinique</option>
                            <option value="MR">Mauritania</option>
                            <option value="MU">Mauritius</option>
                            <option value="YT">Mayotte</option>
                            <option value="MX">Mexico</option>
                            <option value="FM">Micronesia, Federated States of</option>
                            <option value="MD">Moldova, Republic of</option>
                            <option value="MC">Monaco</option>
                            <option value="MN">Mongolia</option>
                            <option value="MS">Montserrat</option>
                            <option value="MA">Morocco</option>
                            <option value="MZ">Mozambique</option>
                            <option value="MM">Myanmar</option>
                            <option value="NA">Namibia</option>
                            <option value="NR">Nauru</option>
                            <option value="NP">Nepal</option>
                            <option value="NL">Netherlands</option>
                            <option value="AN">Netherlands Antilles</option>
                            <option value="NC">New Caledonia</option>
                            <option value="NZ">New Zealand</option>
                            <option value="NI">Nicaragua</option>
                            <option value="NE">Niger</option>
                            <option value="NG">Nigeria</option>
                            <option value="NU">Niue</option>
                            <option value="NF">Norfolk Island</option>
                            <option value="MP">Northern Mariana Islands</option>
                            <option value="NO">Norway</option>
                            <option value="OM">Oman</option>
                            <option value="PK">Pakistan</option>
                            <option value="PW">Palau</option>
                            <option value="PA">Panama</option>
                            <option value="PG">Papua New Guinea</option>
                            <option value="PY">Paraguay</option>
                            <option value="PE">Peru</option>
                            <option value="PH">Philippines</option>
                            <option value="PN">Pitcairn</option>
                            <option value="PL">Poland</option>
                            <option value="PT">Portugal</option>
                            <option value="PR">Puerto Rico</option>
                            <option value="QA">Qatar</option>
                            <option value="RE">Reunion</option>
                            <option value="RO">Romania</option>
                            <option value="RU">Russian Federation</option>
                            <option value="RW">Rwanda</option>
                            <option value="KN">Saint Kitts and Nevis</option>
                            <option value="LC">Saint LUCIA</option>
                            <option value="VC">Saint Vincent and the Grenadines</option>
                            <option value="WS">Samoa</option>
                            <option value="SM">San Marino</option>
                            <option value="ST">Sao Tome and Principe</option>
                            <option value="SA">Saudi Arabia</option>
                            <option value="SN">Senegal</option>
                            <option value="SC">Seychelles</option>
                            <option value="SL">Sierra Leone</option>
                            <option value="SG">Singapore</option>
                            <option value="SK">Slovakia (Slovak Republic)</option>
                            <option value="SI">Slovenia</option>
                            <option value="SB">Solomon Islands</option>
                            <option value="SO">Somalia</option>
                            <option value="ZA">South Africa</option>
                            <option value="GS">South Georgia and the South Sandwich Islands</option>
                            <option value="ES">Spain</option>
                            <option value="LK">Sri Lanka</option>
                            <option value="SH">St. Helena</option>
                            <option value="PM">St. Pierre and Miquelon</option>
                            <option value="SD">Sudan</option>
                            <option value="SR">Suriname</option>
                            <option value="SJ">Svalbard and Jan Mayen Islands</option>
                            <option value="SZ">Swaziland</option>
                            <option value="SE">Sweden</option>
                            <option value="CH">Switzerland</option>
                            <option value="SY">Syrian Arab Republic</option>
                            <option value="TW">Taiwan, Province of China</option>
                            <option value="TJ">Tajikistan</option>
                            <option value="TZ">Tanzania, United Republic of</option>
                            <option value="TH">Thailand</option>
                            <option value="TG">Togo</option>
                            <option value="TK">Tokelau</option>
                            <option value="TO">Tonga</option>
                            <option value="TT">Trinidad and Tobago</option>
                            <option value="TN">Tunisia</option>
                            <option value="TR">Turkey</option>
                            <option value="TM">Turkmenistan</option>
                            <option value="TC">Turks and Caicos Islands</option>
                            <option value="TV">Tuvalu</option>
                            <option value="UG">Uganda</option>
                            <option value="UA">Ukraine</option>
                            <option value="AE">United Arab Emirates</option>
                            <option value="GB">United Kingdom</option>
                            <option value="US">United States</option>
                            <option value="UM">United States Minor Outlying Islands</option>
                            <option value="UY">Uruguay</option>
                            <option value="UZ">Uzbekistan</option>
                            <option value="VU">Vanuatu</option>
                            <option value="VE">Venezuela</option>
                            <option value="VN">Viet Nam</option>
                            <option value="VG">Virgin Islands (British)</option>
                            <option value="VI">Virgin Islands (U.S.)</option>
                            <option value="WF">Wallis and Futuna Islands</option>
                            <option value="EH">Western Sahara</option>
                            <option value="YE">Yemen</option>
                            <option value="YU">Yugoslavia</option>
                            <option value="ZM">Zambia</option>
                            <option value="ZW">Zimbabwe</option>
                        </select>
                    </div>
                </div>
                <div class="row">                  
                  <div class="col-lg-12 text-right">
                    <button class="btn btn-action login edit-submit" type="submit">Edit Profile</button>
                  </div>
                </div>
            </fieldset>
        </form>
  </div>
    </div>
    <div id="menu3" class="tab-pane fade">
      <div class="row">
    
      <!-- Article main content -->
      <article class="col-xs-12 maincontent">       
        
        <div class="col-md-12 ">
          <div class="panel panel-default">
            <div class="panel-body">
              <h3 class="thin text-center">Change your password</h3>
              <p class="text-center text-muted">Lorem ipsum dolor sit amet, <a href="<?php echo base_url(); ?>register">Register</a> adipisicing elit. Quo nulla quibusdam cum doloremque incidunt nemo sunt a tenetur omnis odio. </p>
              <hr>
              
              <form method="post" action="" id="change_password" method="post">
               <input type="hidden" name="user_id" value="<?php echo $loggedUser->id; ?>">
                <div class="top-margin">
                  <label>Current Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" name="current_password">
                </div>
                <div class="top-margin">
                  <label>Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" name="new_password">
                </div>
                <div class="top-margin">
                  <label>Confirm New Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" name="confirm_password">
                </div>

                <hr>

                <div class="row">
                  <div class="col-lg-6">
                    <b><a href="" class="forgot">Forgot password?</a></b>
                  </div>
                  <div class="col-lg-6 text-right">
                    <button class="btn btn-action login" type="submit">Change Password</button>
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>
        
      </article>
      <!-- /Article -->

    </div>
    </div>
    <div id="menu4" class="tab-pane fade">
      <h3>Menu 4</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
  <!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Profile Edit</h4>
      </div>
      <div class="modal-body">
        <p>Your profile has been updated successfully.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="changePassword" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <div class="modal-body">
        <p>Your profile password has been updated successfully.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


