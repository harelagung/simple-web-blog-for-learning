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
<main class="pt-1 pb-16 lg:pt-1 lg:pb-24 antialiased">
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
                                class="{{ $post->category->color }} text-gray-600 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded {{ $post->category->color }} dark:text-gray-800 hover:font-extrabold hover:text-gray-800">
                                {{ $post->category->name }} Category
                            </span>
                        </a>
                        <p class="text-base text-gray-500 dark:text-gray-400">
                            {{ $post->created_at->locale('en')->isoformat('D MMMM YYYY') }}</p>
                    </div>
        </article>
    </div>
    <div class="flex justify-between items-center px-5 mb-5">
        <div class="flex items-center space-x-3 sm:space-x-4">
            <a href="/dashboard/edit/{{ $post->slug }}"
                class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 cursor-pointer">
                <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                    <path fill-rule="evenodd"
                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                        clip-rule="evenodd" />
                </svg>
                Edit
            </a>
            <button type="button" data-modal-target="deleteModal-{{ $post->id }}"
                data-modal-toggle="deleteModal-{{ $post->id }}"
                class="inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900 cursor-pointer">
                <svg aria-hidden="true" class="w-5 h-5 mr-1.5 -ml-1" fill="currentColor" viewbox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                Delete
            </button>
        </div>
        <!-- Delete modal -->
        <div id="deleteModal-{{ $post->id }}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <button type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="deleteModal-{{ $post->id }}">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want
                        to delete this item?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button data-modal-toggle="deleteModal-{{ $post->id }}" type="button"
                            class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                            cancel</button>
                        <form action="/dashboard/{{ $post->slug }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit"
                                class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">Yes,
                                I'm sure</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="px-5">
        <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">
            {{ $post->title }}</h1>

        <div class="text-gray-900 post-content">
            {!! $post->body !!}
        </div>
    </div>
    <div class="mt-20 px-5">
        <a href="/dashboard" class="font-medium text-md text-blue-500 hover:underline">&laquo; Back to all
            posts</a>

    </div>
</main>
