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
                <span class="close-btn p-4">&times;</span>
                <span class="nav-btn left">&lt;</span>
                <span class="nav-btn right">&gt;</span>
                <img class="p-4" src="${imgSrc}" alt="Fullscreen Image">
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