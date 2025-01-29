<?php
// Redirect to a different page after 5 seconds
header("Refresh: 5; URL=https://www.example.com/");

// Other headers
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Redirecting...</title>
</head>
<body>
    <p>You will be redirected to another page in 5 seconds. If not, <a href="https://www.example.com/">click here</a>.</p>
</body>
</html>
