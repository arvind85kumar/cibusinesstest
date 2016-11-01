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
        url: "http://localhost:83/cibusiness/",
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
 });