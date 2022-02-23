<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
  @include('header')
  <div class="container">
    <img src="https://www.eyalohana.com/wp-content/uploads/2018/07/shiTree-projection-01.jpg" alt="Avatar">
    
    <h5>これまでに{{$totalUsers}}人のユーザーからの{{$totalWishes}}個の願いによって
      {{$totalTrees-1}}本の木が植えられました</h5>
    
    
    <br>
    <a href="activity" class="btn btn-primary" style="margin-right:5%">実際の活動</a>
    <a href="trees" class="btn btn-success">過去の願い達を見る</a>
    <br>
    
      

  </div>

</body>