<?php

#
# WSearch keret
#



if (file_exists("./header.php")) {
  include("./header.php");
}

?>

<body class="search-body">
    <div class="container">
        <header>
            <img src="logo.png" alt="WSearch Logo" class="logo">
            <h1>WSearch</h1>
        </header>
        <main class="search-main"">
            <form method="get" class="search-form">
                <input id ="q" name="q" type="text" placeholder="<?php echo($L_SEARCH_TEXT_PLACEHOLDER);?>" class="search-bar">
                <button id="go" name="go" type="submit" class="search-button"><?php echo($L_BUTTON);?></button>
            </form>
        </main>
        
        <?php
            if (file_exists("./footer.php")) {
              include("./footer.php");
            }
        ?>
        
    </div>
</body>

</html>

