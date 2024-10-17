<div class="row">

    <div class="col-md-6">
        <div class="card shadow blur mb-4 ">
            <div class="card-header border-bottom">
                <h5 class="card-title">Assignment Details</h5>
            </div>
            <div class="card-body">

                <h3 class="mb-4">
                    {{ $assessment->assessment->title }}
                </h3>
                <div class="row">

                    <div class="col-md-6 col-sm-12">
                        <div class="alert bg-info-light text-info-light fw-bolder ">


                            Maximum Marks: {{ $assessment->assessment->max_score }}
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="alert bg-success-light text-success fw-bolder">
                            Minimum passed score: {{ $assessment->assessment->passed_min_score }}
                        </div>
                    </div>
                </div>
                <div class="mb-4 mt-2">
                    <h5 class="card-title">Assessment Description:</h5>
                    {!! $assessment->assessment->description !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header border-bottom">
                <h5 class="card-title">{{ __('Result') }}</h5>
            </div>
            <div class="card-body">
                @if ($assessment->status != \App\Enums\AssessmentStatus::PENDING)
                    @php
                        $bgCard = 'bg-success-light';
                        $bgText = 'text-success';
                        if ($assessment->status == \App\Enums\AssessmentStatus::REJECTED) {
                            $bgCard = 'bg-pink-light';
                            $bgText = 'text-danger';
                        }
                    @endphp
                    <div class="card {{ $bgCard }}">
                        <div class="card-body">
                            <h6 class="{{ $bgText }}">My Score: {{ $assessment->score }}
                                ({{ $assessment->status }})
                            </h6>
                        </div>
                    </div>
                    <div class="row mt-3">

                        <div class="col-12">
                            <a target="_blank" href="{{ $assessment->file_url }}"
                                class="btn btn-success mb-sm-0 me-00 "><x-svg.download /> Download
                                Assessment File</a>
                            <h5 class="card-title mt-3">Reviewer's Note:</h5>
                            <p class="text-muted">
                                {{ $assessment->note }}
                            </p>
                        </div>

                    </div>
                @else
                    <div class="card bg-warning-light">
                        <div class="card-body">
                            <h6 class="text-warning">Your assignment is still being reviewed.</h6>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
