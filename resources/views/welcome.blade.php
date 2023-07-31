<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link rel="stylesheet" href="{{asset('css/main.css')}}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <style>
    .added {
      padding: 20px;
      margin-top: 20px;
      background: green;
      color: white;
      display: inline-block;
    }
  </style>

</head>

<body>
  <div class="container">
    <h1 class="text-center mt-5">
      Simple Live Search Laravel
    </h1>

    <div class="d-flex justify-content-center mt-5">
      <form id="search-form" action="{{route('result')}}" method="POST">
        @csrf
        <div class="row">
          <div class="col-md-8">
            <input id="search" type="text" name="q" class="form-control" placeholder="Name or Email" />
          </div>
          <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Search</button>
          </div>
        </div>
      </form>
    </div>

    <div class="card mt-3">
      <div class="card-header text-center">
        <h1>Search Result</h1>
      </div>
      <div class="card-body">
        <pre id="result"></pre>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $('#search-form').on('submit', function(e) {
      e.preventDefault();

      const input = document.getElementById("search").value;

      var formData = {
        search_input: input,
      };

      $.ajax({
        type: "POST",
        url: "{{route('search')}}",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        dataType: "json",
        encode: true
      }).done(function(data) {
        document.getElementById("result").textContent = JSON.stringify(data, undefined, 2);
        console.log(data)
      });

    });
  </script>
</body>

</html>