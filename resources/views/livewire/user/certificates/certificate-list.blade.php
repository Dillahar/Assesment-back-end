@push('styles')
@endpush
@push('scripts')
    {{-- <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.10.377/build/pdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.10.377/build/pdf.worker.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

        // Load your PDF from the Laravel route
        var pdfUrl = 'http://192.168.100.145:8000/certificate/CD69AF5A8B/preview';

        // The PDF loading task
        var loadingTask = pdfjsLib.getDocument(pdfUrl);
        loadingTask.promise.then(function(pdf) {
            // Get the first page
            pdf.getPage(1).then(function(page) {
                var canvas = document.getElementById('pdfCanvas');
                var context = canvas.getContext('2d');
                var viewport = page.getViewport({
                    scale: 0.1
                });

                // Set canvas size to the size of the PDF page
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                // Render PDF page into canvas context
                var renderContext = {
                    canvasContext: context,
                    viewport: viewport
                };
                page.render(renderContext);
            });
        }.bind(this), function(reason) {
            document.getElementById('pdfCanvas').remove();
            document.getElementById('error-preview').classList.remove('d-none');
        });
    </script> --}}
@endpush
<div class="container py-5">
    <h2>My Certificates</h2>
    <p>Ambil Certificates mu!</p>
    <div class="row row-cols-12 row-cols-md-12 g-4">

        @foreach ($certificates as $certificate)
            <div class="col-12">
                <div class="card mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="{{ $certificate->course->thumbnail_url }}" class="img-fluid img-thumbnail"
                                alt="Certificate">
                            {{-- <canvas id="pdfCanvas"></canvas>
                            <span class="text-danger d-none" id="error-preview">Preview not support on your
                                browser.</span> --}}
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title">{{ $certificate->course->title }}</h5>
                                <p class="card-text"><small class="text-success"><svg width="20" height="21"
                                            viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.0566 20.1877C4.73438 20.1877 0.349609 15.8127 0.349609 10.4807C0.349609 5.15845 4.73438 0.773682 10.0566 0.773682C15.3789 0.773682 19.7734 5.15845 19.7734 10.4807C19.7734 15.8127 15.3887 20.1877 10.0566 20.1877ZM9.04102 15.0999C9.43164 15.0999 9.77344 14.9045 9.99805 14.553L14.3047 7.96118C14.4512 7.73657 14.5586 7.48267 14.5586 7.25806C14.5586 6.70142 14.0703 6.32056 13.5332 6.32056C13.1914 6.32056 12.8984 6.5061 12.6641 6.8772L9.01172 12.6877L7.36133 10.6467C7.11719 10.344 6.87305 10.217 6.55078 10.217C6.00391 10.217 5.56445 10.6565 5.56445 11.2034C5.56445 11.467 5.65234 11.7014 5.84766 11.9456L8.03516 14.5725C8.31836 14.9241 8.64062 15.0999 9.04102 15.0999Z"
                                                fill="#60D13A" />
                                        </svg>
                                        Completed on @if (!empty($certificate->created_at))
                                            {{ \App\Utils\DateSupport::parse($certificate->created_at)->format(config('app.date_format')) }}
                                        @endif </small></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card-body text-end">
                                @if ($certificate->course->is_rated)
                                    <a href="{{ route('certificate.preview', $certificate->number) }}"
                                        class="btn btn-outline-primary mb-md-2 mb-sm-0 mb-lg-0" download>Download</a>
                                    <a href="{{ route('certificate.verify', $certificate->number) }}"
                                        class="btn btn-primary" target="_blank">View</a>
                                @else
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#review-modal"
                                        wire:click="$dispatch('rating-modal', {id:{{ $certificate->course->id }}})">
                                        View
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if($certificates->count() == 0)
            <span class="text-center">No certificates found.</span>
        @endif
    </div>

    <div wire:ignore.self class="modal fade" id="review-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form wire:submit='giveReview'>
            <div class="modal-dialog">
                <div class="modal-content">
                    @if ($course)
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Review for course {{ $course->title }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="exampleFormControlTextarea1" class="form-label">Your Rating</label>
                            <div class="rating text-warning">
                                <i class=" rating__star {{ $rating >= 1 ? 'fas' : 'far' }} fa-star"
                                    wire:click='setRating(1)'></i>
                                <i class=" rating__star {{ $rating >= 2 ? 'fas' : 'far' }}  fa-star"
                                    wire:click='setRating(2)'></i>
                                <i class=" rating__star {{ $rating >= 3 ? 'fas' : 'far' }}  fa-star"
                                    wire:click='setRating(3)'></i>
                                <i class=" rating__star {{ $rating >= 4 ? 'fas' : 'far' }} fa-star"
                                    wire:click='setRating(4)'></i>
                                <i class=" rating__star {{ $rating >= 5 ? 'fas' : 'far' }}  fa-star"
                                    wire:click='setRating(5)'></i>
                            </div>
                            <div class="mb-2 mt-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Write your Review</label>
                                <textarea class="form-control" name="review" id="exampleFormControlTextarea1" rows="4" placeholder="Awsome...!"
                                    wire:model='review'></textarea>
                                <x-forms.error field="review" />
                            </div>
                            <input type="hidden" id="star_count" name="star_count" value="1" wire:model='rating'>
                        </div>
                        <input type="hidden" name="_token" value="vvpsF2fUS9wRFG4PUaxd0BizmZDig9c8glxGsi2s">
                        <input type="hidden" name="course_id" value="43">
                        <div class="ms-3 mb-4">
                            <button type="button" class="btn btn-sm bg-pink-light text-danger shadow-none"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-sm bg-purple-light text-purple shadow-none">Save
                                Review</button>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
