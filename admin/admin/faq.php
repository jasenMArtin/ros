<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>FAQ's</title>
</head>
<body class="bg-gray-100 p-6">
    <h2 class="text-2xl text-center text-gray-700 mb-6">Frequently Asked Questions</h2>

    <!-- FAQ Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead>
                <tr class="bg-orange-600 ">
                    <th class="p-4 border-b">Question</th>
                    <th class="p-4 border-b">Answer</th>
                    <th class="p-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody id="faqTableBody" class="text-gray-700">
                <tr class="hover:bg-gray-100">
                    <td class="p-4 border-b">Where is your restaurant located?</td>
                    <td class="p-4 border-b">We are located at Gullas Drive, Banilad, Cebu</td>
                    <td class="p-4 border-b text-center">
                        <button class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 edit" data-id="01">Edit</button>
                        <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 delete" data-id="01">Delete</button>
                    </td>
                </tr>
            </tbody>

            
        </table>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 w-full max-w-lg">
            <span id="closeModal" class="absolute top-2 right-4 text-gray-500 text-2xl cursor-pointer">&times;</span>
            <form id="editForm">
                <div class="mb-4">
                    <label for="editQuestion" class="block text-gray-700">Question</label>
                    <input type="text" id="editQuestion" name="question" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="editAnswer" class="block text-gray-700">Answer</label>
                    <input type="text" id="editAnswer" name="answer" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="flex justify-end">
                    <button type="button" id="saveEdit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../js/faq.js"></script>
    

</body>

</html>
