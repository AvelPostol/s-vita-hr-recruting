<template>
  <section class="section section-bl11" id="id4">
    <v-container>
      <v-row class="section-bl11-container">
        <v-col cols="12">
          <div class="section-bl11-t">
            <div class="section-bl11-b-title">
              Наша команда
            </div>
            <div class="section-bl11-title-line"></div>
          </div>
        </v-col>
        <v-col cols="12">
 <v-slide-group
    :cycle="false"
    :show-arrows="true"
  >
    <template v-slot:prev>
      <img src="../images/img_v2/n2-prev.svg" alt="" class="n2-prev">
    </template>
    <template v-slot:next>
      <img src="../images/img_v2/n2-next.svg" alt="" class="n2-next">
    </template>

    <v-slide-item
      v-for="(item, index) in teamMembers"
      :key="index"
      :active-class="'v-slide-item--active'"
    >
   <div class="swiper-slid-row">
                  <div class="swiper-slid-col">
                    <v-img :src="item.image" alt="" class="swiper-slid-im"></v-img>
                    <div class="swiper-slid-tit">
                      {{ item.name }}
                    </div>
                    <div class="swiper-slid-text">
                      {{ item.role }}
                    </div>
                  </div>
                </div>
    </v-slide-item>
    </v-slide-group>
        </v-col>
      </v-row>
    </v-container>
  </section>
</template>
  
  <script>
export default {
  name: 'NashaComanda',
  data() {
    return {
      activeSlide: 0,
      teamMembers: [
        {
          name: 'Юлия Бялкова',
          role: 'Руководитель отдела кадрового делопроизводства и рекрутинга',
          image: require('../images/img_v2/person1.png'),
        },
        {
          name: 'Елена Кара',
          role: 'Специалист кадрового делопроизводства',
          image: require('../images/img_v2/person3.png'),
        },
        {
          name: 'Алина Макарова',
          role: 'HR-специалист',
          image: require('../images/img_v2/person2.png'),
        },
        {
          name: 'Мираслава Котенко',
          role: 'Специалист кадрового делопроизводства',
          image: require('../images/img_v2/per8.png'),
        },
        {
          name: 'Анна Урусова',
          role: 'Финансовый директор',
          image: require('../images/img_v2/person4.png'),
        },
        {
          name: 'Наталья Адылова',
          role: 'Главный бухгалтер',
          image: require('../images/img_v2/person5.png'),
        },
      ],
    };
  },
};
</script>