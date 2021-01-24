<?php
session_start();
?>


<p>Your Session has ended</p>




<?php
// remove all session variables
session_unset();

// destroy the session
session_destroy();
?>

<form action="itemSelect.php">
    <button type="submit">Return to Item Select</button>
</form>