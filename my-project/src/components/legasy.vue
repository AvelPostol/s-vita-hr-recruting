
<template>
    <div>
     <v-card-title
     class="v-card-title-cust"
     >
      <h2>Панель редактирования</h2>
      <br>
      <h3>(1 - учитывать, 0 - не учитывать)</h3>
     </v-card-title>
  
     <div class="search-container">
        <v-text-field
          v-model="search"
          label="Поиск"
          append-icon="mdi-magnify"
          single-line
          hide-details
          class="my-search-input"
        ></v-text-field>
      </div>
  
     <v-card-text
     class="v-card-text-cust"
     >
      <v-row>
        <v-col v-for="header in headers" :key="header.key">
          <h3>{{ header.text }}</h3>
        </v-col>
      </v-row>
  
  
  
      <v-data-table
        :headers="headers"
        :items="users"
        mobile-breakpoint="800"
        class="elevation-0 data-table"
        :search="search"
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
        <span v-if="editedItem.columns.id_task">ID задачи {{editedItem.columns.id_task}}</span>
        <span v-else>Редактирование</span>
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
        <v-btn color="blue darken-1" text @click="closeEditPopup()">Cancel</v-btn> 
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
        search: '',
        editedItem: {},
        dialog: false,
        users: [],
        headers: [
          { text: 'ID', key: 'ID' },
          { text: 'ID задачи', key: 'id_task' },
          { text: 'Роль', key: 'role' },
          { text: 'Пользователь', key: 'user' },
          { text: 'Просрочки', key: 'delay' },
          { text: 'Переносы', key: 'transfer' },
          { text: 'Учет', key: 'report' },
          { text: 'Править', key: 'actions' }
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
    openEditPopup(item) {
      this.editedItem = { ...item }; // Копируем данные для редактирования
      this.dialog = true; // Устанавливаем значение dialog в true для открытия попапа
    },
    closeEditPopup() {
      this.dialog = false; // Закрываем попап редактирования
    //  this.editedItem = null; // Сбрасываем данные для редактирования
    },
  
    fetchUsers() {
        axios.get('http://10.0.3.49/1911/GoBI/Bi/server.php')
          .then(response => {
            this.users = response.data;
            console.log(this.users);
          })
          .catch(error => {
            console.error('Ошибка при получении пользователей:', error);
          });
      },
    saveItem(editedItem) {
  
      if(!editedItem.delay){
        editedItem.delay = editedItem.columns.delay;
      }
      if(!editedItem.transfer){
        editedItem.transfer = editedItem.columns.transfer;
      }
      if(!editedItem.report){
        editedItem.report = editedItem.columns.report;
      }
      if(!editedItem.ID){
        editedItem.ID = editedItem.columns.ID;
      }
      if(!editedItem.id_task){
        editedItem.id_task = editedItem.columns.id_task;
      }
      if(!editedItem.role){
        editedItem.role = editedItem.columns.role;
      }
      if(!editedItem.user){
        editedItem.user = editedItem.columns.user;
      }
  
  
      let parametros = {
        ID: editedItem.ID,
        user: editedItem.user,
        role: editedItem.role,
        id_task: editedItem.id_task,
        delay: editedItem.delay, 
        transfer: editedItem.transfer, 
        report: editedItem.report};   
        console.log(parametros);
  
      axios.post('http://10.0.3.49/1911/GoBI/Bi/server.php', parametros)
        .then(response => {
          console.log('сохранено');
          this.dialog = false; // Закрываем попап редактирования
          console.log(response.data);
        })
        .catch(error => {
          console.error('Ошибка при получении пользователей:', error);
        });
  
        
    },
    }
  };
  </script>
  
  
  
