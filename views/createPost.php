<?php include("start.php"); ?>




<h1>CREATE POST</h1>

<div class="form">
    <form action="/posts" method="post">
        <input type="text" name="title" placeholder="TITLE">
        <input type="text" name="text" placeholder="TEXT">
        <input type="submit" value="SAVE">
    </form>
</div>




<?php include("end.php"); ?>