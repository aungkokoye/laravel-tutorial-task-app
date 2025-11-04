@extends('layout.main')

@section('header-title')
    create-book-review
@endsection

@section('page-title', 'Create Review for: ' . $book->title)


@section('content')
    <form method="POST" action="{{ route('books.reviews.store', $book) }}">
        @csrf

        <div class="mb-4">
            <label for="review" class="label">Review</label>
            <textarea name="review" id="review" rows="3"
                    @class([
                                'textarea',
                                'border-red-500 bg-red-200' => $errors->has('review'),
                    ])
                >{{ old('review') }}</textarea>
            @if ($errors->has('review'))
                <span class="text-red-500 mt-20">{{ $errors->first('review') }}</span>
            @endif
        </div>

        <div class="mb-4">
            <label for="rating" class="label">Rating</label>
            <select name="rating" id="rating"  @class([
                            'input',
                            'border-red-500 bg-red-200' => $errors->has('name'),
                        ])>

                <option value=""> Please Select Rating </option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                        {{ $i }}
                    </option>
                @endfor
            </select>
            @if ($errors->has('rating'))
                <span class="text-red-500 mt-4">{{ $errors->first('rating') }}</span>
            @endif
        </div>

        <div class="mb-4 flex gap-4">
            <button type="submit" class="btn-m btn-primary"> Save </button>
            <a href="{{ route('books.show', $book) }}" class="btn-m btn-default"> Cancel </a>
        </div>
    </form>
@endsection
