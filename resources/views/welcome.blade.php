<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="colorlib.com">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,600,700" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  </head>
  <body>
    <div class="s009">
        
      <form action="/search" method="POST" role="search">
        {{ csrf_field() }}
        <div class="inner-form">
          <div class="basic-search">
            <div class="input-field">
              <input id="search" type="text" name="q"  placeholder="No Kad Pengenalan" />
              <div class="icon-wrap">
                <button type="submit" class="btn btn-default">
                    <span class="fa fa-search"></span>
                </button>
              </div>
            </div>
          </div>
          <div class="advance-search">
            <span class="desc">Result</span>
            @if(isset($details))
            <p> The Search results for your query <b> {{ $query }} </b> are :</p>
        <h2>Sample User details</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($details as $semakan)
                <tr>
                    <td>{{$semakan->name}}</td>
                    <td>{{$semakan->status}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
          </div>
        </div>
      </form>

      <form>
        <div class="inner-form">
          
          
        </div>
      </form>
    </div>
    <script src="js/extention/choices.js"></script>
    <script>
      const customSelects = document.querySelectorAll("select");
      const deleteBtn = document.getElementById('delete')
      const choices = new Choices('select',
      {
        searchEnabled: false,
        itemSelectText: '',
        removeItemButton: true,
      });
      deleteBtn.addEventListener("click", function(e)
      {
        e.preventDefault()
        const deleteAll = document.querySelectorAll('.choices__button')
        for (let i = 0; i < deleteAll.length; i++)
        {
          deleteAll[i].click();
        }
      });

    </script>
  </body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
