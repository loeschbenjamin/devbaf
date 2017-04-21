function getTimeRemaining(endtime)
{
    let t = Date.parse(endtime) - Date.parse(new Date());
    let seconds = Math.floor((t / 1000) % 60);
    let minutes = Math.floor((t / 1000 / 60) % 60);
    let hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    let days = Math.floor(t / (1000 * 60 * 60 * 24));

    return {
        'total': t,
        'days': days,
        'hours': hours,
        'minutes': minutes,
        'seconds': seconds,
    };
}

function initializeClock(id, endtime)
{
    let clock = document.getElementById(id);
    let daysSpan = clock.querySelector(".clock__day");
    let hoursSpan = clock.querySelector(".clock__hour");
    let minutesSpan = clock.querySelector('.clock__minute');
    let secondsSpan = clock.querySelector('.clock__second');

    function updateClock()
    {
        let t = getTimeRemaining(endtime);

        daysSpan.innerHTML = t.days;
        hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

        if( t.total <= 0 ) {
            clearInterval(timeInterval);
            location.reload();
        }
    }

    updateClock();
    let timeInterval = setInterval(updateClock, 1000);
}

$(document).ready(function() {
    let $waiting = $('#waiting');
    let $audio = $('[data-audio-loop="true"]');

    if( $waiting.length > 0 ) {
        let deadline = new Date(Date.parse($waiting.data('end')));
        initializeClock('waiting', deadline);initializeClock('waiting', deadline);
    }

console.log($audio);

    if( $audio.length > 0 ) {
        let myAudio = new Audio('/storage/audio/beer_background_music.mp3');
        myAudio.addEventListener('ended', function() {
            this.currentTime = 0;
            this.play();
        }, false);
        myAudio.play();
    }
});
