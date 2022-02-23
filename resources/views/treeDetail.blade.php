<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/treeDetail.css') }}">
</head>

<body>
  @include('header')

  <div class="card" style="width: 25%; position: absolute;top: 45%;left: 50%;-ms-transform: translateX(-50%) translateY(-50%);-webkit-transform: translate(-50%,-50%);transform: translate(-50%,-50%); border-color:green ">
    <div class="card-body">
      <h5 class="card-title">Tree No. {{$treeId}}</h5>
      <p class="card-text" style="float:right">
        <?php
          echo $time;
        ?>  
      に作成</p>
    </div>
    <ul class="list-group list-group-flush">
      <?php
        $count =0;

        foreach($treeWishes as $index=>$wish){
          $count++;
          $wishId = (int)$wish;
          foreach($wishes as $index=>$actualWish){
            if($wishId== $actualWish['id']){
              if($actualWish['is_private'] ==1){
                echo '<li class="list-group-item">' .$count . ': '. $actualWish['content']. '</li>';
              }else{
                echo '<li class="list-group-item">' .$count . ': 限定公開</li>';
              }
            }
          }
          // $wishid = (int)$wish;
          // 
        }
      ?>
    </ul>
    <div class="card-body">
      <a href="trees" class="btn btn-primary">戻る</a>
    </div>
  </div>

</body>
</html>