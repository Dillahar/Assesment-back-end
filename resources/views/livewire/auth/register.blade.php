<section>
    <div class="row">
        <!-- left -->

        <div class="col-md-6 col-sm-12 h-100-vh logres-column">
            <div class="row">
                <a href="{{ route('home') }}">
            <img src="{{asset('img/logo/skillage-3d-logo.png')}}" alt="Logo" class="mt-4 ms-4"style="max-height: 65px;">
        </a>
            </div>
            <div class="row">
                <h4 class="logres-header text-white register-slogan">
                    <i>Welcome. <br> Start to upgrade <br> your skill with <br> Skillage Academy!</i>
                </h4>
            </div>
        </div>

        <!-- Right -->
        <div class="col-md-6 col-sm-12 m-auto h-100">
            <div class="row ">
                <div class="col-sm-10 col-xl-8 m-auto">
                    <!-- Title -->
                    <!-- Form START -->
                    <div class="card-info mt-8">
                        <div class="card-header pb-0 ">

                            <h3 class="font-weight-bolder text-dark">
                                Create an Account
                            </h3>
                        </div>
                        <div class="card-body">
                            <form wire:submit='register'>
                                <x-forms.alert />
                                <x-forms.input label="Name" field="name" type="text" placeholder="Name"
                                    class="mb-4" />
                                <x-forms.input label="Email" field="email" type="email" placeholder="Email"
                                    class="mb-4" />
                                <div class="mb-4">
                                    <label class="">Province</label>
                                    <select class="form-control" wire:model.live='province_id'>
                                        <option value="">Select Province</option>
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-forms.error field="province_id" />
                                </div>
                                <div class="mb-4">
                                    <label class="">City</label>
                                    <select class="form-control" wire:model.live='city_id'>
                                        <option value="">Select City</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}"
                                                @if ($city_id == $city->id) selected @endif>{{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-forms.error field="city_id" />
                                </div>
                                <x-forms.input label="Address" field="address" type="text" placeholder="Address"
                                    class="mb-4" />
                                <x-forms.input label="Instance" field="instance" type="text" placeholder="Instance"
                                    class="mb-4" />
                                <x-forms.input label="Password" field="password" type="password" placeholder="Password"
                                    class="mb-4" />
                                <x-forms.input label="Confirm Password" field="password_confirmation" type="password"
                                    placeholder="Confirm Password" class="mb-5" />

                                <div class="text-center">
                                    <button type="submit" class="btn btn-blue btn-lg w-100 my-4 mb-2">Create
                                        account</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="text-sm mt-3 mb-0">Already have an account ? <a href="{{ route('login') }}"
                                    class="font-weight-bolder text-info-light">Log in</a>
                        </div>
                    </div>
                </div>
            </div> <!-- Row END -->
        </div>

    </div>
</section>
