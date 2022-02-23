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

        function jump(){
          window.location.href = '/createUser';
        }
      

        function deletingConfirmation(num) {   
            let text = 'id No.' + num + ' を削除しますか？' ;
            
            if (confirm(text) == true) {

                window.location = (`./delete.php?id="${num}"`) 
            } else {
                text = "You canceled!";
            }
            // document.getElementById("demo").innerHTML = text;
        }

        var number = 0

        function buttonClick(num){
          number = num
          document.getElementById("img1").classList.remove('selected');
          document.getElementById("img2").classList.remove('selected');
          document.getElementById("img3").classList.remove('selected');
          document.getElementById("img4").classList.remove('selected');

          document.getElementById("img1").classList.add('notSelected');
          document.getElementById("img2").classList.add('notSelected');
          document.getElementById("img3").classList.add('notSelected');
          document.getElementById("img4").classList.add('notSelected');
          if(num ==1){

            document.getElementById("img1").classList.add('selected');
            document.getElementById("img1").classList.remove('notSelected');
            
          }else if(num == 2){

            document.getElementById("img2").classList.add('selected');
            document.getElementById("img2").classList.remove('notSelected');
          }else if(num ==3){

            document.getElementById("img3").classList.add('selected');
            document.getElementById("img3").classList.remove('notSelected');
          }else{

            document.getElementById("img4").classList.add('selected');
            document.getElementById("img4").classList.remove('notSelected');
          }
        }  



        function validateForm() {
            document.cookie = "username = " + null
            document.cookie = "password = " + null
            document.cookie = "firstQuestion = " + null
            document.cookie = "secondQuestion = " + null
            document.cookie = "picnum = " + null
            document.cookie = "validation = " + 0


            let username  = document.querySelector('.username').value;
            let password1 = document.querySelector('.password1').value;
            let password2 = document.querySelector('.password2').value;
            let first_secret = document.querySelector('.first_secret').value;
            let second_secret = document.querySelector('.second_secret').value;
            var picnum = number

            let flag = true;
            let warning = ''

            

            if(password2 !== password1){
              flag =false;
              document.cookie = "validation = " + 1
              warning = warning + 'パスワードは同じ物を2回タイプしてください' + '\n';
            }


            if(picnum == 0 ){
              flag =false;
              warning = warning +  'アバター写真をお選びください'
            }

           

            // if(!flag) alert(`${warning}`);
            if(!flag){

              alert(`${warning}`)
              return
            }else{
              document.cookie = "username = " + username
              document.cookie = "password = " + password1
              document.cookie = "first_secret = " + first_secret
              document.cookie = "second_secret = " + second_secret
              document.cookie = "picnum = " + picnum
              document.cookie = "warning = " + warning
              document.cookie = "validation = " + 0
              return
              
              
            }
            
          } 

        </script>
  </head>

  <body class="text-center">

    
        @include('header')

        <form class="form-signin" style="margin-top: 200px;" action="/createUser"   onsubmit="validateForm()">
          <h1 class="h3 mb-3 font-weight-normal">サインアップ</h1>
          <span style="color:red;">
            <?php
              if(isset($_GET['warning'])){
                echo $_GET['warning'];
              }
            ?>
          </span>
          <br><br>

          <input type="text" id="inputEmail" class="form-control username" placeholder="ユーザーネーム" required autofocus>
          <input type="password" id="inputPassword" class="form-control password1" placeholder="パスワード" required>
          <input type="password" id="inputPassword" class="form-control password2" placeholder="パスワード再入力" required>
          <input type="text" id="inputEmail" class="form-control first_secret" placeholder="母親の旧姓は？" required autofocus>
          <input type="text" id="inputEmail" class="form-control second_secret" placeholder="出生地は？" required autofocus>
          <br>
          <span>アバターをお選びください</span>
          

          <ul id="galleries">
            <li >
                <a onclick="buttonClick(1)"><img id="img1" class="notSelected" src="{{$links[0]['link']}}"></a> 
            </li>
            <li >
                <a onclick="buttonClick(2)"><img id="img2" class="notSelected" src="{{$links[1]['link']}}"></a>
            </li>
            <li >
                <a onclick="buttonClick(3)"><img id="img3" class="notSelected" src="{{$links[2]['link']}}"></a>
            </li>
            <li >
                <a onclick="buttonClick(4)"><img id="img4" class="notSelected"  src="{{$links[3]['link']}}"></a>
            </li>
          </ul>
        <button class=" button1 btn btn-lg btn-success btn-block" type="submit"  >サインアップ</button>
          <br>
          
          <!-- <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p> -->
        </form>
    
  </body>
</html>