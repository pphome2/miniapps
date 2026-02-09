<?php

// beállítások, értékek, elérések, könyvtárak
if (file_exists(__DIR__.'/../core/config.php')){
  include(__DIR__.'/../core/config.php');
}else{
  exit;
}

// nyelvi fájl betöltése
if (file_exists(__DIR__.'/..'.$wswdteam_dir_lang."/".$wswdteam_locale.".php")){
  include(__DIR__.'/..'.$wswdteam_dir_lang."/".$wswdteam_locale.".php");
}

if (isset($wswdteam_lang_str)){
  $title=$wswdteam_lang_str['Karbantartás'];
  $line1=$wswdteam_lang_str['Karbantartás folyamatban'];
  $line2=$wswdteam_lang_str['Oldalunk jelenleg frissítés alatt áll'];
  $line3=$wswdteam_lang_str['Várható befejezés: hamarosan'];
  $line4=$wswdteam_lang_str['Főoldal'];
} else {
  $title='.Karbantartás';
  $line1='.Karbantartás folyamatban';
  $line2='.Oldalunk jelenleg frissítés alatt áll';
  $line3='.Várható befejezés: hamarosan';
  $line4='.Főoldal';
}


// főkönvtár URL kiszámítása
function get_base_url() {
  $current_path=str_replace('\\', '/',dirname($_SERVER['SCRIPT_NAME']));
  // Megkeressük az utolsó előfordulását a "wp-content" résznek és levágjuk onnan
  $wp_root_path=substr($current_path,0,strpos($current_path,'/wp-content'));
  $full_url=(isset($_SERVER['HTTPS']) ? "https" : "http") ."://".$_SERVER['HTTP_HOST'].$wp_root_path;
  return $full_url;
}




?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo($title); ?></title>
    <style>
        body {
            font-family: sans-serif;
            background: #1a1a1a;
            color: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .box {
            text-align: center;
            padding: 40px;
            border: 1px solid #444;
            border-radius: 8px;
            background: #222;
        }
        h1 { color: #ffcc00; }
        p { font-size: 1.2rem; }
        a {
            color: inherit;
            text-decoration: none;
        }
        a:visited {
            color: inherit;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>🛠 <?php echo($line1); ?></h1>
        <p><?php echo($line2.'.'); ?></p>
        <p><small><?php echo($line3.'.'); ?></small></p>
        <p><small><a href=<?php echo(get_base_url());?>><?php echo('[ '.$line4.' ]'); ?></a></small></p>
    </div>
</body>
</html>


