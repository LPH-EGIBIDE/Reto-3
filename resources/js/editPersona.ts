function init(){
    let profPic = document.getElementById('profpic') as HTMLInputElement;
    profPic.addEventListener('change', function () {
        let image = profPic.files[0];
        changeImagePreview(image);
    });
}

 function changeImagePreview(image: File) {
        const reader = new FileReader();
        reader.readAsDataURL(image);
        reader.onload = function () {
            let img = document.getElementById('imgProfile') as HTMLImageElement;
            img.src = reader.result as string;
        }
        reader.onerror = function (error) {
            console.log('Error with image conversion: ', error);
        }
}


init();
