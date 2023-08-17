<template>
  <v-app>
    <v-dialog v-model="dialogVisible">
      <v-card class="card-sh">
        <section class="section form-well base-up section-bl5 form-out form-out1" date-nameform="base-up">
          <form action="/call.php" class="form-call" method="post" novalidate="novalidate" id="form7">
            <div class="sp-bl1">
              <div class="ex exto1" @click="closeDialog"> <img src="img_v2/ex.svg" alt="/" class="ex"> </div>
              <div class="form-t"> <div class="titlesp"> Получить бесплатную консультацию </div></div>
              <div class="form-b-b-b">
                <div class="form-b-b-b-t">
                  <div class="btn-title"> ФИО/Компания* </div>
                  <div class="type-btn cl-name-er-btn-i">
                    <img src="img_v2/icim1.svg" alt="" class="icon-vm1">
                    <input type="text" class="maininput toname" name="name" placeholder="Имя" date-nameform="base-up">
                  </div>
                  <div class="btn-title">   Телефон*  </div>
                  <div class="type-btn cl-tel-er-btn-i">
                    <img src="img_v2/icim10.svg" alt="" class="icon-vm1">
                    <input type="tel" class="maininput totel" name="tel" placeholder="8 (904) 200-54-95" date-nameform="base-up">
                    <input type="text" class="lov2" name="tel" style="max-height: 0px; max-width: 0px; opacity: 0px;">
                  </div>
                  <div class="btn-title">  Кого ищем/специальность </div>
                  <div class="type-btn">
                    <img src="img_v2/icim1.svg" alt="" class="icon-vm1">
                    <input type="text" class="maininput tosubname" name="subname" placeholder="Бухгалтер" date-nameform="base-up">
                  </div>
                </div>
                <div class="form-b-b-b-b" date-nameform="base-up">
                  <div class="section-btn section-btn-v1 submit form-main-b1 tosendi" date-nameform="base-up">Начать работу</div>
                  <div class="polzi hidden">требуется согласие с политикой конфиденциальности</div>
                  <div class="polz-bl">
                    <div type="text" class="polzinput" date-nameform="base-up"></div>
                    <img src="img_v2/icim7.svg" alt="" class="polz1">
                    <img src="img_v2/icim77.svg" alt="" class="polz2 hidden">
                    <div class="polz">С <span class="exit-btn">политикой конфиденциальности</span> ознакомлен(а)</div>
                  </div>
                </div>
              </div>
            </div>
          </form>  
        </section>
      </v-card>
    </v-dialog>

    <button @click="openDialog" class="ex-popup">Открыть попап по классу</button>

  </v-app>
</template>

 

<script>
export default {
  data() {
    return {
      dialogVisible: false,
    };
  },
  methods: {
    openDialog() {
      this.dialogVisible = true;
    },
    closeDialog() {
      this.dialogVisible = false;
    },
  },
};
</script>