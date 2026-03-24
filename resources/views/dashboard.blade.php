<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-4">Bem-vindo, {{ auth()->user()->name }}!</p>

                    <!-- Formulário para criar novo post -->
                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Criar Novo Post</h3>
                        <form method="POST" action="{{ route('posts.store') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-900">Título</label>
                                <input type="text" id="title" name="title" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500" required>
                                @error('title')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="content" class="block text-sm font-medium text-gray-900">Conteúdo</label>
                                <textarea id="content" name="content" rows="4" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                                @error('content')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="category" class="block text-sm font-medium text-gray-900">Categoria</label>
                                <input type="text" id="category" name="category" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm text-gray-900 placeholder-gray-500 focus:border-indigo-500 focus:ring-indigo-500">
                                @error('category')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4 flex items-center space-x-4">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="published" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-600">Publicar imediatamente</span>
                                </label>
                                <button type="submit" name="action" value="postar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Postar</button>
                            </div>

                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Criar Post</button>
                        </form>
                    </div>

                    <h3 class="text-lg font-semibold mb-4">Seus Posts</h3>

                    <div class="space-y-4">
                        @php $posts = auth()->user()?->posts ?? collect(); @endphp
                        @forelse($posts as $post)
                            <div class="border-b pb-4">
                                <div class="flex justify-between items-center mb-2">
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

                                <!-- Comentários -->
                                <div class="mt-4">
                                    <h5 class="text-sm font-semibold text-gray-700">Comentários ({{ $post->comments->count() }})</h5>
                                    @forelse($post->comments as $comment)
                                        <div class="bg-gray-100 p-2 rounded mt-2">
                                            <p class="text-sm">{{ $comment->content }}</p>
                                            <p class="text-xs text-gray-500">Por {{ $comment->user->name ?? 'Anônimo' }} em {{ $comment->created_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    @empty
                                        <p class="text-sm text-gray-500 mt-2">Nenhum comentário ainda.</p>
                                    @endforelse

                                    <!-- Formulário para adicionar comentário -->
                                    <form method="POST" action="{{ route('comments.store', $post) }}" class="mt-2">
                                        @csrf
                                        <textarea name="content" rows="2" class="w-full border-gray-300 rounded-md shadow-sm" placeholder="Adicione um comentário..."></textarea>
                                        <button type="submit" class="mt-1 bg-blue-500 hover:bg-blue-700 text-black py-1 px-3 rounded text-sm">Comentar</button>
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
