<template>
<section class="section n5">
    <div class="containei">
        <div class="container">
   
            <div class="n5-l">
                <div class="n5-t">
                    Долго не можете найти подходящие кадры? <br> Закажите бесплатный мониторинг рынка труда! <br> 
                </div>
                <div class="n5-b">
                    Мы проведем анализ предложений конкурентов, <br> дадим оценку системам мотивации, условиям работы специалиста <br> и составим пошаговый план поиска сотрудника. 
                </div>
            </div>
            <div class="n5-r">
                <section class="section form-well base" date-nameform="base">
    
                    <form action="/call.php" class="form-call " method="post" novalidate="novalidate" id="form7">
                  
                        <input type="tel" class="maininput totel cl-tel-er-btn-i" name="tel" placeholder="Телефон" date-nameform="base" v-mask="['+7 (9##) ###-##-##']">
                        <input type="text" class="maininput toname cl-name-er-btn-i" name="name" placeholder="Ваше имя" date-nameform="base">
                        <div class="section-btn section-btn-v1 submit form-main-b1 tosendi" date-nameform="base">Заказать мониторинг</div>
                  
                    </form>
                  </section>
            </div>
    
            <div class="n5-r-i">
                <div class="boom exto1"><div class="section-btn section-btn-v1 submit form-main-b1 tosendi" @click="submitForm" date-nameform="base-up">Оставить заявку</div></div>
            </div>
            
        </div>
    </div>
   
</section>
</template>

<script>

import {mask} from 'vue-the-mask';
export default {
  name: 'LentForm',
  directives: {mask},
  methods: {
  async submitForm() {
    const form = document.getElementById('form7'); // Замените на ID вашей формы
    if (form.checkValidity()) {
      // Валидация успешна
      try {
        // Отправка данных на сервер
        const response = await fetch('/call.php', {
          method: 'POST',
          body: new FormData(form)
        });

        // Обработка ответа от сервера, если нужно
        // Например, показ сообщения об успешной отправке
        if (response.ok) {
          alert('Форма успешно отправлена');
          // Скрыть диалоговое окно
          this.closeDialog();
        } else {
          alert('Произошла ошибка при отправке формы');
        }
      } catch (error) {
        console.error('Ошибка при отправке формы:', error);
      }
    } else {
      // Если форма не валидна, вы можете показать сообщение или выполнить другие действия
    }
  },
},
}
</script>