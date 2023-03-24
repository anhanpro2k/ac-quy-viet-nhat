export default function SideModule() {
    // const sideOpen = document.querySelector('.side-open')
    // const sideClose = document.querySelector('.side-close')
    // const sideFixed = document.querySelector('.side-fixed')
    // const sideOverlay = document.querySelector('.side-overlay')
    // const body = document.getElementsByTagName("body")[0];

    // if (sideOpen) {
    //     sideOpen.addEventListener('click', () => {
    //         sideFixed.classList.add('open')
    //         sideOverlay.classList.add('open')
    //         sideOpen.classList.add('close')
    //         body.style.overflowY = "hidden"

    //     })
    // }
    // if (sideClose) {
    //     sideClose.addEventListener('click', () => {
    //         sideFixed.classList.remove('open')
    //         sideOverlay.classList.remove('open')
    //         sideOpen.classList.remove('close')
    //         body.style.overflowY = "auto"
    //     })
    // }
    // if (sideOverlay) {
    //     sideOverlay.addEventListener('click', () => {
    //         sideFixed.classList.remove('open')
    //         sideOverlay.classList.remove('open')
    //         sideOpen.classList.remove('close')
    //         body.style.overflowY = "auto"
    //     })
    // }

    // 
    const sideOpens = document.querySelectorAll('.side-open')
    const sideCloses = document.querySelectorAll('.side-close')
    const sideFixeds = document.querySelectorAll('.side-fixed')
    const sideOverlays = document.querySelectorAll('.side-overlay')
    // const body = document.getElementsByTagName("body");

    if (sideOpens) {
        sideOpens.forEach((e, index) => {
            e.addEventListener('click', () => {
                if (sideFixeds[index].className.includes("left")) {
                    sideFixeds[index].classList.add('open')
                    sideOverlays[index].classList.add('open')
                    sideOpens[index].classList.add('close')
                }
                else {
                    sideFixeds[index].classList.add('open')
                    sideOverlays[index].classList.add('open')
                    sideOpens[index].classList.add('close')
                    $('body').css('overflow-y', 'hidden')
                }
            })
        })
    }
    if (sideCloses) {
        sideCloses.forEach((e, index) => {
            e.addEventListener('click', () => {
                sideFixeds[index].classList.remove('open')
                sideOverlays[index].classList.remove('open')
                sideOpens[index].classList.remove('close')
                $('body').css('overflow-y', 'auto')

            })
        })
    }
    if (sideOverlays) {
        sideOverlays.forEach((e, index) => {
            e.addEventListener('click', () => {
                sideFixeds[index].classList.remove('open')
                sideOverlays[index].classList.remove('open')
                sideOpens[index].classList.remove('close')
                $('body').css('overflow-y', 'auto')

            })
        })
    }
}