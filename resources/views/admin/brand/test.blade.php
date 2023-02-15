<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>jQuery Create a "Please Wait, Loading..." Animation</title>
<style>
.overlay{
    display: none;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 999;
    background: rgba(255,255,255,0.8) url("loader.gif") center no-repeat;
}
/* Turn off scrollbar when body element has the loading class */
body.loading{
    overflow: hidden;   
}
/* Make spinner image visible when body element has the loading class */
body.loading .overlay{
    display: block;
}
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
// Initiate an Ajax request on button click
$(document).on("click", "button", function(){
    $.get("customers.php", function(data){
        $("body").html(data);
    });       
});
 
// Add remove loading class on body element based on Ajax request status
$(document).on({
    ajaxStart: function(){
        $("body").addClass("loading"); 
    },
    ajaxStop: function(){ 
        $("body").removeClass("loading"); 
    }    
});
</script>
</head>
<body style="text-align: center;">
    <button type="button">Get Customers Details</button>
    <p>Click the above button to get the customers details from the web server via Ajax.</p>
    <div class="overlay"></div>
</body>
</html> 