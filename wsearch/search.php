<?php

#
# WSearch keret
#


if (!isset($SW)){
  if (file_exists("./config.php")){
    include("./config.php");
  }
}


if (file_exists("./header.php")){
  include("./header.php");
}

$q="";
if (isset($_GET['q'])){
  $q=$_GET['q'];
}

$page="0";
if (isset($_GET['p'])){
  $page=$_GET['p'];
}

if ($q!=""){
  if (file_exists("$DATA_ENGINE")){
    include("$DATA_ENGINE");
  }
}

?>

<body class="result-body">
    <div class="result-container">
        <header>
            <div class="result-search-container">
                <img src="logo.png" alt="WSearch Logo" class="result-logo">
                <form method="get" class="result-search-form">
                    <input id="q" name="q" type="text" placeholder="<?php echo($L_SEARCH_TEXT_PLACEHOLDER);?>" class="result-search-bar" value="<?php echo($q); ?>">
                </form>
            </div>
        </header>
        
        <div class="result-content-wrapper">
            <main class="results">
                <br />
                <h2><?php echo($L_FOUND);?>: "<?php echo($q); ?>"</h2>
                
                
                <?php
                
                  $result=array(array("","",""));
                  
                  if (function_exists("data_engine")){
                    $result=data_engine($q,$page,$DATA_PAGE);
                  }
                  
                  $db=count($result);
                  for($i=0;$i<$db;$i++){
                    $r=$result[$i];
                    echo("<div class=\"result-item\">");
                    echo("<h3><a href=\"".$r[1]."\">".$r[0]."</a></h3>");
                    echo("<p class=\"result-url\">".$r[1]."</p>");
                    echo("<p class=\"result-description\">".$r[2]."</p>");
                    echo("</div>");
                  }
    
                ?>
            </main>

            <?php
              $aires="";
              if (function_exists("data_engine")){
                $aires=data_ai($q);
              }
            ?>
            
            <aside class="sidebar">
                <div class="info-box">
                    <h3><?php echo($AI_BOX_TITLE); ?></h3>
                    <p><?php echo($aires); ?></p>
                </div>
            </aside>
        </div>
                
        <div class="pagination">
            <?php
            ?>
            <a href="#" class="page-link disabled">&laquo; <?php echo($L_FORMER);?></a>
            <a href="#" class="page-link active">1</a>
            <a href="#" class="page-link">2</a>
            <a href="#" class="page-link">3</a>
            <span class="page-dots">...</span>
            <a href="#" class="page-link">10</a>
            <a href="#" class="page-link"><?php echo($L_NEXT);?> &raquo;</a>
        </div>
        
        <?php
            if (file_exists("./footer.php")) {
              include("./footer.php");
            }
        ?>
        
    </div>

</body>
</html>





