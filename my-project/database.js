import mysql from 'mysql2';

const pool = mysql.createPool({
    host: '5.23.51.104', // Адрес вашего MySQL-сервера
    user: 'cu98932_bgbi',
    password: '3324Avel',
    database: 'cu98932_bgbi'
  }).promise()

 export async function getAll() {
    const [rows] = await pool.query("select * from bg_tasks_control")
    return rows
  }
  
  const notes = await getAll()
  console.log(notes)