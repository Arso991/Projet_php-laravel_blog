@extends("layout.master")
@section("title","Blog")

@section("content")
    <section class="mt-5 text-center p-5">
        @include('includes.header')
    </section>
    <section>
        @include('includes.blog_list')
        <a href="{{ route('printBlog') }}" target="blank" class="btn btn-primary text-center">Imprimer les blogs</a>
    </section>
@endsection
    