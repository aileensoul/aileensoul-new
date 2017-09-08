
//validation start
 $(document).ready(function () {
 $.validator.addMethod("lowercase", function(value, element, regexpr) {          
          return regexpr.test(value);
      }, "email Should be in Small Character");
      
      
       $.validator.addMethod("regx2", function(value, element, regexpr) {          
        
           if(!value) 
                  {
                      return true;
                  }
                  else
                  {
                      return regexpr.test(value);
      
                  }
           
      },"special character and space not allow in the beginning");
      
      $.validator.addMethod("regx_digit", function(value, element, regexpr) {          
         
           if(!value) 
                  {
                      return true;
                  }
                  else
                  {
                      
                      return regexpr.test(value);
      
                  }
          
      },"digit is not allow");
      
      $.validator.addMethod("regx1", function(value, element, regexpr) {          
         
           if(!value) 
                  {
                      return true;
                  }
                  else
                  {
                        return regexpr.test(value);
                  }
           
      }, "only space, only number and only special characters are not allow");
      
      
       $("#jobseeker_regform").validate({
      
                 ignore: '*:not([name])',
              
               rules: {
      
                      first_name: {
      
                          required: true,
                          regx2:/^[a-zA-Z0-9-.,']*[0-9a-zA-Z][a-zA-Z]*/,
                           regx_digit:/^([^0-9]*)$/,
                         
                      },
      
                      last_name: {
      
                          required: true,
                          regx2:/^[a-zA-Z0-9-.,']*[0-9a-zA-Z][a-zA-Z]*/,
                           regx_digit:/^([^0-9]*)$/,
                      },
                      
                      cities: {
      
                          required: true,
                      },
      
                      email: {
      
                          required: true,
                          email: true,
                          lowercase: /^[0-9a-z\s\r\n@!#\$\^%&*()+=_\-\[\]\\\';,\.\/\{\}\|\":<>\?]+$/,
                         remote: {
                             url: base_url +"job/check_email",
                             //async is used for double click on submit avoid
                             async:false,
                             type: "post",
                            
                         },
                      },
      
                      fresher: {
      
                          required: true,
      
                      },
                      
                       job_title: {
      
                          required: "#test2:checked",
                           regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                     
                       },
                       
                       industry: {
      
                          required: true,
                       },
                       
                       cities: {
      
                          required: true,
                           regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                       },
                       
                       skills: {
      
                          required: true,
                           regx1:/^[-@./#&+,\w\s]*[a-zA-Z][a-zA-Z0-9]*/,
                                 
                      },
                     
                  },
      
                  messages: {
      
                      first_name: {
      
                          required: "first name Is Required.",
      
                      },
      
                      last_name: {
      
                          required: "last name Is Required.",
      
                      },
      
                      email: {
      
                          required: "email Address Is Required.",
                          email: "please Enter Valid Email Id.",
                          remote: "email already exists"
                      },
                     
                      fresher: {
      
                          required: "fresher Is Required.",
      
                      },
                      
                      industry: {
      
                          required: "industry Is Required.",
      
                      },
                      
                      cities: {
      
                          required: "city Is Required.",
      
                      },
                      
                      job_title: {
      
                          required: "job title Is Required.",
      
                      },
                      
                       skills: {
      
                           required: "skill Is Required.",
      
                      }
      
                  },
      
              });
  });

