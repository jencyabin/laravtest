
$(document).on('click', '#deleteuser', function(event) {
     $("#deleteModel").modal('show');
     $('#delete_form').attr('action', APP_URL+'/delete/'+event.target.value);
  }); 

  $(document).ready(function(){ 
    if($("#addUser_form").length > 0) { 
      $("#addUser_form").validate({    

        rules:
        {
          email: {
            required:true,
            email:true,
            remote:{
              url:APP_URL+"/user/checkEmail",
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



    if($("#editUser_form").length > 0) { 
      var user_id   = $('#userid').val(); 

      $("#editUser_form").validate({    

        rules:
        {
          email: {
            required:true,
            email:true,
            remote:{
              url:APP_URL+"/user/checkEmail",
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

  
  $.validator.addMethod("pwcheck",
  function(value, element) {
    return /^.*(?=.{8,30}$)(?=.*\d)(?=.*[a-z])(?=.*[@#$%&]).*$/ //(?=.*[A-Z])
    .test(value);
},"please enter strong password");
        



