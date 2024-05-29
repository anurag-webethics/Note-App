<x-app-layout>
    @section('title')
        View Note
    @endsection
    <html>

    <head>
        <title>Note app</title>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="title" class="form-control" value="{{ $note->title }}"
                                disabled readonly />
                            @error('title')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label><strong>Description :</strong></label>

                            <textarea class="summernote" name="description">
                                    {{-- @if ($note->note_type == 'public')
                                    @php echo $note->share_link . '<br><br>' @endphp
                                    @endif --}}
                                    {{ $note->description }}
                                </textarea>
                            @error('description')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.summernote').summernote('disable');
            });
        </script>
    </body>

    </html>

</x-app-layout>
