<template>
<v-dialog v-model="popup" scroll-strategy="none" ref="dialogRef" :ripple="false" class="extra-dial">
      <v-card class="card-sh" @click.stop :ripple="false">
        <section class="section form-well base-up section-bl5 form-out form-out1" date-nameform="base-up">
          <form action="/call.php" class="form-call" method="post" novalidate="novalidate" id="form7">
            <div class="sp-bl1">
              <div class="ex exto1" @click="closeDialog"> <img src="../images/img_v2/ex.svg" alt="/" class="ex"> </div>
              <div class="form-t"> <div class="titlesp"> Получить бесплатную консультацию </div></div>
              <div class="form-b-b-b">
                <div class="form-b-b-b-t">
                  <div class="btn-title"> ФИО/Компания* </div>
                  <div class="type-btn cl-name-er-btn-i">
                    <img src="../images/img_v2/icim1.svg" alt="" class="icon-vm1">
                    <input type="text" class="maininput toname" name="name" placeholder="Имя" date-nameform="base-up">
                  </div>
                  <div class="btn-title">   Телефон*  </div>
                  <div class="type-btn cl-tel-er-btn-i">
                    <img src="../images/img_v2/icim10.svg" alt="" class="icon-vm1">  
                    <input type="tel" class="maininput totel" name="tel" placeholder="8 (904) 200-54-95" date-nameform="base-up" v-mask="['+7 (9##) ###-##-##']">
                  </div>
                  <div class="btn-title">  Кого ищем/специальность </div>
                  <div class="type-btn">
                    <img src="../images/img_v2/icim1.svg" alt="" class="icon-vm1">
                    <input type="text" class="maininput tosubname" name="subname" placeholder="Бухгалтер" date-nameform="base-up">
                  </div>
                </div>
                <div class="form-b-b-b-b" date-nameform="base-up">
                  <div class="section-btn section-btn-v1 submit form-main-b1 tosendi" date-nameform="base-up">Начать работу</div>
                  <div class="polzi hidden">требуется согласие с политикой конфиденциальности</div>
                  <div class="polz-bl">
                    <div type="text" class="polzinput" date-nameform="base-up"></div>
                    <img src="../images/img_v2/icim7.svg" alt="" class="polz1">
                    <img src="../images/img_v2/icim77.svg" alt="" class="polz2 hidden">
                    <div class="polz">С <span class="exit-btn">политикой конфиденциальности</span> ознакомлен(а)</div>
                  </div>
                </div>
              </div>
            </div>
          </form>  
        </section>
      </v-card>
    </v-dialog>
</template>



<script>
import {mask} from 'vue-the-mask';
import { support, handleAppClick, LentClick } from '../assets/js/support.js';
import { mapGetters } from 'vuex';

export default {
  directives: {mask},
  data() {
    return {
     
      phoneNumber: '',
      name: '',
      textValidationRules: [
        v => !!v || 'Поле обязательно для заполнения',
      ],
    };
  },
  computed: {
    ...mapGetters(['popup'])
  },
  mounted() {
    LentClick();
    const handleClick = async (event) => {
      let clickedOnOpenDialogButton = await support(this, event);
      if (clickedOnOpenDialogButton === false) {
        await handleAppClick(this, event);
      }
    };
    document.addEventListener('click', handleClick);
  },
  methods: {
    closeDialog(){
      this.$store.dispatch('TOGGLE_DIALOG', false);
    }
  },
  beforeUnmount() {
    document.removeEventListener('click', this.handleAppClick);
  },
};
</script>

<style>
.v-dialog__content.v-dialog__content--active{
  width: 100vw;
  overflow: hidden;
  background-image: none;
  flex-direction: column;
  height: 100vh;
  z-index: 10000!important;
  background-color: #2c3354d7;
  position: fixed;
  top: 0px;
  left: 0px;
  -webkit-backdrop-filter: blur(2px);
  backdrop-filter: blur(2px);
}
.v-dialog{
  width: fit-content;
  overflow: visible;
  /*  padding: 40px 0px 20px 0px;*/
}
</style>