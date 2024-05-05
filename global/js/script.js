document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("customUploadButton").addEventListener("click", function() {
        document.getElementById("fileToUpload").click();
    });

    document.getElementById("fileToUpload").addEventListener("change", function() {
        var fileInput = document.getElementById("fileToUpload");
        var selectedFile = document.getElementById("selectedFile");
        selectedFile.textContent = fileInput.files[0].name;
    });
});

function deleteImage(imageId) {
    if (confirm("Apakah Anda yakin ingin menghapus gambar ini?")) {
        fetch('delete_image.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: imageId }),
        })
        .then(response => {
            if (response.status === 200) {
                location.reload(); // Reload the page on successful deletion
            } else {
                console.log('Failed to delete image');
            }
        })
        .catch(error => {
            console.error('Error deleting image:', error);
        });
    }
}
