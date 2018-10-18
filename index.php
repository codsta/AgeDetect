<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" >

    <title>Age Detector </title>
  </head>
  <body>
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="#">Age Detector</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor01">
        <!-- <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Features</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search">
          <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
        </form> -->
      </div>
    </nav>
      <div class="row">
        <div class="col-md-6 offset-md-3" id="main">
          <!-- <form class="justify-content-center"  enctype="multipart/form-data" method="POST" action="post.php" id="upload-form" > -->
          <form class="justify-content-center"  enctype="multipart/form-data" method="POST" action="post.php" id="upload-form" >
            <h2 class="mt-5" id="heading">Upload Image To Detect Age</h2>
            <div class="alert alert-primary" role="alert" id="result" >

            </div>
            <div class="" id="image-preview"></div>

            <p id="percent"></p>
            <!-- <div class="progress mt-5" id="upload-progress">

              <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 0%" id="progressbar1"></div>
            </div> -->
            <label class="btn-bs-file btn btn btn-secondary btn-block mt-5 ">
                Browse
                <input type="file" name="pic" id="pic">

            </label>
            <br>
            <!-- <button type="submit" name="button" class=" btn btn-lg btn-primary btn-block"  >Upload </button> -->
            <button type="submit" name="button" class=" btn btn-lg btn-primary btn-block"  onclick='upload_image();'>Upload </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="jquery.form.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script type="text/javascript">
    function upload_image()
      {
      // var bar = $('#progressbar1');
      // var percent = $('#percent');
      $('#upload-form').ajaxForm({
          beforeSubmit: function() {
            // document.getElementById("upload-progress").style.display="block";
            var percentVal = '0%';
            // bar.width(percentVal)
            // percent.html(percentVal);
          },

          uploadProgress: function(event, position, total, percentComplete) {
            // console.log(percentComplete);
            var percentVal = percentComplete + '%';
            // bar.width(percentVal)
            // percent.html(percentVal);
          },

        success: function() {

            var percentVal = '100%';
            // bar.width(percentVal)
            // percent.html(percentVal);
          },

          complete: function(xhr) {
            if(xhr.responseText)
            {
              $('#image-preview').show();
              $('#heading').hide();
              $('.alert').show();
              console.log(JSON.parse(xhr.responseText));
              var result = JSON.parse(xhr.responseText);

              $('#result').html('<h3 class="text-white">'+result[0]+','+result[1]+'</h3>');

              document.getElementById("image-preview").innerHTML= '<img src="'+result[2]+'" class="img-thumbnail">';
            }
          }
        });
      }
    </script>
  </body>
</html>
