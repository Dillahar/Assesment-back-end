<div>
    <section class="bg-dark-alt border-radius-lg py-0 ">
        <div class="container">
            <div class="row ">
                <div class="col-md-6  mt-5">
                    @if ($user->photo_url)
                        <div class="avatar avatar-xxl  rounded-circle position-relative border-avatar ms-3">
                            <img src="{{ $user->photo_url }}" class="w-100 border-radius-sm ">
                        </div>
                    @else
                        <div class="avatar avatar-xxl rounded-circle position-relative bg-info-light border-avatar ms-3">
                            <h1 class="text-info-light text-uppercase mt-1">
                                {{ $user->name[0] }}</h1>
                        </div>
                    @endif
                    <h6 class="text-white ms-3 mt-3 mb-4">
                        {{ $user->name }}
                        <br>
                        <small class="text-success">{{ $user->email }}</small>
                    </h6>
                </div>
            </div>
        </div>
    </section>
    <div class="text-center">
        <ul class="nav  mt-2 ">
            <li class="nav-item">
                <a class="nav-link {{ $section == 'about' ? 'active' : '' }} fw-bolder" href="javascript:void(0);"
                    wire:click='changeSection("about")'>About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $section == 'courses' ? 'active' : '' }} fw-bolder" href="javascript:void(0);"
                    wire:click='changeSection("courses")'>Courses</a>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0);" class="nav-link {{ $section == 'assessments' ? 'active' : '' }} fw-bolder"
                    wire:click='changeSection("assessments")'>Assessments</a>
            </li>
            <li class="nav-item">
                <a href="javascript:void(0);"
                    class="nav-link {{ $section == 'certificates' ? 'active' : '' }} fw-bolder"
                    wire:click='changeSection("certificates")'>Certificates</a>
            </li>
        </ul>
        <hr>
    </div>
    <div class="row">
        @if ($section == 'about')
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body">
                        <h6 class="card-title">
                            Basic Information
                        </h6>
                        <ul class="flex-row  nav ">
                        </ul>
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 text-md"><strong class="text-dark">Account
                                    Created:</strong> {{ $user->created_at->format('d M Y h:i:s') }}
                            </li>
                            <li class="list-group-item border-0 ps-0 text-md"><strong
                                    class="text-dark">Province:</strong>
                                {{ $user->city->province->name ?? '' }}
                            </li>
                            <li class="list-group-item border-0 ps-0 text-md"><strong class="text-dark">City:</strong>
                                {{ $user->city->name ?? '' }}
                            </li>
                            <li class="list-group-item border-0 ps-0 text-md"><strong
                                    class="text-dark">Address:</strong>
                                {{ $user->address }}
                            </li>
                            <li class="list-group-item border-0 ps-0 text-md"><strong class="text-dark">Email:</strong>
                                {{ $user->email }}
                            </li>
                            <li class="list-group-item border-0 ps-0 text-md"><strong
                                    class="text-dark">Instance:</strong>
                                {{ $user->instance }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @elseif($section == 'courses')
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body table-responsive">
                        <h6 class="card-title mb-3 ">
                            Courses
                        </h6>
                        <table class="table  mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-uppercase  text-xs font-weight-bolder">Name</th>
                                    <th class="text-uppercase text-end  text-xs font-weight-bolder  ps-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->my_courses as $order)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $order->course->thumbnail_url }}"
                                                        class="w-100 border-radius-lg shadow-sm mt-2 avatar-xxl"
                                                        style="max-width: 100px;">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center ms-3">
                                                    <a href="/view-course?id=47" class="text-dark font-weight-normal">
                                                        <h6 class=" mb-0 "> {{ $order->course->title }}
                                                        </h6>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-end">
                                                <div class="dropstart ">
                                                    <a href="javascript:" class="text-secondary"
                                                        id="dropdownMarketingCard" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                                        aria-labelledby="dropdownMarketingCard">
                                                        <li>
                                                        </li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item border-radius-md text-danger"
                                                                href="javascrit:void(0);"
                                                                wire:click="$dispatch('swal:confirm', {id:{{ $order->id }}, dispatch:'delete-order'})">Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @elseif($section == 'assessments')
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header">
                        <h6 class="card-title">
                            Assessments
                        </h6>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table  mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-uppercase  text-xs font-weight-bolder">Name</th>
                                    <th class="text-uppercase  text-xs font-weight-bolder">Course</th>
                                    <th class="text-uppercase  text-xs font-weight-bolder ps-2">Deadline</th>
                                    <th class="text-uppercase  text-xs font-weight-bolder ps-2">Status</th>
                                    <th class="text-uppercase  text-xs font-weight-bolder  ps-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->my_assessment as $assessment)
                                    <tr>
                                        <td>
                                            <h6 class=" mb-0 ">{{ $assessment->assessment->title }}</h6>
                                        </td>
                                        <td>
                                            <h6 class=" mb-0 ">{{ $assessment->assessment->course->title }}</h6>
                                        </td>
                                        <td>
                                            <p class="text-sm mb-0">
                                                {{ $assessment->score }}
                                            </p>
                                        </td>
                                        <td>
                                            @if ($assessment->status == \App\Enums\AssessmentStatus::PENDING)
                                                <span class="badge badge-dot me-4">
                                                    <i class="bg-warning"></i>
                                                    <span class="badge bg-warning-light font-weight-bold">Pending</span>
                                                </span>
                                            @elseif($assessment->status == \App\Enums\AssessmentStatus::PASSED)
                                                <span class="badge badge-dot me-4">
                                                    <i class="bg-success"></i>
                                                    <span class="badge bg-success-light font-weight-bold">Passedd</span>
                                                </span>
                                            @else
                                                <span class="badge badge-dot me-4">
                                                    <i class="bg-danger"></i>
                                                    <span
                                                        class="badge bg-danger-light font-weight-bold">Rejected</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <div class="dropstart ">
                                                    <a href="javascript:" class="text-secondary"
                                                        id="dropdownMarketingCard" data-bs-toggle="dropdown"
                                                        aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3"
                                                        aria-labelledby="dropdownMarketingCard">
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item border-radius-md text-danger"
                                                                href="javascript:void(0);"
                                                                wire:click="$dispatch('swal:confirm', {id:{{ $assessment->id }}, dispatch:'delete-assessment'})">Delete
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header pb-0">
                    </div>
                    <div class="card-body">
                        <div class="alert bg-info-light text-info-light fw-bolder ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="19"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Total Assignment:
                            {{ $user->my_assessment->count() }}
                        </div>
                    </div>
                </div>
            </div>
        @elseif($section == 'certificates')
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-body table-responsive">
                        <h6 class="card-title mb-3 ">
                            Certificates
                        </h6>
                        <table class="table  mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-uppercase  text-xs font-weight-bolder">Course</th>
                                    <th class="text-uppercase  text-xs font-weight-bolder">Valid Until</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->certificate_receives as $certificate)
                                    <tr>
                                        <td>
                                            <h6 class="text-sm">
                                                {{ $certificate->course->title }}
                                            </h6>
                                        </td>

                                        <td>
                                            <h6 class="text-sm">
                                                {{ $certificate->valid_until }}
                                            </h6>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
