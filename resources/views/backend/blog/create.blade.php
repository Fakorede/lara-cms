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
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-body ">
                    {!! 
                        Form::model($post, [
                            'method' => 'POST',
                            'route' => 'blog.store'
                        ])
                    !!}

                        <div class="form-group">
                            {!! Form::label('title') !!}
                            {!! Form::text('title', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('slug') !!}
                            {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('excerpt') !!}
                            {!! Form::textarea('excerpt', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('body') !!}
                            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('published_at', 'Publication Date') !!}
                            {!! Form::text('published_at', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('category_id', 'Category') !!}
                            {!! Form::select('category_id', App\Category::pluck('title', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Choose Category']) !!}
                        </div>

                        <hr>

                        {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>
          <!-- ./row -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
@endsection

@section('script')
    <script>
        $('ul.pagination').addClass('no-margin pagination-sm');
    </script>
@endsection
