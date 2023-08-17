<x-admin.header />
    <x-admin.sidebar />

    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mainContent">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex items-center justify-center h-24 rounded dark:bg-gray-800">
                    <p class="text-2xl text-gray-400 dark:text-gray-500">
                        Users
                    </p>
                </div>
                
                <div class="flex items-center justify-center h-24 rounded dark:bg-gray-800">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            User Management
                        </li>
                        <li>
                            <div class="flex items-center">
                              <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                              </svg>
                              <a href="#" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Users</a>
                            </div>
                        </li>
                    </ol>
                </div>
            </div>
            <div class="flex items-center justify-center mb-4 rounded bg-gray-50 dark:bg-gray-800 overflow-x-auto">
                
                <div class="w-full overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Display name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created at
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($updateUsers as $updateUser)
                                <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $updateUser->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $updateUser->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $updateUser->role->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $updateUser->created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                    <a href="">
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
                    <button type="button" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Add Role</button>
                </div>
                
                <div id="roleUpdateModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700" id="modalContent">
                            <a href="{{route('admin.userTab')}}">
                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </a>
                            <div class="px-6 py-6 lg:px-8" id="modalPlate">
                                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Update User</h3>
                                <form method="POST" class="space-y-6" action="{{route('userAdmin.update', $user->id)}}">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Display Name</label>
                                        <input type="name" value="{{$user->name}}" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                    </div>
                                    <div>
                                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                        <input type="email" value="{{$user->email}}" name="email" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                    </div>
                                    <div>
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                                        <select name="role_id" id="role_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" @if ($user->role_id == $role->id) selected @endif>
                                                {{ $role->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <button type="submit" id="updateButton" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update</button>
                                    
                                    
                                </form>
                                <form method="POST" action="{{route('userAdmin.softDelete', $user->id)}}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 deletebtn">Delete</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>

<x-admin.footer />