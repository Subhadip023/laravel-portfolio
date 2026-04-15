@extends('layouts.app')

@section('title', 'Blog Details | Subhadip Chakraborty')

@section('content')
<main class="flex-grow pt-28 pb-28" id="blog-details">
    <!-- Blog details will be rendered here by JS -->
</main>
@endsection

@push('scripts')
<script>
    const ENDPOINT = "https://cloud.appwrite.io/v1";
    const PROJECT_ID = "696ccb6f0007553e40a1";
    const DATABASE_ID = "696ccbff00241ca8d15c";
    const COLLECTION_ID = "blogs";
    const BUCKET_ID = "696cd04d00122e691fb4";
    const DOCUMENT_ID = "{{ $id }}";

    async function fetchSinglePost(DOCUMENT_ID) {
        try {
            const res = await fetch(
                `${ENDPOINT}/databases/${DATABASE_ID}/collections/${COLLECTION_ID}/documents/${DOCUMENT_ID}`, {
                    headers: {
                        "X-Appwrite-Project": PROJECT_ID
                    }
                }
            );

            const data = await res.json();
            if (!res.ok) {
                console.error("Appwrite error:", data);
                return;
            }

            let thumbnail = data.thumbnail ? (data.thumbnail.startsWith('http') ? data.thumbnail : `${ENDPOINT}/storage/buckets/${BUCKET_ID}/files/${data.thumbnail}/preview?project=${PROJECT_ID}`) : data.thumbnail_url;

            let html = `<section class="text-gray-600 body-font">
                <div class="container mx-auto flex px-5 py-24 items-center justify-left flex-col text-left">
                    <img class=" lg:w-2/3 w-full mb-10 object-cover object-left rounded" alt="${data.title}" src="${thumbnail}">
                    <div class="text-justify lg:w-2/3 w-full">
                        <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">${data.title}</h1>
                        <div class="prose max-w-none">
                            ${data.description}
                        </div>
                        <div class="flex justify-start mt-5">
                            <a href="{{ route('home') }}" class="inline-flex text-white bg-blue-500 border-0 py-2 px-6 focus:outline-none hover:bg-blue-600 rounded text-lg">Home</a>
                            <a href="{{ route('blog.index') }}" class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">Blogs</a>
                        </div>
                    </div>
                </div>
            </section>`;
            document.getElementById("blog-details").innerHTML = html;
        } catch (error) {
            console.error("Fetch error:", error);
        }
    }

    fetchSinglePost(DOCUMENT_ID);
</script>
@endpush
