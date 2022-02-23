<html>
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/wishForm.css') }}">
  <script>
    function submitWish(){
      let wish = document.querySelector('.wish').value;
      document.cookie = "privacy = " + document.theForm.privacy.value
      document.cookie = "wish = " + wish
    }
  </script>
  </head>
  <body>
  @include('header')
  <div class="tab-content">
    <div class="tab-pane fade show active">

      <form style="margin-top:200px" action="/submitWish" onsubmit="submitWish()" name="theForm">
        <h2 style="text-align:center">願いを作成中</h2>
        <br>

        <div class="form-outline mb-4">
          <label class="form-label">願いの内容</label>
          <textarea class="wish form-control" style="width:100%; height:150px"  ></textarea>
          <br>
          
        </div>

        

        <div>
          <div >

            <div class="">
              <p>公開設定</p>
              &nbsp;<input type="radio" id="open" name="privacy" value="1" checked="checked">
              &nbsp;<label for="open">公開</label><br>
              &nbsp;<input type="radio" id="closed" name="privacy" value="0">
              &nbsp;<label for="closed">限定公開</label><br>  
            </div>
          </div>

        </div>
        <br>

        <!-- Submit button -->
        <button style="text-align:center" type="submit" class="btn btn-primary btn-block mb-4">投稿する</button>

      </form>
    </div>
  </div>
  </body>
</html>