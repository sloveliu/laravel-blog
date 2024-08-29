@php
    $isCreate = !$category->exists;
    $actionUrl = $isCreate ? '/categories' : '/categories/' . $category->id;
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
        <label for="nameInput">Name</label>
        <input type="text" class="form-control" name="name" id="nameInput" value="{{ $category->name }}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
</form>
