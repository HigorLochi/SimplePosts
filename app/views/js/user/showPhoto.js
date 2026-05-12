function showPhoto(input){
    const file = input.files[0];
    const userPhoto = document.getElementById('user-photo');

    if (file) {
        userPhoto.src = URL.createObjectURL(file);
        userPhoto.style.display = 'block';
    }
}