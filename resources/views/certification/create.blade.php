<x-app-layout>


    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Certification</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('certifications.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('certification.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
