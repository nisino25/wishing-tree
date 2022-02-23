<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">

  <script>

    function remove(id,content){
      newLine = "\r\n"
      msg = "Wish ID No."+ id + ': `' + content + '`'
      msg += newLine;
      msg += 'を削除してもよろしいでしょうか？'
      if (window.confirm(msg)) {
        window.location.href = './remove?id=' + id
      }
      console.log('sup: ' +id)
    }
  </script>

</head>
<body>
  @include('header')
  <h1 style="text-align:center; margin-top: 20px">マイページ</h1>

  <div>
    <div>
      <img src="{{$picLink}}">
      <strong style="margin-left:1%; font-size:150%">{{$username}}</strong>
    </div>
    <hr>
    
      <?php
        $count = -1;
        $idCount =0;
        echo '<div class="row">';

        foreach($wishes as $index=>$wish){
          if($id == $wishes[$index]['user_id'] && $wish['is_deleted'] == 1 ){
            $count++;
            $idCount++;
            if($count % 3== 0) {
              echo '</div > <br> <br>';
              echo '<div class="row">';
            }
            echo '<div  class="card col-5" style="width: 30%; border-color:orange; margin-left:3%">
              <div class="card-body">
                <h5> No. '. $idCount. '</h5>
                <span class="card-title">' . $wishes[$index]['content'] .'</span><br><br>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">'. $wishes[$index]['created_at'] .'</li>
                <li class="list-group-item">Wish ID No.'. $wish['id'] .'</li>
                <li class="list-group-item">願いがある木のID: No.'. $wishes[$index]['tree_id'] .'</li>
                <li class="list-group-item">公開設定:';
                if($wishes[$index]['is_private'] == 1){
                  echo '　公開';
                }else{
                  echo '　非公開';
                }
                echo '
              </li></ul>
              <div class="card-body">
                <a onclick="remove('. $wish['id'] .',`' . $wish['content'] .'`)" class="btn-outline-danger btn ">削除</a>
              </div>
            </div>';
          }
            
        }
        echo '</div>';
      ?>

    </div>

    
</div>
  </div>

  

</body>