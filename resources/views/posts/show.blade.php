<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="text-sm text-gray-600 mb-4">Por {{ $post->user->name }} em {{ $post->published_at->format('d/m/Y') }}
                        @if($post->category) - Categoria: {{ $post->category }} @endif
                    </p>

                    <div class="prose max-w-none mb-6">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    @auth
                        @if($post->user_id == auth()->id())
                            <a href="{{ route('posts.edit', $post) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">Editar</a>
                            <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline" onsubmit="return confirm('Tem certeza?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Deletar</button>
                            </form>
                        @endif
                    @endauth

                    <hr class="my-6">

                    <h3 class="text-lg font-semibold mb-4">Comentários</h3>

                    @auth
                        <form method="POST" action="{{ route('comments.store', $post) }}" class="mb-6">
                            @csrf
                            <textarea name="content" rows="3" placeholder="Adicione um comentário..." required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                            @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
                            <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Comentar</button>
                        </form>
                    @else
                        <p class="text-gray-600">Faça <a href="{{ route('login') }}" class="text-blue-600">login</a> para comentar.</p>
                    @endauth

                    <div class="space-y-4">
                        @forelse($post->comments as $comment)
                            <div class="border-l-4 border-gray-300 pl-4">
                                <p class="text-sm text-gray-600">{{ $comment->user->name }} em {{ $comment->created_at->format('d/m/Y H:i') }}</p>
                                <p>{{ $comment->content }}</p>
                            </div>
                        @empty
                            <p class="text-gray-600">Nenhum comentário ainda.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
