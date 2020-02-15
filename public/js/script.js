// Image preview

function inputImage(){
    document.getElementById("image-source").click();
}

function previewImage(){
    document.getElementById("image-preview").style.display = "block";
     let oFReader = new FileReader();
         oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

         oFReader.onload = function(oFREvent){
             document.getElementById("image-preview").src = oFREvent.target.result;
         }
}
