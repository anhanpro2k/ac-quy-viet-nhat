export default function UploadFileProgressModule() {
    const fileItem = document.querySelector("#upload-files");
    const progressArea = document.querySelector(".progress-area");
    const uploadedArea = document.querySelector(".uploaded-area");
    const form = document.querySelector('#form-custom')
    if (fileItem) {

        fileItem.addEventListener("change", () => {
            let file = fileItem.files
            for (let i = 0; i < file.length; i++) {
                let fileName = file[i].name;
                if (fileName.length >= 12) {
                    let splitName = fileName.split(".");
                    fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
                }
                uploadFile(fileName, i);
            }
        })
    }

    function uploadFile(name, id) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/upload.php");
        xhr.upload.addEventListener("progress", ({ loaded, total }) => {
            let fileLoaded = Math.floor((loaded / total) * 100);
            let progressHTML = `<div class="box-upload-item">
            <span class="stt">${id + 1}.</span>
            <span class="file-name">${name}</span>
            <div class="filebar">
                <span class="filebar-progress" style="width: ${fileLoaded}%"></span>
            </div>
            <span class="percent">
            ${fileLoaded}%
            </span>
             </div>`;
            progressArea.innerHTML += progressHTML;
            uploadedArea.classList.add("onprogress");
            if (loaded == total) {
                progressArea.innerHTML = "";
                let uploadedHTML = `<div class="box-upload-item">
                <span class="stt">${id + 1}.</span>
                <span class="file-name">${name}</span>
                <div class="filebar">
                    <span class="filebar-progress" style="width: ${fileLoaded}%"></span>
                </div>
                <span class="percent">
                ${fileLoaded}%
                </span>
            </div>`;
                uploadedArea.classList.remove("onprogress");
                uploadedArea.insertAdjacentHTML("afterbegin", uploadedHTML);
            }
        });
        let data = new FormData(form);
        xhr.send(data);
    }

}