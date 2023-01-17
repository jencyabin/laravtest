
$(document).on('click', '#deleteuser', function(event) { //display confirmation box before deleting user
     $("#deleteModel").modal('show');
     $('#delete_form').attr('action', APP_URL+'/delete/'+event.target.value);
  }); 

  $(document).ready(function(){  // add user validation
    if($("#addUser_form").length > 0) { 
      $("#addUser_form").validate({   
        rules:
        {
          email: {
            required:true,
            email:true,
            remote:{
              url:APP_URL+"/user/checkEmail", //checking email existance
              type:"post",
              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              dataFilter: function (data) {
                  var json = JSON.parse(data);
                  if (json.msg == "true") {
                      return "\"" + "Email address already in use" + "\"";
                  } else {
                      return 'true';
                  }
              }
            }
          }, 
           password: {
            required:true,
            pwcheck:true,
            //minlength:8,
           // maxlength:30,
            //alphanumeric: true,
          }, 
          confirmpassword:{
            required:true,
            equalTo:"#password",
          },
          first_name:{
            required: true,
          },
          last_name:{
            required: true,
          },
          gender: {
            required: true,
          },          
          country:{
            required: true,
        },

        },
        messages: {
          email: {
            required: "Please Enter Email",
            remote: "Email address already in use!"
          },
          password: {
            required: "Please Enter Password",
          },
          confirmpassword: {
            required: "Please Enter Confirm Password Field",
          },
          first_name: {
            required: "Please enter First Name",
          },
          last_name: {
            required: "Please enter Last Name",
          },
          gender: {
            required: "Please select Gender",
          },
          country: {
            required: "Please select Country",
          },
        }
    })
    }

    if($("#editUser_form").length > 0) {  // edit user form validation
      var user_id   = $('#userid').val(); 
      $("#editUser_form").validate({   
        rules:
        {
          email: {
            required:true,
            email:true,
            remote:{
              url:APP_URL+"/user/checkEmail", // checking email existance
              type:"post",
              data:{'user_id':user_id},

              headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
              dataFilter: function (data) {
                  var json = JSON.parse(data);
                  if (json.msg == "true") {
                      return "\"" + "Email address already in use" + "\"";
                  } else {
                      return 'true';
                  }
              }
            }
          }, 
           password: {
            required:true,
            pwcheck:true,
            //minlength:8,
           // maxlength:30,
            //alphanumeric: true,
          }, 
          confirmpassword:{
            required:true,
            equalTo:"#password",
          },
          first_name:{
            required: true,
          },
          last_name:{
            required: true,
          },
          gender: {
            required: true,
          },          
          country:{
            required: true,
        },

        },
        messages: {
          email: {
            required: "Please Enter Email",
            remote: "Email address already in use!"
          },
          password: {
            required: "Please Enter Password",
          },
          confirmpassword: {
            required: "Please Enter Confirm Password Field",
          },
          first_name: {
            required: "Please enter First Name",
          },
          last_name: {
            required: "Please enter Last Name",
          },
          gender: {
            required: "Please select Gender",
          },
          country: {
            required: "Please select Country",
          },
        }
    })
    }
  })
  
$.validator.addMethod("pwcheck",        //checking password strength
  function(value, element) {
    return /^.*(?=.{8,30}$)(?=.*\d)(?=.*[a-z])(?=.*[@#$%&]).*$/ //(?=.*[A-Z])
    .test(value);
},"please enter strong password");

$(document).ready(function() {            // enable & disbale submit button on clicking on terms and conditions
    $('#termconditions').click(function() {
      if ($(this).is(':checked')) {
        $('#submit').removeAttr('disabled');
      } else {
        $('#submit').attr('disabled', 'disabled');
      }
  });
});