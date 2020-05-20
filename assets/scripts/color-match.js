const boxes = [$("#color-match-box-1"), $("#color-match-box-2")]; 
var colors = [];  

refreshColorBoxes(); 

function sendCMResult(result) {
  if (typeof result !== 'boolean') 
    return; 

  var data = new FormData(); 
  
  colors.forEach(function(b, i) {
    var actual = hexc(boxes[i].css('background-color')).toLowerCase(); 

    if (actual !== colors[i]) {
      refreshColorBoxes(); 
      return; 
    }

    data.append('color-' + (i+1), b); 
  }); 

  data.append('match', result); 

  fetch('/training-data.php?action=add', {
    body: data, 
    method: "post"
  }); 

  refreshColorBoxes(); 
}

function refreshColorBoxes() {
  boxes.forEach(function(b, i) {
    colors[i] = getRandomColor(); 
    b.css('background-color', colors[i]); 
  }); 
}

function getRandomColor() {
  var letters = '0123456789abcdef';
  var color = '#';

  for (var i = 0; i < 6; i++) {
    color += letters[Math.floor(Math.random() * 16)];
  }

  return color;
}

function hexc(colorval) {
  var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
  delete(parts[0]);
  for (var i = 1; i <= 3; ++i) {
    parts[i] = parseInt(parts[i]).toString(16);
    if (parts[i].length == 1) parts[i] = '0' + parts[i];
  }
  return '#' + parts.join('');
}
