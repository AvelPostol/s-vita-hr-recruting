<template>
    <v-section class="section section-bl5 form-out form-out1">
      <v-container>
        <v-section class="section form-well base-up" data-nameform="base-up">
          <v-form @submit.prevent="submitForm" action="/call.php" class="form-call" method="post" novalidate="novalidate" id="form7">
            <div class="sp-bl1">
              <div class="ex exto1">
                <img src="https://test.24kibo.ru/img_v2/ex.svg" alt="/" class="ex">
              </div>
              <div class="form-t">
                <div class="titlesp">
                  Получить бесплатную консультацию
                </div>
              </div>
              <div class="form-b-b-b">
                <div class="form-b-b-b-t">
                    <div class="btn-title">
                        Введите ФИО/ название компании*
                    </div>
                    <div class="type-btn-vue">
                        <img src="https://test.24kibo.ru/img_v2/icim1.svg" alt="" class="icon-vm1">
                        <v-text-field
                            v-model="fullName"
                            required
                            :rules="[requiredRule]"
                            data-nameform="base-up"
                        ></v-text-field>
                    </div>
                    <div class="btn-title">
                        Введите телефон*
                    </div>
                    <div class="type-btn-vue">
                        <img src="https://test.24kibo.ru/img_v2/icim10.svg" alt="" class="icon-vm1">
                        <v-text-field
                            v-model="phoneNumber"
                            required
                            :rules="[requiredRule]"
                            data-nameform="base-up"
                        ></v-text-field>
                    </div>
                    <div class="btn-title">
                        Введите Кого ищем/специальность
                    </div>
                    <div class="type-btn-vue">
                        <img src="https://test.24kibo.ru/img_v2/icim1.svg" alt="" class="icon-vm1">
                        <v-text-field
                            v-model="specialization"
                            data-nameform="base-up"
                        ></v-text-field>
                    </div>
                </div>
                <div class="form-b-b-b-b" data-nameform="base-up">
                  <v-btn class="section-btn section-btn-v1 submit form-main-b1 tosendi" @click.prevent="submitForm" data-nameform="base-up">
                    Начать работу
                  </v-btn>
                  <v-checkbox v-model="consent" :rules="[requiredConsentRule]" class="my-checkbox">
                        <template #label>
                        <div class="checkbox-content">
                            <span>С </span>
                            <a class="exit-btn" >политикой конфиденциальности ознакомлен(а)</a>
                        </div>
                        </template>
                    </v-checkbox>
                </div>
              </div>
            </div>
          </v-form>
        </v-section>
      </v-container>
    </v-section>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
    return {
      fullName: '',
      phoneNumber: '',
      specialization: '',
      consent: false,
      requiredRule: v => !!v || 'Это поле обязательно к заполнению',
      requiredConsentRule: [v => !!v || 'Необходимо дать согласие на обработку данных'],
    };
    },
    methods: {
      async submitForm() {
      
      if (!this.$refs.form.validate() || !this.consent) {
        console.log('Submit aborted');
        return;
      }

      if (!this.fullName || !this.phoneNumber) {
        console.log('Required fields are missing');
        return;
      }
      const formData = new FormData();
      formData.append('reviewType', this.fullName);
      formData.append('nameOrCompany', this.phoneNumber);
      formData.append('comment', this.specializatio);

      try {
        // Отправляем данные на сервер
        const response = await axios.post('/api/call-push.php', formData, {
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
    }
  };
  </script>
  