@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.10.377/build/pdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.10.377/build/pdf.worker.min.js"></script>
    <script>
        pdfjsLib.GlobalWorkerOptions.workerSrc = '//mozilla.github.io/pdf.js/build/pdf.worker.js';

        // Load your PDF from the Laravel route
        var pdfUrl = '{{ route('certificate.preview', $certificate->number) }}';

        // The PDF loading task
        var loadingTask = pdfjsLib.getDocument(pdfUrl);
        loadingTask.promise.then(function(pdf) {
            // Get the first page
            pdf.getPage(1).then(function(page) {
                var canvas = document.getElementById('pdfCanvas');
                var context = canvas.getContext('2d');
                var viewport = page.getViewport({
                    scale: 1
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
    </script>
@endpush
<div>
    <section class="mb-5 mt-4">
        <div class="container">
            <div class="row justify-content-center">
                <!--Preview Certificate-->
                <canvas id="pdfCanvas"></canvas>
                <span class="text-danger d-none" id="error-preview">Certificate Preview not support on your
                    browser. <a download href="{{ route('certificate.preview', $certificate->number) }}">Click here to
                        download</a></span>
            </div>
        </div>
    </section>
    <section class="container mb-6 mt-sm-3">
        <div class="row">
            <div class="col-md-8 col-sm-12 mb-sm-3">
                <div class="row pe-sm-0 pe-md-4">
                    <div class="position-relative d-flex flex-column mb-4" wire:ignore="">
                        <div class="position-relative">
                            <img src="{{ $certificate->course->thumbnail_url }}" alt="Certificate"
                                class="img-fluid rounded-3">
                        </div>
                    </div>
                    <div class="bg-gray-100 rounded-3 pt-3 pb-3 px-4 text-md-start mb-4">
                        <h3 class="text-info-light fw-bold"> Deskripsi
                        </h3>
                        {!! $certificate->course->description !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="row">
                    <div class="bg-gray-100 rounded-3 pt-3 pb-3 px-4 text-md-start mb-3">
                        <h3 class="text-info-light fw-bold"> Certificate Owner
                        </h3>
                        <div class="d-flex mt-3">
                            @if (empty($certificate->user->photo_url))
                                <div class="avatar avatar-sm rounded-circle bg-info-light border-radius-md p-2 ">
                                    <h6 class="text-info-light text-uppercase mt-1">
                                        {{ $certificate->user->name[0] }}</h6>
                                </div>
                            @else
                                <img src="{{ $certificate->user->photo_url }}"
                                    class="avatar avatar-sm rounded-circle shadow-sm">
                            @endif

                            <div class="text-start ms-3">
                                <h6 class="mb-0 text-dark">{{ $certificate->user->name }}</h6>
                                <p class="mb-0 small text-dark">{{ $certificate->user->instance }}</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ $linkedin_share }}" target="_blank" class="btn btn-outline-primary">Share to
                        linkedin</a>
                </div>
            </div>
        </div>
    </section>
</div>
