export default function CmtModule() {
    document.addEventListener('click', (e) => {
        const cmtBot = e.target.closest(".cmt-bot")
        const cmtAnswer = e.target.closest(".cmt-control-answer")
        const allForms = document.querySelectorAll(".re-form")
        if (!cmtBot) {
            allForms.forEach(item => {
                item.classList.remove('open')
            })
        }
        if (cmtBot) {
            const cmtForm = cmtBot.querySelector(".re-form")
            const cmtFormInput = cmtForm.querySelector("input")
            if (cmtAnswer) {
                e.preventDefault();
                allForms.forEach(item => {
                    item.classList.remove('open')
                })
                cmtForm.classList.add('open');
                cmtFormInput.focus();

            }
        }
    })
    const cmt = document.querySelectorAll('.cmt')
    if (cmt) {
        cmt.forEach(item => {
            const cmtItems = item.querySelectorAll('.cmt-item')
            if (cmtItems) {
                cmtItems.forEach(item => {
                    const cmtItemss = item.querySelectorAll('.cmt-item')
                    if (cmtItemss.length > 0) {
                        item.classList.add("has-child");
                    }
                })
            }
        })
    }


 

}