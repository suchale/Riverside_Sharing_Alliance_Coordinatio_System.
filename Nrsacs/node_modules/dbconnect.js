var mysql = require('mysql');

dbconnect = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database:"rsacs"
});

module.exports = dbconnect
 

