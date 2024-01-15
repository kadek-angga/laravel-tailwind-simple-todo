<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Todos') }}
        </h2>
    </x-slot>

    <div class="lg:w-2/4 mx-auto my-10 py-12 px-6 bg-white rounded-xl">
        <h1 class="font-bold text-5xl text-center mb-8">{{ __('Laravel Tailwind Todo') }}</h1>
        <div class="mb-6">
            <form class="flex flex-col space-y-4" method="POST" action="{{ route('todos.store') }}">
                @csrf
                <input type="text" name="title" placeholder="Title" class="py-3 px-4 bg-gray-100 rounded-xl">
                <textarea name="description" placeholder="Description" class="py-3 px-4 bg-gray-100 rounded-xl"></textarea>
                <button type="submit" class="py-3 px-4 bg-blue-500 text-white rounded-xl">Add</button>
            </form>
        </div>

        <hr>
        
        <div class="mt-2">
            @foreach ($todos as $todo)    
                <div @class([
                        'py-4 flex item-center border-b border-gray-300 px-3', 
                        $todo->is_done ? 'bg-green-200' : ''
                    ])
                >
                    <div class="flex-1 pr-8">
                        <h3 @class([
                                "text-lg font-semibold",
                                $todo->is_done ? 'line-through' : ''
                        ])>
                            {{ $todo->title }}
                        </h3>
                        <p @class([
                            "text-gray-500",
                            $todo->is_done ? 'line-through' : ''
                        ])
                        >
                            {{ $todo->description }}
                        </p>
                    </div>
                    
                    <div class="flex space-x-3">
                        <form method="POST" action="{{ route('todos.update', $todo->id) }}">
                            @csrf
                            @method('PATCH')

                            <button class="py-2 px-2 bg-green-500 text-white rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z" clip-rule="evenodd" />
                                </svg>                                                           
                            </button>
                        </form>


                        <form method="POST" action="{{ route('todos.destroy', $todo->id) }}">
                            @csrf
                            @method('DELETE')

                            <button class="py-2 px-2 bg-red-500 text-white rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z" clip-rule="evenodd" />
                                </svg>                                                        
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>