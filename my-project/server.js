const express = require('express');
const mysql = require('mysql2');
const app = express();
const cors = require('cors');

app.use(cors());

const pool = mysql.createPool({
    host: '5.23.51.104', 
    user: 'cu98932_bgbi',
    password: '3324Avel',
    database: 'cu98932_bgbi'
  }).promise()

async function getAll() {
    const [rows] = await pool.query("select * from bg_tasks_control")
    return rows
}

  app.get('/GoBi/Bi/getlist', (req, res) => {
    res.sendStatus(200);
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

  app.use(express.json());

  app.post('/GoBi/Bi/update', (req, res) => {
    const updated = req.body;  // Данные, полученные из запроса
    let values = [updated.delay, updated.transfer, updated.report, updated.ID]
    try {
      const sql = `UPDATE bg_tasks_control SET delay = ?, transfer = ?, report = ? WHERE ID = ?`;
      pool.query(sql, values, (req, res));
      res.sendStatus(200);

    } catch (error) {
      console.error('Ошибка при обновлении данных:', error);
      res.sendStatus(500);
    }

    res.send('успех');
  });

  
  

app.listen(443, () => {
    console.log('Сервер запущен на порту 443');
});

 