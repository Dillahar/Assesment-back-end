<div>
    <section class="container mb-6 mt-sm-3 min-vh-70 d-flex flex-column">
        <div class="row">
            <div class="col-md-4 col-sm-12 mb-sm-3 order-2 order-md-2 mt-3">
                <div class="row pe-sm-0 pe-md-4">
                    <div class="bg-gray-100 rounded-3 pt-3 pb-3 px-4 text-md-start">
                        <h3 class="text-info-light fw-bold"> Pelajaran
                        </h3>
                        <div class="list-group list-group-flush">
                            <a href="{{ route('user.my-course.detail', [$course->slug]) }}"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-2">
                                <div class="text-start">
                                    <div class="avatar avatar-sm bg-dark rounded-circle me-2">
                                        <i class="fas fa-play text-white"></i>
                                    </div>
                                    Overview Course
                                </div>

                                <span></span>
                            </a>
                            <a href="#module-prep"
                                class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-2"
                                data-bs-toggle="collapse">
                                <div class="text-start">
                                    <div class="avatar avatar-sm bg-dark rounded-circle me-2">
                                        <i class="fas fa-hourglass-start text-white"></i>
                                    </div>
                                    Class Preparation
                                </div>
                            </a>
                            <div id="module-prep" class="collapse mb-3">
                                <a href="{{ $course->group_invite_link }}" target="_blank"
                                    class="list-group-item list-group-item-action px-4">Discussion Group</a>
                            </div>
                            @foreach ($course->course_modules as $moduleList)
                                <a href="#module-{{ $moduleList->id }}"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center mb-2"
                                    data-bs-toggle="collapse">
                                    <div class="text-start">
                                        <div class="avatar avatar-sm bg-dark rounded-circle me-2">
                                            <i class="fas fa-play text-white"></i>
                                        </div>
                                        {{ $moduleList->title }}
                                    </div>

                                    <span>{{ \App\Utils\Helper::formatDurationReadable($moduleList->total_duration) }}</span>
                                </a>
                                <div id="module-{{ $moduleList->id }}" wire:key="module-{{ $moduleList->id }}"
                                    class="collapse mb-3">
                                    @foreach ($moduleList->course_lessons as $lessonList)
                                        <a href="{{ route('user.my-course.learn', [$course->slug, $moduleList->id, $lessonList->id]) }}"
                                            class="list-group-item list-group-item-action px-4">{{ $lessonList->title }}</a>
                                    @endforeach
                                </div>
                            @endforeach
                            @if ($course->assessment)
                                <a href="{{ route('user.my-course.assessment', [$course->slug]) }}"
                                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center active">
                                    <div class="text-start">
                                        <div class="avatar avatar-sm bg-dark rounded-circle me-2">
                                            <i class="fas fa-tasks text-white"></i>
                                        </div>
                                        {{ $course->assessment->title }}
                                    </div>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 order-1 order-md-2 mt-3">
                <div class="bg-gray-100 rounded-3 pt-3 pb-3 px-4 text-md-start">
                    <h3 class="text-info-light fw-bold"> {{ $course->assessment->title }}
                    </h3>
                    {!! $course->assessment->description !!}
                    @if ($course->assessment->file)
                        <a class="btn btn-primary mt-2" href="{{ $course->assessment->file_url }}" download>Download
                            Extended File</a>
                    @endif
                    <hr>

                    <form wire:submit.prevent='submit'>
                        <div class="mb-4">
                            <label for="file">File</label>
                            <label class="text-danger">*</label>
                            <input id="file" type="file" name="file" class="form-control"
                                placeholder="File" aria-label="File" aria-describedby="file-addon"
                                wire:model="file">
                            <x-forms.error field="file" />
                        </div>
                        <button type="submit" class="btn btn-primary" wire:loading.remove wire:target='file,submit'>Submit</button>
                        <div class="spinner-border text-primary d-none" wire:loading.class.remove="d-none"  wire:target='file,submit' role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </form>
                </div>
                <div class="bg-gray-100 rounded-3 pt-3 pb-3 px-4 text-md-start mt-4 mb-sm-3">
                    <h3 class="text-info-light fw-bold"> My Submissions
                    </h3>
                    <div class="table-responsive  p-0">
                        <div id="data_table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">No</th>
                                                <th scope="col" class="text-center">File</th>
                                                <th scope="col" class="text-center">Status</th>
                                                <th scope="col" class="text-center">Score</th>
                                                <th scope="col" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($my_submissions as $submission)
                                                <tr>
                                                    <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                                                    <td class="text-center"><a href="{{ $submission->file_url }}"
                                                            target="_blank" download>Download</a>
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($submission->status == \App\Enums\AssessmentStatus::PENDING)
                                                            <span class="badge bg-warning-light mb-0 ms-3 text-warning">
                                                                Pending
                                                            </span>
                                                        @endif
                                                        @if ($submission->status == \App\Enums\AssessmentStatus::REJECTED)
                                                            <span class="badge bg-danger-light mb-0 ms-3 text-danger">
                                                                Rejected
                                                            </span>
                                                        @endif
                                                        @if ($submission->status == \App\Enums\AssessmentStatus::PASSED)
                                                            <span class="badge bg-success-light mb-0 ms-3 text-success">
                                                                Passed
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $submission->status != \App\Enums\AssessmentStatus::PENDING ? $submission->score : '-' }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-info btn-sm"
                                                            href="{{ route('user.assessments.view', $submission->id) }}">View</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @if ($my_submissions->count() == 0)
                                                <tr>
                                                    <td colspan="5" class="text-center">No Data</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
