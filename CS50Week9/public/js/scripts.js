function favBrowser()
{
    var mylist=document.getElementById("myList");
    var mylist2=document.getElementById("myList2");
    document.getElementById("idn").innerHTML = mylist.options[mylist.selectedIndex].text;
    document.getElementById("idm").innerHTML = mylist2.options[mylist2.selectedIndex].text;
    
    if((mylist.options[mylist.selectedIndex].text) == "Space Marines")
    {
        $("#chapter1").show();
    }
    else if((mylist2.options[mylist2.selectedIndex].text) == "Space Marines")
    {
        $("#chapter2").show();
    }
    else
    {
        $("#chapter1").hide();
        //CLEAR THE VALUES!!
        $("#chapter2").hide();
    }
}


$(document).ready(function(){
    $("#chapter1").hide();
    $("#chapter2").hide();
});

function validateChapter() {
            // Get the source element.
            var el = document.getElementById("chapter1").value;
            var el2 = document.getElementById("chapter2").value;
            // Valid numbers
            var array = CHAPTERS;
            
            if(jQuery.inArray(el, CHAPTERS) == -1)
            {
                console.log("Invalid State");
                $("#submit").hide();
            }
            else if(jQuery.inArray(el2, CHAPTERS) == -1)
            {
                $("#submit").hide(); 
            }
            else
            {
                $("#submit").show();
            }
         }



function codeAddress(){
var select = document.getElementById("selectNumber");
for(var i = 0; i < ARMIES.length; i++) {
    var opt = ARMIES[i];
    var el = document.createElement("option");
    el.textContent = opt;
    el.value = opt;
    select.appendChild(el);

}}

function getPicture(){
for(var i = 0; i < ARMYPICS.length; i++) {
    if(ARMYPICS[i].army == document.title)
    {
        console.log("army");
        document.getElementById("armypic").src= ARMYPICS[i].image;
    }}}
