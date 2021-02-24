<?php
    include 'conn.php';
    
    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <script src="timer.js"></script>
    <title>주식 뉴스</title>
</head>

<body onload="setClock()">
    <h3 id="time" style="text-align: center; margin-top: 25px"></h3>
    <form action="news_search.php" method="post">
        <input type="text" id="search" name="search" placeholder="실시간 뉴스 검색" autocomplete="off">
        <input type="submit" value="submit" hidden>
    </form>
    <?php include 'list.php' ?>
    <footer id="footer">
        <li>
            <span style="font-size: 20px; font-weight: 700; color: #FFA083;">제작: 이석민</span> <span> | </span>
            <span><a href="https://www.youtube.com/channel/UCQNE2JmbasNYbjGAcuBiRRg">제작 도움: 조코딩 유튜브 채널</a></span> <span>    |    </span>
            <span><a href="https://hairstyle-ai.ga">헤어스타일 테스트</a></span> <span> | </span>
            <span><a href="mailto:dltjrals13@naver.com">문의 하기</a></span>
        </li>

        <br><br>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            서비스 소개
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">서비스 소개</h5>
                    </div>
                    <div class="modal-body">
                        본 서비스는 주린이들을 위한 주식에 관한 주요 뉴스들을 한 곳에 모아 놓은 서비스입니다. 주식을 최근에 시작한 주린이들은 기사들을 어디서 어떻게 찾아야하는지 잘 모르기
                        때문에 이 서비스를 만들게 되었습니다. 뉴스 기사들은 팍스넷의 기사를 크롤링 하여 구글의 자연어 처리 api를 이용해 AI가 긍정적이라고 평가한 기사만 크롤링
                        하였습니다.<br>코스피 지수와 코스닥 지수는 네이버에서 크롤링 하였습니다.<br>서버는 Google Cloud Platform을 사용했습니다.<br><br><a href="https://github.com/seokmin12/stock_news"><span>소스 코드</span></a>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <?php
        if($kospi_minus_rate_row['rate'] == '' && $kospi_plus_rate_row['rate'] == '') {
            echo '<script>document.getElementById("kospi").style.color = "black"</script>';
            echo '<script>document.getElementById("kospi2").style.color = "black"</script>';
        }
        else if($kospi_minus_rate_row['rate'] == '') {
            echo '<script>document.getElementById("kospi").style.color = "red"</script>';
            echo '<script>document.getElementById("kospi2").style.color = "red"</script>';
        }
        else if($kospi_plus_rate_row['rate'] == ''){
            echo '<script>document.getElementById("kospi").style.color = "blue"</script>';
            echo '<script>document.getElementById("kospi2").style.color = "blue"</script>';
        }
        if($kosdaq_minus_rate_row['rate'] == '' && $kosdaq_plus_rate_row['rate'] == '') {
            //nothing
        }
        else if($kosdaq_minus_rate_row['rate'] == '') {
            echo '<script>document.getElementById("kosdaq").style.color = "red"</script>';
            echo '<script>document.getElementById("kosdaq2").style.color = "red"</script>';
        }
        else if($kosdaq_plus_rate_row['rate'] == ''){
            echo '<script>document.getElementById("kosdaq").style.color = "blue"</script>';
            echo '<script>document.getElementById("kosdaq2").style.color = "blue"</script>';
        }
    ?>
</body>

</html>