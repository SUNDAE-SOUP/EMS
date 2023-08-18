<x-admin.header />
    <x-admin.user-sidebar />
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mainContent">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="items-center justify-center h-24 rounded dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        Expenses
                    </p>
                </div>
                
                
                
            </div>
            <div class="flex items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-800 overflow-x-auto">
                
                <div class="w-full overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email Address
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Entry Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created at
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $expense)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $expense->expense_category->expense_category_name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $expense->amount }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $expense->entry_date }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $expense->created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('expense.edit', ['expense' => $expense]) }}">
                                            <button type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                                Edit
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex items-center justify-center rounded h-28 dark:bg-gray-800">
                    
                </div>
                <div class="flex items-center justify-center rounded h-28 dark:bg-gray-800">
                    <button data-modal-target="addRole-modal" data-modal-toggle="addRole-modal" type="button" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Add Expense</button>
                </div>
                <div id="addRole-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="addRole-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="px-6 py-6 lg:px-8">
                                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Add Expense</h3>
                                <form method="POST" class="space-y-6" action="/expenses/store">
                                    @csrf
                                    <div>
                                        <label for="expense_category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expense Category</label>
                                        <select name="expense_category_id" id="expense_category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                            @foreach ($expenseCategories as $expenseCategory)
                                            <option value="{{ $expenseCategory->id }}">
                                                {{ $expenseCategory->expense_category_name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount <Address></Address></label>
                                        <input type="number" name="amount" id="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                    </div>
                                    <div>
                                        <label for="entry_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                        <input type="date" name="entry_date" id="entry_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                    </div>
                                    
                                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
<x-admin.footer />