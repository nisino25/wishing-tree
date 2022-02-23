<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/trees.css') }}">
</head>
<body>
  @include('header')
  <h1 style="text-align:center; margin-top: 20px">過去の願い達</h1>

  <div>
    <hr>
    
      <?php
        $count = -1;
        $idCount = 0;
        echo '<div class="row">';

        foreach($trees  as $index=>$tree){
            $count++;
            $idCount++;
            $wisheArray= json_decode($trees[$index]['wishes'], true);
            if($count % 3== 0) {
              echo '</div > <br> <br>';
              echo '<div class="row">';
            }

            
            
            echo '<div  class="card col-5" style=" width: 30%; border-color:green; margin-left:3%">
            <img src="' . asset("img/tree.png") . '">
              <div class="card-body" >
                
                <h5 class="card-title">No.'. $tree['id'] .'</h5>
                <h6 style="float:right">' .  sizeof($wisheArray). '/10</h6>'  .'

              </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">'. $trees[$index]['created_at'] .'</li>
                  <li class="list-group-item">Wishes IDs: <br>'. $trees[$index]['wishes'] .'<br></li>
                </ul>
              <div class="card-body">
                <a href="/treeDetail?treeId='  . $tree['id'].'"  class="btn-outline-secondary btn ">詳細</a>
              </div>
              
            </div>';
          }
           
        echo '</div>';
      ?>

    </div>
    <br><br><br>

    
</div>
  </div>

  

</body>