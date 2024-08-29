<x-app-layout>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Tiposolicitude</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('tiposolicitudes.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('tiposolicitude.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
