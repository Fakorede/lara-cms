@if (session('message'))
    <div class="alert alert-info">
        {{ session('message') }}
    </div>
@elseif (session('error-message'))
    <div class="alert alert-danger">
        {{ session('error-message') }}
    </div>
@elseif(session('trash-message'))
    <?php list($message, $postId) = session('trash-message') ?>
    {!! Form::open([
        'method' => 'PUT',
        'route' => ['blog.restore', $postId]
        ]) 
        !!}
        <div class="alert alert-info">
            {{ $message }}
            <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-undo"></i>Restore</button>
        </div>
    {!! Form::close() !!}
@endif