<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Live Search Laravel</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900">
  <div class="container mx-auto p-5">
    <h1 class="text-4xl font-bold text-center text-blue-600 my-10">
      Simple Live Search Laravel
    </h1>

    <!-- Search Form -->
    <div class="flex justify-center">
      <form id="search-form" action="{{route('result')}}" method="POST" class="w-full max-w-2xl">
        @csrf
        <div class="flex flex-wrap items-center gap-4">
          <input id="search" type="text" name="q" class="flex-grow p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Search by Name or Email">
          <button type="submit" class="px-5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            Search
          </button>
        </div>
      </form>
    </div>

    <!-- Search Results -->
    <div class="mt-10 bg-white shadow-lg rounded-lg">
      <div class="bg-blue-600 text-white rounded-t-lg p-4">
        <h2 class="text-xl font-semibold text-center">Search Result</h2>
      </div>
      <div class="p-6">
        <table id="result-table" class="table-auto w-full text-left border-collapse border border-gray-200 hidden">
          <thead class="bg-gray-100 text-gray-700">
            <tr>
              <th class="border border-gray-300 px-4 py-2">ID</th>
              <th class="border border-gray-300 px-4 py-2">Name</th>
              <th class="border border-gray-300 px-4 py-2">Email</th>
              <th class="border border-gray-300 px-4 py-2">IC No</th>
              <th class="border border-gray-300 px-4 py-2">Status</th>
              <th class="border border-gray-300 px-4 py-2">Email Verified At</th>
            </tr>
          </thead>
          <tbody id="result-body" class="text-gray-800"></tbody>
        </table>
        <p id="no-result" class="text-gray-500 text-center hidden">No results found.</p>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $('#search-form').on('submit', function (e) {
      e.preventDefault();

      const input = document.getElementById("search").value;

      const formData = {
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
      }).done(function (data) {
        const resultTable = document.getElementById("result-table");
        const resultBody = document.getElementById("result-body");
        const noResult = document.getElementById("no-result");

        // Clear previous results
        resultBody.innerHTML = "";

        if (data.length > 0) {
          resultTable.classList.remove("hidden");
          noResult.classList.add("hidden");

          data.forEach(item => {
            const row = `
              <tr class="border-t border-gray-200 hover:bg-gray-100">
                <td class="border border-gray-300 px-4 py-2">${item.id}</td>
                <td class="border border-gray-300 px-4 py-2">${item.name}</td>
                <td class="border border-gray-300 px-4 py-2">${item.email}</td>
                <td class="border border-gray-300 px-4 py-2">${item.ic_no}</td>
                <td class="border border-gray-300 px-4 py-2">${item.status}</td>
                <td class="border border-gray-300 px-4 py-2">${item.email_verified_at}</td>
              </tr>
            `;
            resultBody.insertAdjacentHTML("beforeend", row);
          });
        } else {
          resultTable.classList.add("hidden");
          noResult.classList.remove("hidden");
        }
      });
    });
  </script>
</body>

</html>
