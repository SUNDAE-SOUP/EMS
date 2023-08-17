<x-admin.header />
    <x-admin.user-sidebar />
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