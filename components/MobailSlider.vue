<template>
    <v-container class="section s3 nm">
      <v-row>
        <v-col cols="6">
          <div class="s3-l-t">
            Почему рекрутинг <br> с SCG эффективнее?
          </div>
          <div class="s3-r-b b1">
            <!-- Ваш текст -->
          </div>
          <div class="s3-r-b b2">
            <!-- Ваш текст -->
          </div>
        </v-col>
        <v-col cols="6">
          <v-carousel hide-delimiters>
            <v-carousel-item v-for="(item, index) in items" :key="index">
              <div class="slidi">
                <div class="swiper3-t">
                  <div class="swiper3-l">
                    {{ index + 1 }}
                  </div>
                  <div class="swiper3-r">
                    {{ item.text }}
                  </div>
                </div>
                <v-img :src="item.image" class="imper"></v-img>
              </div>
            </v-carousel-item>
          </v-carousel>
          <div class="n2-st4">
            <div class="nuberi">
              <div class="kla">{{ activeSlideIndex + 1 }}</div>
              <div class="ski">/5</div>
            </div>
            <v-row class="kjs">
              <v-col cols="6" class="n2-l">
                <v-pagination v-model="activeSlideIndex" :length="items.length"></v-pagination>
              </v-col>
              <v-col cols="6" class="n2-r">
                <v-btn icon @click="nextSlide">
                  <v-icon>mdi-chevron-right</v-icon>
                </v-btn>
              </v-col>
            </v-row>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </template>
  
  <script>
  export default {
    name: 'MobailSlider',
    data() {
      return {
        activeSlideIndex: 0,
        items: [
          { text: "Составляем “портрет” идеального кандидата...", image: "../images/img_v2/repi1.png" },
          { text: "Отбираем подходящих претендентов и проводим собеседования", image: "../images/img_v2/repi2.png" },
          // Добавьте остальные элементы в соответствии с вашим кодом
        ],
      };
    },
    methods: {
      nextSlide() {
        this.activeSlideIndex = (this.activeSlideIndex + 1) % this.items.length;
      },
    },
  };
  </script>