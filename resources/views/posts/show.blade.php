<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4 text-sm text-gray-600">Por {{ $post->user->name }} em {{ $post->published_at->format('d/m/Y') }}
                        @if($post->category) - Categoria: {{ $post->category }} @endif
                    </p>

                    <div class="mb-6 prose max-w-none">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    @auth
                        @if($post->user_id == auth()->id())
                            <a href="{{ route('posts.edit', $post) }}" class="px-4 py-2 mr-2 font-bold text-white bg-yellow-500 rounded hover:bg-yellow-700">Editar</a>
                            <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline" onsubmit="return confirm('Tem certeza?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 font-bold text-white bg-red-500 rounded hover:bg-red-700">Deletar</button>
                            </form>
                        @endif
                    @endauth

                    <hr class="my-6">

                    <h3 class="mb-4 text-lg font-semibold">Comentários</h3>

                    @auth
                        <form method="POST" action="{{ route('comments.store', $post) }}" class="mb-6">
                            @csrf
                            <textarea name="content" rows="3" placeholder="Adicione um comentário..." required class="block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                            @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
                            <button type="submit" class="px-4 py-2 mt-2 font-bold text-black bg-blue-500 rounded hover:bg-blue-700">Comentar</button>
                        </form>
                    @else
                        <p class="text-gray-600">Faça <a href="{{ route('login') }}" class="text-blue-600">login</a> para comentar.</p>
                    @endauth

                    <div class="space-y-4">
                        @forelse($post->comments as $comment)
                            <div class="pl-4 border-l-4 border-gray-300">
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
