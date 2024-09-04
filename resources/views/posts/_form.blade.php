@php
    $isCreate = !$post->exists;
    $actionUrl = $isCreate ? '/posts' : '/posts/' . $post->id;
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $actionUrl }}" method="post">
    @csrf
    @if (!$isCreate)
        {{-- action 不支援 put 所以透過 laravel 的 _method 來達到 put 的效果 --}}
        <input type="hidden" name="_method" value="put">
    @endif

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ $post->title }}">
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <select class="form-control" name="category_id">
            <option selected value>Please select a category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if ($post->category_id == $category->id) selected @endif>
                    {{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="tags">Tags</label>
        <input type="text" class="form-control" name="tags" value="{{ $post->tagsString() }}">
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea id="content" class="form-control" name="content" rows="8" cols="80">{{ $post->content }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
</form>
