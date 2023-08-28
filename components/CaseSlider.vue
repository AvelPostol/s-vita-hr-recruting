<template>
    <section class="section n2" id="id2">
      <v-container>
        <v-row>
          <v-col cols="12">
            <div class="n2-title">
              Наши кейсы
            </div>
          </v-col>
          <v-col cols="12">
            <v-carousel
                v-model="activeSlide"
                hide-delimiters
                hide-delimiter-background
            >
          
              <v-carousel-item v-for="(item, index) in items" :key="index">
                <div class="n2-contain">
                  <div class="n2-st1">
                    <div class="n2-l"></div>
                    <div class="n2-r">
                      <div class="n2-t">
                        {{ item.title }}
                      </div>
                      <div class="n2-b">
                        {{ item.content }}
                      </div>
                    </div>
                  </div>
                  <div class="n2-st2">
                    <div class="n2-l">
                      <div class="n2-c">
                        <div class="n2-c-t">
                          Требования
                        </div>
                        <div class="n2-c-b">
                          {{ item.requirements }}
                        </div>
                      </div>
                    </div>
                    <div class="n2-r">
                      <div class="n2-c">
                        <div class="n2-c-t">
                          Сделано
                        </div>
                        <div class="n2-c-b">
                          {{ item.done }}
                        </div>
                      </div>
                      <div class="n2-c">
                        <div class="n2-c-t">
                          Результат
                        </div>
                        <div class="n2-c-b">
                          {{ item.result }}
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="n2-st3 nw" v-if="item.point_nume1">
                        <div class="n2-st3-l" v-if="item.point_nume1">
                            <div class="n3-c">
                                <div class="n3-c-t">
                                  {{ item.point_nume1 }}
                                </div>
                                <div class="n3-c-b">
                                  {{ item.oint_text1 }}
                                </div>
                            </div>
                        </div>
                        <div class="n2-st3-r" v-if="item.point_nume2">
                            <div class="n3-c">
                             <div class="n3-c-t">
                                  {{ item.point_nume2 }}
                                </div>
                                <div class="n3-c-b">
                                  {{ item.oint_text2 }}
                                </div>
                            </div>
                            <div class="n3-c">
                                <div class="n3-c-t">
                                  {{ item.point_nume3 }}
                                </div>
                                <div class="n3-c-b">
                                  {{ item.oint_text3 }}
                                </div>
                            </div>
                        </div>
                  </div>
                  <div class="n2-st3 nw" v-if="item.point_nume4">
                        <div class="n2-st3-l"></div>
                        <div class="n2-st3-r">
                            <div class="n3-c">
                               <div class="n3-c-t">
                                  {{ item.point_nume4 }}
                                </div>
                                <div class="n3-c-b">
                                  {{ item.oint_text4 }}
                                </div>
                            </div>
                            <div class="n3-c">
                               <div class="n3-c-t">
                                  {{ item.point_nume5 }}
                                </div>
                                <div class="n3-c-b">
                                  {{ item.oint_text5 }}
                                </div>
                            </div>
                        </div>
                  </div>
                  <div class="n2-st3 nm">
                        <div class="n3-c" v-if="item.point_nume1">
                           <div class="n3-c-t">
                                  {{ item.point_nume1 }}
                                </div>
                                <div class="n3-c-b">
                                  {{ item.oint_text1 }}
                                </div>
                        </div>
                        <div class="n3-c" v-if="item.point_nume2">
                          <div class="n3-c-t">
                                  {{ item.point_nume2 }}
                                </div>
                                <div class="n3-c-b">
                                  {{ item.oint_text2 }}
                                </div>
                        </div>
                        <div class="n3-c" v-if="item.point_nume3">
                          <div class="n3-c-t">
                                  {{ item.point_nume3 }}
                                </div>
                                <div class="n3-c-b">
                                  {{ item.oint_text3 }}
                                </div>
                        </div>
                        <div class="n3-c" v-if="item.point_nume4">
                           <div class="n3-c-t" >
                                  {{ item.point_nume4 }}
                                </div>
                                <div class="n3-c-b">
                                  {{ item.oint_text4 }}
                                </div>
                        </div>
                        <div class="n3-c" v-if="item.point_nume5">
                          <div class="n3-c-t">
                                  {{ item.point_nume5 }}
                                </div>
                                <div class="n3-c-b">
                                  {{ item.oint_text5 }}
                                </div>
                        </div>
                  </div>
                </div>
              </v-carousel-item>

      
            </v-carousel>
          </v-col>
          <v-col cols="12">
            <div class="n2-st4">
              <div class="n2-l">
                <div class="n2-btn n2-prev" @click="goToNextSlide">
                 Следующий кейс
                </div>
              </div>
              <div class="n2-r">
                <img src="../images/img_v2/n2-prev.svg" alt="" class="n2-prev" @click="goToPrevSlide">
                <img src="../images/img_v2/n2-next.svg" alt="" class="n2-next" @click="goToNextSlide">
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>
  </template>

  
  <script>
  export default {
    name: 'CaseSlider',
    methods: {
        goToPrevSlide() {
        this.activeSlide = Math.max(this.activeSlide - 1, 0);
        },
        goToNextSlide() {
        this.activeSlide = Math.min(this.activeSlide + 1, this.items.length - 1);
        },
    },
    data() {
      return {
      
        activeSlide: 0, // Начальный слайд
        items: [
          {
            title: 'Руководитель отдела продаж юридической фирмы',
            content: 'Мы поддерживаем связь с подобранным специалистом и компанией на протяжении 6-ти месяцев. Отслеживаем процесс адаптации сотрудника, в случае проблем - предлагаем решение или производим бесплатную замену на другого кандидата. ',
            requirements: 'РОП с опытом работы в юридической сфере от 5 лет, понимание В2В-рынка.',
            done: 'Составлен портрет кандидата, разработана стратегия поиска, подготовлено задание на поиск.',
            result: 'Подобран РОП, отвечающий требованиям заказчика. Учтены запросы по компетенциям, опыту работу, личным и деловым качествам.',
            point_nume1: '1012+',
            point_nume2: '109+',
            point_nume3: '17',
            point_nume4: '3',
            point_nume5: '1',
            oint_text1: 'Просмотров объявлений за 14 дней',
            oint_text2: 'Получено в результате откликов и холодного поиска',
            oint_text3: 'Кандидатов прошли интревью и рекомендованы заказчику.',
            oint_text4: 'Кандидата отобрано в резерв',
            oint_text5: 'Сотрудник трудоустроен в компанию',
          },
          {
            title: 'Директор информационных технологий производственной компании',
            content: '1 выход на работу и 1 - резерв, 4 претендента не удовлетворили требования заказчика, 1 - отказался по различным причинам...',
            requirements: 'Опыт работы руководителем подразделения IT/директором департамента IT от 2 лет в производственной компании, Английский язык C1, лидерские качества.',
            done: 'Проведен анализ рынка, выработан план подбора. Разработан первичный тест и чек-лист идеального кандидата.',
            result: 'Новый Директор быстро адаптировался в компании и нашёл общий язык с подчиненными. Условия сотрудничества и система мотивации полностью удовлетворили кандидата.',
            point_nume1: '769+',
            point_nume2: '81+',
            point_nume3: '7',
            oint_text1: 'Просмотров объявлений за 16 дней',
            oint_text2: 'Получено в результате откликов и холодного поиска',
            oint_text3: 'Кандидатов прошли интревью и рекомендованы заказчику.',
          },
        ],

      };
    },
  };
  </script>
  
  