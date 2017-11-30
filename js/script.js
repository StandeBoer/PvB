function AddCriterium() {

    var id = document.getElementById("kerntaak_criterium_option").value;
    //alert(id);
    if (id == null) {
        document.getElementById("Addcrit").innerHTML = "Empty";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("Addcrit").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "AddCriterium.php?id=" + id, true);
        xmlhttp.send();
    }
    setTimeout(function () {
    }, 10);
}