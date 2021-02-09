
document.getElementById('hideSearch').style.display = "none";

function clientSearch () {
    var x = document.getElementById('hideSearch');
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}