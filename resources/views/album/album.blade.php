@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/album.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vegas.min.css') }}">
    <div class="container">
        <main>
            <section class="py-5 text-center container position-relative">
                <div class="vegas-container rounded" style="height: 500px;">
                    <div class="overlay"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1;">
                    </div>
                    <div class="d-flex align-items-center py-lg-5 position-relative" style="z-index: 2; height: 500px;">
                        <div class="col-lg-6 col-md-8 mx-auto">
                            <h1 class="fw-light text-white">Album Kenangan 2024</h1>
                            <p class="lead text-white"><i>"Perpisahan bukan akhir kebersamaan, melainkan awal dari kenangan
                                    yang akan selalu hidup di hati."</i></p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Gallery -->
            <div class="album py-4">
                <div class="container">
                    <div class="row">
                        @foreach ($images->chunk(ceil($images->count() / 3)) as $columnImages)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 mb-4 mb-lg-0">
                                @foreach ($columnImages as $image)
                                    <img src="{{ asset('storage/' . $image->url) }}"
                                        class="foto img-fluid shadow-1-strong rounded mb-4"
                                        alt="{{ $image->description ?? 'Album Image' }}"
                                        data-title="{{ $image->title ?? 'Untitled' }}"
                                        data-description="{{ $image->description ?? 'No description available.' }}"
                                        data-date="{{ $image->photo_date ?? 'Unknown date' }}">
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>
    <footer class="bg-body-tertiary py-5">
        <div class="container-fluid">
            <div class="container">
                <p class="float-end mb-1">
                    <a href="#">Kembali ke atas</a>
                </p>
                <p class="mb-1">&copy; 2024 (Glorious<b>24</b>) Album Kenangan. Semua hak cipta dilindungi undang-undang.
                </p>
                <p class="mb-0 text-body-secondary"><i>"Perpisahan bukan akhir kebersamaan, melainkan awal dari kenangan
                        yang akan selalu hidup di hati."</i></p>
            </div>
        </div>
    </footer>
@endsection
@section('script')
    <script src="{{ asset('js/vegas.min.js') }}"></script>
    <script src="{{ asset('js/album.js') }}"></script>
    <script>
        $(function() {
            $('.vegas-container').vegas({
                slides: [
                    @foreach ($images as $image)
                        {
                            src: '{{ asset('storage/' . $image->url) }}'
                        },
                    @endforeach
                ]
            });
        });
    </script>
@endsection
