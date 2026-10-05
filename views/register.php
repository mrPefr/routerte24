<?php include("start.php"); ?>

<h1>Register</h1>

<div class="form">
    <form action="/register" method="post">
        <input  type="email" name="email" placeholder="EMAIL">
        <input  type="password" name="password" placeholder="PASSWORD" minlength="8">
        <input type="submit" value="REGISTER">
    </form>
</div>



<?php include("end.php"); ?>