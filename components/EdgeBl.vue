<template>
    <section class="section n4">
      <div class="container">
        <div class="n4-t"><div class="n4-l-t">Наши преимущества</div>
        </div>
        <div class="n4-b">
          <div class="n4-b-bl-top n4-b-bl">
            <div class="n4-row"
              v-for="(item, index) in filteredRetbl1"
              :key="index"
            >
               <div class="n4-col">
                   <img :src="item.image" alt="" class="n4-ic">
                   <div class="n4-title">{{ item.title }}</div>
                   <div class="n4-text">{{ item.content }}</div>
                </div>
            </div>
          </div>
          <div class="n4-b-bl-center n4-b-bl">
            <div class="n4-b-bl-center-l">
              <div class="n4-image-bl"><img src="../images/im/preimscreen.png" alt="" class="n4-image"></div>
              <div class="n4-b-bl-center-r">
                <div class="n4-row"
                  v-for="(item, index) in filteredRetbl2"
                  :key="index"
                >
                <div class="n4-col">
                      <img :src="item.image" alt="" class="n4-ic">
                      <div class="n4-title">{{ item.title }}</div>
                      <div class="n4-text">{{ item.content }}</div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="boom exto1"><div class="section-btn section-btn-v1 ex">Бесплатная консультация</div></div>
        </div>
      </div>

<div class="container">
   <div class="bl-loyalty">
    <div class="loyalty-main-title">
      Программа лояльности
    </div>
      <div class="loyalty-block">
        <div class="loyalty-row"
          v-for="(item, index) in loyalty"
          :key="index"
        >
          <div class="loyalty-col">
            <div class="loyalty-t">
            <div class="loyalty-title">{{ item.title }}</div>
            <div class="loyalty-text">{{ item.text }}</div>
            </div>
            <div class="loyalty-b">
              <div class="loyalty-nume">{{ item.nume}}</div>
              <div class="loyalty-sebtext">{{ item.subtext }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
 

    </section>
  </template>

<script>
export default {
  name: 'EdgeBl',
  computed: {
    filteredRetbl1() {
      return this.retbl1.filter((item, index) => index < 3);
    },
     filteredRetbl2() {
      return this.retbl1.filter((item, index) => index >= 3);
    },
  },
  data() {
    return {
      loyalty: [
        {
          title: 'Постоплата',
          text: 'Оплата по факту трудоустройства и выхода сотрудника на работу в течение 3-х рабочих дней. ',
          nume: '0 ₽',
          subtext: 'Постоплата',
        },
          {
          title: 'Выгодные скидки ',
          text: 'Постоянным партнерам и клиентам с заявкой от 3-х вакансий скидка 10-15% на услуги подбора и другие консалтинговые услуги S-vita consulting group.',
          nume: '10-15%',
          subtext: 'Скидка постоянным клиентам',
        },
          {
          title: 'Гарантийный период',
          text: 'Предоставляется замена сотрудника, не прошедшего испытательный срок, в течение всего срока гарантии (однократно бесплатно).',
          nume: '0 ₽',
          subtext: 'Гарантийный период',
        },
          {
          title: 'Бонусы',
          text: 'Разбор конфликтной ситуации в коллективе / разработка системы подарков для коллектива / другие предложения по удержанию и налаживанию атмосферы внутри коллектива.',
          nume: '∞',
          subtext: 'Подарки',
        },
      ],
      retbl1: [
        {
          image: require('../images/im/preim1.svg'),
          title: 'Только самые сильные потенциальные претенденты на должность',
          content: 'Предлагаем к рассмотрению лучших кандидатов, точно соответствующих запросам и профилю.',
        },
        {
          image: require('../images/im/preim2.svg'),
          title: 'Собеседование с руководителями SCG',
          content: 'Помимо HR-менеджеров собеседования с кандидатами проводят профильные руководители направлений (финансовый директор, главный бухгалтер, руководитель юридического направления, руководитель IT-направления).',
        },
        {
          image: require('../images/im/preim3.svg'),
          title: 'Замена сотрудника по гарантии',
          content: 'Предоставим замену сотрудника, не прошедшего испытательный срок, в течение всего срока гарантии (однократно бесплатно).',
        },
        {
          image: require('../images/im/preim4.svg'),
          title: 'Эксклюзивные источники поиска кандитатов',
          content: 'Помимо рабочих сайтов используем собственную базу, рекламные каналы, соцсети, профильные мероприятия.',
        },
        {
          image: require('../images/im/preim5.svg'),
          title: 'Скорость подбора, поддержка 24/7',
          content: 'Обеспечиваем оперативное закрытие вакансии благодаря экспертизе и динамичности команды.',
        },
         {
          image: require('../images/im/preim6.svg'),
          title: 'Оплата за результат',
          content: 'Оплачиваете услугу после трудоустройства без предоплаты и изменения стоимости.',
        },
        {
          image: require('../images/im/preim7.svg'),
          title: 'Команда профессионалов с многолетним опытом в сфере управления человеческими ресурсами',
        }, 
      ],
      activeBlock: null,
    };
  },
  methods: {

  },
};
</script>


