@extends('layouts.app')

@section('title', 'Blog | Subhadip Chakraborty')

@section('head')
<!-- Quill Editor -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
@endsection

@section('content')
<main class="flex-grow pt-28 pb-28">
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="flex flex-wrap -m-4" id="blog-body">
                <!-- Blogs will be rendered here by JS -->
            </div>
        </div>
    </section>
</main>

<!-- Modal Backdrop -->
<div id="modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 h-screen w-screen">
    <!-- Modal Box -->
    <div class="bg-white w-full max-w-[60vw] max-h-[80vh] rounded-2xl shadow-xl p-6 flex flex-col relative">
        <!-- Close Button -->
        <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            ✕
        </button>
        <!-- Modal Header -->
        <h2 class="text-xl font-semibold text-gray-800 mb-4" id="modal-title">
            Modal Title
        </h2>
        <!-- Modal Body (SCROLLABLE) -->
        <div id="modal-body" class="flex-1 overflow-y-auto text-gray-600 mb-4 pr-2">
        </div>
        <!-- Modal Footer -->
        <div class="flex justify-end gap-3 border-t pt-4">
            <button onclick="closeModal()" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300">
                Cancel
            </button>
            <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                Confirm
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openModal() {
        document.getElementById('modal').classList.remove('hidden');
        document.getElementById('modal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('modal').classList.add('hidden');
        document.getElementById('modal').classList.remove('flex');
    }

    const ENDPOINT = "https://cloud.appwrite.io/v1";
    const PROJECT_ID = "696ccb6f0007553e40a1";
    const DATABASE_ID = "696ccbff00241ca8d15c";
    const COLLECTION_ID = "blogs";
    const BUCKET_ID = "696cd04d00122e691fb4";

    async function fetchBlogs() {
        try {
            const res = await fetch(
                `${ENDPOINT}/databases/${DATABASE_ID}/collections/${COLLECTION_ID}/documents`, {
                    method: "GET",
                    mode: "cors",
                    headers: {
                        "X-Appwrite-Project": PROJECT_ID,
                    },
                }
            );

            const data = await res.json();
            if (!res.ok) {
                console.error("Appwrite error:", data);
                return;
            }
            renderBlogs(data.documents);
        } catch (error) {
            console.error("Fetch error:", error);
        }
    }

    function imageUrl(fileId, width = 400) {
        return `${ENDPOINT}/storage/buckets/${BUCKET_ID}/files/${fileId}/preview?width=${width}&project=${PROJECT_ID}`;
    }

    function renderBlogs(blogs) {
        const blogContainer = document.getElementById("blog-body");
        blogContainer.innerHTML = "";

        for (const blog of blogs) {
            let detailUrl = "{{ route('blog.show', ['id' => ':id']) }}".replace(':id', blog.$id);
            let thumbnail = blog.thumbnail ? imageUrl(blog.thumbnail) : blog.thumbnail_url;
            
            let html = ` 
                <div class="p-4 md:w-1/3">
                  <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
                    <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="${thumbnail}" alt="blog">
                    <div class="p-6">
                      <h2 class="tracking-widest text-xs title-font font-medium text-gray-400 mb-1">${blog.category || 'Tech'}</h2>
                      <h1 class="title-font text-lg font-medium text-gray-900 mb-3">${new Date(blog.$createdAt).toLocaleDateString()}</h1>
                      <p class="leading-relaxed mb-3">${blog.title}</p>
                      <div class="flex items-center flex-wrap ">
                        <a href="${detailUrl}" class="text-indigo-500 inline-flex items-center md:mb-2 lg:mb-0">Learn More
                          <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5l7 7-7 7"></path>
                          </svg>
                        </a>
                        <span class="text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200">
                          <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                          </svg>1.2K
                        </span>
                        <span class="text-gray-400 inline-flex items-center leading-none text-sm">
                          <svg class="w-4 h-4 mr-1" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                            <path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"></path>
                          </svg>6
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              `;
            blogContainer.innerHTML += html;
        }
    }

    fetchBlogs();
</script>
@endpush
