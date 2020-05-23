// function to be called by the image upload button
// to trigger the hidden image input
function chooseImage() {
  $("#image-input").click(); 
}

// function to ensure the file with the correct extension
// is being uploaded
function checkExtension(fileName) {
  var _validExts = [".jpg", ".jpeg", ".png"]; 

  var extValid = false; 

  for (var i = 0; i < _validExts.length; i++) {
    var ext = _validExts[i];
    if (fileName.substr(fileName.length - ext.length, 
            ext.length).toLowerCase() == ext.toLowerCase()) {
        extValid = true;
        break;
    }
  }

  if (!extValid) {
    window.location.href = "index.html?error=-1"; 
    throw new Error("Bye bye! "); 
  }
}

var api = "/api/upload.php"; 

var form = $("#upload-form"); 
var img = $("#image-input"); 
form.attr("action", api); 

// auto submit the form (image input) upon an image is uploaded
img.on("change", function() {
  var fileName = img.val(); 
  checkExtension(fileName); 

  form.submit(); 
}); 
