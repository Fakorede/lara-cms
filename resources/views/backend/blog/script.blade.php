@section('script')
    <script>
        $('ul.pagination').addClass('no-margin pagination-sm');

        $('#title').on('blur', function() {
          var title = this.value.toLowerCase().trim();
          var slugInput = $('#slug');
          var slug = title.replace(/&/g, '-and-')
                          .replace(/[^a-z0-9-]+/g, '-')
                          .replace(/\-\-+/g, '-')
                          .replace(/^-+|-+$/g, '');

          slugInput.val(slug);
        });

        var simplemde1 = new SimpleMDE({ element: $("#excerpt")[0] });
        var simplemde2 = new SimpleMDE({ element: $("#body")[0] });

        $('#published_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            showClear: true
        });

        $('#draft-btn').click(function(e) {
            e.preventDefault();
            $('#published_at').val("");
            $('#post-form').submit();
        });
    </script>
@endsection
