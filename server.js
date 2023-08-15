const express = require('express');
const mysql = require('mysql2');
const app = express();
const cors = require('cors');

app.use(cors());

const pool = mysql.createPool({
    host: '5.23.51.104', // Адрес вашего MySQL-сервера
    user: 'cu98932_bgbi',
    password: '3324Avel',
    database: 'cu98932_bgbi'
  }).promise()

async function getAll() {
    const [rows] = await pool.query("select * from bg_tasks_control")
    return rows
}

  app.get('/getlist', (req, res) => {
    getAll()
      .then(query => {
        res.send(query);
      })
      .catch(error => {
        // Обработка ошибок
        console.error(error);
        res.status(500).send('Произошла ошибка при получении данных');
      });
  });

  app.put('/getlist/:id', (req, res) => {
    const id = req.params.id;
    const updated = req;  // Данные, полученные из запроса
    console.log('тело: ', updated);
    console.log(id);
   /* try {
      pool.query('UPDATE bg_tasks_control SET ? WHERE ID = ?', [updatedUser, id]);
      res.sendStatus(200);
    } catch (error) {
      console.error('Ошибка при обновлении данных:', error);
      res.sendStatus(500);
    }*/
  });


  

const server = app.listen(3000, () => {
    console.log('Сервер запущен на порту 3000');
});