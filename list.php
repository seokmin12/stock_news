<div class="container">
        <div id="board_area">
            <h4 id="d">지수</h4>
            <table class="table table-striped">
                    <tr>
                        <td>name</td>
                        <td>price</td>
                        <td>rate</td>
                    </tr>
                <?php 
                    $kospi_sql = " SELECT * FROM kospi;";
                    $kosdaq_sql = "SELECT * FROM kosdaq;";

                    $kospi_rate_sql = "SELECT * FROM kospi WHERE rate LIKE '%-%'";
                    $kosdaq_rate_sql = "SELECT * FROM kosdaq WHERE rate LIKE '%-%'";

                    $kospi_result = mysqli_query($conn, $kospi_sql);
                    $kosdaq_result = mysqli_query($conn, $kosdaq_sql);

                    $kospi_rate_result = mysqli_query($conn, $kospi_rate_sql);
                    $kosdaq_rate_result = mysqli_query($conn, $kosdaq_rate_sql);

                    $kospi_row = mysqli_fetch_array($kospi_result);
                    $kosdaq_row = mysqli_fetch_array($kosdaq_result);

                    $kospi_rate_row = mysqli_fetch_array($kospi_rate_result);
                    $kosdaq_rate_row = mysqli_fetch_array($kosdaq_rate_result);

                    $kospi_price = $kospi_row['price'];
                    $kospi_rate = $kospi_row['rate'];
                    $kosdaq_price = $kosdaq_row['price'];
                    $kosdaq_rate = $kosdaq_row['rate'];
                ?>
                <tbody>
                    <tr>
                        <td>코스피</td>
                        <td id="kospi">
                            <?= $kospi_price ?>
                        </td>
                        <td id="kospi2">
                            <?= $kospi_rate ?>
                        </td>
                    </tr>
                    <tr>
                        <td>코스닥</td>
                        <td id="kosdaq">
                            <?= $kosdaq_price ?>
                        </td>
                        <td id="kosdaq2">
                            <?= $kosdaq_rate ?>
                        </td>
                    </tr>
                </tbody>
                </table>
            <h4><a href="index.php">주요 뉴스</a> &nbsp;
                <?php
                    $amount_sql = mysqli_query($conn, "SELECT * FROM news");
                    $amount = mysqli_num_rows($amount_sql);
                    echo $amount.'개';
                ?>
            </h4>
                <table class="table table-striped">
                    <tr>
                        <th>제목</th>
                        <th>날짜/시간</th>
                    </tr>
                    <?php
                        $page_sql = mysqli_query($conn, "SELECT * FROM news");
                        $total_record = mysqli_num_rows($page_sql);

                        $list = 15;
                        $block_cnt = 5;
                        $block_num = ceil($page / $block_cnt);

                        $block_start = (($block_num - 1) * $block_cnt) + 1;
                        $block_end = $block_start + $block_cnt - 1;

                        $total_page = ceil($total_record / $list);
                        if($block_end > $total_page)
                            $block_end = $total_page;

                        $total_block = ceil($total_page / $block_cnt);
                        $page_start = ($page - 1) * $list;
                    ?>
                    <?php
                        $sql = "SELECT * FROM news ORDER BY date DESC, number LIMIT $page_start, $list;";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_array($result)) {
                            $title = $row['title'];
                            $url = $row['url'];
                            // if(strlen($title)>30) {
                            //     $title = str_replace($row["title"],mb_substr($row["title"],0,30,"utf-8")."...",$row["title"]);
                            // } 
                        
                        ?>
                            <tbody>
                                <tr>
                                    <td>
                                        <?='<a href="'.$url.'">'.$title.'</a>' ?>
                                    </td>
                                    <td>
                                        <?=$row['date']; ?>
                                    </td>
                                </tr>
                            </tbody>
                <?php } ?>
                </table>
                <div id="page_num">
                    <?php
                        if ($page <= 1) {
                            //빈 값
                        } else {
                            echo "<a id='paging' href='index.php?page=1'>처음</a>";
                        }
                        if ($page <= 1) {
                            //빈 값
                        } else {
                            $pre = $page - 1;
                            echo "<a id='paging' href='index.php?page=$pre'>◀ 이전</a>";
                        }
                        for ($i = $block_start; $i <= $block_end; $i++) {
                            if ($page == $i) {
                                echo "<b> $i </b>";
                            } else {
                                echo "<a id='paging' href='index.php?page=$i'> $i </a>"; 
                            }                            
                        }
                        if ($page >= $total_page) {
                            //빈 값
                        } else {
                            $next = $page + 1;
                            echo "<a id='paging' href='index.php?page=$next'> 다음 ▶</a>";
                        }
                        if ($page >= $total_page) {
                            //빈 값
                        } else {
                            echo "<a id='paging' href='index.php?page=$total_page'>마지막</a>";
                        }
                    ?>
                </div>
                <h4>개장전 꼭 읽어야 할 이슈</h4>
                <table class="table table-striped">
                    <tr>
                        <th>제목</th>
                        <th>날짜/시간</th>
                    </tr>
                    <?php
                        $sql2 = "SELECT * FROM news WHERE title LIKE '%이슈%';";
                        $result2 = mysqli_query($conn, $sql2);
                        while($row2 = mysqli_fetch_array($result2)) {
                            $title2 = $row2['title'];
                            $url2 = $row2['url'];
                            $date2 = $row2['date'];
                        }
                    ?>
                    <tbody>
                        <tr>
                            <td>
                                <?='<a href="'.$url2.'">'.$title2.'</a>' ?>
                            </td>
                            <td>
                                <?=$date2 ?>
                            </td>
                        </tr>
                    </tbody>
                
                </table>
        </div>
    </div>