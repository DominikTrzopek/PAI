var timer;

function startTimer(duration, display) {
    display = document.querySelector('#time');
    timer = duration;
    var minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;
        if (--timer < 0) {
            timer = 0;
            display.classList.add('time');
        }
        else {
            display.classList.remove('time');
        }
        setCookie("remainingTime",timer,100);
        console.log(getCookieValue("remainingTime"));
    }, 1000);
}



const getCookieValue = (name) => (
    document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)')?.pop() || ''
)

function setCookie(name,value,seconds) {
    var expires = "";
    if (seconds) {
        var date = new Date();
        date.setTime(date.getTime() + (seconds*60));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}


window.onload = function () {
    var value = getCookieValue("remainingTime");
    startTimer(value);

};

