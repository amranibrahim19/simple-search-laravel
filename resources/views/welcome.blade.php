<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Live Search Laravel</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .fade-in {
      animation: fadeIn 0.3s ease-in;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
  <div class="container mx-auto px-4 py-8 max-w-7xl">
    <!-- Header -->
    <div class="text-center mb-8 fade-in">
      <h1 class="text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 mb-3">
        Simple Live Search Laravel
      </h1>
      <p class="text-gray-600 text-lg">Search users by name, email, or status</p>
    </div>

    <!-- Search Form -->
    <div class="flex justify-center mb-8 fade-in">
      <form id="search-form" class="w-full max-w-3xl">
        @csrf
        <div class="bg-white rounded-xl shadow-lg p-6">
          <div class="flex flex-wrap items-center gap-3">
            <div class="flex-grow relative">
              <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
              <input 
                id="search" 
                type="text" 
                name="q" 
                class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" 
                placeholder="Search by Name, Email, or Status..."
                autocomplete="off"
              >
            </div>
            <button 
              type="submit" 
              id="search-btn"
              class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all shadow-md hover:shadow-lg font-semibold"
            >
              Search
            </button>
            <button 
              type="button" 
              id="clear-btn"
              class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition-all font-semibold"
            >
              Clear
            </button>
          </div>
          <!-- Loading Indicator -->
          <div id="loading" class="hidden mt-4 text-center">
            <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
            <span class="ml-2 text-gray-600">Searching...</span>
          </div>
        </div>
      </form>
    </div>

    <!-- Results Section -->
    <div class="bg-white shadow-xl rounded-xl overflow-hidden fade-in">
      <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-5">
        <div class="flex justify-between items-center">
          <h2 class="text-2xl font-semibold">Users Directory</h2>
          <span id="result-count" class="bg-white bg-opacity-20 px-4 py-1 rounded-full text-sm font-medium">
            {{ $users->total() }} users
          </span>
        </div>
      </div>
      
      <div class="overflow-x-auto">
        <table id="result-table" class="w-full text-left border-collapse">
          <thead class="bg-gray-50 border-b-2 border-gray-200">
            <tr>
              <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
              <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
              <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
              <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">IC No</th>
              <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
              <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">Email Verified</th>
            </tr>
          </thead>
          <tbody id="result-body" class="bg-white divide-y divide-gray-200">
            @foreach ($users as $user)
            <tr class="hover:bg-blue-50 transition-colors duration-150">
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->id }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $user->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->ic_no ?? 'N/A' }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                  {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                  {{ $user->status ?? 'N/A' }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                {{ $user->email_verified_at ? \Carbon\Carbon::parse($user->email_verified_at)->format('M d, Y') : 'Not verified' }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- No Results Message -->
      <div id="no-result" class="hidden p-12 text-center">
        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Results Found</h3>
        <p class="text-gray-500">Try adjusting your search terms or clear the search to see all users.</p>
      </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
      {{ $users->links() }}
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      const $searchForm = $('#search-form');
      const $searchInput = $('#search');
      const $resultTable = $('#result-table');
      const $resultBody = $('#result-body');
      const $noResult = $('#no-result');
      const $loading = $('#loading');
      const $resultCount = $('#result-count');
      const $clearBtn = $('#clear-btn');

      // Store original table content
      const originalTableContent = $resultBody.html();
      const originalCount = "{{ $users->total() }}";

      function performSearch(searchTerm) {
        if (!searchTerm.trim()) {
          resetTable();
          return;
        }

        $loading.removeClass('hidden');
        $resultTable.addClass('hidden');
        $noResult.addClass('hidden');

        const formData = {
          search_input: searchTerm,
        };

        $.ajax({
          type: "POST",
          url: "{{ route('search') }}",
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: formData,
          dataType: "json",
        })
        .done(function(data) {
          $loading.addClass('hidden');
          
          // Clear previous results
          $resultBody.empty();

          // Check if data is valid array
          if (Array.isArray(data) && data.length > 0 && data[0] !== "Sorry no data") {
            $resultTable.removeClass('hidden');
            $noResult.addClass('hidden');
            $resultCount.text(data.length + ' result' + (data.length !== 1 ? 's' : ''));

            data.forEach(item => {
              const statusClass = item.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800';
              const verifiedDate = item.email_verified_at 
                ? new Date(item.email_verified_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })
                : 'Not verified';
              
              const row = `
                <tr class="hover:bg-blue-50 transition-colors duration-150">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.id}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">${item.name || 'N/A'}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${item.email || 'N/A'}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${item.ic_no || 'N/A'}</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}">
                      ${item.status || 'N/A'}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${verifiedDate}</td>
                </tr>
              `;
              $resultBody.append(row);
            });
          } else {
            $resultTable.addClass('hidden');
            $noResult.removeClass('hidden');
            $resultCount.text('0 results');
          }
        })
        .fail(function() {
          $loading.addClass('hidden');
          $resultTable.addClass('hidden');
          $noResult.removeClass('hidden');
          $resultCount.text('Error');
        });
      }

      function resetTable() {
        $resultBody.html(originalTableContent);
        $resultTable.removeClass('hidden');
        $noResult.addClass('hidden');
        $resultCount.text(originalCount + ' users');
      }

      // Form submit handler
      $searchForm.on('submit', function(e) {
        e.preventDefault();
        const searchTerm = $searchInput.val().trim();
        performSearch(searchTerm);
      });

      // Clear button handler
      $clearBtn.on('click', function() {
        $searchInput.val('');
        resetTable();
        $searchInput.focus();
      });

      // Optional: Live search as you type (debounced)
      let searchTimeout;
      $searchInput.on('input', function() {
        clearTimeout(searchTimeout);
        const searchTerm = $(this).val().trim();
        
        if (searchTerm.length >= 2) {
          searchTimeout = setTimeout(function() {
            performSearch(searchTerm);
          }, 500); // Wait 500ms after user stops typing
        } else if (searchTerm.length === 0) {
          resetTable();
        }
      });

      // Enter key to search
      $searchInput.on('keypress', function(e) {
        if (e.which === 13) {
          e.preventDefault();
          $searchForm.submit();
        }
      });
    });
  </script>
</body>

</html>