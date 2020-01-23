@section('script')
    <script>
        $('#title').on('blur', function() {
          var title = this.value.toLowerCase().trim();
          var slugInput = $('#slug');
          var slug = title.replace(/&/g, '-and-')
                          .replace(/[^a-z0-9-]+/g, '-')
                          .replace(/\-\-+/g, '-')
                          .replace(/^-+|-+$/g, '');

          slugInput.val(slug);
        });
    </script>
@endsection
