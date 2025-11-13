@push('style')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <style>
        /* Atur tinggi container Quill */
        #editor {
            height: 250px;
            /* atau sesuaikan dengan kebutuhan */
        }

        /* Atur tinggi area editable dan scroll */
        #editor .ql-editor {
            min-height: 100px;
            max-height: 225px;
            overflow-y: auto;
        }

        /* Styling untuk container Quill */
        #editor .ql-container {
            border-radius: 0 0 0.5rem 0.5rem;
        }

        #editor .ql-toolbar {
            border-radius: 0.5rem 0.5rem 0 0;
        }
    </style>
@endpush

<!-- Modal content -->
<div class="relative p-4 bg-white rounded-lg border dark:bg-gray-800 sm:p-5">
    <!-- Modal header -->
    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Post</h3>
    </div>
    <form action="/dashboard/update/{{ $post->slug }}" method="POST" id="post-form">
        @csrf
        @method('patch')
        <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <div>
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                <input type="text" name="title" id="title"
                    class="@error('title') bg-red-50 border-red-50 border-red-500 text-red-900 placeholder-red-700  focus:ring-red-500 focus:border-red-500 @enderror bg-gray-50 capitalize border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Type post title" autofocus value="{{ old('title', $post->title) }}">
                @error('title')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500 text-xs">{{ $message }}</p>
                @enderror

            </div>
            <div>
                <label for="category"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label><select
                    id="category" name="category"
                    class="@error('category') bg-red-50 border-red-50 border-red-500 text-red-700 placeholder-red-700  focus:ring-red-500 focus:border-red-500 @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option selected='' value="">Select post category</option>
                    @foreach ($category as $c)
                        <option value="{{ $c->id }}" @selected(old('category', $post->category->id) == $c->id)>{{ $c->name }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>
            <div class="sm:col-span-2">
                <label for="description"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post</label>
                <textarea name='body' id="body"
                    class="hidden @error('body') bg-red-50 border-red-50 border-red-500 text-red-900 placeholder-red-700  focus:ring-red-500 focus:border-red-500 @enderror block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Write post body ...">{{ old('body', $post->body) }}</textarea>

                {{-- QUILLJS EDITOR --}}
                <div id="editor"
                    class="@error('body') bg-red-50 border-red-50 border-red-500 text-red-900 placeholder-red-700  focus:ring-red-500 focus:border-red-500 @enderror block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                </div>

                @error('body')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex space-x-4">
            <button type="submit"
                class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 cursor-pointer">
                <svg class="mr-1 -ml-1 w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                        clip-rule="evenodd" />
                </svg>

                Update post
            </button>
            <a href="/dashboard"
                class="inline-flex items-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900 cursor-pointer">
                Cancel
            </a>
        </div>
    </form>
</div>

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: '   Write post here ...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    ['blockquote', 'code-block'],
                    [{
                        'header': 1
                    }, {
                        'header': 2
                    }],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    [{
                        'script': 'sub'
                    }, {
                        'script': 'super'
                    }],
                    [{
                        'indent': '-1'
                    }, {
                        'indent': '+1'
                    }],
                    [{
                        'direction': 'rtl'
                    }],
                    [{
                        'size': ['small', false, 'large', 'huge']
                    }],
                    [{
                        'header': [1, 2, 3, 4, 5, 6, false]
                    }],
                    [{
                        'color': []
                    }, {
                        'background': []
                    }],
                    [{
                        'align': []
                    }],
                    ['clean'],
                    ['link']
                ]
            }
        });

        quill.root.innerHTML = {!! json_encode(old('body', $post->body ?? '')) !!};

        const postForm = document.querySelector('#post-form');
        const postBody = document.querySelector('#body');
        const quillEditor = document.querySelector('#editor');

        postForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const content = quillEditor.children[0].innerHTML;
            postBody.value = content;

            this.submit();
        });
    </script>
@endpush
