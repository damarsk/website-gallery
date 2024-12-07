@extends('layouts.app')

@section('content')
<style>
    ::-webkit-scrollbar {
        display: none;
    }

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
        color: white;
        text-align: center;
        flex-direction: column;
    }

    .fullscreen-overlay img {
        max-width: 90%;
        max-height: 70%;
        margin-bottom: 15px;
        animation: fadeIn 0.3s ease-in-out;
    }

    .overlay-text {
        margin-top: 10px;
    }

    .fullscreen-overlay .close-btn {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 24px;
        color: white;
        cursor: pointer;
        z-index: 1100;
    }

    .fullscreen-overlay .nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 36px;
        color: white;
        cursor: pointer;
        z-index: 1100;
        user-select: none;
    }

    .nav-btn.left {
        left: 20px;
    }

    .nav-btn.right {
        right: 20px;
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
        <!-- Gallery -->
        <div class="album py-5">
            <div class="container">
                <div class="row">
                    @foreach ($images->chunk(ceil($images->count() / 3)) as $columnImages)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4 mb-lg-0">
                        @foreach ($columnImages as $image)
                        <img
                            src="{{ asset('storage/' . $image->url) }}"
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
            <p class="mb-1">&copy; 2024 (Glorious<b>24</b>) Album Kenangan. Semua hak cipta dilindungi undang-undang.</p>
            <p class="mb-0 text-body-secondary"><i>"Perpisahan bukan akhir kebersamaan, melainkan awal dari kenangan yang akan selalu hidup di hati."</i></p>
        </div>
    </div>
</footer>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        let currentIndex = 0; // Track the current image index
        const images = $(".foto"); // Get all images

        // Function to show fullscreen overlay
        function showOverlay(index) {
            const img = $(images[index]);
            const imgSrc = img.attr("src");
            const title = img.data("title") || "Untitled";
            const description = img.data("description") || "No description available.";
            const date = img.data("date") || "Unknown date";

            const overlay = `
                <div class="fullscreen-overlay">
                    <span class="close-btn">&times;</span>
                    <span class="nav-btn left">&lt;</span>
                    <span class="nav-btn right">&gt;</span>
                    <img src="${imgSrc}" alt="Fullscreen Image">
                    <div class="overlay-text">
                        <h4>${title}</h4>
                        <p>${description}</p>
                        <small><i>${date}</i></small>
                    </div>
                </div>
            `;
            $("body").append(overlay);
            $("body").css("overflow", "hidden");
        }

        // Function to update the overlay content
        function updateOverlay(index) {
            const img = $(images[index]);
            const imgSrc = img.attr("src");
            const title = img.data("title") || "Untitled";
            const description = img.data("description") || "No description available.";
            const date = img.data("date") || "Unknown date";

            $(".fullscreen-overlay img").attr("src", imgSrc);
            $(".fullscreen-overlay .overlay-text h4").text(title);
            $(".fullscreen-overlay .overlay-text p").text(description);
            $(".fullscreen-overlay .overlay-text small").text(date);
        }

        // Event to open fullscreen overlay on image click
        $(".foto").on("click", function() {
            currentIndex = images.index(this); // Set current index
            showOverlay(currentIndex);
        });

        // Close fullscreen overlay
        $(document).on("click", ".close-btn", function() {
            $(".fullscreen-overlay").fadeOut(300, function() {
                $(this).remove();
                $("body").css("overflow", "auto");
            });
        });

        // Navigate to the previous image
        $(document).on("click", ".nav-btn.left", function() {
            currentIndex = (currentIndex - 1 + images.length) % images.length; // Loop back to last image
            updateOverlay(currentIndex);
        });

        // Navigate to the next image
        $(document).on("click", ".nav-btn.right", function() {
            currentIndex = (currentIndex + 1) % images.length; // Loop back to first image
            updateOverlay(currentIndex);
        });
    });
</script>
@endsection