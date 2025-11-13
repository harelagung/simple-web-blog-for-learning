@push('style')
    <style>
        .post-content {
            line-height: 1.6;
        }

        .post-content h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            margin-top: 1.5rem;
        }

        .post-content h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            margin-top: 1.25rem;
        }

        .post-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            margin-top: 1rem;
        }

        .post-content p {
            margin-bottom: 1rem;
        }

        .post-content strong {
            font-weight: 700;
        }

        .post-content em {
            font-style: italic;
        }

        .post-content u {
            text-decoration: underline;
        }

        .post-content ul,
        .post-content ol {
            margin-left: 2rem;
            margin-bottom: 1rem;
        }

        .post-content li {
            margin-bottom: 0.5rem;
        }

        .post-content blockquote {
            border-left: 4px solid #e5e7eb;
            padding-left: 1rem;
            margin: 1rem 0;
            color: #5c626d;
            font-style: italic;
        }

        .post-content a {
            color: #2563eb;
            text-decoration: underline;
        }

        .post-content code {
            background-color: #f3f4f6;
            padding: 0.2rem 0.4rem;
            border-radius: 0.25rem;
            font-family: monospace;
            font-size: 0.875rem;
        }

        .post-content pre {
            background-color: #1f2937;
            color: #f9fafb;
            padding: 1rem;
            border-radius: 0.5rem;
            overflow-x: auto;
            margin-bottom: 1rem;
        }

        .post-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            margin: 1rem 0;
        }
    </style>
@endpush
<x-layout :title='$title' :header='$header'>
    {{-- @foreach ($posts as $post)
        <article class="py-8 max-w-screen-md text-white border-b border-gray-700">
            <a href="/posts/{{ $post->slug }}">
                <h2 class="mb-1 text-3xl hover:underline tracking-tight font-bold text-gray-100">{{ $post->title }}
                </h2>
            </a>
            <div class="text-base text-gray-400">
                By <a href="/authors/{{ $post->author->username }}"
                    class="text-gray-200 hover:underline">{{ $post->author->name }}</a>
                in <a href="/categories/{{ $post->category->slug }}"
                    class="text-gray-200 hover:underline">{{ $post->category->name }}</a>
                |
                {{ $post['created_at']->locale('id')->isoFormat('D MMMM YYYY') }}
            </div>
            <p class="my-4 font-light text-gray-300">{{ Str::limit($post['body'], 100) }}</p>
            <a href="/posts/{{ $post['slug'] }}" class="font-medium text-blue-300 hover:underline">Read More &raquo;</a>
        </article>
    @endforeach --}}

    <div class="py-4 px-4 mx-auto max-w-screen-xl lg:px-6">

        {{-- <form class="mb-8 max-w-md mx-auto">
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if (request('author'))
                <input type="hidden" name="author" value="{{ request('author') }}">
            @endif
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search" name="search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search post title..." autocomplete="off" autofocus />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form> --}}
        {{ $posts->links() }}
        <div class="mt-4 mb-8 grid gap-8 lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1">
            @forelse ($posts as $post)
                <article
                    class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-5 text-gray-500">
                        <a href="/posts?category={{ $post->category->slug }}" class="text-gray-200 hover:underline">
                            <span
                                class="{{ $post->category->color }} text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded {{ $post->category->color }} dark:text-gray-800">
                                {{ $post->category->name }}
                            </span>
                        </a>
                        <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"><a
                            href="/posts/{{ $post->slug }}" class="hover:underline">{{ $post->title }}</a></h2>
                    <div class="mb-5 font-light text-gray-500 dark:text-gray-400 post-content">{!! Str::limit($post['body'], 75) !!}
                    </div>
                    <div class="flex justify-between items-center">
                        <a href="/posts?author={{ $post->author->username }}">
                            <div class="flex items-center space-x-4">
                                <img class="w-7 h-7 rounded-full"
                                    src="{{ $post->author->avatar ? asset('storage/' . $post->author->avatar) : asset('img/default-avatar.png') }}"
                                    alt="{{ $post->author->name }}" />
                                <span class="font-medium text-xs dark:text-white hover:underline">
                                    {{ $post->author->name }}
                                </span>
                            </div>
                        </a>
                        <a href="/posts/{{ $post->slug }}"
                            class="inline-flex items-center font-medium text-xs text-blue-300 dark:text-blue-300 hover:underline">
                            Read more
                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </article>
            @empty
                <div>
                    <p class="font-semibold text-4xl my-4 text-gray-200">Data not found!</p>
                    <a href="/posts" class="block text-blue-500 hover:underline">&laquo; Back to all posts</a>
                </div>
            @endforelse
        </div>
        <div class="mb-4">
            {{ $posts->links() }}</div>
    </div>

</x-layout>
