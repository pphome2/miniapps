<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Képnézegető</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      overflow: hidden;
      background-color: #000;
    }
    .gallery-container {
      position: relative;
      width: 100vw;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .gallery-image {
      width: 100vw;
      height: 100vh;
      object-fit: contain;
      transition: opacity 0.5s ease;
      opacity: 1; /* Alapértelmezett láthatóság */
    }
    .controls {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 10;
    }
    button {
      padding: 10px 20px;
      margin: 0 10px;
      cursor: pointer;
      background-color: rgba(76, 175, 80, 0.8);
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
    }
    button:hover {
      background-color: rgba(69, 160, 73, 0.8);
    }
    .loading {
      position: absolute;
      color: white;
      font-size: 24px;
      z-index: 20;
    }
  </style>
</head>

<body>
  <div class="gallery-container">
    <div id="loadingMessage" class="loading">Képek betöltése...</div>
    <img id="currentImage" class="gallery-image" src="" alt="Galéria kép">
    <div class="controls">
      <button onclick="previousImage()">Előző</button>
      <button onclick="toggleSlideshow()">Diavetítés</button>
      <button onclick="nextImage()">Következő</button>
      <button onclick="toggleFullscreen()">Teljes képernyő</button>
    </div>
  </div>

  <script>
    const images = [
    <?php
      if (!empty($_SERVER['HTTPS'])){
        $pr="https://";
      }else{
        $pr="http://";
      }
      $URL=$pr.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
      $DIR="img";
      $fl=scandir($DIR);
      foreach($fl as $fn){
        $fi=pathinfo($DIR."/".$fn);
        switch($fi['extension']){
          case "jpg":
            echo("\"".$URL."/".$DIR."/".$fn."\",\n");
          break;
        }
      }
      //echo("\"\"\n");
    ?>
    ];

    let currentIndex = 0;
    let slideshowInterval = null;
    const imageElement = document.getElementById("currentImage");
    const galleryContainer = document.querySelector(".gallery-container");
    const loadingMessage = document.getElementById("loadingMessage");
    let preloadedImages = [];
    const transitionDuration = 500; // Átmenet időtartama milliszekundumban (0.5s)

    // Képek előtöltése
    function preloadImages(imageArray, callback) {
      let loadedCount = 0;
      preloadedImages = imageArray.map(src => {
        const img = new Image();
        img.src = src;
        img.onload = () => {
          loadedCount++;
          if (loadedCount === imageArray.length) {
            callback();
          }
        };
        img.onerror = () => {
          console.error(`Hiba a kép betöltésekor: ${src}`);
          loadedCount++;
          if (loadedCount === imageArray.length) {
            callback();
          }
        };
        return img;
      });
    }

    // Kép betöltése és megjelenítése az átmenet után
    function loadImage(index) {
      // Elhalványítjuk az aktuális képet
      imageElement.style.opacity = 0;

      // Várunk, amíg az átmenet befejeződik, majd betöltjük az új képet
      setTimeout(() => {
          imageElement.src = images[index];
          imageElement.style.opacity = 1; // Új kép megjelenítése
      }, transitionDuration);
    }

    function nextImage() {
      currentIndex = (currentIndex + 1) % images.length;
      loadImage(currentIndex);
    }

    function previousImage() {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      loadImage(currentIndex);
    }

    function toggleSlideshow() {
      if (slideshowInterval) {
        clearInterval(slideshowInterval);
        slideshowInterval = null;
      } else {
        slideshowInterval = setInterval(nextImage, 3000); // 3 másodperc képváltás között
      }
    }

    function toggleFullscreen() {
      if (!document.fullscreenElement) {
        galleryContainer.requestFullscreen().catch(err => {
          console.log(`Hiba a teljes képernyőre váltáskor: ${err.message}`);
        });
      } else {
        document.exitFullscreen();
      }
    }

    // Inicializálás: képek előtöltése, majd indítás
    preloadImages(images, () => {
      loadingMessage.style.display = "none";
      loadImage(currentIndex); // Első kép betöltése
    });
    </script>
</body>
</html>
