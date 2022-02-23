</body>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

    <title>Signin Template for Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
      <script>

          function validateForm() {
          // document.cookie = "username = " + null
          //   document.cookie = "password = " + null

            let username = document.querySelector('.username').value;
            let password = document.querySelector('.password').value;

            document.cookie = "username = " + username
            document.cookie = "password = " + password
              
              
            } 

          
      </script>
  </head>

  <body class="text-center">

    
        @include('header')

        <form class="form-signin" style="margin-top: 250px;" action="/loginConfirm"   onsubmit="validateForm()">
          <h1 class="h3 mb-3 font-weight-normal">ログイン</h1>
          <br>

          <?php if (isset($_COOKIE["warning"])) {
                echo '<span style="color:red">'. $_COOKIE["warning"]  . "</span>";
          }?>

          <br><br>
          

          <input type="text" id="inputEmail" class="form-control username" placeholder="ユーザーネーム" required autofocus>
          <input type="password" id="inputPassword" class="form-control password" placeholder="パスワード" required>
          <br><br>
         
          

         
        <button class=" button1 btn btn-lg btn-success btn-block" type="submit"  >ログイン</button>
        
          <br><br>
          
          <button class=" button1 btn btn-lg btn-danger btn-block" onclick="window.location.href = './reset'"  >パスワードを忘れた方は</button>
          <!-- <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p> -->
        </form>

    
  </body>
</html>