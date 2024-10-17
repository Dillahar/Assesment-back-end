<div>
    <div class="bg-dark-alt position-relative border-radius-xl">
        <div class="pb-lg-4  pt-5 ">
            <div class="row ms-2">
                <div class="col">
                </div>



            </div>
        </div>

    </div>
    <div class="row mt-4">

        <div class="col-md-3 mb-4">
            <div class="card  ">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="mb-0 text-capitalize font-weight-bold "> Total Users</p>
                                <h5 class="font-weight-bolder   mt-4 ">
                                    {{ $totalUsers }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class=" icon icon-shape bg-info-light rounded-circle  text-center">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather text-info-light feather-users mt-2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card ">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="mb-0 text-capitalize font-weight-bold">Total Courses</p>
                                <h5 class="font-weight-bolder mt-4">
                                    {{ $totalCourses }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class=" icon icon-shape bg-info-light  rounded-circle text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-grid text-info-light ms-auto mt-2 ">
                                    <rect x="3" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="3" width="7" height="7"></rect>
                                    <rect x="14" y="14" width="7" height="7"></rect>
                                    <rect x="3" y="14" width="7" height="7"></rect>
                                </svg>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="mb-0 text-capitalize font-weight-bold">Total Modules</p>
                                <h5 class="font-weight-bolder mt-4 ">
                                    {{ $totalModules }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class=" icon icon-shape bg-info-light rounded-circle text-center">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class=" text-info-light feather feather-hard-drive mt-2">
                                    <line x1="22" y1="12" x2="2" y2="12"></line>
                                    <path
                                        d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                    </path>
                                    <line x1="6" y1="16" x2="6.01" y2="16"></line>
                                    <line x1="10" y1="16" x2="10.01" y2="16"></line>
                                </svg>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="mb-0   font-weight-bold">Total Orders</p>

                                <h5 class="font-weight text-white-bolder mt-4">
                                    {{ $totalOrders }}
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class=" icon icon-shape bg-info-light rounded-circle text-center">


                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-book text-info-light mt-2">
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                                </svg>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row ">
        <div class="col-lg-4 col-sm-6">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="d-flex justify-content-between">
                        <h6 class="text-capitalize mb-0">Recent Students</h6>
                        <a href="{{ route('users') }}"
                            class="btn  bg-purple-light text-purple shadow-none mb-0 ms-2 d-flex align-items-center justify-content-center"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                            data-bs-original-title="">
                            View All
                        </a>
                    </div>


                </div>

                <div class="card-body ">


                    <div class="table-responsive  p-0">
                        <table class="table align-items-center mb-0">
                            <tbody>

                                @foreach ($recentStudents as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex mb-1">
                                                <div>
                                                    @if ($user->photo)
                                                        <img src="{{ $user->photo_url }}"
                                                            class="avatar avatar-md rounded-circle  shadow-sm">
                                                    @else
                                                        <div
                                                            class="avatar avatar-md rounded-circle bg-info-light border-radius-md ">
                                                            <h6 class="text-info-light text-uppercase mt-1">
                                                                {{ $user->name[0] }}</h6>
                                                        </div>
                                                    @endif

                                                </div>
                                                <div class="d-flex flex-column justify-content-center ms-3">
                                                    <h6 class="mb-0">{{ $user->name }}</h6>

                                                    <p class=" text-sm text-muted mb-0">{{ $user->email }}</p>
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
        </div>
        <div class="col-lg-8 col-sm-6 mt-sm-0 mt-4">
            <div class="card">
                <div class="card-header border-bottom">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0 text-capitalize">Recent Orders</h6>
                        <a href="{{ route('orders') }}"
                            class="btn  bg-purple-light text-purple shadow-none mb-0 ms-2 d-flex align-items-center justify-content-center"
                            data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
                            data-bs-original-title="">
                            View All
                        </a>
                    </div>

                </div>
                <div class="card-body">

                    <div class="table-responsive  p-0">
                        <table class="table align-items-center mb-0" id="data_table">
                            <thead class="bg-gray-100">
                                <tr>

                                    <th class="text-uppercase  text-xs">User</th>
                                    <th class="text-uppercase  text-xs  ps-2">Amount</th>
                                    <th class="text-uppercase  text-xs  ps-2">Date</th>
                                    <th class=""></th>
                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($recentOrders as $order)
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <div>
                                                    @if (isset($order->user->photo))
                                                        <img src="{{ $order->user->photo_url }}"
                                                            class="avatar avatar-md rounded-circle  shadow-sm">
                                                    @else
                                                        <div
                                                            class="avatar avatar-md rounded-circle bg-info-light border-radius-md ">
                                                            <h6 class="text-info-light text-uppercase mt-1">
                                                                {{ $order->user->name[0] }}</h6>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex flex-column justify-content-center ms-3">
                                                    <h6 class="mb-0">{{ $order->user->name }}</h6>

                                                    <p class=" text-sm text-muted mb-0">{{ $order->user->email }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle text-start">
                                            <span class="">
                                                @rupiah($order->total)
                                            </span>
                                        </td>
                                        <td class="align-middle text-start">
                                            <span class="">
                                                {{ \App\Utils\DateSupport::parse($order->created_at)->format(config('app.date_format')) }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-right">
                                            <a class=" btn bg-purple-light text-purple btn-icon-only  shadow-none"
                                                href="{{ route('orders.edit', $order->id) }}">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-file">
                                                    <path
                                                        d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z">
                                                    </path>
                                                    <polyline points="13 2 13 9 20 9"></polyline>
                                                </svg>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
