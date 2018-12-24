  document.getElementById("submit").addEventListener("click",validation);

    function validation(){
        var check = 0;
        //input
        var fname=document.getElementById("fname").value;
        var lname=document.getElementById("lname").value;
        var uname=document.getElementById("uname").value;
        var email=document.getElementById("email").value;
        var pass=document.getElementById("pass").value;
        var pass1=document.getElementById("pass1").value;
         //check validation of input
        const name = /^[\s]*[a-zA-Z]+[a-zA-Z]*[\s]*$/;
        const user_name = /^[\s]*[a-zA-Z]+[a-zA-Z0-9]*[\s]*$/;
        const email_check=/^[\s]*[a-zA-Z0-9]+(@hotmail.com)[\s]*|[\s]*[a-zA-Z0-9]+(@gmail.com)[\s]*|[\s]*[a-zA-Z0-9]+(@yahoo.com)[\s]*$/;
        const pass_check=/^[\s]*[\w]{8,}[\s]*$/;
        
        if(!name.test(fname)){
            document.getElementById("fn").innerHTML=fname;
             check++;
        }else document.getElementById("fn").innerHTML="";

        if(!name.test(lname)){
            document.getElementById("ln").innerHTML=lname;
            check++;
       }else document.getElementById("ln").innerHTML="";
       if (! user_name.test(uname)){
        document.getElementById("un").innerHTML=uname;
        check++;
       }else document.getElementById("un").innerHTML="";

       if(!email_check.test(email)){
        document.getElementById("em").innerHTML=email;
        check++;
       }else document.getElementById("em").innerHTML="";
        if(!pass_check.test(pass)){
         document.getElementById("pa").innerHTML=pass;
         check++;
        }else document.getElementById("pa").innerHTML="";
        if(pass!=pass1){
        document.getElementById("pa1").innerHTML=pass1;
         check++;
        }else document.getElementById("pa1").innerHTML="";
       if(check>0){
       console.log("false"+check);
        return false;
       }
       else return true;
}   
