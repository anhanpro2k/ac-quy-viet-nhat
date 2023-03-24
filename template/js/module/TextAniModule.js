export default function TextAniModule() {
    const textAni = document.querySelectorAll('.txt-ani')
    if (textAni) {
        // Thêm khoảng trắng
        textAni.forEach(item => {
                const textAniItems = item.querySelectorAll('.txt-ani-item')
                let arrs = [];
                if (textAniItems) {
                    textAniItems.forEach((item, index) => {
                        arrs.push(item.outerHTML)
                        arrs.push(`${index == (textAniItems.length - 1) ? '' : '<span>&nbsp;</span>'}`)
                    })
                }
                item.innerHTML = arrs.join('')
            })
            // End thêm khoảng trắng
        textAni.forEach(item => {
            const textAniItems = item.querySelectorAll('.txt-ani-item')
            if (textAniItems) {
                textAniItems.forEach(item => {
                    let arrText = item.textContent.trim().split(' ');
                    let arrTextSecond = [];
                    arrText.forEach(item => {
                        arrTextSecond.push(item.split(''))
                    })
                    let textSecond = ""
                    arrTextSecond.forEach((item, index) => {
                        let textFirst = "";
                        item.forEach((item, index) => {
                            textFirst += `<span><span class="letter">${item}</span></span>`
                        })

                        textSecond += `<p>${textFirst}</p>${index == (arrTextSecond.length - 1) ? '' : '<span>&nbsp;</span>'}`
                    })
                    item.innerHTML = textSecond;
                    const txtAni = document.querySelectorAll('.txt-ani');
                    if (txtAni) {
                        txtAni.forEach(item => {
                            const letter = item.querySelectorAll('.letter')
                            if (letter) {
                                letter.forEach((item, index) => {
                                    let delay = index * 0.05
                                    item.style = `transition-delay:${delay}s`
                                })
                            }
                        })
                    }
                })
            }
        })
    }

    let $window = $(window);

    function scrollAddClass(el, className) {
        $(el).each(function() {
            let el = this;
            if (
                $(el).offset().top <
                $window.scrollTop() + ($window.height() / 10) * 8
            ) {
                $(el).addClass(className);
            }
        });
    }

    function bindImageAnimations() {
        scrollAddClass(".txt-ani .letter", "run");
        scrollAddClass(".txt-ani-second .txt-ani-second-item", "run");


        $window.on("scroll", function() {
            scrollAddClass(".txt-ani .letter", "run");
            scrollAddClass(".txt-ani-second .txt-ani-second-item", "run");
        });
    }
    bindImageAnimations();
}