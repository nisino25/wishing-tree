<head>
  <!-- <link href="../css/header.css" rel="stylesheet" > -->
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <script>
    function logout(){
      if (window.confirm("ログアウトしますか？")) {
        window.location.href = './logout'
      }
    }
  </script>
</head>
<body>
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="text-muted" href="/">Wishing Tree</a>
        <?php if (isset($_COOKIE["is_logined"])) {
            echo ' &nbsp;&nbsp<span class=" " style="margin-right:20px">ようこそ  ' .  $_COOKIE['username']. 'さん !</span>';
        }?>

      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="btn btn-sm btn-outline-secondary" style="margin-right:20px" href="trees">木を見る</a>
        <?php if (isset($_COOKIE["is_logined"])) {
              echo '<a class="btn btn-sm btn-outline-secondary" style="margin-right:20px" href="wishForm">願いを作成</a><a class="btn btn-sm btn-outline-secondary" style="margin-right:20px" href="mypage">マイページ</a>
              <a class="btn btn-sm btn-outline-secondary" style="margin-right:20px" href="#" onclick="logout()" >ログアウト</a>';
        }?>

        <?php if (!isset($_COOKIE["is_logined"])) {
              echo '<a class="btn btn-sm btn-outline-secondary" href="login" style="margin-right:20px">ログイン</a>
              <a class="btn btn-sm btn-outline-secondary" href="signup">サインアップ</a>';
        }?>
      
      

        
      </div>
    </div>
    <!-- <hr> -->
  </header>
  
</body>