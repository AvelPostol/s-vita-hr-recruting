<template>
  <section class="section-comment-line">
    <div class="container">
      <v-form @submit.prevent="submitReview" class="my-form">
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
      label="Выберите файл"
      accept=".pdf, .doc, .docx, .jpg, .jpeg, .png"
      @change="handleFileChange"
      class="my-input input-dnld"
    ></v-file-input>
    <v-checkbox
      v-model="consent"
      label="Согласие с обработкой персональных данных"
      :rules="[requiredConsentRule]"
      class="my-checkbox"
    ></v-checkbox>
    <v-btn color="primary" type="submit" class="my-button">Оставить комментарий</v-btn>
  </v-form>



  <v-dialog v-model="dialogVisible" max-width="400" class="my-dialog">
    <v-card>
      <v-card-title>Спасибо за отзыв</v-card-title>
      <v-card-text>
        Ваш отзыв был успешно отправлен. Благодарим вас!
      </v-card-text>
      <v-card-actions>
        <v-btn color="primary" @click="closeDialog">Закрыть</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>

  <div class="my-comments">
      <h2>Комментарии</h2>
      <v-card v-for="(review, index) in reviews" :key="index" class="my-comment">
        <v-card-title>
          {{ review.nameOrCompany }}
        </v-card-title>
        <v-card-text>
          {{ review.comment }}
        </v-card-text>
        <v-row v-if="file">
          <v-col cols="12">
            <v-card>
              <v-card-title>Загруженный файл</v-card-title>
              <v-card-text>
                Имя файла: {{ file.name }}
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
        <v-card-actions>
          <v-btn v-if="canEditOrDelete(review)" color="primary" @click="editReview(index)">Редактировать</v-btn>
          <v-btn v-if="canEditOrDelete(review)" color="error" @click="deleteReview(index)">Удалить</v-btn>
        </v-card-actions>
      </v-card>
  </div>
    </div>
  </section>
  
  

</template>

<script>


export default {
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
      sessionData: this.getSessionData(), // Получаем данные сессии из локального хранилища
    };
  },
  methods: {
    submitReview() {
      if (!this.consent) {
        return;
      }

      const newReview = {
      reviewType: this.reviewType,
      nameOrCompany: this.nameOrCompany,
      comment: this.comment,
      file: { ...this.file }, // Копируем информацию о файле
    };

    // Добавляем новый комментарий в массив
    this.reviews.push(newReview);

    // Показываем всплывающее окно
    this.dialogVisible = true;

    // Сбрасываем поля формы после отправки
    this.reviewType = 'client';
    this.nameOrCompany = '';
    this.comment = '';
    this.file = null;
    this.consent = false;

      // Здесь можно выполнить отправку данных на сервер


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
    getSessionData() {
      const session = JSON.parse(localStorage.getItem('session'));
      if (session) {
        return session;
      }
      // Если сессии нет, создаем новую
      const newSession = {
        userId: 'номер сессии', // Может быть случайным числом, строкой или другим уникальным идентификатором
      };
      localStorage.setItem('session', JSON.stringify(newSession));
      return newSession;
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




