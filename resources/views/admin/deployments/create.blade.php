<x-app-layout>
  <x-slot name="title">Admin</x-slot>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800 font-poppins">
      <a href="#!" onclick="window.history.go(-1); return false;">
        ← Back
      </a>
    </h2>
  </x-slot>

  <div class="py-12 font-poppins">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 bg-white rounded-xl">
            <h1 class="mb-10 text-2xl font-medium">Add Data Deployment</h1>
            <form action="{{ route('admin.deployments.store') }}" method="POST">
              @csrf

              <div class="grid grid-cols-2 gap-16">
                  <div>
                    <!-- Title -->
                    <div class="mb-4">
                        <label for="title" class="block mb-2 text-sm font-bold text-gray-600">Title:</label>
                        <input type="text" id="title" name="title" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" value="{{ old('title') }}" required>
                    </div>

                    <!-- Module ID -->
                    <div class="mb-4">
                        <label for="module_id" class="block mb-2 text-sm font-bold text-gray-600">Module:</label>
                        <select id="module_id" name="module_id" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                        <option value="">-- Pilih Module --</option>
                        @foreach($modules as $module)
                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                        @endforeach
                        </select>
                    </div>

                    <!-- Server Type ID -->
                    <div class="mb-4">
                        <label for="server_type_id" class="block mb-2 text-sm font-bold text-gray-600">Server Type:</label>
                        <select id="server_type_id" name="server_type_id" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                        </select>
                    </div>

                    <!-- Deploy Date -->
                    <div class="mb-4">
                        <label for="deploy_date" class="block mb-2 text-sm font-bold text-gray-600">Deploy Date:</label>
                        <input type="date" id="deploy_date" name="deploy_date" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" value="{{ old('deploy_date') }}" required>
                    </div>
                  </div>

                  <div>
                    <!-- Document Status -->
                    <div class="mb-4">
                        <label for="document_status" class="block mb-2 text-sm font-bold text-gray-600">Document Status:</label>
                        <select id="document_status" name="document_status" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                            <option value="not done">Not Done</option>
                            <option value="in progress">In Progress</option>
                            <option value="done">Done</option>
                        </select>
                    </div>

                    <!-- Document Description -->
                    <div class="mb-4">
                        <label for="document_description" class="block mb-2 text-sm font-bold text-gray-600">Document Description:</label>
                        <textarea id="document_description" name="document_description" rows="4" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required></textarea>
                    </div>

                    <!-- CM Status -->
                    <div class="mb-4">
                        <label for="cm_status" class="block mb-2 text-sm font-bold text-gray-600">CM Status:</label>
                        <select id="cm_status" name="cm_status" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required>
                        <option value="draft">Draft</option>
                        <option value="in progress">In Progress</option>
                        <option value="done">Done</option>
                        </select>
                    </div>

                    <!-- CM Description -->
                    <div class="mb-4">
                        <label for="cm_description" class="block mb-2 text-sm font-bold text-gray-600">CM Description:</label>
                        <textarea id="cm_description" name="cm_description" rows="4" class="block w-full px-4 py-3 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" required></textarea>
                    </div>
                  </div>
              </div>

              <button type="submit" class="px-24 py-2 font-bold text-white rounded-full bg-primary">
                Submit Data
              </button>

            </form>
        </div>
    </div>
  </div>

    <x-slot name="script">
        <script>
            // Make sure the DOM is fully loaded
            document.addEventListener('DOMContentLoaded', function() {
                // Attach the event listener
                document.getElementById('module_id').addEventListener('change', function() {
                    var selectedModule = this.value;

                    // Fetch data from the server
                    fetch(`/api/modules/${selectedModule}/server-types`, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            // Other headers here
                        },
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        var serverTypeSelect = document.getElementById('server_type_id');
                        serverTypeSelect.innerHTML = '';

                        data.forEach(function(serverType) {
                            var option = new Option(serverType.name, serverType.id);
                            serverTypeSelect.appendChild(option);
                        });
                    });
                });
            });
        </script>
    </x-slot>



</x-app-layout>
