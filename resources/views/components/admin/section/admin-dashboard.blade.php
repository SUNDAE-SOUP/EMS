<x-admin.header />
    <x-admin.sidebar />
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-dashed rounded-lg dark:border-gray-700 mainContent">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex items-center justify-center h-24 rounded dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                       My Expenses
                    </p>
                </div>
                
                <div class="flex items-center justify-center h-24 rounded dark:bg-gray-800">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            Dashboard
                        </li>
                    </ol>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-4 h-200" id="divTablePie">
                <div class="flex justify-center rounded h-90">
                @if (session('warning'))
                    <div id="alert-2" class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 .alertWindow" role="alert">
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ml-3 text-sm font-medium">
                            Oops!. {{ session('warning') }}.
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                @endif
                @if (session('success'))
                    <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ml-3 text-sm font-medium">
                    {{ session('success') }}.
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                    </div>
                @endif
                    <div class="relative w-full overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 rounded-l-lg">
                                        Expense Categories
                                    </th>
                                    <th scope="col" class="px-6 py-3 rounded-r-lg">
                                        Total
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="data-table">
                                @if ($expensesByCategory->isEmpty())
                                    <p>No expenses available.</p>
                                @endif
                                @foreach ($expensesByCategory as $expense)
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $expense->expense_category->expense_category_name }}
                                    </th>
                                    
                                    <td class="px-6 py-4">
                                        {{ $expense->totalAmount }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>

                </div>
                <div class="flex items-center justify-center rounded h-200 dark:bg-gray-800">
                    <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                        <!-- Line Chart -->
                        <div class="py-6" id="pie-chart"></div>
                        
                    </div>
                </div>
                
            </div>

            <div class="justify-center rounded h-90 divTablet">
                    
                <div class="relative w-full overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 rounded-l-lg">
                                    Expense Categories
                                </th>
                                <th scope="col" class="px-6 py-3 rounded-r-lg">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody id="data-table">
                            @if ($expensesByCategory->isEmpty())
                                <p>No expenses available.</p>
                            @endif
                            @foreach ($expensesByCategory as $expense)
                                <tr class="bg-white dark:bg-gray-800">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $expense->expense_category->expense_category_name }}
                                    </th>
                                    
                                    <td class="px-6 py-4">
                                        {{ $expense->totalAmount }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>

            </div>
            <div class="items-center rounded h-100 dark:bg-gray-800 divTablet" >
                <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                    <!-- Line Chart -->
                    <div class="py-6" id="pie-chart2"></div>
                    
                </div>
            </div>
            
        </div>
    </div>

<x-admin.footer />