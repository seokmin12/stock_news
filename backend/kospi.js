var mysql = require('mysql');
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
    
    connection.query('DROP TABLE kospi', function(err, results, fields) {
        if (err) {
              console.log(err);
          }
          console.log("기존의 데이터를 제거하였습니다.");
    });
    
    connection.query('CREATE TABLE kospi (number INT(11) NOT NULL AUTO_INCREMENT, price VARCHAR(300) NOT NULL, rate VARCHAR(300) NOT NULL, PRIMARY KEY(number));', function(err, results, fields) {
        if (err) {
            console.log(err);
        }
        console.log("새로운 테이블을 생성하였습니다.");
    });
    
    request.get("https://finance.naver.com/sise/sise_index.nhn?code=KOSPI", function(err, res, body) {
        const $ = cheerio.load(body);
        const price = $("#now_value").text();
        const rate = $("#change_value_and_rate").text().replace('���', "");
        console.log(price);
        console.log(rate);
        var sql = "INSERT INTO kospi (price, rate) VALUES (?,?)"
        var contents = [price, rate];
    
        connection.query(sql,contents, function(errs, results, fields) {
            if (errs) {
                console.log(errs);
            } else {
                console.log("DB에 저장완료");
            }
        })
    });
    
    connection.query('DROP TABLE kosdaq', function(err, results, fields) {
        if (err) {
              console.log(err);
          }
          console.log("기존의 데이터를 제거하였습니다.");
    });
    
    connection.query('CREATE TABLE kosdaq (number INT(11) NOT NULL AUTO_INCREMENT, price VARCHAR(300) NOT NULL, rate VARCHAR(300) NOT NULL, PRIMARY KEY(number));', function(err, results, fields) {
        if (err) {
            console.log(err);
        }
        console.log("새로운 테이블을 생성하였습니다.");
    });
    
    request.get("https://finance.naver.com/sise/sise_index.nhn?code=KOSDAQ", function(err, res, body) {
        const $ = cheerio.load(body);
        const price = $("#now_value").text();
        const rate = $("#change_value_and_rate").text().replace('���', "");
        console.log(price);
        console.log(rate);
        var sql = "INSERT INTO kosdaq (price, rate) VALUES (?,?)"
        var contents = [price, rate];
    
        connection.query(sql,contents, function(errs, results, fields) {
            if (errs) {
                console.log(errs);
            } else {
                console.log("DB에 저장완료");
            }
        })
    });
}

setInterval(crawling, 60000)