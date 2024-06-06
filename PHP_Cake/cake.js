function deleteCake(id) {
    if (id == "") {
        // We are not deleting anything
    } else {
        console.log("ID is " + id);
        var xmlHttpRequest = new XMLHttpRequest(); // GET, PUT, POST, DELETE
        xmlHttpRequest.onreadystatechange = function () {
            // State: 0 = Unsent, 1 = Opened, 2 = Headers_Received, 3 = Loading, 4 = Done -> Transmitting a request
            // Status 200 = OK, 404 = Not Found, 500 = Server error (backend) -> Response from the server
            if (this.readyState == 4 && this.status == 200) {
                // Optionally handle response here
                window.location.reload();
            }
        };
        xmlHttpRequest.open("GET", "deletecake.php?id=" + id, true);
        xmlHttpRequest.send();
    }
}

function showCakeLive(aString){
    if (aString== ""){
        document.getElementById("cakeLiveSearch").innerHTML = "";
    }
    else {
        var xmlHttpRequest = new XMLHttpRequest(); // GET , PUT, POST, DELETE 
        xmlHttpRequest.onreadystatechange = function () 
        {
            // State :  0 = Unsent, 1 = Opened , 2 Headers_Received, 3 Loading, 4 Done -> Trasmitting a request
            // Status 200 = OK, 404 = Not Found , 500 = Server error (backend)  -> Response from the server
            if (this.readyState == 4 && this.status == 200){
                document.getElementById("cakeLiveSearch").innerHTML = this.responseText;
                document.getElementById("cakeLiveSearch").style.border = "border: 1px solid black";
            } // if
             }// xmlHTTPRequest onreadystatechange
        xmlHttpRequest.open("GET","cakeinfo.php?query=" + aString,true);
        xmlHttpRequest.send();
    }
}  


function uploadPicture(id, cakeName, icingName){
    if (id === ""){
       return;
    }

    const encodedId = encodeURIComponent(id);
    const encodedCakeName = encodeURIComponent(cakeName);
    const encodedIcingName = encodeURIComponent(icingName);

    const xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.onreadystatechange = function (){
        if (this.readyState === 4 && this.status === 200){
            const redirectUrl = `uploadcakepicture.php?id=${encodedId}&cakeName=${encodedCakeName}&icingName=${encodedIcingName}`;
            window.location.href = redirectUrl;
        } //if readyState == 4 && status == 200
    }; 

    const url = `uploadcakepicture.php?id=${encodedId}&cakeName=${encodedCakeName}&icingName=${encodedIcingName}`;
    xmlHttpRequest.open("GET", url, true);
    xmlHttpRequest.send();
}

function updateCake(id, cakeName, icingName, infoDetails) {
    if (id === "") {
        // We are not updating anything
        return;
    }

    const encodedId = encodeURIComponent(id);
    const encodedCakeName = encodeURIComponent(cakeName);
    const encodedIcingName = encodeURIComponent(icingName);
    const encodedInfoDetails = encodeURIComponent(infoDetails);

    const xmlHttpRequest = new XMLHttpRequest();
    xmlHttpRequest.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            // Redirect to the updatecake.php page
            const redirectUrl = `updatecake.php?id=${encodedId}&cakeName=${encodedCakeName}&icingName=${encodedIcingName}&infoDetails=${encodedInfoDetails}`;
            window.location.href = redirectUrl;
        }
    };

    const url = `updatecake.php?id=${encodedId}&cakeName=${encodedCakeName}&icingName=${encodedIcingName}&infoDetails=${encodedInfoDetails}`;
    xmlHttpRequest.open("GET", url, true);
    xmlHttpRequest.send();
}
