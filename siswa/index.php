<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/CSS/style.css">
    <style>
        body{
        }

        .upload-container {
    text-align: center;
    background: #fff;
    border: 1px dashed #aaa;
    border-radius: 10px;
    padding: 20px;
    width: 300px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.container{
    display: flex;
    justify-content: center;
    align-items: center;
}

.upload-container h2 {
    margin: 0;
    font-size: 20px;
    color: #333;
}

.upload-container p {
    margin: 10px 0;
    color: #555;
}

.upload-box {
    border: 2px dashed #aaa;
    border-radius: 10px;
    padding: 20px;
    margin-top: 20px;
    background: #f9f9f9;
}

.upload-icon img {
    width: 50px;
    height: 50px;
    margin-bottom: 10px;
}

.browse-btn {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.browse-btn:hover {
    background-color: #0056b3;
}
    </style>
    <script type='text/javascript'>
       
       Dropzone.options.myAwesomeDropzone = {
           init: function() {
               
               this.on("success", function(file) {

                   var ext = checkFileExt(file.name);  // Get ekstensi
                   var newimage = "";
                   console.log('ext : ' + ext);
                   // Memeriksa Ekstensi. Jika tidak gambar maka thumbnail diganti dengan logo
                   if(ext != 'png' &&  ext != 'jpg' && ext != 'jpeg'){
                       newimage = "logo.png";   // default image path
                   }
                    
                   this.createThumbnailFromUrl(file, newimage);
               });
           }
       };

       // Get file extension
       function checkFileExt(filename){
           filename = filename.toLowerCase();
           return filename.split('.').pop();
       }
       </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm stikcy-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="../assets/img/bm3.png" alt="Logo" height="30" class="logo d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../landing page/index.php#program">Program</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kontak</a>
                    </li>
                </ul>
                <div class="d-flex mt-2 mt-lg-0">
                    <button class="btn btn-outline-primary me-2" type="button">Sign In</button>
                    <button class="btn btn-primary" type="button">Sign Up</button>
                </div>
            </div>
        </div>
    </nav>
    <div class="upload-container" style="display: flex; justify-content: center; align-items: center;">
        <div class="container" >
            <div class='content'>
            <form action="upload.php" class="dropzone" id="myAwesomeDropzone" >
        <h2>UPLOAD FILES</h2>
        <p>Upload documents you want to share with your team.</p>
        <div class="upload-box">
            <div class="upload-icon">
                <img src="cloud-upload-icon.png" alt="Upload Icon">
            </div>
            <p>Drag & Drop your Files here</p>
            <p>OR</p>
            <button class="browse-btn">Browse Files</button>
        </div>
             <!-- INI ADALAH AREA DROPZONENYA -->  
            </form>  
            </div> 
        </div>
    </div>
</body>
</html>