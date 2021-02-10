function setClock() {
    let today = new Date()
    let hours = today.getHours(); // 시
    let minutes = today.getMinutes();  // 분
    if(minutes < 10) {
        minutes = '0' + minutes;
    }
    let seconds = today.getSeconds();  // 초
    if(seconds < 10) {
        seconds = '0' + seconds;
    }

    let open_hours = 09
    let open_min = 00
    let open_sec = 00
    if(15 <= hours && hours < 24) {
        remaining_hours = open_hours + 24 - hours;
    }
    if (0 <= hours && hours < 9) {
        remaining_hours = open_hours - hours - 1;
    }
    if (9 <= hours && hours < 15) {
        document.getElementById('time').innerHTML = "거래 중"
    }
    
    let remaining_min = 60 - minutes;
    let remaining_sec = 60 - seconds;
    let time = '개장까지 ' + remaining_hours + '시간 ' + remaining_min + '분 ' + remaining_sec + '초 남음';


    document.getElementById('time').innerHTML = time;
    setInterval(setClock,1000); //1초마다 검사를 해주면 실시간으로 시간을 알 수 있다. 
}