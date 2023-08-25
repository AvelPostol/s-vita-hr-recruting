<template>
    <section class="section-comment-line">
      <div class="container">
  
        <v-dialog v-model="enlargedImageVisible" max-width="800" @input="handleDialogClose">
        <v-img :src="enlargedImageSrc" class="enlarged-image" contain>
          <v-btn icon color="primary" @click="closeEnlargedImage">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-img>
      </v-dialog>
  
        <v-card-title>
          <h2 class="otz-title">Отзывы</h2>
        </v-card-title>
        <v-form ref="form" @submit.prevent="submitReview" class="my-form">
      <v-radio-group v-model="reviewType" row>
        <v-radio label="Клиент" value="client"></v-radio>
        <v-radio label="Кандидат" value="candidate"></v-radio>
      </v-radio-group>
      <v-text-field
        v-model="nameOrCompany"
        :label="reviewType === 'client' ? 'Компания клиента' : 'ФИО кандидата'"
        required
        :rules="[requiredRule]"
        class="my-input"
      ></v-text-field>
      <v-textarea
        v-model="comment"
        label="Текст отзыва"
        required
        :rules="[requiredRule]"
        class="my-input"
      ></v-textarea>
      <v-file-input
          v-model="file"
          :label="file ? file.name : 'Выберите файл'"
          accept=".pdf, .doc, .docx, .jpg, .jpeg, .png"
          @change="handleFileChange"
          class="my-input input-dnld"
        >
        </v-file-input>
      <v-checkbox
          v-model="consent"
          :rules="[requiredConsentRule]"
          class="my-checkbox"
        >
          Согласие с 
          <a class="exit-btn" >обработкой персональных данных</a>
        </v-checkbox>
      <v-btn  type="submit" class="button-send-otz section-btn section-btn-v1" @click.prevent="submitReview">Оставить комментарий</v-btn>
    </v-form>
  
  
  
    <v-dialog v-model="dialogVisible" max-width="400" class="my-dialog fank">
      <v-card>
        <v-card-title>Спасибо за отзыв</v-card-title>
        <v-card-text>
          Ваш отзыв был успешно отправлен. Благодарим вас!
        </v-card-text>
        <v-card-actions>
          <v-btn class="section-btn section-btn-v1" @click.stop="closeDialog">Закрыть</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  
    <div class="my-comments">
    <h2>Комментарии</h2>
    <v-card v-for="(review, index) in reviews" :key="index" class="my-comment">
      <v-card-text>
        <strong>{{ review.review_type === 'client' ? 'Название компании:' : 'Имя кандидата:' }}</strong>
        {{ review.name_or_company }}
        <br>
        <br>
        <strong>Комментарий:</strong> {{ review.comment }}
      </v-card-text>
      <v-row v-if="review.file_id">
        <v-col cols="12">
          <v-card>
            <v-row v-if="review.file_id">
              <v-col cols="12">
                <v-card>
                  <v-card-text>
                    <img
                      :src="getFileUrl(review.file_name)"
                      class="image-comment"
                      alt="Изображение"
                      @click="openEnlargedImage(review.file_name)"
                    >
                  </v-card-text>
                </v-card>
              </v-col>
            </v-row>
          </v-card>
        </v-col>
      </v-row>
      <v-card-actions>
        <v-btn v-if="canEditOrDelete(review)" color="primary" @click.prevent="editReview(index)">Редактировать</v-btn>
        <v-btn v-if="canEditOrDelete(review)" color="error" @click.prevent="deleteReview(index)">Удалить</v-btn>
      </v-card-actions>
    </v-card>
  
        </div>
      </div>
    </section>
    
    
  
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    theme: {
    defaultTheme: 'light'
  },
    data() {
      return {
        reviewType: 'client',
        nameOrCompany: '',
        comment: '',
        file: null,
        consent: false,
        requiredRule: v => !!v || 'Это поле обязательно к заполнению',
        dialogVisible: false,
        requiredConsentRule: v => !!v || 'Необходимо дать согласие на обработку персональных данных',
        reviews: [], // Инициализируем массив для хранения комментариев
       // sessionData: this.getSessionData(), // Получаем данные сессии из локального хранилища
        enlargedImageVisible: false,
         enlargedImageSrc: '',
      };
    },
    created() {
      // Вызываем функцию для получения комментариев при создании компонента
      this.getComments();
    },
    methods: {
      getFileUrl(fileId) {
      return `/api/uploads/${fileId}`; // Замените на реальный путь к файлу на сервере
    },
      async getComments() {
        try {
          const response = await axios.get('/api/get.php'); // Замените на реальный путь к PHP-файлу
          this.reviews = response.data; // Обновляем массив reviews с полученными данными
          console.log(response.data);
        } catch (error) {
          console.error('Error fetching comments:', error);
        }
      },
      deleteReview(index) {
      // Удаляем комментарий по индексу
      this.reviews.splice(index, 1);
      },
      handleFileChange(event) {
        this.file = event.target.files[0];
      },
      closeDialog() {
        this.dialogVisible = false;
      },
      
      /*getSessionData() {
        let session = JSON.parse(localStorage.getItem('session'));
        if (!session) {
          // Проверяем, есть ли номер сессии в cookie
          const sessionNumber = this.getCookie('sessionNumber');
          if (sessionNumber) {
            session = {
              userId: sessionNumber,
            };
          } else {
            // Генерируем случайный номер сессии
            const randomSessionNumber = Math.floor(Math.random() * 1000000);
            session = {
              userId: randomSessionNumber.toString(),
            };
            // Записываем номер сессии в cookie
            this.setCookie('sessionNumber', session.userId, 365); // Здесь 365 - срок действия cookie в днях
          }
          localStorage.setItem('session', JSON.stringify(session));
        }
        return session;
      },*/
  
      getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
      },
  
      setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = `expires=${date.toUTCString()}`;
        document.cookie = `${name}=${value};${expires};path=/`;
      },
      openEnlargedImage(imageFileName) {
      this.scrollPosition = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
      this.enlargedImageSrc = this.getFileUrl(imageFileName);
      this.enlargedImageVisible = true;
    },
    closeEnlargedImage() {
      this.enlargedImageVisible = false;
      this.enlargedImageSrc = '';
    },
    handleDialogClose(val) {
      if (!val) {
        this.scrollToPosition();
      }
    },
    scrollToPosition() {
      window.scrollTo(0, this.scrollPosition);
    },
  
      async submitReview() {
        
        if (!this.$refs.form.validate() || !this.consent) {
          console.log('Submit aborted');
          return;
        }
  
        if (!this.nameOrCompany || !this.comment) {
          console.log('Required fields are missing');
          return;
        }
        const formData = new FormData();
        formData.append('reviewType', this.reviewType);
        formData.append('nameOrCompany', this.nameOrCompany);
        formData.append('comment', this.comment);
        if (this.file) {
          formData.append('file', this.file);
        }
  
        try {
          // Отправляем данные на сервер
          const response = await axios.post('/api/push.php', formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          });
  
          // Обработка успешного ответа
          const newReview = response.data;
          this.reviews.push(newReview);
          this.dialogVisible = true;
          this.resetFormFields();
  
        } catch (error) {
          // Обработка ошибок
          console.error('Error submitting review:', error);
        }
      },
      canEditOrDelete(review) {
        // Проверяем, имеет ли текущий пользователь право редактировать/удалять этот отзыв
        return review.userId === this.sessionData.userId;
      },
      // ... (ваша текущая submitReview, handleFileChange и deleteReview)
      editReview(index) {
        console.log(index);
        // Редактирование отзыва
      },
    },
  };
  
  
  </script>
  
  
  
  
  