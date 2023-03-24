export default function MobileModule() {
    const burgerBtn = document.getElementById("hamburger");

    const mobile = document.querySelector(".mobile");
    const mobileOverLay = document.querySelector(".mobile-overlay");
    const body = document.getElementsByTagName("body")[0];
    const header = document.querySelector(".header");
    const mobileClose = document.querySelector(".mobile-close");

    let isOpen = false;
    if (burgerBtn) {
        burgerBtn.addEventListener("click", () => {
            isOpen = !isOpen;
            if (isOpen) {
                burgerBtn.classList.add("active");
                mobile.classList.add("open");
                mobileOverLay.classList.add("open");
                body.style.overflowY = "hidden";
            } else {
                burgerBtn.classList.remove("active");
                mobile.classList.remove("open");
                mobileOverLay.classList.remove("open");
                body.style.overflowY = "scroll";
            }
        });
    }
    if (mobileClose) {
        mobileClose.addEventListener("click", function() {
            isOpen = false;
            burgerBtn.classList.remove("active");
            mobile.classList.remove("open");
            mobileOverLay.classList.remove("open");
            body.style.overflowY = "scroll";
        });
    }
    if (mobileOverLay) {
        mobileOverLay.addEventListener("click", function() {
            isOpen = false;
            burgerBtn.classList.remove("active");
            mobile.classList.remove("open");
            mobileOverLay.classList.remove("open");
            header.classList.remove("sticky");
            body.style.overflowY = "scroll";
        });
    }
    const menuNavs = document.querySelectorAll(".header .menu-nav");
    if (menuNavs) {
        menuNavs.forEach((item) => {
            const menuLinks = item.querySelectorAll(".menu-item.dropdown .menu-link");
            menuLinks.forEach((item) => {
                const contentOld = item.innerHTML;
                const contentNew = `${contentOld} <i class="far fa-chevron-down"></i>`;
                item.innerHTML = contentNew;
            });
        });
    }
    const arrowIcon = document.querySelectorAll(
        ".mobile-nav .menu-list .menu-item a i"
    );
    if (arrowIcon) {
        arrowIcon.forEach((item) => {
            item.addEventListener("click", (e) => {
                e.preventDefault();
                const menu =
                    item.parentElement.parentElement.querySelectorAll(".menu-list")[0];
                $(menu).slideToggle();
                $(item.parentElement.parentElement).toggleClass("active");
            });
        });
    }

    // Catemenu
    const cateMenus = document.querySelectorAll(".cate-menu");
    if (cateMenus) {
        cateMenus.forEach((item) => {
            const menuLinks = item.querySelectorAll(".cate-menu-item.dropdown a");
            menuLinks.forEach((item) => {
                const contentOld = item.innerHTML;
                const contentNew = `${contentOld} <i class="far fa-chevron-down"></i>`;
                item.innerHTML = contentNew;
            });
        });
    }
    const cateMenuArrow = document.querySelectorAll(
        ".cate-menu .cate-menu-item a i"
    );
    if (cateMenuArrow) {
        cateMenuArrow.forEach((item) => {
            item.addEventListener("click", (e) => {
                e.preventDefault();
                const menu =
                    item.parentElement.parentElement.querySelectorAll(
                        ".cate-menu-list"
                    )[0];
                $(menu).slideToggle();
                $(item.parentElement.parentElement).toggleClass("active");
            });
        });
    }

    // Mega menujs
    const megaSidebarItems = document.querySelectorAll(".megas-menu-item");
    const megaMenus = document.querySelectorAll(".megas-menu");
    const mega = document.querySelectorAll(".megas");
    if (megaSidebarItems && megaSidebarItems[0]) {
        megaSidebarItems[0].classList.add("active");
        megaMenus[0].classList.add("open");
        megaSidebarItems.forEach((item, index) => {
            item.addEventListener("mouseover", () => {
                megaSidebarItems.forEach((item) => {
                    item.classList.remove("active");
                });
                item.classList.add("active");
                megaMenus.forEach((item) => {
                    item.classList.remove("open");
                });
                if (megaMenus[index]) {
                    megaMenus[index].classList.add("open");
                }
            });
        });
    }
}