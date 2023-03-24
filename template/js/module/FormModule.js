export default function FormModule() {
    $(document).ready(function() {
        $(".seepassJS").on("click", function() {
            // console.log("show pass");
            const pwd = $(this).siblings('input');
            if (pwd.attr("type") == "password") {
                pwd.attr("type", "text");
                // console.log("show");
                // $(this).parent().addClass("show");
                $(this).removeClass("fa-eye");
                $(this).addClass("fa-eye-slash");
            } else {
                pwd.attr("type", "password");
                $(this).addClass("fa-eye");
                $(this).removeClass("fa-eye-slash");
            }
        });
    });

    const formlog = document.querySelector('.formlog')
    const formforgot = document.querySelector('.formforgot')
    const btnforgot = document.querySelector('.forgot')
    const btnreturn = document.querySelector('.returnbtn')
    if(btnforgot && btnreturn) {
        btnforgot.addEventListener('click', ()=> {
            formforgot.classList.add('open')
            formlog.classList.remove('open')
        })
        btnreturn.addEventListener('click', ()=> {
            formforgot.classList.remove('open')
            formlog.classList.add('open')
        })
    
    }
    
}