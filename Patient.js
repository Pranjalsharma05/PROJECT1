
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = yyyy + '-' + mm + '-' + dd;
document.getElementById("AppointmentDate").setAttribute("min", today);

var maxDate = new Date();
maxDate.setDate(maxDate.getDate() + 30); // Adding 30 days
var max_dd = String(maxDate.getDate()).padStart(2, '0');
var max_mm = String(maxDate.getMonth() + 1).padStart(2, '0'); //January is 0!
var max_yyyy = maxDate.getFullYear();
var maxDateFormatted = max_yyyy + '-' + max_mm + '-' + max_dd;
document.getElementById("AppointmentDate").setAttribute("max", maxDateFormatted);

// Date button
  
var AppointmentDate = document.getElementById("AppointmentDate");
var button=document.getElementById('btn11');
 
button.addEventListener('click', function() {
    button.clicked = true;
});
document.getElementById("AppointmentDate").addEventListener("input", function() {
    var btn11 = document.getElementById("btn11");
    if (this.value !== "") {
        btn11.disabled = false; // Enable the button
    } else {
        btn11.disabled = true; // Disable the button
    }
});
       var option=document.getElementsByClassName("disable");

button.addEventListener('click', function() {
    

  if (AppointmentDate.value !== ""){
        document.getElementById('AppointmentDate').readOnly = true;
        for (var i = 0; i < option.length; i++) {
            option[i].disabled = false;
          }

        }
    });


    // timeeeee
    var btn22 = document.getElementById("btn22");
    btn22.disabled = true;
    btn22.style.backgroundColor="pink";


    button.addEventListener('click', function() {
document.getElementById("time").addEventListener("input", function() {
    var btn22 = document.getElementById("btn22");
    if (this.value !== "") {
        btn22.disabled = false;
        btn22.style.backgroundColor="green" ;
        alert("ok"); // Enable the button
    } else {
        btn22.disabled = true;
        
        alert("not ok");// Disable the button
    }
});
});


// timebook
var check=document.getElementById("slot1");
function timebook(event) {
    event.preventDefault(); // Prevent default form submission behavior

    // Your time booking logic here
    var check = document.getElementById("slot1");
    check.innerHTML = "booked";
    check.style.backgroundColor = "yellow";
}
