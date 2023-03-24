export default function ShowImgModule() {
    const fileUp = document.querySelector('.fileup');
    if(fileUp) {
        fileUp.querySelectorAll('input')[0].addEventListener('change', function (event) {
            var file = event.target.files[0];
            var fileReader = new FileReader();
            if (file.type.match('image')) {
                fileReader.onload = function () {
                    var img = document.createElement('img');
                    img.src = fileReader.result;
                    var imgWr = document.createElement('div');
                    var imgInner = document.createElement('div');
                    imgWr.className = 'fileup-item'
                    imgInner.className = 'fileup-inner'
                    imgWr.appendChild(imgInner)
                    imgInner.appendChild(img)
                    document.querySelectorAll('.fileup .fileup-box')[0].appendChild(imgWr);
                };
                fileReader.readAsDataURL(file);
            } else {
                fileReader.onload = function () {
                    var blob = new Blob([fileReader.result], { type: file.type });
                    var url = URL.createObjectURL(blob);
                    var video = document.createElement('video');
                    var timeupdate = function () {
                        if (snapImage()) {
                            video.removeEventListener('timeupdate', timeupdate);
                            video.pause();
                        }
                    };
                    video.addEventListener('loadeddata', function () {
                        if (snapImage()) {
                            video.removeEventListener('timeupdate', timeupdate);
                        }
                    });
                    var snapImage = function () {
                        var canvas = document.createElement('canvas');
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                        var image = canvas.toDataURL();
                        var success = image.length > 100000;
                        if (success) {
                            var img = document.createElement('img');
                            img.src = image;
                            var imgWr = document.createElement('div');
                            var imgInner = document.createElement('div');
                            imgWr.className = 'fileup-item'
                            imgInner.className = 'fileup-inner'
                            imgWr.appendChild(imgInner)
                            imgInner.appendChild(img)
                            document.querySelectorAll('.fileup .fileup-box')[0].appendChild(imgWr);
                            URL.revokeObjectURL(url);
                        }
                        return success;
                    };
                    video.addEventListener('timeupdate', timeupdate);
                    video.preload = 'metadata';
                    video.src = url;
                    // Load video in Safari / IE11
                    video.muted = true;
                    video.playsInline = true;
                    video.play();
                };
                fileReader.readAsArrayBuffer(file);
            }
        });
    }
    
}