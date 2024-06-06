<?php
include 'header.php';
include 'database.php';


?>
<br/>
        <h5>&nbsp; &nbsp; Searching cake...</h5>
        <br/>
        <div class="centrallyAligned">
            <form>
                <input type="text" size="45" onkeyup="showCakeLive(this.value)"> 
            </form>
        </div>
        <br/>
        <div id="cakeLiveSearch" ></div>
<?php
echo"<br>";
echo"<hr>";
include 'footer.php';
echo"<br>";

?>