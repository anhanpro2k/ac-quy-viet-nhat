export default function ScrollDesktop() {
    let startX;
    let scrollLeft;
    let isDown = false;
  
    const container = document.querySelector('.scrollDeskJS');
  
    if(container) {
      container.addEventListener('mousedown', e => {
        isDown = true;
        container.classList.add('active');
        startX = e.pageX - container.offsetLeft;
        scrollLeft = container.scrollLeft;
      });
    
      container.addEventListener('mouseleave', () => {
        isDown = false;
        container.classList.remove('active');
      });
    
      container.addEventListener('mouseup', () => {
        isDown = false;
        container.classList.remove('active');
      });
    
      container.addEventListener('mousemove', e => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - container.offsetLeft;
        const walk = (x - startX) * 3;
        container.scrollLeft = scrollLeft - walk;
      });
    }
}
