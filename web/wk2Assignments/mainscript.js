/*Add function in your JavaScript file to alert the text "Clicked!", 
and have your button call this function when it is clicked.*/
function buttonClick() {
    alert("Clicked!");
}

/*Write a JavaScript function that gets invoked by clicking this button 
that gets the text from the textbox and sets the color of the first div.*/

function changeColor1() {
    var color = document.getElementById("colorChange1").value;
    document.getElementById("div1").style.backgroundColor = color;
}

/*Use JQuery to change background color of div2, getting user entered color
and clicking button*/
$(document).ready(function() {
    /*
    $("#changeColorButton2").click(function(){
        alert("Value: " + $("#colorChange2").val());
    })
    */
    $("#div2").on( "click", "button", function( event ) {
        $(event.delegateTarget ).css( "background-color", $("#colorChange2").val());
      });
});

/*Use jQuery to toggle the visibility of the third div. Use jQuery to make it slowly
fade in and fade out, rather than just turning on and off.*/
$(document).ready(function() {
    $("#fadeDiv3").click(function(){
        $("#div3").fadeToggle("slow");
    });
});
