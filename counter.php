<?php
/*
  =============================================================================
  STEP 1: INITIALIZE PHP SESSION
  session_start() must be called at the very top of the script BEFORE any HTML 
  output is sent to the browser.
  
  What session_start() does:
  It tells PHP to start tracking a unique visitor session using a session ID 
  stored in a temporary server file and browser cookie.
  =============================================================================
*/
session_start();

// File name where total visit count is saved permanently on disk
$filename = "count.txt";

/*
  =============================================================================
  STEP 2: READ THE PERMANENT COUNT FROM count.txt
  - count.txt stores the master total visit count across all users and server reboots.
  - If count.txt does not exist yet, we initialize it with 0.
  =============================================================================
*/
if (!file_exists($filename)) {
    file_put_contents($filename, "0");
}

// Read current count from file and convert to an integer
$totalHits = (int) file_get_contents($filename);

/*
  =============================================================================
  STEP 3: SESSION-BASED HIT COUNTING LOGIC (Requirement 6)
  
  Why use $_SESSION instead of simple page-load counting?
  - Simple page-load counting increments the number every time the user hits F5 (refresh).
  - $_SESSION['counted'] acts as a flag for the current browser session.
  - When a user first opens the site, $_SESSION['counted'] is NOT set. We increment 
    the count and set $_SESSION['counted'] = true.
  - If the user reloads or refreshes the page, $_SESSION['counted'] is ALREADY true, 
    so the counter DOES NOT increment again!
  =============================================================================
*/
$isNewSession = false;

if (!isset($_SESSION['counted'])) {
    // Increment the running total
    $totalHits++;
    
    // Save the new total permanently back into count.txt
    file_put_contents($filename, (string)$totalHits);
    
    // Set the session flag so this session is marked as counted
    $_SESSION['counted'] = true;
    
    $isNewSession = true;
}
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

        .status-new {
            background-color: #EBF2ED;
            color: #3D5A44;
            border: 1px solid #A2BFA7;
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

        <!-- Status Badge explaining if this request incremented the counter -->
        <?php if ($isNewSession): ?>
            <div class="status-badge status-new">
                🎉 New Session Detected &mdash; Count Incremented!
            </div>
        <?php else: ?>
            <div class="status-badge status-existing">
                🔄 Existing Session Active &mdash; Refresh Ignored (Count Unchanged)
            </div>
        <?php endif; ?>

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
                <li><code>session_start()</code> initializes session tracking when you load this page.</li>
                <li><code>$_SESSION['counted']</code> marks your session once you visit.</li>
                <li>If you hit <strong>Refresh (F5)</strong>, the count stays at <strong><?php echo $totalHits; ?></strong> because your session is already flagged!</li>
                <li>Opening a new browser tab or incognito window starts a <em>new session</em>, incrementing the count.</li>
            </ul>
        </div>

        <!-- Return button -->
        <a href="main.html" class="back-btn">&larr; Back to Main Content</a>
    </div>

</body>
</html>
