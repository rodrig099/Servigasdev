<x-app-layout>
    <section class="content">
        <div class="container-xxl flex-grow-1 container-p-y d-flex flex-column" style="min-height: 100vh;">
            <div class="row flex-grow-1">
                <div class="col-xl d-flex flex-column">
                    <div class="card flex-grow-1 d-flex flex-column">
                        <div class="card-header">
                            <span class="card-title">Crear Tipo de solicitud</span>
                        </div>
                        <div class="card-body bg-white">
                            <form method="POST" action="{{ route('users.store') }}" role="form"
                                enctype="multipart/form-data">
                                @csrf

                                @include('user.formCreate')

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
