function previewImage() {
    var reader = new FileReader();
    reader.onload = function(event) {
      var img = document.getElementById("preview");
      img.src = event.target.result;
      img.style.display = "block";
    }
    reader.readAsDataURL(document.getElementById("file-upload").files[0]);
  }