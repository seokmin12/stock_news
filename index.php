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
    <link rel="stylesheet" href="index.css?after">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />
    <script src="timer.js"></script>
    <title>주식 뉴스</title>
</head>
<body onload="setClock()">
    <h3 id="time" style="text-align: center; margin-top: 25px"></h3>
    <?php include 'list.php' ?>
    <footer id="footer">
        <li>
            <a href="https://www.youtube.com/channel/UCQNE2JmbasNYbjGAcuBiRRg">제작 도움: 조코딩 유튜브 채널</a>
        </li>
        <li>
            <a href="mailto:dltjrals13@naver.com">문의 하기</a>
        </li>
    </footer>
    <?php
        if($kospi_rate_row['rate'] == '') {
            echo '<script>document.getElementById("kospi").style.color = "red"</script>';
            echo '<script>document.getElementById("kospi2").style.color = "red"</script>';
        } else {
            echo '<script>document.getElementById("kospi").style.color = "blue"</script>';
            echo '<script>document.getElementById("kospi2").style.color = "blue"</script>';
        }

        if($kosdaq_rate_row['rate'] == '') {
            echo '<script>document.getElementById("kosdaq").style.color = "red"</script>';
            echo '<script>document.getElementById("kosdaq2").style.color = "red"</script>';
        } else {
            echo '<script>document.getElementById("kosdaq").style.color = "blue"</script>';
            echo '<script>document.getElementById("kosdaq2").style.color = "blue"</script>';
        }
    ?>
</body>
</html>