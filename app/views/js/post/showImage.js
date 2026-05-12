function showImage(input){
    const file = input.files[0];
    const postImage = document.getElementById('post-image');

    if (file) {
        postImage.src = URL.createObjectURL(file);
        postImage.style.display = 'block';
    }
}