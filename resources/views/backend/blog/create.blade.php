@extends('layouts.backend.main')

@section('title', 'MyBlog | Add new Post')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Blog
            <small>Add new Post</small>
          </h1>
          <ol class="breadcrumb">
            <li>
                <a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i>Dashboard</a>
            </li>
            <li>
                <a href="{{ route('blog.index') }}">Blog</a>
            </li>
            <li class="active">New Post</li>
          </ol>
        </section>
    
        <!-- Main content -->
        <section class="content">
            <div class="row">
              {!! 
                  Form::model($post, [
                      'method' => 'POST',
                      'route' => 'blog.store',
                      'files' => TRUE,
                      'id' => 'post-form'
                  ])
              !!}

              @include('backend.blog.form')

              {!! Form::close() !!}
            </div>
          <!-- ./row -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endsection

@include('backend.blog.script')