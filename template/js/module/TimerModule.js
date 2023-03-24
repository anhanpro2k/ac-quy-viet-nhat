export default function TimerModule() {
    const daysEl = document.getElementById("days");
    const hoursEl = document.getElementById("hours");
    const minsEl = document.getElementById("mins");
    const secondsEl = document.getElementById("seconds");
    if(daysEl) {
        const getDate = document.querySelector('.home-prod-time');
        const dates = getDate.getAttribute("data-time");
    
        const newYears = dates;
    
        function countdown() {
            const newYearsDate = new Date(newYears);
            const currentDate = new Date();
    
            const totalSeconds = (newYearsDate - currentDate) / 1000;
    
            const days = Math.floor(totalSeconds / 3600 / 24);
            const hours = Math.floor(totalSeconds / 3600) % 24;
            const mins = Math.floor(totalSeconds / 60) % 60;
            const seconds = Math.floor(totalSeconds) % 60;
    
            daysEl.innerHTML = days;
            hoursEl.innerHTML = formatTime(hours);
            minsEl.innerHTML = formatTime(mins);
            secondsEl.innerHTML = formatTime(seconds);
    
            if (days < 0) {
                daysEl.innerHTML = 0;
                hoursEl.innerHTML = 0;
                minsEl.innerHTML = 0;
                secondsEl.innerHTML = 0;
            }
        }
    
        function formatTime(time) {
            return time < 10 ? `0${time}` : time;
        }
    
        // initial call
        countdown();
    
        setInterval(countdown, 1000);
    }
    
}
