export default function PopupModule(){
    $(document).ready(function() {
        $('.ex-play').magnificPopup({
            // disableOn: 500,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
    
            fixedContentPos: false
        });
    });
}