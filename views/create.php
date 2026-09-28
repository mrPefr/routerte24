<?php include("start.php"); ?>




<h1>CREATE GUITAR</h1>

<div class="form">
    <form action="/guitars/create" method="post">
        <input type="text" name="brand" placeholder="BRAND">
        <input type="text" name="model" placeholder="MODEL">
        <input type="submit" value="SAVE">
    </form>

</div>




<?php include("end.php"); ?>