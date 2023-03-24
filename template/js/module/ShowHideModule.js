export default function ShowHideModule() {
    const showhideBlocks = document.querySelectorAll(".show-hide-block");
    if (showhideBlocks) {
        showhideBlocks.forEach((item) => {
            const dataShow = item.getAttribute("data-show-hide-number");
            const dataShowText = item.getAttribute("data-show-hide-show-text");
            const dataHideText = item.getAttribute("data-show-hide-hide-text");
            const showhideContents = item.querySelector(".show-hide-content");
            const div = document.createElement("div");
            div.classList = "show-hide-toggle";
            div.innerText = dataShowText;
            var itemHeight = $(showhideContents).height();
            var lineHeight = parseInt($(showhideContents).css("line-height"), 10);
            var numberLine = Math.round(itemHeight / lineHeight);
            if (numberLine > dataShow) {
                item.appendChild(div);
                showhideContents.style = `display:-webkit-box;-webkit-line-clamp:${dataShow};-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis; word-break: break-word;`;
            }
        });
    }
    const showhideToggles = document.querySelectorAll(".show-hide-toggle");
    if (showhideToggles) {
        showhideToggles.forEach((item) => {
            item.addEventListener("click", () => {
                const dataShowText = item.parentElement.getAttribute(
                    "data-show-hide-show-text"
                );
                const dataHideText = item.parentElement.getAttribute(
                    "data-show-hide-hide-text"
                );
                const dataShow = item.parentElement.getAttribute(
                    "data-show-hide-number"
                );
                if (
                    item.parentElement.querySelector(".show-hide-content").style
                    .overflow == "hidden"
                ) {
                    item.parentElement.querySelector(
                        ".show-hide-content"
                    ).style = `display:-webkit-box;-webkit-line-clamp: 0;-webkit-box-orient: vertical;overflow: auto;text-overflow: ellipsis; word-break: break-word;`;
                    item.innerText = dataHideText;
                } else {
                    item.parentElement.querySelector(
                        ".show-hide-content"
                    ).style = `display:-webkit-box;-webkit-line-clamp:${dataShow};-webkit-box-orient: vertical;overflow: hidden;text-overflow: ellipsis; word-break: break-word;`;
                    item.innerText = dataShowText;
                }
            });
        });
    }
}