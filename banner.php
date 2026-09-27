<?php
/*
  =============================================================================
  PHP SESSION HIT COUNTER LOGIC
  - session_start() must be called at the very top before any HTML output.
  - Checks if the current visitor session has been counted.
  - If not, increments the hit count in count.txt and sets $_SESSION['counted'].
  =============================================================================
*/
session_start();

$filename = "count.txt";

if (!file_exists($filename)) {
    file_put_contents($filename, "0");
}

$totalHits = (int) file_get_contents($filename);

if (!isset($_SESSION['counted'])) {
    $totalHits++;
    file_put_contents($filename, (string)$totalHits);
    $_SESSION['counted'] = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Site Banner</title>
    <!-- Simple inline styling using warm light cream background and terracotta accents -->
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #F4EFEA; /* Light warm cream/beige background */
            font-family: Arial, Helvetica, sans-serif;
            color: #383330; /* Dark charcoal text for high contrast */
            text-align: center;
            border-bottom: 3px solid #D97757; /* Terracotta bottom border */
        }

        .banner-container {
            padding: 12px 10px;
        }

        h1 {
            margin: 0;
            font-size: 22px;
            color: #D97757; /* Terracotta title color */
            letter-spacing: 1px;
        }

        p {
            margin: 4px 0 0 0;
            font-size: 13px;
            color: #527359; /* Sage green subtitle color */
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- 
      BANNER CONTAINER:
      Displays the main website logo header text centered at the top of the frameset.
    -->
    <div class="banner-container">
        <h1>INTERNET & WEB TECHNOLOGY ACADEMIC PORTAL</h1>
        <p>Simple Mini-Project: HTML Frames, Image Maps &amp; PHP Session Counter</p>
    </div>

</body>
</html>
