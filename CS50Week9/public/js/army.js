/**
 * scripts.js
 *
 * Computer Science 50
 * Problem Set 7
 *
 * Global JavaScript, if any.
 */
 
 function favBrowser()
{
    var mylist=document.getElementById("myList");
    var mylist2=document.getElementById("myList2");
    document.getElementById("idn").innerHTML = mylist.options[mylist.selectedIndex].text;
    document.getElementById("idm").innerHTML = mylist2.options[mylist2.selectedIndex].text;
}
