@extends('layout.admin')
@section('title', isset($post) ? 'Редактировать статью' : 'Добавить статью')
@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ isset($post) ? 'Редактировать статью' : 'Добавить статью' }}</h3>
        <div class="mt-8">
        </div>
        <div class="mt-8">
            <form action="{{ isset($post) ? route('admin.posts.update', $post->id) : route('admin.posts.store')}}" class="space-y-5 mt-5" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <input type="text" name="title" class="w-full h-12 border border-gray-800 rounded px-3 @error('title') border-red-500 @enderror" placeholder="Название" value="{{ $post->title ?? null }}"/>
                @error('title')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <input type="text" name="preview" class="w-full h-12 border border-gray-800 rounded px-3 @error('preview') border-red-500 @enderror" placeholder="Краткое описание" value="{{ $post->preview ?? null }}"/>
                @error('preview')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <input type="text" name="description" class="w-full h-12 border border-gray-800 rounded px-3 @error('description') border-red-500 @enderror" placeholder="Описание" value="{{ $post->description ?? null }}"/>
                @error('description')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                @if(isset($post) && $post->thumbnail)
                    <div>
                        <img class="h-64 w-64" src="/storage/posts/{{ $post->thumbnail }}">
                    </div>
                @endif
                <input type="file" name="thumbnail" class="w-full h-12" placeholder="Обложка" />
                @error('thumbnail')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection