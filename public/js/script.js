// Preview Image
const fileInput = document.getElementById("PreviewImageInput");
const previewImage = document.getElementById("PreviewImage");
const imageLinkInput = document.getElementById("imageLink");
const Thumbnail = document.getElementById("Thumbnail");
const previewImageLink = document.getElementById("previewImageLink");

function getThumbnailFromLink(link) {
    if (link.startsWith("https://you") || link.startsWith("https://m")) {
        // YouTube Link
        var videoId = link.substring(link.lastIndexOf("/") + 1);
        return `https://img.youtube.com/vi/${videoId}/mqdefault.jpg`;
    } else if (link.startsWith("https://drive")) {
        // Google Drive Link
        var fileId = link.split("/")[5];
        return `https://drive.google.com/thumbnail?id=${fileId}`;
    } else {
        // Return the original link if it's not a YouTube or Google Drive link
        return link;
    }
}

fileInput.addEventListener("change", function () {
    const file = fileInput.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        previewImage.src = e.target.result;
        previewImageLink.style.display = "none";
        previewImage.style.display = "block";
    };

    reader.readAsDataURL(file);
});

imageLinkInput.addEventListener("input", function () {
    const imageLink = getThumbnailFromLink(imageLinkInput.value);
    previewImageLink.src = imageLink;
    previewImage.style.display = "none";
    previewImageLink.style.display = "block";
    Thumbnail.value = imageLink;
});

// Delete PopUp

function showDeleteConfirmation(element) {
    
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        // If user clicks on 'Yes, delete it!' button, proceed with the deletion
        if (result.isConfirmed) {
            window.location.href = element.getAttribute('data-href');
        }
    });
}

