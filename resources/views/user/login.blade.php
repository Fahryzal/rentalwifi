<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Wifi Rental</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <br/>
    <br/>
    <div class="d-flex align-items-center justify-content-center">
      <form class="w-px-400 border rounded p-3 p-md-5"  method="post" action="{{url('user/authenticate')}}">
        @csrf
        <h3 class="mb-4">Masuk</h3>

        <div class="mb-3">
          <label class="form-label" for="form-alignment-username">Email</label>
          <input type="text" name="email" type="email" id="form-alignment-username" class="form-control" placeholder="naruto@gmail.com">
        </div>

        <div class="mb-3 form-password-toggle">
          <label class="form-label" for="form-alignment-password">Password</label>
          <div class="input-group input-group-merge">
            <input type="password" name="password" id="form-alignment-password" class="form-control" placeholder="············" aria-describedby="form-alignment-password2">
            <span class="input-group-text cursor-pointer" id="form-alignment-password2"><i class="bx bx-hide"></i></span>
          </div>
        </div>
       
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
  </body>
</html>
