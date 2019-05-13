function numberAnimation(canvasId, foregroundHex, fontSize = 28) {
  let canvas = document.getElementById(canvasId);
  let $canvas = $('#'+canvasId);
  let ctx = canvas.getContext("2d");
  canvas.width = $canvas.parent().outerWidth();
  canvas.height = $canvas.parent().outerHeight();

  let charSet = [
    "0",
    "1",
    "2",
    "3",
    "4",
    "5",
    "6",
    "7",
    "8",
    "9",
  ];

  ctx.fillStyle = "rgba(255, 255, 255, 1)";
  ctx.fillRect(0, 0, canvas.width, canvas.height);

  function fadingSymbols(ctx) {

    let numberOfColumns = Math.floor(canvas.width / fontSize);
    let numberOfRows = Math.floor(canvas.height / fontSize);

      ctx.fillStyle = "rgba(255, 255, 255, 0.2)";
      ctx.fillRect(0, 0, canvas.width, canvas.height);

      for (let i = 0; i < numberOfColumns; i++) {
          ctx.fillStyle = foregroundHex;
          ctx.font = `${fontSize}px Courier New`;
          ctx.fillText(charSet[Math.floor(Math.random() * charSet.length)], i * fontSize, Math.floor(Math.random() * numberOfRows) * fontSize);
      }
  }

  var interval;
  function updateNamebersCanvas () {
    var namebers_canvas = $('#'+canvasId);
    var namebers_canvas_container = namebers_canvas.parent();
    var namebers_canvas_context = namebers_canvas.get(0).getContext('2d');
    namebers_canvas.attr('width', namebers_canvas_container.outerWidth() );
    namebers_canvas.attr('height', namebers_canvas_container.outerHeight() );
    clearInterval(interval);
    interval = setInterval(function(){ return fadingSymbols(namebers_canvas_context); }, 70);
  }

  $(window).resize(updateNamebersCanvas);
  updateNamebersCanvas();

  // Debounce resize notifications to reduce subscriber calls
  var timer;
  window.addEventListener("resize", function () {
    clearTimeout(timer);
    timer = setTimeout(updateNamebersCanvas, 100);  // adjust time to liking
  });
}
