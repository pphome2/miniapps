<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
      opacity: 1;
    }
    .controls {
      position: fixed;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 10;
      display: flex;
      gap: 10px;
    }
    button {
      padding: 10px 20px;
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
  </style>
</head>

<body>
  <div class="gallery-container">
    <img id="currentImage" class="gallery-image" src="" alt="Galéria kép">
    <div class="controls">
      <button onclick="previousImage()"> << </button>
      <button onclick="toggleSlideshow()"> > </button>
      <button onclick="nextImage()"> >> </button>
      <button onclick="toggleFullscreen()"> + </button>
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
          case "JPG":
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
    const transitionDuration = 500;
    let nextImagePreload = null;

    // Következő kép előtöltése
    function preloadNextImage(index) {
      const nextIndex = (index + 1) % images.length;
      nextImagePreload = new Image();
      nextImagePreload.src = images[nextIndex];
    }

    function loadImage(index) {
      imageElement.style.opacity = 0;
      preloadNextImage(index); // Előtöltjük a következő képet
      setTimeout(() => {
      imageElement.src = images[index];
      }, transitionDuration);
      setTimeout(() => {
        imageElement.style.opacity = 1;
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
        slideshowInterval = setInterval(nextImage, 3000);
      }
    }

    function toggleFullscreen() {
      if (!document.fullscreenElement) {
        galleryContainer.requestFullscreen({ navigationUI: "hide" })
          .catch(err => {
            console.log(`Hiba a teljes képernyőre váltáskor: ${err.message}`);
          });
      } else {
        document.exitFullscreen();
      }
    }

    // Kezdeti kép betöltése
    if (images.length > 0) {
      loadImage(currentIndex);
    }

    // Képernyő forgatás kezelése Androidon
    window.addEventListener('orientationchange', () => {
      setTimeout(() => {
        imageElement.style.width = '100vw';
        imageElement.style.height = '100vh';
      }, 100);
    });

    // Pinch zoom megakadályozása Androidon
    document.addEventListener('touchmove', function (event) {
      if (event.scale !== 1) {
        event.preventDefault();
      }
    }, { passive: false });
  </script>
</body>
</html>
