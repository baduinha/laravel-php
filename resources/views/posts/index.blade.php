<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Search and Filter -->
                    <form method="GET" class="mb-6 flex gap-4">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por título..." class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <select name="category" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Todas as categorias</option>
                            @foreach($posts->pluck('category')->unique()->filter() as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buscar</button>
                    </form>

                    @auth
                        <a href="{{ route('posts.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Criar Novo Post</a>
                    @endauth

                    <div class="space-y-4">
                        @forelse($posts as $post)
                            <div class="border-b pb-4">
                                <h3 class="text-lg font-semibold"><a href="{{ route('posts.show', $post) }}" class="text-blue-600 hover:text-blue-800">{{ $post->title }}</a></h3>
                                <p class="text-sm text-gray-600">Por {{ $post->user->name }} em {{ $post->published_at->format('d/m/Y') }}
                                    @if($post->category) - Categoria: {{ $post->category }} @endif
                                </p>
                                <p class="mt-2">{{ Str::limit($post->content, 200) }}</p>
                            </div>
                        @empty
                            <p>Nenhum post encontrado.</p>
                        @endforelse
                    </div>

                    {{ $posts->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
