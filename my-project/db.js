const express = require('express');
const mysql = require('mysql');
const app = express();
const cors = require('cors');

app.use(cors());

const connection = mysql.createConnection({
    host: '5.23.51.104', // Адрес вашего MySQL-сервера
    user: 'cu98932_bgbi',
    password: '3324Avel',
    database: 'cu98932_bgbi'
});

connection.connect((err) => {
  if (err) {
    console.error('Ошибка подключения к базе данных:', err);
    return;
  }
  console.log('Успешное подключение к базе данных');
});



app.get('/users', (req, res) => {
  const query = 'SELECT * FROM bg_tasks_control';
  connection.query(query, (err, results) => {
    if (err) {
      console.error('Ошибка выполнения запроса:', err);
      res.status(500).send('Ошибка сервера');
      return;
    }
    res.json(results);
  });
});

const server = app.listen(3000, () => {
  console.log('Сервер запущен на порту 3000');
});