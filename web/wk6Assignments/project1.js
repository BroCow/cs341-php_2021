var clientSearch = "<?php echo $clientSearch ?>";

if(clientSearch == false){
    document.getElementById('h2_clientSearch').style.display = "none";
    document.getElementById('form_clientSearch').style.display = "none";
}


function clientSearch () {
    document.getElementById('h2_clientSearch').style.display = "block";
    document.getElementById('form_clientSearch').style.display = "block";
}