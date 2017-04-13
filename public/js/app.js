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

        if ( (t<(5*60*1000)) && ((t%(60*1000))===0) ){
            location.reload(true);
        }

        daysSpan.innerHTML = t.days;
        hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

        if( t.total <= 0 ) {
            clearInterval(timeInterval);
        }
    }

    updateClock();
    let timeInterval = setInterval(updateClock, 1000);
}

$(document).ready(function() {
    let $waiting = $('#waiting');

    if( $waiting.length > 0 ) {
        let deadline = new Date(Date.parse($waiting.data('end')));
        initializeClock('waiting', deadline);initializeClock('waiting', deadline);
    }
});