@extends('layouts.app')

@section('content')
    <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            <h1 class=" text-6xl ">
                Update post
            </h1>
        </div>
    </div>
    <!--edit post-->
    @if ($errors->any())
        <div class="w-4/5 m-auto">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl px-2 py-4">
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="w-4/5 m-auto pt-20">
        <form action="/blog/{{$post->slug}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="text" name="title" value="{{$post->title}}" class="bg-transparent block border-b-2 w-full h-20 text-6xl px-2 py-3 outline-none">
            <div class="form-group pt-6">
                <label for="categories" class="block text-lg font-medium text-gray-700">Select Categories:</label>
                <select name="categories[]" id="categories" class="form-control select2 block mt-1 w-full" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ in_array($category->id, old('categories', isset($post) ? $post->categories->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <textarea name="description" placeholder="Description.." class="bg-white block border-2 border-black w-full h-60 px-2 py-3 text-xl outline-none">{{ old('description', $post->description) }}</textarea>
            <button type="submit" class="uppercase mt-15 bg-blue-500 text-gray-100 text-lg font-extra-bold py-4 px-8 rounded-3xl">
                Submit Post
            </button>
        </form>
    </div>
    <script>
    $(document).ready(function() {
        $('#categories').select2({
            placeholder: "Select categories",
            allowClear: true
        });
    });
</script>
@endsection
