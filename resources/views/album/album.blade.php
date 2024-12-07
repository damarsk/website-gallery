@extends('layouts.app')

@section('content')
<style>
    .foto {
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .foto:hover {
        transform: scale(1.05);
    }

    .fullscreen-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0, 0, 0, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1050;
        overflow: hidden;
    }

    .fullscreen-overlay img {
        max-width: 90%;
        max-height: 90%;
        cursor: zoom-out;
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>
<div class="container">
    <main>
        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Album Kenangan 2024</h1>
                    <p class="lead text-body-secondary"><i>"Perpisahan bukan akhir kebersamaan, melainkan awal dari kenangan yang akan selalu hidup di hati."</i></p>
                </div>
            </div>
        </section>
        <div class="album py-5">
            <div class="container">
            <div class="row">
                @foreach ($images->chunk(ceil($images->count() / 3)) as $columnImages)
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4 mb-lg-0">
                @foreach ($columnImages as $image)
                <img
                    src="{{ asset('storage/' . $image->url) }}"
                    class="foto img-fluid shadow-1-strong rounded mb-4"
                    alt="{{ $image->description ?? 'Album Image' }}">
                @endforeach
                </div>
                @endforeach
            </div>
            <!-- Gallery -->
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
            <p class="mb-1">&copy; 2024 (Glorious<b>24</b>) Album Kenangan. Semua hak cipta dilindungi undang-undang.</p>
            <p class="mb-0 text-body-secondary"><i>"Perpisahan bukan akhir kebersamaan, melainkan awal dari kenangan yang akan selalu hidup di hati."</i></p>
        </div>
    </div>
</footer>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $(".foto").on("click", function () {
            const imgSrc = $(this).attr("src");
            const overlay = `
                <div class="fullscreen-overlay">
                    <img src="${imgSrc}" alt="Fullscreen Image">
                </div>
            `;
            $("body").append(overlay);
            $("body").css("overflow", "hidden");
        });

        $(document).on("click", ".fullscreen-overlay", function () {
            $(this).fadeOut(300, function () {
                $(this).remove();
                $("body").css("overflow", "auto");
            });
        });

        $(document).on("wheel", ".fullscreen-overlay img", function (e) {
            e.preventDefault();
            const scaleStep = 0.1;
            const img = $(this);
            let currentScale = parseFloat(img.data("scale")) || 1;

            if (e.originalEvent.deltaY < 0) {
                currentScale += scaleStep;
            } else {
                currentScale = Math.max(0.5, currentScale - scaleStep);
            }

            img.css("transform", `scale(${currentScale})`);
            img.data("scale", currentScale); 
        });
    });
</script>
@endsection