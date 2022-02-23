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

        function sendToUrl(){
          url_string =location.href
          url = new URL(url_string);
          let username = url.searchParams.get("username");

          first = document.querySelector('#first_secret').value;
          second = document.querySelector('#second_secret').value;
          window.location =  '/resetConfirm?first_secret=' + first + '&second_secret='+ second + '&username=' + username;
        }

        </script>
  </head>

  <body class="text-center">
  @include('header')

        <form class="form-signin" onsubmit="sendToUrl(); return false">
          <h1 class="h3 mb-3 font-weight-normal">パスワード再発行</h1>
          <br>
          <h5>
            <?php
              if(isset($_GET['username'])){
                echo $_GET['username'] . 'のパスワードをリセット中';
              }
            ?>
          </h5>
          <span style="color:red;">
            <?php
              if(isset($_GET['warning'])){
                echo $_GET['warning'];
              }
            ?>
          </span>
          <br><br>
          <input type="" id="first_secret" class="form-control" placeholder="母親の旧姓は？" required autofocus>
          <input type="" id="second_secret" class="form-control" placeholder="出生地は？" required autofocus>
          
          
          <br>
          <br>
          <button href="reset" class="btn btn-lg btn-danger btn-block button1" type="submit">次へ</button>
          <!-- <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p> -->
        </form>
    
  </body>
</html>