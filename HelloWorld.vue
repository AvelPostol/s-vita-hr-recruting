
<template>
  <div>
   <v-card-title>
    <h2>Панель редактирования1</h2>
   </v-card-title>
   <v-card-text>
    <v-row>
      <v-col v-for="header in headers" :key="header.key">
        <h3>{{ header.text }}</h3>
      </v-col>
    </v-row>
    <v-data-table
      :headers="headers"
      :items="users"
      mobile-breakpoint="800"
      class="elevation-0"
    >
    <template v-slot:[`item.actions`]="{ item }">
                          <div class="text-truncate">
                            <v-icon
                              small
                              class="mr-2"
                              @click="openEditPopup(item)"
                              color="primary" 
                            >
                              mdi-pencil
                            </v-icon>
                        </div>
                      </template>
  
  </v-data-table>

   </v-card-text>
  
  <v-dialog v-model="dialog" max-width="500px">
  <template v-slot:activator="{ on }">
    <div class="d-flex">
      <v-btn color="primary" dark class="ml-auto ma-3" @click="dialog = true" v-on="on">
        New
        <v-icon small>mdi-plus-circle-outline</v-icon>
      </v-btn>
    </div>
  </template>
  <v-card>
    <v-card-title>
      <span v-if="editedItem.ID">Редактирование( 1 - учитывать, 0 - нет) {{editedItem.ID}}</span>
      <span v-else>Редактирование {{editedItem.ID}}</span>
    </v-card-title>
    <v-card-text>
      <v-row>
        <v-col cols="12" sm="12">
          <v-text-field v-model="editedItem.delay" label="Просрочки"></v-text-field>
        </v-col>
        <v-col cols="12" sm="12">
          <v-text-field v-model="editedItem.transfer" label="Переносы"></v-text-field>
        </v-col>
        <v-col cols="12" sm="12">
          <v-text-field v-model="editedItem.report" label="Учет задачи"></v-text-field>
        </v-col>
      </v-row>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="blue darken-1" text @click="closeEditDialog()">Cancel</v-btn>
      <v-btn color="blue darken-1" text @click="saveItem(editedItem)">Save</v-btn>
    </v-card-actions>
  </v-card>
</v-dialog>

  </div>
</template>




<script setup>
  import { VDataTable } from 'vuetify/labs/VDataTable'
</script>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      editDialog: false, // Переменная состояния попапа редактирования
      editedItem: {},
      dialog: false,
      users: [],
      headers: [
        { text: 'ID задачи', key: 'ID' },
        { text: 'Просрочки', key: 'delay' },
        { text: 'Переносы', key: 'transfer' },
        { text: 'Учет задачи', key: 'report' },
        { text: 'Редактирование', key: 'actions' }
      ]
    };
  },
  mounted() {
    console.log('Полученные данные:', this.headers); // Вывод полученных данных в консол
    this.fetchUsers();
  },
 
  methods: {
    showEditDialog(item) {
        this.editedItem = item||{}
        this.dialog = !this.dialog
    },
    fetchUsers() {
      axios.get('http://localhost:3000/getlist')
        .then(response => {
          this.users = response.data;
          console.log(this.users);
        })
        .catch(error => {
          console.error('Ошибка при получении пользователей:', error);
        });
    },
  openEditPopup(item) {
    this.editedItem = { ...item }; // Копируем данные для редактирования
    this.dialog = true; // Устанавливаем значение dialog в true для открытия попапа
  },
  closeEditPopup() {
    this.editDialog = false; // Закрываем попап редактирования
    this.editedItem = null; // Сбрасываем данные для редактирования
  },
  saveItem(editedItem) {
    let parametros = {delay:editedItem.delay, transfer:editedItem.transfer, report:editedItem.report};   
    console.log(parametros);
    axios.put(
    axios({
      method: 'post',
      url: `http://localhost:3000/getlist/${editedItem.columns.ID}`,
      data: editedItem,
      headers: {
        'Content-Type': 'application/json',
      },
    })
    )
      .then(response => {
        console.log('сохранено');
        console.log(response.data);
      })
      .catch(error => {
        console.error('Ошибка при получении пользователей:', error);
        // Обработка ошибки при обновлении данных
        // Например, вы можете вывести сообщение об ошибке или выполнить другие действия
      });
  },
  }
};
</script>



