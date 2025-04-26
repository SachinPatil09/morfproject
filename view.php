<?php
$logFile = "logs/info.txt";
?>

<!DOCTYPE html>
<html>
<head>
  <title>MORF Log Viewer</title>
  <link rel="stylesheet" href="style.css">
  <style>
    pre {
      background: #f9f9f9;
      padding: 20px;
      border-radius: 10px;
      white-space: pre-wrap;
      word-wrap: break-word;
      font-family: monospace;
      max-height: 80vh;
      overflow-y: auto;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>📂 MORF Log Viewer</h2>
    <pre>
<?php
if (file_exists($logFile)) {
    echo htmlspecialchars(file_get_contents($logFile));
} else {
    echo "No logs found.";
}
?>
    </pre>
    <footer>📜 End of Logs</footer>
  </div>
</body>
</html>
