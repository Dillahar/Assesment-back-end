<div class="row">
    <div class="col-md-2 col-sm-6">
        <!-- Profile picture card-->
        <div class="card mb-4 mb-xl-0">
            <div class="card-header pb-0">
                <h6>Profile Picture</h6>
            </div>
            <div class="card-body text-center">
                <!-- Profile picture image-->
                @if (empty($user['photo']))
                    <div class="avatar avatar-lg rounded-circle bg-info-light border-radius-md p-2 ">
                        <h6 class="text-info-light text-uppercase mt-1">
                            {{ $user['name'][0] }}</h6>
                    </div>
                @else
                    <img src="{{ $useTemp ? $photo->temporaryUrl() : asset('storage/' . $user['photo']) }}"
                        class="avatar avatar-lg rounded-circle  shadow-sm">
                @endif
                <!-- Profile picture help block-->
                <div class="small font-italic text-muted mb-4">Image no larger than 5 MB</div>
                <x-forms.input type="file" field="photo" label="Upload new photo" placeholder="Photo"
                    class="form-control" />
            </div>
        </div>
    </div>
    <div class="col-md-10 col-sm-6">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Profile Information</h6>
            </div>
            <div class="card-body ">
                <form wire:submit='save'>
                    <x-forms.input field="user.name" label="Name" placeholder="Name" class="mb-3"
                        :asterisk="true" />
                    <x-forms.input field="user.email" label="Email" placeholder="Email" class="mb-3"
                        :asterisk="true" />
                    <div class="mb-4">
                        <label class="">Province</label><label class="text-danger">*</label>
                        <select class="form-control" wire:model.live='province_id'>
                            <option value="">Select Province</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                        <x-forms.error field="province_id" />
                    </div>
                    <div class="mb-4">
                        <label class="">City</label><label class="text-danger">*</label>
                        <select class="form-control" wire:model.live='user.city_id'>
                            <option value="">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" @if ($user['city_id'] == $city->id) selected @endif>
                                    {{ $city->name }}</option>
                            @endforeach
                        </select>
                        <x-forms.error field="user.city_id" />
                    </div>
                    <x-forms.input label="Address" field="user.address" type="text" placeholder="Address"
                        class="mb-4" :asterisk="true" />
                    <x-forms.input label="Instance" field="user.instance" type="text" placeholder="Instance"
                        class="mb-4" :asterisk="true" />
                    <x-forms.input label="Old Password" field="old_password" type="password" placeholder="Old Password"
                        class="mb-4" />
                    <x-forms.input label="Password" field="password" type="password" placeholder="Password"
                        class="mb-4" />
                    <x-forms.input label="Confirm Password" field="password_confirmation" type="password"
                        placeholder="Confirm Password" class="mb-4" />
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary btn-sm mb-0">Save
                            Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @if (!auth()->user()->is_admin)
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>My Orders</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Order Number
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Date
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">#{{ $order->number }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $order->created_at }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{ $order->status }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs font-weight-bold mb-0">@rupiah($order->total)</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ route('user.payment', $order->number) }}"
                                                class="text-secondary font-weight-bold text-xs">
                                                View Payment
                                            </a>
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
