<?php
/*
  =============================================================================
  READ PERMANENT HIT COUNT FROM count.txt
  - Hit counter incrementing logic is handled automatically in banner.php when 
    the site loads.
  - counter.php only reads and displays the count stored in count.txt without 
    incrementing it.
  =============================================================================
*/
$filename = "count.txt";

// Read current count from file and convert to an integer (default to 0 if file does not exist)
if (!file_exists($filename)) {
    file_put_contents($filename, "0");
}

$totalHits = (int) file_get_contents($filename);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Visitor Counter - PHP Sessions</title>
    <!-- Styling using Warm Cream, Sage Green & Terracotta palette -->
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #FAF6F0; /* Soft warm cream background */
            color: #383330;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        .counter-card {
            max-width: 580px;
            margin: 20px auto;
            background-color: #FFFFFF;
            padding: 30px 25px;
            border-radius: 8px;
            border: 1px solid #E0D7C6;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        h2 {
            color: #527359; /* Sage green heading */
            margin-top: 0;
        }

        /* Styled counter display box */
        .count-box {
            background-color: #FAF6F0;
            border: 2px dashed #D4C7B0;
            padding: 20px;
            margin: 20px 0;
            border-radius: 6px;
        }

        .count-number {
            font-size: 48px;
            font-weight: bold;
            color: #D97757; /* Terracotta count display color */
            margin: 10px 0;
        }

        .count-label {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #527359; /* Sage green text */
            font-weight: bold;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .status-existing {
            background-color: #F9F3EA;
            color: #8C6A43;
            border: 1px solid #E3D2BF;
        }

        .explanation {
            text-align: left;
            background-color: #FAF6F0;
            border-left: 4px solid #527359;
            padding: 12px 15px;
            margin-top: 20px;
            font-size: 13px;
            line-height: 1.6;
        }

        a.back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 18px;
            background-color: #527359;
            color: #FFFFFF;
            text-decoration: none;
            border-radius: 4px;
            font-size: 13px;
            font-weight: bold;
        }

        a.back-btn:hover {
            background-color: #D97757;
        }
    </style>
</head>
<body>

    <div class="counter-card">
        <h2>PHP Session Visitor Hit Counter</h2>

        <!-- Status Badge -->
        <div class="status-badge status-existing">
            📊 Live Visitor Counter &mdash; Auto-tracked on Site Load (banner.php)
        </div>

        <!-- Total Count Box -->
        <div class="count-box">
            <div class="count-label">Total Permanent Unique Sessions</div>
            <div class="count-number"><?php echo $totalHits; ?></div>
            <p style="margin: 0; font-size: 12px; color: #77706A;">
                Stored permanently inside file: <code>count.txt</code>
            </p>
        </div>

        <!-- Beginner Student Explanation Box -->
        <div class="explanation">
            <strong>How this PHP Session Counter Works:</strong>
            <ul>
                <li>The session hit-counter increment logic runs automatically in <code>banner.php</code> when the site loads.</li>
                <li><code>session_start()</code> and <code>$_SESSION['counted']</code> ensure each session is counted only once.</li>
                <li><code>counter.php</code> simply reads and displays the count stored in <code>count.txt</code> without incrementing it.</li>
            </ul>
        </div>

        <!-- Return button -->
        <a href="main.html" class="back-btn">&larr; Back to Main Content</a>
    </div>

</body>
</html>
