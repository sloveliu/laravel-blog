@extends('layouts.app')

@section('page-title')
    <section class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="text-uppercase">Edit Category</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a>
                        </li>
                        <li class="breadcrumb-item"><a href="/categories">Blog Admin Panel</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('content')
    <div class="page-content">
        <div class="container">
            @include('categories._form', ['category' => $category])
        </div>
    </div>
@endsection
