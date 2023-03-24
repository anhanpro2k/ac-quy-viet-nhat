export default function CollapseModule() {
    const clBlock = document.querySelectorAll(".collapse-block");

    if (clBlock) {
        clBlock.forEach((item) => {
            const clBody = item.querySelectorAll('.collapse-body');
            const clItems = item.querySelectorAll('.collapse-item')
            console.log(clItems)
            if (clBody) {
                $(clBody[0]).slideDown();
                clBody[0].parentElement.classList.add("active");
            }
            const head = item.querySelectorAll('.collapse-head');
            head.forEach(item => {
                item.addEventListener('click', () => {
                    clBody.forEach(item => {
                        $(item).slideUp();
                    })
                    clItems.forEach(item => {
                        $(item).removeClass("active");
                    })
                    const body = item.parentElement.querySelector(".collapse-body")
                    if (body.style.display == "none" || body.style.display == "") {
                        $(body).slideDown();
                        $(item.parentElement).addClass("active");
                    } else {
                        $(body).slideUp();
                        $(item.parentElement).removeClass("active");
                    }
                })
            })
        });
    }


    const clfree = document.querySelectorAll(".collapse-blockf");

    if (clfree) {
        clfree.forEach((item) => {
            const clItems = item.querySelectorAll('.collapse-itemf')
            clItems.forEach(items => {
                const head = items.querySelector('.collapse-headf');
                const body = items.querySelector('.collapse-bodyf');

                head.addEventListener('click', () => {
                    if (body.style.display == "none" || body.style.display == "") {
                        $(body).slideDown();
                        body.parentElement.classList.add('active')
                    } else {
                        $(body).slideUp();
                        body.parentElement.classList.remove('active')
                    }
                })

            })
        });
    }
} 