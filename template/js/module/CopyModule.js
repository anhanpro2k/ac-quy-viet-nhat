export default function CopyModule() {
    var temp = $('<input>');
    temp.addClass('inputURL')
    var $url = $('.getlink').attr('value');
    $('.btn-copy').on('click', function () {
        const btnData = document.querySelector('.btn-copy').getAttribute('')
        document.querySelector(".btn-copy .txt").innerHTML = 'Copied'
        $("body").append(temp);
        temp.val($url).select();
        document.execCommand("copy");
        console.log(document.execCommand('copy'))
    })
}