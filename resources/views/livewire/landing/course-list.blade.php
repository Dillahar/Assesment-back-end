<div>
    <section class="course-header" data-bg-image="{{ $category ? $category->background_url : asset('img/landing/all-category.webp') }}">
        <div class="container">
            <div class="row ">
                <div class="col-12 text-start mt-10 mb-10 ">
                    <h3 class="text-white text-course">{{ $category ? 'Kelas ' . $category->name : 'Semua Kelas' }}</h3>
                    <p class="subtitle-course">{{ $category ? $category->subCategories->pluck('name')->join(', ') : ($sub_category ? $sub_category->name : "") }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="px-0 mt-4 ">
        <div class="container">
            <x-card.course-list :courses="$courses" />
        </div>
    </section>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var courseHeader = document.querySelector('.course-header');
            var bgImage = courseHeader.getAttribute('data-bg-image');
            courseHeader.style.backgroundImage =
                `linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('${bgImage}')`;
        });
    </script>
@endpush
