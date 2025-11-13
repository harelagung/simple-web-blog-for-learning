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
    {{-- <article class="py-8 max-w-screen-md text-white">
        <div class="text-base text-gray-300">
            <a href="/authors/{{ $post->author->username }}" class="hover:underline">{{ $post->author->name }}</a> | <a
                href="/categories/{{ $post->category->slug }}" class="hover:underline">{{ $post->category->name }}</a> |
            {{ $post['created_at']->locale('id')->isoformat('D MMMM YYYY') }}
        </div>
        <p class="my-4 font-light text-gray-300">{{ $post['body'] }}</p>
        <a href="/posts" class="font-medium text-blue-300 hover:underline">&laquo; Back to all
            posts</a>
    </article> --}}

    <!--
Install the "flowbite-typography" NPM package to apply styles and format the article content:

URL: https://flowbite.com/docs/components/typography/
-->

    <main class="pt-1 pb-16 lg:pt-1 lg:pb-24 bg-gray-900 dark:bg-gray-900 antialiased">
        <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
            <article
                class="mx-auto w-full max-w-7xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">

                <header class="my-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <a href="/posts?author={{ $post->author->username }}" rel="author"
                                class="text-xl font-bold hover:underline text-gray-900 dark:text-white">
                                <img class="mr-4 w-16 h-16 rounded-full"
                                    src="{{ $post->author->avatar ? asset('storage/' . $post->author->avatar) : asset('img/default-avatar.png') }}"
                                    alt="{{ $post->author->name }}">
                                <div>
                                    {{ $post->author->name }}
                            </a>
                            <a href="/posts?category={{ $post->category->slug }}"
                                class="text-gray-200 hover:underline block my-0.5">
                                <span
                                    class="{{ $post->category->color }} text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded {{ $post->category->color }} dark:text-gray-800">
                                    {{ $post->category->name }} Category
                                </span>
                            </a>
                            <p class="text-base text-gray-500 dark:text-gray-400">
                                {{ $post->created_at->locale('en')->isoformat('D MMMM YYYY') }}</p>
                        </div>
                    </address>
                    <h1
                        class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
                        {{ $post->title }}</h1>
                </header>
                <div class="text-gray-100 post-content mb-10">
                    {!! $post->body !!}
                </div>
                <a href="/posts" class="font-medium text-sm text-blue-300 hover:underline">&laquo; Back to all
                    posts</a>
            </article>
        </div>
    </main>
</x-layout>
