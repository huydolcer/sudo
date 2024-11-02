<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mx-auto mt-8">
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto bg-white shadow-lg rounded-lg">
                <thead class="bg-gray-100 border-b-2 border-gray-300">
                    <tr>
                        <th class="py-3 px-4 text-left text-gray-700 font-semibold uppercase tracking-wider">ID</th>
                        <th class="py-3 px-4 text-left text-gray-700 font-semibold uppercase tracking-wider">Image</th>
                        <th class="py-3 px-4 text-left text-gray-700 font-semibold uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Example row -->
                    @foreach($images as $file)
                    <tr class="hover:bg-gray-50 transition duration-200 ease-in-out">
                        <td class="py-4 px-4 text-gray-600">{{ $file->id }}</td>
                        <td class="py-4 px-4">
                            <img src="{{ $file->path }}" alt="Image" class="h-16 w-16 object-cover rounded-md shadow-sm">
                        </td>
                        <td class="py-4 px-4">
                            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200 ease-in-out">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                    <!-- Repeat rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>