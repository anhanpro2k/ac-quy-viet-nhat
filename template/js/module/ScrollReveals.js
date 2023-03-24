export default function ScrollReveals() {
    const itemLazy = document.querySelectorAll('.item-lazy');
    if(itemLazy) {
        ScrollReveal().reveal(itemLazy, {
            interval:200,
            delay: 200,
            duration: 300,
            easing: 'ease-in',
        });
    }
    
}