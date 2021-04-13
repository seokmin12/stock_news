const mysql = require("mysql");
const request = require("request");
const cheerio = require("cheerio");

function crawling() {
    var connection = mysql.createConnection({
        host: '127.0.0.1',
        user: 'root',
        password: 'seokmin68',
        database: 'news_crawler',
        port: 3307
    });

    connection.connect();

    connection.query('DROP TABLE news', function (err, results, fields) {
        if (err) {
            console.log(err);
        }
        console.log("기존의 데이터를 제거하였습니다.");
    });

    connection.query('CREATE TABLE news (number INT(11) NOT NULL AUTO_INCREMENT, title VARCHAR(300) NOT NULL, url VARCHAR(300) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(number));', function (errss, results, fields) {
        if (errss) {
            console.log(errss);
        }
        console.log("새로운 테이블을 생성하였습니다.");
    })

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    }
    var now_date = yyyy + mm + dd;

    request.get("http://www.paxnet.co.kr/news/infostock?newsSetId=6966&currentPageNo=1&genDate=" + now_date + "&objId=N6966", function (err, res, body) {
        const $ = cheerio.load(body);
        const last_page = $("#contents > div.cont-area > div.board-thumbnail > div > a.next").attr('onclick');
        const int_last_page = last_page.replace(/[^0-9]/g, "") + 1;
        for (x = 1; x <= int_last_page; ++x) {
            request.get("http://www.paxnet.co.kr/news/infostock?newsSetId=6966&currentPageNo=" + x + "&genDate=" + now_date + "&objId=N6966", function (err, res, body) {
                const $ = cheerio.load(body);
                const num = $("#contents > div.cont-area > div.board-thumbnail > ul.thumb-list > li").length;
                for (i = 1; i <= num; i++) {
                    var title = $("#contents > div.cont-area > div.board-thumbnail > ul > li:nth-child(" + i + ") > dl > dt > a").text();
                    var href = $("#contents > div.cont-area > div.board-thumbnail > ul > li:nth-child(" + i + ") > dl > dt > a").attr('href');
                    href = 'http://www.paxnet.co.kr' + href
                    var date = $("#contents > div.cont-area > div.board-thumbnail > ul > li:nth-child(" + i + ") > dl > dd.date > span:nth-child(2)").text();

                    var sql = "INSERT INTO news (title, url, date) VALUES (?,?,?)";

                    var contents = [title, href, date];

                    connection.query(sql, contents, function (errs, results, fields) {
                        if (errs) {
                            console.log(errs);
                        } else {
                            console.log("DB에 저장완료");
                        }
                    })
                }
            });
        }
    });

    //connection.end()
}

setInterval(crawling, 10000)
