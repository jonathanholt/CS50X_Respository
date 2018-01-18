<!DOCTYPE html>

<html>

    <head>

        <link href="/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="/css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>40k Carnage Report</title>
        <?php endif ?>

        <script src="/js/jquery-1.10.2.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/scripts.js"></script>
        <script src="/js/smchapters.js"></script>
        <script src="/js/armies.js"></script>
        <script src="/js/armypics.js"></script>

    </head>

     <body onload="getPicture(); codeAddress();">
     
    
   

        <div class="container">
            <div id="top">
                <a href="/"><img id="topbanner" alt="40kbanner" src="http://files.cluster2.hgsitebuilder.com/hostgator20427/image/warhammer-40000-logo.jpg"/></a>
            </div>
            
            <ul id="headlist" class="nav nav-pills">
    <li><a href="stats.php" class="liu">Statistics</a></li>
    <li><a href="submit.php" class="liu">Submit Battle Report</a></li>
    <li><a href="games.php" class="liu">Recent Games</a></li>
    <li><a href="history.php" class="liu">Personal History</a></li>
    <?php
    if(!empty($_SESSION["id"]))
    {
        echo "<li><a href='logout.php' class='liu'><strong>Log Out</strong></a></li>";
    }
    else
    {
        echo "<li><a href='login.php' class='liu'><strong>Login</strong></a></li>";
    }
    ?>
</ul>

            <div id="middle">
