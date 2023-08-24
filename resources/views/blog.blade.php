@extends("layout.master")
@section("title","Blog")

@section("content")
    <section class="mt-5 text-center p-5">
        @include('includes.header')
    </section>
    <section>
        @include('includes.blog_list')
    </section>
@endsection
    