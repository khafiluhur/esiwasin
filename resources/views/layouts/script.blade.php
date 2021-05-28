<script src="{{asset('/js/oneui.core.min.js')}}"></script>
<script src="{{asset('/js/oneui.app.min.js')}}"></script>
<script>
    $("document").ready(function(){
    setTimeout(function(){
       $("div.alert").remove();
    }, 3000 ); // 5 secs

    });
</script>

<script>
var down = document.getElementById("GFG_DOWN"); 
                    
function GFG_Fun() { 
// Create a form synamically 
var form = document.createElement("div"); 
form.setAttribute("class", "clone input-group custom-file hdtuto control-group");
form.setAttribute("style", "margun-top: 10px")

// Create an input element for Full Name 
var FN = document.createElement("input"); 
FN.setAttribute("type", "file"); 
FN.setAttribute("name", "FullName"); 
FN.setAttribute("placeholder", "Full Name");  

// Create an input element for remove
var RWD = document.createElement("input"); 
RWD.setAttribute("type", "button"); 
RWD.setAttribute("value", "Delete"); 
RWD.setAttribute("onclick", "this.parentNode.parentNode.removeChild(this.parentNode);"); 
            
    // Append the full name input to the form 
    form.appendChild(FN);     
    
    // Append the Password to the form 
    form.appendChild(RWD);     

    document.getElementsByTagName("body")[0].appendChild(form); 
} 
</script>