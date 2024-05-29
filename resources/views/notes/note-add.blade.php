<x-app-layout>
    @section('title')
        Add Note
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
                        <form method="POST"
                            action="{{ isset($note) ? route('note.update', ['note' => $note->id]) : route('note.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($note))
                                @method('PUT')
                            @endif
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ isset($note) ? $note->title : old('title') }}" />
                                @error('title')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label><strong>Description :</strong></label>
                                <textarea class="summernote" name="description">{{ isset($note) ? $note->description : old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-evenly">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="note_type"
                                        id="flexRadioDefault1" value="private"
                                        {{ isset($note) && $note->note_type == 'private' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        private
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="note_type"
                                        id="flexRadioDefault2" value="public"
                                        {{ isset($note) && $note->note_type == 'public' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        public
                                    </label>
                                </div>
                            </div>
                            @error('note_type')
                                <span class="text-danger text-center"> {{ $message }}</span>
                            @enderror

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-sm">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.summernote').summernote();
            });
        </script>
    </body>

    </html>

</x-app-layout>
