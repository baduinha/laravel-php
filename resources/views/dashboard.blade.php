<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Bem-vindo, {{ auth()->user()->name }}!</p>

                    <a href="{{ route('posts.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">Criar Novo Post</a>

                    <h3 class="text-lg font-semibold mb-4">Seus Posts</h3>

                    <div class="space-y-4">
                        @php $posts = auth()->user()?->posts ?? collect(); @endphp
                        @forelse($posts as $post)
                            <div class="border-b pb-4 flex justify-between items-center">
                                <div>
                                    <h4 class="font-semibold"><a href="{{ route('posts.show', $post) }}" class="text-blue-600">{{ $post->title }}</a></h4>
                                    <p class="text-sm text-gray-600">
                                        Status: {{ $post->isPublished() ? 'Publicado em ' . $post->published_at->format('d/m/Y') : 'Rascunho' }}
                                        @if($post->category) - Categoria: {{ $post->category }} @endif
                                    </p>
                                </div>
                                <div>
                                    <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded text-sm mr-2">Editar</a>
                                    <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline" onsubmit="return confirm('Tem certeza?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded text-sm">Deletar</button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p>Você ainda não criou nenhum post.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
